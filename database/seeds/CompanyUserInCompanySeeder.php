<?php

use Illuminate\Database\Seeder;

class CompanyUserInCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $CompanyLimit = 5;
        $UserLimit=33;
        $CompanyRoleLimit=7;
        $c=1;
        $r=1;
        for ($u = 1; $u < $UserLimit; $u++) {
            $user = DB::table('users')->where('id', $u)->first();
            $company = DB::table('company')->where('name', 'The Trinket Factory')->first();
            $companyRole = DB::table('companyrole')->where('id', $r)->first();
            DB::table('userincompany')->insert([
                'user_id' => $user->id,
                'company_id'=>$company->id,
                'companyrole_id'=>$companyRole->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
            if($r==$CompanyRoleLimit){
                $r=1;
            }else{
                $r++;
            }
            if($c==$CompanyLimit){
                $c=1;
            }else{
                $c++;
            }
        }
    }
}
