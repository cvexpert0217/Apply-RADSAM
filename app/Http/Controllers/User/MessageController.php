<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MessageUser;
use App\Models\MessageAdmin;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function messageBrowsed(Request $request) {
        $message_id = $request->keys()[0];
        $result = MessageUser::update([
            'id' => $message_id,
            'isBrowsed' => 1
        ]);
    }

    public function replyMessage(Request $request) {
        $message = $request->all();
        MessageAdmin::insert($message);
        return response()->json(['result' => 'success']);
    }

    public function deleteMessage(Request $request) {
        $messageId = $request->keys()[0];
        MessageUser::delete($messageId);
        return response()->json(['result' => 'success']);
    }
}