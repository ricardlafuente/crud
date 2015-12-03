<?php

include 'Curl.php';

$curl = new Curl("https://api.github.com/", "e4e777a90dec520e6d9bc42edbb05e88dfbf2733");

if(isset($_REQUEST['repository']))
    getCommits($curl, $_REQUEST['repository']);
else
    getRepos ($curl);


function getRepos($curl){
    $info = $curl->send("user/repos", "GET");
    
    echo '<img class="profile" src="' . $info[0]->owner->avatar_url . '"></img>';//https://avatars.githubusercontent.com/u/14833438?v=3"
    echo '<a href="' . $info[0]->owner->html_url . '"><h2>' . $info[0]->owner->login . '\'s Repositories</h2></a>';
    
    echo '<ul class="list-group">';
    foreach ($info as $value) {
        $created = str_replace("T", " ", $value->created_at);
        $created = str_replace("Z", "", $created);
        $updated = str_replace("T", " ", $value->updated_at);
        $updated = str_replace("Z", "", $updated);
        
        echo '<a href="'.$_SERVER['PHP_SELF'].'?repository=' . $value->name . '">';
        echo '<li class="list-group-item row">';
        echo '<h3 class="title col-sm-4">' . $value->name . '<i class="icon-' . strtolower($value->language) . '"></i></h3>';
        echo '<h4 class="col-sm-4"> data de creacio : ' . $created . '</h4>';
        echo '<h4 class="col-sm-4"> ultima actualitzacio : ' . $updated . '</h4>';
        echo '</li></a>';
    }
    
    echo '</ul>';
}

function getCommits($curl, $repo){
   $commits = $curl->send("repos/Abenitsi/".$repo."/commits", "GET");
   
   echo '<a href="' . $_SERVER['PHP_SELF'] . '">Back</a>';
   echo '<div class="repo">';
   echo '<h3>' . $repo . '</h3>';
   
   echo '<div class="row">';
   echo '<div class="col-sm-4"><h4>Sha</h4></div><div class="col-sm-4"><h4>Comment</h4></div><div class="col-sm-4"><h4>User Email</h4></div>';
   echo '</div>';
   foreach ($commits as $value) {
       echo '<div class="row">';
       echo '<div class="col-sm-4">' .$value->sha . '</div><div class="col-sm-4">' . $value->commit->message . '</div><div class="col-sm-4">' . $value->commit->author->email . '</div>';
       echo '</div>';
   }
   
}


?>

<html>
    <head>
        <title>Practica 10</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="css/font-mfizz.css">
        
        <style>
            a, a:hover{
                text-decoration: none;
                color: black;
            }
            
            i{
                margin-left: 10px;
            }
            
            img.profile {
                width: 50px;
                float: left;
                margin-right: 15px;
                margin-top: -15px;
            }
            
            .row {
                text-align: center;
            }
            
            h4{
                margin-top: 20px;
            }
        </style>
    </head>
</html>
