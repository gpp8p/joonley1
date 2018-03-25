<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;


class BillInfo extends Model
{
    public function getBillInfoForCompany($companyId)
    {
        try {
            return DB::table('billinfo')->where('company_id', $companyId)->get();
        } catch (Exception $e) {
            throw new Exception('Could not get Billping info for this company:'.$e->getMessage());
        }
    }

    public function addBillInfo($companyId, $newInfo)
    {
        if(!isset($newInfo['lname']) |!isset($newInfo['fname'])|!isset($newInfo['addr1'])|!isset($newInfo['city'])|!isset($newInfo['country']) )
        {
            throw new Exception('Missing address information');
        }
        $emptyBillInfoRecord = [
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
            'wireinfo'=>'',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ];
        $insertData= array_merge($emptyBillInfoRecord, $newInfo);
        try {
            $insertedBillingInfoId = DB::table('billinfo')->insertGetId($insertData);
        } catch (Exception $e) {
            throw new Exception('Could not create this billing info record:'.$e->getMessage());
        }

        return $insertedBillingInfoId;
    }

    public function editBillInfo($billInfoId, $editInfo)
    {
        if(!DB::table('billinfo')->where('id', $billInfoId)->exists())
        {
            throw new Exception('Billing Information record with id ='.$billInfoId.' does not exist');
        }
        $existingBillInfoRcd = (array) DB::table('billinfo')->where('id', $billInfoId)->first();

        $updateData = array_merge($existingBillInfoRcd, $editInfo);
        try {
            DB::beginTransaction();
            $rupd = DB::table('Billinfo')->where('id', $billInfoId)->update($updateData);
        } catch (Exception $e) {
            DB::rollBack();
        }
        DB::commit();
        return $rupd;
    }

    public function removeBillInfo($billInfoRecordId)
    {
        try {
            $nrd = DB::table('billinfo')->where('id', $billInfoRecordId)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not remove Bill info record:'.$e->getMessage());
        }
        return $nrd;
    }

    public function getBillInfoById($billInfoId)
    {
        if(!DB::table('billinfo')->where('id', $billInfoId)->exists())
        {
            throw new Exception('Billing Information record with id ='.$billInfoId.' does not exist');
        }
        $existingBillInfoRcd = (array) DB::table('billinfo')->where('id', $billInfoId)->first();
        return $existingBillInfoRcd;
    }


}
