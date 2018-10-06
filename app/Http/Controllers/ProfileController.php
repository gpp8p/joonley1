<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
use App\Terms;
use Illuminate\Support\Facades\DB;


class ProfileController extends Controller
{
    public function showProfileEdit(Request $request){
        $inData =  $request->all();
        $selectedUserId = $inData['selectedUser'];
        $userModel = new User;
        $thisUserData = $userModel->getUserProfileById($selectedUserId);
        $states = $this->getStates();
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'admin', 'contentWindow'=>'userEdit', 'thisUserData'=>$thisUserData, 'states'=>$states]);
    }

    public function profileEditSubmit(Request $request){
        $inData =  $request->all();

        $editUser = DB::table('users')->where('id', $inData['userId'])->first();
        $thisUser = new User;
        try {
            $thisUser->editUserProfile($editUser, $inData);
        } catch (Exception $e) {

        }

        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        if($adminView){
            return redirect()->route('admin');
        }
    }

    public function editCompanyInformation(Request $request)
    {
        $inData = $request->all();
        $thisUserId = $inData['userId'];
        $thisUserName = $inData['userFname']." ".$inData['userLname'];
        $thisCompany = new Company;
        $companyData = $thisCompany->getCompanyInfoByUserId($thisUserId);
        $termsObject = new Terms;
        $allTerms = $termsObject->getAllTerms();
        $currentTermsTypeId = $allTerms[0]->termstype_id;
        $currentTermsId = $allTerms[0]->terms_id;
        $currentTermsTypeName = $allTerms[0]->termstype_name;
        $terms = array();
        $termsTypes = array();
//        $thisTermsReference = array($allTerms[0]->terms_specification, $allTerms[0]->terms_id);
        foreach($allTerms as $thisTerm){
            if($thisTerm->termstype_id!=$currentTermsId){
                $termsTypes[$currentTermsTypeName]=$terms;
                $currentTermsTypeName = $thisTerm->termstype_name;
                $thisTermsReference = array($thisTerm->terms_specification, $thisTerm->terms_id);
                $terms=array();
                array_push($terms, $thisTermsReference);
            }else{
                $thisTermsReference = array($thisTerm->terms_specification, $thisTerm->terms_id);
                array_push($terms, $thisTermsReference);
            }
        }
        $termsTypes[$currentTermsTypeName]=$terms;
        $states = $this->getStates();
        $companyRoles = $this->getCompanyRoles();
        $adminView = User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'admin', 'contentWindow'=>'companyEdit', 'thisCompanyData'=>$companyData[0], 'states'=>$states, 'companyRoles'=>$companyRoles, 'userName'=>$thisUserName, 'terms'=>$termsTypes] );
    }

    public function companyEditUpdate(Request $request){
        $inData = $request->all();
        $thisCompanyId = $inData['company_id'];
        $defaultTerms = DB::table('defaultterms')->where('company_id',$thisCompanyId)->first();
/*
        if(array_length($defaultTerms)>0){
            DB::table('defaultterms')->where('company_id', $thisCompanyId)->delete();
        }
        $keys = array_keys($inData);

        foreach($keys as $thisKey){
            if($this->startsWith($thisKey, 'term_')){
                $explodedTermKey = explode('_',$thisKey);
                DB::table('defaultterms')->insert([
                    'terms_id'=>$explodedTermKey[1],
                    'company_id'=>$thisCompanyId,
                    'created_at'=>\Carbon\Carbon::now(),
                    'updated_at'=>\Carbon\Carbon::now()
                ]);
            }
        }

        DB::table('company')->where('id', $thisCompanyId)->update([
            'name'=>    $inData['name'],
            'website'=> 'www.rings.com',
            'icon'=>'12345678.jpg',
            'phone'=> $inData['phone'],
            'addr1' =>$inData['name'],
            'addr2' =>$$inData['addr2'],
            'city' => $inData['city'],
            'state' => $inData['state'],
            'zip' => $inData['zip'],
            'country' =>$inData['country'],
            'reseller_id'=>'1234567890',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()


        ]);
*/
    }

    public function getCompanyRoles(){
        $query = "select name, slug from companyrole";
        $userroles = DB::select($query);
        $roles = array();
        foreach($userroles as $thisRole){
            array_push($roles, [$thisRole->slug, $thisRole->name]);
        }
        return $roles;
    }



    public function getStates(){
        $states = array();
        array_push($states,["","State"]);
        array_push($states,["AL","Alabama"]);
        array_push($states,["AK","Alaska"]);
        array_push($states,["AZ","Arizona"]);
        array_push($states,["AR","Arkansas"]);
        array_push($states,["CA","California"]);
        array_push($states,["CO","Colorado"]);
        array_push($states,["CT","Connecticut"]);
        array_push($states,["DE","Delaware"]);
        array_push($states,["DC","District Of Columbia"]);
        array_push($states,["FL","Florida"]);
        array_push($states,["GA","Georgia"]);
        array_push($states,["HI","Hawaii"]);
        array_push($states,["ID","Idaho"]);
        array_push($states,["IL","Illinois"]);
        array_push($states,["IN","Indiana"]);
        array_push($states,["IA","Iowa"]);
        array_push($states,["KS","Kansas"]);
        array_push($states,["KY","Kentucky"]);
        array_push($states,["LA","Louisiana"]);
        array_push($states,["ME","Maine"]);
        array_push($states,["MD","Maryland"]);
        array_push($states,["MA","Massachusetts"]);
        array_push($states,["MI","Michigan"]);
        array_push($states,["MN","Minnesota"]);
        array_push($states,["MS","Mississippi"]);
        array_push($states,["MO","Missouri"]);
        array_push($states,["MT","Montana"]);
        array_push($states,["NE","Nebraska"]);
        array_push($states,["NV","Nevada"]);
        array_push($states,["NH","New Hampshire"]);
        array_push($states,["NJ","New Jersey"]);
        array_push($states,["NM","New Mexico"]);
        array_push($states,["NY","New York"]);
        array_push($states,["NC","North Carolina"]);
        array_push($states,["ND","North Dakota"]);
        array_push($states,["OH","Ohio"]);
        array_push($states,["OK","Oklahoma"]);
        array_push($states,["OR","Oregon"]);
        array_push($states,["PA","Pennsylvania"]);
        array_push($states,["RI","Rhode Island"]);
        array_push($states,["SC","South Carolina"]);
        array_push($states,["SD","South Dakota"]);
        array_push($states,["TN","Tennessee"]);
        array_push($states,["TX","Texas"]);
        array_push($states,["UT","Utah"]);
        array_push($states,["VT","Vermont"]);
        array_push($states,["VA","Virginia"]);
        array_push($states,["WA","Washington"]);
        array_push($states,["WV","West Virginia"]);
        array_push($states,["WI","Wisconsin"]);
        array_push($states,["WY","Wyoming"]);
        return $states;
    }

    private function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === ''
            || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }
}
