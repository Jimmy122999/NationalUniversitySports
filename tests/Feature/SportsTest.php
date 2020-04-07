<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SportsTest extends TestCase
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


    /** @test */
    public function An_Unauthenticated_User_Can_View_Sports()
    {
        $response = $this->get('/sports');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Sports()
    {
        $this->isAdmin();

        $response = $this->get('/sports')
        ->assertOk();
    }
    /** @test */
    public function A_Captain_Can_View_Sports()
    {
        $this->isCaptain();

        $response = $this->get('/sports')
        ->assertOk();
    }

    /** @test */
    public function A_Player_Can_View_Sports()
    {
        $this->isPlayer();

        $response = $this->get('/sports')
        ->assertOk();
    }

    /** @test */
    public function A_Captain_Is_Redirected_From_Sports_Create_Form()
    {
        $this->isCaptain();

        $response = $this->get('/sports/create')
        ->assertStatus(302);
    }

    /** @test */
    public function A_Player_Is_Redirected_From_Sports_Create_Form()
    {
        $this->isPlayer();

        $response = $this->get('/sports/create')
        ->assertStatus(302);
    }


    

    /** @test */
    public function A_Sport_Can_Be_Added_By_Admin()
    {
        $this->isAdmin();

        $response = $this->post('/sports', [
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());
    }

    /** @test */
    public function A_Numerical_Character_Sport_Cannot_Be_Added()
    {
        $this->isAdmin();

        $response = $this->post('/sports', [
            'name' => '1'
        ]);
        $this->assertCount(0 , Sport::all());
    }

    /** @test */
    public function A_Duplicate_Sport_Cannot_Be_Added()
    {
        $this->isAdmin();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);

        $response = $this->post('/sports', [
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());
    }

    /** @test */
    public function An_Unvalidated_Sport_Cannot_Be_Added()
    {
        $this->isAdmin();

        $response = $this->post('/sports', [
            'name' => '1'
        ]);
        $this->assertCount(0 , Sport::all());
    }

    /** @test */
    public function A_Sport_Cannot_Be_Added_By_Captain()
    {
        $this->isCaptain();

        $response = $this->post('/sports', [
            'name' => 'test'
        ]);
        $this->assertCount(0 , Sport::all());
    }

    /** @test */
    public function A_Sport_Cannot_Be_Added_By_Player()
    {
        $this->isPlayer();

        $response = $this->post('/sports', [
            'name' => 'test'
        ]);
        $this->assertCount(0 , Sport::all());
    }

    /** @test */
    public function A_Sport_Can_Be_Updated_By_Admin()
    {
        $this->isAdmin();

        $response = $this->post('/sports', [
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());
        $createdSport = Sport::first();

        $patch = $this->patch('/sports/' . $createdSport->name . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('New Test', Sport::First()->name);

    }

    /** @test */
    public function A_Sport_Cannot_Be_Updated_By_Captain()
    {
        $this->isCaptain();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);

        $patch = $this->patch('/sports/' . $createdSport->name . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('test', Sport::First()->name);
    }

    /** @test */
    public function A_Sport_Cannot_Be_Updated_By_Player()
    {
        $this->isPlayer();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);

        $patch = $this->patch('/sports/' . $createdSport->name . '/edit', [
            'name' => 'New Test'
        ]);

        $this->assertEquals('test', Sport::First()->name);
    }


    /** @test */
    public function A_Sport_Can_Be_Deleted_By_Admin()
    {
        $this->isAdmin();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());

        $delete = $this->delete('/sports/' . $createdSport->name);
        $this->assertCount(0 , Sport::all());

    }

    /** @test */
    public function A_Sport_Cannot_Be_Deleted_By_Captain()
    {
        $this->isCaptain();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());

        $delete = $this->delete('/sports/' . $createdSport->name);
        $this->assertCount(1 , Sport::all());

    }

    /** @test */
    public function A_Sport_Cannot_Be_Deleted_By_Player()
    {
        $this->isPlayer();

        $createdSport = Sport::create([
            'name' => 'test'
        ]);
        $this->assertCount(1 , Sport::all());

        $delete = $this->delete('/sports/' . $createdSport->name);
        $this->assertCount(1 , Sport::all());

    }

   



}
