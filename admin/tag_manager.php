<?php 
include 'header.php'; 
$t = $db->query("select * from tag_manager where id = 1",database::GET_ROW);
?>

 <div class="panel panel-primary width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Mp3 Tag Manager</h2>
              </div>
            <div class="panel-body">

            <form method="post" action="tag_process.php" class="form-horizontal" role="form">

                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Title Tag</span>
                       <input type="text" class="form-control" name="title" id="" value="<?=$t['title']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Artist</span>
                       <input type="text" class="form-control" name="artist" id="" value="<?=$t['artist']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Album</span>
                       <input type="text" class="form-control" name="album" id="" value="<?=$t['album']?>">
                    </div>


                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Year</span>
                       <input type="text" class="form-control" name="year" id="" value="<?=$t['year']?>">
                   </div>

                   <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Genre</span>
                       <input type="text" class="form-control" name="genre" id="" value="<?=$t['genre']?>">
                   </div>

                   <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-music"></i> &nbsp;Default Comment</span>
                       <input type="text" class="form-control" name="comment" id="" value="<?=$t['comment']?>">
                   </div>

                    <div class="margintop-20">
                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit" />
                    </div>
             </form>            
    </div>
  </div>
<?php include $adminfolder.'footer.php'; ?>