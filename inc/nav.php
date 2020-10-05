<?php
session_start();
require 'inc/bd.php';
if(!empty($_SESSION['name'])) {
$userid = $_SESSION['userid'];
$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
$row = $result->fetch();
$userlevel = $row['level'];
}
?>
<nav id="navbar" class="navbar fixed-top navbar-expand-lg navbar-dark">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarText">
			<ul class="navbar-nav mr-auto">
				<?php if(!empty($_SESSION['name'])) { ?>
					<li class="nav-item">
						<div class="dropdown">
						  <button class="btn btn-info dropdown-toggle customdropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    <?php echo $_SESSION['name']; ?>
						  </button>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						  	<a class="dropdown-item" href="profil"><i class="fas fa-user"></i> Mon profil</a>
						    <a class="dropdown-item" href="settings"><i class="fas fa-user-cog"></i> Paramètres du compte</a>
						    <a class="dropdown-item" href="edit"><i class="fas fa-user-edit"></i> Editer mon profil</a>
						    <a class="dropdown-item" href="prestation"><i class="fas fa-clipboard-list"></i> Réserver une prestation</a>
						    <?php if($userlevel >= "1") { ?>
						    <a class="dropdown-item" href="prestataire"><i class="fas fa-user-plus"></i> On recrute</a>
						    <?php
							}
							if($userlevel > "1") {
							?>
							<a class="dropdown-item" href="dprestataire"><i class="fas fa-eye"></i> Qui postule ?</a>
							<?php }
							if($userlevel >= "1") { ?>
							<a class="dropdown-item" href="dprestation"><i class="fas fa-eye"></i> Prestations disponible</a>
							<?php } ?>
							<a class="dropdown-item" href="mesprestations"><i class="fas fa-eye"></i> Mes prestations</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item" href="logout"><i class="fas fa-sign-out-alt"></i> Déconexion</a>
						  </div>
						</div>
					</li>
				<?php } ?>
				<li class="nav-item">
					<a class="nav-link" href="index">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about">A propos</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about">Actualités</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="about">Réseaux sociaux</a>
				</li>
				<!--<li class="nav-item">
					<a class="nav-link" href="rules">Règlement</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="contact">Contact</a>
				</li>-->
			</ul>
			<ul class="navbar-nav ml-auto">
				<?php if(empty($_SESSION['name'])) { ?>
					<li class="nav-item">
						<a class="nav-link" href="signup">Inscription</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="login">Connexion</a>
					</li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>