<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class MediaLink extends Model
{
    public function addMediaLink($type, $pertainsTo, $url)
    {
        try {
            $recordId = DB::table('medialink')->insertGetId([
                'mediatype_id' => $type->id,
                'pertainsto' => $pertainsTo,
                'url' => $url,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            throw new Exception('MediaLink could not be added:'.$e->getMessage());
        }
        return $recordId;

    }

    public function removeMediaLink($mediaLinkId)
    {
        if(!DB::table('medialink')->where('id', $mediaLinkId)->exists())
        {
            throw new Exception('MediaLink record does not exist');
        }
        $nrd = DB::table('medialink')->where('id', $mediaLinkId)->delete();
        return $nrd;
    }
}
