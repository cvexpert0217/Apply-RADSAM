<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Assessment;
use Illuminate\Http\Request;

class UniversityController extends Controller
{
    public function index(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $assessment = Activity::get_assessment($activity_id);
        $assessment_id = $assessment->assessment_id;
        $assessment_type = $assessment->assessment_type;
        if ($assessment_type == 0) {
            $url = '/policy/visa/'.$activity_id;
            return redirect($url);
        } else {
            $allow_university_list = Assessment::get_university_list($assessment_id);
            $data['universities'] = $allow_university_list;
            $data['activity_id'] = $activity_id;
            return view('user.university', $data);
        }
    }
}
