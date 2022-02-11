<?php

namespace Tests\Feature;

use App\Jobs\ProcessNewDonation;
use App\Models\Donation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DonationsTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_donation_functionality()
    {
        $this->post(
            '/donation/make',
            [
                'name' => 'Test3',
                'email' => 'test3@test.com',
                'donation' => 400.99,
                'message' => 'free message'
            ]
        );

        $this->assertDatabaseHas('donations', ['email' => 'test3@test.com']);
    }

    public function test_some_field_are_required() {
        $response = $this->post(
            '/donation/make',
            [
                'name' => '',
                'email' => '',
                'donation' => '',
                'message' => 'free message'
            ]
        );

        $response->assertSessionHasErrors(['name', 'email', 'donation']);
    }

    public function test_message_field_can_be_empty() {
        $this->post(
            '/donation/make',
            [
                'name' => 'Test3',
                'email' => 'test3@test.com',
                'donation' => 400.99,
                'message' => ''
            ]
        );

        $this->assertDatabaseHas('donations', ['email' => 'test3@test.com']);
    }

    public function test_donation_field_must_be_between_1_and_999999() {
        $response = $this->post(
            '/donation/make',
            [
                'name' => 'Test3',
                'email' => 'test3@test.com',
                'donation' => 1000200,
                'message' => ''
            ]
        );

        $response->assertSessionHasErrors(['donation']);
    }

    public function test_email_field_must_be_email() {
        $response = $this->post(
            '/donation/make',
            [
                'name' => 'Test3',
                'email' => 'test3',
                'donation' => 400.99,
                'message' => ''
            ]
        );

        $response->assertSessionHasErrors(['email']);
    }

    public function test_job_dispatch() {
        Queue::fake();

        Queue::assertNothingPushed();

        $entry = Donation::factory()->create();

        ProcessNewDonation::dispatch($entry);

        Queue::assertPushed(ProcessNewDonation::class, function($job) use ($entry){
            return $job->newEntry->image_url === $entry->image_url;
        });
    }
}
