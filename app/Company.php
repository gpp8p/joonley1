<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Exception;

class Company extends Model
{
    protected $table = 'company';

    public function names()
    {
        $companies = $this->all();
        $companyNames = [];
        foreach($companies as $thisCompany)
        {
            $companyNames[] = $thisCompany->name;
        }
        return $companyNames;
    }

    public function addNewCompany($companyName, $companyWeb, $companyPhone, $companyLocations, $companyTypeId,$icon)
    {
        try {
            $this->getCompanyByName($companyName);
            throw new Exception($companyName.' already exists');
        } catch (Exception $e) {
            DB::beginTransaction();
            try {
                $newCompanyId = DB::table('company')->insertGetId([
                    'name' => $companyName,
                    'website' => $companyWeb,
                    'icon' => $icon,
                    'phone' => $companyPhone,
//                'location_id'=>$companyLocations,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);

                DB::table('compcanbe')->insert([
                    'ctype_id' => $companyTypeId,
                    'company_id' => $newCompanyId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
                foreach($companyLocations as $thisLoc)
                {
                    DB::table('companyloc')->insert([
                        'location_id' => $thisLoc,
                        'company_id' => $newCompanyId,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    ]);
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw new Exception("Error updating database:".$e->getMessage());
            }
        }
        return $newCompanyId;
    }

    public function getCompanyByName($companyName)
    {
        $thisCompany = DB::table('company')->where('name', $companyName)->first();

        if($thisCompany==NULL){
            throw new Exception($companyName.' not found');
        }else{
            return $thisCompany->id;
        }
    }

    public function deleteCompany($companyId)
    {
        $nrd = DB::table('company')->where('id', '=', $companyId)->delete();
        if($nrd==0){
            throw new Exception('Nothing deleted');
        }else{
            $nrd = DB::table('compcanbe')->where('company_id', '=', $companyId)->delete();
            if($nrd==0){
                throw new Exception('No type records deleted');
            }
        }
    }

    public function editCompany($companyId, $companyName, $companyWeb, $companyPhone, $companyLocations, $companyTypeIds)
    {
        try {
            $thisCompany = DB::table('company')->where('id', '=', $companyId)->get();
        } catch (Exception $e) {
            throw new Exception("Company with Id = ".$companyId."not found");
        }
        if($thisCompany[0]->name != $companyName){
            $newCompanyName = $companyName;
        }else{
            $newCompanyName = $thisCompany[0]->name;
        }
        if($thisCompany[0]->website != $companyWeb){
            $newCompanyWeb = $companyWeb;
        }else{
            $newCompanyWeb = $thisCompany[0]->website;
        }
        if($thisCompany[0]->phone != $companyPhone){
            $newCompanyPhone = $companyPhone;
        }else{
            $newCompanyPhone = $thisCompany[0]->phone;
        }
/*
        if($thisCompany[0]->location_id != $companyLocationId){
            $newCompanyLocationId = $companyLocationId;
        }else{
            $newCompanyLocationId = $thisCompany[0]->location_id;
        }
*/
        DB::table('company')->where('id', $companyId)->update([
            'name'=>    $newCompanyName,
            'website'=> $newCompanyWeb,
            'phone'=> $newCompanyPhone,
//            'location_id'=>$newCompanyLocationId,
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        $canBeQuery = "select ctype_id from compcanbe where company_id = ?";
        $cbs = DB::select($canBeQuery, [$companyId]);


        $existingCtypes = array();
        foreach($cbs as $cb)
        {
            $thisCtypeId = $cb->ctype_id;
            $existingCtypes[] = $thisCtypeId;
        }
        foreach($companyTypeIds as $ct) {
            if (!in_array($ct, $existingCtypes))
            {
                DB::table('compcanbe')->insert([
                    'ctype_id'=>$ct,
                    'company_id'=>$companyId,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);
            }
        }
        foreach($existingCtypes as $et)
        {
            if( !in_array($et, $companyTypeIds))
            {
                DB::table('compcanbe')->where([
                    ['ctype_id', '=', $et],
                    ['company_id', '=', $companyId],
                ])->delete();
            }
        }

        $locationsQuery = "select location_id from companyloc where company_id = ?";
        $locs = DB::select($locationsQuery, [$companyId]);
        $existingLocations = array();
        foreach($locs as $l)
        {
            $thisLocId = $l->location_id;
            $existingLocations[] = $thisLocId;
        }
        foreach($companyLocations as $cloc)
        {
            if(!in_array($cloc, $existingLocations))
            {
                DB::table('companyloc')->insert([
                   'location_id'=>$cloc,
                   'company_id'=>$companyId,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);
            }
        }
        foreach($existingLocations as $eloc)
        {
            if(!in_array($eloc, $companyLocations))
            {
                DB::table('companyloc')->where([
                    ['location_id', '=', $eloc],
                    ['company_id', '=', $companyId]
                ])->delete();
            }
        }
    }
}


