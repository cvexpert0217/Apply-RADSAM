<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Assessment;
use App\Models\Activity;
use App\Models\Admission;

class AssessmentController extends Controller
{
    const BASE_PATH = "upload_data/";
    public function register(Request $request)
    {
        //register assessment
        $data = $request->all();
        if ($request->hasFile('resume_filename')){
            $destinationPath = self::BASE_PATH . $data['first_name'] . " " . $data['last_name'] . "/";
            $filename = $data['file_name'];
            $upload_success = $data['resume_filename']->move($destinationPath, $filename);
            $data['resume_filename'] = $filename;
        } else {
            $data['resume_filename'] = "";
        }
        $requested_services = "";

        if ($request->exists('educational_consultation') == "1")
            $requested_services .= "1";
        else
            $requested_services .= "0";

        if ($request->exists('apply_admission') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('credential') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('apply_fund') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('apply_accommodations') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('apply_insurance') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('help_permits') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('travel_consultation') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('airport_transfer') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('help_registration') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('help_bank') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        if ($request->exists('help_driving') == "1")
            $requested_services .= ",1";
        else
            $requested_services .= ",0";

        $data['requested_services'] = $requested_services;
        $data['user_id'] = $request->session()->get(config('radasm.session.user'))->id;

        Assessment::insert($data);
        //end register assessment

        $last_one = DB::select("select MAX(id) as assessment_id from tbl_assessment t1");
        $last_id = 0;
        if (count($last_one) > 0)
            $last_id = $last_one[0]->assessment_id;
        $last_one = Assessment::get_one($last_id);

        $activity = [];
        $activity['assessment_id'] = $last_id;
        $activity['activity_type'] = 0;
        $activity['status'] = 0;

        if ($last_one->assessment_type==1)  // case Study.
        {
            Activity::insert($activity);

            // register admission
            $admission = [];
            $admission['assessment_id'] = $last_id;

            Admission::insert($admission);
            // end register admission

            return redirect('/');
        }
        else    // case Visa.
        {
            return redirect('policy/visa/'.$last_id);
        }
    }
}