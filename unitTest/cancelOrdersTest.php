<?php declare(strict_types=1);
require './controller/staffCancelOrderController.php';
use PHPUnit\Framework\TestCase;

final class cancelOrdersTest extends TestCase
{
    public function testCancelOrders(): void {
        $this->conn = @mysqli_connect('127.0.0.1', 'root', '', 'csit314');
        $sql = "INSERT INTO `orderDetails` (`orderNo`, `name`, `ccNo`, `orderDetails`, `cost`, `tableCode`,
         `status`, `day`, `month`, `week`, `hour`, `duration`) 
        VALUES (9999, 'name', '1234', '{\"squid ink pasta\":\"1\"}', '10.00', 'table1', 'preparing'
        , '1', '1', '1', '1', '3')";
        $result = @mysqli_query($this->conn, $sql);

        $expectedArray = ["orderNo" => 9999];
        $sql2 = "SELECT orderNo from orderDetails WHERE orderNo = 9999";
		$result2 = @mysqli_query($this->conn, $sql2);
        $this->assertEquals($expectedArray, $result2->fetch_assoc());

        $cancelOrderController = new staffCancelOrderController();
        $cancelOrder = $cancelOrderController->cancelOrder(9999);
        $this->assertTrue($cancelOrder);

        $sql3 = "SELECT orderNo from orderDetails WHERE orderNo = 9999";
		$result3 = @mysqli_query($this->conn, $sql3);
        $this->assertEquals(null, $result3->fetch_assoc());
    }
}