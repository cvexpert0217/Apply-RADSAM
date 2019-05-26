<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Invoice;

class InvoiceController extends Controller
{

	public function get_list(Request $request) {
		$filter = $request->input();
		$filter = $this->set_pageinfo($filter);

		$invoices = Invoice::get_list($filter);

		$data['filter'] = $filter;
		$data['invoices'] = $invoices;
		return view('admin.invoice.list', $data);
	}

	public function detail(Request $request) {
		if ($request->has('id') && !empty($request->input('id'))) {
			$invoice = Invoice::detail($request->input('id'));
			$data['invoice'] = $invoice;
		} else {
			$data['invoice'] = NULL;
		}

		return response()->json($data);
	}

	public function reply(Request $request) {
		$filter = $request->input();

		// send message to user
		$invoice_admin = Invoice::get_one($filter['id']);
		$filter['activity_id'] = $invoice_admin->activity_id;

		Invoice::sendMsg($filter);

		// delete message from admin
		Invoice::deleteMsg($filter['id']);

		return response()->json(['result' => 'success']);
	}
}
