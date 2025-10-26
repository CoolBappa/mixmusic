<?php include '../header.php'; ?>
<?
$cid = $_GET['cid'];
$id = $_GET['id'];
$qe = 'select * from file where id = '.$id;
$qq = $db->query($qe,  database::GET_ROW);
$ext = $qq[ext];
$name = $qq[name];
?>
<div class="panel panel-success width-800">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-star"></i> Add Singers : <?=$name?> </h2>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="addartist_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">
<div class='form-group'>
<label class="control-label col-sm-2"><b>Singers Name :</b></label>
<div class="col-sm-10">
<ul id="singers">
</ul>
<input id="mySingleField2" name="artistname" type="hidden"/>
</div>
</div>
<div class='form-group'>
<label class="control-label col-sm-2"></label>
<div class="col-sm-10">
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="cid" value="<?=$cid?>" />
<input type="hidden" name="page" value="<?=$_GET['page']?>" />
<a class="btn btn-default" href="index.php?pid=<?=$_GET['cid']?>&page=<?=$_GET['page']?>">Close</a>
<input type="submit" class="btn btn-primary" name="submit" id="submit" value="Add"/>
</div>
</div>
</form>
</div>
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
<?php include $adminfoldername.'/footer.php'; ?>

