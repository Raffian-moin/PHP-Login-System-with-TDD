<?php

declare(strict_types=1);

use App\Registration;
use PHPUnit\Framework\TestCase;

final class RegistrationTest extends TestCase
{
    // public function test_it_can_register_a_user(): void
    // {
    //     $greeter = new Registration();

    //     $greeter->register();

    //     // $this->assertSame('Hello, Alice!', $greeting);
    // }

    public function test_it_throws_error_if_any_required_field_is_missing(): void
    {
        $greeter = new Registration();

        $this->expectException(Exception::class);

        $greeter->validate(
            [
                'mail' => "raffianmoin@gmail.com",
                'password' => "123456",
                'confirm_password' => "",
            ]
        );
    }

    public function test_it_passes_if_all_required_fields_are_given(): void
    {
        $greeter = new Registration();

        $result = $greeter->validate(
            [
                'email' => "raffianmoin@gmail.com",
                'password' => "123456",
                'confirm_password' => "123456",
            ]
        );

        $this->assertTrue($result);
    }
}
