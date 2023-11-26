<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Course;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_courses_list()
    {
        $courses = Course::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.courses.index'));

        $response->assertOk()->assertSee($courses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_course()
    {
        $data = Course::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.courses.store'), $data);

        $this->assertDatabaseHas('courses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_course()
    {
        $course = Course::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(route('api.courses.update', $course), $data);

        $data['id'] = $course->id;

        $this->assertDatabaseHas('courses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson(route('api.courses.destroy', $course));

        $this->assertSoftDeleted($course);

        $response->assertNoContent();
    }
}
