<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

error_reporting(error_reporting() & ~E_STRICT & ~E_DEPRECATED);

class AllTests extends TestSuite {
    function __construct() {
        parent::__construct('All PEAR::Pager Tests');
        $this->addFile(__DIR__ . '/pager_tests.php');
        $this->addFile(__DIR__ . '/pager_jumping_tests.php');
        $this->addFile(__DIR__ . '/pager_sliding_tests.php');
    }
}
