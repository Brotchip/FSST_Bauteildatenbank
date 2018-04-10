<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Registration Bauteildatenbank</title>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" type="text/css" href="style/style.css" title="style" />

	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>

<body>
  <div class="wrapper">
    <h1  style="font-size:500%;">Bauteildatenbank</h1>
    <form class="login" method="POST">
      <p class="title">Registration</p>
      <input type="text" placeholder="MitarbeiterNr" name="MitarbeiterNr" id="MitarbeiterNr" autofocus>Text</ />
      <i class="fa fa-user"></i>
      <input type="text" placeholder="Vorname" name="Vorname" id="Vorname" autofocus required />
      <i class="fa fa-user"></i>
      <input type="text" placeholder="Nachname" name="Nachname" id="Nachname" autofocus required />
      <i class="fa fa-user"></i>
      <input type="text" placeholder="Abteilung" name="Abteilung" id="Abteilung" autofocus required />
      <i class="fa fa-user"></i>
      <input type="password" placeholder="Kennwort" name="kennwort" id="kennwort" required />
      <i class="fa fa-key"></i>
      <!--<a href="#" onclick="alert('Söba schuid')"; return false; >Login</a> -->
      <button type="submit"  name="submit">
        <i class="spinner"></i>
        <span class="state">Register</span>
      </button>
    </form>
    <!--<footer><a target="blank" href="http://boudra.me/">boudra.me</a></footer> -->
  </p>
</div>
<?php

/*<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

<script  src="js/index.js"></script>*/


if((isset($_POST['MitarbeiterNr'])) and (isset($_POST['Vorname'])) and (isset($_POST['Nachname'])) and (isset($_POST['Abteilung'])) and (isset($_POST['kennwort']))) {

  $MitarbeiterNr = $_POST['MitarbeiterNr'];
  $Vorname = $_POST['Vorname'];
  $Nachname = $_POST['Nachname'];
  $Abteilung = $_POST['Abteilung'];
  $kennwort = $_POST['kennwort'];

  require('config.php');

  //mysql_select_db("test",[$conn]);

  $query = "INSERT INTO `mitarbeiter`
  (`MitarbeiterNr`, `Vorname`, `Nachname`, `Abteilung`, `kennwort`)
  VALUES ('$MitarbeiterNr', '$Vorname', '$Nachname', '$Abteilung', '$kennwort')";
  $result = mysqli_query ($conn,$query);
  mysqli_close($conn);
  header("Location: ./login.php");
}

?>
</body>
</html>
