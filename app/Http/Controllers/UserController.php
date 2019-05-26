<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

	public function login(Request $request) {
		$request->session()->regenerate();

		$data = [
			'user' => [
				'email' => ''
			]
		];

		if ($request->has(['email', 'password'])) {
			$user = $request->only(['email', 'password']);
			$data['user'] = $user;

			$login_user = User::get_one($user['email'], 'email');
			if ($login_user === NULL) {
				$data['error_code'] = 'unregistered_user';
			} else {
				if ($login_user->use_status != User::STATUS_ENABLE) {
					$data['error_code'] = 'disabled_user';
				} else {
					if (Hash::check($user['password'], $login_user->password)) {
						$login_user->password = NULL;
						$request->session()->put(config('radasm.session.user'), $login_user);
						if ($login_user->account_type == User::TYPE_ADMIN) {
							return redirect(route('admin.index'));
						}
						return redirect(route('user.index'));
					} else {
						$data['error_code'] = 'incorrect_password.';
					}
				}
			}
		}

		return view('pages.login', $data);
    }

	public function logout(Request $request) {
		$request->session()->flush();

		return redirect(route('login'));
    }

	public function register(Request $request) {
		$request->session()->regenerate();

		$data = [
			'user' => [
				'name' => '',
				'email' => '',
			]
		];

		if ($request->has(['name', 'email', 'password'])) {
			$user = $request->only(['name', 'email', 'password']);
			$data['user'] = $user;

			if (User::exist_email($user['email'])) {
				$data['error_code'] = 'exist_email';
			} else {
				$user['password'] = Hash::make($user['password']);
				$user['account_type'] = User::TYPE_USER;
				$user['use_status'] = User::STATUS_DISABLE;

				User::insert($user);
				$data['msg_code'] = 'register_success';
			}
		}

		return view('pages.register', $data);
    }

}
