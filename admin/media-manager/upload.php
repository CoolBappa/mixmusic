<?php include '../header.php'; ?>
<div class="panel panel-success width-800">
              <div class="panel-heading">
                <h2 class="panel-title"><i class="fa fa-edit fa-2x"></i> Upload Status</h2>
              </div>
<div class="panel-body">
<?php
// UPLOAD.PHP
$name=$_POST["name"];
if($name == ""){
echo 'Please enter filename with extension';
exit();
}
if($_POST["submit"]){
$url = trim($_POST["url"]);
if($url){
$file = fopen($url,"rb");
if($file){
$directory = "zipfiles/"; // Directory to upload files to.
$valid_exts = array("zip","mp3"); // valid extensions
$ext = end(explode(".",strtolower(basename($url))));
if(in_array($ext,$valid_exts)){
$rand = rand(1000,9999);
$filename = $name;
$newfile = fopen($directory . $filename, "wb"); // creating new file on local server
if($newfile){
while(!feof($file)){
// Write the url file to the directory.
fwrite($newfile,fread($file,1024 * 8),1024 * 8); // write the file to the new directory at a rate of 8kb/sec. until we reach the end.
}
echo '<h3>Zip File uploaded successfully!</h3>';
echo '<a class="btn btn-info" href="index.php">Upload Another</a> <a class="btn btn-success" href="unzip.php">Next Step</a>';
//echo ''.$directory.$filename.'';
} else { echo 'Could not establish new file ('.$directory.$filename.') on local server. Be sure to CHMOD your directory to 777.'; }
} else { echo 'Invalid file type. Please try another file.'; }
} else { echo 'Could not locate the file: '.$url.''; }
} else { echo 'Invalid URL entered. Please try again.'; }
}
?>
</div>
</div>
<?php include $adminfoldername.'/footer.php'; ?>