<?php
// +-----------------------------------------------------------------------+
// | Copyright (c) 2002, Richard Heyes                                     |
// | All rights reserved.                                                  |
// |                                                                       |
// | Redistribution and use in source and binary forms, with or without    |
// | modification, are permitted provided that the following conditions    |
// | are met:                                                              |
// |                                                                       |
// | o Redistributions of source code must retain the above copyright      |
// |   notice, this list of conditions and the following disclaimer.       |
// | o Redistributions in binary form must reproduce the above copyright   |
// |   notice, this list of conditions and the following disclaimer in the |
// |   documentation and/or other materials provided with the distribution.|
// | o The names of the authors may not be used to endorse or promote      |
// |   products derived from this software without specific prior written  |
// |   permission.                                                         |
// |                                                                       |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
// |                                                                       |
// +-----------------------------------------------------------------------+
// | Author: Richard Heyes <richard@phpguru.org>                           |
// +-----------------------------------------------------------------------+

include('Pager.php');

$params['totalItems'] = 1600;
$pager = &new Pager($params);
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

<h4>Results from methods:</h4>
<pre>
getCurrentPageID()...: <?=$pager->getCurrentPageID()?> 
getNextPageID()......: <?var_dump($pager->getNextPageID())?>
getPreviousPageID()..: <?var_dump($pager->getPreviousPageID())?>
numItems()...........: <?var_dump($pager->numItems())?>
numPages()...........: <?var_dump($pager->numPages())?>
isFirstPage()........: <?var_dump($pager->isFirstPage())?>
isLastPage().........: <?var_dump($pager->isLastPage())?>
isLastPageComplete().: <?var_dump($pager->isLastPageComplete())?>
</pre>

</body>
</html>