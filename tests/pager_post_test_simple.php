<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

class TestOfPagerPOSTsimple extends UnitTestCase {
    var $pager;
    var $baseurl;
    var $options = array();

    function TestOfPagerPOSTsimple($name='Test of Pager with httpMethod="POST" - no web') {
        $this->UnitTestCase($name);
    }
    function setUp() {
        $this->options = array(
            'itemData' => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
            'perPage'  => 1,
            'clearIfVoid' => false,
            'httpMethod' => 'POST',
        );
        //$this->pager = Pager::factory($this->options);
        $this->baseurl = 'http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/'));
        //var_dump($this->baseurl.'/multibyte_post.php');
    }
    function tearDown() {
        unset($this->pager);
    }

    function testGetAndPost() {
        $this->pager =& Pager::factory($this->options);
        $this->assertNoPattern('/id=/', $this->pager->links);

        $_GET['id'] = 123;
        $this->pager =& Pager::factory($this->options);
        $this->assertPattern('/id=123/', $this->pager->links);
    }
}
?>