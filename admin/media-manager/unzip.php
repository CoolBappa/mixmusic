<?php include '../header.php'; ?>
<div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Please choose a file to unzip:</h2>
              </div>
<div class="panel-body">
<?php
    // See if there's a file parameter in the URL string
    $file = $_GET['file'];
    $fp='zipfiles/'.$file.'';
    $path = $fp;
    
    if (isset($file))
    {
    $zip = new ZipArchive;
    if ($zip->open($path) === true) {
    for($i = 0; $i < $zip->numFiles; $i++) {
        $filename = $zip->getNameIndex($i);
        $fileinfo = pathinfo($filename);
        copy("zip://".$path."#".$filename, "unzip/".$fileinfo['basename']);
    }                  
    $zip->close();                  
    }
    header('location: word-replacer.php');
    exit;
    }
    // create a handler to read the directory contents
    $handler = opendir("zipfiles");
 
    
 
    // A blank action field posts the form to itself
    echo '<FORM action="" method="get" class="form-horizontal" role="form">';
 
    $found = FALSE; // Used to see if there were any valid files
 
    // keep going until all files in directory have been read
    while ($file = readdir($handler))
    {
        if (preg_match ("/.zip$/i", $file))
        {
            echo '<input type="radio" name="file" value=' . $file . '> ' . $file . ' <a href="del_zip.php?name='. $file .'"><i class="fa fa-trash-o"></i></a><br/>';
            $found = true;
        }
    }
 
    closedir($handler);
 
    if ($found == FALSE)
        echo "No files ending in .zip found<br>";
    else
        echo '<br>Warning: Existing files will be overwritten.<br><br><INPUT class="btn btn-primary" type="submit" value="Unzip!">';
 
    echo "</FORM>";
?>
</div>
</div>
<?php include $adminfoldername.'/footer.php'; ?>