<?php declare(strict_types=1);
require './controller/staffSearchOrdersController.php';
use PHPUnit\Framework\TestCase;

final class searchOrdersTest extends TestCase
{
    public function testSearchOrders(): void {
        $searchOrdersController = new staffSearchOrdersController();
        $searchOrderNo = 200;
        $expectedOutput = array();
        $expectedArray = array(
            "orderNo"=>"200",
            "name"=>"richard",
            "ccNo"=>"8046467163156804",
            "orderDetails"=>'{"bolognese pasta":"1","espresso":"8"}',
            "cost"=>"9.50",
            "tableCode"=>"table18",
            "status"=>"delivered",
            "day"=>"30",
            "month"=>"4",
            "week"=>"5",
            "hour"=>"8",
            "duration"=>"85");

        $expectedOutput[0] = $expectedArray;

        $searchOrder = $searchOrdersController->searchOrder($searchOrderNo);

        $this->assertEquals($expectedOutput, $searchOrder);
    }

    public function testInvalidSearch(): void {
        $searchOrdersController = new staffSearchOrdersController();
        $searchOrderNo = 9999;
        $searchOrder = $searchOrdersController->searchOrder($searchOrderNo);
        $expectedOutput = array();

        $this->assertEquals($expectedOutput, $searchOrder);
    }
}