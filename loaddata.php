<?php
include("config.php");

$instagram = new Instagram($config);
$instagram->setAccessToken($_SESSION['InstagramAccessToken']);

if (!isset($_SESSION['InstagramAccessToken'])) {
    header('Location: login.php');
    die();
}

$num = 1;
$follow_l = null;
$followby_l = null;
$result = null;

function getFollow($cursor = null){
    global $instagram;
    global $follow_l;
    global $num;

    if(isset($cursor)){
        $getFollowList = $instagram->getUserFollows("self", $cursor);
    } else {
        $getFollowList = $instagram->getUserFollows("self");
    }

    $data = json_decode($getFollowList, true);

    $new = getUsername($data);
    if($follow_l != null){
        $follow_l = array_merge($follow_l, $new);
    } else {
        $follow_l = $new;
    }
    checkCursor($data);
    $num = 1;
}

function checkCursor($data){
    if(isset($data["pagination"]["next_cursor"])) {
        getFollow($data["pagination"]["next_cursor"]);
    }
}

function checkCursorBy($data){
    if(isset($data["pagination"]["next_cursor"])) {
        getFollowBy($data["pagination"]["next_cursor"]);
    }
}

function getUsername($data) {
    global $num;
    $list = null;

    if(is_array($data)){
        foreach ($data["data"] as $followlist) {
            $list[$num] = $followlist["id"];
            $num = $num + 1;
        }
    } else {
        header("location: loaddata.php");
    }

    return $list;
}

function getFollowBy($cursor = null){
    global $instagram;
    global $followby_l;

    if(isset($cursor)){
        $getFollowByList = $instagram->getUserFollowedBy("self", $cursor);
    } else {
        $getFollowByList = $instagram->getUserFollowedBy("self");
    }

    $data = json_decode($getFollowByList, true);

    $new = getUsername($data);
    if($followby_l != null){
        $followby_l = array_merge($followby_l, $new);
    } else {
        $followby_l = $new;
    }
    checkCursorBy($data);
}

function checkResult() {
    global $instagram;
    global $follow_l;
    global $followby_l;
    global $result;

    if(is_array($follow_l)){
        $result = array_diff($follow_l, $followby_l);
    } else {
        header("location: loaddata.php");
    }

    if(count($result) == 0) {
        echo "<div class=jumbotron> <h1>Congratulation!</h1><br><h2> You don't have any unfollower.</h2></div>";
    } else {
        echo "<div class=jumbotron> <a class=\"btn btn-large btn-success\" href=\"unfollow.php\">Unfollow all of them!</a> <br /> <h2><font color=red>" . count($result) . "</font> people is not following you back!<br/> Here are their list</h1> </div> <hr>";
        echo "<div class=\"row\" style=\"margin: 0px 30px; text-align:center;\">";
            foreach ($result as $fr){
                $getId = $instagram->getUser($fr);
                $idat = json_decode($getId, true);
                echo "<div class=\"span2\">
                    <h4><a href=\"http://instagram.com/".$idat["data"]["username"]."\" target=\"_blank\">".$idat["data"]["username"]."</a></h4>
                    <p><img src=\"".$idat["data"]["profile_picture"]."\"></p>
                </div>";
            }
        echo "</div>";
    }
}

getFollow();
getFollowBy();
checkResult();
?>