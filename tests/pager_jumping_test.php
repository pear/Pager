<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class TestOfPagerJumping extends UnitTestCase {
    var $pager;
    function TestOfPagerJumping($name='Test of Pager_Jumping') {
        $this->UnitTestCase($name);
    }
    function setUp() {
        $options = array(
            'itemData' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'perPage'  => 3,
            'mode'     => 'Jumping',
        );
        $this->pager = new Pager($options);
    }
    function tearDown() {
        unset($this->pager);
    }
    function testOffsetByPageId() {
        $this->assertEqual(array(1, 3), $this->pager->getOffsetByPageId(1));
    }
    function testOffsetByPageId2() {
        $this->assertEqual(array(4, 6), $this->pager->getOffsetByPageId(2));
    }
    function testOffsetByPageId_outOfRange() {
        $this->assertEqual(array(0, 0), $this->pager->getOffsetByPageId(6));
    }
    function testPageIdByOffset() {
        $this->assertEqual(1, $this->pager->getPageIdByOffset(1));
    }
    function testPageIdByOffset2() {
        $this->assertEqual(1, $this->pager->getPageIdByOffset(2));
    }
    function testPageIdByOffset3() {
        $this->assertEqual(2, $this->pager->getPageIdByOffset(5));
    }
}
?>