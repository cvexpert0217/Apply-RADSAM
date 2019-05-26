<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Models\University;
use App\Models\Assessment;
use App\Models\Activity;
use App\Http\Controllers\Controller;

class AssessmentController extends Controller
{
	const BASE_PATH = "upload_data/";

	// category
    public function get_categories(Request $req) {
	    $filter = $req->input();
		$filter['deleted'] = 0;
	    $filter = $this->set_pageinfo($filter);

	    $categories = Assessment::get_categories($filter);

	    $data['filter'] = $filter;
	    $data['categories'] = $categories;

	    return view('admin.assessment.category', $data);
    }

    public function get_category($id) {
		if ($id != 0) {
			$category = Assessment::get_category($id);
			$data['category'] = $category;
		} else {
			$data['category'] = NULL;
		}

		$data['country_list'] = Assessment::get_country_list();

		return view('admin.assessment.assessment_edit', $data);
    }

	public function get_detail($id) {
		if ($id != 0) {
			$category = Assessment::get_category($id);
			$data['category'] = $category;
		} else {
			$data['category'] = NULL;
		}

		$data['country_list'] = Assessment::get_country_list();

		return view('admin.assessment.assessment_detail', $data);
	}

    public function save_category(Request $request){
    	$category = $request->all();

		if (empty($category['id'])) {
			return view('admin.assessment.assessment_edit', $category);
		}

	    if ($request->hasFile('resume_filename')){
		    $destinationPath = self::BASE_PATH . $category['first_name'] . " " . $category['last_name'] . "/";
		    $filename = $category['changed_filename'];
		    if ($filename) {
			    $upload_success = $category['resume_filename']->move($destinationPath, $filename);
			    $category['resume_filename'] = $filename;
		    }
	    } else {
		    $category['resume_filename'] = $category['changed_filename'];
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

	    $category['requested_services'] = $requested_services;
		Assessment::update_category($category);

	    $filter['deleted'] = 0;
	    $filter = $this->set_pageinfo($filter);

	    $categories = Assessment::get_categories($filter);

	    $data['filter'] = $filter;
	    $data['categories'] = $categories;

	    return view('admin.assessment.category', $data);
    }

    public function delete_category(Request $req){
		if (!$req->has('id') || empty($req->input('id'))) {
			return response()->json(['result' => 'invalid']);
		}

		$id = $req->input('id');
		Assessment::delete_category($id);

		return response()->json(['result' => 'success']);
    }

	public function edit_category(Request $req){
		if (!$req->has('id') || empty($req->input('id'))) {
			return response()->json(['result' => 'invalid']);
		}

		$id = $req->input('id');
		Assessment::delete_category($id);

		return response()->json(['result' => 'success']);
	}

	// list
	public function get_list(Request $request) {
		$filter = $request->input();
		$filter['activity_type'] = 0;
		$filter['status'] = 0;
		$filter['deleted'] = 0;
		$filter = $this->set_pageinfo($filter);

		$list = Assessment::get_list($filter);

		$data['filter'] = $filter;
		$data['list'] = $list;

    	return view('admin.assessment.list', $data);
	}

	public function get_one(Request $request) {
		if (!$request->has('activity_id') || empty($request->input('activity_id'))) {
			return json_encode(['result' => 'invalid']);
		}

		$activity_id = $request->input('activity_id');
		$activity = Activity::get_one_with_assement($activity_id);

		if ($activity == NULL) {
			return json_encode(['result' => 'invalid']);
		}
		$data = [
			'result' => 'success',
			'activity' => $activity
		];
    	return json_encode($data);
	}

	public function get_universities(Request $req) {
		$filter = $req->input();
		$filter['deleted'] = 0;

		$universities = University::get_categories($filter, FALSE);
		$data['universities'] = $universities;

		return response()->json($data);
	}

	public function accept(Request $request) {
		$filter = $request->input();

		// update activity
		$status = 1;
		Payment::update2activity($filter['activity_id'], $status);

		// insert to tbl_allocated_university
		$activity = Activity::get_one($filter['activity_id']);
		$assessment_id = $activity->assessment_id;

		$university_ids = $filter['university'];
		foreach ($university_ids as $university_id) {
			$university['assessment_id'] = $assessment_id;
			$university['university_id'] = $university_id;
			Assessment::allocate_university($university);
		}

		// send message to user
		if (isset($filter['msg_title']) && isset($filter['msg_content'])) {
			Payment::insert2msg($filter);
		}

		return response()->json(['result' => 'success']);
	}

	public function reject(Request $request) {
    	$filter = $request->input();

    	// update tbl_activity
		$status = 2;
		Payment::update2activity($filter['activity_id'], $status);

		// insert to tbl_message
		if (isset($filter['msg_title']) && isset($filter['msg_content'])) {
			Payment::insert2msg($filter);
		}

    	return response()->json(['result' => 'success']);
	}

	public function accept_visa(Request $request){
		$filter = $request->input();

		$activity = Activity::get_one($filter['activity_id']);
		$assessment_id = $activity->assessment_id;
		$filter['assessment_id'] = $assessment_id;

		// insert to tbl_transaction
		$transaction_id = Transaction::insert($filter);

		// insert to tbl_allocated_fee
		$fee_list['transaction_id'] = $transaction_id;
		$count = count($filter['fee_name']);
		for ($i = 0; $i<$count; $i++) {
			$fee_list['fee_name'] = $filter['fee_name'][$i];
			$fee_list['price'] = $filter['price'][$i];
			$fee_list['quantity'] = $filter['quantity'][$i];

			Assessment::allocate_fee($fee_list);
		}

		// update tbl_activity
		$status = 1;
		Payment::update2activity($filter['activity_id'], $status);

		// insert to tbl_message_user
		if (isset($filter['msg_title']) && isset($filter['msg_content'])) {
			Payment::insert2msg($filter);
		}

		return response()->json(['result' => 'success']);
	}
}