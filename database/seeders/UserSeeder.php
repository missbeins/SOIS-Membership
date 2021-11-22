<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
                'first_name' => 'Admin',
                'middle_name' => 'admin',
                'last_name' =>'Admin',
                'course_id'=> '9',
                'year_and_section'=>'BSIT 3-1',
                'mobile_number' => '091234567812',
                'student_number' => '00193-2020-tg-0',
                'email' => 'admin@email.com',
                'password' =>Hash::make('admin12345'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
             ],
             [
                'first_name' => 'Non',
                'middle_name' => 'Academic',
                'last_name' =>'Admin',
                'course_id'=> '11',
                'year_and_section'=>'ERG',
                'mobile_number' => '091234567812',
                'student_number' => '00000-ERG-TG-0',
                'email' => 'adminerg@email.com',
                'password' =>Hash::make('admin12345'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
             ],
            
            
            
        ];
        DB::table('users')->insert($data);
    }
}
