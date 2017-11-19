<?php


function getPicture()
{
    ini_set("upload_max_filesize",2000000);
    $truePhoto = 1;
    if($_FILES["fileToUpload"]['error'] == UPLOAD_ERR_OK){
        echo "file Uploaded";
    } elseif ($_FILES["fileToUpload"]['error'] == UPLOAD_ERR_INI_SIZE) {
        echo "there was a Problem with the file size";
        $truePhoto = 0;
    } else {
        echo "there was a Problem while uploading";
        $truePhoto = 0;
    }
    if ($truePhoto == 1) {
        $directoryPhoto = "photos/";
        $filePath = $directoryPhoto . $_FILES["fileToUpload"]["name"];
        //echo "<br>";
        //echo $filePath;
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filePath);
        var_dump($filePath);
        return $filePath;
    }else{
        return $truePhoto;
    }
}
function getExifData($filePath)
{
    var_dump($filePath);
    $exif = exif_read_data($filePath, 0, true);
    return $exif;
}

$exif = getExifData(getPicture());
if (isset($exif)) {
    echo "<table>";
    foreach ($exif as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<table>";
        foreach ($value as $key2 => $value2) {
            echo "<tr>";
            echo "<td>" . $key2 . "</td>";
            echo "<td>" . $value2 . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</tr>";
    }
}
echo "</table>";
?>