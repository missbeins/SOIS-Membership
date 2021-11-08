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
            
            
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-CSMEM-TG-0',
            //     'email' => 'csmembership@email.com',
            //     'password' =>Hash::make('csmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-AEMEM-TG-0',
            //     'email' => 'aecesmembership@email.com',
            //     'password' =>Hash::make('aecesmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-JMMEM-TG-0',
            //     'email' => 'jmamembership@email.com',
            //     'password' =>Hash::make('jmamembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-JPMEM-TG-0',
            //     'email' => 'jpiamembership@email.com',
            //     'password' =>Hash::make('jpiamembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-MAMEM-TG-0',
            //     'email' => 'jpmapmembership@email.com',
            //     'password' =>Hash::make('jpmapmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-MEMEM-TG-0',
            //     'email' => 'jpsmemembership@email.com',
            //     'password' =>Hash::make('jpsmemembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-MSMEM-TG-0',
            //     'email' => 'mentormembership@email.com',
            //     'password' =>Hash::make('mentormembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-PAMEM-TG-0',
            //     'email' => 'pasoamembership@email.com',
            //     'password' =>Hash::make('pasoamembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-ERMEM-TG-0',
            //     'email' => 'ergmembership@email.com',
            //     'password' =>Hash::make('ergmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-CCMEM-TG-0',
            //     'email' => 'cscmembership@email.com',
            //     'password' =>Hash::make('cscmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-REMEM-TG-0',
            //     'email' => 'recmembership@email.com',
            //     'password' =>Hash::make('recmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '1',
            //     'student_number' => '0000-ICMEM-TG-0',
            //     'email' => 'irockmembership@email.com',
            //     'password' =>Hash::make('irockmembership@email.com'),
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member@email.com', 
            //     'password' => Hash::make('bsa-member@email.com'),
            //     'student_number' => '2018-00012-TG-O',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                   
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member2@email.com', 
            //     'password' => Hash::make('bsa-member2@email.com'),
            //     'student_number' => '2018-00013-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member3@email.com', 
            //     'password' => Hash::make('bsa-member3@email.com'),
            //     'student_number' => '2018-00014-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member4@email.com', 
            //     'password' => Hash::make('bsa-member4@email.com'),
            //     'student_number' => '2018-00015-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member5@email.com', 
            //     'password' => Hash::make('bsa-member5@email.com'),
            //     'student_number' => '2018-00016-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member6@email.com', 
            //     'password' => Hash::make('bsa-member6@email.com'),
            //     'student_number' => '2018-00017-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member7@email.com', 
            //     'password' => Hash::make('bsa-member7@email.com'),
            //     'student_number' => '2018-00018-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member8@email.com', 
            //     'password' => Hash::make('bsa-member8@email.com'),
            //     'student_number' => '2018-00019-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member9@email.com', 
            //     'password' => Hash::make('bsa-member9@email.com'),
            //     'student_number' => '2018-00020-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member10@email.com', 
            //     'password' => Hash::make('bsa-member10@email.com'),
            //     'student_number' => '2018-00021-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member11@email.com', 
            //     'password' => Hash::make('bsa-member11@email.com'),
            //     'student_number' => '2018-00112-TG-O',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                   
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member12@email.com', 
            //     'password' => Hash::make('bsa-member12@email.com'),
            //     'student_number' => '2018-00113-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member13@email.com', 
            //     'password' => Hash::make('bsa-member13@email.com'),
            //     'student_number' => '2018-00114-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member14@email.com', 
            //     'password' => Hash::make('bsa-member14@email.com'),
            //     'student_number' => '2018-00115-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member15@email.com', 
            //     'password' => Hash::make('bsa-member15@email.com'),
            //     'student_number' => '2018-01016-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member16@email.com', 
            //     'password' => Hash::make('bsa-member16@email.com'),
            //     'student_number' => '2018-00117-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member17@email.com', 
            //     'password' => Hash::make('bsa-member17@email.com'),
            //     'student_number' => '2018-00118-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member18@email.com', 
            //     'password' => Hash::make('bsa-member18@email.com'),
            //     'student_number' => '2018-10019-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member19@email.com', 
            //     'password' => Hash::make('bsa-member19@email.com'),
            //     'student_number' => '2018-10020-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member20@email.com', 
            //     'password' => Hash::make('bsa-member20@email.com'),
            //     'student_number' => '2018-02021-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member21@email.com', 
            //     'password' => Hash::make('bsa-member21@email.com'),
            //     'student_number' => '2018-22012-TG-O',
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                   
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member22@email.com', 
            //     'password' => Hash::make('bsa-member22@email.com'),
            //     'student_number' => '2018-00023-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                
            // ],
            // [
            //     'role_id' => '2', 
            //     'email' => 'bsa-member23@email.com', 
            //     'password' => Hash::make('bsa-member23@email.com'),
            //     'student_number' => '2018-20014-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member24@email.com', 
            //     'password' => Hash::make('bsa-member24@email.com'),
            //     'student_number' => '2018-20015-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member25@email.com', 
            //     'password' => Hash::make('bsa-member25@email.com'),
            //     'student_number' => '2018-00216-TG-O', 
                
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member26@email.com', 
            //     'password' => Hash::make('bsa-member26@email.com'),
            //     'student_number' => '2018-02017-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member27@email.com', 
            //     'password' => Hash::make('bsa-member27@email.com'),
            //     'student_number' => '2018-20018-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member28@email.com', 
            //     'password' => Hash::make('bsa-member28@email.com'),
            //     'student_number' => '2018-02119-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member29@email.com', 
            //     'password' => Hash::make('bsa-member29@email.com'),
            //     'student_number' => '2018-03020-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            // [   
            //     'role_id' => '2', 
            //     'email' => 'bsa-member30@email.com', 
            //     'password' => Hash::make('bsa-member30@email.com'),
            //     'student_number' => '2018-33321-TG-O', 
            //     'created_at' => date('Y-m-d H:i:s'),
            //     'updated_at' => date('Y-m-d H:i:s'),
                    
            // ],
            
            
            
            
        ];
        DB::table('users')->insert($data);
    }
}
