<?php
require_once('manage/getid3/getid3.php');     

$TaggingFormat = 'UTF-8';

$DirectoryToScan = '';
$mp3 = $Filename;

$getID3 = new getID3;
$getID3->setOption(array('encoding'=>$TaggingFormat));

require_once('manage/getid3/write.php');

$tagwriter = new getid3_writetags;

$tagwriter->filename = $mp3;

$tagwriter->tagformats = array('id3v1', 'id3v2.3');

$tagwriter->overwrite_tags = true;

$tagwriter->tag_encoding   = $TaggingFormat;

$tagwriter->remove_other_tags = true;

$album = '../'.$folder.'folder.jpg';

if (file_exists($album)){
$tag_image = $folder_lev . $folder .'folder.jpg';
}else{
$tag_image = '../images/tag.jpg';
}

$fd = @fopen($tag_image, 'rb');
$APICdata = fread($fd, filesize($tag_image));
fclose ($fd);
list($APIC_width, $APIC_height, $APIC_imageTypeID) = GetImageSize($tag_image);
$imagetypes = array(1=>'gif', 2=>'jpeg', 3=>'png');

$bas = substr(BASE_PATH,0,strlen(BASE_PATH) -1);
$bas = str_replace('http://', '', $bas);
// populate data array
$TagData = array(
	'title'   => array($name.' '.$bas),
	'artist'  => array($bas),
	'album'   => array($foldername),
	'year'    => array(date('y')),
	'genre'   => array($bas),
	'comment' => array('Download From '.$bas),
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
