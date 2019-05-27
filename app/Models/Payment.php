<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Base;

class Payment extends Base
{
	protected static $table = 'tbl_payment';

	public static function get_activities($filter) {
		$filter['deleted'] = '0';
		$filter['activity_type'] = '2';
		$filter['status'] = '0';
		$query = DB::table('tbl_activity AS t1')
			->leftjoin('tbl_assessment AS t2', 't1.assessment_id', '=', 't2.id')
			->leftjoin('tbl_user AS t3', 't3.id', '=', 't2.user_id')
			->leftjoin('tbl_transaction AS t4', 't4.assessment_id', '=', 't1.assessment_id')
			->select('t1.id', 't1.assessment_id', 't2.first_name', 't2.last_name', 't2.assessment_type', 't4.pay_price', 't4.pay_image', 't4.pay_realimage', 't4.pay_type', 't1.updated_at', 't3.name AS user_name')
			->orderBy('t1.updated_at', 'DESC');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_activities($filter, $query);
		}

		$activities = parent::paginate($filter, $query);
		return $activities;
	}

	public static function conditions_for_activities($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('first_name', 'like', '%' . $filter['name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted'])
							->where('t1.activity_type', '=', $filter['activity_type'])
							->where('t1.status', '=', $filter['status'])
							->where('t4.pay_image', '!=', NULL)
							->where('t4.pay_type', '!=', NULL);
		}

		return $query;
	}

	public static function insert2docs($filter) {
		DB::table('tbl_allocated_docs')->insert(
			[
				'assessment_id' => $filter['assessment_id'],
				'docs_type' => $filter['doc_type'],
				'docs_req_id' => $filter['doc_req_id'],
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function insert2msg($filter) {
		DB::table('tbl_message_user')->insert(
			[
				'activity_id' => $filter['activity_id'],
				'msg_title' => $filter['msg_title'],
				'msg_content' => $filter['msg_content'],
				'created_at' => now(),
				'isBrowsed' => 0,
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function update2activity($id, $status) {
		DB::table('tbl_activity')->where('id', $id)
			->update([
					'status' => $status,
					'updated_at' => now(),
				]
			);

		return TRUE;
	}
}
