<?php

include 'Curl.php';

$curl = new Curl("https://api.github.com/", "59f8623cc84c79e0dcd3705e7e2a2c2ed22aac88");


$info = $curl->send("user/repos", "GET");
$info = json_decode($info);


foreach ($info as $value) {
    $repo = getUtilInfo($curl, $value);
    echo '<div class="repo">';
    echo '<h3>'.$repo['name'] . "</h3>";
    echo '<h4> data de creacio : ' . $repo['created_at'] . '</h4>';
    echo '<h4> ultima actualitzacio : ' . $repo['updated_at'] . '</h4>';
//    print_r($repo['commits']);
    
    echo '<div class="commits">';
    foreach ($repo['commits'] as $commit) {
       echo '<div>' . $commit->sha . " " . $commit->commit->message . " " . $commit->commit->author->email . '</div>';
    }
    echo '</div>';
    
    echo '</div>';
}


function getUtilInfo($curl, $info){
   $repoInfo = array();
   
   $repoInfo['name'] = $info->name;
   $repoInfo['created_at'] = $info->created_at;
   $repoInfo['updated_at'] = $info->updated_at;
   $repoInfo['language'] = $info->language;
   
//   $repoInfo['html_url'] = $info['html_url'];
   
   $owner = $info->owner->login;
   $commits = $curl->send("repos/$owner/".$repoInfo['name']."/commits", "GET");
   
   $repoInfo['commits'] = json_decode($commits);
//   $repoInfo['git_commits_url'] = $info['git_commits_url'];
   
   return $repoInfo;
}


?>

<html>
    <head>
        <title>Practica 10</title>
        <style>
            .commits {
                border-top: 1px solid grey;
                display: none;
                background: whitesmoke;
                text-align: center;
            }
            
            .repo {
                border: 1px solid grey;
                background: gainsboro;
            }
        </style>
        
        <script>
            
            lastDisplay = false;
            window.onload = function(){
                window.onclick = visible;
            }
            
            function visible(event){
                e = event || window.event;
                
                if(lastDisplay) lastDisplay.style.display = "none";
                
                div = e.srcElement;
                lastDisplay = div.getElementsByClassName("commits")[0];
//                console.log(div.getElementsByClassName("commits"));
                lastDisplay.style.display = "block";
            }
        </script>
    </head>
</html>
