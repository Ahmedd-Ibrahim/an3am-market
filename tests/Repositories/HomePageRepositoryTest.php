<?php namespace Tests\Repositories;

use App\Models\HomePage;
use App\Repositories\HomePageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class HomePageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var HomePageRepository
     */
    protected $homePageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->homePageRepo = \App::make(HomePageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_home_page()
    {
        $homePage = factory(HomePage::class)->make()->toArray();

        $createdHomePage = $this->homePageRepo->create($homePage);

        $createdHomePage = $createdHomePage->toArray();
        $this->assertArrayHasKey('id', $createdHomePage);
        $this->assertNotNull($createdHomePage['id'], 'Created HomePage must have id specified');
        $this->assertNotNull(HomePage::find($createdHomePage['id']), 'HomePage with given id must be in DB');
        $this->assertModelData($homePage, $createdHomePage);
    }

    /**
     * @test read
     */
    public function test_read_home_page()
    {
        $homePage = factory(HomePage::class)->create();

        $dbHomePage = $this->homePageRepo->find($homePage->id);

        $dbHomePage = $dbHomePage->toArray();
        $this->assertModelData($homePage->toArray(), $dbHomePage);
    }

    /**
     * @test update
     */
    public function test_update_home_page()
    {
        $homePage = factory(HomePage::class)->create();
        $fakeHomePage = factory(HomePage::class)->make()->toArray();

        $updatedHomePage = $this->homePageRepo->update($fakeHomePage, $homePage->id);

        $this->assertModelData($fakeHomePage, $updatedHomePage->toArray());
        $dbHomePage = $this->homePageRepo->find($homePage->id);
        $this->assertModelData($fakeHomePage, $dbHomePage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_home_page()
    {
        $homePage = factory(HomePage::class)->create();

        $resp = $this->homePageRepo->delete($homePage->id);

        $this->assertTrue($resp);
        $this->assertNull(HomePage::find($homePage->id), 'HomePage should not exist in DB');
    }
}
