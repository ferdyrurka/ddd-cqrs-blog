<?php
declare(strict_types=1);

namespace App\Tests\Integration\Controller;

use App\Domain\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Client;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlogControllerTest
 * @package App\Tests\Integration\Controller
 */
class BlogControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        $this->client = self::createClient();
        $this->client->setServerParameters([
            'HTTP_HOST' => 'localhost',
            'HTTP_USER_AGENT' => 'TESTS USER'
        ]);

        parent::setUp();
    }

    public function testIndexAction(): void
    {
        $this->client->request('GET', '/');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testAddPostAction(): void
    {
        $this->client->request('GET', '/add-post');
        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    public function testForm(): void
    {
        $crawler = $this->client->request('GET', '/add-post');
        $form = $crawler->selectButton('add_post_form[save]')
            ->form([
                'add_post_form[title]' => 'Title',
                'add_post_form[content]' => 'Content'
            ]);

        $this->client->submit($form);

        $kernel = self::bootKernel();
        $em = $kernel->getContainer()->get('doctrine')->getEntityManager();
        $post = $em->getRepository(Post::class)->findOneBy(['title' => 'Title']);

        $this->assertNotNull($post);

        $em->remove($post);
        $em->flush();
    }
}
