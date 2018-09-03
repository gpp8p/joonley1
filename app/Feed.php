<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class Feed extends Model
{
    public function getFeedItems(){
        $feedResult = array();
        $col1 = array();
        $col2 = array();
        $col3 = array();
        $col4 = array();
        $col = 0;
        $feedQueryResult = DB::table('feed')->orderBy('created_at')->get();
        foreach($feedQueryResult as $thisFeed){
            $feedName = $thisFeed->name;
            $feedImage = $thisFeed->image_url;
            $feedDescription = $thisFeed->description;
            $feedId = $thisFeed->id;
            $feedProductId = $thisFeed->product_id;
            $feedCollectionId = $thisFeed->collection_id;
            $feedCompanyId = $thisFeed->company_id;
            $thisFeedItem = array('name'=>$feedName, 'image_url'=>$feedImage, 'description'=>$feedDescription, 'id'=>$feedId, 'product_id'=>$feedProductId, 'collection_id'=>$feedCollectionId, 'company_id'=>$feedCompanyId);
            switch($col){
                case 0:
                    array_push($col1, $thisFeedItem);
                    break;
                case 1:
                    array_push($col2, $thisFeedItem);
                    break;
                case 2:
                    array_push($col3, $thisFeedItem);
                    break;
                case 3:
                    array_push($col4, $thisFeedItem);
                    break;
            }
            if($col==3){
                $col=0;
            }else{
                $col++;
            }
        }
        return array('col1'=>$col1, 'col2'=>$col2, 'col3'=>$col3, 'col4'=>$col4);
    }
}
