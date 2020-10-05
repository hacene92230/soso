<?php
	session_start();
	$userid = $_SESSION['userid'];
	if(empty($userid)) {
		header('Location: index');
	}

    require 'inc/bd.php';
    if(isset($_POST['image'])) {
	$file = $_FILES['fichier'];
	$filetmp = $file['tmp_name'];
	$target_file = basename($_FILES["fichier"]["name"]);
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	echo $imageFileType;
	$filename = "rci". $userid . "." . $imageFileType;
	$filestore = "upload/".$filename;
        move_uploaded_file($filetmp, $filestore);
        print_r($file);
    }
?>

<form action="?" method="post" enctype="multipart/form-data">
	<label>Recto carte d'identitée (png ou jpeg):</label><input type="file" name="fichier">
	<input type="submit" name="image" value="Faire ma demande">
</form>

