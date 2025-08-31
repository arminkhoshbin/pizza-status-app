<?php

namespace Tests\Feature;

use App\Events\PizzaStatusUpdated;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PosSendUpdateStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    #[Test]
    public function it_requires_authentication(): void
    {
        $this->postJson(route('pos.send-update.store'), [
            'status' => 'making',
        ])
            ->assertUnauthorized();
    }

    #[Test]
    public function it_dispatches_an_event(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->postJson(route('pos.send-update.store'), [
            'status' => 'making',
        ])
            ->assertRedirectBack();

        Event::assertDispatched(PizzaStatusUpdated::class, fn (PizzaStatusUpdated $event) =>
            $event->status === 'making' && $event->userId === $user->id
        );
    }

    #[Test]
    public function it_flashes_a_message_to_session(): void
    {
        $this->actingAs(User::factory()->create());

        $this->postJson(route('pos.send-update.store'), [
            'status' => 'ready',
        ])
            ->assertSessionHas('flash', 'Pizza status updated to ready!');
    }
}
