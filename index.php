<?php
function getUserAgent()
{
    $agent = null;
    $os = null;
    $arch = null;

    if ( empty($agent) ) {
        $agent = $_SERVER['HTTP_USER_AGENT'];

        if ( stripos($agent, 'Firefox') !== false ) {
            $start = stripos($agent, 'Firefox');
            $start = stripos($agent, '/', $start) + 1;
            $agent = 'Firefox ' . substr($agent, $start, strlen($agent) - $start);
        } elseif ( stripos($agent, 'MSIE') !== false ) {
            $agent = 'Internet Explorer';
        } elseif ( stripos($agent, 'iPad') !== false ) {
            $agent = 'iPad';
        } elseif ( stripos($agent, 'Android') !== false ) {
            $agent = 'Android';
        } elseif ( stripos($agent, 'Chrome') !== false ) {
            //Chrome/62.0.3202.94
            $start = stripos($agent, 'Chrome');
            $start = stripos($agent, '/', $start) + 1;
            $end = stripos($agent, ' ', $start) + 1;
            $agent = 'Chrome ' . substr($agent, $start, $end - $start);
        } elseif ( stripos($agent, 'Safari') !== false ) {
            $agent = 'Safari';
        } elseif ( stripos($agent, 'AIR') !== false ) {
            $agent = 'AIR';
        } elseif ( stripos($agent, 'Fluid') !== false ) {
            $agent = 'Fluid';
        }

        $os = $_SERVER['HTTP_USER_AGENT'];

        if (stripos($os, 'Windows') !== false) {
            $par_start = stripos($os, 'Windows') - 1;
            $par_end = stripos($os, ")", $par_start);
            $pars = substr($os, $par_start + 1, $par_end - $par_start - 1); // wegen (
            $arr = explode(";", $pars);
            $os = "Windows";
            $arch = $arr[2];
        } elseif (stripos($os, 'Mac OS X') !== false) {
            $ver_start = stripos($os, 'Mac OS X') + 9;
            $ver_end = stripos($os, " ", $ver_start);
            $pars = substr($os, $ver_start + 1, $ver_end - $ver_start - 1);
            $arr = explode("_", $pars);
            $version = implode(".", $arr);
            $os = "OS X " . $version;
            $arch = null;
        }
    }

    return array("agent" => $agent, "os" => $os, "arch" => $arch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>OpenProfile</title>
    <meta charset="utf-8"/>
    <!--link href="main.css" rel="stylesheet"/-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>
<div class="jumbotron text-center">
    <h1>OpenProfile</h1>
    <h2 class="text-white">Look at your Internet footprint!</h2>
    <br/>
    <?php
        $ip = $_SERVER['REMOTE_ADDR'];
        $header = getallheaders();
        $lang = $header['Accept-Language'];
        $lang = substr($lang, strpos($lang, ',') + 1, 2);
        echo "<p>IP Adress: {$ip}</p>";
        echo "<p>Browser language: " . $lang . "</p>";
        $uadata = getUserAgent();
        echo !empty($uadata['agent']) ? "<p>Browser: {$uadata['agent']}</p>" : null;
        echo !empty($uadata['os']) ? "<p>Operating System: {$uadata['os']}" : null;
        echo !empty($uadata['arch']) ? "{$uadata['arch']}" : null . '</p>';
    ?>
    <p>
        Display Height: <span id="windowScreenHeight"></span>
    </p>
    <p>
        Display Width: <span id="windowScreenWidth"></span>
    </p>
    <p>
        Window Height: <span id="windowDisplayHeight"></span>
    </p>
    <p>
        Window Width: <span id="windowDisplayWidth"></span>
    </p>

</div>
<div class="container text-center">
    <div class="row">
        <div class="col-sm-4">
            <h3>PicPrez</h3>
            <div class="card-title">
                <div class="card-body">
                    <img src="OKQTLQ0.jpg" class="card-img-bottom" width="350" height="350">
                    <h4 class="card-title">What does a picture reveal about you?</h4>
                    <p class="card-text">By sharing a picture here, you can take a look at, how much data social media companies gather about you with only a single private post!After your test, your picture will obviously be deleted!</p>
                    <a href="foto_uploadform.html" class="btn btn-primary">Your Profile</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>GeoGuess</h3>
            <div class="card-title">
                <div class="card-body">
                    <img src="2005.jpg" class="rounded" width="350" height="350">
                    <h4 class="card-title">What do GPS-pins reveal about you?</h4>
                    <p class="card-text">By sharing several GPS-pins here, you can take a look at, what social media companies can tell about your areal behaviour!After your test, your GPS-Pins will obviously be deleted!</p>
                    <a href="geo.php" class="btn btn-primary">Your Profile</a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <h3>MindMem</h3>
            <div class="card-title">
                <div class="card-body">
                    <img src="112943-OONJZG-976.jpg" class="rounded" width="350" height="350">
                    <h4 class="card-title">What do comments reveal about you?</h4>
                    <p class="card-text">By sharing a personal comment here, you can take a look at, what social media companies can tell about your character, mind set, gender and personal life!After your test, your comment will obviously be deleted!</p>
                    <a href="umfrage.html" class="btn btn-primary">Your Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<script src="display_size.js"></script>
</body>
</html>
