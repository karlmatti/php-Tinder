<?php
  require 'includes/db.php';
  require 'includes/auth.php';
  require 'includes/utils.php';
  require 'menu.php';

  $isLoggedIn = isLoggedIn();
  if ($isLoggedIn == 1) {
    logOut();
  }
  $errors = [];
  $name = post('name'); // Nime turvaline post
  $email = post('email'); // Emaili turvaline post

  $errors = [];
  if (isset($_POST['op'])) {
    $password = post('password');
    $passwordCheck = post('passwordCheck');
    if ($password != $passwordCheck) { // Kas paroolid ühtivad?
      $errors[] = 'Paroolid ei ühti!';
    } else {


      //TODO: pildi upload
      //TODO: vaata et kasutaja ei oleks juba olemas
      list($uploadOk, $saved_file) = upload_photo($email);

      if ($uploadOk == 1) { // Kas saab faili üles laadida?
        


        $description = post('description'); // Kirjelduse turvaline post

        $gender = post('gender');
        if ( $gender == "male" ) { // Soo määramine
          $gender = 1;
        } else {
          $gender = 0;
        }


        $query = 'INSERT INTO kamatt_users (name, email, password, gender, description, photo) 
        VALUES("%s", "%s", "%s", "%s", "%s", "%s")';
        $query = sprintf($query, $name, $email, md5($password), $gender, $description, $saved_file);
        
        if (false == mysqli_query($db, $query)) { // Kas saab päringu ära teha?
          die( mysqli_error($db) );

        } else {
          
          echo "Registreerimine õnnestus!";
          //header('Location: index.php');
        }


      
      } else {
        
        $errors[] = 'Lae parem pilt üles!';
      }
    } 
  }

$isLoggedIn = isLoggedIn();
?>
<!doctype html>
<html>
  <head>
  	<meta charset="utf-8">
  	<title>Mini Tinder</title>
  	<link rel="stylesheet" type="text/css" href="/assets/tinder.css">
  </head>
  <body>
  	<h1>Registreerimine</h1>
    <?php 
    if ($errors) { 
    ?>

    <div style="color: red;">Viga registreerimisel: <?php print_r($errors[0]); ?> </div>
    <?php 
    } 
    ?>

  	<form method="post" enctype="multipart/form-data">

      <input type="hidden" name="op" value="register">
      
      <label>Nimi</label>
      <input type="text" name="name" value="<?php echo $name; ?>" required="required" >
      <br><br>

      <label>E-mail</label>
      <input type="email" name="email" value="<?php echo $email; ?>" required="required">
      <br><br>

      <label>Parool</label>
      <input type="password" name="password" required="required">
      <br><br>

      <label>Parool uuesti</label>
      <input type="password" name="passwordCheck" required="required">
      <br><br>

      <label>Foto</label>
      <input type="file" name="photo" id="photo">
      <br><br>

      <label>Naine</label>
      <input type="radio" name="gender" value="female">
      <label>Mees</label>
      <input type="radio" name="gender" value="male" checked>
      <br><br>

      <label>Kirjeldus</label>
      <textarea name="description" rows="5" cols="40"  value="<?php echo $description; ?>"></textarea>
      <br><br>


      <button name="register" type="submit">Registreeri</button>
    </form>
  </body>
</html>


