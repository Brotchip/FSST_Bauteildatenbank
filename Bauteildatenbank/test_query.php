<?php
	  require('config.php');
	  $result = mysqli_query ($conn,"INSERT INTO Bestellungen (ArtNr, Bauteilbezeichnung, Status, Stueck, MitarbeiterNr, Nachname, GesamtPreis) VALUES (1, '1', '1', 1, 1, '1', 1.0)");
	  var_dump($result);
	  mysqli_close($conn);
?>
