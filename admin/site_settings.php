<?php 
include 'header.php'; 
$n = $db->query("select * from site_setting where id = 1",database::GET_ROW);
?>

     <div class="panel panel-success width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Site Settings</h2>
              </div>
            <div class="panel-body">

           <form method="post" action="site_settings_process.php" class="form-horizontal" role="form">

                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-spinner"></i> &nbsp;Site Title</span>
                       <input type="text" class="form-control" name="title" id="" value="<?=$n['title']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-spinner"></i> &nbsp;Sitename</span>
                       <input type="text" class="form-control" name="sitename" id="" value="<?=$n['sitename']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-file-text-o"></i> &nbsp;Meta Description</span>
                       <input type="text" class="form-control" name="metades" id="" value="<?=$n['metades']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-line-chart"></i> &nbsp;Google Analytics Code</span>
                       <textarea class="form-control" name="analytics" id=""><?=$n['analytics']?></textarea>
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-globe"></i> &nbsp;Google WebMaster Meta</span>
                       <textarea class="form-control" name="googlewebmaster" id=""><?=$n['googlewebmaster']?></textarea>
                    </div>
                    <div class="row">
                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-folder-o"></i> &nbsp;Cat Per page [Mob]</span>
                       <input type="text" class="form-control" name="catperpage_mob" id="" value="<?=$n['catperpage_mob']?>" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-folder-o"></i> &nbsp;Cat Per page [PC]</span>
                       <input type="text" class="form-control" name="catperpage_pc" id="" value="<?=$n['catperpage_pc']?>" size="54" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-file-o"></i> &nbsp;File Per page [Mob]</span>
                       <input type="text" class="form-control" name="fileperpage_mob" id="" value="<?=$n['fileperpage_mob']?>" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-file-o"></i> &nbsp;File Per page [PC]</span>
                       <input type="text" class="form-control" name="fileperpage_pc" id="" value="<?=$n['fileperpage_pc']?>" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-rss-square"></i> &nbsp;Update Per page [Mob]</span>
                       <input type="text" class="form-control" name="updateperpage_mob" id="" value="<?=$n['updateperpage_mob']?>" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-rss-square"></i> &nbsp;Update Per page [Pc]</span>
                       <input type="text" class="form-control" name="updateperpage_pc" id="" value="<?=$n['updateperpage_pc']?>" />
                     </div>
                    </div>

                    <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-plus-square-o"></i> &nbsp;Update Home [Mob]</span>
                       <input type="text" class="form-control" name="updatehome_mob" id="" value="<?=$n['updatehome_mob']?>" />
                     </div>
                    </div>
                     
                     <div class="col-xs-6">
                     <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-plus-square-o"></i> &nbsp;Update Home [PC]</span>
                       <input type="text" class="form-control" name="updatehome_pc" id="" value="<?=$n['updatehome_pc']?>" />
                     </div>
                    </div>
                    </div>
                    <div class="marginbot-30">
                    <div class="checkbox checkbox-danger checkbox-inline">
                        <?php
                        if($n['showfeatured'] == 1)
                        echo '<input type="checkbox" id="inlineCheckbox1" name="showfeatured" checked="checked" value="1" /><label for="inlineCheckbox1">Featured</label>';
                        else
                        echo '<input type="checkbox" id="inlineCheckbox1" name="showfeatured" value="1" /><label for="inlineCheckbox1">Featured</label>';
                        ?>
                    </div>

                    <div class="checkbox checkbox-danger checkbox-inline">
                        <?php
                        if($n['showlatest'] == 1)
                        echo '<input type="checkbox" id="inlineCheckbox2" name="showlatest" checked="checked" value="1" /><label for="inlineCheckbox2">Latest</label>';
                        else
                        echo '<input type="checkbox" id="inlineCheckbox2" name="showlatest" value="1" /><label for="inlineCheckbox2">Latest</label>';
                        ?> 
                    </div>

                    <div class="checkbox checkbox-danger checkbox-inline">
                        <?php
                        if($n['showtop'] == 1)
                        echo '<input type="checkbox" id="inlineCheckbox3" name="showtop" checked="checked" value="1" /><label for="inlineCheckbox3">Weekly Top Files</label>';
                        else
                        echo '<input type="checkbox" id="inlineCheckbox3" name="showtop" value="1" /><label for="inlineCheckbox3">Weekly Top Files</label>';
                        ?>  
                    </div>
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-star-o"></i> &nbsp;File Postfix</span>
                       <input type="text" class="form-control" name="filepostfix" id="" value="<?=$n['filepostfix']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-cog"></i> &nbsp;Create Thumbnail Size (W)</span>
                       <input type="text" class="form-control" name="thumbw" id="" value="<?=$n['thumbw']?>" size="5" maxlength="3" />
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-cog"></i> &nbsp;Display Thumbnail Size (H/W)</span>
                       <input type="text" class="form-control" name="dthumbh" size="5" maxlength="3" value="<?=$n['dthumbh']?>" /> 
                       <input type="text" class="form-control" name="dthumbw" size="5" maxlength="3" value="<?=$n['dthumbw']?>" />
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-file-leaf"></i> &nbsp;Image Watermark Text</span>
                       <input type="text" class="form-control" name="watermark" id="" value="<?=$n['watermark']?>">
                    </div>
                    
                    
                    <div class="margintop-20">
                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Update Settings" />
                    </div>
         </form>
        
    </div>
  </div>
<?php include $adminfolder.'footer.php'; ?>