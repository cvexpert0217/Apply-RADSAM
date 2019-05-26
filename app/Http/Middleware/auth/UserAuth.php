<?php

namespace App\Http\Middleware\Auth;

use Closure;

use App\Models\User;

class UserAuth
{

	public function handle($request, Closure $next) {
		$login_user = $request->session()->get(config('radasm.session.user'));
		if (empty($login_user)) {
			return redirect(route('login'));
		}
		if ($login_user->account_type == User::TYPE_ADMIN) {
			return redirect(route('admin.index'));
		}

		return $next($request);
	}

}
