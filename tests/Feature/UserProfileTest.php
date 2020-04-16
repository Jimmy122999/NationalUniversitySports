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
use App\UserProfile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserProfileTest extends TestCase
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

        TeamMember::create([
            'name' => 'testMember',
            'team_id' => 1,
            'user_id' => 1,


        ]);

        


    }

    private function addProfile()
    {
         UserProfile::create([
             'user_id' => 1,
             'team_id' => 1,
             'team_member_id' => 1,
             'position' => "Goalkeeper",
             'bio' => "test"


          ]);
    }

    /** @test */
    public function An_Unauthenticated_User_Can_View_Profiles()
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
        $this->addProfile();

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Own_Profiles()
    {
        $this->isAdmin();
        $this->populateData();
        $this->addProfile();

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Captain_Can_View_Own_Profiles()
    {
        $this->isCaptain();
        $this->populateData();
        $this->addProfile();

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Player_Can_View_Own_Profiles()
    {
        $this->isPlayer();
        $this->populateData();
        $this->addProfile();

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function An_Admin_Can_View_Others_Profiles()
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
        $this->addProfile();

        $this->isAdmin(); //Makes Populated Data assign a profile to the created user

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Captian_Can_View_Others_Profiles()
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
        $this->addProfile();

        $this->isCaptain(); //Makes Populated Data assign a profile to the created user

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Player_Can_View_Others_Profiles()
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
        $this->addProfile();

        $this->isPlayer(); //Makes Populated Data assign a profile to the created user

        $response = $this->get('/profile/1');

        $response->assertOk();
    }

    /** @test */
    public function A_Member_Of_A_Team_Can_Access_User_Profile_Create_Form()
    {
        
        $this->isPlayer();
        $this->populateData();

        $response = $this->get('/profile/create');
        $response->assertOk();

        
        
    }

    /** @test */
    public function A_Captain_Of_A_Team_Can_Access_User_Profile_Create_Form()
    {
        
        $this->isCaptain();
        $this->populateData();

        $response = $this->get('/profile/create');
        $response->assertOk();

        
        
    }

    /** @test */
    public function A_Non_Team_Member_Is_Unauthorized_From_User_Profile_Create_Form()
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
        $this->isPlayer();

        $response = $this->get('/profile/create');
        $response->assertStatus(403);
    }

    /** @test */
    public function A_Member_Of_A_Team_Can_Create_A_Profile()
    {
        
        $this->isPlayer();
        $this->populateData();
         

        $response = $this->post('/profile/create', [
            'user_id' => 1,
            'team_id' => 1,
            'team_member_id' => 1,
            'position' => "Goalkeeper",
            'bio' => "test"
        ]);
        $this->assertCount(1 , UserProfile::all());
        
    }

    /** @test */
    public function A_Captain_Of_A_Team_Can_Create_A_Profile()
    {
        
        $this->isCaptain();
        $this->populateData();
         

        $response = $this->post('/profile/create', [
            'user_id' => 1,
            'team_id' => 1,
            'team_member_id' => 1,
            'position' => "Goalkeeper",
            'bio' => "test"
        ]);
        $this->assertCount(1 , UserProfile::all()); //Profile Created
        
    }

    /** @test */
    public function A_Non_Member_Of_A_Team_Cannot_Create_A_Profile()
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
        $this->isPlayer();
         

        $response = $this->post('/profile/create', [
            'user_id' => 1,
            'team_id' => 1,
            'team_member_id' => 1,
            'position' => "Goalkeeper",
            'bio' => "test"
        ]);
        $this->assertCount(0 , UserProfile::all()); //Profile Not Created
        
    }

    /** @test */
    public function A_Profile_Cannot_Submit_Invalid_Data()
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
        $this->isPlayer();
        

        $response = $this->post('/profile/create', [
            'position' => '',
            'bio' => 'test data'
        ]);
        $this->assertCount(0 , UserProfile::all());
        
    }


    /** @test */
    public function Any_Profile_Can_Be_Updated_By_Admin()
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
        $this->withoutExceptionHandling();
        $this->populateData();
        $this->addProfile();

        $this->isAdmin();
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);

        $this->assertEquals('Defender', UserProfile::First()->position);

    }

    /** @test */
    public function Any_Profile_Cannot_Be_Updated_By_Captain()
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
        $this->addProfile();

        $this->isCaptain();
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);


        $this->assertEquals('Goalkeeper', UserProfile::First()->position);

    }

    /** @test */
    public function Any_Profile_Cannot_Be_Updated_By_Player()
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
        $this->addProfile();

        $this->isPlayer();
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);
        

        $this->assertEquals('Goalkeeper', UserProfile::First()->position);

    }

    /** @test */
    public function Captain_Can_Update_Own_Profile()
    {
        $this->isCaptain();
        
        $this->populateData();
        $this->addProfile();

        
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);


        $this->assertEquals('Defender', UserProfile::First()->position);

    }

    /** @test */
    public function Player_Can_Update_Own_Profile()
    {
      
        $this->isPlayer();
        $this->populateData();
        $this->addProfile();

        
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);


        $this->assertEquals('Defender', UserProfile::First()->position);

    }

    /** @test */
    public function Captain_Cannot_Update_Others_Profile()
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
        $this->addProfile();

        $this->isCaptain();
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);


        $this->assertEquals('Goalkeeper', UserProfile::First()->position);

    }

    /** @test */
    public function Player_Cannot_Update_Others_Profile()
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
        $this->addProfile();

        $this->isPlayer();
        
        
        $createdProfile = UserProfile::first();

        $patch = $this->patch('/profile/' . $createdProfile->id . '/edit', [
            'bio' => 'test',
            'position' => 'Defender'
        ]);


        $this->assertEquals('Goalkeeper', UserProfile::First()->position);

    }












   




        
}


