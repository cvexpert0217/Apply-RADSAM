<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class Transaction extends Base
{
    protected static $table = "tbl_transaction";

    public static function get_one($value, $field = 'id') {
        $transaction = DB::table(self::$table)->where($field, $value)->first();

        return $transaction;
    }

    public static function get_one_by_assessment($value, $field = 'assessment_id') {
        $transaction = DB::table(self::$table)->where($field, $value)->first();

        return $transaction;
    }

    public static function get_fee_list($id) {
        $fees = DB::table('tbl_allocated_fee AS allow_fee')
            ->select('*')
            ->where('allow_fee.transaction_id','=', $id)
            ->get()
            ->toArray();

        return $fees;
    }

    public static function get_list($filter) {
        $query = DB::table(self::$table . ' AS transaction')
            ->select('*');
        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $transactions = parent::paginate($filter, $query);

        return $transactions;
    }

    public static function get_recent_list($filter) {
        $query = DB::table(self::$table . ' AS transaction')
            ->select('transaction.*', 'assessment.first_name', 'assessment.last_name', 'assessment.assessment_type', 'user.name AS worker')
            ->leftjoin('tbl_assessment AS assessment', 'assessment.id', '=','transaction.assessment_id')
            ->leftjoin('tbl_user AS user', 'user.id', '=','assessment.user_id')
            ->where('transaction.deleted','=', 0)
            ->where('transaction.pay_image','!=', null)
            ->where('transaction.pay_type','!=', null)
            ->orderBy('transaction.updated_at', 'DESC');

        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $transactions = parent::paginate($filter, $query);

        return $transactions;
    }
    
    public static function conditions($filter, $query) {
        if (isset($filter['name']) && filled($filter['name'])) {
            $query = $query->where('name', 'like', '%' . $filter['name'] . '%');
        }
        return $query;
    }

    public static function insert($filter) {
        DB::table(self::$table)->insert(
            [
                'assessment_id' => $filter['assessment_id'],
                'hst' => $filter['hst'],
                'pay_account' => $filter['pay_account'],
                'pay_price' => $filter['pay_price'],
                'created_at' => now(),
	            'updated_at' => now(),
                'deleted' => 0,
            ]
        );

        $lastId = DB::table(self::$table)->select('id')->orderBy('id', 'DESC')->first()->id;
        return $lastId;
    }

    public static function update($transaction) {
        DB::table(self::$table)->where('id', $transaction['id'])
            ->update([
                    '' => $transaction[''],

                ]
            );

        return TRUE;
    }

    public static function update_by_assessment($transaction) {
        DB::table(self::$table)->where('assessment_id', $transaction['assessment_id'])
            ->update([
                    'pay_image' => $transaction['pay_image'],
                    'pay_realimage' => $transaction['pay_realimage'],
                    'pay_type' => $transaction['pay_type'],
                    'updated_at' => now(),
                ]
            );

        return TRUE;
    }
}
