<?php
    require_once('nav.php');
    $Student= $this->StudentsDAO->SearchStudentByEmail($_SESSION['loggedUser']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
  <div class="ctn-welcome">
 
  <img src="" alt="" class="logo-welcome">
  <h1 class="title-welcome">Bienvenido <strong><?php echo $Student->getFirstName();?></strong> a la Bolsa de Trabajo de la UTN</h1>
  </div>
</body>
</html>