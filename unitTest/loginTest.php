<?php declare(strict_types=1);
require './controller/loginController.php';
use PHPUnit\Framework\TestCase;

final class loginTest extends TestCase
{
    public function testLogin(): void
    {
        $loginController = new loginController();

        $validUsername = "owner";
        $invalidUsername = "wrongUser";
        $validPw = "ownerPw";
        $invalidPw = "wrongPw";

        $validLoginTest = $loginController->validateLogin($validUsername, $validPw);
        $this->assertTrue($validLoginTest);

        $invalidUsernameTest = $loginController->validateLogin($invalidUsername, $validPw);
        $this->assertFalse($invalidUsernameTest);

        $invalidPwTest = $loginController->validateLogin($validUsername, $invalidPw);
        $this->assertFalse($invalidPwTest);

        $invalidLoginTest = $loginController->validateLogin($invalidUsername, $invalidPw);
        $this->assertFalse($invalidLoginTest);
    }
}