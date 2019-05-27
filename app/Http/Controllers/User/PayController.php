<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Admission;
use App\Models\Assessment;
use App\Models\MessageUser;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PayController extends Controller
{
    const BASE_PATH = "upload_data/";
    public function index(Request $request)
    {
        $activity_id = $request->route('activity_id');
        $activity = Activity::get_one($activity_id);
        $assessment_id = $activity->assessment_id;
        $transaction = Transaction::get_one_by_assessment($assessment_id);
        $hst = $transaction->hst;
        $pay_price = $transaction->pay_price;
        $pay_account = $transaction->pay_account;
        $allow_fee_list = Transaction::get_fee_list($transaction->id);

        $total_out_hst = 0;
        foreach ($allow_fee_list as $allow_fee){
            $total_out_hst += $allow_fee->price * $allow_fee->quantity;
        }

        $data['activity_id'] = $activity_id;
        $data['assessment_id'] = $assessment_id;
        $data['fees'] = $allow_fee_list;
        $data['total_out_hst'] = $total_out_hst;
        $data['total_in_hst'] = $pay_price;
        $data['hst'] = $hst;
        $data['pay_account'] = $pay_account;
        return view('user.pay', $data);
    }

    public function register(Request $request) {
        $data = $request->all();
        $activity_id = $data['activity_id'];
        $assessment_id = $data['assessment_id'];
        $pay_image = $data['pay_image'];
        list($name, $extension) = explode('.', $pay_image);
        $pay_realimage = Carbon::now()->timestamp . '.' . $extension;
        $pay_type = $data['pay_type'];
        $assessment = Assessment::get_one($assessment_id);

        if ($request->hasFile('pay_image_file')){
            // $destinationPath = self::BASE_PATH . $assessment->first_name . " " . $assessment->last_name . "/";
            $destinationPath = self::BASE_PATH;
            $upload_success = $data['pay_image_file']->move($destinationPath, $pay_realimage);
        } else {
            $pay_image = "";
            $pay_realimage = "";
        }

        // insert to tbl_transaction
        $transaction['assessment_id'] = $assessment_id;
        $transaction['pay_image'] = $pay_image;
        $transaction['pay_realimage'] = $pay_realimage;
        $transaction['pay_type'] = $pay_type;
        if (Transaction::update_by_assessment($transaction)) {
            // update to tbl_admission
            $admission['assessment_id'] = $assessment_id;
            $pay_price = Transaction::get_one_by_assessment($assessment_id)->pay_price;
            $admission['fee_price'] = $pay_price;
            if (Admission::updateFeeByAssessment($admission)) {
                // update to tbl_activity
                $activity['activity_id'] = $activity_id;
                $activity['activity_type'] = 2;
                if (Activity::update($activity)) {
                    MessageUser::deleteByActivity($activity_id);
                    return redirect('/');
                } else {
                     return array('success' => 'false', 'result' => 'update error in Activity');
                }

            } else {
                 return array('success' => 'false', 'result' => 'update error in Admission');
            }

        } else {
            return array('success' => 'false', 'result' => 'insert error in Transaction');
        }
    }
}
