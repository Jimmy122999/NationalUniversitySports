<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\Team;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamsTest extends TestCase
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

    /** @test */
    public function An_Unauthenticated_User_Can_View_Teams()
    {
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Teams()
    {
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Captain_Can_View_Teams()
    {
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Player_Can_View_Teams()
    {
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $response = $this->get('/teams/1');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_Create_Teams()
    {
        
        $this->addSport();
        $this->addDivision();
         $this->isAdmin();
        $division = Division::First();

        $response = $this->post('/teams', [
            'name' => 'test',
            'division_id' => $division->id
        ]);
        $this->assertCount(1 , Team::all());
        
    }

    /** @test */
    public function An_Admin_Cannot_Create_Teams_With_Nuemerical_Characters()
    {
        
        $this->addSport();
        $this->addDivision();
         $this->isAdmin();
        $division = Division::First();

        $response = $this->post('/teams', [
            'name' => 'test12',
            'division_id' => $division->id
        ]);
        $this->assertCount(0 , Team::all());
        
    }

    /** @test */
    public function A_Captain_Cannot_Create_Teams()
    {
        $this->withoutExceptionHandling();
        $this->addSport();
        $this->addDivision();
         $this->isCaptain();
        $division = Division::First();

        $response = $this->post('/teams', [
            'name' => 'test',
            'division_id' => $division->id
        ]);
        $this->assertCount(0 , Team::all());
        
    }

    /** @test */
    public function A_Player_Cannot_Create_Teams()
    {
        $this->withoutExceptionHandling();
        $this->addSport();
        $this->addDivision();
         $this->isPlayer();
        $division = Division::First();

        $response = $this->post('/teams', [
            'name' => 'test',
            'division_id' => $division->id
        ]);
        $this->assertCount(0 , Team::all());
        
    }

    /** @test */
    public function A_Team_Can_Be_Updated_By_Admin()
    {
        $this->withoutExceptionHandling();
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();
        
        
        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $createdTeam->id . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('New Test', Team::First()->name);

    }

    /** @test */
    public function A_Team_Cannot_Be_Updated_By_Captain()
    {
        $this->withoutExceptionHandling();
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();
        
        
        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $createdTeam->id . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('test', Team::First()->name);

    }

    /** @test */
    public function A_Team_Cannot_Be_Updated_By_Player()
    {
        $this->withoutExceptionHandling();
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();
        
        
        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $createdTeam->id . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('test', Team::First()->name);

    }

    /** @test */
    public function A_Team_Can_Be_Deleted_By_Admin()
    {
        $this->withoutExceptionHandling();
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $createdTeam = Team::first();

        $this->assertCount(1 , Team::all());

        $delete = $this->delete('/teams/' . $createdTeam->id);
        $this->assertCount(0 , Team::all());

    }

    /** @test */
    public function A_Team_Cannot_Be_Deleted_By_Captain()
    {
        $this->withoutExceptionHandling();
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $createdTeam = Team::first();

        $this->assertCount(1 , Team::all());

        $delete = $this->delete('/teams/' . $createdTeam->id);
        $this->assertCount(1 , Team::all());

    }

    /** @test */
    public function A_Team_Cannot_Be_Deleted_By_Player()
    {
        $this->withoutExceptionHandling();
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();
        $this->addTeam();

        $createdTeam = Team::first();

        $this->assertCount(1 , Team::all());

        $delete = $this->delete('/teams/' . $createdTeam->id);
        $this->assertCount(1 , Team::all());

    }




}
