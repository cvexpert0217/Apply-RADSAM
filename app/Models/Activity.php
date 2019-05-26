<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Activity extends Base
{
    protected static $table = "tbl_activity";

    public static function get_one($value, $field = 'id') {
        $activity = DB::table(self::$table)->where($field, $value)->first();

        return $activity;
    }

    public static function get_list($filter) {
        $query = DB::table(self::$table . ' AS activity')
            ->select('*');
        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $activities = parent::paginate($filter, $query);

        return $activities;
    }

    public static function get_assessment($activity_id) {
        $assessment = DB::table(self::$table . ' AS activity')
            ->select('activity.*', 'assessment.assessment_type', 'assessment.first_name', 'assessment.last_name')
            ->leftjoin('tbl_assessment AS assessment', 'assessment.id', '=','activity.assessment_id')
            ->where('activity.id', '=', $activity_id)
			->where('activity.deleted', '=', 0)
            ->get()
            ->first();

        return $assessment;
    }

    public static function get_one_with_assement($activity_id) {
        $assessment = DB::table(self::$table . ' AS activity')
			->join('tbl_assessment AS assessment', 'assessment.id', '=', 'activity.assessment_id')
            ->select('activity.*', 'assessment.assessment_type', 'assessment.first_name', 'assessment.last_name')
            ->where('activity.id', '=', $activity_id)
            ->get()
            ->first();

        return $assessment;
    }

    public static function get_recent_list($filter) {
        $query = DB::table(self::$table . ' AS activity')
            ->select('activity.*', 'assessment.first_name', 'assessment.last_name')
            ->leftjoin('tbl_assessment AS assessment', 'assessment.id', '=','activity.assessment_id')
            ->where('activity.deleted','=', 0)
            ->orderBy('activity.updated_at', 'DESC');

        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $activities = parent::paginate($filter, $query);

        return $activities;
    }

    public static function conditions($filter, $query) {
        if (isset($filter['name']) && filled($filter['name'])) {
            $query = $query->where('name', 'like', '%' . $filter['name'] . '%');
        }
        return $query;
    }

    public static function insert($activity) {
        DB::table(self::$table)->insert(
            [
                'assessment_id' => $activity['assessment_id'],
                'activity_type' => $activity['activity_type'],
                'status' => $activity['status'],
                'created_at' => now(),
                'updated_at' => now(),
                'deleted' => 0,
            ]
        );

        return TRUE;
    }

    public static function update($activity) {
        DB::table(self::$table)->where('id', $activity['activity_id'])
            ->update([
                    'status' => 0,
                    'activity_type' => $activity['activity_type'],
                    'updated_at' => now()
                ]
            );

        return TRUE;
    }

    public static function delete($id) {
        DB::table(self::$table)->where('id', $id)->update([
            'deleted' => 1
        ]);

        return TRUE;
    }

    public static function get_doc_list($activity_id) {
        $docs = DB::table(self::$table . ' AS activity')
            ->select('activity.*', 'allow_docs.id AS doc_id', 'allow_docs.docs_type', 'allow_docs.docs_req_id')
            ->leftjoin('tbl_allocated_docs AS allow_docs', 'activity.assessment_id', '=','allow_docs.assessment_id')
            ->where('activity.id','=', $activity_id)
            ->get()
            ->toArray();

        return $docs;
    }
}
