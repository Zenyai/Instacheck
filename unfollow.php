<?php
include("config.php");

$instagram = new Instagram($config);
$instagram->setAccessToken($_SESSION['InstagramAccessToken']);

if (!isset($_SESSION['InstagramAccessToken'])) {
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Instacheck? Check your following who UNFOLLOW you!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Easy way to check your following who do not follow you back!">
    <meta name="author" content="Narongdej Sarnsuwan">

    <!-- Le styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 10px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<link rel="shortcut icon" href="favicon.ico">
    <!-- Fav and touch icons
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    -->
  </head>

  <body>

    <div class="container-narrow">

      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li><a href="index.php">Home</a></li>
        </ul>
        <h3 class="header_t">Instacheck</h3>
      </div>

      <hr>
<?php
$areyousure = strip_tags($_GET["s"]);
if($areyousure == "yes"){
	?>
	<div style="display:none" id="dvloader"><center><img src="img/ajax-loader.gif"><br /><br /> We are UNFOLLOWING your unfollowers. This may take a while <br/><br/>
	</center></div>
	<div class="block1"></div>	
<?php
} else {
?>
	<center>Are you sure that you will unfollow ALL of your unfollowers (<b>can't be undone</b>).<br/><br/><br/>
	<font size="20px"><a href="unfollow.php?s=yes">Yes </a> or <a href="index.php">No!</a></font></center>
<?php
}
?>

      <hr>

      <div class="footer">
        <p>&copy; 2012 by <a href="http://narongdej.sarnsuwan.com">Narongdej Sarnsuwan</a>
              <center>
              <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                  <input type="hidden" name="cmd" value="_donations">
                  <input type="hidden" name="business" value="zenyaith@gmail.com">
                  <input type="hidden" name="lc" value="US">
                  <input type="hidden" name="item_name" value="Buy me a drink">
                  <input type="hidden" name="no_note" value="0">
                  <input type="hidden" name="currency_code" value="USD">
                  <input type="hidden" name="bn" value="PP-DonationsBF:btn_donate_LG.gif:NonHostedGuest">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
              </form>
			</center>
        	
        </p>
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   	<script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="js/bootstrap.min.js"></script>


<?php
$areyousure = strip_tags($_GET["s"]);
if($areyousure == "yes"){
?>
<script type="text/javascript">
$(function() {
    $("#dvloader").show();
    $(".block1").load("ufthmall.php", function(){ $("#dvloader").hide(); });
    return false;
});
<?php
}
?>
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251056-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </body>
</html>
