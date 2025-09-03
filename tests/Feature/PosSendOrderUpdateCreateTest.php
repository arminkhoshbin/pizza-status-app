<?php

namespace Feature;

use App\Models\Order;
use App\Models\OrderHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Vite;
use PHPUnit\Framework\Attributes\Test;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

class PosSendOrderUpdateCreateTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->spy(Vite::class);
    }

    #[Test]
    public function it_requires_authentication(): void
    {
        $this->get(route('orders.send-update.create', $this->faker->uuid()))
            ->assertRedirect(route('login'));
    }

    #[Test]
    public function it_does_not_allow_viewing_update_status_page_when_order_does_not_belong_to_user(): void
    {
        $this->actingAs(User::factory()->create());

        $order = Order::factory([
            'user_id' => $this->faker->randomNumber(),
        ])->create();

        $this->get(route('orders.send-update.create', $order))
            ->assertStatus(403);
    }

    #[Test]
    public function it_renders_component(): void
    {
        $this->actingAs($user = User::factory()->create());

        $order = Order::factory([
            'user_id' => $user->id,
        ])->create();

        $this->get(route('orders.send-update.store', $order))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page->component('Pos/SendUpdate')
                ->where('order.id', $order->id)
                ->where('nextAvailableStatus.status', 'making')
            );
    }

    #[Test]
    public function it_can_calculate_the_next_available_status(): void
    {
        $this->actingAs($user = User::factory()->create());

        $order = Order::factory([
            'user_id' => $user->id,
        ])
            ->has(OrderHistory::factory(['status' => 'making']), 'history')
            ->has(OrderHistory::factory(['status' => 'cooking']), 'history')
            ->create();

        $this->get(route('orders.send-update.store', $order))
            ->assertSuccessful()
            ->assertInertia(fn (AssertableInertia $page) => $page
                ->where('nextAvailableStatus.status', 'ready')
            );
    }
}
