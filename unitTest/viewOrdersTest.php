<?php declare(strict_types=1);
require './controller/staffViewOrdersController.php';
use PHPUnit\Framework\TestCase;

final class viewOrdersTest extends TestCase
{
    public function testViewAllOrders(): void {
        $viewOrdersController = new staffViewOrdersController();

        $allOrders = $viewOrdersController->viewAllOrders();
        $this->assertIsArray($allOrders);
    }

    public function testviewUnfulfilledOrders(): void {
        $viewOrdersController = new staffViewOrdersController();

        $unfulfilledOrders = $viewOrdersController->viewUnfulfilledOrders();
        $this->assertIsArray($unfulfilledOrders);
    }

    public function testviewFulfilledOrders(): void {
        $viewOrdersController = new staffViewOrdersController();

        $fulfilledOrders = $viewOrdersController->viewFulfilledOrders();
        $this->assertIsArray($fulfilledOrders);
    }


}