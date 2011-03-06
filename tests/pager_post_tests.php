<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

$test = new TestSuite('Pager POST tests');
$test->addFile('pager_post_test.php');
$test->addFile('pager_post_test_simple.php');
exit ($test->run(new HTMLReporter()) ? 0 : 1);

?>