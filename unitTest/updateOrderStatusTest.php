<?php declare(strict_types=1);
require './controller/staffUpdateOrderStatusController.php';
use PHPUnit\Framework\TestCase;

final class updateOrderStatusTest extends TestCase
{
    public function testUpdateOrderStatusFulfilled(): void {
        $this->conn = @mysqli_connect('127.0.0.1', 'root', '', 'csit314');

        $updateOrderStatusController = new staffUpdateOrderStatusController();
        $updateOrderStatus = $updateOrderStatusController->orderFulfilled(100);
        $this->assertTrue($updateOrderStatus);

        $expectedArray = ["status" => "delivered"];
        $sql = "SELECT status from orderDetails WHERE orderNo = 100";
		$result = @mysqli_query($this->conn, $sql);
        $this->assertEquals($expectedArray, $result->fetch_assoc());
    }

    public function testUpdateOrderStatusUnfulfilled(): void {
        $this->conn = @mysqli_connect('127.0.0.1', 'root', '', 'csit314');

        $updateOrderStatusController = new staffUpdateOrderStatusController();
        $updateOrderStatus = $updateOrderStatusController->orderUnfulfilled(100);
        $this->assertTrue($updateOrderStatus);

        $expectedArray = ["status" => "preparing"];
        $sql = "SELECT status from orderDetails WHERE orderNo = 100";
		$result = @mysqli_query($this->conn, $sql);
        $this->assertEquals($expectedArray, $result->fetch_assoc());
    }
}