<?php include '../header.php'; ?>
<script src="<?=BASE_PATH?>js/validation.js"></script>
<script language="javascript" >
	var compulsory = new Array('name');
	var dispError = new Array('category name !');
</script>

<?php
    if($_GET['pid'] != '')
        $parentid = $_GET['pid'];
    else
        exit;
    $id = $_GET['id'];
    $q = "select * from category where id = ".$_GET['id'];
    $CATEGORY = $db->query($q,  database::GET_ROW);
$singerlist = $CATEGORY['artist'];
$s = explode(',', $singerlist);
$starlist = $CATEGORY['starring'];
$st = explode(',', $starlist);
?>

  <div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title pull-left"><i class="fa fa-edit"></i> Edit Category</h2>
                <div class="pull-right">
                <a class="btn btn-primary btn-xs" href="editcategory.php?id=<?=$id?>&pid=<?=$parentid?>&page=<?=$_GET['page']?>&starchange=1"><i class="fa fa-star"></i> Change Stars Name</a>
                <a class="btn btn-primary btn-xs" href="editcategory.php?id=<?=$id?>&pid=<?=$parentid?>&page=<?=$_GET['page']?>&singerchange=1"><i class="fa fa-star"></i> Change Singers Name</a>
                <a class="btn btn-primary btn-xs" href="editcategory.php?id=<?=$id?>&pid=<?=$parentid?>&page=<?=$_GET['page']?>&allchange=1"><i class="fa fa-star"></i> Change Singers & Stars Both</a>
                </div>
                <div class="clear"></div>
              </div>
   <div class="panel-body">
    <form action="editcategory_process.php" method="post" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data" class="form-horizontal" role="form">
       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Name :</b></label>
        <div class="col-sm-10">
        <input type="text"  class="form-control" name="name" size="40" id="" value="<?=$CATEGORY['name']?>">
        </div>
       </div>
       <?if($_GET['singerchange']==1){?>
       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Singers Name :</b></label>
        <div class="col-sm-10">
       <ul id="singers">
       </ul>
       <input id="mySingleField2" name="artname" type="hidden"/>
       </div>
       </div>
       <?}elseif($_GET['allchange']==!1){?>
       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Singers Name:</b></label>
        <div class="col-sm-10">
        <? if($CATEGORY['artist']==!""){?>
        <div class="btn-toolbar">   
       <?foreach ($s as $key => $link) {
       $qs = 'select * from singer_star where id = ' . $link;
       $getsinger = $db->query($qs,  database::GET_ROW);
       echo '<span class="btn btn-warning btn-xs">'.$getsinger['name'].'</span>';
       }
       ?>
       <input type="hidden" name="artname" value="<?=$CATEGORY['artist']?>">
       </div>
       <?}else{?>
       <ul id="singers">
       </ul>
       <input id="mySingleField2" name="artname" type="hidden"/>
       <?}?>
       </div>
       </div>
       <?}?>
       <?if($_GET['starchange']==1){?>
       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Stars Name :</b></label>
        <div class="col-sm-10">
       <ul id="stars">
       </ul>
       <input id="mySingleField" name="strname" type="hidden"/>
       </div>
       </div>
       <?}elseif($_GET['allchange']==!1){?>
       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Stars Name :</b></label>
        <div class="col-sm-10">
        <? if($CATEGORY['starring']==!""){?>
        <div class="btn-toolbar">   
       <?foreach ($st as $key => $slink) {
       $qst = 'select * from singer_star where id = ' . $slink;
       $getstar = $db->query($qst,  database::GET_ROW);
       echo '<span class="btn btn-warning btn-xs">'.$getstar['name'].'</span>';
       }
       ?>
       <input type="hidden" name="strname" value="<?=$CATEGORY['starring']?>">
       </div>
       <?}else{?>
       <ul id="stars">
       </ul>
       <input id="mySingleField" name="strname" type="hidden"/>
       <?}?>
       </div>
       </div>
       <?}?>

       <?if($_GET['allchange']==1){?>
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
       <?}?>

       <div class='form-group'>
        <label class="control-label col-sm-2"><b>SEO Tags :</b></label>
        <div class="col-sm-10">
        <textarea name="tag"><?= $CATEGORY['tag'] ?></textarea>
       </div>
       </div>

       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Description :</b></label>
        <div class="col-sm-10">
        <textarea name="des"><?= $CATEGORY['des'] ?></textarea>
       </div>
       </div>

       <div class='form-group'>
        <label class="control-label col-sm-2"><b>URL Slug :</b></label>
        <div class="col-sm-10">
        <input type="text"  class="form-control" name="slug" size="40" id="" value="<?= $CATEGORY['url_slug'] ?>">
       </div>
       </div>

       <div class='form-group'>
        <label class="control-label col-sm-2"><b>Custom Link :</b></label>
        <div class="col-sm-10">
        <input type="text" class="form-control" value="<?=$CATEGORY['customlink']?>" name="customlink" id="" placeholder="" />
       </div>
       </div>
       <!--<div class="input-group marginbot-20">
         <span class="input-group-btn">
           <span class="btn btn-info btn-file">
            Browse folder thumb..<input type="file" name="thumb"/>
           </span>
          </span>
         <input type="text" class="form-control" readonly>
       </div>
    
       <?php
         if($CATEGORY['thumb'] ==! ''){
       ?>
       <div class="input-group marginbot-20">
         <label>Old Thumb:</label>
         <img src="../../files/folder-icon/<?=$CATEGORY['thumb']?>">
       </div>
       <? } ?>

       <div class="pull-right marginbot-20">

       <?php
       if($CATEGORY['thumb'] ==! ''){
       ?>
       <div class="checkbox checkbox-warning checkbox-inline">
         <input type="checkbox" id="inlineCheckbox1" name="clearthumb" /><label for="inlineCheckbox1">Remove Thumb ?</label>
       </div>
       <? } ?>

       <div class="checkbox checkbox-warning checkbox-inline">
          <?php
         if($CATEGORY['newitemtag'] == 1)
         echo '<input type="checkbox" id="inlineCheckbox2" name="newitemtag" checked="checked" value="1" /><label for="inlineCheckbox2">Enable New Tag</label>';
          else
         echo '<input type="checkbox" id="inlineCheckbox2" name="newitemtag" value="1" /><label for="inlineCheckbox2">Enable New Tag</label>';
          ?>
       </div>

       <div class="checkbox checkbox-warning checkbox-inline">
         <?php
         if($CATEGORY['updateitemtag'] == 1)
         echo '<input type="checkbox" id="inlineCheckbox3" name="updateitemtag" checked="checked" value="1" /><label for="inlineCheckbox3">Enable HOT Tag</label>';
            else
         echo '<input type="checkbox" id="inlineCheckbox3" name="updateitemtag" value="1" /><label for="inlineCheckbox3">Enable HOT Tag</label>';
         ?>
       </div>-->
       <div class='form-group'>
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-10">
       <div class="checkbox checkbox-danger">
          <?php
          if($CATEGORY['active'] == 1)
          echo '<input type="checkbox" id="inlineCheckbox4" name="active" checked="checked" value="1" /><label for="inlineCheckbox4">Inactive Folder</label>';
          else
          echo '<input type="checkbox" id="inlineCheckbox4" name="active" value="1" /><label for="inlineCheckbox4">Inactive Folder</label>';
          ?>
       </div>
       </div>
       </div>
       <div class='form-group'>
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-10">
       
           <input type="hidden" name="id" value="<?=$id?>" />
           <input type="hidden" name="pid" value="<?=$parentid?>" />
           <input class="btn btn-success" type="submit" name="submit" id="submit" value="Update Category" />
           <a class="btn btn-danger" href="index.php?pid=<?= $pid ?>"><i class="fa fa-chevron-left"></i> Back to List</a>
       </div>
       </div>
    </form>
</div>


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
<script>
$('#readOnlyTags').tagit({
                readOnly: true
            });
</script>
<?php include $adminfoldername.'/footer.php'; ?>