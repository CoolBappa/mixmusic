<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
?>
<?
if($parentid > 0 or $def=='songs' or $def=='singer' or $def=='star' or $def=='search'){
echo '<div class="breadcrumb">'.$PATH.'</div>';
}
if($parentid==0)
include '../files/advt/mob/home_Bottom.php';
else
include '../files/advt/mob/all_bottom.php';
?>
</div>
<?if($parentid==0){?>
<div class="top-footer">
<div class="footer-link aligncenter">
<a href="<?=BASE_PATH?>contact/">Contact Us</a> - 
<a href="<?=BASE_PATH?>dmca/">DMCA</a>
</div>
<div class="copyright aligncenter"><a href="<?=BASE_PATH?>">&copy; 2010-<?php echo date("Y"); ?>  - <?=SITENAME?></a></div>
</div>
<?}else{?>
<?if($parentid ==! 0 || $def== 'download' || $def==! 'dmca' || $def==! 'contact' || $def ==! 'star' || $def ==! 'singer' || $def ==! 'songs' || $def ==! 'search'){?>
<div class="top-footer">
<?
if($folddetail[tag]==!""){
echo '<div class="tag">'.$folddetail[tag].'</div>';
}else{
if($def=='download'){
$tag= str_replace('_',' ',$getfile['name']).' - '.str_replace('_',' ',$folddetail['name']);
}else{
$tag= str_replace('_',' ',$folddetail['name']);
}
?>
<div class="tag">Tags: <?=$tag?> Mp3 Songs Download, <?=$tag?> iTunes Rip Mp3 Songs Download, <?=$tag?> 128 Kbps Mp3 Songs Free Download, <?=$tag?> 320 Kbps Mp3 Songs Free Download, <?=$tag?> Mp3 Songs Download In High Quality, <?=$tag?> Mp3 Songs Download 320kbps Quality, <?=$tag?> Mp3 Songs Download, <?=$tag?> All Mp3 Songs Download, <?=$tag?> Full Album Songs Download</div>
<? } ?>
</div>
<?}?>
<div class="footer">
<span class="copyright"><a href="<?=BASE_PATH?>">&copy; 2010-<?php echo date("Y"); ?>  - <?=SITENAME?></a></span>
</div>
<?}?>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
ga('create', '<?=$headset['analytics']?>', 'auto');
ga('send', 'pageview');
</script>  
<?$db->disconnect();?>
</body>
</html>