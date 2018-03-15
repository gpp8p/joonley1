<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $table = 'companytype';

    public function getCompanyTypes()
    {
        $companyTypes = $this->all();
        $companyTypesNames = [];
        foreach($companyTypes as $thisCompanyTypes)
        {
            $companyTypesNames[] = [$thisCompanyTypes->name, $thisCompanyTypes->id];
        }
        return $companyTypesNames;
    }

    public function getCompanySellerTypes()
    {
        $companyTypes = \App\CompanyType::where('role','seller')->get();
        $companyTypesNames = [];
        foreach($companyTypes as $thisCompanyTypes)
        {
            $companyTypesNames[] = [$thisCompanyTypes->name, $thisCompanyTypes->id];
        }
        return $companyTypesNames;
    }

    public function getCompanyBuyerTypes()
    {
        $companyTypes = \App\CompanyType::where('role','buyer')->get();
        $companyTypesNames = [];
        foreach($companyTypes as $thisCompanyTypes)
        {
            $companyTypesNames[] = [$thisCompanyTypes->name, $thisCompanyTypes->id];
        }
        return $companyTypesNames;
    }

}
