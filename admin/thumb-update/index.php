<?php include '../header.php'; ?>

<script src="../js/validation.js"></script>

<script language="javascript" >
    var compulsory = new Array('name');
    var dispError = new Array('Name !');
</script>


<div class="panel panel-info">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-edit"></i> Add Update</h2>
</div>
<div class="panel-body width-800">
<form class="form-horizontal" method="post" action="addupdate_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">
<div class="input-group marginbot-20">
<span class="input-group-addon">Thumb Link : </span>
<input type="text"  class="form-control" name="thumb" size="40" id="">
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Title</span>
<input type="text"  class="form-control" name="title" size="40" id="">
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Link</span>
<input type="text"  class="form-control" name="link" size="40" id="">
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Artist</span>
<input type="text"  class="form-control" name="artist" size="40" id="">
</div>
<div class="input-group marginbot-20">
<span class="input-group-addon">Cast</span>
<input type="text"  class="form-control" name="cast" size="40" id="">
</div>
<div class="clear marginbot-20"></div>
<input type="submit" name="submit" id="submit" class="btn btn-success" value="Add Update"/>
</form>
</div>
</div> 
 
<?php
$pagingqry = 'select * from `thumb_update` order by kram desc';
$rowsPerPage = 25;
$gets = '?';
$pagelink = ADMIN_BASE_PATH . 'thumb-update/index.php?page=';
$htmlpage = '';

include("../../inc/paging_admin.php");

$Book = $db->query($pagingqry . $limit);

$TOTAL_Book = $numrows;

$qrygetkram = $db->query("select * from `update` order by id desc");

$tot = count($qrygetkram)+1;

if ($pagtotrow == 1)
    $pagtotrow = $_GET['page'] - 1;
else
    $pagtotrow = $_GET['page'];

if ($pagtotrow <= 0)
    $pagtotrow = 1;
?>


<div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Update List</h2>
              </div>
            <div class="panel-body">

    <table class="table table-striped table-border-custom text-center">
        <thead>
            <tr>
                <td class="text-center vert-align" width="4%">No</td>
                <td class="text-center vert-align" width="4%">Order</td>
                <td class="text-center vert-align" width="12%">Thumb</td>
                <td class="text-center vert-align" width="30%">Name</td>
                <td class="text-center vert-align" width="30%">Link</td>
                <td class="text-center vert-align" width="4%">New</td>
                <td class="text-center vert-align" width="4%">Hot</td>
                <td class="text-center vert-align" width="4%">Edit</td>
                <td class="text-center vert-align" width="4%">Delete</td>
            </tr>
        </thead>
        <tbody>
        <?php
        $start_sr_no = $offset + 1;
        
        foreach ($Book as $key => $val) {
        ?>
            <tr>
                <td class="vert-align"><?php echo $start_sr_no++; ?></td>
                <td class="vert-align">
                      
                     <form name='formname<?=$key?>' method='post' action='updateorder.php?uid=<?=$val['id']?>'>
                           <select name='kram' onchange="formname<?=$key?>.submit()">
                            <option value="<?=$val['kram']?>"><?=$val['kram']?></option>
                              <?php
                                
                                for($i=0 ; $i<=$numrows;$i++)
                                 echo '<option value="'.$i.'">'.$i.'</option>';
                                   ?>
                             </select>
                        <input type="hidden" name="page" value="<?=$_GET['page']?>">
                      </form>
                </td>
                <td class="vert-align">
                    <img src="<?=$val['thumb']?>" width="50px">
                </td>
                <td class="vert-align">
                    <?= $val['title'] ?>
                </td>
                <td class="vert-align">
                    <a href="<?= $val['link'] ?>"><?= $val['link'] ?></a>
                </td>
                <? if($val['newitemtag']=='0'){?>
                <td class="vert-align"><a class="link-red" href="new_hot_update.php?id=<?= $val['id'] ?>&type=new&action=on&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-remove"></i></a></td>
                <?}else{?>
                <td class="vert-align"><a href="new_hot_update.php?id=<?= $val['id'] ?>&type=new&action=off&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-check" style="color:#38b44a"></i></a></td>
                <?}?>
                <? if($val['hotitemtag']=='0'){?>
                <td class="vert-align"><a class="link-red" href="new_hot_update.php?id=<?= $val['id'] ?>&type=hot&action=on&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-remove"></i></a></td>
                <?}else{?>
                <td class="vert-align"><a href="new_hot_update.php?id=<?= $val['id'] ?>&type=hot&action=off&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-check" style="color:#38b44a"></i></a></td>
                <?}?>
                <td class="vert-align"><a class="link-black" href="editupdate.php?id=<?= $val['id'] ?>&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-edit fa-2x"></i></a></td>
                <td class="vert-align"><a class="link-red ask" href="deleteupdate.php?id=<?= $val['id'] ?>&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-trash-o fa-2x"></i></a></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
     <div class="text-center">
            <div class="btn-group">
              <?= $PAGE_CODE ?>
            </div>
    </div>
 </div>
</div>
<?php include $adminfolder. 'footer.php'; ?>