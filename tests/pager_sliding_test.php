<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class TestOfPagerSliding extends UnitTestCase {
    var $pager;
    function TestOfPagerSliding($name='Test of Pager_Sliding') {
        $this->UnitTestCase($name);
    }
    function setUp() {
        $options = array(
            'itemData' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            'perPage'  => 2,
            'mode'     => 'Sliding',
        );
        $this->pager = new Pager($options);
    }
    function tearDown() {
        unset($this->pager);
    }
    function testOffsetByPageId() {
        $this->assertEqual(array(1, 5), $this->pager->getOffsetByPageId(2));
    }
    function testOffsetByPageId2() {
        $this->assertEqual(array(2, 6), $this->pager->getOffsetByPageId(6));
    }
    function testOffsetByPageId_outOfRange() {
        $this->assertEqual(array(0, 0), $this->pager->getOffsetByPageId(20));
    }
}
?>