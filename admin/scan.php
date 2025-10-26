<?php include 'header.php'; ?>
<?php
    $bulk = $_GET['bulk'];
    $folder_scan = '../bulk_dir_upload';
    $folder_scan_file = get_files($folder_scan,true);
?>
<? if ($bulk==1){ ?>
<div class="valid_box">
    <h2>Moved File Summery</h2>
    <ol>
        <li>Total file inserted in site : <strong><?php echo $_GET['tfi']; ?></strong> </li>
        <li>Total Exist Thumb which directly set to file : <strong><?php echo $_GET['tetm']; ?></strong> </li>
        <li>Total Make thumb for image file  : <strong><?php echo $_GET['tmt']; ?></strong> </li>
        <li>Total Created Directory : <strong><?php echo $_GET['tmd']; ?></strong> </li>
    </ol>
    <strong>Now You can remove Your scan_dir folder.</strong>
</div>
<? } ?>

  <div class="alert alert-warning">
    <i class="fa fa-warning fa-2x"></i> Please Sure to you have not a <b>Duplicate Filename</b> in same folder.
    Other Wise it will may have problem In viewing site.
  </div>


<div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Bulk Directory Upload</h2>
              </div>
   <div class="panel-body">
    
    <div class="alert alert-success">
    <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp; You have <b><?php echo count($folder_scan_file); ?></b> File in your bulk_dir_upload folder.
    </div>

    <ol>

        <li>It will automatically create <b>Videos Thumb</b></li>
        <li>It will automatically <b>Edit Mp3 Tag</b></li>
        <li>It will automatically create <b>Images Thumb</b></li>
        <li>It will not upload file which start from 'thumb-' </li>
        <li>Which file have same name file start with 'thumb-' (image file) it will automatic set it to proper file thumb.<br />
            <strong>Ex.</strong><br />
            if folder have this file<br />
            <strong>abc.sis</strong><br />
            And also have this file<br />
            <strong>thumb-abc.jpg or gif or png</strong><br />
            So thumb-abc.jpg set thumb for abc.sis
        </li>
        
     </ol>   
        
        <a class="btn btn-success margintop-20" href="scan.process.php"><i class="fa fa-upload"></i> Start Scan</a>
       
  
</div>


<?php include $adminfolder.'footer.php'; ?>