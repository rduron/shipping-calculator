<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShippingControllerTest extends WebTestCase
{
    public function testCalculateSuccess(): void
    {
        $client = static::createClient();
        $client ->request(
            'POST',
            '/api/shipping/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'transcompany',
                'weightKg' => 5
            ])
        );

        $this->assertResponseIsSuccessful();

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('price', $data);
        $this->assertEquals('transcompany', $data['carrier']);
    }

    public function testUnsupportedCarrier(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/shipping/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'carrier' => 'testcompany',
                'weightKg' => 5
            ])
        );

        $this->assertResponseStatusCodeSame(400);
        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Unsupported carrier', $data['error']);
    }

    /**
     * @dataProvider invalidPayloadProvider
     */
    public function testValidationErrors(array $payload): void
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/shipping/calculate',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($payload)
        );

        $this->assertResponseStatusCodeSame(400);

        $data = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Validation failed', $data['error']);
    }

    public static function invalidPayloadProvider(): array
    {
        return [
            'missing carrier' => [[
                'weightKg' => 5,
            ]],
            'missing weight' => [[
                'carrier' => 'transcompany',
            ]],
            'invalid weight string' => [[
                'carrier' => 'transcompany',
                'weightKg' => 'abc',
            ]],
            'negative weight' => [[
                'carrier' => 'transcompany',
                'weightKg' => -5,
            ]],
        ];
    }

}
