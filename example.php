<?php

include('Pager.php');

$params['itemData'] = range(1, 140);
$pager =& new Pager($params);
$data  = $pager->getPageData();
$links = $pager->getLinks();
list($from, $to) = $pager->getOffsetByPageId();

?>
<html>
<body>

<table border="0" width="100%">
	<tr>
		<td colspan="3" align="center">
			Displaying [<?=$from?> - <?=$to?>] of <?=$pager->_totalItems?> <br />
			<?=$links['pages']?>
		</td>
	</tr>

	<tr>
		<td><nobr><?=$links['back']?></nobr></td>
		<td align="center" width="100%">&nbsp;</td>
		<td align="right"><nobr><?=$links['next']?></nobr></td>
	</tr>

	<tr>
		<td colspan="3">
			<pre><?print_r($data)?></pre>
		</td>
	</tr>
</table>

</body>
</html>