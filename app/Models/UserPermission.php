<?php

namespace App\Models;

    use Illuminate\Database\Eloquent\Model;

    class UserPermission extends Model
    {
        protected $table = 'users_permissions';

        protected $fillable = [
            'user_id', 'permission_id',
        ];

        public static function getUserPermissionById($user_id, $permission_id)
        {
            if (self::where('user_id', $user_id)->where('permission_id', $permission_id)->first()) {
                return true;
            }

            return null;
        }

        public static function getUserPermissionByString($user_id, $permission_string)
        {
            $permission = Permission::where('permission', $permission_string)->first();

            if ($permission) {
                if (self::where('user_id', $user_id)->where('permission_id', $permission->id)->first()) {
                    return true;
                }
            }

            return null;
        }

        public static function getUserPermission($user_id, $permission_string)
        {
            return self::getUserPermissionByString($user_id, $permission_string);
        }
    }
