<?php 
$type = $_GET['type'];
$search = str_replace(' ','_',$_GET['search']);
include 'header.php';
$start_sr_no = $offset + 1;

if ($_GET['type'] != '')
    //$seq = "select *  from category as c,file as f where f.name like '%" . $search . "%' and f.ext = '" . $_GET['type'] . "' and f.cid = c.id";
    $seq = "select *  from category as c,file as f where (f.name like '%" . $search . "%' and f.cid = c.id) or  (f.artist like '%" . $search . "%' and f.cid = c.id) or (c.starring like '%" . $search . "%' and f.ext = '" . $_GET['type'] . "' and f.cid = c.id)";
else
    $seq = "select * from category as c,file as f where f.name like '%" . $search . "%' and f.cid = c.id";

$rowsPerPage = 20;
$pagingqry = $seq;
$gets = '?';

if ($sort == '')
    $sort = 'category';

$pagelink = ADMIN_BASE_PATH . 'search.php?search=' .$search. '&type=' . $_GET['type'] . '&page=';
//echo $sort;

$htmlpage = '';
$pagingpassid = 'f.id';
include("../inc/paging_admin.php");

$LIST = $db->query($pagingqry.$limit,0,'no');

$LISTTOTAL = count($LIST);


$PATH = '<a href="' . BASE_PATH . '">Home</a>&nbsp;';
?>


<div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Search Results for <b>"<?=$search?>"</b></h2>
              </div>
    <div class="panel-body">
    
        <?php
        if ($LISTTOTAL != 0) {
        ?>
        <table class="table table-striped table-border-custom text-center">
        <thead>
        <tr> 
        <td class="text-center" style="width:4%">No</td>
        <td class="text-center" style="width:40%">File Name</td>
        <td class="text-center" style="width:30%">Path</td>
        <td class="text-center" style="width:4%">Extention</td>
        <td class="text-center" style="width:6%">Size</td>
        <td class="text-center" style="width:3%">Edit</td>
        <td class="text-center" style="width:3%">Delete</td> 
        </tr>
        </thead>
        <tbody>
        <?    
        $l = 1;
        $file_tot = count($LIST);
        for ($i = 0; $i < $file_tot; $i++) {
       
        ?>
      
       <td class="vert-align"><?php echo $start_sr_no ++ ?></td>
       <td class="text-left vert-align"><?=$LIST[$i]['name']?></td>
       <td class="vert-align"><?=$LIST[$i]['clink']?></td>
       <td class="vert-align"><?=$LIST[$i]['ext']?></td>
       <td class="vert-align"><?=getsize($LIST[$i]['size'])?></td>
       <td class="vert-align"><a href="manage/editfile.php?id=<?=$LIST[$i]['id']?>&cid=<?=$LIST[$i]['cid']?><?=$set_page?>&ref=search" class="link-black"><i class="fa fa-edit fa-2x"></i></a></td>
       <td class="vert-align"><a href="manage/deletefile.php?id=<?=$LIST[$i]['id']?>&cid=<?=$LIST[$i]['cid']?>&ref=search" class="ask link-red"><i class="fa fa-trash-o fa-2x"></i></a></td>
       </tr>
       <? } ?>  
       </tbody></table>    
        
        <? }else{ ?>
       
        <div style="padding-top:10px;padding-bottom:10px;"><font color="red">Opps..! Sorry No match found for "<?= $search ?>" in <?= $type ?> files</font></div>
        <? } ?>
       

       
      
        <div class="text-center">
        <div class="btn-group">
        <?php
        if ($LISTTOTAL != 0)
        echo $PAGE_CODE;
        ?>
        </div>
        </div>
       </div>
      </div>
           
 </div></div>
<?php include $adminfoldername.'/footer.php'; ?>