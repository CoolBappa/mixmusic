<?php
	include("../includes/admin-config.php");
	
	if($_GET['id'] != '')
	{
		
		$id = $_GET['id'];
		
		$q = 'select * from singer_star where id = '.$id;
		$qt = $db->query($q,  database::GET_ROW);
                
		
		
		unlink('../../files/starsinger-icon/'.$qt[thumb]);

		
		
		$deletefile = 'delete from singer_star where id = '.$id;
		$db->query($deletefile);
					
		
		header("location: add_singercast.php?errid=9");
                
	}
	
?>