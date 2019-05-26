<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Admission;

class AdmissionController extends Controller
{
	public function get_list(Request $request) {
		$filter = $request->input();
		$filter = $this->set_pageinfo($filter);

		$admissions = Admission::get_activities($filter);

		$data['filter'] = $filter;
		$data['admissions'] = $admissions;
		return view('admin.admission.list', $data);
	}
}
