<?php include '../header.php'; ?>
<div class="panel panel-success width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Upload Zip Files by URL</h2>
              </div>
                <div class="panel-body">
<form action="upload-zip.php" method="post" class="form-horizontal" role="form">
<div class="input-group marginbot-20">
<span class="input-group-addon">File Name</span>
<input type="text" name="name" class="form-control" placeholder="Dont use special characters"/>
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Enter URL</span>
<input type="text" name="url" size="35" class="form-control"/> 
</div>
<input type="hidden" name="id" value="<?=$_GET['id']?>"/>
<input class="btn btn-success" type="submit" name="submit" id="submit" value="Upload" />
</div>
</form>
</div>

<?php
if($_GET['pid'] != '')
    header('location: index.php?pid='.$_GET['pid']);
if ($_GET['id'] == '')
    exit;

$parentid = $_REQUEST['id'];

//dir_list.php
$default_dir = "../../files/bulk_upload/";

// lists files only for the directory which this script is run from
$listfile = array();
$i = 0;
if (!($dp = opendir($default_dir)))
    die("Cannot open $default_dir.");
while (false !== ($file = readdir($dp))) {
    if (!is_dir($file)) {
        if ($file != '.' && $file != '..') {
            $listfile[$i]['filename'] = $file;
            $i++;
        }
    }
}
closedir($dp);
$seq = "select path from category where id = " . $_REQUEST['id'];
$PATH = '<a href="index.php">Home</a>&nbsp;' . $db->query($seq, database::GET_FIELD);
?>

<div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Bulk Zip Files Upload</h2>
              </div>
            <div class="panel-body">
    
    
    <table class="table table-striped table-border-custom text-center">
        <thead>
            <tr>
                <td class="text-center" width="50px">No</td>
                <td class="text-center">File Name</td>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $start_sr_no = 1;
            foreach ($listfile as $key => $val) {
            ?>
                <tr>
                    <td><?php echo $start_sr_no++ ?></td>
                    <td>
                    <?= $val['filename'] ?>
                </td> 
            </tr>
              
            <? }?>
          </tbody>
        </table>
              <?
if ($val['filename']==''){
echo 'No files to upload...please add file to folder directory';
}
?>
                 <form name="fr" method="post" action="zipupload_process.php" class="text-center">
                 <input type="hidden" name="pid" value="<?= $parentid ?>" />
                 <button type="submit" class="btn btn-success" name="Upload" value="Upload Zip Files"/><i class="fa fa-arrow-circle-up"></i> Upload</button>
                 <a class="btn btn-primary" href="index.php?pid=<?=$parentid?>"><i class="fa fa-chevron-left"></i> Back to File List</a>
              </form>
               

      </div>
    </div>

<? include $adminfoldername.'/footer.php'; ?>