<?php session_start(); ?>
<?php

require 'inc/bd.php';
if(isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(!empty($email) && !empty($password)) {
		$result = $bdd->query('SELECT * FROM account WHERE email = "' . $email . '"');
		$row = $result->fetch();
		if(!empty($row['email'])) {
			$accpassword = $row['password'];
			if (password_verify($password, $accpassword)) {
			    $_SESSION['email'] = $email;
			    $_SESSION['name'] = $row['name'];
			    $_SESSION['userid'] = $row['id'];
			    header('Location: index');
			} else {
			    $error = "Le mot de passe et/ou l'adresse email sont incorrect.";
			}	
		}
		else {
			$error = "Aucun compte avec cette adresse email n'a été trouvé.";
		}
	}
	else
	{
		$error = "Veuillez compléter le formulaire.";
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
		<h1>Connexion</h1>
		<form method="post">
			<input type="text" name="email" placeholder="Adresse email" required="true">
			<input type="password" name="password" placeholder="Mot de passe" required="true">
			<input type="submit" name="login" value="Se connecter">
		</form>
		<?php if($error) { echo $error; } ?>
	</section>

	<?php require 'inc/footer.php'; ?>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>