<?php

use App\User;
use App\UserPermission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user_permissions')->delete();
        // foreach (DB::select('select id from users') as $user)
            foreach (UserPermission::PERMISSIONS as $pkey => $pvalue)
                foreach (UserPermission::TYPES as $tkey => $tvalue) {
                    DB::table('user_permissions')->insert([
                        'user_id' => 1,
                        'permission' => $pkey,
                        'type'     => $tkey, 
                        'granted_by_user_id' => 1
                    ]);
                }
        
    }
}
