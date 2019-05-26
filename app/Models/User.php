<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Base;

class User extends Base
{
	const TYPE_ADMIN = '1';
	const TYPE_USER = '0';

	const STATUS_DISABLE = '0';
	const STATUS_ENABLE = '1';

	protected static $table = 'tbl_user';
	//protected static $table = 'users';

	public static function get_one($value, $field = 'id') {
		$user = DB::table(self::$table)->where($field, $value)->first();

		return $user;
	}

	public static function get_list($filter) {
		$query = DB::table(self::$table . ' AS user')
			->select('*');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions($filter, $query);
		}

		$users = parent::paginate($filter, $query);

		return $users;
	}

	public static function conditions($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('name', 'like', '%' . $filter['name'] . '%');
		}
		if (isset($filter['email']) && filled($filter['email'])) {
			$query = $query->where('email', 'like', '%' . $filter['email'] . '%');
		}
		if (isset($filter['account_type'])) {
			$query = $query->where('account_type', '=', $filter['account_type']);
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('deleted', '=', $filter['deleted']);
		}
		return $query;
	}

	public static function insert($user) {
		DB::table(self::$table)->insert(
			[
				'name' => $user['name'],
				'email' => $user['email'],
				'password' => $user['password'],
				'account_type' => $user['account_type'],
				'use_status' => $user['use_status'],
				//'remember_token' => $user['remember_token']
				'created_at' => now(),
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function update($user) {
		DB::table(self::$table)->where('id', $user['id'])
			->update([
				'' => $user[''],
				
			]
		);

		return TRUE;
	}

	public static function password($user) {
		DB::table(self::$table)->where('id', $user['id'])
			->update([
				'password' => $user['password'],
			]
		);

		return TRUE;
	}

	public static function status($user) {
		DB::table(self::$table)->where('id', $user['id'])->update([
			'use_status' => $user['use_status']
		]);

		return TRUE;
	}

	public static function delete($id) {
		DB::table(self::$table)->where('id', $id)->update([
			'deleted' => 1
		]);

		return TRUE;
	}

	public static function exist_email($email) {
		$user = DB::table(self::$table)->where('email', $email)->first();

		if ($user === NULL) {
			return FALSE;
		}

		return TRUE;
	}

}
