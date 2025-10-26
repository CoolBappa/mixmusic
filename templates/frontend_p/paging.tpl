<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$pageNum = 1;
if(isset($_GET['page']))
{
$pageNum = $_GET['page'];
}
$PAGE = $pageNum;
$offset = ($pageNum - 1) * $rowsPerPage;			
$limit = " LIMIT $offset, $rowsPerPage";
if($pagingpassid == '' )
$pagingpassid = 'id';
$numrows = $db->numrow($pagingqry,$pagingpassid);
if($numrows>0)
{
$maxPage = ceil($numrows/$rowsPerPage);
$self = $_SERVER['PHP_SELF'].$gets;
$nav  = '';
if($pageNum > 2)
{
$startpage = $pageNum - 2;
}
else
$startpage = 1;
$endpage = $startpage + 5;
if($endpage > $maxPage)
$endpage = $maxPage+1;
if($maxPage > 1)
{
for($page = $startpage; $page < $endpage; $page++)
{
if ($page == $pageNum)
{
$nav .= "<span class='cur'>".$page."</span>";
}
else
{
$nav .= "<a href=\"$pagelink$page$htmlpage\">$page</a>";
} 
}
}
if ($pageNum > 1)
{
$page  = $pageNum - 1;
$prev  = "<a href=\"$pagelink$page$htmlpage\"><i class='fa fa-angle-left'></i></a>";
$gofirst = 1;
$first = "<a href=\"$pagelink$gofirst$htmlpage\" ><i class='fa fa-angle-double-left'></i></a>";
} 
else
{
$prev  = '<a href="#"><i class="fa fa-angle-left"></i></a>'; 
$first = '';
}
if ($pageNum < $maxPage)
{
$page = $pageNum + 1;
$next = "<a href=\"$pagelink$page$htmlpage\"><i class='fa fa-angle-right'></i></a>";
$last = "<a href=\"$pagelink$maxPage$htmlpage\"><i class='fa fa-angle-double-right'></i></a>";
} 
else
{
$next = '';
$last = '<a href="#"><i class="fa fa-angle-right"></i></a></li>';
}
$jumppage = '';
$jumppage .= '<form name="frme" class="basic-grey" method="get" action="'.BASE_PATH.'jumppage.php">';
$jumppage .= '<p class="finfo">Jump to : ';
$jumppage .= '<select name="page">';
for($i=1;$i<=$maxPage;$i++)
{
if($i == $pageNum)
$jumppage .= "<option value='$i' selected='selected'>$i</option>";
else
$jumppage .= "<option value='$i'>$i</option>";
}
$jumppage .= "</select>";
$jumppage .= "<input type='submit' id='submit' name='go' value='Go' />";
$jumppage .= "<input type='hidden' name='pagelink' value='".$pagelink."' />";
$jumppage .= "<input type='hidden' name='htmlpage' value='".$htmlpage."' />";
$jumppage .= '</p></form>';
if($maxPage > 1)
{
$str = $first . $prev . $nav . $next . $last  ;	
$PAGE_CODE = '<div class="pgn">'.$str.'</div>';	
}
}
else
{
$PAGE_CODE = '<div class="post text-center">No Songs or Movies</div>';
}
?>
