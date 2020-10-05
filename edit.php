<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];

	if(empty($userid)) {
		header('Location: index');
	}

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	if(!empty($row['password'])) {
		$dpassword = $row['password'];
	}

	if(isset($_POST['changeemail'])) {
		$ceemail = $_POST['ceemail'];
		$cepassword = $_POST['cepassword'];
		if(!empty($ceemail) && !empty($cepassword)) {
			if(password_verify($cepassword, $dpassword)) {
				$result2 = $bdd->query('SELECT * FROM account WHERE email = "' . $row['email'] . '"');
				$row2 = $result2->fetch();
				if(empty($row2['email'])) {
					$stmt = $bdd->prepare('UPDATE account SET email = :email WHERE id = ' . $userid . '');
					$stmt->bindParam(':email', $ceemail);
					$stmt->execute();
					$error = "L'adresse email à correctement été mise à jour.";
				}
				else {
					$error = "Un compte utilisant cette adresse email éxiste déjà.";
				}
			}
			else {
				$error = "Le mot de passe actuel ne correspond pas.";
			}
		}
		else {
			$error = "Veuillez completer correctement le formulaire.";
		}
	}

	if(isset($_POST['changepassword'])) {
		$apassword = $_POST['apassword'];
		$npassword = $_POST['npassword'];
		$npasswordc = $_POST['npasswordc'];
		if(!empty($apassword) && !empty($npassword) && !empty($npasswordc)) {
			if(password_verify($apassword, $dpassword)) {
				if($npassword == $npasswordc) {
					$password = password_hash($npassword, PASSWORD_ARGON2I);
					$stmt = $bdd->prepare('UPDATE account SET password = :password WHERE id = ' . $userid . '');
					$stmt->bindParam(':password', $password);
					$stmt->execute();
					$error = "Le mot de passe à été mis à jour.";
				}
				else
				{
					$error = "La confirmation du mot de passe ne correspond pas.";
				}
			}
			else
			{
				$error = "Le mot de passe actuel ne correspond pas.";
			}
		} else {
			$error = "Veuillez completer correctement le formulaire.";
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
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none;">Edition du compte</h1>
		<section class="profil">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<form method="post">
							<h3>Changer de mot de passe:</h3>
							<input type="password" name="apassword" placeholder="Mot de passe actuel">
							<input type="password" name="npassword" placeholder="Nouveau mot de passe">
							<input type="password" name="npasswordc" placeholder="Répéter le nouveau mot de passe">
							<input type="submit" name="changepassword" value="Changer de mot de passe">
						</form>
					</div>
					<div class="col-md-6">
						<form method="post">
							<h3>Changer d'adresse email:</h3>
							<input type="text" name="ceemail" placeholder="Nouvelle adresse email">
							<input type="password" name="cepassword" placeholder="Mot de passe actuel">
							<input type="submit" name="changeemail" value="Changer d'adresse email">
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