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
	if($userlevel < "2") {
		header('Location: index');
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
		table {
			width: 100%;
			color: black;
			text-align: center;
		}

		thead {
			background: #4bd1bf;
		}

		th {
			padding: 5px;
		}

		tbody tr:nth-child(2n) {
		  background-color: rgb(200,200,200);
		  color: black;
		}
	</style>
</head>
<body>
	<?php require 'inc/nav.php'; ?>
	<section class="sectiontext container">
		<h1 style="text-transform: none;">Les demandes en cours</h1>
		<section class="profil">
				<p class="error"><?php if($error) { echo $error; } ?></p>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Status</th>
							<th>Adresse email</th>
							<th>Voir</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$result3 = $bdd->query('SELECT * FROM demandeprestataire WHERE status = "En attente" ORDER BY id ASC');
					        while ($row3 = $result3->fetch())
					        {
					        	$id = $row3['id'];
					        	$status = $row3['status'];
					        	$email = $row3['email'];
						?>
						<tr>
							<th><?= $id ?></th>
							<th><?= $status ?></th>
							<th><?= $email ?></th>
							<?php if($status != "Acceptée") { ?>
							<th><a href='editdemande?id=<?=$id?>'><i class="fas fa-eye"></i></a></th>
							<th><a href='deletedemande?id=<?=$id?>'><i class="fas fa-times-circle"></i></th>
							<?php } else { ?>
							<th>---</th>
							<th><a href='deletedemande?id=<?=$id?>'><i class="fas fa-times-circle"></i></th>
							<?php } ?>
						</tr>
						<?php
						 	} 
						?>
					</tbody>
				</table>
				<h2>Les demandes acceptées</h2>
				<table>
					<thead>
						<tr>
							<th>ID</th>
							<th>Status</th>
							<th>Adresse email</th>
							<th>Voir</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$result3 = $bdd->query('SELECT * FROM demandeprestataire WHERE status = "Acceptée" ORDER BY id ASC');
					        while ($row3 = $result3->fetch())
					        {
					        	$id = $row3['id'];
					        	$status = $row3['status'];
					        	$email = $row3['email'];
						?>
						<tr>
							<th><?= $id ?></th>
							<th><?= $status ?></th>
							<th><?= $email ?></th>
							<?php if($status != "Acceptée") { ?>
							<th><a href='editdemande?id=<?=$id?>'><i class="fas fa-eye"></i></a></th>
							<th><a href='deletedemande?id=<?=$id?>'><i class="fas fa-times-circle"></i></th>
							<?php } else { ?>
							<th>---</th>
							<th><a href='deletedemande?id=<?=$id?>'><i class="fas fa-times-circle"></i></th>
							<?php } ?>
						</tr>
						<?php
						 	} 
						?>
					</tbody>
				</table>
		</section>
	</section>
<script type="text/javascript" src="js/others.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>