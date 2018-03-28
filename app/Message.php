<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;


class Message extends Model
{
    public function getAllMessagesFromUser($user)
    {
        return DB::table('message')->where('from_id', $user->id)->get();
    }

    public function getMessagesToUser($user)
    {
        $query ='select * from message, messageto '.
            'where message.id = messageto.message_id '.
            'and message.thread = TRUE '.
            'and messageto.to_user_id = ?';

        return DB::select($query, [$user->id]);
    }


}
