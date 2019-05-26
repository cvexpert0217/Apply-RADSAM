<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admission;
use App\Models\MessageUser;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    const BASE_PATH = "upload_data/";
    public function index(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $allow_doc_list = Activity::get_doc_list($activity_id);
        $data['activity_id'] = $activity_id;
        $data['docs'] = $allow_doc_list;
        return view('user.upload', $data);
    }

    public function register(Request $request) {
        $data = $request->all();
        $activity_id = $data['activity_id'];
        $assessment = Activity::get_assessment($activity_id);
        $assessment_id = $assessment->assessment_id;
        $destinationPath = self::BASE_PATH . $assessment->first_name . " " . $assessment->last_name . "/";
        $file_names = "";
        foreach ($request->allFiles() as $file) {
            $filename = $file->getClientOriginalName();

            $file_names = $file_names . $filename . ", ";
            $file->move($destinationPath, $filename);
        }

        $docs_name = $file_names==""?"":substr($file_names, 0, strlen($file_names)-2);
        $activity['activity_id'] = $activity_id;
        $activity['activity_type'] = 3;
        if (Activity::update($activity)){
            $admission['assessment_id'] = $assessment_id;
            $admission['docs_name'] = $docs_name;
            if (Admission::updateDocsNameByAssessment($admission)) {
                MessageUser::deleteByActivity($activity_id);
                return redirect('/');
            } else
                return array('success' => 'false');
        } else {
            return array('success' => 'false');
        }
    }

    public function storeDocName(Request $request) {
        $data = $request->all();
        Upload::insertDoc($data);
    }
}
