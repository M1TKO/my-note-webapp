<?php 
// !! To change the showing notes per page change the variable ---  $rowsperpage
// !! To change showing pages in penu change the variable --------	$range

// find out how many rows are in the table
$notesQuantity = $db->getNotesQuantity($user_id);

// number of rows to show per page
$rowsperpage = 4;
// find out total pages
$totalpages = ceil($notesQuantity / $rowsperpage);

// get the current page or set a default
if (!isset($_GET['currentpage']) || !ctype_digit($_GET['currentpage'])) {
    $currentpage = 1;
} else {
    $currentpage = (int)$_GET['currentpage'];
}

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} 
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} 

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

$notes = $db->getNotes($user_id, $offset, $rowsperpage);	 // Get the notes from the Database

function showPaginationLinks($currentpage, $totalpages){
	/******  build the pagination links ******/
	// range of num links to show
	$range = 2;

	// if not on page 1, don't show back links
	if ($currentpage > 1) {
	   // show << link to go back to page 1
	   echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=1' id=\"page-1\"><<</a></li> ";
	   // get previous page num
	   $prevpage = $currentpage - 1;
	   // show < link to go back to 1 page
	   echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage' id=\"page-prev\"><</a></li> ";
	}  

	// loop to show links to range of pages around current page
	for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
	   // if it's a valid page number...
	   if (($x > 0) && ($x <= $totalpages)) {
	      // if we're on current page...
	      if ($x == $currentpage) {
	         // 'highlight' it but don't make a link
	         echo " <li class=\"active\"><a><b id=\"page-current-2\">$x</b></a></li> ";
	      // if not current page...
	      } else {
	         // make it a link
	         echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x' id=\"page-current-1\">$x</a></li> ";
	      } // end else
	   }  
	} // end for

	// if not on last page, show forward and last page links        
	if ($currentpage != $totalpages) {
	   // get next page
	   $nextpage = $currentpage + 1;
	    // echo forward link for next page 
	   echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage' id=\"page-next\">></a></li> ";
	   // echo forward link for lastpage
	   echo " <li><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages' id=\"page-total\">>></a></li> ";
	} 
	/****** end build pagination links ******/

}
