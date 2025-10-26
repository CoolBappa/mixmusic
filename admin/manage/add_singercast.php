<?php 
include '../header.php';
if($_REQUEST['id']=="")
$parentid=0;
else
$parentid = $_REQUEST['id'];

?>
<div class="panel panel-info">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-star"></i> Add Singers & Star</h2>
</div>
<div class="panel-body width-800">
<form class="form-horizontal" method="post" action="add_singercast_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">

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
<input type="submit" name="submit" id="submit" class="btn btn-success" value="Add"/>
</form>
</div>
</div> 
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

<?php
if($_GET['type']=='1'){
$pagingqry = 'select * from `singer_star` where star=1 order by kram desc';
$pagelink = ADMIN_BASE_PATH . 'manage/add_singercast.php?type=1&page=';
$htmlpage = '';
$tit = 'Stars List';
}
elseif($_GET['type']=='2'){
$pagingqry = 'select * from `singer_star` where singer=1 order by kram desc';
$pagelink = ADMIN_BASE_PATH . 'manage/add_singercast.php?type=2&page=';
$htmlpage = '';
$tit = 'Singers List';
}
else{
$pagingqry = 'select * from `singer_star` order by kram desc';
$pagelink = ADMIN_BASE_PATH . 'manage/add_singercast.php?page=';
$htmlpage = '';
$tit = 'Stars & Singers List';
}

$rowsPerPage = 20;
$gets = '?';

include("../../inc/paging_admin.php");

$Book = $db->query($pagingqry . $limit);

$TOTAL_Book = $numrows;

$qrygetkram = $db->query("select * from `singer_star` order by id desc");

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
                <h2 class="panel-title pull-left"><?=$tit?></h2>
                <div class="pull-right">
                <a class="btn btn-primary btn-xs" href="<?=ADMIN_BASE_PATH?>manage/add_singercast.php">Show Only All</a>&nbsp;&nbsp;
                <a class="btn btn-primary btn-xs" href="<?=ADMIN_BASE_PATH?>manage/add_singercast.php?type=1">Show Only Star</a>&nbsp;&nbsp;
                <a class="btn btn-primary btn-xs" href="<?=ADMIN_BASE_PATH?>manage/add_singercast.php?type=2">Show Only Singers</a>
                </div>
                <div class="clear"></div>
              </div>
            <div class="panel-body">

    <table class="table table-striped table-border-custom text-center">
        <thead>
            <tr>
                <td class="text-center vert-align" width="4%">No</td>
                <td class="text-center vert-align" width="4%">Order</td>
                <td class="text-center vert-align" width="20%">Thumb</td>
                <td class="text-center vert-align" width="60%">Name</td> 
                <td class="text-center vert-align" width="4%">Star</td>
                <td class="text-center vert-align" width="4%">Singer</td>
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
                      
                     <form name='formname<?=$key?>' method='post' action='kramupdate.php?sid=<?=$val['id']?>'>
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
                    <img src="../../files/starsinger-icon/<?=$val['thumb']?>" width="50px">
                </td>
                <td class="vert-align">
                    <?= $val['name'] ?>
                </td>

                <td class="vert-align">
                    <?if($val['star'] =='1'){?><i class="fa fa-check" style="color:#38b44a"></i><?}?>
                </td>

                <td class="vert-align">
                    <?if($val['singer'] =='1'){?><i class="fa fa-check" style="color:#38b44a"></i><?}?>
                </td>
                
                <td class="vert-align"><a class="link-red ask" href="delete_singerstar.php?id=<?= $val['id'] ?>&page=<?= $_REQUEST['page'] ?>"><i class="fa fa-trash-o fa-2x"></i></a></td>
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

