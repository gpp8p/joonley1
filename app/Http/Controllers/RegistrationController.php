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
                'password' => $input['password'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'buysell_type'=>'B',
                'reg_status'=>'A'
            ]);
        } catch (Exception $e) {
            return view('error', ["error_message"=>$e->getMessage()]);
        }
        return view('regsuccess');
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
            return response()->json($thisRegistration, 200);
        }

    }

    public function showRegistrationRequests(){
        $outstandingRegistrationsList = $this->getOutstandingRegistrations();
        return view('reviewRegistrations',['outstandingRegistrations'=>$outstandingRegistrationsList]);
    }

    private function getOutstandingRegistrations(){
        return DB::table('registrations')->where('reg_status','A')->paginate(15);
    }

}
