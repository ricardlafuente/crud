<?php

include 'Curl.php';

$curl = new Curl("https://api.github.com/", "d76be1135ef70f8888a1675845a213ca05d82a5f");


$info = $curl->send("user/repos", "GET");
$info = json_decode($info);

foreach ($info as $value) {
    echo '<div>';
    echo $value->name . "\n";
    echo '</div>';
}


?>
