<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class RegistrationController extends Controller
{
    public function showBuyerForm() {
        return view('registerBuyer');
    }

    public function showSellerForm() {
        return view('registerSeller');
    }

    public function checkUserId(Request $newUserIdRequest){
        $inData =  $newUserIdRequest->all();
        $newUserId = $inData['message'];
        $regUserExists = DB::table('users')->where('email',$newUserId)->first();
        if($regUserExists!=null){
            $returnData = array(
                'status' => 'error',
                'message' => 'User Id Exists!'
            );
            return response()->json($returnData, 400);
        }
        $usr = new User();
        if($usr->getUserByName($newUserId)!=null){
            $returnData = array(
                'status' => 'error',
                'message' => 'User Id Exists!'
            );
            return response()->json($returnData, 400);
        }else{
            $returnData = array(
                'status' => 'Ok',
                'message' => 'User Id Available!'
            );
            return response()->json($returnData, 200);
        }
    }

    public function checkCompanyWebURL(Request $newUserIdRequest)
    {
        $inData = $newUserIdRequest->all();
        $newCompanyWebsiteURL = $inData['message'];
        $regUserExists = DB::table('company')->where('website', $$newCompanyWebsiteURL)->first();
        if ($regUserExists != null) {
            $returnData = array(
                'status' => 'error',
                'message' => 'Company Exists!'
            );
            return response()->json($returnData, 400);
        }
        $returnData = array(
            'status' => 'Ok',
            'message' => 'Company Not on file!'
        );
        return response()->json($returnData, 200);

    }


    public function processBuyerForm(Request $buyerRequest){
        $emptyRcd = [
            'fname'=>'',
            'lname'=>'',
            'email'=>'',
            'phone'=>'',
            'comment'=>'',
            'strname'=>'',
            'roleselected'=>'',
            'strwebsite'=>'',
            'stradr1'=>'',
            'stradr2'=>'',
            'strcity'=>'',
            'strstate'=>'',
            'strzip'=>'',
            'strcountry'=>'',
            'strid'=>'',
            'strestab'=>'',
            'password'=>'',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),

        ];
        $input= array_merge($emptyRcd, $buyerRequest->all());
        try {
            $regId = DB::table('registrations')->insertGetId([
                'fname' => $input['fname'],
                'lname' => $input['lname'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'comment' => $input['comment'],
                'strname' => $input['strname'],
                'roleselected' => $input['roleselected'],
                'strwebsite' => $input['strwebsite'],
                'straddr1' => $input['stradr1'],
                'straddr2' => $input['stradr2'],
                'strcity' => $input['strcity'],
                'strstate' => $input['strstate'],
                'strzip' => $input['strzip'],
                'country' => $input['strcountry'],
                'strid' => $input['strid'],
                'strestab' => $input['strestab'],
                'strtype'=>$input['strtype'],
                'password' => $input['password'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'buysell_type'=>'B',
                'reg_status'=>'A'
            ]);
        } catch (Exception $e) {
            return view('error', ["error_message"=>$e->getMessage()]);
        }
        $thisRegistration = DB::table('registrations')->where('id', $regId)->first();
        $thisRegistrationController = new RegistrationController();
        $thisRegistrationController->doRegistration($thisRegistration, "buyer", $regId);
        $user = User::where('email', $input['email'])->first();
        if($user==null){
            return view('login');
        }
        Auth::login($user, true);
        $adminView=FALSE;
        return view('feed',['adminView'=>$adminView]);
    }

    public function processSellerForm(Request $sellerRequest){
        $emptyRcd = [
            'fname'=>'',
            'lname'=>'',
            'email'=>'',
            'phone'=>'',
            'comment'=>'',
            'strname'=>'',
            'roleselected'=>'',
            'strwebsite'=>'',
            'stradr1'=>'',
            'stradr2'=>'',
            'strcity'=>'',
            'strstate'=>'',
            'strzip'=>'',
            'strcountry'=>'',
            'strid'=>'',
            'strestab'=>'',
            'password'=>'',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now(),

        ];
        $input= array_merge($emptyRcd, $sellerRequest->all());
        try {
            DB::table('registrations')->insert([
                'fname' => $input['fname'],
                'lname' => $input['lname'],
                'email' => $input['email'],
                'phone' => $input['phone'],
                'comment' => $input['comment'],
                'strname' => $input['strname'],
                'roleselected' => $input['roleselected'],
                'strwebsite' => $input['strwebsite'],
                'straddr1' => $input['stradr1'],
                'straddr2' => $input['stradr2'],
                'strcity' => $input['strcity'],
                'strstate' => $input['strstate'],
                'strzip' => $input['strzip'],
                'country' => $input['strcountry'],
                'strid' => $input['strid'],
                'strestab' => $input['strestab'],
                'strtype'=>$input['strtype'],
                'password' => bcrypt($input['password']),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'buysell_type'=>'S',
                'reg_status'=>'A'
            ]);
        } catch (Exception $e) {
            return view('error', ["error_message"=>$e->getMessage()]);
        }
        return view('regsuccess');

    }

    public function getOneRegistration(Request $regIdRequest){
        $inData =  $regIdRequest->all();
        $regId = $inData['regId'];
        $thisRegistration = DB::table('registrations')->where('id',$regId)->first();
        if($thisRegistration==null){
            $returnData = array(
                'status' => 'error',
                'message' => 'User Id does not Exist!'
            );
            return response()->json($returnData, 400);
        }else{
            $companyTypes = DB::table('companytype')->where('slug',$thisRegistration->strtype)->first();
            $thisRegistration->storeType = $companyTypes->name;
            return response()->json($thisRegistration, 200);
        }

    }

    public function showRegistrationRequests(){
        $outstandingRegistrationsList = $this->getOutstandingRegistrations();
        $adminView =User::hasAccess(['\'admin-dashboard\'']);
        return view('jframe',['outstandingRegistrations'=>$outstandingRegistrationsList, 'adminView'=>$adminView,'sidebar'=>'admin', 'contentWindow'=>'viewRegistrations']);
    }

    private function getOutstandingRegistrations(){
        return DB::table('registrations')->where('reg_status','A')->paginate(15);
    }

    public function approveRegistration(Request $regApprovalRequest)
    {
        $inData = $regApprovalRequest->all();
        $regId = $inData['applicantId'];
        $approveType = $inData['approveRole'];
        $thisRegistration = DB::table('registrations')->where('id', $regId)->first();
        doRegistration($thisRegistration, $approveType, $regId);
        $outstandingRegistrationsList = $this->getOutstandingRegistrations();
        return view('reviewRegistrations2',['outstandingRegistrations'=>$outstandingRegistrationsList]);
    }

    public function doRegistration($thisRegistration, $approveType, $regId){
        DB::beginTransaction();
        $thisUserRole = DB::table('userrole')->where('slug', $approveType)->first();
        try {
            $newUserId = DB::table('users')->insertGetId([
                'name' => strtolower($thisRegistration->fname . '.' . $thisRegistration->lname),
                'email' => $thisRegistration->email,
                'password' => Hash::make($thisRegistration->password),
                'userrole_id' => $thisUserRole->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return view('error', ["error_message"=>$e->getMessage()]);
        }
        $companyFound = FALSE;
        $thisCompany = DB::table('company')->where('website',$thisRegistration->strwebsite)->first();
        if($thisCompany==null){
            try {
                $newCompayId = DB::table('company')->insertGetId([
                    'name' => $thisRegistration->strname,
                    'website' => $thisRegistration->strwebsite,
                    'phone' => $thisRegistration->phone,
                    'addr1' => $thisRegistration->straddr1,
                    'addr2' => $thisRegistration->straddr2,
                    'city' => $thisRegistration->strcity,
                    'state' => $thisRegistration->strstate,
                    'zip' => $thisRegistration->strzip,
                    'country' => $thisRegistration->country,
                    'reseller_id' => $thisRegistration->strid,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                return view('error', ["error_message"=>$e->getMessage()]);
            }
        }else{
            $companyFound = TRUE;
        }
        $thisCompanyType = DB::table('companytype')->where('slug',$thisRegistration->strtype)->first();
        if($thisCompanyType==null){
            throw new Exception('Store type unknown:'.$inData['strtype']);
        }else{
            try {
                $newCompayId = DB::table('compcanbe')->insert([
                    'ctype_id' => $thisCompanyType->id,
                    'company_id' => $newCompayId,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            } catch (Exception $e) {
                DB::rollBack();
                return view('error', ["error_message"=>$e->getMessage()]);
            }
        }
        if($thisRegistration->buysell_type=='B'){
            if($thisRegistration->roleselected==1){
                $companyRoleType = DB::table('companyrole')->where('slug','owner')->first();
            }else{
                $companyRoleType = DB::table('companyrole')->where('slug','buyer')->first();
            }
        }else{
            if($thisRegistration->roleselected==1){
                $companyRoleType = DB::table('companyrole')->where('slug','owner')->first();
            }else{
                $companyRoleType = DB::table('companyrole')->where('slug','srep')->first();
            }
        }
        try {
            $newUserInCompanyRole = DB::table('userincompany')->insert([
                'user_id' => $newUserId,
                'company_id' => $newCompayId,
                'companyrole_id' => $companyRoleType->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return view('error', ["error_message"=>$e->getMessage()]);
        }

        try {
            $affected = DB::update("UPDATE registrations SET reg_status = 'R' WHERE id = ?", [$regId]);
            if($affected==0){
                DB::rollBack();
                return view('error', ["error_message"=>'could not update registration status']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return view('error', ["error_message"=>$e->getMessage()]);
        }

        DB::commit();


    }


}
