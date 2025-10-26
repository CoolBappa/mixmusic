<?php include 'header.php'; ?>
<?php
    $n = $db->query("select * from admin where id = 1",database::GET_ROW);
?>
<script language="javascript" src="<?=BASE_PATH?>js/validation.js"></script>
<script language="javascript" >

	var compulsory = new Array('username','password');
	var dispError = new Array('Username','Password');

	function chf(tthis)
	{
		if(document.dfrm.password.value != document.dfrm.cpass.value)
		{
			alert("password not confirmed");
			document.dfrm.password.focus();
			return false;
		}

		return chkfrm(compulsory,dispError,tthis);
	}
</script>
       <div class="panel panel-info width-800">
              <div class="panel-heading">
                <h2 class="panel-title">Security Settings</h2>
              </div>
            <div class="panel-body">

           <form name="dfrm" method="post" action="settings_db.php" onsubmit="return chf(this);" class="form-horizontal" role="form">

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-user"></i> &nbsp;Username</span>
                       <input type="text" class="form-control" name="username" id="" value="<?=$n['username']?>">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-lock"></i> &nbsp;Password</span>
                       <input type="password" class="form-control" name="password" value="" id="">
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-lock"></i> &nbsp;Confirm Password</span>
                       <input type="password" class="form-control" name="cpass" value="" id=""/>
                    </div>

                    <div class="input-group marginbot-20">
                       <span class="input-group-addon"><i class="fa fa-at"></i> &nbsp;Email id</span>
                       <input type="text" class="form-control" name="email" id="" value="<?=$n['email']?>" size="54" />
                    </div>

                   
                    <div class="margintop-20">
                    <input type="submit" class="btn btn-success" name="submit" id="submit" value="Update Settings" />
                    </div>
         </form>
      </div>
   </div>
<?php include $adminfolder.'footer.php'; ?>