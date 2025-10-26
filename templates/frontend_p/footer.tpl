<?php
if (basename($_SERVER['PHP_SELF']) == basename(__FILE__)) { die('Access denied'); };
include '../files/advt/pc/all_page_bottom.php';
?>
</div>
</div>
</div>
<?if($parentid==0){?>
<div class="top-footer">
<div class="container">
<div class="row">
<div class="wrapper padding-0 pull-left">
<div class="social"><a href="http://facebook.com/mixmusicin"><i class="fa fa-facebook"></i></a></div>
<div class="social"><i class="fa fa-twitter"></i></div>
<div class="social"><i class="fa fa-google-plus"></i></div>
</div>
<div class="footer-link pull-right">
<a href="<?=BASE_PATH?>contact/">Contact Us</a> - 
<a href="<?=BASE_PATH?>dmca/">DMCA</a>
<span class="copyright"><a href="<?=BASE_PATH?>">&copy; <?php echo date("Y"); ?>  - <?=SITENAME?></a></span>
</div>
</div>
</div>
<?}else{?>
<?if($parentid ==! 0 || $def== 'download' || $def==! 'dmca' || $def==! 'contact' || $def ==! 'star' || $def ==! 'singer' || $def ==! 'songs' || $def ==! 'search'){?>
<div class="top-footer">
<div class="container">
<div class="row">
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
</div>
</div>
<?}?>
<div class="footer">
<div class="container">
<div class="row">
<span class="copyright"><a href="<?=BASE_PATH?>">&copy; <?php echo date("Y"); ?>  - <?=SITENAME?></a></span>
</div>
</div>
</div>
<?}?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/bootstrap3_player.js?1.2"></script>
<script type="text/javascript" src="/js/lightslider.min.js?1.1"></script>
<script>
$(document).ready(function() {
$('#content-slider').lightSlider({
item:5,
slideMove:1,
loop:true,
easing: 'cubic-bezier(0.25, 0, 0.25, 1)',
speed:600,
pager: false
});  
});
</script>
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TQJP8K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TQJP8K');</script>
<!-- End Google Tag Manager -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-78056335-1', 'auto');
  ga('send', 'pageview');

</script>
<?$db->disconnect();?>
</body>
</html>