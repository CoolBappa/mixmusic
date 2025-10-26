<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
$search = $_GET['search']; 
$def = search;
$PATH = '<a href="'.BASE_PATH.'">Home</a> / Search Files';
include 'header.tpl';
if (!isset($_GET['search'])){  
echo '<div class="alert alert-danger">';
echo '<i class="fa fa-frown-o"></i> Search query too short or no search query, you may search again';
echo '</div>';
}
if (isset($_GET['search'])){
if(preg_match('/[#$%^&*()+=\-\[\]\';,.\/{}|":<>?~\\\\]/',$_GET['search'])){
echo '<div class="alert alert-danger"><i class="fa fa-frown-o"></i> Oops some symbol encountered !!</div>';
}
elseif ($_GET['search'] == ''){
echo '<div class="alert alert-danger"><i class="fa fa-frown-o"></i> Search Missing..!!</b>&nbsp;Write something on search</div>';
}else{
$arr_words = explode(" ", $search);
foreach($arr_words as $word)
{
$word = trim($word);
$seq = "select *  from category as c,file as f where (f.name like '%" . $word . "%' and f.cid = c.id)";
}
$rowsPerPage = FILEPERPAGE_MOB;
$pagingqry = $seq;
$gets = '?';
if ($sort == '')
$sort = 'category';
$pagelink = BASE_PATH . 'search/' .$search. '/';
//echo $sort;
$htmlpage = '/';
$pagingpassid = 'f.id';
include 'paging.tpl';
if(isset($_GET['page'])){
if($_GET['page'] > $maxPage or $_GET['page'] == '0'){
header('HTTP/1.1 404 Not Found');
header("Refresh:0; url=".BASE_PATH."404.php");
exit();
}
}
$FILE = $db->query($pagingqry . $limit,0,'no');
$LISTTOTAL = $numrows;
?>
<h2 class="title-red">Search Results for "<?=$search?>"</h2>
<div class="panel panel-default">
<div class="panel-body">
<?
if ($LISTTOTAL != 0){
include 'item.tpl';
}else{
?>
<div class="alertbox" style="margin-bottom:10px">Opps..! Sorry No match found for <b>"<?= $search ?>"</b></div>
<? } ?>
</div>
</div>
<? } ?>
<? } ?>
<? include 'footer.tpl'; ?>