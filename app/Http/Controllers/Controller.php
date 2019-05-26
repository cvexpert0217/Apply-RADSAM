<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	protected function set_pageinfo($params) {
		if (!isset($params)) {
			$params = array();
		}
		if (empty($params['perPage'])) {
			$params['perPage'] = 10;
		}
		if (empty($params['currentPage'])) {
			$params['currentPage'] = 1;
		}
		return $params;
	}

}
