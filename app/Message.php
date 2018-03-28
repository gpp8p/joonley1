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

    public function addNewMessage($msginfo)
    {
        $error = FALSE;
        $errorMessage = '';
        if(!isset($msginfo['from_id']))
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## No from_id supplied ##';
        }
        if(!isset($msginfo['to_id']))
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## No to_id supplied ##';
        }
        if(!isset($msginfo['type_id']))
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## No type_id supplied ##';
        }
        if(!isset($msginfo['content']))
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## No content supplied ##';
        }
        if(!isset($msginfo['title']))
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## No title supplied ##';
        }
        $fromId = $msginfo['from_id'];
        if(!DB::table('users')->where('id', $fromId)->exists())
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## User with from_id:'.$fromId.' does not exist';
        }
        $toId = $msginfo['to_id'];
        if(!DB::table('users')->where('id', $toId)->exists())
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## User with to_id does not exist';
        }
        $typeId = $msginfo['type_id'];
        if(!DB::table('messagetype')->where('id',$typeId)->exists())
        {
            $error=TRUE;
            $errorMessage = $errorMessage.'## Message type is wrong ##';
        }
        if(!isset($msginfo['thread']))
        {
            $msgIsThread=TRUE;
            $msgParentId = 0;
        }else{
            if(!isset($msginfo['parent_id']))
            {
                $error=TRUE;
                $errorMessage = $errorMessage.'## Thread has no parent id ##';
            }else{
                if(!DB::table('message')->where('id',$msginfo['parent_id']))
                {
                    $error=TRUE;
                    $errorMessage = $errorMessage.'## Thread parent does not exist ##';
                }else{
                    $msgIsThread=TRUE;
                    $msgParentId = $msginfo['parent_id'];
                }
            }
        }
        if(!isset($msginfo['event_id']))
        {
            $thisEventId = 0;
        }else{
            if(!DB::table('event')->where('id', $msginfo['event_id'])->exists())
            {
                $error=TRUE;
                $errorMessage = $errorMessage.'Event id does not exist';
            }else{
                $thisEventId = $msginfo['event_id'];
            }
        }
        if($error)
        {
            throw new Exception($errorMessage);
        }
        try {
            DB::beginTransaction();
                $newMessageId = DB::table('message')->insertGetId([
                    'type_id' => $msginfo['type_id'],
                    'title' => $msginfo['title'],
                    'thread' => $msgIsThread,
                    'parent_id' => $msgParentId,
                    'event_id' => $thisEventId,
                    'from_id' => $msginfo['from_id'],
                    'content' => $msginfo['content'],
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                 DB::table('messageto')->insert([
                    'message_id'=>$newMessageId,
                    'to_user_id'=>$msginfo['to_id'],
                     'created_at' => \Carbon\Carbon::now(),
                     'updated_at' => \Carbon\Carbon::now(),
                 ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not add new event:'.$e->getMessage());
        }
        DB::commit();
        return $newMessageId;
    }

    public function removeMessage($messageId)
    {
        try {
            DB::beginTransaction();
            DB::table('message')->where('id', $messageId)->delete();
            DB::table('messageto')->where('message_id', $messageId)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not delete event:'.$e->getMessage());
        }
        DB::commit();
    }


}
