<?php
session_start();
if(!(isset($_SESSION['priority'])))
{
	header("Location: ./login.php");
}
else  if ($_SESSION["priority"] != "admin")
{
	header("Location: ./table.php");
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
						<li><a href="mitarbeiter.php">Mitarbeiter</a></li>
						<li><a href="table.php">Bauteile</a></li>
						<li class="selected"><a href="Bestellung.php">Bestellungen</a></li>
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
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE MitarbeiterNr='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY MitarbeiterNr");
							}
							break;
							case 2:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE Vorname='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Vorname");
							}
							break;
							case 3:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE Nachname='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Nachname");
							}
							break;
							case 4:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE Abteilung='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Abteilung");
							}
							break;
							default:
							if($suche!="")
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE MitarbeiterNr='$suche' OR Vorname='$suche' OR Nachname='$suche' OR Abteilung='$suche'");
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`");
							}

						}
					}
					else
					{
						$results = mysqli_query ($conn,"SELECT c.BestellNr, b.ArtNr, b.Bauteilbezeichnung, c.Stueck, a.MitarbeiterNr, a.Nachname, b.Preis  FROM  mitarbeiter a, Bauteile b, bestellungen c WHERE c.ArtNr = b.ArtNr AND c.MitarbeiterNr = a.MitarbeiterNr;");
					}
					?>
						<form method="POST">
							<h1>Sortieren nach....
								<br>
								<select id="id" name="sort">
									<option value="0">Spalten...</option>
									<option value="1">MitarbeiterNr</option>
									<option value="2">Vorname</option>
									<option value="3">Nachname</option>
									<option value="4">Abteilung</option>
								</select>
								<input class="search" type="text" name="suchbegriff" placeholder="Suchbegriff eingeben..." />
							</h1>
							<p class="form_settings" style="padding-top: 15px">
								<span>&nbsp;</span>
								<input class="submit" type="submit" name="name" value="button" />
							</p>
						</form>
						<table class="table-fill">
							<thead>
								<tr>
									<th class="text-left">BestellNr</th>
									<th class="text-left">ArtNr</th>
									<th class="text-left">Bauteilbezeichnung</th>
									<th class="text-left">Stueck</th>
									<th class="text-left">MitarbeiterNr</th>
									<th class="text-left">Nachname</th>
									<th class="text-left">GesamtPreis</th>
								</tr>
							</thead>
							<tbody class="table-hover">
								<?php
								while ( $row = mysqli_fetch_array ( $results )) {
									?>
									<tr>
										<td class="text-left"><?php echo $row["BestellNr"] ?></td>
										<td class="text-left"><?php echo $row["ArtNr"] ?></td>
										<td class="text-left"><?php echo $row["Bauteilbezeichnung"] ?></td>
										<td class="text-left"><?php echo $row["Stueck"] ?></td>
										<td class="text-left"><?php echo $row["MitarbeiterNr"] ?></td>
										<td class="text-left"><?php echo $row["Nachname"] ?></td>
										<td class="text-left"><?php echo ($row["Preis"]*$row["Stueck"]) ?></td>
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
