<?php // upload.php
  require_once 'login.php';
  
  function mysql_fix_string($conn, $string)
  {
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return $conn->real_escape_string($string);
  }
  
  $conn = new mysqli($hn, $un, $pw, $db);
  if ($conn->connect_error) die($conn->connect_error);

  if (isset($_POST['first_name'])&&
      isset($_POST['last_name'])&&
      isset($_POST['email'])
    ) 
  {
    
    $first_name_sanitized  = mysql_fix_string($conn, $_POST['first_name']);
    $last_name_sanitized  = mysql_fix_string($conn, $_POST['last_name']);
    $email_sanitized = mysql_fix_string($conn, $_POST['email']);
    
    $query = "INSERT INTO emails VALUES ('$first_name_sanitized','$last_name_sanitized','$email_sanitized')";

    $result = $conn->query($query);
    if (!$result) die ("Database access failed: " . $conn->error);
  }

echo <<<_END
  <html>
    <head>
      <title>Form Test</title>
      <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.css"/>
    </head>
    <body>

      <p>Your name is: $first_name $last_name and your email is $email</p>

      <form method="post" action="index.php">
        <p>What is your <b>first</b> name?<input type="text" name="first_name"></p>
        <p>What is your <b>last</b> name?<input type="text" name="last_name"></p>
        <p>What is your <b>email</b>?<input type="text" name="email"></p>
        <input type="submit" id="submitButton">
      </form>

      <script src="bootstrap/bootstrap.js">

      <script
        src="https://code.jquery.com/jquery-3.1.0.min.js"
        integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="
        crossorigin="anonymous">
      </script>


      <script>
        $("#submitButton").click( function( event ){
            event.preventDefault();
        });
      </script>
    </body>
  </html>
_END;

?>