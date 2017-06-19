<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class PagerJumpingTests extends TestSuite {
    function PagerJumpingTests() {
        parent::__construct('Pager_Jumping Tests');
        $this->addFile(__DIR__ . '/pager_jumping_test.php');
        $this->addFile(__DIR__ . '/pager_jumping_noData_test.php');
    }
}
?>