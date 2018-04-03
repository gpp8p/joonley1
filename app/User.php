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
        $query = 'select * from users, userdetails, userrole where userdetails.user_id = users.id and users.userrole_id = userrole.id and users.name = ?';
        $usersFound = DB::select($query, [$userName]);
        $usersFound[0]->name = $userName;
        return $usersFound[0];
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

}
