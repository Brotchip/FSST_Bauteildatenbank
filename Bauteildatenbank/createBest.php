<?php
	/* if((isset($_POST["ArtNr"])) AND (isset($_POST["Stueck"])))
	{ */
		/* $ArtNr = $_POST["ArtNr"];
		$Stueck = $_POST["Stueck"]; */
		
		$ArtNr = 1;
		$Stueck = 2;
		
		require('config.php');
		
		$result = mysqli_query($conn,"select Bauteilbezeichnung,Stueckzahl,Preis from Bauteile where ArtNr='$ArtNr'");
		$row = mysqli_fetch_array( $result );
		$Bauteilbez = $row["Bauteilbezeichnung"];
		$Stueckdb = $row["Stueckzahl"];
		$BestPreis = $row["Preis"];
		
		$BestPreis = $BestPreis * $Stueck;
		
		$Stueckdb = $Stueckdb - $Stueck;
		$result = mysqli_query($conn,"UPDATE `Bauteile` SET Stueckzahl='$Stueckdb' WHERE ArtNr='$ArtNr'");
		
		$Status = "Pending";
		
		$MitarbeiterNr = 1234; //$_SESSION["MitarbeiterNr"];
		$result = mysqli_query($conn,"select MitarbeiterNr,Nachname from Mitarbeiter where MitarbeiterNr='$MitarbeiterNr'");
		$row = mysqli_fetch_array( $result );
		$Nachname = $row["Nachname"];
		
		echo "$ArtNr, $Bauteilbez, $Status, $MitarbeiterNr, $Nachname, $BestPreis, $MitarbeiterNr";
		
		$query = "INSERT INTO 'Bestellungen'
	  ('ArtNr', 'Bauteilbezeichnung', 'Status', 'Stueck', 'MitarbeiterNr', 'Nachname', 'GesamtPreis', 'MitarbeiterNr')
	  VALUES (1, 1, 1, 1, 1, 1, 1, 1)";
	  $result = mysqli_query ($conn,$query);
	  var_dump($result);
	  mysqli_close($conn);
	//}
?>
