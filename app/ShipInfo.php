<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class ShipInfo extends Model
{
    public function getShipInfoForCompany($companyId)
    {
        try {
            return DB::table('shipinfo')->where('company_id', $companyId)->get();
        } catch (Exception $e) {
            throw new Exception('Could not get shipping info for this company:'.$e->getMessage());
        }
    }

    public function addShipInfo($companyId, $newInfo)
    {
        if(!isset($newInfo['lname']) |!isset($newInfo['fname'])|!isset($newInfo['addr1'])|!isset($newInfo['city'])|!isset($newInfo['country']) )
        {
            throw new Exception('Missing address information');
        }
        $emptyShipInfoRecord = [
            'company_id'=>$companyId,
            'title' => '',
            'lname' => '',
            'fname' => '',
            'addr1' =>'',
            'addr2' =>'',
            'addr3' =>'',
            'city' => '',
            'state' => '',
            'zip' => '',
            'country' => '',
            'phone' => '',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];
        $insertData= array_merge($emptyShipInfoRecord, $newInfo);
        try {
            $insertedShippingInfoId = DB::table('shipinfo')->insertGetId($insertData);
        } catch (Exception $e) {
            throw new Exception('Could not create this shipping info record:'.$e->getMessage());
        }

        return $insertedShippingInfoId;
    }

    public function removeShipInfo($shipInfoRecordId)
    {
        try {
            $nrd = DB::table('shipinfo')->where('id', $shipInfoRecordId)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not remove ship info record:'.$e->getMessage());
        }
        return $nrd;
    }
    public function editShipInfo($shipInfoId, $editInfo)
    {

    }
}
