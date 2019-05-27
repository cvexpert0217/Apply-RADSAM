<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Base;

class Invoice extends Base
{
	protected static $table = 'tbl_message_admin';

	public static function get_one($value, $field = 'id') {
		$invoice = DB::table(self::$table)->where($field, $value)->first();

		return $invoice;
	}

	public static function detail($id) {
		$query = DB::table(self::$table.' AS t1')
			->leftjoin('tbl_activity AS t2', 't1.activity_id', '=', 't2.id')
			->leftjoin('tbl_assessment AS t3', 't2.assessment_id', '=', 't3.id')
			->leftjoin('tbl_user AS t4', 't3.user_id', '=', 't4.id')
			->select('t1.id', 't3.first_name', 't3.last_name', 't2.activity_type', 't2.status', 't1.msg_title', 't1.msg_content', 't1.created_at', 't4.name AS user_name')
			->where('t1.id', '=', $id)
			->where('t2.status', '!=', 0);

		DB::table(self::$table)->where('id', $id)->update([
			'isBrowsed' => 1
		]);

		$invoice = $query->first();
		return $invoice;
	}

	public static function get_list($filter) {
		$filter['deleted'] = '0';
		$query = DB::table(self::$table.' AS t1')
			->leftjoin('tbl_activity AS t2', 't1.activity_id', '=', 't2.id')
			->leftjoin('tbl_assessment AS t3', 't2.assessment_id', '=', 't3.id')
			->leftjoin('tbl_user AS t4', 't3.user_id', '=', 't4.id')
			->select('t1.id', 't3.id AS assessment_id', 't3.first_name', 't3.last_name', 't1.msg_title', 't1.isBrowsed', 't1.created_at', 't4.name AS user_name')
			->orderBy('t1.created_at', 'DESC')
			->where('t2.status', '!=', 0);

		if (isset($filter) && !blank($filter)) {
			$query = self::conditions($filter, $query);
		}

		$invoiced = parent::paginate($filter, $query);
		return $invoiced;
	}

	public static function conditions($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('name', 'like', '%' . $filter['name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted']);
		}
		return $query;
	}

	public static function sendMsg($filter) {
		DB::table('tbl_message_user')->insert(
			[
				'activity_id' => $filter['activity_id'],
				'msg_title' => $filter['msg_title'],
				'msg_content' => $filter['msg_content'],
				'created_at' => now(),
				'isBrowsed' => 0,
				'admin_message_id' => $filter['id'],
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function deleteMsg($id) {
		DB::table(self::$table)->where('id', $id)->update([
			'deleted' => 1
		]);

		return TRUE;
	}
}
