<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Company;
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
        $thisCompany = new Company;
        $companyData = $thisCompany->getCompanyInfoByUserId($thisUserId);
        $states = $this->getStates();
        $adminView = User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['adminView'=>$adminView,'sidebar'=>'admin', 'contentWindow'=>'companyEdit', 'thisCompanyData'=>$companyData[0], 'states'=>$states]);
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
}
