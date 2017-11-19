<!DOCTYPE html>
    <html>
    <head>
        <script src="https://rawgit.com/eduardolundgren/tracking.js/master/build/tracking-min.js"></script>
        <script src="https://rawgit.com/eduardolundgren/tracking.js/master/build/data/face-min.js"></script>
        <script src="https://rawgit.com/eduardolundgren/tracking.js/master/build/data/eye-min.js"></script>
        <script src="https://rawgit.com/eduardolundgren/tracking.js/master/build/data/mouth-min.js"></script>
        <meta charset="utf-8"/>
        <link href="main.css" rel="stylesheet"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
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
            ini_set("upload_max_filesize",10000000);
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
            echo '<table class="table table-hover">';
            foreach ($exif as $key => $value) {
                echo "<tr>";
                echo "<td>" . $key . "</td>";
                echo '<table class="table table-hover">';
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
            <div id="demo-container">
                <?php
                echo '<img id="img" src="'. $picturePath.'" width="700"/>';
                ?>
            </div>
        </div>
        <script src="foto_object_detection.js"></script>
    </body>
</html>
