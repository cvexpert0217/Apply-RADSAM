<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Assessment;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\University;

class UniversityController extends Controller
{
	// category
    public function get_categories(Request $req) {
	    $filter = $req->input();
		$filter['deleted'] = 0;
	    $filter = $this->set_pageinfo($filter);

	    $categories = University::get_categories($filter);

	    $data['filter'] = $filter;
	    $data['categories'] = $categories;

	    return view('admin.university.category', $data);
    }

    public function get_category(Request $req) {
		if ($req->has('id') && !empty($req->input('id'))) {
			$category = University::get_category($req->input('id'));
			$data['category'] = $category;
		} else {
			$data['category'] = NULL;
		}

		return response()->json($data);
    }

    public function save_category(Request $req){
		if (!$req->has(['id', 'name', 'start_date', 'tuition', 'type'])) {
			return response()->json(['result' => 'invalid']);
		}

	    $category = $req->only(['id', 'name', 'start_date', 'tuition', 'type']);
		if (empty($category['id'])) {
			University::insert_category($category);
		} else {
			University::update_category($category);
		}

        return response()->json(['result' => 'success']);
    }

    public function delete_category(Request $req){
		if (!$req->has('id') || empty($req->input('id'))) {
			return response()->json(['result' => 'invalid']);
		}

		$id = $req->input('id');

		University::delete_category($id);

		return response()->json(['result' => 'success']);
    }

    // list
	public function get_list(Request $request) {
		$filter = $request->input();
		$filter['deleted'] = 0;
		$filter = $this->set_pageinfo($filter);

		$activities = University::get_activities($filter);

		$data['filter'] = $filter;
		$data['activities'] = $activities;

		return view('admin.university.list', $data);
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

	public function accept(Request $request){
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