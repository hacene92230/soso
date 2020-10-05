<?php session_start(); ?>
<?php
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
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
	<section class="sectiontext">
		<h1 style="text-transform: none;">Informations du compte</h1>
		<section class="profil infos" style="text-align: center; margin-top: 30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<span><i class="fas fa-signature"></i> Nom:</span> <?php echo $row['fname']; ?>
					</div>
					<div class="col-md-4">
						<span><i class="fas fa-signature"></i> Prénom:</span> <?php echo $row['name']; ?>
					</div>
					<div class="col-md-4">
						<span><i class="fas fa-envelope"></i> Email:</span> <?php echo $row['email']; ?>
					</div>
					<div class="col-md-4">
						<span><i class="fas fa-calendar-alt"></i> Inscription:</span> <?php echo $row['joindate']; ?>
					</div>
					<div class="col-md-4">
						<span><i class="fas fa-home"></i> Adresse:</span> <?php if(!empty($row['adresse'])) { echo $row['adresse'] . ', ' . $row['postal'] . ' ' . $row['city']; } else { echo 'Aucune adresse en base de donnée, enregistrez votre adresse <a href="settings">ici</a>.'; } ?>
					</div>
					<div class="col-md-4">
						<span><i class="fas fa-phone"></i> Téléphone:</span> <?php if(!empty($row['phone'])) { echo $row['phone']; } else { echo 'Aucun numéro de téléphone en base de donnée, enregistrez votre numéro de téléphone <a href="settings">ici</a>.'; } ?>
					</div>	
				</div>
			</div>
		</section>
	</section>
	<?php require 'inc/footer.php'; ?>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>