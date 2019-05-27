<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Admission extends Base
{
    protected static $table = "tbl_admission";

    public static function insert($admission) {
        DB::table(self::$table)->insert(
            [
                'assessment_id' => $admission['assessment_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return TRUE;
    }

    public static function get_activities($filter) {
    	$filter['deleted'] = '0';
        $query = DB::table(self::$table . ' AS t1')
	        ->leftjoin('tbl_assessment AS t2', 't1.assessment_id', '=', 't2.id')
	        ->leftjoin('tbl_user AS t3', 't3.id', '=', 't2.user_id')
	        ->leftjoin('tbl_university As t4', 't1.university_id', '=', 't4.id')
            ->select('t1.id', 't1.assessment_id', 't2.first_name', 't2.last_name', 't2.assessment_type', 't4.name AS university_name', 't1.fee_price', 't1.docs_name', 't1.updated_at', 't3.name AS user_name')
            //->where('t1.admission_text', '!=', NULL)
	        ->orderBy('t1.updated_at', 'DESC');

        $admissions = parent::paginate($filter, $query);
        return $admissions;
    }

    public static function get_one($value, $field = 'id') {
        $admission = DB::table(self::$table)->where($field, $value)->first();

        return $admission;
    }

    public static function get_one_by_assessment($value, $field = 'assessment_id') {
        $admission = DB::table(self::$table)->where($field, $value)->first();

        return $admission;
    }

    public static function updateUniversityByAssessment($admission) {
        DB::table(self::$table)->where('assessment_id', $admission['assessment_id'])
            ->update([
                    'university_id' => $admission['university_id'],
                    'updated_at' => now()
                ]
            );

        return TRUE;
    }

    public static function updateAdmission($filter) {
	    DB::table('tbl_admission')->where('assessment_id', $filter['assessment_id'])
		    ->update([
				    'admission_image' => $filter['image_name'],
				    'admission_realimage' => $filter['image_realname'],
				    'admission_text' => $filter['admission_msg'],
				    'updated_at' => now(),
			    ]
		    );

	    return TRUE;
    }

    public static function updateFeeByAssessment($admission) {
        DB::table(self::$table)->where('assessment_id', $admission['assessment_id'])
            ->update([
                    'fee_price' => $admission['fee_price'],
                    'updated_at' => now()
                ]
            );

        return TRUE;
    }

    public static function updateDocsNameByAssessment($admission) {
        DB::table(self::$table)->where('assessment_id', $admission['assessment_id'])
            ->update([
                    'docs_name' => $admission['docs_name'],
                    'updated_at' => now()
                ]
            );

        return TRUE;
    }
}
