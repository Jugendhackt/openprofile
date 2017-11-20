<?php
    $files = glob('photos/*.*');
    foreach($files as $file){ // iterate files
        if(is_file($file))
            unlink($file); // delete file
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>PicPrez</title>
    <meta charset="utf-8"/>
    <link href="main.css" rel="stylesheet"/>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="jumbotron text-center">
    <h1>PicPrez</h1>
    <p class= "text-white">What does a picture reveal about you?</p>
</div>
<div class="container">
    <div class="row">
        <form action="foto_drop.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fileToUpload"> Upload photo</label>
                <input type="file" class="form-control" id="fileToUpload" placeholder="Insert photo" name="fileToUpload">
            </div>
        <input type="submit" class="btn btn-primary" value="Your Profile" name="submit">
        </form>
    </div>
</div>
</body>
</html>
