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
    function testPageRangeByPageId1() {
        $this->assertEqual(array(1, 5), $this->pager->getPageRangeByPageId(1));
    }
    function testPageRangeByPageId4() {
        $this->assertEqual(array(2, 6), $this->pager->getPageRangeByPageId(4));
    }
    function testPageRangeByPageId_outOfRange() {
        $this->assertEqual(array(0, 0), $this->pager->getPageRangeByPageId(20));
    }
//////////
    function testPageRangeByPageId2() {
        $this->assertEqual(array(2, 6), $this->pager->getPageRangeByPageId(4));
    }
    /**
     * Returns offsets for given pageID. Eg, if you pass pageID=5 and your
     * delta is 2, it will return 3 and 7. A pageID of 6 would give you 4 and 8
     * If the method is called without parameter, pageID is set to currentPage#.
     *
     * Given a PageId, it returns the limits of the range of pages displayed.
     * While getOffsetByPageId() returns the offset of the data within the current
     * page, this method returns the offsets of the page numbers interval.
     * E.g., if you have perPage=10 and pageId=3, it will return you 1 and 10.
     * PageID of 8 would give you 1 and 10 as well, because 1 <= 8 <= 10.
     * PageID of 11 would give you 11 and 20.
     *
     * @param pageID PageID to get offsets for
     * @return array  First and last offsets
     * @access public
     */
    /**
     * Given a PageId, it returns the limits of the range of pages displayed.
     * While getOffsetByPageId() returns the offset of the data within the
     * current page, this method returns the offsets of the page numbers interval.
     * E.g., if you have perPage=10 and pageId=3, it will return you 1 and 10.
     * PageID of 8 would give you 1 and 10 as well, because 1 <= 8 <= 10.
     * PageID of 11 would give you 11 and 20.
     *
     * @param pageID PageID to get offsets for
     * @return array  First and last offsets
     * @access public
     */
}
?>