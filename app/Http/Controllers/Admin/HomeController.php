<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageAdmin;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input();
        $filter = $this->set_pageinfo($filter);
        $transactions = Transaction::get_recent_list($filter);
        $filter['perPage'] = 3;
        $messages = MessageAdmin::get_recent_list($filter);
        $data['transactions'] = $transactions;
        $data['messages'] = $messages;
        return view('admin.index', $data);
    }

}