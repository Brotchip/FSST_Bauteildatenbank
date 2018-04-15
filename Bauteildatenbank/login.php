<?php
session_start();
// remove all session variables
session_unset();
?>
<html lang="en" >

<head>
	<meta charset="UTF-8">
	<title>Login Bauteildatenbank</title>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />
</head>

<body>
	<div class="wrapper">
		<h1  style="font-size:500%;">Bauteildatenbank</h1>
		<form class="login" method="POST">
			<p class="title">Log in</p>
			<input type="text" placeholder="MitarbeiterNr" name="benutzername" id="benutzername" autofocus required />
			<i class="fa fa-user"></i>
			<input type="password" placeholder="Kennwort" name="kennwort" id="kennwort" required />
			<i class="fa fa-key"></i>
			<a href="./registration.php" >Registration</a>
			<button type="submit"  name="submit">
				<i class="spinner"></i>
				<span class="state">Log in</span>
			</button>
		</form>
	</p>
</div>
<?php
if((isset($_POST['benutzername'])) and (isset($_POST['kennwort']))) {

	$benutzername = $_POST['benutzername'];
	$kennwort = $_POST['kennwort'];

	require('config.php');

	$query = "SELECT * FROM `mitarbeiter` WHERE MitarbeiterNr='$benutzername' and Kennwort='$kennwort'";
	$result = mysqli_query ($conn,$query);
	$count = mysqli_num_rows($result);
	if ($count == 1) {	//echo "Du bist nun eingeloggt";
		$query = "SELECT Abteilung FROM `mitarbeiter` WHERE MitarbeiterNr='$benutzername' and Kennwort='$kennwort' and Abteilung='IT'";
		$result = mysqli_query ($conn,$query);
		$count = mysqli_num_rows($result);
		$_SESSION["MitarbeiterNr"] = $benutzername;
		if ($count == 1) {
			$_SESSION["priority"] = "admin";
			header("Location: ./mitarbeiter.php");
		} else {
			$_SESSION["priority"] = "user";
			header("Location: ./table.php");
		}
	} else {	//echo "Falscher Benutzername/Kennwort";
		?>
		<script>
		alert("MitarbeiterNr oder Passwort ist falsch!");
		</script>
		<?php
	}
	mysqli_close($conn);
}

?>
</body>
</html>
