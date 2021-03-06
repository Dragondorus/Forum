<?php

namespace Tests\Feature;

use App\Models\Thread;
use App\Models\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp(): void
    {
        parent::setUp();

        $this->thread = create(Thread::class);

    }

    /** @test */

    public function a_user_can_view_all_threads()
    {

        $this->get('/threads')
            ->assertSee($this->thread->title);

    }

    /** @test */

    public function a_user_can_read_a_single_thread()
    {

        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    /** @test */

    public function a_user_can_read_a_thread_associated_with_a_thread()
    {
        $reply = create(Reply::class, ['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }


}
