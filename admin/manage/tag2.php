<?php
$t = $db->query("select * from tag_manager where id = 1",database::GET_ROW);
$title = $t['title'];
if($getname['artist'] ==! ''){
$artist = $singer;
}else{
$artist = $t['artist'];
}
$albumm = $t['album'];
$year = $t['year'];
$genre = $t['genre'];
$comment = $t['comment'];
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

$album = '../../'.$destfolder.'folder.jpg';
if (file_exists($album)){
$tag_image = '../../'.$destfolder.'folder.jpg';
}else{
$tag_image = '../../css/images/tag.jpg';
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
	'title'   => array(str_replace('_',' ',$tagname).$title),
	'artist'  => array($artist),
	'album'   => array($foldername.$albumm),
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

 ?>
