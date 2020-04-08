<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Sport;
use App\Division;
use App\Team;
use App\User;
use App\TeamMember;
use App\TeamApplicant;
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

    private function addMember()
    {
        TeamMember::create([
             'name' => 'testMember',
             'team_id' => 1,
             'user_id' => 1,


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
        $this->addMember();
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
        $this->addMember();

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
        $this->addMember();

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

     /** @test */
     public function A_Non_Member_Of_A_Team_Can_Access_Application_Create_Form()
     {
         
         $this->isPlayer();
         $this->addSport();
         $this->addDivision();
         $this->addTeam();
         
        

         $response = $this->get('/teams/1/apply');
         $response->assertOk(); //Unauthorized

         
         
     }

     /** @test */
     public function A_Member_Of_A_Team_Cannot_Access_Application_Create_Form()
     {
         
         $this->isPlayer();
         $this->addSport();
         $this->addDivision();
         $this->addTeam();
         $this->addMember();
        

         $response = $this->get('/teams/1/apply');
         $response->assertStatus(403); //Unauthorized

         
         
     }

     /** @test */
     public function A_Captain_Of_A_Team_Cannot_Access_Application_Create_Form()
     {
         
         $this->isCaptain();
         $this->addSport();
         $this->addDivision();
         $this->addTeamWithCaptain();
         $this->addMember();
        

         $response = $this->get('/teams/1/apply');
         $response->assertStatus(403); //Unauthorized

         
    }

    /** @test */
    public function An_Admin_Can_Accept_All_Teams_Applications()
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
        $this->addApplication();

        $team = Team::First();
        $application = TeamApplicant::First();

        $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/approve', [
            'name' => 'test',
            'team_id' => 1,
            'user_id' => 1,
        ]);

        $this->assertCount(1 , TeamMember::all());
     }

     /** @test */
     public function A_Captain_Can_Accept_Own_Teams_Applications()
     {
         

         $this->isCaptain();
         $this->addSport();
         $this->addDivision();
         $this->addTeamWithCaptain();
         $this->addMember();

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

         $this->addApplication();

         $team = Team::First();
         $application = TeamApplicant::First();

         $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/approve', [
             'name' => 'test',
             'team_id' => 1,
             'user_id' => 1,
         ]);

         $this->assertCount(2 , TeamMember::all());
      }

      /** @test */
      public function A_Captain_Cannot_Accept_Other_Teams_Applications()
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

          $this->isCaptain();
          $this->addSport();
          $this->addDivision();
          $this->addTeamWithCaptain();

          

          $this->addApplication();

          $team = Team::First();
          $application = TeamApplicant::First();

          $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/approve', [
              'name' => 'test',
              'team_id' => 1,
              'user_id' => 1,
          ]);
          $response->assertStatus(403); //Unauthorized
          $this->assertCount(0 , TeamMember::all());
       }

       /** @test */
       public function A_Player_Cannot_Accept_Other_Teams_Applications()
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

           

           $this->addApplication();

           $team = Team::First();
           $application = TeamApplicant::First();

           $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/approve', [
               'name' => 'test',
               'team_id' => 1,
               'user_id' => 1,
           ]);
           $response->assertStatus(403); //Unauthorized
           $this->assertCount(0 , TeamMember::all());
        }

        /** @test */
        public function A_Player_Cannot_Accept_Own_Teams_Applications()
        {
            

            $this->isPlayer();
            $this->addSport();
            $this->addDivision();
            $this->addTeam();
            $this->addMember();
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

            

            $this->addApplication();

            $team = Team::First();
            $application = TeamApplicant::First();

            $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/approve', [
                'name' => 'test',
                'team_id' => 1,
                'user_id' => 1,
            ]);
            $response->assertStatus(403); //Unauthorized
            $this->assertCount(1 , TeamMember::all()); //The 1 member is the player trying to accept the application
         }

        

          /** @test */
          public function An_Admin_Can_Deny_All_Teams_Applications()
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
              $this->addApplication();

              $team = Team::First();
              $application = TeamApplicant::First();

              $delete = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/deny');
              $this->assertCount(0 , TeamApplicant::all());

              
           }

           /** @test */
           public function A_Captain_Can_Deny_Own_Teams_Applications()
           {
               

               $this->isCaptain();
               $this->addSport();
               $this->addDivision();
               $this->addTeamWithCaptain();

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
               $this->addApplication();

               $team = Team::First();
               $application = TeamApplicant::First();

               $delete = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/deny');
               $this->assertCount(0 , TeamApplicant::all());

               
            }

            /** @test */
            public function A_Captain_Cannot_Deny_Other_Teams_Applications()
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

                $this->isCaptain();
                $this->addSport();
                $this->addDivision();
                $this->addTeamWithCaptain();

               
                $this->addApplication();

                $team = Team::First();
                $application = TeamApplicant::First();

                $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/deny');

                $response->assertStatus(403); //Unauthorized
                $this->assertCount(1 , TeamApplicant::all());

                
             }

             /** @test */
             public function A_Player_Cannot_Deny_Other_Teams_Applications()
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

                
                 $this->addApplication();

                 $team = Team::First();
                 $application = TeamApplicant::First();

                 $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/deny');

                 $response->assertStatus(403); //Unauthorized
                 $this->assertCount(1 , TeamApplicant::all());

                 
              }

              /** @test */
              public function A_Player_Cannot_Deny_Own_Teams_Applications()
              {
                 

                  $this->isPlayer();
                  $this->addSport();
                  $this->addDivision();
                  $this->addTeam();
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

                 
                  $this->addApplication();

                  $team = Team::First();
                  $application = TeamApplicant::First();

                  $response = $this->post('/teams/' . $team->id . '/' . $application->id . '/applications/deny');

                  $response->assertStatus(403); //Unauthorized
                  $this->assertCount(1 , TeamApplicant::all());

                  
               }







         








}
