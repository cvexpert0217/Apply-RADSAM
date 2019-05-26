<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\Base;

class Assessment extends Base
{
    protected static $table = "tbl_assessment";

    // admin
	public static function get_category($value, $field = 'id') {
		$category = DB::table(self::$table)->where($field, $value)->first();

		return $category;
	}

	public static function get_categories($filter) {
		//"select t1.*, t2.name as user_name from tbl_assessment t1 left join tbl_user t2 on t1.user_id = t2.id where t1.deleted = 0"
		$query = DB::table(self::$table.' AS t1')
			->leftjoin('tbl_user AS t2', 't1.user_id', '=', 't2.id')
			->select('t1.*', 't2.name AS user_name');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_category($filter, $query);
		}

		$categories = parent::paginate($filter, $query);
		return $categories;
	}

	public static function conditions_for_category($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('first_name', 'like', '%' . $filter['first_name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted']);
		}
		return $query;
	}

	public static function update_category($category) {
		DB::table(self::$table)->where('id', $category['id'])
			->update([
					'first_name' => $category['first_name'],
					'last_name' => $category['last_name'],
					'mobile_phone' => $category['mobile_phone'],
					'email' => $category['email'],
					'gender' => $category['gender'],
					'birthday' => $category['birthday'],
					'married_status' => $category['married_status'],
					'skype_id' => $category['skype_id'],
					'instagram_id' => $category['instagram_id'],
					'citizenship' => $category['citizenship'],
					'street_address' => $category['street_address'],
					'address_line2' => $category['address_line2'],
					'city' => $category['city'],
					'state_province_region' => $category['state_province_region'],
					'zip_postal_code' => $category['zip_postal_code'],
					'country' => $category['country'],
					'passport_expire_date' => $category['passport_expire_date'],
					'education_level' => $category['education_level'],
					'university' => $category['university'],
					'major' => $category['major'],
					'from' => $category['from'],
					'to' => $category['to'],
					'gpa_score' => $category['gpa_score'],
					'english_proficiency' => $category['english_proficiency'],
					'indicate' => $category['indicate'],
					'french_proficiency' => $category['french_proficiency'],
					'latest_job_title' => $category['latest_job_title'],
					'work_experience_years' => $category['work_experience_years'],
					'applid' => $category['applid'],
					'requested_services' => $category['requested_services'],
					'annual_budget' => $category['annual_budget'],
					'our_job' => $category['our_job'],
					'agent_name' => $category['agent_name'],
					'resume_filename' => $category['resume_filename'],
					'assessment_type' => $category['assessment_type'],
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

	// list
	public static function get_list($filter) {
		//"SELECT * FROM tbl_activity t1 LEFT JOIN tbl_assessment t2 ON t1.assessment_id = t2.id
		//WHERE t1.deleted = 0 AND t1.activity_type = 0 AND t1.`status` = 0"
		$query = DB::table('tbl_activity AS t1')
			->leftjoin(self::$table.' AS t2', 't1.assessment_id', '=', 't2.id')
			->leftjoin('tbl_user AS t3', 't3.id', '=', 't2.user_id')
			->select('t1.*', 't2.first_name', 't2.last_name', 't2.assessment_type', 't3.name AS user_name');
		if (isset($filter) && !blank($filter)) {
			$query = self::conditions_for_list($filter, $query);
		}

		$list = parent::paginate($filter, $query);
		return $list;
	}

	public static function conditions_for_list($filter, $query) {
		if (isset($filter['name']) && filled($filter['name'])) {
			$query = $query->where('first_name', 'like', '%' . $filter['first_name'] . '%');
		}
		if (isset($filter['deleted'])) {
			$query = $query->where('t1.deleted', '=', $filter['deleted']);
		}
		if (isset($filter['activity_type'])) {
			$query = $query->where('t1.activity_type', '=', $filter['activity_type']);
		}
		if (isset($filter['status'])) {
			$query = $query->where('t1.status', '=', $filter['status']);
		}
		return $query;
	}

	// user
	public static function insert($assessment) {
		DB::table(self::$table)->insert(
			[
				'first_name' => $assessment['first_name'],
				'last_name' => $assessment['last_name'],
				'mobile_phone' => $assessment['mobile_phone'],
				'email' => $assessment['email'],
				'gender' => $assessment['gender'],
                'birthday' => $assessment['birthday'],
                'married_status' => $assessment['married_status'],
                'skype_id' => $assessment['skype_id'],
                'instagram_id' => $assessment['instagram_id'],
                'citizenship' => $assessment['citizenship'],
                'street_address' => $assessment['street_address'],
                'address_line2' => $assessment['address_line2'],
                'city' => $assessment['city'],
                'state_province_region' => $assessment['state_province_region'],
                'zip_postal_code' => $assessment['zip_postal_code'],
                'country' => $assessment['country'],
                'passport_expire_date' => $assessment['passport_expire_date'],
                'education_level' => $assessment['education_level'],
                'university' => $assessment['university'],
                'major' => $assessment['major'],
                'from' => $assessment['from'],
                'to' => $assessment['to'],
                'gpa_score' => $assessment['gpa_score'],
                'english_proficiency' => $assessment['english_proficiency'],
                'indicate' => $assessment['indicate'],
                'french_proficiency' => $assessment['french_proficiency'],
                'latest_job_title' => $assessment['latest_job_title'],
                'work_experience_years' => $assessment['work_experience_years'],
                'applid' => $assessment['applid'],
                'requested_services' => $assessment['requested_services'],
                'annual_budget' => $assessment['annual_budget'],
                'our_job' => $assessment['our_job'],
                'agent_name' => $assessment['agent_name'],
                'resume_filename' => $assessment['resume_filename'],
                'assessment_type' => $assessment['assessment_type'],
                'user_id' => $assessment['user_id'],
				'created_at' => now(),
                'updated_at' => now(),
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function get_university_list($value) {
        $university_list = DB::table(self::$table.' AS assessment')
            ->select('assessment.*', 'university.id AS university_id', 'university.name AS university_name',
                'university.tuition', 'university.start_date', 'university.type AS university_type')
            ->leftjoin('tbl_allocated_university AS allowUniversity', 'assessment.id', '=', 'allowUniversity.assessment_id')
            ->leftjoin('tbl_university AS university', 'university.id', '=', 'allowUniversity.university_id')
            ->where('assessment.id', '=', $value)
            ->get()
            ->toArray();

        return $university_list;
    }

	public static function update($assessment) {
		DB::table(self::$table)->where('id', $assessment['id'])
			->update([
					'' => $assessment[''],

				]
			);

		return TRUE;
	}

	public static function get_one($value, $field = 'id') {
        $activity = DB::table(self::$table)->where($field, $value)->first();

        return $activity;
    }

	public static function allocate_university($university) {
		DB::table('tbl_allocated_university')->insert(
			[
				'assessment_id' => $university['assessment_id'],
				'university_id' => $university['university_id'],
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function allocate_fee($fee_list) {
		DB::table('tbl_allocated_fee')->insert(
			[
				'transaction_id' => $fee_list['transaction_id'],
				'fee_name' => $fee_list['fee_name'],
				'price' => $fee_list['price'],
				'quantity' => $fee_list['quantity'],
				'deleted' => 0,
			]
		);

		return TRUE;
	}

	public static function setHST($id, $hst) {
		DB::table(self::$table)->where('id', $id)
			->update([
					'hst' => $hst,
					'updated_at' => now(),
				]
			);

		return TRUE;
	}

	public static function get_country_list() {
        $country_list = [];
        $lines = file('http://pastebin.com/raw.php?i=943PQQ0n');
        $lineNo = 0;
        $startLine = 4;
        $endLine = 246;
        // Loop through our array, show HTML source as HTML source; and line numbers too.
        foreach ($lines as $line_num => $line) {
            $lineNo++;
            if ($lineNo >= $startLine) {
                $country = explode('   ', trim(htmlspecialchars($line)));
                if (!isset($country[0]) || !isset($country[1])) {
                    continue;
                }

                $country_list[$line_num] = $country[1];
            }
            if ($lineNo == $endLine) {
                break;
            }
        }

        return $country_list;
	}
}
