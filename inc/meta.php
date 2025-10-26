<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Identifier-URL" content="<?=BASE_PATH?>" />
<meta name="robots" content="index, follow" />
<meta name="language" content="en" />
<meta name="google-site-verification" content="<?=$headset['googlewebmaster']?>" />
<?if($parentid==0 && $def==! 'dmca' && $def==! 'contact' && $def ==! 'star' && $def ==! 'singer' && $def ==! 'songs'){?>
<meta name="title" content="<?=SITENAME?> - <?=SITETITLE?>" />
<meta name="description" content="<?=$headset['metades']?>" />
<?}?>
<?if($parentid > 0 && $def==! 'download'){?>
<meta name="title" content="<?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?>" />
<meta name="description" content="<?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs, A To Z <?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs, Best Mp3 Songs From <?=str_replace('_',' ',$folddetail[name])?><?if($folddetail[artist]==!''){?>, <?=str_replace('_',' ',$folddetail[artist])?><?}?> - <?=SITENAME?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="object" />
<meta property="og:title" content="<?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs - <?=SITENAME?>" />
<meta property="og:description" content="<?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs, All <?=str_replace('_',' ',$folddetail[name])?> Songs Free Download - <?=SITENAME?>" />
<meta property="og:url" content="<?echo'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
<meta property="og:site_name" content="<?=BASE_PATH?>" />
<?}?>
<?if($def == 'download'){?>
<meta name="title" content="<?=str_replace('_',' ',$getfile['name'])?> <?=str_replace('_',' ',$folddetail[name])?> Mp3 Song Download - <?=SITENAME?>" />
<meta name="description" content="<?=str_replace('_',' ',$getfile['name'])?> Song Free Download, <?=str_replace('_',' ',$folddetail[name])?> - Mp3 Song Free Download in 64Kbps, 128Kbps & 320Kbps - <?=SITENAME?>" />
<meta property="og:locale" content="en_US" />
<meta property="og:type" content="object" />
<meta property="og:title" content="<?=str_replace('_',' ',$getfile['name'])?> <?=str_replace('_',' ',$folddetail[name])?> Mp3 Songs - <?=SITENAME?>" />
<meta property="og:description" content="<?=str_replace('_',' ',$getfile['name'])?> Mp3 Song of <?=str_replace('_',' ',$getfile['artist'])?> From <?=str_replace('_',' ',$folddetail[name])?> Songs Free Download - <?=SITENAME?>" />
<meta property="og:url" content="<?echo'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>" />
<meta property="og:site_name" content="<?=BASE_PATH?>" />
<?}?>
<?if($def == 'search'){?>
<?if($_GET['search'] == ''){?>
<meta name="title" content="Search Files For Free Download - <?=SITENAME?>" />
<meta name="description" content="Search &amp; Download Thousand of Free Mp3 Songs - <?=SITENAME?>" />
<?}else{?>
<meta name="title" content="<?=$_GET['search']?> Free Download <? if($_GET['page']==!""){echo '- Page-'.str_replace('/',' ',$_GET['page']).' ';}?> - <?=SITENAME?>" />
<meta name="description" content="Search &amp; Download Thousand of Free Mp3 Songs - <?=SITENAME?>" />
<?}?>
<?}?>
<?if($def == 'latest'){?>
<meta name="title" content="New Release Mp3 Songs - Page-<?=str_replace('/',' ',$_GET['page'])?> - <?=SITENAME?>" />
<meta name="description" content="New Release Mp3 Songs Free to Download &amp; Listen - <?=SITENAME?>" />
<?}?>
<?if($def == 'star'){?> 
<meta name="title" content="Popular Stars Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?>" />
<meta name="description" content="Popular Stars Mp3 Songs & Albums Free to Download &amp; Listen - <?=SITENAME?>" />
<?}?>
<?if($def == 'singer'){?> 
<meta name="title" content="Popular Singers Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?>" />
<meta name="description" content="Popular Singers Mp3 Songs & Albums Free to Download &amp; Listen - <?=SITENAME?>" />
<?}?>
<?if($def == 'songs'){?> 
<meta name="title" content="<?=$name?> Mp3 Songs & Albums <?if($_GET['page']){?> - Page-<?=str_replace('/',' ',$_GET['page'])?> <?}?>- <?=SITENAME?>" />
<meta name="description" content="<?=$name?> Mp3 Songs & Albums Free to Download &amp; Listen - <?=SITENAME?>" />
<?}?>