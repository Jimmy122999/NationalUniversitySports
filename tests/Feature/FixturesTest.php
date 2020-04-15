<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\Team;
use App\TeamMember;
use App\User;
use App\Fixture;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FixturesTest extends TestCase
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


    private function populateData()
    {
       Sport::create([
            'name' => 'test'
        ]);

        Division::create([
            'name' => 'test',
            'sport_id' => 1
        ]);

        Team::create([
            'name' => 'home test',
            'division_id' => 1,
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);

        Team::create([
            'name' => 'away test',
            'division_id' => 1,
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);

        


    }

    private function addFixture()
    {

        Fixture::create([
            'home_team_id' => 1,
            'away_team_id' => 2,
            'division_id' => 1,
            'time' => '2020-04-09 10:20:31',
            'notes' => 'testing',
            'played' => 0
        ]);
    }




    
    /** @test */
    public function An_Unauthenticated_User_Can_View_Fixtures()
    {
        
        $this->populateData();
        $this->addFixture();
        $response = $this->get('/fixtures');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Fixtures()
    {
        $this->isAdmin();
        $this->populateData();
        $this->addFixture();
        $response = $this->get('/fixtures');

        $response->assertOk();
    }

    /** @test */
    public function A_Captain_Can_View_Fixtures()
    {
        $this->isCaptain();
        $this->populateData();
        $this->addFixture();
        $response = $this->get('/fixtures');

        $response->assertOk();
    }


    /** @test */
    public function A_Player_Can_View_Fixtures()
    {
        $this->isPlayer();
        $this->populateData();
        $this->addFixture();
        $response = $this->get('/fixtures');

        $response->assertOk();
    }


    /** @test */
    public function An_Unauthenticated_User_Cannot_Access_Fixture_Create_Form()
    {
        
        
        $this->populateData();


        $response = $this->get('/fixtures/create');
        $response->assertStatus(302); //Middleware Redirects

        
        
    }

    /** @test */
    public function An_Admin_Can_Access_Fixture_Create_Form()
    {
        
        $this->isAdmin();
        $this->populateData();


        $response = $this->get('/fixtures/create');
        $response->assertOk(); 

        
        
    }

    /** @test */
    public function A_Captain_Cannot_Access_Fixture_Create_Form()
    {
        
        $this->isCaptain();
        $this->populateData();


        $response = $this->get('/fixtures/create');
        $response->assertStatus(302); //Middleware Redirects

        
        
    }

    /** @test */
    public function A_Player_Cannot_Access_Fixture_Create_Form()
    {
        
        $this->isPlayer();
        $this->populateData();


        $response = $this->get('/fixtures/create');
        $response->assertStatus(302); //Middleware Redirects

        
        
    }

    /** @test */
        public function An_Admin_Can_Create_A_Fixture()
        {
           
            $this->isAdmin();
            $this->populateData();
             

            $response = $this->post('/fixtures/create', [
                'homeTeam' => 1,
                'awayTeam' => 2,
                'division_id' => 1,
                'time' => '2020-04-09 10:20:31',
                'notes' => 'testing',
                
            ]);
            $this->assertCount(1 , Fixture::all());
            
        }

    /** @test */
        public function A_Captain_Cannot_Create_A_Fixture()
        {
            
            $this->isCaptain();
            $this->populateData();
             

            $response = $this->post('/fixtures/create', [
                'homeTeam' => 1,
                'awayTeam' => 2,
                'division_id' => 1,
                'time' => '2020-04-09 10:20:31',
                'notes' => 'testing',
                
            ]);
            $response->assertStatus(302);
            $this->assertCount(0 , Fixture::all());
            
        }        

        /** @test */
            public function A_Player_Cannot_Create_A_Fixture()
            {
                
                $this->isPlayer();
                $this->populateData();
                 

                $response = $this->post('/fixtures/create', [
                    'homeTeam' => 1,
                    'awayTeam' => 2,
                    'division_id' => 1,
                    'time' => '2020-04-09 10:20:31',
                    'notes' => 'testing',
                   
                ]);

                $response->assertStatus(302);
                $this->assertCount(0 , Fixture::all());
                
            }





        
}


