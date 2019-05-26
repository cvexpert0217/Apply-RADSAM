<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{

	public function get_list(Request $request) {
		$filter = $request->input();
		$filter['account_type'] = User::TYPE_USER;
		$filter['deleted'] = 0;
		$filter = $this->set_pageinfo($filter);

		$users = User::get_list($filter);

		$data['filter'] = $filter;
		$data['users'] = $users;
		return view('admin.user.list', $data);
	}

	public function get_one(Request $request) {
		if (!$request->has('id') || empty($request->input('id'))) {
			return redirect('list');
		}
		
		$id = $request->input('id');
		$user = User::get_one($id);
		if ($user === null) {
			return redirect('list');
		}
		
		$data['user'] = $date;
		return view('admin.user.edit', $data);
	}

	public function status(Request $request) {
		if (!$request->has(['id', 'use_status']) || empty($request->input('id'))) {
			return response()->json(['result' => 'invalid']);
		}
		
		$user = $request->only(['id', 'use_status']);
		$temp = User::get_one($user['id']);
		if ($temp === null || $temp->deleted == 1) {
			return response()->json(['result' => 'invalid']);
		}

		User::status($user);

		return response()->json(['result' => 'success']);
	}

	public function delete(Request $request) {
		if (!$request->has('id') || empty($request->input('id'))) {
			return response()->json(['result' => 'invalid']);
		}
		
		$id = $request->input('id');
		$temp = User::get_one($id);
		if ($temp === null) {
			return response()->json(['result' => 'invalid']);
		}

		User::delete($id);

		return response()->json(['result' => 'success']);
	}
}
