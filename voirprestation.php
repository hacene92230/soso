<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

	$demandeid = $_GET['id'];

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	$userlevel = $row['level'];

	$result3 = $bdd->query('SELECT * FROM demandeprestation WHERE id =' . $demandeid);
    $row3 = $result3->fetch();
    $duserid = $row3['userid'];
    $name = $row3['name'];
    $fname = $row3['fname'];
    $accepted = $row3['accepted'];

    $jour = $row3['jour'];
    $heure = $row3['heure'];
    $city = $row3['ville'];
    $img = strtoupper($row3['prestation']);
    $materiel = strtoupper($row3['materiel']);
    $phone = $row3['phone'];
    $prestation = strtoupper($row3['prestation']);
    $informations = $row3['informations'];

    $result4 = $bdd->query('SELECT * FROM account WHERE id = ' . $duserid . '');
	$row4 = $result4->fetch();
	$duserlevel = $row4['level'];

	if($userlevel < "2") {
		header('Location: index');
	}

	/* Configure le script en français */
	setlocale(LC_TIME, "fr_FR");
	//Définit le décalage horaire par défaut de toutes les fonctions date/heure  
	date_default_timezone_set("Europe/Paris");
	//Definit l'encodage interne
	mb_internal_encoding("UTF-8");
	//Convertir une date US en françcais
	function dateFr($date){
	return strftime('%d-%m-%Y',strtotime($date));
	}

	if(isset($_POST['accept'])) {
		$accepted = 1;
		$accepter = $bdd->prepare('UPDATE demandeprestation SET accepted = :accepted WHERE id = '. $demandeid);
		$accepter->bindParam(':accepted', $accepted);
		$accepter->execute();

		$status = "En cours";
		$accept = $bdd->prepare('INSERT INTO prestationsencours(prestationid, prestataireid, clientid, status, type, jour, heure) VALUES(:prestationid, :prestataireid, :clientid, :status, :type, :jour, :heure)');
		$accept->bindParam(':prestationid', $demandeid);
		$accept->bindParam(':prestataireid', $userid);
		$accept->bindParam(':clientid', $duserid);
		$accept->bindParam(':status', $status);
		$accept->bindParam(':type', $img);
		$accept->bindParam(':jour', $jour);
		$accept->bindParam(':heure', $heure);
		$accept->execute();

		$error = "Vous avez acceptée la demande, redirection vers vos demandes en cours dans 5 secondes.";
		header( "refresh:5;url=https://hidoyat.fr/soso/mesprestations" );
	}
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php require 'inc/name.php'; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<style type="text/css">
		img {
			width: 50%;
			height: 50%;
		}

		span {
			font-weight: bold;
			font-size: 18px;
		}

		input {
			display: inline-block;
		}

		.col-md-4 {
			margin-bottom: 20px !important;
		}

		.pres-info {
			margin-top: 15px;
			text-align: center;
		}

		.pres-info span {
			display: block;
		}
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none; margin-top: -20px;">Demande prestataire <?php echo $demandeid; ?></h1>
		<section class="profil">
			<p class="error"><?php if($error) { echo $error; } ?></p>
				<div class="row" style="text-align: center; margin-top: 50px;">
					<div class="col-md-4"><span>Demandeur:</span> <?php echo $name, ' ', $fname; ?></div>
					<div class="col-md-4"><span>Date:</span> <?php echo dateFr($jour), ' ', $heure; ?></div>
					<div class="col-md-4"><span>Ville:</span> <?= $city ?></div>
					<div class="col-md-4"><span>Préstation:</span> <?= $img ?></div>
					<div class="col-md-4"><span>Téléphone:</span> <?= $phone ?></div>
					<div class="col-md-4"><span>Materiel:</span> <?= $materiel ?></div>
				</div>
				<p class="pres-info"><span>Informations:</span> <?= $informations ?></p>
				<?php if($accepted == 0) { ?>
					<form method="post">
						<input type="submit" name="accept" value="Accepter la demande">
					</form>
				<?php } else { echo "Cette demande à déjà été acceptée. <a href='mesprestations'>revenir à mes prestations en cours.</a>"; } ?>
		</section>
	</section>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>