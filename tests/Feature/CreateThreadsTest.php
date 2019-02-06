<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test  */
    function an_authenticated_user_can_create_a_new_thead()
    {
        // get a user
        $this->signIn();

        // create a thread
        $thread = make('App\Thread');

        // post to the server
        $this->post('/threads', $thread->toArray());

        // get the created thread
        $this->get($thread->path_to_single_thread())

        ->assertSee($thread->title);
    }
}
