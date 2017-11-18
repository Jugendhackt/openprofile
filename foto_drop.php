<!DOCTYPE html>
<head>
    <script src="../node_modules/tracking/build/tracking-min.js"></script>
    <script src="../node_modules/tracking/build/data/face-min.js"></script>
    <script src="../node_modules/tracking/build/data/eye-min.js"></script>
    <script src="../node_modules/tracking/build/data/mouth-min.js"></script>
    <style>
        .rect {
            border: 2px solid #a64ceb;
            position: absolute;
        }
        #img {
            position: absolute
        }
    </style>
</head>/
<body>
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
            echo "there was a Problem with uploading";
            $truePhoto = 0;
        }
        if ($truePhoto == 1) {
            $directoryPhoto = "photos/";
            $filePath = $directoryPhoto . $_FILES["fileToUpload"]["name"];
            //echo "<br>";
            //echo $filePath;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filePath);
            return $filePath;
        }else{
            return $truePhoto;
        }
    }
    function getExifData($filePath)
    {
        $exif = exif_read_data($filePath, 0, true);
        return $exif;
    }

    $picturePath = getPicture();
    $exif = getExifData($picturePath);
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

    <div class="demo-frame">
        <div class="demo-container">
            <img id="img" src="faces.jpg" />
        </div>
    </div>
    <script src="foto_object_detection.js"></script>
</body>

