<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class PagerSlidingTests extends TestSuite {
    function PagerSlidingTests() {
        $this->TestSuite('Pager_Sliding Tests');
        $this->addFile('pager_sliding_test.php');
        $this->addFile('pager_sliding_notExpanded_test.php');
        $this->addFile('pager_sliding_noData_test.php');
    }
}

if (!defined('TEST_RUNNING')) {
    define('TEST_RUNNING', true);
    $test = new PagerTests();
    $test->run(new HtmlReporter());
}
?>