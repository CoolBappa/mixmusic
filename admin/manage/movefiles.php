<?php include '../header.php'; ?>
<?php
    if($_GET['id'] == '')
        exit;
    $id = $_GET['id'];
    $from = $id;
?>
 

    <?php
        $catname = $db->query('select name from category where id = '.$id,  database::GET_FIELD);
    ?>
  <div class="pull-right marginbot-20">
    <a class="btn btn-primary" href="index.php?pid=10"><i class="fa fa-chevron-left"></i> Back to File List</a>
   </div>
   <div class="clear"></div>
        <div class="panel panel-default">
              <div class="panel-heading">
                <h2 class="panel-title">Move File From : <?=$catname?></h2>
              </div>
            <div class="panel-body">
            <div class="alert alert-danger" role="alert">
               Select always last folder <strong> ( which have not any sub folder...) </strong>
             </div>
        <?php

           $q = $db->query('select * from category where parentid = 0');
            $n = count($q);
            for($i=0;$i<$n;$i++)
            {
                   
                   if($q[$i]['subcate']==1){
                   echo '&bull; <b>'.$q[$i]['name'].'</b><br/>';
                   }else{
                   echo '&bull; <a href="'.ADMIN_BASE_PATH.'manage/movefiles_process.php?to='.$q[$i]['id'].'&from='.$from.'"><b>'.$q[$i]['name'].'</b></a><br/>';
                   }
                   //echo $q[$i]['name'].'<br>';
                   showlist($q[$i]['id'],0,$db,$from);
                    //echo $total.'<br />'.$q[$i]['id'];
                    //echo '<br />';
            }


            
            function showlist($parent, $indent = 0,$db,$from)
            {
                    global $total;
                    $result = $db->query("SELECT * FROM category WHERE parentid =" . mysql_real_escape_string($parent));
                    $n = count($result);
                    
                    for($i=0;$i<$n;$i++)
                    {
                            $indent++;
                            for($in=0;$in < $indent ; $in ++)
                                echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo '<a style="color:#555" href="'.ADMIN_BASE_PATH.'manage/movefiles_process.php?to='.$result[$i]["id"].'&from='.$from.'">'.$result[$i]["name"].'</a><br/>';
                            //echo $result[$i]['totalitem'].'-'.$result[$i]['id'].'<br />';
                            //$indent .= '&nbsp;&nbsp;';
                            //echo $indent;
                            showlist($result[$i]["id"], $indent ,$db,$from);
                            $indent--;
                            //echo $indent."<br>";
                    }
                   
            }
           
           
        ?>
   </div>  
</div>
<?php include $adminfoldername.'/footer.php'; ?>