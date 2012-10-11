<?php

require_once 'src/Guestbook.php';

class GuestbookTest extends PHPUnit_Extensions_Database_TestCase {

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;
    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }
        return $this->conn;
    }

    function getDataSet() {
        $dataSet = $this->createXMLDataSet('fixture/DataForDB/GuestbookFixture.xml');
        return $dataSet;
    }

    public function testNumberOfRowsInGuestbook() {
        $this->assertEquals(3, $this->getConnection()->getRowCount('guestbook'), "Pre-Condition");

        $guestbook = new Guestbook(static::$pdo);
        $guestbook->addEntry(4, 'Entry 4', 'Tester');

        $this->assertEquals(4, $this->getConnection()->getRowCount('guestbook'), "Inserting failed");
    }
    
    public function testDataInTableGuestbook() {

        $dataInGuestbook = $this->getConnection()->createQueryTable('guestbook', 'SELECT * FROM guestbook');

        $expectedDataForGuestbook = $this->getDataSet()->getTable("guestbook");

        $this->assertTablesEqual($expectedDataForGuestbook, $dataInGuestbook);
    }

    public function testDataInTableGuestbook2() {

        $dataSet = $this->getConnection()->createDataSet(array('guestbook'));

        $expectedDataSet = $this->getDataSet();

        $this->assertDataSetsEqual($expectedDataSet, $dataSet);
    }

    public function testDataInTableGuestbook3() {
        // building manual data set
        $dataSet = new PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());

        $dataSet->addTable('guestbook', 'SELECT * FROM guestbook');

        $expectedDataSet = $this->getDataSet();

        $this->assertDataSetsEqual($expectedDataSet, $dataSet);
    }

}

?>
