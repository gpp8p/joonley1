<?php

namespace App;

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccessE(array $permissions) : bool
    {
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if($role->hasAccess($permissions)) {
                return true;
            }
        }
        return false;
    }

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
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }



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
        return $usersFound;
    }

}
