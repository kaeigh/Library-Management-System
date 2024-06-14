<?php

include "qr/phpqrcode/qrlib.php";
$PNG_TEMP_DIR = 'temp/';
if(!file_exists($PNG_TEMP_DIR))
    mkdir($PNG_TEMP_DIR);

    $filename = $PNG_TEMP_DIR . 'test.png';

    if(isset($_POST["view"])) {

        $codeString = $_POST["isbn"] ."/n";
        $codeString = $_POST["title"] ."/n";
        $codeString = $_POST["author"] ."/n";
        $codeString = $_POST["publication_date"] ."/n";

        $filename = $PNG_TEMP_DIR. 'test' .
        md5($codeString) . '.png';

        QRcode::png($codeString, $filename);

        echo '<img src="' .$PNG_TEMP_DIR .
        basename($filename) . '"/><hr/>';
    }


?>