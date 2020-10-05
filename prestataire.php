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

	if(isset($_POST['bprestataire'])) {
		$status = "En attente";
		$name = $_POST['name'];
		$fname = $_POST['fname'];
		$phone = $_POST['phone'];
		$adresse = $_POST['adresse'];
		$parcours = $_POST['parcours'];

		$rci = $_FILES['rci'];
		$vci = $_FILES['vci'];

		$rcitmp = $rci['tmp_name'];
		$rciname = $rci['name'];
		$rcitype = strtolower(pathinfo(basename($rciname),PATHINFO_EXTENSION));

		$vcitmp = $vci['tmp_name'];
		$vciname = $vci['name'];
		$vcitype = strtolower(pathinfo(basename($vciname),PATHINFO_EXTENSION));

		$filerciname = "rci". $userid . "." . $rcitype;
		$filevciname = "vci". $userid . "." . $vcitype;

		$rcistore = "upload/".$filerciname;
		$vcistore = "upload/".$filevciname;

		if(!empty($name) && !empty($fname) && !empty($phone) && !empty($adresse) && !empty($parcours) && !empty($rci) && !empty($vci)) {
			$result2 = $bdd->query('SELECT * FROM demandeprestataire WHERE userid = ' . $userid . '');
			$row2 = $result2->fetch();
			$demandeexist = $row2['status'];
			if(empty($demandeexist)) {
				move_uploaded_file($rcitmp, $rcistore);
				move_uploaded_file($vcitmp, $vcistore);
				$stmt = $bdd->prepare('INSERT INTO demandeprestataire(userid,status,email,name,fname,adresse,phone,parcours,rci,vci) VALUES(:userid, :status, :email, :name, :fname, :adresse, :phone, :parcours, :rci, :vci)');
				$stmt->bindParam(':userid', $userid);
				$stmt->bindParam(':status', $status);
				$stmt->bindParam(':email', $email);
				$stmt->bindParam(':name', $name);
				$stmt->bindParam(':fname', $fname);
				$stmt->bindParam(':adresse', $dadresse);
				$stmt->bindParam(':phone', $phone);
				$stmt->bindParam(':parcours', $parcours);
				$stmt->bindParam(':rci', $rcistore);
				$stmt->bindParam(':vci', $vcistore);
				$stmt->execute();
				$error = "Demande valiée, il faut maintenant qu'un administrateur accepte votre demande.";
			}
			else {
				$error = "Vous avez déjà une demande en cours de traitement / validée.";
			}
		} else {
			$error = "Veuillez completer le formulaire en entier.";
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
		input, textarea {
			width: 310px !important;
		}

		.imagepreview {
			width: 555px; 
			height: 314px; 
			display: block;
			margin: 0 auto;
			margin-top: 15px !important;
		}
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none; margin-top: -20px;">Devenir prestataire</h1>
		<section class="profil">
			<?php if(!empty($phone) || !empty($adresse)) {?> 
				<p class="error"><?php if($error) { echo $error; } ?></p>
				<form method="post" enctype="multipart/form-data">
					<label>Nom:</label><input type="text" name="fname" value=<?php echo $fname; ?> />
					<label>Prénom:</label><input type="text" name="name" value=<?php echo $name; ?> />
					<label>Téléphone:</label><input type="text" name="phone" value=<?php echo $phone; ?> />
					<label>Adresse:</label><input type="text" name="adresse" value="<?= $dadresse ?>, <?= $postal ?> <?= $city ?>" />
					<label>Votre parcours:</label><textarea name="parcours" placeholder="Veuillez nous décrire votre parcours (formations, diplômes...)"></textarea>
					<label>Carte d'identitée recto: (jpeg ou png)</label><input type='file' name='rci' onchange="loadFile(event)" />
					<img id="output">
					<label>Carte d'identitée verso: (jpeg ou png)</label><input type='file' name='vci' onchange="loadFile2(event)" />
					<img id="output2">
					<input type='submit' name="bprestataire" value='Envoyer ma demande' />
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