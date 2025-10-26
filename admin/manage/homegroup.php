<?
include '../header.php';
$group_list = $db->query('select * from `homegroup` order by id asc');
?>
<div class="panel panel-info width-800">
<div class="panel-heading">
<h2 class="panel-title"><i class="fa fa-plus"></i> Add HomeGroup</h2>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="add_homegroup_process.php" onsubmit="return chkfrm(compulsory,dispError,this)" enctype="multipart/form-data">
<div class="input-group marginbot-20">
<span class="input-group-addon">Group Name</span>
<input type="text"  class="form-control" name="name" size="40" id="">
</div>
<div class="clear marginbot-20"></div>
<input type="submit" name="submit" id="submit" class="btn btn-success" value="Add Group"/>
</form>
</div>
</div> 

<div class="panel panel-success width-800">
              <div class="panel-heading">
                <h2 class="panel-title">HomeGroup</h2>
              </div>
            <div class="panel-body">
<?
foreach($group_list as $field => $value)
  {
  echo '<div class="well">';
  echo $value['id'].'. ';
  echo $value['name'];
  echo '<span class="pull-right">';
  echo ' <a class="label label-success" href="edit_homegroup.php?id='.$value['id'].'">Edit</a> ';
  echo ' <a class="ask label label-danger" href="del_homegroup.php?id='.$value['id'].'">Delete</a> ';
  echo '</span>';
  echo '</div>';
}
?>

 </div>
</div>
<?php include $adminfolder. 'footer.php'; ?>
