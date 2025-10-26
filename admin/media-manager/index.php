<?php include '../header.php'; ?>
<div class="panel panel-success width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Upload Zip Files</h2>
              </div>
                <div class="panel-body">
<form action="upload.php" method="post" class="form-horizontal" role="form">
<div class="input-group marginbot-20">
<span class="input-group-addon">File Name</span>
<input type="text" name="name" class="form-control" placeholder="Dont use special characters"/>
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Enter URL</span>
<input type="text" name="url" size="35" class="form-control"/> 
</div>
<input class="btn btn-success" type="submit" name="submit" id="submit" value="Upload" />
</div>
</form>
</div>
<?php include $adminfoldername.'/footer.php'; ?>
