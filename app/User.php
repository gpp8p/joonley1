<?php

namespace App;
use Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Exception;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Checks if User has access to $permissions.
     */

    public function hasAccess(array $permissions) : bool
    {
        $loggedInUser = Auth::user();
        $loggedInUserName = $loggedInUser>attributesToArray()['name'];


        try {
            $access = $this->hasAccessWithUserName($permissions, $loggedInUserName);
        } catch (Exception $e) {
            return false;
        }
        return $access;

    }

    public function hasAccessWithUserName(array $perms, string $userName) : bool
    {
        $query = 'select permissions from users, userrole where users.userrole_id = userrole.id and users.name = ? ';
        $permission = DB::select($query, [$userName]);
        if(count($permission)!=1){
            throw new Exception('User or role not found');
        }
        $permission = DB::select($query, [$userName]);
        $decodedPermission = json_decode($permission[0]->permissions);


        $permission = array($permission);
        foreach($perms as $p)
        {
            foreach ($decodedPermission as $key => $value)
            {
                if($key==$p && $value ==1){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Checks if the user belongs to role.
     */



    public function getUserList()
    {
        $query = 'select users.name, users.email, userdetails.fname , userdetails.lname, userdetails.phone from users, userdetails '.
        'where userdetails.user_id = users.id';

        $users = DB::select($query);
        return $users;

    }


    public function getUserProfile($userName)
    {
        $query = 'select users.id as uid,users.name as name,users.email as email,users.password as password, '.
            'users.userrole_id as userrole_id, users.remember_token as users_remember_token, users.created_at as users_created_at, users.updated_at as users_updated_at, '.
            'userdetails.admin,userdetails.title,userdetails.lname,userdetails.fname, '.
            'userdetails.addr2,userdetails.addr3,userdetails.city,userdetails.addr1, '.
            'userrole.name as userrole_name, '.
            'userdetails.state,userdetails.zip,userdetails.country,userdetails.phone,userdetails.user_id, userdetails.created_at as userdetails_created_at, userdetails.updated_at as userdetails_updated_at  '.
            'from users, userdetails, userrole where userdetails.user_id = users.id and users.userrole_id = userrole.id and users.name = ?';

        $usersFound = DB::select($query, [$userName]);
//        $usersFound[0]->name = $userName;
        return $usersFound[0];
    }

    public function getUserByName($userName)
    {
        return DB::table('users')->where('name',$userName)->first();
    }

    public function addUser($info)
    {

        try {
            $defaultUserInfo = array(
                'name' => $info['name'],
                'email' => $info['email'],
                'password_pw' => $info['password_pw'],
                'userrole_id' => $info['userrole_id'],
                'title' => '',
                'admin' => $info['admin'],
                'lname' => $info['lname'],
                'fname' => $info['fname'],
                'addr1' => $info['addr1'],
                'addr2' => '',
                'addr3' => '',
                'city' => $info['city'],
                'state' => $info['state'],
                'zip' => $info['zip'],
                'country' => '',
                'phone' => $info['phone'],
            );
        } catch (Exception $e) {
            throw new Exception('could not set up default'.$e->getMessage());
        }

        $mergedInformation = array_merge($defaultUserInfo, $info);

        DB::beginTransaction();
        try {
            $lastRcd = DB::table('users')->insertGetId([
                'name' => $mergedInformation['name'],
                'email' => $mergedInformation['email'],
                'password' => Hash::make($mergedInformation['password_pw']),
                'userrole_id' => $mergedInformation['userrole_id'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            $lastUserDetailsRcd = DB::table('userdetails')->insertGetId([
                'title' => $mergedInformation['title'],
                'admin' => $mergedInformation['admin'],
                'lname' => $mergedInformation['lname'],
                'fname' => $mergedInformation['fname'],
                'addr1' => $mergedInformation['addr1'],
                'addr2' => $mergedInformation['addr2'],
                'addr3' => $mergedInformation['addr3'],
                'city' => $mergedInformation['city'],
                'state' => $mergedInformation['state'],
                'zip' => $mergedInformation['zip'],
                'country' => $mergedInformation['country'],
                'phone' => $mergedInformation['phone'],
                'user_id' => $lastRcd,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not add new user:'.$e->getMessage());
        }
        DB::commit();
        return $lastRcd;

    }

    public function removeUser($userId)
    {
        DB::beginTransaction();
        try {
            $nrd1 = DB::table('users')->where('id', $userId)->delete();
            $nrd2 = DB::table('userdetails')->where('user_id', $userId)->delete();
            $nrd3 = DB::table('userincompany')->where('user_id', $userId)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not remove user:'.$e->getMessage());
        }
        DB::commit();
        return $nrd1;
    }

    public function editUserProfile($user, $editInfo)
    {
        if(!DB::table('users')->where('id', $user->id)->exists())
        {
            throw new Exception('That user cannot be found');
        }
        $existingProfile = (array) $this->getUserProfile($user->name);
        $mergedProfileInformation=array_merge($existingProfile, $editInfo);
        if(isset($editInfo['password']))
        {
            $mergedProfileInformation['password']= Hash::make($editInfo['password']);
        }
        DB::beginTransaction();
        try {
            DB::table('users')->where('id', $user->id)->update([
                'name' => $mergedProfileInformation['name'],
                'email' => $mergedProfileInformation['email'],
                'password' => $mergedProfileInformation['password'],
                'userrole_id' => $mergedProfileInformation['userrole_id'],
                'created_at' => $mergedProfileInformation['users_created_at'],
                'updated_at' => \Carbon\Carbon::now()
            ]);

            DB::table('userdetails')->where('user_id', $user->id)->update([
                'title' => $mergedProfileInformation['title'],
                'admin' => $mergedProfileInformation['admin'],
                'lname' => $mergedProfileInformation['lname'],
                'fname' => $mergedProfileInformation['fname'],
                'addr1' => $mergedProfileInformation['addr1'],
                'addr2' => $mergedProfileInformation['addr2'],
                'addr3' => $mergedProfileInformation['addr3'],
                'city' => $mergedProfileInformation['city'],
                'state' => $mergedProfileInformation['state'],
                'zip' => $mergedProfileInformation['zip'],
                'country' => $mergedProfileInformation['country'],
                'phone' => $mergedProfileInformation['phone'],
                'user_id' => $user->id,
                'created_at' => $mergedProfileInformation['userdetails_created_at'],
                'updated_at' => \Carbon\Carbon::now()
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('Could not edit user:'.$e->getMessage());

        }
        DB::commit();
    }

    public function getUserCompanies($user)
    {
        $query = 'select company.id as comp_id, company.name as comp_name, companyrole.name as comp_role '.
            'from users, userincompany, companyrole, company '.
            'where company.id = userincompany.company_id '.
            'and companyrole.id = userincompany.companyrole_id '.
            'and userincompany.user_id = users.id '.
            'and users.id=?';

        $companiesFound = DB::select($query, [$user->id]);
        return $companiesFound;

    }

    public function setUserRole($newUserRole, $userToChange)
    {
        try {
            DB::table('users')->where('id', $userToChange->id)->update(['userrole_id' => $newUserRole->id]);
        } catch (Exception $e) {
            throw new Exception('Unable to update user role:'.$e->getMessage());
        }
    }

    public function addUserToCompany($user, $company, $companyRole)
    {
        try {
            DB::table('userincompany')->insert([
                'user_id' => $user->id,
                'company_id' => $company->id,
                'companyrole_id' => $companyRole->id,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        } catch (Exception $e) {
            throw new Exception('Could not add user to company:'.$e->getMessage());
        }
    }

    public function removeUserFromCompany($user, $company)
    {
        try {
            DB::table('userincompany')->where('user_id', $user->id)->where('company_id', $company->id)->delete();
        } catch (Exception $e) {
            throw new Exception('Could not remove user from company:'.$e->getMessage());
        }
    }



}
