<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class TestOfPager extends UnitTestCase {
    var $pager;
    function TestOfPager($name='Test of Pager') {
        $this->UnitTestCase($name);
    }
    function setUp() {
        $options = array(
            'itemData'    => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
            'perPage' => 5,

        );
        $this->pager = new Pager($options);
    }
    function tearDown() {
        unset($this->pager);
    }
    function testCurrentPageID () {
        $this->assertEqual(1, $this->pager->getCurrentPageID());
    }
    function testNextPageID () {
        $this->assertEqual(2, $this->pager->getNextPageID());
    }
    function testPrevPageID () {
        $this->assertEqual(false, $this->pager->getPreviousPageID());
    }
    function testNumItems () {
        $this->assertEqual(10, $this->pager->numItems());
    }
    function testNumPages () {
        $this->assertEqual(2, $this->pager->numPages());
    }
    function testFirstPage () {
        $this->assertEqual(true, $this->pager->isFirstPage());
    }
    function testLastPage () {
        $this->assertEqual(false, $this->pager->isLastPage());
    }
    function testLastPageComplete () {
        $this->assertEqual(true, $this->pager->isLastPageComplete());
    }
    function testOffsetByPageId1() {
        $this->assertEqual(array(1, 5), $this->pager->getOffsetByPageId(1));
    }
    function testOffsetByPageId2() {
        $this->assertEqual(array(6, 10), $this->pager->getOffsetByPageId(2));
    }
    function testOffsetByPageId_outOfRange() {
        $this->assertEqual(array(0, 0), $this->pager->getOffsetByPageId(20));
    }
}
?>