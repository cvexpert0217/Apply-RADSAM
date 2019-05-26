<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admission;
use App\Models\MessageUser;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function policyVisa(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $data['activity_id'] = $activity_id;
        return view('user.policy_visa', $data);
    }

    public function policyStudy(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $university_id = $request->keys()[0];
        $data['activity_id'] = $activity_id;
        $data['university_id'] = $university_id;
        return view('user.policy_study', $data);
    }

    public function register(Request $request) {
        $data = $request->all();
        if ($request->has('assessment_id')) {
            $activity['assessment_id'] = $data['assessment_id'];
            $activity['activity_type'] = 0;
            $activity['status'] = 0;

            if (Activity::insert($activity)) {
                // register admission
                $admission['assessment_id'] = $data['assessment_id'];

                Admission::insert($admission);
                // end register admission

                return array('success' => 1);
            } else {
                return array('success' => 0);
            }

        } else {
            $activity_id = $data['activity_id'];
            $university_id = $data['university_id'];
            $activity_study['activity_id'] = $activity_id;
            $activity_study['activity_type'] = 1;
            if (Activity::update($activity_study)){
                $activity_one = Activity::get_one($activity_id);
                $admission['assessment_id'] = $activity_one->assessment_id;
                $admission['university_id'] = $university_id;
                $admission['fee_price'] = "";
                $admission['docs_names'] = "";
                if (Admission::updateUniversityByAssessment($admission)) {
                    MessageUser::deleteByActivity($activity_id);
                    return array('success' => 1);
                } else
                    return array('success' => 0);

            } else {
                return array('success' => 0);
            }
        }
    }
}
