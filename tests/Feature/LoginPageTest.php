<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginPageTest extends TestCase
{
    public function test_user_can_login_using_login_form(){

        $user = User::create([
            
                'first_name' => 'Student',
                'middle_name' => 'Number',
                'last_name' =>'One',
                'course_id'=> '9',
                'year_and_section'=>'BSIT 3-1',
                'student_number' => '0000-2020-tg-0',
                'mobile_number' => '091234567892',
                'email' => 'student1@email.com',
                'password' =>Hash::make('studentone'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
             
        ]);

        $response = $this->post('/login',[

            'email' => $user->email,
            'password' =>'password'
        ]);

        $this->assertAuthenticated($guard = null);

        $response->assertRedirect('/'); 
    }

    public function test_user_cannot_access_admin_pages(){

        $user = User::create([
            'first_name' => 'Student',
            'middle_name' => 'Number',
            'last_name' =>'Two',
            'course_id'=> '9',
            'year_and_section'=>'BSIT 3-1',
            'student_number' => '00111-2020-tg-0',
            'mobile_number' => '091234567892',
            'email' => 'student2@email.com',
            'password' =>Hash::make('studenttwo'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        $response = $this->post('/login',[

            'email' => $user->email,
            'password' =>'password'
        ]);

        $this->get('/admin/users');

        $response->assertRedirect('/'); 
    }
}
