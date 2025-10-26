<?php
	include("../includes/admin-config.php");

	if($_POST['id'] != '' || $_POST['cid'] != '')
	{
            $id = $_REQUEST['id'];
            $cid = $_REQUEST['cid'];

            $fieldname = 'file';
            $invalidurl = ADMIN_BASE_PATH.'manage/editfile.php?id='.$id.'&cid='.$cid;

            //$rand = rand(111111111,999999999);

            $q = 'select folder from category where id = '.$cid;
            $savefolder = $db->query($q,database::GET_FIELD);

            $qe = 'select * from file where id = '.$id;
            $qq = $db->query($qe,  database::GET_ROW);

            if($_FILES[$fieldname]['name'] != '')
            {
                    $ext1 = explode('.',$_FILES[$fieldname]['name']);
                    $ext = $ext1[count($ext1)-1];

                    $newname = cleanfilename($ext1[0]).FILEADDNAME;

                    if($_REQUEST['name'] == '')
                    {
                            $name = $ext1[0];
                    }
                    else
                    {
                            $name = $_REQUEST['name'];
                    }

                    $fileSize = $_FILES[$fieldname]['size'];

                    unlink('../../'.$savefolder.$qq['dname'].'.'.$qq['ext']);
                    $thumbnewname = $newname;
                    UploadFile($fieldname,$invalidurl,$newname,'../../'.$savefolder);

                    if((strtolower($ext) == 'jpg' ||  strtolower($ext) == 'gif' || strtolower($ext) == 'png' || strtolower($ext) == 'jpeg'))
                    {
                            unlink('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext']);
                            createthumb('../../'.$savefolder.$newname.'.'.$ext,'../../'.$savefolder.'thumb-'.$newname.'.'.$ext,THUMBW,$ext);
                            $thumbext = $ext;
                    }
                   
                    else{
                    
                    copy('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext'],'../../'.$savefolder.'thumb-'.$newname.'.'.$qq['thumbext']);
                    unlink('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext']);
                    }
            }
            else
            {
                    $name = $_REQUEST['name'];
                    $newname = $name.FILEADDNAME;
                    $ext = $qq['ext'];
                    $fileSize = $qq['size'];
                    if(!rename('../../'.$savefolder.$qq['dname'].'.'.$qq['ext'], '../../'.$savefolder.$newname.'.'.$qq['ext']))
                        header("location: editfile.php?errid=17&id=$id&cid=$cid");
                    else
                        rename('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext'], '../../'.$savefolder.'thumb-'.$newname.'.'.$qq['thumbext']);
            }
            if($_FILES['thumb']['name'] != '')
            {
                    if($thumbnewname == '')
                            $thumbnewname = $qq['dname'];
                    @unlink('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext']);
                    @getimagesize($_FILES['thumb']['tmp_name']) or error('only image uploads are allowed', $invalidurl);
                    $thumbup = UploadImage('thumb',$invalidurl,'tmp-'.$newname,'../../'.$savefolder,0,'',0);
                    createthumb('../../'.$savefolder.'tmp-'.$newname.'.'.$thumbup[3],'../../'.$savefolder.'thumb-'.$thumbnewname.'.'.$thumbup[3],THUMBW,$thumbup[3]);
                    unlink('../../'.$savefolder.'tmp-'.$newname.'.'.$thumbup[3]);
                    $thumbext = $thumbup[3];
            }
            else
            {
                    if($thumbext == '')
                     $thumbext = $qq['thumbext'];
            }

            $des = $_REQUEST['desc'];
            $newtag = $_REQUEST['newtag'];

            $qryUpdate = "update file set
                            name = '$name',
                            dname = '$newname',
                            ext = '$ext',
                            thumbext = '$thumbext',
                            size = '$fileSize',
                            `des` = '$des',
                            newtag = '$newtag' where id = ".$id;
            $db->query($qryUpdate);

            if(strtolower($ext)=='mp3')
            {
                //$name;
                $Filename= '../../'.$savefolder.$newname.'.'.$ext;
                include 'tag.php';
            }

            //if(strtolower($ext)=='mp4' || strtolower($ext)=='3gp' || strtolower($ext)=='avi')
            //{
              
            //rename('../../'.$savefolder.'thumb-'.$qq['dname'].'.'.$qq['thumbext'], '../../'.$savefolder.'thumb-'.$newname.'.'.$qq['thumbext']);
            //}
            header("location: editfile.php?errid=10&id=$id&cid=$cid");
	}
	
?>
