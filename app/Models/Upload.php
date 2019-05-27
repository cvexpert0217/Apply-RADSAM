<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Base;

class Upload extends Base
{
	public static function get_activities($filter) {
		$filter['deleted'] = '0';
		$filter['activity_type'] = '2';
		$filter['status'] = '0';

		$query = DB::table('tbl_activity AS t1')
			->leftjoin('tbl_assessment AS t2', 't1.assessment_id', '=', 't2.id')
			->leftjoin('tbl_user AS t3', 't3.id', '=', 't2.user_id')
			->leftjoin('tbl_admission AS t4', 't4.assessment_id', '=', 't1.assessment_id')
			->select('t1.id', 't1.assessment_id', 't2.first_name', 't2.last_name', 't2.assessment_type', 't4.docs_name', 't1.created_at', 't3.name AS user_name')
			->orderBy('t1.updated_at', 'DESC');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_activities($filter, $query);
		}

		$activities = parent::paginate($filter, $query);
		return $activities;
	}

	public static function conditions_for_activities($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('first_name', 'like', '%' . $filter['first_name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted'])
				->where('t1.activity_type', '=', '3')
				->where('t1.status', '=', '0');
		}

		return $query;
	}

	public static function get_docs($assessment_id) {
		$query = DB::table("tbl_allocated_docs")
			->select('docs_type', 'docs_req_id', 'docs_name', 'docs_realname')
			->where('assessment_id','=',$assessment_id)
			->where('deleted','=',0);

		$docs_list = $query->get()->toArray();

		return $docs_list;
	}

	public static function insertDoc($doc) {
        DB::table('tbl_allocated_docs AS allowdocs')
            ->where('id', $doc['doc_id'])
            ->update(['docs_name' => $doc['doc_name'], 'docs_realname' => $doc['doc_realname']]);

        return TRUE;
    }
}
