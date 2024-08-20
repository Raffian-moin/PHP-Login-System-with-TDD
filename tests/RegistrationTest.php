<?php

declare(strict_types=1);

use App\Registration;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class RegistrationTest extends TestCase
{
    // public function test_it_can_register_a_user(): void
    // {
    //     $greeter = new Registration();

    //     $greeter->register();

    //     // $this->assertSame('Hello, Alice!', $greeting);
    // }

    protected $registrationObj = null;

    protected function setUp(): void
    {
        $this->registrationObj = new Registration();
    }

    public function test_it_throws_error_if_any_required_field_is_missing(): void
    {

        $this->expectException(Exception::class);

        $this->registrationObj->checkRequiredFields(
            [
                'mail' => "raffianmoin@gmail.com",
                'password' => "123456",
                'confirm_password' => "",
            ]
        );
    }

    public function test_it_passes_if_all_required_fields_are_given(): void
    {
        $this->registrationObj = new Registration();

        $result = $this->registrationObj->checkRequiredFields(
            [
                'email' => "raffianmoin@gmail.com",
                'password' => "123456",
                'confirm_password' => "123456",
            ]
        );

        $this->assertTrue($result);
    }

    #[DataProvider('inputProvider')]
    public function test_it_throws_error_for_invalid_input(array $inputData) : void
    {

        $this->expectException(Exception::class);

        $this->registrationObj->validateInput(
            $inputData
        );
    }

    public function test_it_passes_if_all_input_are_valid(): void
    {

        $result = $this->registrationObj->validateInput(
            [
                'email' => "raffianmoin@gmail.com",
                'password' => "12345678",
                'confirm_password' => "12345678",
            ]
        );

        $this->assertTrue($result);
    }

    public static function inputProvider(): array
    {
        return [
                [
                    [
                        'email' => 'raffianmoin@gmailcom',
                        'password' => '12345678',
                        'confirm_password' => '12345678'
                    ]
                ],
                [
                    [
                        'email' => 'raffianmoin@gmail.com',
                        'password' => '12345',
                        'confirm_password' => '12345678'
                    ]
                ],
                [
                    [
                        'email' => 'raffianmoin@gmail.com',
                        'password' => '12345678',
                        'confirm_password' => '1234567'
                    ]
                ],
        ];
    }

    protected function tearDown(): void
    {
        $this->registrationObj = null;
    }
}
