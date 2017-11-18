<?php
ini_set("upload_max_filesize",2000000);
$truePhoto = 1;
if($_FILES["fileToUpload"]['error'] == UPLOAD_ERR_OK){
    echo "file Uploaded";
} elseif ($_FILES["fileToUpload"]['error'] == UPLOAD_ERR_INI_SIZE) {
    echo "there was a Problem with the file size";
    $truePhoto = 0;
} else {
    echo "there was a Problem with uploading";
    $truePhoto = 0;
}
?>
