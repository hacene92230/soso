<?php session_start(); ?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php require 'inc/name.php'; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<div class="wallpaper">
		<h1><?php require 'inc/name.php'; ?>, LE SITE N°1 DE PRESTATAIRES</h1>
		<div id="joinus" class="headerinfo hidden">
			<p class="joinus">Rejoignez nous dès maintenant !</p>
			<div class="container">
				<form>
					<input type="text" name="email" placeholder="Adresse email" required="true">
					<input type="text" name="username" placeholder="Nom de compte" required="true">
					<input type="password" name="password" placeholder="Mot de passe" required="true">
					<input type="submit" name="inscription" value="S'inscrire">
				</form>
			</div>
			<p class="info">En vous inscrivant vous certifiez accepter nos conditions générales et la politique de confidentialité de soso.com.</p>
		</div>
		<div id="joinus-xs" class="headerinfo-xs hidden">
			<div class="textinfo">
				<p class="joinus" style="margin-top: -15px;">Rejoignez nous dès maintenant !</p><span class="buttoninscrire" onclick="window.open('https://hidoyat.fr/soso/signup.php');">S'inscrire !</span>
			</div>
		</div>
	</div>
	<section class="about container">
		<!--<h2><i class="far fa-question-circle titleicon"></i> PRÉSENTATION</h2>-->
		<h1><b>Soso est une application qui à pour but d’offrir du service à la personne.</b></h1>
		<p>En effet, tout le monde peut réserver une prestation de service qui sera effectué à l’adresse indiqué, le prestataire se déplace. Vous pouvez simplement réserver différentes prestations comme :</p>
			<ul>
				<li><a href=""><i class="fas fa-shopping-cart"></i></a> Faire les courses</li>
				<li><a href=""><i class="fas fa-broom"></i></a> Faire du ménage</li>
				<li><a href=""><i class="fas fa-tshirt"></i></a> Faire du repassage</li>
				<li><a href=""><i class="fas fa-couch"></i></a> Débarrasser votre logement de choses qui vous encombre</li>
				<li><a href=""><i class="fas fa-concierge-bell"></i></a> Cuisiner</li>
			</ul>
		<p>Chaque prestation que vous réservez est calculé en fonction du nombre d’heures effectué, plus vous augmentez le nombre d'heurs d'intervention plus le prix sera élevé, cependant des promotions peuvent vous être proposé.</p>
	</section>

	<div id="cookiesbandeau" class="cookies">
		En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de Cookies afin de réaliser des statistiques anonymes de visites.<br>
		<button onclick="setCookie('cookies','true',31);">Accepter</button>
		<button onclick="window.open('cookies');">En savoir plus</button>
	</div>
	<footer>
		<div class="footer">
			<ul>
				<li><a href="cgv">CGV</a></li>
				<li><a href="rules">CGU</a></li>
				<li><a href="contact">Contact</a></li>
				<li class="copyright"> &copy; Fast Cleaning: Tous droits r&#201;serv&#201;s (2019-2020).</li>
			</ul>
		</div>
	</footer>


<script type="text/javascript" src="js/cookies.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript" src="js/nav.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>