<?php include 'includes/admin-config.php'; ?>
<?php
	$title = $_REQUEST['title'];
	$sitename = $_REQUEST['sitename'];
	$metades = $_REQUEST['metades'];
	$analytics = $_REQUEST['analytics'];
        $googlewebmaster = $_REQUEST['googlewebmaster'];
	$catperpage_mob = $_REQUEST['catperpage_mob'];
        $catperpage_pc = $_REQUEST['catperpage_pc'];
	$fileperpage_mob = $_REQUEST['fileperpage_mob'];
        $fileperpage_pc = $_REQUEST['fileperpage_pc'];
        $updateperpage_mob = $_REQUEST['updateperpage_mob'];
        $updateperpage_pc = $_REQUEST['updateperpage_pc'];
        $updatehome_mob = $_REQUEST['updatehome_mob'];
        $updatehome_pc = $_REQUEST['updatehome_pc'];
	$filepostfix = $_REQUEST['filepostfix'];
	$thumbw = $_REQUEST['thumbw'];
	$dthumbw = $_REQUEST['dthumbw']; 
	$dthumbh = $_REQUEST['dthumbh'];
        $watermark = $_REQUEST['watermark'];
        if($_REQUEST['showtop'] == 1){
        $showtop = '1';}
        if($_REQUEST['showfeatured'] == 1){
        $showfeatured = '1';}
        if($_REQUEST['showlatest'] == 1){
        $showlatest = '1';}
        
	
	
	$nn = "update site_setting set 

                        title = '$title',
                        sitename = '$sitename',
			metades = '$metades', 
			analytics = '$analytics' ,
                        googlewebmaster = '$googlewebmaster',
                        catperpage_mob = '$catperpage_mob' ,
                        catperpage_pc = '$catperpage_pc' ,
                        fileperpage_mob = '$fileperpage_mob' ,
                        fileperpage_pc = '$fileperpage_pc' ,
                        updateperpage_mob = '$updateperpage_mob',
                        updateperpage_pc = '$updateperpage_pc',
                        updatehome_mob = '$updatehome_mob',
                        updatehome_pc = '$updatehome_pc',
                        filepostfix = '$filepostfix',
			thumbw = '$thumbw',
			dthumbw = '$dthumbw',
			dthumbh = '$dthumbh',
                        watermark = '$watermark',
                        showtop = '$showtop',
                        showlatest = '$showlatest',
                        showfeatured = '$showfeatured'
			where id = 1";
	$db->query($nn);
	
	header("location: site_settings.php?errid=11");
?>