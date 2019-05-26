<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinishController extends Controller
{
    public function index(Request $request)
    {
        $activity_id = $request->input();
    }
}
