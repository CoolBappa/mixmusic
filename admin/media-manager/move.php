<?php include '../header.php'; ?>
<div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-edit fa-2x"></i> Edit Category</h2>
              </div>
   <div class="panel-body">
<?
if($_GET[move]==1){
// Get array of all source files
$files = scandir("unzip");
// Identify directories
$source = "unzip/";
$destination = "../../files/bulk_upload/";

// Cycle through all source files
foreach ($files as $file) {
  if (in_array($file, array(".",".."))) continue;
  // If we copied this successfully, mark it for deletion
  if (copy($source.$file, $destination.str_replace(' ','_',$file))) {
    $delete[] = $source.$file;
  }
}
// Delete all successfully-copied files
foreach ($delete as $file) {
  unlink($file);
}
echo '<div class="alert alert-success"><h3>All Files Moved & Ready for Upload..!!</h3></div>';
echo '<p><a class="btn btn-primary" href="/admin/manage/">Go & Manage Files</a></p>';
}else{

 echo '<div class="alert alert-danger">No Files for Moving</div>';

} 
?>
</div>
</div>
<?php include $adminfoldername.'/footer.php'; ?>