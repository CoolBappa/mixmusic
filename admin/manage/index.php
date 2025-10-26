<?php include '../header.php'; ?>
<script src="<?= BASE_PATH ?>js/validation.js"></script>
<script language="javascript" >
    var compulsory = new Array('name');
    var dispError = new Array('category name !');
</script>
<script>
$(function(){

$('#trigger').click(function(){
  $('#myModal').modal('show');
  return false;
})
});

</script>

<?php
if($_GET['pid'] != '')
    $parentid = $_GET['pid'];
else
    $parentid = 0;

if($parentid != 0)
{
	$seq = "select path from category where id = ".$parentid;
	$PATH = $db->query($seq,database::GET_FIELD);
}

$WHER = 'where parentid = '.$parentid . ' order by kram desc';

$pagingqry = "select * from category ".$WHER;


$rowsPerPage=25;
$gets='?';

$pagelink = ADMIN_BASE_PATH.'manage/index.php?pid='.$parentid.'&page=';
//echo $sort;
$htmlpage = '';

include("../../inc/paging_admin.php");

$CATEGORY = $db->query($pagingqry.$limit);

if($parentid != 0)
{
$filepagingqry = 'select * from file where cid = '.$parentid .' order by kram desc';

$FILEC = $db->query($filepagingqry.$limit);

$tot_file= count($FILEC);

$ids = $_GET['pid'];
$qs = "select * from category where id = ".$ids;
$CATEGORYS = $db->query($qs,  database::GET_ROW);
$prid = $CATEGORYS['parentid'];
$grid = $CATEGORYS['groupid'];

$group_list = $db->query('select * from `homegroup`  where id <> '.$grid.' order by id desc');
$gs = "select * from homegroup where id = ".$grid;
$GROUP = $db->query($gs,  database::GET_ROW);
if($grid=="0"){
$GROUP['name'] ="Select HomeGroup";
}

}
$totalcategory = $numrows;

$start_sr_no = $offset + 1;

 if($_GET[page] == ''){
            $set_page= "&page=1";
            }else{
            $set_page="&page=".$_GET[page];
            }
?>
    <ol class="breadcrumb">
    <i class="fa fa-home"></i>  <a href="<?=ADMIN_BASE_PATH?>">Home</a> &raquo; <a href="index.php">Manage</a><?=$PATH?>
    </ol>
    <div class="btn-toolbar" style="margin-bottom: 20px;"> 

    <? 
    if($parentid == 0){
    echo '<a href="#" class="submenuheader btn btn-primary btn-info"><i class="fa fa-plus"></i> Add Category</a>';
    }elseif($CATEGORYS['subcate']== 1){
    echo '<a href="#" class="submenuheader btn btn-primary btn-info"><i class="fa fa-plus"></i> Add Category</a>';
    }else{
    if($tot_file > 0){ 
    echo '
          <a href="addfile.php?id='.$parentid.'" class="btn btn-primary btn-primary"><i class="fa fa-cloud-upload"></i> Upload File</a> 
          <a class="btn btn-primary btn-danger" href="bulkupload.php?id='.$parentid.'"><i class="fa fa-flash"></i> Upload Bulk Files</a>
          <a class="btn btn-primary btn-success" href="zipupload.php?id='.$parentid.'"><i class="fa fa-file-archive-o"></i> Upload Zip Files</a>
          <a href="movefiles.php?id='.$parentid.'" class="btn btn-primary btn-warning"><i class="fa fa-level-up"></i> Move All Files</a>';
          

   
                }else{

    echo '
          <a href="addfile.php?id='.$parentid.'" class="btn btn-primary btn-primary"><i class="fa fa-cloud-upload"></i> Upload File</a> 
          <a class="btn btn-primary btn-danger" href="bulkupload.php?id='.$parentid.'"><i class="fa fa-flash"></i> Upload Bulk Files</a>
          <a class="btn btn-primary btn-success" href="zipupload.php?id='.$parentid.'"><i class="fa fa-file-archive-o"></i> Upload Zip Files</a>
          <a href="#" class="submenuheader btn btn-primary btn-info"><i class="fa fa-plus"></i> Add Category</a>';
  
                     }
         }
           
     ?>
          <? 
          if($totalcategory == 0)
          {
          echo '<a class="btn btn-default pull-right" href="add_update.php?id='.$CATEGORYS['id'].'&action=on"><i class="fa fa-plus"></i> Add to Update</a>';
          echo '<div class="clear"></div>';
          }
          ?>
     </div>
  
    
         <? if($tot_file == 0){ ?>
            <div class="submenu pull-left">
                 <div class="panel panel-primary width-800">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-edit"></i> Add Category</h2>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="addcategory_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">

<div class='form-group'>
<label class="control-label col-sm-2"><b>Name :</b></label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="name" size="40" id="">
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"></label>
<div class="col-sm-10">
<span class="small text text-danger">**Singers & Stars Not in List ?</span> <button type="button" class="btn btn-xs btn-warning" id="trigger" /> Add Now!</button>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>Singers Name :</b></label>
<div class="col-sm-10">
<ul id="singers">
</ul>
<input id="mySingleField2" name="artname" type="hidden"/>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>Stars Name :</b></label>
<div class="col-sm-10">
<ul id="stars">
</ul>
<input id="mySingleField" name="strname" type="hidden"/>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>Custom Title :</b></label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="title" size="40" id="">
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>SEO Tags :</b></label>
<div class="col-sm-10">
<textarea name="tag"></textarea>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>Description :</b></label>
<div class="col-sm-10">
<textarea name="des"></textarea>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>URL Slug :</b></label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="slug" size="40" id="" placeholder="please use hypen (-) instead of space">
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"><b>Custom Link :</b></label>
<div class="col-sm-10">
<input type="text"  class="form-control" name="customlink" size="40" id="">
</div>
</div>
<!--<div class="input-group marginbot-20">
<span class="input-group-btn">
<span class="btn btn-info btn-file">
Browse folder thumb..<input type="file" name="thumb"/>
</span>
</span>
<input type="text" class="form-control" readonly>
</div>-->

<div class='form-group'>
<label class="control-label col-sm-2"></label>
<div class="col-sm-10">
<input type="hidden" name="pid" value="<?=$parentid?>" />
<input type="submit" name="submit" id="submit" class="btn btn-success" value="Add Category"/>
</div>
</div>
</form>
</div>
</div> 
</div>
<div class="clear"></div>

<? } ?>


<div id="myModal" class="modal fade">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><i class="fa fa-star"></i> Add Singers & Star</h4>
</div>
<div class="modal-body">
<form class="form-horizontal" id="form" method="post" enctype="multipart/form-data">

<div class="input-group marginbot-20">
<label class="myCheckbox">Singer <input id="s_fac" type="checkbox" class="sev_check" name="singer" value="1"><span></span></label>
<label class="myCheckbox">Star <input id="s_fac" type="checkbox" class="sev_check" name="star" value="1"><span></span></label>
</div>
        

<div class="input-group marginbot-20">
<span class="input-group-addon">Name</span>
<input type="text"  class="form-control" name="name" size="40" id="">
</div>

<div class="input-group marginbot-20">
<span class="input-group-addon">Description</span>
<textarea name="desc"></textarea>
</div>

<div class="input-group marginbot-20">
<span class="input-group-btn">
<span class="btn btn-info btn-file">
Browse Thumb..<input type="file" name="thumb"/>
</span>
</span>
<input type="text" class="form-control" readonly>
</div>

<div class="clear marginbot-20"></div>
<input type="hidden" name="pid" value="<?=$parentid?>" />
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
<button type="submit" id="submit" class="btn btn-primary">Add</button>
</form>
</div>
</div>
</div>
</div>
<div class="clear"></div>





<script>
$(document).ready(function() {
  $('.sev_check').each(function() {
    $(this).addClass('unselected');
  });
  $('.sev_check').on('click', function() {
    $(this).toggleClass('unselected');
    $(this).toggleClass('selected');
    $('.sev_check').not(this).prop('checked', false);
    $('.sev_check').not(this).removeClass('selected');
    $('.sev_check').not(this).addClass('unselected');
  });
});
</script>



<div class="clear"></div>

<script>
            $('#form').submit(function(e) {

                var form = $(this);
                var formdata = false;
                if(window.FormData){
                    formdata = new FormData(form[0]);
                }

                var formAction = form.attr('action');

                $.ajax({
                    type        : 'POST',
                    url         : 'add_singercast_process.php?from=modal',
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,

                    success: function(response) {
                        if(response != 'error') {
                            //$('#added').addClass('alert alert-success').text(response);
                            // OP requested to close the modal
                            $('#myModal').modal('hide');
                        } else {
                            $('#messages').addClass('alert alert-danger').text(response);
                        }
                    }
                });
                e.preventDefault();
            });
</script>
   

<?php
        if($totalcategory > 0)
        {
          ?>

     
         
          <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title pull-left">Category Management</h2>
                  <div class="pull-right">
             <?if($_GET['pid']){?>
             <form name='formname<?=$key?>' method='post' action='groupupdate.php?id=<?=$CATEGORYS['id']?>'>
               <label>Select Home Group : </label>
                 <select name='group' onchange="formname<?=$key?>.submit()">
                   <option><?=$GROUP['name']?></option>
                      <?php
                        foreach($group_list as $field => $value){
                        echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                        }                         
                      ?>
                   <option value="0">No Group</option>
                   <input type="hidden" name="pid" value="<?=$parentid?>" />
                   <input type="hidden" name="page" value="<?=$_GET['page']?>">
                 </select>
             </form> 
            <?}?> 
           </div>
          <div class="clear"></div>
              </div>
            <div class="panel-body">

           <table class="table table-striped table-border-custom text-center">
             <thead>
		      <tr>
                        <td class="numeric text-center" style="width:4%">No</td>
                        <td class="numeric text-center" style="width:6%">Order</td>
                        <td class="numeric text-center" style="width:37%">Name</td>
                        <td class="numeric text-center" style="width:20%">Display Name</td>
                        <td class="numeric text-center" style="width:6%">Files</td>
                        <td class="numeric text-center" style="width:8%"></td>
                        <td class="numeric text-center" style="width:8%"></td>
                        <td class="numeric text-center" style="width:5%">Featured</td>
                        <td class="numeric text-center" style="width:4%">Active</td>
                        <td class="numeric text-center" style="width:4%">Edit</td>
                        <td class="numeric text-center" style="width:4%">Delete</td>
                    </tr>
                </thead>


                <tbody>
                    <?php
                        foreach($CATEGORY as $key => $val)
                        {   ?>
                            <tr>
                                <td class="vert-align"><?php echo $start_sr_no ++ ?></td>
                                 <td class="vert-align">
                                    <form name='formname<?=$key?>' method='post' action='kramupdate.php?id=<?=$val['id']?>'>
                                            <input type="hidden" name="pid" value="<?=$parentid?>" />
                                            <select name='kram' onchange="formname<?=$key?>.submit()">
                                                    <option value="<?=$val['kram']?>"><?=$val['kram']?></option>
                                                    <?php
                                                        for($i=0 ; $i<=$totalcategory;$i++)
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                    ?>
                                            </select>
                                            <input type="hidden" name="page" value="<?=$_GET['page']?>">
                                     </form>
                                </td>
                                <td class="text-left"><a href="?pid=<?=$val['id']?>"><?=$val['name']?></a></td>


                                <td>
                                <form class="form-inline" method="post" action="add_displayname.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">
                                <div class="form-group">
                                <div class="input-group">
                                <input type="text"  class="form-control input-sm" name="displayname" id="" value="<?=$val['displayname']?>">
                                </div></div>
                                <div class="form-group">
                                <input type="hidden" name="id" value="<?=$val['id']?>" />
                                <input type="hidden" name="cid" value="<?=$parentid?>" />
                                <input type="submit" class="btn btn-sm btn-primary" name="submit" id="submit" value="Add"/>
                                </div>
                                </form>
                                </td>
                                <td class="vert-align">
                                        <?php
                                        if($val['totalitem'] != 0)
                                            echo ' '.$val['totalitem'] .'';
                                        ?>
                                </td>
                                
                                <td class="vert-align">
                                        <?php
                                        if($val['subcate'] != 1)
                                            echo '<a class="btn btn-sm btn-info" href="addfile.php?id='.$val['id'].'"><i class="fa fa-cloud-upload"></i> Upload File</a>';
                                        else
                                            echo '<span class="btn btn-sm btn-default"><i class="fa fa-cloud-upload"></i> Upload File</span>';
                                        ?>
                                </td>
                                <td class="vert-align">
                                        <?php
                                        if($val['subcate'] != 1)
                                            echo '<a class="btn btn-sm btn-danger" href="bulkupload.php?id='.$val['id'].'"><i class="fa fa-flash"></i> Bulk Upload</a>';
                                        else
                                            echo '<span class="btn btn-sm btn-default"><i class="fa fa-flash"></i> Bulk Upload</span>';
                                        ?>
                                </td>

                               <td class="vert-align">
                                  <?php
                                   if ($val['topmenu'] == 0)
                                    echo '<a href="add_topmenu.php?id='.$val['id'].'&pid='.$parentid.'&action=on'.$set_page.'"><i class="fa fa-star-o fa-2x" style="color:#ccc"></i></a>';
                                   else
                                    echo '<a href="add_topmenu.php?id='.$val['id'].'&pid='.$parentid.'&action=off'.$set_page.'"><i class="fa fa-star fa-2x" style="color:#FADD01;"></i></a>';
                                  ?>
                                </td>

                                <td class="vert-align">
                                  <?php
                                   if ($val['active'] == 1)
                                    echo '<a href="show.php?id='.$val['id'].'&pid='.$parentid.'&action=on'.$set_page.'"><i class="fa fa-remove fa-2x" style="color:red"></i></a>';
                                   else
                                    echo '<a href="show.php?id='.$val['id'].'&pid='.$parentid.'&action=off'.$set_page.'"><i class="fa fa-check-square fa-2x" style="color:#38b44a"></i></a>';
                                  ?>
                                </td>
                                <td class="vert-align"><a href="editcategory.php?id=<?=$val['id']?>&pid=<?=$parentid?><?=$set_page?>" class="link-black"><i class="fa fa-edit fa-2x"></i></a></td>
                                <td class="vert-align"><a href="deletecategory.php?id=<?=$val['id']?>&pid=<?=$parentid?><?=$set_page?>" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            
           <div class="text-center">
            <div class="btn-group">
            <?=$PAGE_CODE?>
            </div>
           </div>
   </div>
 </div>

           <?php
        }
        else
        {
            $pagingqry = 'select * from file where cid = '.$parentid .' order by kram desc';
            $rowsPerPage=15;
            $gets='?';

            $pagelink = ADMIN_BASE_PATH.'manage/index.php?pid='.$parentid.'&page=';
            //echo $sort;
            $htmlpage = '';

            include("../../inc/paging_admin.php");

            $FILE = $db->query($pagingqry.$limit);
            //$params['PAGE_CODE'] = $PAGE_CODEs;
            $TOTAL_FILE = $numrows;

            //$kramval = array();
            //for($i=0 ; $i < $numrows ; $i++)
             //       array_push($kramval,array('krams' => $i+1));

            //$params['KRAM']=$kramval;

            $folq = "select folder from category where id = ".$parentid;
            $FOLDER = '../'.$db->query($folq,database::GET_FIELD);
            $qpid = 'select * from category where id = ' . $parentid;
            $getpid = $db->query($qpid,  database::GET_ROW);
            
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Files Management</h2>
              </div>
            <div class="panel-body">
            <table class="table table-border-custom text-center" >
             <thead>
		     <tr>
                        <td class="text-center" style="width:50%">Mp3 Tag Preview</td>
                        <td class="text-center" style="width:50%">Single Thumb Preview</td>
                    </tr>
                </thead>
                <tbody>
            
            <tr>         
            <?php
            $icon = '../'.$FOLDER.'folder.jpg';
            if (file_exists($icon)){?>
            <td><p><img src="<?=$icon?>?<?=time();?>" width="150"></p><a href="clearmp3tag.php?id=<?=$parentid?>" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td>
            <?
            }else{
            ?>
            <td class="vert-align">
                <form action="addmp3tag_process.php" method="post" enctype="multipart/form-data" class="form-inline">
                 <div class="form-group marginbot-10 margintop-10">
                 <div class="input-group">
                   <span class="input-group-btn">
                     <span class="btn btn-sm btn-info btn-file">
                       Browse mp3 tag..<input type="file" name="fthumb"/>
                     </span>
                   </span>
                <input type="text" class="form-control input-sm" placeholder="Only jpg file.."readonly>
                </div></div>
                <div class="form-group">
                <input type="hidden" name="id" value="<?=$ids?>" />
                <input type="hidden" name="pid" value="<?=$prid?>" />
                <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit" value="Upload"/><i class="fa fa-arrow-circle-up"></i> Upload</button>
                </div>
               </form> 
            </td>
            <?
            }
            if ($getpid['fthumb']==! ''){
            ?>
            <td><p><img src="../../<?=$FOLDER?><?=$getpid['fthumb']?>?<?=time();?>"></p>
            <a href="clearthumb.php?id=<?=$parentid?>&amp;pid=<?=$getpid['parentid']?>" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td> 
            <? }else{
            ?>
            <td class="vert-align">
              <form action="addsinglethumb_process.php" method="post" enctype="multipart/form-data" class="form-inline">
                <div class="form-group marginbot-10 margintop-10">
                 <div class="input-group">
                   <span class="input-group-btn">
                     <span class="btn btn-sm btn-info btn-file">
                       Browse single thumb..<input type="file" name="fthumb"/>
                     </span>
                   </span>
                <input type="text" class="form-control input-sm" placeholder="Only jpg file.."readonly>
                </div></div>
                <div class="form-group">
                <input type="hidden" name="id" value="<?=$ids?>" />
                <input type="hidden" name="pid" value="<?=$prid?>" />
                <button type="submit" class="btn btn-sm btn-primary" name="submit" id="submit" value="Upload"/><i class="fa fa-arrow-circle-up"></i> Upload</button>
                </div>
               </form> 
            </td>
            <?
            }
            ?>
            </tr>
            </tbody>
            </table>
            

          
              <table class="table table-striped table-border-custom text-center">
                <thead>
		     <tr>
                        <td class="text-center" style="width:3%">No</td>
                        <td class="text-center" style="width:4%">Order</td>
                        <td class="text-center" style="width:25%">File Name</td>
                        <td class="text-center" style="width:32%">Functions</td>
                        <td class="text-center" style="width:18%">Singers Name</td>
                        <td class="text-center" style="width:6%">DL</td>
                        <td class="text-center" style="width:2%">Ext</td>
                        <td class="text-center" style="width:4%">Size</td>
                        <td class="text-center" style="width:2%">Edit</td>
                        <td class="text-center" style="width:2%">Del</td>
                     </tr>
                </thead>
                <br/><br/>

                <tbody>
                    <?php
                        foreach($FILE as $key => $val)
                        {   ?>


                            <tr>
                                <td class="vert-align"><?php echo $start_sr_no ++ ?></td>
                                <td class="vert-align">
                                    <form name='formname<?=$key?>' method='post' action='kramupdate.php?fid=<?=$val['id']?>'>
                                            <input type="hidden" name="pid" value="<?=$parentid?>" />
                                            <select name='kram' onchange="formname<?=$key?>.submit()">
                                                    <option value="<?=$val['kram']?>"><?=$val['kram']?></option>
                                                    <?php
                                                        for($i=0 ; $i<=$TOTAL_FILE;$i++)
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                    ?>
                                                    <input type="hidden" name="page" value="<?=$_GET['page']?>">
                                            </select>
                                     </form>
                                </td>
                                <td class="text-left vert-align">
                                  <?=str_replace('_',' ',$val['name'])?>
                                </td> 

                                <td class="text-left vert-align">      
                                       
                                        <? if ($val['ext'] =='mp3') {?><a class="btn btn-xs btn-default" href="add_mp3_singer.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>"><i class="fa fa-user"></i> Add Singers</a> <a class="btn btn-xs btn-default" href="edit_mp3tag.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>"><i class="fa fa-edit"></i> Edit Tag</a> <? if ($val['has_320'] =='' || $val['has_64'] =='') {?><a class="btn btn-xs btn-default" href="add_multibitmp3.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>"><i class="fa fa-music"></i> Multi Bitrate</a><? } ?><? } ?>
                                        
                                        <a class="btn btn-xs btn-default" href="add_file_update.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>&action=on"><i class="fa fa-plus"></i> Add Update</a>

                                        <? if ($val['has_320'] ==!'') {?><a class="btn btn-xs btn-info" href="del_multibit.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>&action=320"><i class="fa fa-close"></i> 320 Kbps</a> <?}?>

                                        <? if ($val['has_64'] ==!'') {?><a class="btn btn-xs btn-primary" href="del_multibit.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>&action=64"><i class="fa fa-close"></i> 64 Kbps</a> <?}?>
                                        
                                </td>
                                <td class="vert-align text-left">
                                 <?
                                 if($val['artist']==! ""){
                                 
                                 $singerlist = $val['artist'];

                                 $sing = array($singerlist);
                                 array_walk($sing , 'intval');
                                 $ids = implode(',', $sing);
                                 $sql = "SELECT * FROM singer_star WHERE id IN ($ids) order by id desc";
                                 $gets = $db->query($sql);

                                 $sing = array();

                                 foreach ($gets as $keys => $vals) {
                                 $sing[$keys] = $vals['name'];
                                 }

                                 $singer = implode(', ', $sing);
                                 echo '<small>';
                                 echo $singer;
                                 echo '</small>';
                                 }
                                 ?>
                                </td>
                                 <!--<td class="vert-align">
                                    
                                     <? if ($val['ext'] =='mp4' or $val['ext'] =='3gp' or $val['ext'] =='avi'){?>
                                     <img src="../<?=$FOLDER?>thumb-<?=$val['dname']?>.<?=$val['thumbext']?>?<?=time();?>" />
                                     <p class="margintop-10"><span class="label label-danger"><a class="link-white" href="video_thumb.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>"><span class="fa fa-refresh"></span> regen</a></span></p>
                                     

                                     
                                    
                                    <?}elseif ($val['thumbext']== ''){
                                    echo'NA';
                                    }else{
                                    ?>
                                    <img src="../<?=$FOLDER?>thumb-<?=$val['dname']?>.<?=$val['thumbext']?>?<?=time();?>" />
                                    <?}?>
                                </td>-->
                                <td class="vert-align">
                                 <?=$val['download']?>
                                </td>
                                <td class="vert-align">
                                    <?=$val['ext']?>
                                </td>
                                <td class="vert-align">
                                    <?php echo getSize($val['size']) ?>
                                </td> 

                                <td class="vert-align"><a href="editfile.php?id=<?=$val['id']?>&cid=<?=$parentid?><?=$set_page?>" class="link-black"><i class="fa fa-edit fa-2x"></i></a></td>

                                <td class="vert-align"><a href="deletefile.php?id=<?=$val['id']?>&cid=<?=$parentid?>" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table> 

           <div class="text-center">
            <div class="btn-group">
            <?=$PAGE_CODE?>
            </div>
           </div>
       </div>
      </div>
<? if ($CATEGORYS['haszip'] > 0){?>

          <div class="panel panel-info">
              <div class="panel-heading">
                <h2 class="panel-title">Zip Files</h2>
              </div>
            <div class="panel-body">
              <table class="table table-striped table-border-custom text-center">
                <thead>
		     <tr>
                        <td class="numeric text-center" style="width:3%">No</td>
                        <td class="numeric text-center" style="width:6%">Order</td>
                        <td class="numeric text-center" style="width:75%">Zip Files</td>
                        <td class="numeric text-center" style="width:4%">Extention</td>
                        <td class="numeric text-center" style="width:6%">Size</td>
                        <td class="numeric text-center" style="width:3%">Rename</td>
                        <td class="numeric text-center" style="width:3%">Delete</td>
                     </tr>
                </thead>
                <tbody>
                <? 
                $sr_no = 1;
                $zplist = $db->query('select * from `zip_files` where cid = '.$parentid.' order by kram desc'); 	
                $TOTAL_ZIP_FILE =count($zplist);
                   foreach($zplist as $key => $zp){
                ?>
                <tr>
                <td class="vert-align"><? echo $sr_no ++ ?></td>
                <td class="vert-align">
                  <form name='formname1<?=$key?>' method='post' action='kramupdate.php?zid=<?=$zp['id']?>'>
                                            <input type="hidden" name="pid" value="<?=$parentid?>" />
                                            <select name='kram' onchange="formname1<?=$key?>.submit()">
                                                    <option value="<?=$zp['kram']?>"><?=$zp['kram']?></option>
                                                    <?php
                                                        for($i=0 ; $i<=$TOTAL_ZIP_FILE;$i++)
                                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                                    ?>
                                                    <input type="hidden" name="page" value="<?=$_GET['page']?>">
                                            </select>
                                     </form>
                </td>
                <td class="vert-align"><?=$zp['name']?></td>
                <td class="vert-align">Zip</td>
                <td class="vert-align"><?=$zp['size']?></td>
                <td class="vert-align"><a href="edit_zipfile.php?id=<?=$zp['id']?>&cid=<?=$parentid?><?=$set_page?>" class="link-black"><i class="fa fa-edit fa-2x"></i></a></td>
                <td class="vert-align"><a href="delete_zipfile.php?id=<?=$zp['id']?>&cid=<?=$parentid?>" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td>
                </tr>
                <?}?>
              </tbody> 
              </table>
</div>
</div>
<?}?>
           <?php
        }
        
        ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery("#singers").tagit({
        singleField: true,
        singleFieldNode: $('#mySingleField2'),
        allowSpaces: true,
        minLength: 2,
        removeConfirmation: false,
        animate: true, 
        tagSource: function( request, response ) {
            
            $.ajax({
                url: "singerlist.php", 
                data: { term:request.term },
                dataType: "json",
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item.label,
                            value: item.id
                            
                        }
                    }));
                }

            });
        },
      autocomplete: {
       delay: 0,
       minLength: 2,
     },
     
   });
 });
</script>
<script type="text/javascript">
    jQuery(document).ready(function() {
    jQuery("#stars").tagit({
        singleField: true,
        singleFieldNode: $('#mySingleField'),
        allowSpaces: true,
        minLength: 2,
        removeConfirmation: false,
        animate: true, 
        tagSource: function( request, response ) {
            
            $.ajax({
                url: "starlist.php", 
                data: { term:request.term },
                dataType: "json",
                success: function( data ) {
                    response( $.map( data, function( item ) {
                        return {
                            label: item.label,
                            value: item.id
                            
                        }
                    }));
                }

            });
        },
      autocomplete: {
       delay: 0,
       minLength: 2,
     },
     
   });
 });
</script>
<?php include $adminfoldername.'/footer.php'; ?>