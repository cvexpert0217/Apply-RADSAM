<?php

namespace App\Http\Controllers\Admin;

use App\Models\Activity;
use App\Models\Admission;
use App\Models\Assessment;
use App\Models\Payment;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\Upload;

class UploadController extends Controller
{
	public function get_list(Request $request) {
		$filter = $request->input();
		$filter = $this->set_pageinfo($filter);

		$activities = Upload::get_activities($filter);

		$data['filter'] = $filter;
		$data['activities'] = $activities;
		return view('admin.upload.list', $data);
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

	public function accept(Request $request) {
		$filter = $request->input();

		// update tbl_activity
		$status = 1;
		Payment::update2activity($filter['activity_id'], $status);

		// insert to tbl_message
		if (isset($filter['msg_title']) && isset($filter['msg_content'])) {
			Payment::insert2msg($filter);
		}

		// update tbl_admission
		$activity = Activity::get_one($filter['activity_id']);
		$filter['assessment_id'] = $activity->assessment_id;

		// upload image
		$assessment = Activity::get_assessment($activity->id);
		$destPath = 'upload_data'. "/";
		$file = $request->file('image_name');
		$fileName = now()->timestamp .'.'. $file->extension();
		$file->move($destPath, $fileName);

		$filter['image_name'] = $file->getClientOriginalName();
		$filter['image_realname'] = $fileName;
		Admission::updateAdmission($filter);

		return response()->json(['result' => 'success']);
	}

	public function detail(Request $request) {
		$assessment_id = $request->input("assessment_id");

		$docs_list = Upload::get_docs($assessment_id);

		$name_dir = asset('upload_data');

		$data = [
			'result' => 'success',
			'docs_list' => $docs_list,
			'name_dir' => $name_dir
		];
		return json_encode($data);
	}
}
