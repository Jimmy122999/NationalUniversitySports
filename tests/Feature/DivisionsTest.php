<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DivisionsTest extends TestCase
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



   

    /** @test */
    public function An_Unauthenticated_User_Can_View_Divisions()
    {
        $divisions = factory('App\Division' , 5)->create(); //adds Divisions

        $sport = Sport::First();

        $response = $this->get('/sports/' . $sport->name);

        $response->assertOk();
    }
    
    /** @test */
    public function An_Admin_Can_View_Divisions()
    {

        $this->isAdmin();
        $divisions = factory('App\Division' , 5)->create();

        $sport = Sport::First();

        $response = $this->get('/sports/' . $sport->name);

        $response->assertOk();
    }

    /** @test */
    public function A_Captain_Can_View_Divisions()
    {

        $this->isCaptain();
        $divisions = factory('App\Division' , 5)->create();

        $sport = Sport::First();

        $response = $this->get('/sports/' . $sport->name);

        $response->assertOk();
    }

    /** @test */
    public function A_Player_Can_View_Divisions()
    {

        $this->isPlayer();
        $divisions = factory('App\Division' , 5)->create();

        $sport = Sport::First();

        $response = $this->get('/sports/' . $sport->name);

        $response->assertOk();
    }

    /** @test */
    public function A_Captain_Is_Unauthorized_From_Division_Create_Form()
    {
        $this->isCaptain();

        $response = $this->get('/sports/test/create')
        ->assertStatus(404);
    }

    /** @test */
    public function A_Player_Is_Unauthorized_From_Division_Create_Form()
    {
        $this->isPlayer();

        $response = $this->get('/sports/test/create')
        ->assertStatus(404);
    }

    /** @test */
    public function An_Admin_Can_Create_Divisions()
    {
        $this->withoutExceptionHandling();
        $this->addSport();

        $this->isAdmin();
        $sport = Sport::First();

        $response = $this->post('/sports/' . $sport->name, [
            'name' => 'test',
            'sport_id' => $sport->id
        ]);
        $this->assertCount(1 , Division::all());
        
    }

    /** @test */
    public function An_Admin_Cannot_Create_Divisions_With_Numbers()
    {
        // $this->withoutExceptionHandling();
        $this->addSport();

        $this->isAdmin();
        $sport = Sport::First();

        $response = $this->post('/sports/' . $sport->name, [
            'name' => 'test2',
            'sport_id' => $sport->id
        ]);
        $this->assertCount(0 , Division::all());
        
    }

    /** @test */
    public function An_Admin_Cannot_Create_Divisions_With_Too_Many_Characters()
    {
        // $this->withoutExceptionHandling();
        $this->addSport();

        $this->isAdmin();
        $sport = Sport::First();

        $response = $this->post('/sports/' . $sport->name, [
            'name' => 'testssssssssssssssssssssssssssssssssssssssssssssssssssssssssss',
            'sport_id' => $sport->id
        ]);
        $this->assertCount(0 , Division::all());
        
    }

    /** @test */
    public function A_Captain_Cannot_Create_Divisions()
    {
        $this->withoutExceptionHandling();
        $this->addSport();

        $this->isCaptain();
        $sport = Sport::First();

        $response = $this->post('/sports/' . $sport->name, [
            'name' => 'test',
            'sport_id' => $sport->id
        ]);
        $response->assertStatus(302); //Middleware Redirects
        $this->assertCount(0 , Division::all());
        
    }

    /** @test */
    public function A_Player_Cannot_Create_Divisions()
    {
        $this->withoutExceptionHandling();
        $this->addSport();

        $this->isCaptain();
        $sport = Sport::First();

        $response = $this->post('/sports/' . $sport->name, [
            'name' => 'test',
            'sport_id' => $sport->id
        ]);
        $response->assertStatus(302); //Middleware Redirects
        $this->assertCount(0 , Division::all());
        
    }

    /** @test */
    public function A_Division_Can_Be_Updated_By_Admin()
    {
        $this->withoutExceptionHandling();
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();

        
        $createdSport = Sport::first();
        $createdDivision = Division::first();

        $patch = $this->patch('/sports/' . $createdSport->name . '/' . $createdDivision->id . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('New Test', Division::First()->name);

    }

    /** @test */
    public function A_Division_Cannot_Be_Updated_By_Captain()
    {
        $this->withoutExceptionHandling();
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();

        
        $createdSport = Sport::first();
        $createdDivision = Division::first();

        $patch = $this->patch('/sports/' . $createdSport->name . '/' . $createdDivision->id . '/edit', [
            'name' => 'New Test'
        ]);
        $patch->assertStatus(302); //Middleware Redirects

        $this->assertEquals('test', Division::First()->name);

    }

    /** @test */
    public function A_Division_Cannot_Be_Updated_By_Player()
    {
        $this->withoutExceptionHandling();
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();

        
        $createdSport = Sport::first();
        $createdDivision = Division::first();

        $patch = $this->patch('/sports/' . $createdSport->name . '/' . $createdDivision->id . '/edit', [
            'name' => 'New Test'
        ]);
        $patch->assertStatus(302); //Middleware Redirects

        $this->assertEquals('test', Division::First()->name);

    }

    /** @test */
    public function A_Division_Can_Be_Deleted_By_Admin()
    {
        $this->withoutExceptionHandling();
        $this->isAdmin();
        $this->addSport();
        $this->addDivision();

        $createdSport = Sport::first();
        $createdDivision = Division::first();


        $this->assertCount(1 , Division::all());

        $delete = $this->delete('/sports/' . $createdSport->name . '/' . $createdDivision->id);
        $this->assertCount(0 , Division::all());

    }

    /** @test */
    public function A_Division_Cannot_Be_Deleted_By_Captain()
    {
        $this->withoutExceptionHandling();
        $this->isCaptain();
        $this->addSport();
        $this->addDivision();

        $createdSport = Sport::first();
        $createdDivision = Division::first();


        $this->assertCount(1 , Division::all());

        $response = $this->delete('/sports/' . $createdSport->name . '/' . $createdDivision->id);
        $response->assertStatus(302); //Middleware Redirects
        $this->assertCount(1 , Division::all());

    }

    /** @test */
    public function A_Division_Cannot_Be_Deleted_By_Player()
    {
        $this->withoutExceptionHandling();
        $this->isPlayer();
        $this->addSport();
        $this->addDivision();

        $createdSport = Sport::first();
        $createdDivision = Division::first();


        $this->assertCount(1 , Division::all());

        $response = $this->delete('/sports/' . $createdSport->name . '/' . $createdDivision->id);
        $response->assertStatus(302); //Middleware Redirects
        $this->assertCount(1 , Division::all());

    }






    // /** @test */
    // public function A_Sports_Divisions_Can_Be_Viewed_By_Unauthenticated_user()
    // {
    //     $this->isPlayer();

    //     $createdSport = Sport::create([
    //         'name' => 'test'
    //     ]);
    //     $this->assertCount(1 , Sport::all());

    //     $delete = $this->delete('/sports/' . $createdSport->name);
    //     $this->assertCount(1 , Sport::all());

    // }



}
