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
            'division_id' => 1,
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);

        


    }

    private function populateDataWithPost()
    {
       $sport1 = Sport::create([
            'name' => 'test'
        ]);

       $div1 = Division::create([
            'name' => 'test',
            'sport_id' => $sport1->id
        ]);

        $team1 =Team::create([
            'name' => 'test',
            'division_id' => $div1->id,
            'played' => '0',
            'wins' => '0',
            'draws' => '0',
            'losses' => '0',
            'points' => '0',
        ]);

        $member1 =TeamMember::create([
             'name' => 'testMember',
             'team_id' => $team1->id,
             'user_id' => 1,


        ]);

        $post1 = TeamPost::create([
            'member_id' => $member1->id,
            'team_id' => $team1->id,
            'body' => 'testing post'
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
    public function Team_Posts_Cannot_Be_Created_By_Unauthenticated_Users()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'remember_token' => 'asdfasf',
            'user_group' => 3,
            'hasTeam' => 0,
            'hasProfile' => 0,

        ]);
        $this->populateData();
        $this->addMember();
        
        $team = Team::first();
        $member = TeamMember::first();

        $response = $this->post('/teams/' . $team->id . '/' . $member->id . '/post', [
            'member_id' => $member->id,
            'team_id' => $team->id,
            'body' => 'Test Post'
        ]);
        $this->assertCount(0 , TeamPost::all());
        
    }

    /** @test */
    public function Team_Posts_Cannot_Be_Created_By_Non_Team_Members()
    {
        $this->populateData();
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
            'remember_token' => 'asdfasf',
            'user_group' => 3,
            'hasTeam' => 0,
            'hasProfile' => 0,

        ]);
        $this->addMember(); //Adds the previously created user to the team so that isPlayer() user is not added to the team

        $this->isPlayer();
        
        $team = Team::first();
        $member = TeamMember::first();

        $response = $this->post('/teams/' . $team->id . '/' . $member->id . '/post', [
            'member_id' => $member->id,
            'team_id' => $team->id,
            'body' => 'Test Post'
        ]);
        $this->assertCount(0 , TeamPost::all());
        
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
    public function Team_Posts_Can_Be_Updated_By_Members_Who_Are_Captains_That_Own_The_Post()
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
    public function Team_Posts_Can_Be_Updated_By_Members_Who_Are_Players_That_Own_The_Post()
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

    /** @test */
    public function Team_Posts_Can_Be_Updated_By_Admins_Who_Are_Not_Owners_Of_The_Post()
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
        $this->populateDataWithPost();
        $this->isAdmin();
     
        
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
    public function Team_Posts_Cannot_Be_Updated_By_Members_Who_Are_Not_Owners_Of_The_Post()
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
        $this->populateDataWithPost();
        $this->isPlayer();
     
        
        $team = Team::first();
        $member = TeamMember::first();
        $post = TeamPost::first();

        $createdTeam = Team::first();

        $patch = $this->patch('/teams/' . $team->id . '/' . $member->id . '/post/' . $post->id . '/edit', [
            'body' => 'New Test'
        ]);

        $this->assertEquals('testing post', TeamPost::First()->body);
        
        
    }

    /** @test */
    public function A_Captain_Is_Unauthorized_From_Post_Edit_Form_If_Not_Owner()
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
        $this->populateDataWithPost();
        $this->isCaptain();        

        $response = $this->get('/teams/1/1/post/1/edit')
        ->assertStatus(403);
    }

    /** @test */
    public function A_Player_Is_Unauthorized_From_Post_Edit_Form_If_Not_Owner()
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
        $this->populateDataWithPost();
        $this->isPlayer();        

        $response = $this->get('/teams/1/1/post/1/edit')
        ->assertStatus(403);
    }


    /** @test */
    public function Any_Team_Post_Can_Be_Deleted_By_Admin()
    {
        $this->withoutExceptionHandling();
        $this->populateData();
        $this->isAdmin();
        $this->addMember();
        $this->addTeamPost();
       
        
        
      

        $createdTeam = Team::first();
        $createdMember = TeamMember::first();
        $createdPost = TeamPost::First();

        

        $delete = $this->delete('/teams/' . $createdTeam->id . '/' . $createdMember->id . '/post/' . $createdPost->id);
        $this->assertCount(0 , TeamPost::all());

    }

    /** @test */
    public function A_Captain_Can_Delete_Their_Own_Team_Post()
    {
      
        $this->populateData();
        $this->isCaptain();
        $this->addMember();
        $this->addTeamPost();
       
        
        
      

        $createdTeam = Team::first();
        $createdMember = TeamMember::first();
        $createdPost = TeamPost::First();

        

        $delete = $this->delete('/teams/' . $createdTeam->id . '/' . $createdMember->id . '/post/' . $createdPost->id);
        $this->assertCount(0 , TeamPost::all());

    }

    /** @test */
    public function A_Player_Can_Delete_Their_Own_Team_Post()
    {
       
        $this->populateData();
        $this->isPlayer();
        $this->addMember();
        $this->addTeamPost();
       
        
        
      

        $createdTeam = Team::first();
        $createdMember = TeamMember::first();
        $createdPost = TeamPost::First();

        

        $delete = $this->delete('/teams/' . $createdTeam->id . '/' . $createdMember->id . '/post/' . $createdPost->id);
        $this->assertCount(0 , TeamPost::all());

    }

    /** @test */
    public function A_Captain_Cannot_Delete_Others_Team_Post()
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
        $this->populateDataWithPost();
        $this->isCaptain();        
            
        
      

        $createdTeam = Team::first();
        $createdMember = TeamMember::first();
        $createdPost = TeamPost::First();

        

        $delete = $this->delete('/teams/' . $createdTeam->id . '/' . $createdMember->id . '/post/' . $createdPost->id);
        $this->assertCount(1 , TeamPost::all());

    }

    /** @test */
    public function A_Player_Cannot_Delete_Others_Team_Post()
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
        $this->populateDataWithPost();
        $this->isPlayer();        
            
        
      

        $createdTeam = Team::first();
        $createdMember = TeamMember::first();
        $createdPost = TeamPost::First();

        

        $delete = $this->delete('/teams/' . $createdTeam->id . '/' . $createdMember->id . '/post/' . $createdPost->id);
        $this->assertCount(1 , TeamPost::all());

    }
   




        
}


