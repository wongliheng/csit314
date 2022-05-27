<?php declare(strict_types=1);
require './controller/logoutController.php';
use PHPUnit\Framework\TestCase;
session_start();

final class logoutTest extends TestCase
{
    public function testValidLogout(): void {
        $logoutController = new logoutController();
        $_SESSION['loggedIn'] = true;

        $validLogoutTest = $logoutController->requestLogout();
        $this->assertTrue($validLogoutTest);
    }

    public function testInvalidLogout(): void {
        $logoutController = new logoutController();
        $_SESSION['loggedIn'] = false;

        $invalidLogoutTest = $logoutController->requestLogout();
        $this->assertFalse($invalidLogoutTest);
    }
}