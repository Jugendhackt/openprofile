<?php
$truePhoto = 1;
if($_FILES["fileToUpload"]["error"] == 0){
    echo "file Uploaded";
} else {
    echo "there was a Problem with uploading";
    $truePhoto = 0;
}
?>
