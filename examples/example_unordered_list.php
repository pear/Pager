<?php
require_once 'Pager/Pager.php';

//create dummy array of data
$myData = array();
for ($i=0; $i<200; $i++) {
    $myData[] = $i;
}

$params = array(
    'itemData' => $myData,
    'perPage' => 10,
    'delta' => 8,             // for 'Jumping'-style a lower number is better
    'append' => true,
    'clearIfVoid' => false,
    'urlVar' => 'entrant',
    'useSessions' => true,
    'closeSession' => true,
    //'mode'  => 'Sliding',    //try switching modes
    'mode'  => 'Jumping',
    'prevImg'   => '« Previous',
    'nextImg'   => ' Next »',
//settings best used for lists:
		'separator' => '',										//you shouldn't use &nbsp; anywhere, especially in lists
		'spacesBeforeSeparator'	=> 0,					//or spaces
		'spacesAfterSeparator'	=> 0,
		'linkContainer' => 'li',							//default is nothing, now optionally wraps links with a html tag
		'linkContainerClassName' => 'active',	//if you want <li class="active"><a>page#</a></li>
		'curTag' => 'a',											//default is span as that's what it used to be, now it's changeable
		//'curPageLinkClassName' => 'active',	//if you want <li><a class="active">page#</a></li>
);
$pager = & Pager::factory($params);
$page_data = $pager->getPageData();
$links = $pager->getLinks();

$selectBox = $pager->getPerPageSelectBox();
?>

<html>
<head>
<title>new PEAR::Pager example using a list</title>
<style>
ul.pagination li {display:inline; margin:3px;}
ul.pagination li a {
	display: inline-block;
	margin: 0;
	padding:2px 5px;
	border:1px solid #000000;
	background-color:#EEEEEE;
	color:#000;
	text-decoration: none;
	font-size:11px;
	font-weight:bold;
}
ul.pagination li.active a {
	color: white;
	border:1px solid black;
	cursor:pointer;
}
ul.pagination li a:hover {
	color: maroon;
	border:1px solid maroon;
	background-color:#FFFFE0;
}
</style>
</head>
<body>

<table border="1" width="500" summary="example 1">
	<tr>
		<td colspan="3" align="center">
			<ul class="pagination">
				<?php echo $links['all']; ?>
			</ul>
		</td>
	</tr>


	<tr>
		<td colspan="3">
			<pre><?php print_r($page_data); ?></pre>
		</td>
	</tr>
</table>

<h4>Results from methods:</h4>

<pre>
getCurrentPageID()...: <?php var_dump($pager->getCurrentPageID()); ?>
getNextPageID()......: <?php var_dump($pager->getNextPageID()); ?>
getPreviousPageID()..: <?php var_dump($pager->getPreviousPageID()); ?>
numItems()...........: <?php var_dump($pager->numItems()); ?>
numPages()...........: <?php var_dump($pager->numPages()); ?>
isFirstPage()........: <?php var_dump($pager->isFirstPage()); ?>
isLastPage().........: <?php var_dump($pager->isLastPage()); ?>
isLastPageComplete().: <?php var_dump($pager->isLastPageComplete()); ?>
$pager->range........: <?php var_dump($pager->range); ?>
</pre>


<hr />

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
Select how many items per page should be shown:<br />
<?php echo $selectBox; ?> &nbsp;
<input type="submit" value="submit" />
</form>

<hr />

</body>
</html>