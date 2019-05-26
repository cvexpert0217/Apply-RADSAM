<?php

namespace App\Models;

use App\Models\Base;
use Illuminate\Support\Facades\DB;

class MessageUser extends Base
{
    protected static $table = "tbl_message_user";

    public static function get_one($value, $field = 'id') {
        $message = DB::table(self::$table . ' AS message')
            ->select('message.*', 'activity.activity_type', 'activity.id AS activity_id', 'activity.assessment_id AS assessment_id', 'activity.status', 'assessment.first_name', 'assessment.last_name', 'assessment.assessment_type')
            ->leftjoin('tbl_activity AS activity', 'message.activity_id', '=', 'activity.id')
            ->leftjoin('tbl_assessment AS assessment', 'assessment.id', '=', 'activity.assessment_id')
            ->where('message.deleted','=', 0)
            ->where('message.id', '=', $value)->first();

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
                'assessment_id' => $message['assessment_id'],
                'message_type' => $message['message_type'],
                'status' => $message['status'],
                'created_at' => now(),
                'updated_at' => now(),
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

    public static function delete($id) {
        DB::table(self::$table)->where('id', $id)->update([
            'deleted' => 1
        ]);

        return TRUE;
    }

    public static function deleteByActivity($activity_id) {
        DB::table(self::$table)->where('activity_id', $activity_id)->update([
            'deleted' => 1
        ]);

        return TRUE;
    }
}
