<?if($parentid==0 && $def==! 'dmca' && $def==! 'contact' && $def ==! 'star' && $def ==! 'singer' && $def ==! 'songs'){?>
<title><?=SITENAME?> :: <?=SITETITLE?></title>
<?}?>
<?if($parentid > 0 && $def==! 'download'){?>
<?if($folddetail[title]==""){?>
<title><?=str_replace('_',' ',$getfile['name'])?> <?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?></title>
<?}else{?>
<title><?=$folddetail[title]?> <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?></title>
<?}?>
<?}?>
<?if($def == 'download'){?>
<title><?=str_replace('_',' ',$getfile['name'])?> <?=str_replace('_',' ',$folddetail[name])?> Mp3 Song Download - <?=SITENAME?></title>
<?}?>
<?if($def == 'search'){?>
<?if($_GET['search'] == ''){?>
<title>Search Files For Free Download - <?=SITENAME?></title>
<?}else{?>
<title><?=$_GET['search']?> Free Download <? if($_GET['page']==!""){echo '- Page-'.str_replace('/',' ',$_GET['page']).' ';}?> - <?=SITENAME?></title>
<?}?>
<?}?>
<?if($def == 'latest'){?>
<title>New Release Mp3 Songs - Page-<?=str_replace('/',' ',$_GET['page'])?> - <?=SITENAME?></title>
<?}?>
<?if($def == 'contact'){?>
<title>Contact Us - <?=SITENAME?></title>
<?}?>
<?if($def == 'dmca'){?>
<title>DMCA - <?=SITENAME?></title>
<?}?>
<?if($def == 'star'){?> 
<title>Popular Stars Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?></title>
<?}?>
<?if($def == 'singer'){?> 
<title>Popular Singers Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?></title>
<?}?>
<?if($def == 'songs'){?> 
<title><?=$name?> Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?></title>
<?}?>