<?php include '../header.php'; ?>
<div class="panel panel-default width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Word replacer</h2>
              </div>
            <div class="panel-body">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline" role="form">
<div class="input-group marginbot-20">
<span class="input-group-addon">Replace Word :</span>
<input type="text" name="word" size="35" class="form-control"/>
</div>
<div class="input-group marginbot-20">
<input type="submit" class="btn btn-primary" name="submit" value="Replace" />
</div>
</form>
</div>
</div>
<? if($_POST["submit"]){ ?>
<div class="alert alert-success width-800">Word Replacing Done..!!</div>
<? } ?>
<div class="panel panel-primary width-800">
              <div class="panel-heading">
                <h2 class="panel-title pull-left margintop-5">Listed Files : </h2>
                <div class="pull-right">
                  <a class="btn btn-sm btn-danger" href="word-replacer.php"><i class="fa fa-refresh"></i> Refresh List</a> 
                </div>
              <div class="clear"></div>
              </div>
            <div class="panel-body">
         
<?php
// you can add to the array
$ext_array = array(".htm", ".php", ".asp", ".js");
//list of extensions not required (above)
$dir1 = "unzip"; 
$filecount1 = 0; 
$d1 = dir($dir1); 

while ($f1 = $d1->read()) { 
$fext = substr($f1,strrpos($f1,".")); //gets the file extension
if (in_array($fext, $ext_array)) { //check for file extension in list
continue;
}else{
if(($f1!= '.') && ($f1!= '..')) { 
if(!is_dir($f1)) $filecount1++;


if(isset($_POST['submit'])) {
$replace_word=$_POST["word"];
$replaced_name = str_replace($replace_word,'', $f1);
rename($dir1 . '/' . $f1, $dir1 . '/' . $replaced_name);
}

$thelist .= '<li>'.$f1.'</li>';
} 
}
}
?>

<ul><?=$thelist?></ul>
</div>
</div>
<p><a class="btn btn-success" href="move.php?move=1">Next Step</a></p>

<?php include $adminfoldername.'/footer.php'; ?>
