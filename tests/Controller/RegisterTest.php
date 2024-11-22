<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class RegisterTest extends WebTestCase
{
    private $client;
    private EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->client = static::createClient();


        $this->entityManager = self::getContainer()->get(EntityManagerInterface::class);
    }

    protected function tearDown(): void
    {

        $user = $this->entityManager->getRepository(User::class)
            ->findOneBy(['email' => 'jane.smith@example.com']);

        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }


        $this->client = null;

        parent::tearDown();
    }

    public function testSuccessfulRegister(): void
{
    $crawler = $this->client->request('GET', '/register');

    $form = $crawler->selectButton("S'inscrire")->form([
        'registration_form[firstname]' => 'Jane',
        'registration_form[lastname]' => 'Smith',
        'registration_form[email]' => 'jane.smith@example.com',
        'registration_form[plainPassword]' => 'password123',
        'registration_form[agreeTerms]' => true,
    ]);

    $this->client->submit($form);


    $this->assertResponseRedirects('/login');

    $this->client->followRedirect();

    $user = $this->entityManager->getRepository(User::class)
        ->findOneBy(['email' => 'jane.smith@example.com']);

    $this->assertNotNull(
        $user,
        'L\'utilisateur n\'a pas été créé en base de données.'
    );
    $this->assertEquals(
        'Jane',
        $user->getFirstname(),
        'Le prénom enregistré dans la base ne correspond pas.'
    );
    $this->assertEquals(
        'Smith',
        $user->getLastname(),
        'Le nom de famille enregistré dans la base ne correspond pas.'
    );
}
}