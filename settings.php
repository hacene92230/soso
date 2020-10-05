<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

	if(isset($_POST['changeadress'])) {
		$region = $_POST['dep'];
		$adresse = $_POST['adresse'];
		$city = $_POST['city'];
		$postal = $_POST['postal'];
		if(!empty($region) && !empty($adresse) && !empty($city) && !empty($postal)) {
			$stmt = $bdd->prepare('UPDATE account SET region = :region, adresse = :adresse, city = :city, postal = :postal WHERE id = ' . $userid . '');
			$stmt->bindParam(':region', $region);
			$stmt->bindParam(':adresse', $adresse);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':postal', $postal);
			$stmt->execute();
			$error = "Adresse par défaut mise à jour.";
		} else {
			$error = "Veuillez completer correctement le formulaire.";
		}
	}

	if(isset($_POST['changephone'])) {
		$nphone = $_POST['phone'];
		if(!empty($nphone)) {
			$lphone = strlen($nphone);
			if($lphone == 10) {
				$stmt = $bdd->prepare('UPDATE account SET phone = :phone WHERE id = ' . $userid . '');
				$stmt->bindParam(':phone', $nphone);
				$stmt->execute();
				$error = "Numéro de téléphone enregistré.";
			} else {
				$error = "Veuillez entrer un format de numéro de téléphone correct.";
			}
		}
	}

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	if(!empty($row['region'])) {
		$dregion = $row['region'];
	}
	if(!empty($row['adresse'])) {
		$dadresse = $row['adresse'];
	}
	if(!empty($row['city'])) {
		$dcity = $row['city'];
	}
	if(!empty($row['postal'])) {
		$dpostal = $row['postal'];
	}
	if(!empty($row['phone'])) {
		$dphone = $row['phone'];
	}
?>
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
	<section class="sectiontext container">
		<h1 style="text-transform: none;">Paramètres du compte</h1>
		<section class="profil">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<form method="post">
							<h3>Adresse par défaut:</h3>
							<label style="margin-bottom: 10px;">Département :</label><?php require 'inc/dep.php'; ?>
							<label>Numéro d'adresse :</label><input type="text" name="adresse" placeholder="Ex: 15 rue de Paris" <?php if($dadresse){ echo 'value="' . $dadresse . '"'; } ?>>
							<label>Code postal :</label><input type="text" name="postal" placeholder="Ex: 75000" <?php if($dpostal){ echo 'value="' . $dpostal . '"'; } ?>>
							<label>Ville :</label><input type="text" name="city" placeholder="Ex: Paris" <?php if($dcity){ echo 'value="' . $dcity . '"'; } ?>>
							<input type="submit" name="changeadress" value="Changer l'adresse par défaut">
						</form>
					</div>
					<div class="col-md-6">
						<form method="post">
							<h3>Numéro de téléphone :</h3>
							<input type="text" name="phone" placeholder="Ex: 0612542541" <?php if($dphone){ echo 'value="' . $dphone . '"'; } ?>>
							<input type="submit" name="changephone" value="Changer le numéro de téléphone">
						</form>
					</div>
				</div>
			</div>
			<p class="error"><?php if(!empty($error)) { echo $error; } ?></p>
		</section>
	</section>
	<?php require 'inc/footer.php'; ?>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>