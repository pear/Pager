<?php
// $Id$

require_once 'simple_include.php';
require_once 'pager_include.php';

$test = &new GroupTest('Pager POST tests');
$test->addTestFile('pager_post_test.php');
exit ($test->run(new HTMLReporter()) ? 0 : 1);

?>