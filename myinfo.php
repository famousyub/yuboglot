<?php


function pushAssets() {
    $pushes = array(
        "/css/styles.css" => substr(md5_file(__DIR__."/css/styles.css"), 0, 8),
        "/scripts/main.js" => substr(md5_file(__DIR__."/scripts/main.js"), 0, 8)
    );

    if (!isset($_COOKIE["h2pushes"])) {
        $pushString = buildPushString($pushes);
        header($pushString);
        setcookie("h2pushes", json_encode($pushes), 0, 2592000, "", "http://localhost:8096/myinfo.php", true);
    } else {
        $serializedPushes = json_encode($pushes);

        if ($serializedPushes !== $_COOKIE["h2pushes"]) {
            $oldPushes = json_decode($_COOKIE["h2pushes"], true);
            $diff = array_diff_assoc($pushes, $oldPushes);
            $pushString = buildPushString($diff);
            header($pushString);
            setcookie("h2pushes", json_encode($pushes), 0, 2592000, "", "http://localhost:8096/myinfo.php", true);
        }
    }
}

function buildPushString($pushes) {
    $pushString = "Link: ";

    foreach($pushes as $asset => $version) {
        $pushString .= "<" . $asset . ">; rel=preload";

        if ($asset !== end($pushes)) {
            $pushString .= ",";
        }
    }

    return $pushString;
}

// Push those assets!
pushAssets();

function pushAssets2() {
    $pushes = array(
        "/css/styles.css" => substr(md5_file(__DIR__."/css/styles.css"), 0, 8),
        "/scripts/main.js" => substr(md5_file(__DIR__."/scripts/main.js"), 0, 8)
    );

    if (!isset($_COOKIE["h2pushes2"])) {
        $pushString = buildPushString($pushes);
        header($pushString);
        setcookie("h2pushes2", json_encode($pushes), 0, 2592000, "", "http://localhost:82/famousme", true);
    } else {
        $serializedPushes = json_encode($pushes);

        if ($serializedPushes !== $_COOKIE["h2pushes2"]) {
            $oldPushes = json_decode($_COOKIE["h2pushes2"], true);
            $diff = array_diff_assoc($pushes, $oldPushes);
            $pushString = buildPushString($diff);
            header($pushString);
            setcookie("h2pushes2", json_encode($pushes), 0, 2592000, "", "http://localhost:82/famousme", true);
        }
    }
}

function buildPushString2($pushes) {
    $pushString = "Link: ";

    foreach($pushes as $asset => $version) {
        $pushString .= "<" . $asset . ">; rel=preload";

        if ($asset !== end($pushes)) {
            $pushString .= ",";
        }
    }

    return $pushString;
}





pushAssets2();




?>

<?php
function isMobileDevice() {
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
, $_SERVER["HTTP_USER_AGENT"]);
}
if(isMobileDevice()){
    echo "Mobile Browser Detected";
}
else {
    echo "Mobile Browser Not Detected";
}
?>
