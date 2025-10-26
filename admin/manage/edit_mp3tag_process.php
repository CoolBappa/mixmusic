<?php
include("../includes/admin-config.php");
$cid = $_REQUEST['cid'];
$id = $_REQUEST['id'];
$fieldname = 'file';	
$qnew = 'select folder from category where id = ' . $cid;
$query = $db->query($qnew,  database::GET_ROW);
$savefolder= $query['folder'];
$qe = 'select * from file where id = '.$id;
$qq = $db->query($qe,  database::GET_ROW);
$sourcefile= '../../'.$savefolder.$qq['dname'].'.'.$qq['ext'];


$title = $_REQUEST['title'];
$artist = $_REQUEST['artist'];
$albumm = $_REQUEST['album'];
$year = $_REQUEST['year'];
$genre = $_REQUEST['genre'];
$comment = $_REQUEST['comment'];

require_once('getid3/getid3.php');     

$TaggingFormat = 'UTF-8';

$DirectoryToScan = '';
$mp3 = $sourcefile;//$DirectoryToScan."a.mp3"; //The mp3 file.

// Initialize getID3 engine
$getID3 = new getID3;
$getID3->setOption(array('encoding'=>$TaggingFormat));

require_once('getid3/write.php');

// Initialize getID3 tag-writing module
$tagwriter = new getid3_writetags;
//$tagwriter->filename = '/path/to/file.mp3';
$tagwriter->filename = $mp3;
//$tagwriter->filename = 'P:/webroot/_dev/getID3/testfiles/_writing/2011-02-02/test.mp3';

$tagwriter->tagformats = array('id3v1', 'id3v2.3');
//$tagwriter->tagformats = array('id3v2.3');

// set various options (optional)
$tagwriter->overwrite_tags = true;
//$tagwriter->overwrite_tags = false;
$tagwriter->tag_encoding   = $TaggingFormat;
$tagwriter->remove_other_tags = true;



if ($_FILES['fthumb']['name'] != '') {
        
$thumbname = 'tag-'.$qq['dname'];
@getimagesize($_FILES['fthumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
$thumbup = UploadImage('fthumb', $invalidurl, $thumbname, '../../'.$savefolder, 0, '', 0);
createthumb('../../'.$savefolder . $thumbname . '.' . $thumbup[3], '../../'.$savefolder . $thumbname . '.' . $thumbup[3],  $thumbup[3]);
$thumbext = $thumbup[3];
$thumbfullname = $thumbname . '.' . $thumbext;
unlink('../../'.$savefolder . $oldthumb);
}else{
$thumbname = 'tag-'.$qq['dname'];
$thumbext = '.jpg';
$thumbfullname = $thumbname . '.' . $thumbext;


}

if ($_FILES['fthumb']['name'] != '') {
$tag_image = '../../'.$savefolder.$thumbfullname.'';
}else{

$album = '../../'.$savefolder.'tag-'.$qq['dname'].'.jpg';
if (file_exists($album)){
$tag_image = '../../'.$savefolder.'tag-'.$qq['dname'].'.jpg';
}else{
$tag_image = '../../images/tag.jpg';
}

}

$fd = @fopen($tag_image, 'rb');
$APICdata = fread($fd, filesize($tag_image));
fclose ($fd);
list($APIC_width, $APIC_height, $APIC_imageTypeID) = GetImageSize($tag_image);
$imagetypes = array(1=>'gif', 2=>'jpeg', 3=>'png');

//$bas = substr(BASE_PATH,0,strlen(BASE_PATH) -1);
//$bas = str_replace('http://', '', $bas);
// populate data array
$TagData = array(
	'title'   => array($title),
	'artist'  => array($artist),
	'album'   => array($albumm),
	'year'    => array($year),
	'genre'   => array($genre),
	'comment' => array($comment),
	'track'   => array(''),
);



if (isset($imagetypes[$APIC_imageTypeID])) {

	$TagData['attached_picture'][0]['data']          = $APICdata;
	$TagData['attached_picture'][0]['picturetypeid'] = 0;
	$TagData['attached_picture'][0]['description']   = $tag_image;
	$TagData['attached_picture'][0]['mime']          = 'image/'.$imagetypes[$APIC_imageTypeID];
}

$tagwriter->tag_data = $TagData;

// write tags
if ($tagwriter->WriteTags()) {
	echo 'Successfully wrote tags<br>';
	if (!empty($tagwriter->warnings)) {
		echo 'There were some warnings:<br>'.implode('<br><br>', $tagwriter->warnings);
	}
} else {
	echo 'Failed to write tags!<br>'.implode('<br><br>', $tagwriter->errors);
}


header("location: edit_mp3tag.php?errid=10&id=$id&cid=$cid");



?>