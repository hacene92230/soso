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

	$result3 = $bdd->query('SELECT * FROM demandeprestataire WHERE id =' . $demandeid);
    $row3 = $result3->fetch();
    $duserid = $row3['userid'];
    $status = $row3['status'];
    $email = $row3['email'];
    $name = $row3['name'];
    $fname = $row3['fname'];
    $adresse = $row3['adresse'];
    $phone = $row3['phone'];
    $parcours = $row3['parcours'];
    $rci = $row3['rci'];
    $vci = $row3['vci'];

    $result4 = $bdd->query('SELECT * FROM account WHERE id = ' . $duserid . '');
	$row4 = $result4->fetch();
	$duserlevel = $row4['level'];

	if($userlevel < "2") {
		header('Location: index');
	}

	if(isset($_POST['accepter'])) {
		$status = "Acceptée";
		
		if($duserlevel < "2") {
			$level = "1";
		} else {
			$level = "3";
		}

		$accepter = $bdd->prepare('UPDATE demandeprestataire SET status = :status WHERE id = '. $demandeid);
		$accepter->bindParam(':status', $status);
		$accepter->execute();

		$req = $bdd->prepare('UPDATE account SET level = :level WHERE id = '. $duserid);
		$req->bindParam(':level', $level);
		$req->execute();

		header('Location: dprestataire');
	}

	if(isset($_POST['refuser'])) {
		$refuser = $bdd->query('DELETE FROM demandeprestataire WHERE id = '. $demandeid);
		header('Location: dprestataire');
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
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none; margin-top: -20px;">Demande prestatire <?php echo $demandeid; ?></h1>
		<section class="profil">
			<p class="error"><?php if($error) { echo $error; } ?></p>
			<center>
				<form method="post">
					<input type="submit" name="accepter" value="Accepter la demande" style="display: inline-block;">
					<input type="submit" name="refuser" value="Refuser la demande" style="display: inline-block;">
				</form>
			</center>
				<div class="row" style="text-align: center; margin-top: 50px;">
					<div class="col-md-4"><span>UserID:</span> <?= $duserid ?></div>
					<div class="col-md-4"><span>Status:</span> <?= $status ?></div>
					<div class="col-md-4"><span>Nom:</span> <?= $fname ?></div>
					<div class="col-md-4"><span>Prénom:</span> <?= $name ?></div>
					<div class="col-md-4"><span>Adresse:</span> <?= $adresse ?></div>
					<div class="col-md-4"><span>Téléphone:</span> <?= $phone ?></div>
					<div class="col-md-12" style="margin-top: 20px;"><span>Parcours:</span><br><?= $parcours ?></div>
					<div style="margin-top: 50px;">
						<div class="col-md-12">
							<img <?php echo "src='" . $rci . "'"; ?>>
						</div>
						<div class="col-md-12" style="margin-top: 15px;">
							<img <?php echo "src='" . $vci . "'"; ?>>
						</div>
					</div>
				</div>
		</section>
	</section>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>