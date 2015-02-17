<!doctype html>
<?php
require_once 'db_connect.php';
$req = $db->prepare('SELECT * FROM tblchat WHERE chatId=?');
$req->execute(array($_GET['id']));
$chat = $req->fetch();
?>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $chat['chatNom']; ?> - Kwar</title>
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="/css/foundation.css" />
	<script src="/js/vendor/modernizr.js"></script>
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
			<h5><?php echo $chat['chatNom']; ?></h5>
			<div class="row">
				<div class="large-12 medium-12 columns">
					<figure>
						<img src="<?php echo htmlspecialchars($chat['chatImage']); ?>" alt="<?php echo htmlspecialchars($chat['chatNom']); ?>">
						<figcaption class="panel">
							<table width="100%">
								<tr>
									<td>Nom</td>
									<td><?php echo $chat['chatNom']; ?></td>
								</tr>
								<tr>
									<td>Pourcentage <i class="fa fa-heart"></i></td>
									<td><?php echo round($chat['chatVotesPositifs']/($chat['chatVotesPositifs']+$chat['chatVotesNegatifs'])*100); ?>%</td>
								</tr>
								<tr>
									<td>Votes positifs</td>
									<td><?php echo $chat['chatVotesPositifs']; ?></td>
								</tr>
								<tr>
									<td>Votes négatifs</td>
									<td><?php echo $chat['chatVotesNegatifs']; ?></td>
								</tr>
								<tr>
									<td>Votes totaux</td>
									<td><?php echo $chat['chatVotesPositifs']+$chat['chatVotesNegatifs']; ?></td>
								</tr>
							</table>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>

		<!-- Menu -->
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
<!--<script src="/js/vendor/jquery.js"></script>
<script src="/js/foundation.min.js"></script>
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
