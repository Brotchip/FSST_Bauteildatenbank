<?php
session_start();
if(!(isset($_SESSION['priority'])))
{
	header("Location: ../login.php");
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
						<li><a href="index.php">Mitarbeiter</a></li>
						<li class="selected"><a href="table.php">Bauteile</a></li>
						<li><a href="Bestellung.php">A Page</a></li>
						</ul>
					</div>
				</div>
				<div id="site_content">
					<div id="content">
						<head>
							<meta charset="UTF-8">

							<link rel="stylesheet" href="css/style.css">

							<?php

							require('config.php');
							//$suche = $_POST['search_field'];
							//  $suche = $_POST['search_field'];

							if(isset($_POST['search_field']))
							{
								$suche = $_POST['search_field'];
								$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter`WHERE MitarbeiterNr='$suche' OR Vorname='$suche' OR Nachname='$suche' OR Abteilung='$suche'");
							}



							elseif(isset($_POST['Radio_but_sort']))
							{
								$Radio_but_sort = $_POST['Radio_but_sort'];
								switch($Radio_but_sort) {
									case 1:
									$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY MitarbeiterNr");
									break;
									case 2:
									$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Vorname");
									break;
									case 3:
									$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Nachname");
									break;
									case 4:
									$results = mysqli_query ($conn,"SELECT * FROM `mitarbeiter` ORDER BY Abteilung");
									break;
									default:
									$results = mysqli_query ($conn,"SELECT * FROM `bauteile`");
								}
							}
							else
							{
								$results = mysqli_query ($conn,"SELECT * FROM `bauteile`");
							}
							?>
						</head>
						<body>
							<html lang="en">
							<head>
								<meta charset="utf-8" />
								<title>Table Style</title>
								<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
							</head>
							<body>

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
										<input class="search" type="text" name="suchbegriff" placeholder="Suchbegriff eingeben..." /></li>
									</h1>
									<p class="form_settings" style="padding-top: 15px">
										<span>&nbsp;</span>
										<input class="submit" type="submit" name="name" value="Sortieren" />
									</p>
								</form>


								<table class="table-fill">
									<thead>
										<tr>
											<th class="text-left">ArtNr</th>
											<th class="text-left">Hauptgruppe</th>
											<th class="text-left">Nebengruppe</th>
											<th class="text-left">Bauteilbezeichung</th>
											<th class="text-left">Wert</th>
											<th class="text-left">Stueckzahl</th>
											<th class="text-left">Preis</th>
											<th class="text-left">LieferantenNr</th>
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
												<td class="text-left"><?php echo $row["Bauteilbezeichung"] ?></td>
												<td class="text-left"><?php echo $row["Wert"] ?></td>
												<td class="text-left"><?php echo $row["Stueckzahl"] ?></td>
												<td class="text-left"><?php echo $row["Preis"] ?></td>
												<td class="text-left"><?php echo $row["LieferantenNr"] ?></td>
												<td class="text-left"><?php echo $row["Hersteller"] ?></td>
											</tr>
											<?php
										}
										mysqli_close($conn);
										?>
									</tbody>
								</table>
							</body>

						</body>


					</body>
				</body>
				</html>
				<?php
			}
			?>
