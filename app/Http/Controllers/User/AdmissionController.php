<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admission;
use App\Models\MessageUser;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    const BASE_PATH = "upload_data/";
    public function index(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $assessment = Activity::get_assessment($activity_id);
        // $destinationPath = self::BASE_PATH . $assessment->first_name . " " . $assessment->last_name . "/";
        $destinationPath = self::BASE_PATH;
        $admission = Admission::get_one_by_assessment($assessment->assessment_id);
        $file_url = $destinationPath . $admission->admission_realimage;
        $admission_text = $admission->admission_text;
        $data['activity_id'] = $activity_id;
        $data['file_url'] = $file_url;
        $data['message'] = $admission_text;
        return view('user.admission', $data);
    }

    public function confirm(Request $request) {
        $data = $request->all();
        $activity_id = $data['activity_id'];
        Activity::delete($activity_id);
        MessageUser::deleteByActivity($activity_id);
        return redirect('/');
    }
}
