<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LogoutTest extends WebTestCase
{
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }
    protected function tearDown(): void
    {
        parent::tearDown();
        $this->client = null;
    }
    public function testLogout(): void
    {

        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Sign in')->form([
            '_username' => 'test@example.com',
            '_password' => 'password123',
        ]);
        $this->client->submit($form);

    
        $this->assertResponseRedirects('/');
        $this->client->followRedirect();
        $this->assertSelectorTextContains('body', 'Bienvenue, test@example.com');

        $this->client->request('GET', '/logout');

        $this->assertResponseRedirects('/');

       
        $this->client->followRedirect();
        $this->assertSelectorTextContains('p', "Vous n'êtes pas connecté"); 
        $this->assertNull($this->client->getContainer()->get('security.token_storage')->getToken(), 'Le jeton de sécurité devrait être null après déconnexion.');

    }
}
