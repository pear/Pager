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
        $this->pager = Pager::factory($options);
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
    function testGetPageData() {
        $this->assertEqual(array(0=>1, 1=>2, 2=>3, 3=>4, 4=>5), $this->pager->getPageData());
    }
    function testGetPageData2() {
        $this->assertEqual(array(5=>6, 6=>7, 7=>8, 8=>9, 9=>10), $this->pager->getPageData(2));
    }
    function testGetPageData_OutOfRange() {
        $this->assertEqual(false, $this->pager->getPageData(3));
    }
    function testSelectBox() {
        $selectBox  = '<select name="'.$this->pager->_sessionVar.'">';
        $selectBox .= '<option value="5" selected="selected">5</option>';
        $selectBox .= '<option value="10">10</option>';
        $selectBox .= '<option value="15">15</option>';
        $selectBox .= '</select>';
        $this->assertEqual($selectBox, $this->pager->getPerPageSelectBox(5, 15, 5));
    }
    function testSelectBoxWithString() {
        $selectBox  = '<select name="'.$this->pager->_sessionVar.'">';
        $selectBox .= '<option value="5" selected="selected">5 bugs</option>';
        $selectBox .= '<option value="10">10 bugs</option>';
        $selectBox .= '<option value="15">15 bugs</option>';
        $selectBox .= '</select>';
        $this->assertEqual($selectBox, $this->pager->getPerPageSelectBox(5, 15, 5, false, '%d bugs'));
    }
    function testSelectBoxWithShowAll() {
        $selectBox  = '<select name="'.$this->pager->_sessionVar.'">';
        $selectBox .= '<option value="3">3</option>';
        $selectBox .= '<option value="4">4</option>';
        $selectBox .= '<option value="5" selected="selected">5</option>';
        $selectBox .= '<option value="6">6</option>';
        $selectBox .= '<option value="10">10</option>';
        $selectBox .= '</select>';
        $this->assertEqual($selectBox, $this->pager->getPerPageSelectBox(3, 6, 1, true));
    }
    function testSelectBoxWithShowAllAndText() {
        $this->pager->_showAllText = 'Show All';
        $selectBox  = '<select name="'.$this->pager->_sessionVar.'">';
        $selectBox .= '<option value="3">3 bugs</option>';
        $selectBox .= '<option value="4">4 bugs</option>';
        $selectBox .= '<option value="5" selected="selected">5 bugs</option>';
        $selectBox .= '<option value="6">6 bugs</option>';
        $selectBox .= '<option value="10">Show All</option>';
        $selectBox .= '</select>';
        $this->assertEqual($selectBox, $this->pager->getPerPageSelectBox(3, 6, 1, true, '%d bugs'));
    }
    function testSelectBoxWithShowAllWithExtraAttribs() {
        $this->pager->_showAllText = 'Show All';
        $selectBox  = '<select name="'.$this->pager->_sessionVar.'" onmouseover="doSth">';
        $selectBox .= '<option value="3">3 bugs</option>';
        $selectBox .= '<option value="4">4 bugs</option>';
        $selectBox .= '<option value="5" selected="selected">5 bugs</option>';
        $selectBox .= '<option value="6">6 bugs</option>';
        $selectBox .= '<option value="10">Show All</option>';
        $selectBox .= '</select>';
        $params = array('optionText' => '%d bugs', 'attributes' => 'onmouseover="doSth"');
        $this->assertEqual($selectBox, $this->pager->getPerPageSelectBox(3, 6, 1, true, $params));
    }
    function testSelectBoxInvalid() {
        $err = $this->pager->getPerPageSelectBox(5, 15, 5, false, '%s bugs');
        $this->assertEqual(ERROR_PAGER_INVALID_PLACEHOLDER, $err->getCode());
    }
    function testAppendInvalid() {
        $options = array(
            'totalItems' => 10,
            'append'     => false,
            'fileName'   => 'invalidFileName'
        );
        $err =& Pager::factory($options);  //ERROR_PAGER_INVALID_USAGE
        $this->assertError();
    }
    function testAppendValid() {
        $options = array(
            'totalItems' => 10,
            'append'     => false,
            'fileName'   => 'valid_%d_FileName'
        );
        $err =& Pager::factory($options);
        $this->assertNoErrors();
    }
    function testUrlencode() {
        //encode special chars
        $options = array(
            'extraVars' => array(
                'request[]' => 'aRequest',
                'escape'    => 'дц',
            ),
            'perPage' => 5,
        );
        $this->pager =& Pager::factory($options);
        $expected = '?request%5B%5D=aRequest&amp;escape=%E4%F6&amp;pageID=';
        $this->assertEqual($expected, $this->pager->_getLinksUrl());

        //don't encode slashes
        $options = array(
            'extraVars' => array(
                'request' => 'cat/subcat',
            ),
            'perPage' => 5,
        );
        $this->pager =& Pager::factory($options);
        //$expected = '?request=cat%2Fsubcat&amp;pageID=';
        $expected = '?request=cat/subcat&amp;pageID=';
        $this->assertEqual($expected, $this->pager->_getLinksUrl());
    }
}
?>