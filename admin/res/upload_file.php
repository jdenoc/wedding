<?php
session_name('wedding_admin');
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] == ''){
    header("location:../index.php");
    exit;
}

$dir = '';
$maxWidth = 500;
$maxHeight = 300;
$thumbWidth = 125;
$thumbHeight = 75;
$limit = 4*1024*1024;				// 4MB limit on files uploaded

if(!isset($_POST['folder']) || $_POST['folder'] == ''){
    echo '<script type="text/javascript">alert(\'Folder was not selected\')</script>';
    header("location:../admin.php");
    exit;
}else{
    $dir = $_POST['folder'];
}

echo '<h1>Upload Summary</h1><br/><br/>';

// make sure file is a valid file type, i.e.: jpg, png, gif
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/pjpeg")	// related to IE only
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < $limit)){
    if ($_FILES["file"]["error"] > 0){
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
        header("location:admin.php");		// redirect after failed upload
        exit;
    }else{
        // replace any spaces in original filename with underscores
        $filename = str_replace(' ', '_', $_FILES['file']['name']);

        // Checks to make sure filename not already in use
        if (file_exists($dir . $filename)){
            echo '<strong>'.$_FILES['file']['name'] ."</strong> already exists. ";
        }else{
            recreate($_FILES["file"]["type"], $_FILES["file"]["tmp_name"], $dir, $filename, $maxHeight, $maxWidth);
            echo "File uploaded: ".$filename."<br />";
            echo "To: ".$dir."<br/>";
            echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br />";
            // create a thumb for the uploaded img with max dimensions 500x300
            recreate($_FILES["file"]["type"], $_FILES["file"]["tmp_name"], $dir.'/thumbnails/', $filename, $thumbHeight, $thumbWidth);
        }
    }
    echo '<br/>You will now be redirected back to the admin page.';
}else{
    echo "Invalid file   -   ".$_FILES["file"]["type"];
}
echo '<meta http-equiv="Refresh" content="2; URL=../../admin">';	// redirect 2 secs after upload/failure
// unset $_FILE variables
unset($filename, $_FILES["file"]["size"], $_FILES["file"]["name"], $_FILES["file"]["type"], $_FILES["file"]["tmp_name"]);


function recreate($type, $src, $dir, $filename, $maxheight, $maxwidth){
    //imagecreatefromjpg, imagecreatefrompng, imagecreatefromgif, etc. depending on user's uploaded file extension
    if($type == "image/jpeg" || $type == "image/pjpeg"){
        $img = imagecreatefromjpeg($src);
    }elseif($type == "image/gif"){
        $img = imagecreatefromgif($src);
    }elseif($type == "image/png"){
        $img = imagecreatefrompng($src);
    }else{
        return NULL;
    }

    $width = imagesx($img); 	//get width of original image
    $height = imagesy($img);	//get height of original image

    //determine which side is the longest to use in calculating length of the shorter side, since the longest will be the max size for whichever side is longest.
    $newwidth = $maxwidth;
    $newheight = $maxheight;
    if ($height > $width) {
        if($height >= $maxheight){
            $ratio = $maxheight / $height;
            $newwidth = $width * $ratio;
        }
    }else{
        if($width >= $maxwidth){
            $ratio = $maxwidth / $width;
            $newheight = $height * $ratio;
        }
    }

    //create new image resource to hold the resized image
    $newimg = imagecreatetruecolor($newwidth,$newheight);
    $palsize = ImageColorsTotal($img);   // Get palette size for original image
    for ($i = 0; $i < $palsize; $i++){ 	 // Assign color palette to new image
        $colors = ImageColorsForIndex($img, $i);
        ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
    }

    //copy original image into new image at new size.
    imagecopyresized($newimg, $img, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);


    //Have to figure that one out yourself using whatever rules you want.  Can use imagegif() or imagepng() or whatever.
    $created = null;
    if($type == "image/jpeg" || $type == "image/pjpeg"){
        $created = imagejpeg($newimg, '../../gallery/'.$dir.$filename, 100); //$output file is the path/filename where you wish to save the file.
    }elseif($type == "image/gif"){
        $created = imagegif($newimg, $dir.$filename, 100); //$output file is the path/filename where you wish to save the file.
    }elseif($type == "image/png"){
        $created = imagepng($newimg, $dir.$filename, 100); //$output file is the path/filename where you wish to save the file.
    }
    echo ($created)? 'Created<br/>' : 'Creation Failed<br/>';
}
?>