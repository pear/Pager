<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

define('TEST_RUNNING', true);

require_once './pager_tests.php';
require_once './pager_jumping_tests.php';
require_once './pager_sliding_tests.php';


class AllTests extends TestSuite {
    function AllTests() {
        $this->TestSuite('All PEAR::Pager Tests');
        $this->Add(new PagerTests());
        $this->Add(new PagerJumpingTests());
        $this->Add(new PagerSlidingTests());
    }
}

$test = new AllTests();
$test->run(new HtmlReporter());
?>