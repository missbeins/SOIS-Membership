<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            
            
            [
                'role_role_id' => '1',
                'user_user_id' => '1'
            ],
            
        ];
        DB::table('role_user')->insert($data);
    }
}
