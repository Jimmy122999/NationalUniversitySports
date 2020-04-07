<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\Team;
use App\TeamMember;
use App\User;
use App\TeamPost;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TeamPostsTest extends TestCase
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
            'name' => 'test',
            'division_id' => '1',
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);

        


    }
    private function addMember()
    {
        TeamMember::create([
             'name' => 'testMember',
             'team_id' => 1,
             'user_id' => 1,


        ]);

    }

    private function addTeamPost()
    {
        TeamPost::create([
            'member_id' => 1,
            'team_id' => 1,
            'body' => 'testing post'
        ]);

    }

    /** @test */
    public function Team_Posts_Can_Be_Created_By_Members_Who_Are_Admins()
    {
        $this->populateData();
        $this->isAdmin();
        $this->addMember();
        
        $team = Team::first();
        $member = TeamMember::first();

        $response = $this->post('/teams/' . $team->id . '/' . $member->id . '/post', [
            'member_id' => $member->id,
            'team_id' => $team->id,
            'body' => 'Test Post'
        ]);
        $this->assertCount(1 , TeamPost::all());
        
    }

    /** @test */
    public function Team_Posts_Can_Be_Created_By_Members_Who_Are_Captains()
    {
        $this->populateData();
        $this->isCaptain();
        $this->addMember();
        
        $team = Team::first();
        $member = TeamMember::first();

        $response = $this->post('/teams/' . $team->id . '/' . $member->id . '/post', [
            'member_id' => $member->id,
            'team_id' => $team->id,
            'body' => 'Test Post'
        ]);
        $this->assertCount(1 , TeamPost::all());
        
    }

    /** @test */
    public function Team_Posts_Can_Be_Created_By_Members_Who_Are_Players()
    {
        $this->populateData();
        $this->isPlayer();
        $this->addMember();
        
        $team = Team::first();
        $member = TeamMember::first();

        $response = $this->post('/teams/' . $team->id . '/' . $member->id . '/post', [
            'member_id' => $member->id,
            'team_id' => $team->id,
            'body' => 'Test Post'
        ]);
        $this->assertCount(1 , TeamPost::all());
        
    }

    /** @test */
    public function Team_Posts_Can_Be_Updated_By_Members_Who_Are_Admins()
    {
        
        $this->populateData();
        $this->isAdmin();
        $this->addMember();
        $this->addTeamPost();
        
        $team = Team::first();
        $member = TeamMember::first();
        $post = TeamPost::first();

        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $team->id . '/' . $member->id . '/post/' . $post->id . '/edit', [
            'body' => 'New Test'
        ]);

        $this->assertEquals('New Test', TeamPost::First()->body);
        
    }

    /** @test */
    public function Team_Posts_Can_Be_Updated_By_Members_Who_Are_Captains()
    {
        
        $this->populateData();
        $this->isCaptain();
        $this->addMember();
        $this->addTeamPost();
        
        $team = Team::first();
        $member = TeamMember::first();
        $post = TeamPost::first();

        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $team->id . '/' . $member->id . '/post/' . $post->id . '/edit', [
            'body' => 'New Test'
        ]);

        $this->assertEquals('New Test', TeamPost::First()->body);
        
    }


    /** @test */
    public function Team_Posts_Can_Be_Updated_By_Members_Who_Are_Players()
    {
        
        $this->populateData();
        $this->isPlayer();
        $this->addMember();
        $this->addTeamPost();
        
        $team = Team::first();
        $member = TeamMember::first();
        $post = TeamPost::first();

        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $team->id . '/' . $member->id . '/post/' . $post->id . '/edit', [
            'body' => 'New Test'
        ]);

        $this->assertEquals('New Test', TeamPost::First()->body);
        
    }





        
}
