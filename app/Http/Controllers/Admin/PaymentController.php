<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Payment;

class PaymentController extends Controller
{

	public function get_list(Request $request) {
		$filter = $request->input();
		$filter = $this->set_pageinfo($filter);

		$activities = Payment::get_activities($filter);

		$data['filter'] = $filter;
		$data['activities'] = $activities;
		return view('admin.payment.list', $data);
	}

	public function accept(Request $request) {
		$filter = $request->input();

		$_size = 0;
		$type_name = '';
		if ($filter['doc_type'] == 0) {
			$_size = 19;
			$type_name = 'university_';
		} else if ($filter['doc_type'] == 1) {
			$_size = 19;
			$type_name = 'college_';
		} else if ($filter['doc_type'] == 2) {
			$_size = 17;
			$type_name = 'school_';
		} else if ($filter['doc_type'] == 3) {
			$_size = 14;
			$type_name = 'visa_';
		}

		for ($i=0; $i<$_size; $i++) {
			if (isset($filter[$type_name.$i]) && $filter[$type_name.$i] == 1) {
				$filter['doc_req_id'] = $i;
				Payment::insert2docs($filter);
			}
		}

		$status = 1;
		Payment::update2activity($filter['activity_id'], $status);

		if (isset($filter['msg_title']) && isset($filter['msg_content'])) {
			Payment::insert2msg($filter);
		}

		return response()->json(['result' => 'success']);
	}

	public function reject(Request $request) {
		$filter = $request->input();

		$status = 2;
		Payment::update2activity($filter['activity_id'], $status);

		if (isset($filter['inputMsgTitle']) && isset($filter['inputMsgContent'])) {
			Payment::insert2msg($filter);
		}

		return response()->json(['result' => 'success']);
	}
}
