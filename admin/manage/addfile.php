<?php 
include '../header.php';
if ($_GET['id'] == '')
    exit;

$id = $_REQUEST['id'];
?>

<div class="panel with-nav-tabs panel-info width-800">
  <div class="panel-heading">
    <ul class="nav nav-tabs" id="myTab">
        <li class="active"><a href="#sectionA">Upload File</a></li>
        <li><a href="#sectionB">Upload Image</a></li> 
              
    </ul>
</div>
  <div class="panel-body">
    <div class="tab-content">
        <div id="sectionA" class="tab-pane fade in active">
            <h3>Upload File</h3>
            <p>
            <form action="addfile_process.php" method="post" enctype="multipart/form-data" id="loginform" class="form-horizontal" role="form">

            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file"></i> &nbsp;Filename</span>
                <input type="text" class="form-control" name="name" placeholder="use alphanumeric characters only" />
            </div>

            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Upload from url</span>
                <input type="text" class="form-control" name="url" id="" placeholder="paste url with http://" />
            </div>

            <div class="input-group marginbot-20">
                <b>Or,</b>
            </div>
            <div class="input-group marginbot-20">
              <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                Browse file..<input type="file" name="file"/>
                </span>
               </span>
                <input type="text" class="form-control" placeholder="File to upload.." readonly>
            </div>


            <div class="input-group marginbot-20">
                <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                 Browse thumb..<input type="file" name="thumb"/>
                </span>
              </span>
                <input type="text" class="form-control" placeholder="Only jpg file.."readonly>
            </div>

  
           <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file-text"></i> &nbsp;Description</span>
                <textarea name="desc"></textarea>
           </div>
 

           <div class="clear marginbot-20"></div>
           <div class="pull-right">      
           <input type="hidden" name="cid" value="<?= $id ?>" />
           <button class="btn btn-success" type="submit" name="submit" id="submit" value="Upload File"/><i class="fa fa-arrow-circle-up"></i> Upload File</button> 
           <a href="index.php?pid=<?= $id ?>" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</a>
           </div>
    </form>
            </p>
        </div>
        <div id="sectionB" class="tab-pane fade">
            <h3>Upload Image</h3>
            <p>
             <form action="addimage_process.php" method="post" enctype="multipart/form-data" id="loginform" class="form-horizontal" role="form">

            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file"></i> &nbsp;Filename</span>
                <input type="text" class="form-control" name="name" placeholder="use alphanumeric characters only" />
            </div>

            <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Upload from url</span>
                <input type="text" class="form-control" name="url" id="" placeholder="paste url with http://" />
            </div>

            <div class="input-group marginbot-20">
                <b>Or,</b>
            </div>
            <div class="input-group marginbot-20" id="dynamicInput">
              <span class="input-group-btn">
                <span class="btn btn-info btn-file">
                Browse file..<input type="file" name="file"/>
                </span>
               </span>
                <input type="text" class="form-control" placeholder="File to upload.." readonly>
            </div>

           <div class="input-group marginbot-20">
                <span class="input-group-addon"><i class="fa fa-file-text"></i> &nbsp;Description</span>
                <textarea name="desc"></textarea>
           </div>
           <div class="pull-right">
           <div class="checkbox checkbox-warning checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox3" name="newtag" value="1">
                        <label for="inlineCheckbox3">Enable New Tag ?</label>
           </div>
           </div>
           <div class="clear marginbot-20"></div>
           <div class="pull-right">      
           <input type="hidden" name="cid" value="<?= $id ?>" />
           <button class="btn btn-success" type="submit" name="submit" id="submit" value="Upload File"/><i class="fa fa-arrow-circle-up"></i> Upload File</button> 
           <a href="index.php?pid=<?= $id ?>" class="btn btn-danger"><i class="fa fa-remove"></i> Cancel</a>
           </div>
    </form>
            </p>
        </div>
    </div>
  </div>
</div>
</div></div>
<?php include $adminfoldername.'/footer.php'; ?>
