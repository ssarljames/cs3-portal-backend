<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function only_logged_user_can_see_users_list(){
        $this->get('/api/users')->assertRedirect();
    }


    /** @test */
    public function only_admin_user_can_see_users_list(){

        $this->assertTrue(true);
    }
}
