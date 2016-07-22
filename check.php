<?php

    $id = $_POST["id"];
    
    if(substr( $id, 0, 29 ) === "https://www.youtube.com/user/") {
      $id = substr( $id, 29 );
    } elseif(substr( $id, 0, 32 ) === "https://www.youtube.com/channel/"){
      $id = substr( $id, 32 );
    }
    
    if(substr( $id, 0, 2 ) === "UC") {
      $request = file_get_contents("https://www.googleapis.com/youtube/v3/channels?id=". $id . "&key=&part=snippet,statistics,brandingSettings,contentDetails");
    } else {
      $request = file_get_contents("https://www.googleapis.com/youtube/v3/channels?forUsername=". $id . "&key=&part=snippet,statistics,brandingSettings,contentDetails");
    }
    $json = json_decode($request, true);
    $channellink = ("https://www.youtube.com/channel/" . $json["items"]["0"]["id"]);
    
    $uploadplaylist = $json["items"]["0"]["contentDetails"]["relatedPlaylists"]["uploads"];

    $rawget = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?playlistId=" . $uploadplaylist . "&key=AIzaSyAMyPtqCtpvimfFiID5U44pIGouDWR8c8c&part=snippet&maxResults=1");
    $playlist = json_decode($rawget, true);

    $videoid = $playlist["items"]["0"]["snippet"]["resourceId"]["videoId"];

    $tags = get_meta_tags("https://www.youtube.com/watch?v=" . $videoid);
    $network = $tags['attribution'];

    $networkcheck = substr($channelid, 2);

    if($network == $networkcheck or $network == $username) {
        $network = "No network";
    }

?>
<!doctype html>
<html>
    <head>
        <title>Channel Checker Results</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.indigo-pink.min.css">
        <script defer src="https://code.getmdl.io/1.1.3/material.min.js"></script>
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    </head>
    <body>
        <style>
        body {
            font-family:'Roboto';
            background:#fafafa;
        }
        h2 {
            text-align:center;
        }
.demo-card-square.mdl-card {
    width: 600px;
    height: 296px;
    margin: 10px auto;
}
.stats-card-square.mdl-card {
    width: 295px;
    margin: 5px;
    text-align:center;
    flex-direction: initial;
}
.demo-card-square > .mdl-card__title {
  color: #fff;
  background:
    url('<?php echo($json["items"]["0"]["brandingSettings"]["image"]["bannerMobileImageUrl"]); ?>') no-repeat center #46B6AC;
}
.mdl-card {
  min-height:160px;
}
.subscribers {
  background:#F44336 !important;
}
.network {
  background:#009688 !important;
}
.statstext {
  color:#fff;
}
#statcards {
  margin:0 auto;
  display:table;
}
#statcard {
  display:table-cell;
}
</style>
<h2>Channel Results</h2>
<div class="demo-card-square mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title mdl-card--expand">
    <h2 class="mdl-card__title-text"><?php echo($json["items"]["0"]["snippet"]["title"]); ?></h2>
  </div>
  <div class="mdl-card__supporting-text">
    <?php echo substr($json["items"]["0"]["snippet"]["description"], 0, 200); echo("..."); ?>
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="<?php echo($channellink); ?>" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Visit
    </a>
  </div>
</div>
<div id="statcards">
  <div id="statcard">
<div class="subscribers stats-card-square mdl-card mdl-shadow--2dp">
  <div class="statstext mdl-card__supporting-text">
    <h3>Subscibers</h3>
    <h5><?php echo(number_format($json["items"]["0"]["statistics"]["subscriberCount"])); ?></h5>
  </div>
</div>
</div>
<div id="statcard">
<div class="network stats-card-square mdl-card mdl-shadow--2dp">
  <div class="statstext mdl-card__supporting-text">
    <h3>Network</h3>
    <h5><?php echo($network); ?></h5>
  </div>
</div>
</div>
</div>
    </body>
</html>
