<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class Base
{

	protected static function paginate($params, $query) {
		$totalCount = $query->count();
		$currentPage = $params['currentPage'] ? : 1;
		$perPage = $params['perPage'] ? : 10;
		$skip = $perPage * ($currentPage - 1);
		if ($totalCount <= $skip) {
			$currentPage = 1;
			$skip = 0;
		}
		$query = $query->take($perPage)->skip($skip);

		$rows = $query->get()->toArray();
		$paginator = new LengthAwarePaginator($rows, $totalCount, $perPage, $currentPage);

		return $paginator;
	}

}
