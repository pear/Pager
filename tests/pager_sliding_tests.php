<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class PagerSlidingTests extends TestSuite {
    function PagerSlidingTests() {
        parent::__construct('Pager_Sliding Tests');
        $this->addFile(__DIR__ . '/pager_sliding_test.php');
        $this->addFile(__DIR__ . '/pager_sliding_notExpanded_test.php');
        $this->addFile(__DIR__ . '/pager_sliding_noData_test.php');
    }
}
?>