<?php

namespace App\Http\Middleware\Auth;

use Closure;

use App\Models\User;

class AdministratorAuth
{

	public function handle($request, Closure $next) {
		$login_user = $request->session()->get(config('radasm.session.user'));
		if (empty($login_user)) {
			return redirect(route('login'));
		}
		if ($login_user->account_type != User::TYPE_ADMIN) {
			return redirect(route('login'));
		}
		/*
		if (! $request->is('admin*')) {
			return redirect(route('login'));
		}
		 */

		return $next($request);
	}

}
