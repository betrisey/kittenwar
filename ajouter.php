<?php
require_once 'db_connect.php';
if (isset($_FILES['img'])) {
	$img = $_FILES['img'];
}
if(isset($img) && $img['name']=='' || isset($_POST['nom']) && $_POST['nom']=='')
{
	$status = false;
}
if(isset($img) && $img['name']!='' && isset($_POST['nom']) && $_POST['nom']!='')
{
	$filename = $img['tmp_name'];
	$client_id="c81a88ca509d9e3";
	$handle = fopen($filename, "r");
	$data = fread($handle, filesize($filename));
	$pvars   = array('image' => base64_encode($data));
	$timeout = 30;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
	curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
	$out = curl_exec($curl);
	curl_close ($curl);
	$pms = json_decode($out,true);
	$url=$pms['data']['link'];
	$url = preg_replace('#http[s]?://i.imgur.com/([a-zA-Z0-9]{7}).([a-zA-Z]{3})#', 'https://i.imgur.com/$1l.$2', $url);
	if($url!="")
	{
        // OK
		$req = $db->prepare('INSERT INTO tblchat (chatNom, chatImage) VALUES(?, ?)');
		$req->execute(array($_POST['nom'], $url));
		$status = true;
	}
	else
	{
        	$status = false;
	}
}
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Ajouter - Kwar</title>
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
		<?php
			if (isset($status) && $status) {
				echo '<div data-alert class="alert-box success">
					Votre chat a bien été ajouté. Merci <i class="fa fa-smile-o"></i>
					<a href="#" class="close">&times;</a>
				</div>';
			}
			if (isset($status) && !$status) {
				echo '<div data-alert class="alert-box alert">
					Il y a eu une erreur lors de l\'envoi :(
					<a href="#" class="close">&times;</a>
				</div>';
			}
		?>
			<form action="#" enctype="multipart/form-data" method="post">
				<div class="row">
					<div class="large-12 columns">
						<label>Nom du chat
							<input type="text" name="nom" placeholder="Hello Kitty" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>Photo du chat
							<input type="file" name="img" />
						</label>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<label>
							<input type="submit" class="button" value="Envoyer !" />
						</label>
					</div>
				</div>
			</form>
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
	<script src="js/vendor/jquery.js"></script>
	<script src="js/foundation.min.js"></script>
	<script>
	  $(document).foundation();
	</script>
	<script type="text/javascript">
	  window.analytics=window.analytics||[],window.analytics.methods=["identify","group","track","page","pageview","alias","ready","on","once","off","trackLink","trackForm","trackClick","trackSubmit"],window.analytics.factory=function(t){return function(){var a=Array.prototype.slice.call(arguments);return a.unshift(t),window.analytics.push(a),window.analytics}};for(var i=0;i<window.analytics.methods.length;i++){var key=window.analytics.methods[i];window.analytics[key]=window.analytics.factory(key)}window.analytics.load=function(t){if(!document.getElementById("analytics-js")){var a=document.createElement("script");a.type="text/javascript",a.id="analytics-js",a.async=!0,a.src=("https:"===document.location.protocol?"https://":"http://")+"cdn.segment.io/analytics.js/v1/"+t+"/analytics.min.js";var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(a,n)}},window.analytics.SNIPPET_VERSION="2.0.9",
	  window.analytics.load("etdqc4dt1b");
	  window.analytics.page();
	</script>
</body>
</html>
