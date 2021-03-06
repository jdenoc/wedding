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
$limit = 10*1024*1024;				// 10MB limit on files uploaded

if(!isset($_POST['folder']) || $_POST['folder'] == ''){
    echo '<script type="text/javascript">
            alert(\'Folder was not selected\');
            window.location = \'../admin.php\';
        </script>';
    exit;
}else{
    $dir = $_POST['folder'];
}

echo '<h1>Upload Summary</h1><br/><br/>';


// make sure file is a valid file type, i.e.: jpg, png
if((in_array($_FILES["file"]["type"], array("image/jpeg", "image/jpg", "image/pjpeg", "image/png"))) && ($_FILES["file"]["size"] < $limit)){
    if ($_FILES["file"]["error"] > 0){
        echo "Error: " . $_FILES["file"]["error"] . "<br />";
        echo '<script type="text/javascript">window.location = \'../admin.php\';</script>';
        exit;
    }else{
        // replace any spaces in original filename with underscores
        $filename = str_replace(' ', '_', $_FILES['file']['name']);

        // Checks to make sure filename not already in use
        if (file_exists($dir . $filename)){
            echo '<strong>'.$_FILES['file']['name'] ."</strong> already exists. ";
        }else{
            recreate($_FILES["file"]["type"], $_FILES["file"]["tmp_name"], $dir, $filename, $maxHeight, $maxWidth, 'Image');
            echo "File uploaded: ".$filename."<br />";
            echo "To: ".$dir."<br/>";
            echo "Size: ".($_FILES["file"]["size"] / 1024)." Kb<br />";
            // create a thumb for the uploaded img with max dimensions 500x300
            recreate($_FILES["file"]["type"], $_FILES["file"]["tmp_name"], $dir.'thumbnails/', $filename, $thumbHeight, $thumbWidth, 'Thumbnail');
        }
    }
    echo '<br/>You will now be redirected back to the admin page.';
}else{
    echo "Invalid file   -   ".$_FILES["file"]["type"]."<br/>";
    echo "Size   -   ".$_FILES["file"]["size"]."<br/>";
    echo "Name   -   ".$_FILES["file"]["name"]."<br/>";
}
echo '<meta http-equiv="Refresh" content="5; URL=../../admin">';	// redirect 5 secs after upload/failure
// unset $_FILE variables
unset($filename, $_FILES["file"]["size"], $_FILES["file"]["name"], $_FILES["file"]["type"], $_FILES["file"]["tmp_name"]);


function recreate($type, $src, $dir, $filename, $maxheight, $maxwidth, $file_name){
// imagecreatefromjpg, imagecreatefrompng, imagecreatefromgif, etc. depending on user's uploaded file extension
    if($type == "image/jpeg" || $type == "image/pjpeg"){
        $img = imagecreatefromjpeg($src);
    }elseif($type == "image/png"){
        $img = imagecreatefrompng($src);
    }else{
        return NULL;
    }

    $original_width = imagesx($img); 	//get width of original image
    $original_height = imagesy($img);	//get height of original image

// determine which side is the longest to use in calculating length of the shorter side, since the longest will be the max size for whichever side is longest.
    $width = $original_width;
    $height = $original_height;
    echo 'original:'.$width.' x '.$height.'<br/>';
    while($height > $maxheight || $width > $maxwidth){
        if ($height > $maxheight){
                $ratio = $maxheight / $height;
                $width = $width * $ratio;
                $height = $height * $ratio;
        }elseif($width > $maxwidth){
                $ratio = $maxwidth / $width;
                $height = $height * $ratio;
                $width = $width * $ratio;
        }
    }
    echo 'new:'.$width.' x '.$height.'<br/>';

    // create new image resource to hold the re-sized image
    $newimg = imagecreatetruecolor($width,$height);
    $palsize = ImageColorsTotal($img);   // Get palette size for original image
    for ($i = 0; $i < $palsize; $i++){ 	 // Assign color palette to new image
        $colors = ImageColorsForIndex($img, $i);
        ImageColorAllocate($newimg, $colors['red'], $colors['green'], $colors['blue']);
    }

    // copy original image into new image at new size.
    imagecopyresized($newimg, $img, 0, 0, 0, 0, $width, $height, $original_width, $original_height);


    $created = null;
    make_new_dir("../../gallery/".$dir);
    if($type == "image/jpeg" || $type == "image/pjpeg"){
        $created = imagejpeg($newimg, '../../gallery/'.$dir.strtolower($filename), 100); //$output file is the path/filename where you wish to save the file.
    }elseif($type == "image/png"){
        $created = imagepng($newimg, '../../gallery/'.$dir.strtolower($filename), 9); //$output file is the path/filename where you wish to save the file.
    }
    echo strtolower($filename).(($created)? ' Created<br/>' : ' Creation Failed<br/>');
}

function make_new_dir($path){
    if(!is_dir($path)){
        $made = mkdir($path);
        if(!$made){
            make_new_dir(substr($path, 0, strrpos($path, '/')));
            mkdir($path);
        }
    }
}