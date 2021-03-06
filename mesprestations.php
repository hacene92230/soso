<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	$userlevel = $row['level'];
	if($userlevel < "1") {
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
?>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php require 'inc/name.php'; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<style type="text/css">
		input {
			display: inline-block !important;
			border-color: green !important;
			margin-right: 20px !important;
		}
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none;">Mes préstations à réaliser</h1>
		<section class="profil">
			<center>
				<div class="row">
					<?php
						$result3 = $bdd->query('SELECT * FROM prestationsencours WHERE status = "En cours" && prestataireid = ' . $userid . ' ORDER BY jour, type');
						while ($row3 = $result3->fetch())
						{
							$id = $row3['prestationid'];
							$clientid = $row3['clientid'];
							$status = $row3['status'];
							$jour = $row3['jour'];
							$heure = $row3['heure'];
							$img = strtolower($row3['type']);
							$prestation = strtoupper($row3['type']);
						?>
						<div class="col-md-4" style="margin-top: 30px; margin-bottom: 15px;">
							<div class="card" style="width: 18rem;">
								<img class="card-img-top" height="250px" <?php echo 'src="img/prestation/'. $img .'.png"'; ?> <?php echo 'alt="' . $prestation . '"'; ?>>
								<div class="card-body">
									<h5 class="card-title"><?= $prestation ?></h5>
									<h5 class="card-title"><?php echo dateFr($jour), ' ', $heure; ?></h5>
									<!--<p class="card-text"><i class="fas fa-user"></i><?php echo $name, ' ', $fname; ?></p>-->						
									<a href="voirprestation?id=<?=$id?>" class="btn btn-primary" style="display: block; margin: 0 auto;"><i class="fas fa-eye"></i> Voir plus</a>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if(empty($clientid)) { $error1 = "Aucune préstation pour ce jour trouvé."; } ?>
						<p class="error"> <?php if(!empty($error1)) { echo $error1; } ?> </p>
				</div>
			</center>
		</section>
	</section>
	<section class="sectiontext container">
		<h1 style="text-transform: none; margin-top: -80px;">Mes futures échéances</h1>
		<section class="profil">
			<center>
				<div class="row">
					<?php
						$result3 = $bdd->query('SELECT * FROM prestationsencours WHERE status = "En cours" && clientid = ' . $userid . ' ORDER BY jour, type');
						while ($row3 = $result3->fetch())
						{
							$id = $row3['prestationid'];
							$clientid = $row3['clientid'];
							$status = $row3['status'];
							$jour = $row3['jour'];
							$heure = $row3['heure'];
							$img = strtolower($row3['type']);
							$prestation = strtoupper($row3['type']);
						?>
						<div class="col-md-4" style="margin-top: 30px; margin-bottom: 15px;">
							<div class="card" style="width: 18rem;">
								<img class="card-img-top" height="250px" <?php echo 'src="img/prestation/'. $img .'.png"'; ?> <?php echo 'alt="' . $prestation . '"'; ?>>
								<div class="card-body">
									<h5 class="card-title"><?= $prestation ?></h5>
									<h5 class="card-title"><?php echo dateFr($jour), ' ', $heure; ?></h5>
									<!--<p class="card-text"><i class="fas fa-user"></i><?php echo $name, ' ', $fname; ?></p>-->						
									<a href="voirprestation?id=<?=$id?>" class="btn btn-primary" style="display: block; margin: 0 auto;"><i class="fas fa-eye"></i> Voir plus</a>
								</div>
							</div>
						</div>
						<?php } ?>
						<?php if(empty($clientid)) { $error1 = "Aucune préstation pour ce jour trouvé."; } ?>
						<p class="error"> <?php if(!empty($error1)) { echo $error1; } ?> </p>
				</div>
			</center>
		</section>
	</section>

<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>