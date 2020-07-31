<?php

namespace Tests\Feature\controllers;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dingo\Api\Routing\UrlGenerator;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

class NewsControllerTest extends TestCase
{

    protected $token;
    protected $user;


    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /*public function testCanGetListOfNews()
    {
        $this->actingAs($this->user)
            ->patchJson('api/news', [])
            ->assertSuccessful()
            ->assertJsonStructure([
                'data' => ['*' => [
                    'id',
                    'user_id',
                    'title',
                    'body',
                    'created_at',
                    'updated_at',
                    'comments' => ['*' => []]
                ]],
                'total',
                'count',
                'per_page',
                'current_page',
                'total_pages',
                'links',

            ]);

        $this->assertDatabaseHas('users', [
            'id' => $this->user->id,
            'name' => 'Test User',
            'email' => 'test@test.app',
        ]);
    }*/
     public function testCanGetListOfNews()
     {
         $this->user = factory(User::class)->create();


         //dd(auth()->guard('api'));
         $this->actingAs($this->user);

         $this->get(
             'api/news'
//             ['Accept' => 'application/json', 'Authorization' => 'Bearer ' . $this->token]
         )
             ->assertStatus(200)
             ->assertJsonStructure([
                 'data' => ['*' => [
                     'id',
                     'user_id',
                     'title',
                     'body',
                     'created_at',
                     'updated_at',
                     'comments' => ['*' => []]
                 ]],
                 'meta' => [
                     'pagination' => [
                         'total',
                         'count',
                         'per_page',
                         'current_page',
                         'total_pages',
                         'links',
                     ]
                 ]
             ]);
     }
}
