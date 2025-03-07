<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $container = static::getContainer();
        $em = $container->get('doctrine.orm.entity_manager');
        $userRepository = $em->getRepository(User::class);

        // Remove any existing users from the test database
        foreach ($userRepository->findAll() as $user) {
            $em->remove($user);
        }

        $em->flush();

        // Create a User fixture
        /** @var UserPasswordHasherInterface $passwordHasher */
        $passwordHasher = $container->get('security.user_password_hasher');

        $user = new User();
        $user->setEmail('email@example.com');
        $user->setUsername('testuser');
        $user->setFullName('Test User');
        $user->setPassword($passwordHasher->hashPassword($user, 'password'));

        $em->persist($user);
        $em->flush();
    }

    public function testLoginSucceedsWithValidCredentials(): void
    {
        $this->client->request('GET', '/login');
        self::assertResponseIsSuccessful();

        $this->client->submitForm('Sign in', [
            'login[username]' => 'testuser',
            'login[password]' => 'password',
        ]);

        self::assertResponseRedirects('/');
        $this->client->followRedirect();

        self::assertSelectorNotExists('.alert-danger');
        self::assertResponseIsSuccessful();
    }

    public function testLoginFailsWithInvalidPassword(): void
    {
        $this->client->request('GET', '/login');
        self::assertResponseIsSuccessful();

        $this->client->submitForm('Sign in', [
            'login[username]' => 'testuser',
            'login[password]' => 'bad-password',
        ]);

        self::assertResponseRedirects('/login');
        $this->client->followRedirect();

        // Ensure we do not reveal the user exists but the password is wrong
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    public function testLoginFailsWithInvalidUsername(): void
    {
        $this->client->request('GET', '/login');
        self::assertResponseIsSuccessful();

        $this->client->submitForm('Sign in', [
            'login[username]' => 'doesNotExist',
            'login[password]' => 'password',
        ]);

        self::assertResponseRedirects('/login');
        $this->client->followRedirect();

        // Ensure we do not reveal if the user exists or not
        self::assertSelectorTextContains('.alert-danger', 'Invalid credentials.');
    }

    public function testUsersCanLogoutThemselves(): void
    {
        // Login user directly
        $userRepository = static::getContainer()->get('doctrine')->getRepository(User::class);
        $testUser = $userRepository->findOneBy(['username' => 'testuser']);
        $this->client->loginUser($testUser);

        // Verify that we are logged in
        $this->client->request('GET', '/');
        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('#user_name', 'Test User');
        
        // Perform logout
        $this->client->request('GET', '/logout');
        
        // After logout we should be redirected to the default page
        self::assertResponseRedirects();
        $this->client->followRedirect();
        
        // Verify that we are on the login page
        self::assertRouteSame('app_default');
    }
}
