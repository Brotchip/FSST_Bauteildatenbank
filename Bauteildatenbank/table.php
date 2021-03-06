<?php
session_start();
if(!(isset($_SESSION['priority'])))
{
	header("Location: ./login.php");
}
else
{
	?>
	<html>

	<head>
		<title>Bauteildatenbank</title>
		<meta name="description" content="website description" />
		<meta name="keywords" content="website keywords, website keywords" />
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
	</head>

	<body>
		<div id="main">
			<div id="header">
				<div id="logo">
					<div id="logo_text">
						<!-- class="logo_colour", allows you to change the colour of the text -->
						<h1><span class="logo_colour">Bauteildatenbank</span></a></h1>
						<h2>Afoch nua leiwond!</h2>
					</div>
				</div>
				<div id="menubar">
					<ul id="menu">
						<!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
						<?php
						if ($_SESSION["priority"] == "admin")
						{
							?> <li><a href="mitarbeiter.php">Mitarbeiter</a></li> <?php
						}
						?>
						<li class="selected"><a href="table.php">Bauteile</a></li>
						<li></li>
						<?php
						if ($_SESSION["priority"] == "admin")
						{
							?> <li><a href="Bestellung.php">Bestellungen</a></li><?php

						}
						?>

					</ul>
				</div>
			</div>
			<div id="site_content">
				<div id="content">
					<?php

					require('config.php');
					if(isset($_POST['sort']))
					{
						$sort = $_POST['sort'];
						$suche = $_POST['suchbegriff'];
						switch($sort) {
							case 1:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE ArtNr='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY ArtNr");
							}
							break;
							case 2:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Hauptgruppe='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Hauptgruppe");
							}
							break;
							case 3:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Nebengruppe='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Nebengruppe");
							}
							break;
							case 4:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Bauteilbezeichnung='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Bauteilbezeichnung");
							}
							break;
							case 5:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Stueckzahl='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Stueckzahl");
							}
							break;
							case 6:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Preis='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Preis");
							}
							break;
							case 7:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE Hersteller='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile` ORDER BY Hersteller");
							}
							break;
							default:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`WHERE MitarbeiterNr='$suche' OR Vorname='$suche' OR Nachname='$suche' OR Abteilung='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`");
							}

						}
					}
					else
					{
						$results = mysqli_query ($conn,"SELECT * FROM `bauteile`");
					}
					?>

					<form method="POST">
						<h1>Sortieren nach....
							<br>
							<select id="id" name="sort">
								<option value="0">Spalten...</option>
								<option value="1">ArtNr</option>
								<option value="2">Hauptgruppe</option>
								<option value="3">Nebengruppe</option>
								<option value="4">Bauteilbezeichnung</option>
								<option value="5">Stueckzahl</option>
								<option value="6">Preis</option>
								<option value="7">Hersteller</option>
							</select>
							<input class="search" type="text" name="suchbegriff" placeholder="Suchbegriff eingeben..." /></li>
						</h1>

						<p class="form_settings" style="padding-top: 15px">
							<input class="submit" type="submit" name="name" value="Sortieren" />
						</p>

					</form>
					<form method="POST" action="createBest.php">
						<tr>
							<td>ArtNr:</td>
						</tr>
						<tr>
							<td>Stueck:</td>
						</tr>
						<tr>
							<td><input type="text" name="ArtNr" value="" /></td>
						</tr>
						<tr>
							<td><input type="text" name="Stueck" value="" /></td>
						</tr>
						<p class="form_settings" style="padding-top: 15px">
							<input class="submit" type="submit" name="name" value="Bestellen" />
						</p>
					</form>
					<table class="table-fill">
						<thead>
							<tr>
								<th class="text-left">ArtNr</th>
								<th class="text-left">Hauptgruppe</th>
								<th class="text-left">Nebengruppe</th>
								<th class="text-left">Bauteilbezeichnung</th>
								<th class="text-left">Wert</th>
								<th class="text-left">Stueckzahl</th>
								<th class="text-left">Preis</th>
								<th class="text-left">Hersteller</th>
							</tr>
						</thead>
						<tbody class="table-hover">
							<?php
							while ( $row = mysqli_fetch_array ( $results )) {
								?>
								<tr>
									<td class="text-left"><?php echo $row["ArtNr"] ?></td>
									<td class="text-left"><?php echo $row["Hauptgruppe"] ?></td>
									<td class="text-left"><?php echo $row["Nebengruppe"] ?></td>
									<td class="text-left"><?php echo $row["Bauteilbezeichnung"] ?></td>
									<td class="text-left"><?php echo $row["Wert"] ?></td>
									<td class="text-left"><?php echo $row["Stueckzahl"] ?></td>
									<td class="text-left"><?php echo $row["Preis"] ?></td>
									<td class="text-left"><?php echo $row["Hersteller"] ?></td>
								</tr>
								<?php
							}
							mysqli_close($conn);
							?>
						</tbody>
					</table>
				</body>
				</html>
				<?php
			}
			?>
