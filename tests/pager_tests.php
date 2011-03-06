<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class PagerTests extends TestSuite {
    function PagerTests() {
        $this->TestSuite('Pager Tests');
        $this->addFile('pager_test.php');
        $this->addFile('pager_noData_test.php');
    }
}

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = new PagerTests();
    $test->run(new HtmlReporter());
}
?>