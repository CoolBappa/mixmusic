<?php include 'includes/admin-config.php'; ?>
<?php
	$title = $_REQUEST['title'];
	$artist = $_REQUEST['artist'];
	$album = $_REQUEST['album'];
	$year = $_REQUEST['year'];
	$genre = $_REQUEST['genre'];
        $comment = $_REQUEST['comment'];
	
	
	
	$nn = "update tag_manager set 

                        title = '$title',
                        artist = '$artist',
			album = '$album', 
			year = '$year', 
			genre = '$genre' ,
                        comment = '$comment' 
			where id = 1";
	$db->query($nn);
	
	header("location: tag_manager.php?errid=11");
?>