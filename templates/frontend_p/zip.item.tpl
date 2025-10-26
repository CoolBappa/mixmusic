<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
if($folddetail['haszip']>0){
?>
<h2 class="title-dark">Download <?=str_replace('_',' ',$folddetail['name'])?> Zip Files (single link for all songs)</h2>
<div class="panel">
<div class="panel-body">
<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
echo '<div class="row">';
$zplist = $db->query('select * from `zip_files` where cid = '.$parentid.' order by kram desc'); 	
$TOTAL_ZIP_FILE =count($zplist);
foreach($zplist as $field => $zp){
echo '<div class="post-1 border-0">';
echo'<div class="post-thumb">';
echo '<button type="button" class="btn btn-sm btn-default btn-circle"><i class="fa fa-file-archive-o"></i></button>';
echo'</div>';
echo'<div class="post-data vertcent">';
echo '<a href="'.BASE_PATH.$folddetail['folder'].$zp['name'].'.zip">';
echo str_replace('_',' ',$folddetail['name']).' Zip Download ~ <span class="zipfile">'.str_replace($folddetail['name'],'',$zp['name']).'</span> &nbsp;&nbsp;&nbsp;<span class="size">['.getsize($zp['size']).']</span>';
echo '</a>';
echo '</div>';
echo '<div class="clear"></div>';
echo '</div>';
}
?>
</div>
</div>
</div>
<?}?>