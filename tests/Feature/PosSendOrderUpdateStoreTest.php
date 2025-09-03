<?php

namespace Tests\Feature;

use App\Events\PizzaStatusUpdated;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PosSendOrderUpdateStoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        Event::fake();
    }

    #[Test]
    public function it_requires_authentication(): void
    {
        $this->postJson(route('orders.send-update.store', $this->faker->uuid()), [
            'status' => 'making',
        ])
            ->assertUnauthorized();
    }

    #[Test]
    public function it_creates_an_order_history_record(): void
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory()->create();

        $this->postJson(route('orders.send-update.store', $order), [
            'status' => 'making',
        ])
            ->assertRedirectBack();

        $this->assertDatabaseHas('order_histories', [
            'order_id' => $order->id,
            'status' => 'making',
        ]);
    }

    #[Test]
    public function it_dispatches_an_event(): void
    {
        $this->actingAs($user = User::factory()->create());

        $this->postJson(route('orders.send-update.store', $order = Order::factory()->create()), [
            'status' => 'making',
        ])
            ->assertRedirectBack();

        Event::assertDispatched(PizzaStatusUpdated::class, fn (PizzaStatusUpdated $event) =>
            $event->status === 'making' &&
            $event->order->is($order) &&
            $event->userId === $user->id
        );
    }

    #[Test]
    public function it_flashes_a_message_to_session(): void
    {
        $this->actingAs(User::factory()->create());

        $this->postJson(route('orders.send-update.store', Order::factory()->create()), [
            'status' => 'ready',
        ])
            ->assertSessionHas('flash', 'Pizza status updated to ready!');
    }
}
