<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamsApplicationTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * A basic test example.
     *
     * @return void
     */

    private function isAdmin()
    {

        $this->actingAs(factory(User::class)->create([
            'user_group' => 1
        ]));
    }

    private function isCaptain()
    {

        $this->actingAs(factory(User::class)->create([
            'user_group' => 2
        ]));
    }


    private function isPlayer()
    {
        $this->actingAs(factory(User::class)->create());
    }

    private function addSport()
    {
        Sport::create([
            'name' => 'test'
        ]);
    }

    private function addDivision()
    {
        Division::create([
            'name' => 'test',
            'sport_id' => 1
        ]);
    }

    private function addTeam()
    {
        Team::create([
            'name' => 'test',
            'division_id' => '1',
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);
    }

    private function addTeamWithCaptain()
    {
        Team::create([
            'name' => 'test',
            'division_id' => '1',
            'captain_id' => '1',
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);
    }

    private function addApplication()
    {

        TeamApplicant::create([
                    'team_id' => 1,
                    'user_id' => 2, //Second created user so application can be accepted
                    'name' => 'test name',
                    'approved' => 0

                ]);

    }

    /** @test */
    public function An_Unauthenticated_User_Cannot_View_Applications()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'asdfasf',
            'user_group' => 3,
            'hasTeam' => 0,
            'hasProfile' => 0,

        ]);
        
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertStatus(403); //Unauthorized


    }

    /** @test */
    public function A_Non_Team_Member_Cannot_View_Applications()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'asdfasf',
            'user_group' => 3,
            'hasTeam' => 0,
            'hasProfile' => 0,

        ]);
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertStatus(403); //Unauthorized


    }

    /** @test */
    public function A_Team_Member_Who_Is_A_Player_Cannot_View_Applications()
    {
       
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertStatus(403); //Unauthorized


    }

    /** @test */
    public function A_Captain_Of_A_Team_Can_View_Applications()
    {
       
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeamWithCaptain();

        $response = $this->get('/teams/1/applications');

        $response->assertOk();


    }

    /** @test */
    public function A_Captain_Of_A_Different_Team_Cannot_View_Applications()
    {
       
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertStatus(403); //Unauthorized


    }



    





    /** @test */
    public function An_Admin_Can_View_Own_Teams_Applications()
    {
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Other_Teams_Applications()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => 'asdfasf',
            'user_group' => 3,
            'hasTeam' => 0,
            'hasProfile' => 0,

        ]);

        $this->isAdmin();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1/applications');

        $response->assertOk();
     }







}
