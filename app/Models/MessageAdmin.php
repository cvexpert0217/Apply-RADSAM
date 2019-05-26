<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class MessageAdmin extends Base
{
    protected static $table = "tbl_message_admin";

    public static function get_one($value, $field = 'id') {
        $message = DB::table(self::$table)->where($field, $value)->first();

        return $message;
    }

    public static function get_list($filter) {
        $query = DB::table(self::$table . ' AS message')
            ->select('*');
        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $messages = parent::paginate($filter, $query);

        return $messages;
    }

    public static function get_recent_list($filter) {
        $query = DB::table(self::$table . ' AS message')
            ->select('message.*', 'activity.activity_type', 'activity.status', 'assessment.first_name', 'assessment.last_name', 'assessment.assessment_type')
            ->leftjoin('tbl_activity AS activity', 'message.activity_id', '=', 'activity.id')
            ->leftjoin('tbl_assessment AS assessment', 'assessment.id', '=', 'activity.assessment_id')
            ->where('message.deleted','=', 0)
            ->orderBy('message.created_at', 'DESC');

        if (isset($filter) && !blank($filter)) {
            $query = self::conditions($filter, $query);
        }

        $messages = parent::paginate($filter, $query);

        return $messages;
    }

    public static function get_recent_count() {
        $count = DB::table(self::$table . ' AS message')
            ->select('Count(id)')
            ->where('isBrowsed', '=', 0)
            ->count();

        return $count;
    }

    public static function conditions($filter, $query) {
        if (isset($filter['name']) && filled($filter['name'])) {
            $query = $query->where('name', 'like', '%' . $filter['name'] . '%');
        }
        return $query;
    }

    public static function insert($message) {
        DB::table(self::$table)->insert(
            [
                'activity_id' => $message['activity_id'],
                'user_message_id' => $message['user_message_id'],
                'msg_title' => $message['msg_title'],
                'msg_content' => $message['msg_content'],
                'created_at' => now(),
                'deleted' => 0,
            ]
        );

        return TRUE;
    }

    public static function update($message) {
        DB::table(self::$table)
            ->where('id', $message['id'])
            ->update(['isBrowsed' => $message['isBrowsed']]);

        return TRUE;
    }
}
