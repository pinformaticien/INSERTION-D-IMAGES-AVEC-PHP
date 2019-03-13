<?php
  /*
  
  create database named photos 
  create table named images with :id - int(11), image - varchar(100), image_text - text
  
  */

?>


<?php
    
    $msg = "";

//if upload button is pressed
if (isset($_POST['upload'])) {
    // the path to store the uploaded image
    $target = "images/".basename($_FILES['image']['name']);

    // connect to the database
    $db = mysqli_connect("localhost", "root", "", "photos");

    //get all the submitted data from the form
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];

    $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$text')";
    mysqli_query($db, $sql); //stores the submitted data into the database table: images


    //now let's move the uploaded image into the folder: images 
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
      $msg = "Image uploaded successfully.";
    } else{
      $msg = "There was a problem uploading image.";
    }
}

?>










<!DOCTYPE html>
<html>
<head>
  <title>Upload an image into mysql database using php</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div id="content">
    <?php

      $db = mysqli_connect("localhost", "root", "", "photos");
      $sql = "SELECT * FROM images";
      $result = mysqli_query($db, $sql);

      while ($row = mysqli_fetch_array($result)) {
            
            echo "<div id='img_div'>";
                  echo "<img src='images/".$row['image']."'>";
                  echo "<p>".$row['image_text']."</p>";
            echo "</div>";

      }

    ?>



    <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="size" value="1000000">
      <div>
        <input type="file" name="image">
      </div>
      <div>
        <textarea name="text" cols="40" rows="4" placeholder="Say something about this image..."></textarea>
      </div>
      <div>
        <input type="submit" name="upload" value="Upload Image">
      </div>
    </form>
  </div>
</body>
</html>