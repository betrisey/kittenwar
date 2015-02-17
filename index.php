<!doctype html>
<?php
require_once 'db_connect.php';
if (isset($_GET['win']) && isset($_GET['lose'])) {
	$req = $db->prepare('UPDATE tblchat SET chatVotesPositifs=chatVotesPositifs+1 WHERE chatId=?');
	$req->execute(array($_GET['win']));
	$req = $db->prepare('UPDATE tblchat SET chatVotesNegatifs=chatVotesNegatifs+1 WHERE chatId=?');
	$req->execute(array($_GET['lose']));
}
?>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Kwar</title>
	<link rel="canonical" href="http://kwar.tk/">
	<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="css/foundation.css" />
	<script src="js/vendor/modernizr.js"></script>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="large-12 columns">
			<h1>Kwar</h1>
			<hr style="
			height: 5px;
			border-top: 0;
			background: #c4e17f;
			border-radius: 5px;
			background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
			width: 105px;
			margin-top: 0;">

		</div>
	</div>
	<!--
  ____        _   _   _
 | __ )  __ _| |_| |_| | ___
 |  _ \ / _` | __| __| |/ _ \
 | |_) | (_| | |_| |_| |  __/
 |____/ \__,_|\__|\__|_|\___|

-->
	<div class="row">
		<div class="large-8 medium-8 columns">
			<h5>Lequel préfères-tu ?</h5>
			<div class="row">
				<?php
            // Récupération des 10 meilleurs chats
				$reponse = $db->query('SELECT * FROM tblchat ORDER BY RAND() LIMIT 0, 2');
				$chats = $reponse->fetchall();
				$reponse->closeCursor();
				?>
				<div class="large-5 medium-12 columns">
					<a href="?win=<?php echo $chats[0]['chatId']; ?>&amp;lose=<?php echo $chats[1]['chatId']; ?>">
						<figure>
							<img src="<?php echo htmlspecialchars($chats[0]['chatImage']); ?>" alt="<?php echo htmlspecialchars($chats[0]['chatNom']); ?>">
							<figcaption id="info1" class="panel">
								<?php echo htmlspecialchars($chats[0]['chatNom']); ?>
							</figcaption>
						</figure>
					</a>
				</div>
				<div class="large-2 medium-12 columns">
					<div style="margin: 50px 0;" class="medium alert expand button disabled">VS</div>
				</div>
				<div class="large-5 medium-12 columns">
					<a href="?win=<?php echo $chats[1]['chatId']; ?>&amp;lose=<?php echo $chats[0]['chatId']; ?>">
						<figure>
							<img src="<?php echo htmlspecialchars($chats[1]['chatImage']); ?>" alt="<?php echo htmlspecialchars($chats[1]['chatNom']); ?>">
							<figcaption class="panel">
								<?php echo htmlspecialchars($chats[1]['chatNom']); ?>
							</figcaption>
						</figure>
					</a>
				</div>
			</div>
		</div>

		<!--
  __  __
 |  \/  | ___ _ __  _   _
 | |\/| |/ _ \ '_ \| | | |
 | |  | |  __/ | | | |_| |
 |_|  |_|\___|_| |_|\__,_|

-->
		<?php require '_inc/menu.php'; ?>
	</div>
	<footer class="row">
		<div class="large-12 columns"><hr/>
			<div class="row">

				<div class="large-6 columns">
					<p>This site is built with <i class="fa fa-heart"></i> by Michel, Micheline &amp; Marjorie.</p>
				</div>
			</div>
		</div>
	</footer>
	<!--
  _____ _   _ _____ ___
 |_   _| | | |_   _/ _ \
   | | | | | | | || | | |
   | | | |_| | | || |_| |
   |_|  \___/  |_| \___/

-->
	<ol class="joyride-list" data-joyride>
		<li data-id="info1" data-text="Suivant" data-options="tip_location: left">
			<p>Vote pour le chat que tu pr&eacute;f&egrave;res en lui cliquant dessus.</p>
		</li>
		<li data-id="info2" data-text="Suivant" data-options="tip_location: right">
			<p>Tu peux aussi voir les chats pr&eacute;f&eacute;r&eacute;s.</p>
		</li>
		<li data-id="info3" data-text="Suivant" data-options="tip_location: right">
			<p>ou aussi les pires</p>
		</li>
		<li data-id="info4" data-text="Fin" data-options="tip_location: right">
			<p>et m&ecirc;me ajouter ton chat ici.</p>
		</li>
	</ol>

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.joyride.js"></script>
<script src="js/vendor/jquery.cookie.js"></script>
<script>
	$(document).foundation();

	function getCookie(cname)
	{
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i<ca.length; i++)
		{
		var c = ca[i].trim();
		if (c.indexOf(name)==0) return c.substring(name.length,c.length);
	}
	return "";
	}

	if (getCookie("tuto")=="")
  {
		$(document).foundation('joyride', 'start');
		var d = new Date();
		d.setTime(d.getTime()+(24*60*60*1000));
		var expires = "expires="+d.toGMTString();
		document.cookie = "tuto=true; "+expires;
	}
</script>
<script type="text/javascript">
  window.analytics=window.analytics||[],window.analytics.methods=["identify","group","track","page","pageview","alias","ready","on","once","off","trackLink","trackForm","trackClick","trackSubmit"],window.analytics.factory=function(t){return function(){var a=Array.prototype.slice.call(arguments);return a.unshift(t),window.analytics.push(a),window.analytics}};for(var i=0;i<window.analytics.methods.length;i++){var key=window.analytics.methods[i];window.analytics[key]=window.analytics.factory(key)}window.analytics.load=function(t){if(!document.getElementById("analytics-js")){var a=document.createElement("script");a.type="text/javascript",a.id="analytics-js",a.async=!0,a.src=("https:"===document.location.protocol?"https://":"http://")+"cdn.segment.io/analytics.js/v1/"+t+"/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n)}},window.analytics.SNIPPET_VERSION="2.0.9",
  window.analytics.load("etdqc4dt1b");
  window.analytics.page();
</script>
</body>
</html>
