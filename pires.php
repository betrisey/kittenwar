<!doctype html>
<?php
require_once 'db_connect.php';
?>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Les pires - Kwar</title>
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
	<div class="row">
		<div class="large-8 medium-8 columns">
			<h5>Les chats que vous aimez le moins :</h5>
			<div class="row">
				<?php
            		// Récupération des 10 meilleurs chats
				$reponse = $db->query('SELECT * FROM tblchat WHERE chatVotesPositifs != 0 AND chatVotesPositifs != 0 ORDER BY chatVotesPositifs/(chatVotesPositifs+chatVotesNegatifs) LIMIT 0, 10');
				while ($chat = $reponse->fetch())
				{
					?>
					<div class="large-6 medium-12 columns">
						<a href="chat.php?id=<?php echo $chat['chatId']; ?>">
							<figure>
								<img src="<?php echo htmlspecialchars($chat['chatImage']); ?>" alt="<?php echo htmlspecialchars($chat['chatNom']); ?>">
								<figcaption class="panel">
									<?php echo htmlspecialchars($chat['chatNom']); ?><br>
									<code><?php echo round($chat['chatVotesPositifs']/($chat['chatVotesPositifs']+$chat['chatVotesNegatifs'])*100); ?>% <i class="fa fa-heart"></i></code>
								</figcaption>
							</figure>
						</a>
					</div>
					<?php
				}
				$reponse->closeCursor();
				?>
			</div>
		</div>

		<!-- Menu -->
		<div class="large-4 medium-4 columns">
			<p>
				<a href="index.php" class="medium expand button">Voter</a><br/>
				<a href="meilleurs.php" class="medium expand success button">Les meilleurs</a><br/>
				<a class="medium alert expand disabled button">Les pires</a><br/>
				<a href="ajouter.php" class="medium expand button">Ajouter</a>
			</p>
			<div class="panel">
				<h5>Télécharge l'appli !</h5>
				<p>Kittenwar est disponible sur Android.</p>
				<a class="small disabled button">Télécharger</a>
			</div>
		</div>
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
<!--<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
  $(document).foundation();
</script>-->
<script type="text/javascript">
  window.analytics=window.analytics||[],window.analytics.methods=["identify","group","track","page","pageview","alias","ready","on","once","off","trackLink","trackForm","trackClick","trackSubmit"],window.analytics.factory=function(t){return function(){var a=Array.prototype.slice.call(arguments);return a.unshift(t),window.analytics.push(a),window.analytics}};for(var i=0;i<window.analytics.methods.length;i++){var key=window.analytics.methods[i];window.analytics[key]=window.analytics.factory(key)}window.analytics.load=function(t){if(!document.getElementById("analytics-js")){var a=document.createElement("script");a.type="text/javascript",a.id="analytics-js",a.async=!0,a.src=("https:"===document.location.protocol?"https://":"http://")+"cdn.segment.io/analytics.js/v1/"+t+"/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n)}},window.analytics.SNIPPET_VERSION="2.0.9",
  window.analytics.load("etdqc4dt1b");
  window.analytics.page();
</script>
</body>
</html>
