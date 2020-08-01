<?php

namespace Tests\Feature\controllers;

use App\Models\News;
use App\Models\User;
use Tests\TestCase;
use Dingo\Api\Routing\UrlGenerator;

class NewsControllerTest extends TestCase
{


    public function setUp(): void
    {
        parent::setUp();

    }

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCanGetListOfNews()
    {

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api')
            ->json('get', 'api/news', [])
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

                "first_page_url",
                "from",
                "last_page",
                "last_page_url",
                "next_page_url",
                "path",
                "per_page",
                "prev_page_url",
                "to",
                "total"

            ]);

    }


    public function testCanStoreNews()
    {

        $news = factory(News::class)->create();
        $user = factory(User::class)->create();

        $this->actingAs($user, 'api')
            ->json('post', 'api/news', ['title' => $news->title . rand(1, 100), 'body' => $news->body])
            ->assertStatus(201)
            ->assertJsonStructure([
                "title",
                "body",
                "user_id",
                "updated_at",
                "created_at",
                "id"
            ]);

    }

    public function testCanUpdateNews()
    {
        $user = factory(User::class)->create();
        $news = factory(News::class)->create(['user_id' => $user->id]);

        $this->actingAs($user, 'api')
            ->json('patch', 'api/news/' . $news->id, ['title' => $news->title . rand(1, 100), 'body' => $news->body . $news->body])
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
            ]);
    }

    public function testCanDeleteNews()
    {
        $user = factory(User::class)->create();
        $news = factory(News::class)->create(['user_id' => $user->id]);

        $this->actingAs($user, 'api')
            ->json('delete', 'api/news/' . $news->id)
            ->assertStatus(200)
            ->assertJsonStructure([
                "message",
            ]);
    }
}
