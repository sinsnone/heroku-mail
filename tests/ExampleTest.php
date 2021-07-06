<?php

use Faker\Factory;

class ExampleTest extends TestCase
{
    private \Faker\Generator $faker;
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }

    public function testExample()
    {
        $this->get('/');
        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    public function testSendEmail()
    {
        $this->post(route('mail'), [
            'email' => $this->faker->email,
            'subject' => $this->faker->colorName,
            'content' => $this->faker->colorName,
        ]);
        $this->assertResponseOk();
        $this->seeJsonStructure([
            'data' => [
                'message',
                'request',
                'time'
            ]
        ]);
    }
}
