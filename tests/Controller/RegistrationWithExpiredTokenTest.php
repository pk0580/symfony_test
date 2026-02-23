<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class RegistrationWithExpiredTokenTest extends WebTestCase
{
    public function testRegisterWithExpiredToken(): void
    {
        $client = static::createClient();

        // Мы передаем токен, который выглядит как JWT, чтобы сработал JWT лексика,
        // но он просрочен или невалиден по подписи.
        // В данном случае Lexik Authentication Listener видит заголовок Authorization,
        // пытается его аутентифицировать и выбрасывает ошибку 401, если токен невалиден,
        // так как фаервол 'api' ожидает JWT.

        $expiredToken = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2MDk0NTkyMDB9.invalid_signature";

        $client->request(
            'POST',
            '/api/auth/register',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'HTTP_AUTHORIZATION' => 'Bearer ' . $expiredToken,
            ],
            json_encode([
                'email' => 'test_expired@example.com',
                'password' => 'password123',
            ])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode(), $client->getResponse()->getContent());
    }
}
