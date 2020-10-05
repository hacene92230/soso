<?php
	session_start();
	require 'inc/bd.php';
	$userid = $_SESSION['userid'];
	$result = $bdd->query('SELECT * FROM account WHERE id = ' . $userid . '');
	$row = $result->fetch();
	$userlevel = $row['level'];
	if($userlevel < "2") {
		header('Location: index');
	}
		$id = $_GET['id'];
		if(!empty($id))
		{
			$result = $bdd->query('DELETE FROM demandeprestataire WHERE id = '. $id);
			header('Location: dprestataire');
		}
?>