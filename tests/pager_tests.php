<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class PagerTests extends TestSuite {
    function PagerTests() {
        parent::__construct('Pager Tests');
        $this->addFile(__DIR__ . '/pager_test.php');
        $this->addFile(__DIR__ . '/pager_noData_test.php');
    }
}
?>