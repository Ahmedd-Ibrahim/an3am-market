<?php namespace Tests\Repositories;

use App\Models\Settings;
use App\Repositories\SettingsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SettingsRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SettingsRepository
     */
    protected $settingsRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->settingsRepo = \App::make(SettingsRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_settings()
    {
        $settings = factory(Settings::class)->make()->toArray();

        $createdSettings = $this->settingsRepo->create($settings);

        $createdSettings = $createdSettings->toArray();
        $this->assertArrayHasKey('id', $createdSettings);
        $this->assertNotNull($createdSettings['id'], 'Created Settings must have id specified');
        $this->assertNotNull(Settings::find($createdSettings['id']), 'Settings with given id must be in DB');
        $this->assertModelData($settings, $createdSettings);
    }

    /**
     * @test read
     */
    public function test_read_settings()
    {
        $settings = factory(Settings::class)->create();

        $dbSettings = $this->settingsRepo->find($settings->id);

        $dbSettings = $dbSettings->toArray();
        $this->assertModelData($settings->toArray(), $dbSettings);
    }

    /**
     * @test update
     */
    public function test_update_settings()
    {
        $settings = factory(Settings::class)->create();
        $fakeSettings = factory(Settings::class)->make()->toArray();

        $updatedSettings = $this->settingsRepo->update($fakeSettings, $settings->id);

        $this->assertModelData($fakeSettings, $updatedSettings->toArray());
        $dbSettings = $this->settingsRepo->find($settings->id);
        $this->assertModelData($fakeSettings, $dbSettings->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_settings()
    {
        $settings = factory(Settings::class)->create();

        $resp = $this->settingsRepo->delete($settings->id);

        $this->assertTrue($resp);
        $this->assertNull(Settings::find($settings->id), 'Settings should not exist in DB');
    }
}
