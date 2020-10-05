<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	$name = $row['name'];
	$fname = $row['fname'];
	$email = $row['email'];
	$phone = $row['phone'];
	$dadresse = $row['adresse'];
	$postal = $row['postal'];
	$city = $row['city'];

	if(isset($_POST['dprestation'])) {
		$prestation = $_POST['selectp'];
		$materiel = $_POST['materiel'];
		$jour = $_POST['jour'];
		$heure = $_POST['heure'];
		$informations = $_POST['informations'];
		$accepted = "0";
		$ended = "0";
		if(!empty($prestation) && !empty($materiel) && !empty($jour) && !empty($heure) && !empty($informations)) {
			$stmt = $bdd->prepare('INSERT INTO demandeprestation(userid, accepted, fname, name, phone, prestation, materiel, jour, ville, heure, informations, ended) VALUES(:userid, :accepted, :fname, :name, :phone, :prestation, :materiel, :jour, :ville, :heure, :informations, :ended)');
			$stmt->bindParam(':userid', $userid);
			$stmt->bindParam(':accepted', $accepted);
			$stmt->bindParam(':fname', $fname);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':prestation', $prestation);
			$stmt->bindParam(':materiel', $materiel);
			$stmt->bindParam(':jour', $jour);
			$stmt->bindParam(':ville', $city);
			$stmt->bindParam(':heure', $heure);
			$stmt->bindParam(':informations', $informations);
			$stmt->bindParam(':ended', $ended);
			$stmt->execute();
			$error = "Demande de préstation envoyé à la liste des demandes en attente. Si un prestataire est interessé par votre demande il vous contactera.";
		}
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
		input, textarea, select {
			width: 320px !important;
		}

		textarea {
			width: 500px !important;
			min-height: 200px;
		}
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none; margin-top: -30px;">Demander une prestation</h1>
		<section class="profil">
			<?php if(!empty($phone) || !empty($dadresse)) {?> 
				<p class="error"><?php if($error) { echo $error; } ?></p>
				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<label>Nom:</label><input disabled="true" type="text" name="fname" value=<?php echo $fname; ?> />
						</div>
						<div class="col-md-6">
							<label>Prénom:</label><input disabled="true" type="text" name="name" value=<?php echo $name; ?> />
						</div>
						<div class="col-md-6">
							<label>Téléphone:</label><input disabled="true" type="text" name="phone" value=<?php echo $phone; ?> />
						</div>
						<div class="col-md-6">
							<label>Adresse:</label><input disabled="true" type="text" name="adresse" value="<?= $dadresse ?>, <?= $postal ?> <?= $city ?>" />
						</div>
						<div class="col-md-6">
							<label style="margin-bottom: 15px;">Préstation nécessaire :</label>
							<select name="selectp">
								<option value="courses">Faire les courses</option>
								<option value="menage">Faire du ménage</option>
								<option value="repassage">Faire du repassage</option>
								<option value="debarasser">Débarrasser votre logement de choses qui vous encombre</option>
								<option value="cuisiner">Cuisiner</option>
							</select>
						</div>
						<div class="col-md-6">
							<label style="margin-bottom: 15px;">Avez vous le matériel necessaire :</label>
							<select name="materiel">
								<option value="oui">Oui</option>
								<option value="non">Non</option>
							</select>
						</div>
						<div class="col-md-6">
							<label>Date:</label><input type="date" name="jour" />
						</div>
						<div class="col-md-6">
							<label>Heure:</label><input type="time" name="heure" />
						</div>
						<div style="display: block; margin: 0 auto;">
							<label>Autres informations:</label><textarea name="informations" placeholder="Veuillez nous donner plus d'informations concernant votre demande"></textarea>
						</div>
					</div>
					<input type='submit' name="dprestation" value='Envoyer ma demande' style="margin-top: 20px; margin-bottom: 50px;" />
				</form>
			<?php } else { echo "Avant de devenir prestataire, il vous faut renseigner un numéro de téléphone ainsi qu'une adresse <a href='settings'>ici</a>."; } ?>
		</section>
	</section>
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
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.classList.add("imagepreview");
    output.src = URL.createObjectURL(event.target.files[0]);
  };

  var loadFile2 = function(event) {
    var output2 = document.getElementById('output2');
    output2.classList.add("imagepreview");
    output2.src = URL.createObjectURL(event.target.files[0]);
  };
</script>	
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>