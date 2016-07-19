<?php // upload.php
  require_once 'login.php';


  if (isset($_POST['name'])) $name = $_POST['name'];
  elseif (isset($_POST['name'])== '') {
    $name = "(Not entered)";
    require_once 'login.php';
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);
$query = "UPDATE cats SET name='Charlie' WHERE name='Charly'"; $result = $conn->query($query);
if (!$result) die ("Database access failed: " . $conn->error);
  }
  else $name = "(Not entered)";
echo <<<_END
  <html>
    <head>
      <title>Form Test</title>
      <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css"/>
    </head>
    <body>
      Your name is: $name<br>
      <form method="post" action="examples.php">
        <p>What is your <b>first</b> name?<input type="text" name="first_name"></p>
        <p>What is your <b>last</b> name?<input type="text" name="last_name"></p>
        <p>What is your <b>email</b>?<input type="text" name="email"></p>
        <input type="submit">
      </form>
      <script src="bootstrap/bootstrap.js">
    </body>
  </html>
_END;


?>