<?php
	session_start();
	if((isset($_POST["ArtNr"])) AND (isset($_POST["Stueck"])))
	{
		$ArtNr = $_POST["ArtNr"];
		$Stueck = $_POST["Stueck"];
		
		require('config.php');
		
		$result = mysqli_query($conn,"select Stueckzahl from Bauteile where ArtNr='$ArtNr'");
		$row = mysqli_fetch_array( $result );
		$Stueckdb = $row["Stueckzahl"];
		
		$Stueckdb = $Stueckdb - $Stueck;
		$result = mysqli_query($conn,"UPDATE `Bauteile` SET Stueckzahl='$Stueckdb' WHERE ArtNr='$ArtNr'");
		
	  $result = mysqli_query ($conn,"INSERT INTO Bestellungen (ArtNr, MitarbeiterNr, Stueck)  VALUES ('$ArtNr', '{$_SESSION["MitarbeiterNr"]}', '$Stueck')");
	  var_dump($result);
	  mysqli_close($conn);
	  header("Location: ./table.php");
	}
?>
