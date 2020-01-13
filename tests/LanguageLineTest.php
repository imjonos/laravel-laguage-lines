<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\{LanguageLine, User};

class LanguageLineTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Index LanguageLine functionality
     *
     * @return void
     */
    public function testIndex()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('get', 'admin/languagelines');
        $response->assertStatus(200)
        ->assertJson([
            'data' => [
                'current_page' => true,
                'data' => [[
                    'group' => true,
                    'key' => true,
                    'text' => true,

                ]],
                'first_page_url' => true,
                'from' => true,
                'last_page' => true,
                'last_page_url' => true,
                'path' => true,
                'per_page' => true,
                'to' => true,
                'total' => true
            ]
        ])
        ->assertJsonCount(10, 'data.data');
    }

    /**
     * Test Create LanguageLine functionality
     *
     * @return void
     */
    public function testCreate()
    {
        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('get', 'admin/languagelines/create');
        $response->assertStatus(200)
        ->assertViewIs('admin.languagelines.create');
    }

    /**
     * Test Store LanguageLine functionality
     *
     * @return void
     */
    public function testStore()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $languageline = LanguageLine::firstOrFail();

        $data = [
            'group' => $languageline->group,
            'key' => $languageline->key,
            'text' => $languageline->text,

        ];

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('post', 'admin/languagelines', $data);
        $response->assertStatus(201);
        unset($data['text']);
        $this->assertDatabaseHas('language_lines', $data);
    }

    /**
     * Test Show LanguageLine functionality
     *
     * @return void
     */
    public function testShow()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $languageline = LanguageLine::firstOrFail();

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('get', 'admin/languagelines/' . $languageline->id);
        $response->assertStatus(200)
        ->assertViewIs('admin.languagelines.show');
    }

    /**
     * Test Edit LanguageLine functionality
     *
     * @return void
     */
    public function testEdit()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $languageline = LanguageLine::firstOrFail();

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('get', 'admin/languagelines/' . $languageline->id . '/edit');
        $response->assertStatus(200)
        ->assertViewIs('admin.languagelines.edit');
    }

    /**
     * Test Update LanguageLine functionality
     *
     * @return void
     */
    public function testUpdate()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $languageline = LanguageLine::orderBy('id', 'desc')->first();

        $data = [
            'group' => $languageline->group,
            'key' => $languageline->key,
        ];

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('put', 'admin/languagelines/' . $languageline->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('language_lines', $data);
    }

    /**
     * Test Destroy LanguageLine functionality
     *
     * @return void
     */
    public function testDestroy()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $languageline = LanguageLine::firstOrFail();

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('delete', 'admin/languagelines/' . $languageline->id);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('language_lines', [
            'id' => $languageline->id
        ]);
    }

    /**
     * Test Mass Destroy LanguageLine functionality
     *
     * @return void
     */
    public function testMassDestroy()
    {
        $this->seed(\LanguageLinesTableSeeder::class);

        $data = [
            'selected' => [LanguageLine::firstOrFail()->id]
        ];

        $admin = User::Role('Administrator')->firstOrFail();

        $response = $this->actingAs($admin)->ajax('post', 'admin/languagelines/massdestroy', $data);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('language_lines', [
            'id' => $data['selected']
        ]);
    }
}
