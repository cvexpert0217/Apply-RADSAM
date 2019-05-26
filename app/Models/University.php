<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class University extends Base
{
    protected static $table = "tbl_university";

	public static function get_category($value, $field = 'id') {
		$category = DB::table(self::$table)->where($field, $value)->first();

		return $category;
	}

	public static function get_categories($filter, $pagination = TRUE) {
		$query = DB::table(self::$table . ' AS university')
			->select('*')
			->orderBy('created_at', 'DESC');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_category($filter, $query);
		}

		if ($pagination) {
			$categories = parent::paginate($filter, $query);
		} else {
			$categories = $query->get();
		}

		return $categories;
	}

	public static function conditions_for_category($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('name', 'like', '%' . $filter['name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('deleted', '=', $filter['deleted']);
		}
		if (isset($filter['type'])) {
			$query = $query->where('type', '=', $filter['type']);
		}
		return $query;
	}

	public static function insert_category($category) {
		DB::table(self::$table)->insert(
			[
				'name' => $category['name'],
				'start_date' => $category['start_date'],
				'tuition' => $category['tuition'],
				'type' => $category['type'],
				'created_at' => now(),
				'updated_at' => now(),
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function update_category($category) {
		DB::table(self::$table)->where('id', $category['id'])
			->update([
					'name' => $category['name'],
					'start_date' => $category['start_date'],
					'tuition' => $category['tuition'],
					'type' => $category['type'],
					'updated_at' => now(),
				]
			);

		return TRUE;
	}

	public static function delete_category($id) {
		DB::table(self::$table)->where('id', $id)->update([
			'deleted' => 1
		]);

		return TRUE;
	}

	public static function get_activities($filter) {
		$query = DB::table('tbl_activity AS t1')
			->leftjoin('tbl_assessment AS t2', 't1.assessment_id', '=', 't2.id')
			->leftjoin('tbl_user AS t3', 't3.id', '=', 't2.user_id')
			->leftjoin('tbl_admission AS t4', 't4.assessment_id', '=', 't1.assessment_id')
			->leftjoin(self::$table.' AS t5', 't4.university_id', '=', 't5.id')
			->select('t1.id', 't1.assessment_id', 't2.first_name', 't2.last_name', 't5.name AS university_name', 't5.start_date', 't5.tuition', 't5.type', 't1.created_at', 't3.name AS user_name');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_activities($filter, $query);
		}

		$list = parent::paginate($filter, $query);
		return $list;
	}

	public static function conditions_for_activities($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('name', 'like', '%' . $filter['name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted'])
							->where('t1.activity_type', '=', '1')
							->where('t1.status', '=', '0');
		}
		return $query;
	}

}
