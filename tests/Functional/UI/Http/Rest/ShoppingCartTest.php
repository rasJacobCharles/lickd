<?php

declare(strict_types=1);

namespace Tests\Functional\UI\Http\Rest;

use App\Domain\Item\Entity\Song;
use App\Infrastructure\Shared\DataFixture\SongsDataFixture;
use App\Infrastructure\Shared\DataFixture\SubscriberDataFixture;
use App\Infrastructure\User\DataFixture\UserDataFixture;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\DBAL\DBALException;
use Doctrine\ORM\EntityManagerInterface;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShoppingCartTest extends WebTestCase
{
    use FixturesTrait;

    public function testSuccessGetListOfTracks()
    {
        $client = static::createClient();
        $client->request(
            'GET',
            '/api/v1/list',
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Bitter Sweet Symphony', $client->getResponse()->getContent());
        $this->assertContains('I Want Freedom', $client->getResponse()->getContent());
        $this->assertContains('Green Onions', $client->getResponse()->getContent());
    }

    public function testCreateBasketSuccessTest()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/v1/basket',
            );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Basket ID:', $client->getResponse()->getContent());
    }

    public function testCreateBasketAndSongsToBasketSuccessTest()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/v1/basket',
            );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('Basket ID:', $client->getResponse()->getContent());

    }

    /**
     * @throws DBALException
     */
    protected function setUp(): void
    {
        self::bootKernel();
        $this->truncateEntities();
        $this->loadFixtures(
            [
                SongsDataFixture::class,
            ]
        );
    }

    /**
     * @throws DBALException
     */
    private function truncateEntities()
    {
        $purger = new ORMPurger($this->getEntityManager());
        $purger->purge();
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }
}
