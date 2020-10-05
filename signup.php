<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	if(isset($_POST['inscription'])) {
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$cmail = $_POST['cmail'];
		$cgu = $_POST['cgu'];
		$password = password_hash($password, PASSWORD_ARGON2I);

		if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)) {
				
				$result = $bdd->query('SELECT * FROM account WHERE email = "' . $email . '"');
				$row = $result->fetch();
				if(empty($row['email'])) {
					if($cgu) {
						$stmt = $bdd->prepare("INSERT INTO account(name, fname, email, password, joindate, newsletter) VALUES(:name, :fname, :mail, :password, :joindate, :newsletter)");
						$stmt->bindParam(':name', $firstname);
						$stmt->bindParam(':fname', $lastname);
						$stmt->bindParam(':mail', $email);
						$stmt->bindParam(':password', $password);
						$stmt->bindParam(':joindate', date("d-m-Y"));
						$stmt->bindParam(':newsletter', $cmail);
						$stmt->execute();
						$error = 'Inscription validée, connectez-vous <a href="login">ici</a>.';
					}
				}
				else {
					$error = "Un compte ayant cette adresse email existe déjà.";
				}
		}	
		else
		{
			$error = "Veuillez completer le formulaire. (par ailleurs, cette erreur ne devrait pas avoir lieu.";
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
		<h1>Inscription</h1>
		<form method="post" id="signupform">
			<input type="text" id="firstname" name="firstname" placeholder="Prénom" required="true">
			<input type="text" id="lastname" name="lastname" placeholder="Nom" required="true">
			<input type="email" id="email" name="email" placeholder="Adresse email" required="true">
			<input type="password" id="password" name="password" placeholder="Mot de passe" required="true">
			<center>
				<div>
					<label for="cmail"><input type="checkbox" name="cmail" id="cmail" value="c1" checked>S'abonner à la newsteller</label>
				</div>
				<div>
					<label for="cgu"><input type="checkbox" name="cgu" id="cgu" value="cgu1">J'accepte les <a href="rules" target="_blank">conditions générales d'utilisation</a>.</label>
				</div>
			</center>
			<input type="submit" name="inscription" onclick="return val()" value="S'inscrire">
		</form>
		<p id="error" class="error"></p>
		<?php if($error) { echo '<a id="test">' . $error . '</a>'; } if($error2) { echo $error2; } ?>
	</section>

	<?php require 'inc/footer.php'; ?>
	<script type="text/javascript">
		function val(){
		    var firstname = document.getElementById('firstname').value;
		    var lastname = document.getElementById('lastname').value;
		    var email = document.getElementById('email').value;
		    var password = document.getElementById('password').value;
		    var cmail = document.getElementById('cmail').checked;
		    var cgu = document.getElementById('cgu').checked;
		    var error = document.getElementById("error");
		    if(firstname !== "" && firstname !== null && lastname !== "" && lastname !== null && email !== "" && email !== null && password !== "" && password !== null){
		    	if(cgu) {
		    		var signupform = document.getElementById("signupform");
		    		signupform.classList.add("hidden");
		    		return true;
		    	}
		    	else {
		    		error.innerHTML = "Veuillez accepter nos conditions générales d'utilisation.";
		    		return false;
		    	}
		    }
		    else {
		    	error.innerHTML = "Veuillez completer le formulaire en entier.";
		        return false;
		    }

		}
	</script>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>