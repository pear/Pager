<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Sample usage of the Pager class
 *
 * PHP versions 4 and 5
 *
 * @category   HTML
 * @package    Pager
 * @author     Richard Heyes <richard@phpguru.org>
 * @copyright  2003 Richard Heyes
 * @license    http://www.debian.org/misc/bsd.license  BSD License (3 Clause)
 * @version    CVS: $Id$
 * @link       http://pear.php.net/package/Pager
 */

include 'Pager.php';

$params = array(
    'totalItems' => 1600,
    'mode' => 'Jumping',
);
$pager =& Pager::factory($params);
$data  = $pager->getPageData();
$links = $pager->getLinks();
list($from, $to) = $pager->getOffsetByPageId();

?>
<html>
<body>

<table border="0" width="100%">
	<tr>
		<td colspan="3" align="center">
			Displaying [<?php echo $from; ?> - <?php echo $to; ?>] of <?php echo $pager->_totalItems; ?> <br />
			<?php echo $links['pages']; ?>
		</td>
	</tr>

	<tr>
		<td><nobr><?php echo $links['back']; ?></nobr></td>
		<td align="center" width="100%">&nbsp;</td>
		<td align="right"><nobr><?php echo $links['next']; ?></nobr></td>
	</tr>

	<tr>
		<td colspan="3">
			<pre><?print_r($data)?></pre>
		</td>
	</tr>
</table>

<h4>Results from methods:</h4>
<pre>
getCurrentPageID()...: <?php echo $pager->getCurrentPageID(); ?>
getNextPageID()......: <?php var_dump($pager->getNextPageID()); ?>
getPreviousPageID()..: <?php var_dump($pager->getPreviousPageID()); ?>
numItems()...........: <?php var_dump($pager->numItems()); ?>
numPages()...........: <?php var_dump($pager->numPages()); ?>
isFirstPage()........: <?php var_dump($pager->isFirstPage()); ?>
isLastPage().........: <?php var_dump($pager->isLastPage()); ?>
isLastPageComplete().: <?php var_dump($pager->isLastPageComplete()); ?>
</pre>

</body>
</html>