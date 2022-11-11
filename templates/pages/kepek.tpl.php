<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="./styles/style.css">
</head>
<body>
<form method="post" enctype="multipart/form-data">
  <label>Válasszon képet a feltöltésre:</label>
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Feltöltés" name="submit">
</form>

</body>
</html>

<style type="text/css">
        /* (A) GALLERY WRAPPER */
/* (A1) BIG SCREENS - 3 IMAGES PER ROW */
.gallery {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    grid-gap: 10px;
    max-width: 1200px;
    margin: 0 auto; /* horizontal center */
}

/* (A2) SMALL SCREENS - 2 IMAGES PER ROW */
@media screen and (max-width: 640px) {
    .gallery {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* (B) THUMBNAILS */
.gallery img {
    width: 100%;
    height: 200px;
    object-fit: cover; /* fill | contain | cover | scale-down */
    border: 1px solid #cdcdcd;
    cursor: pointer;
}

    /* (C) FULLSCREEN IMAGE */
    .gallery img.full {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999;
        width: 100vw;
        height: 100vh;
        object-fit: contain; /* fill | contain | cover | scale-down */
        border: 0;
        background: #fff;
    }

/* (D) OPTIONAL ANIMATION *
.gallery { overflow-x: hidden; }
.gallery img { transition: all 0.3s; } */

    </style>
<?php
$images = glob("images/*.{jpg,jpeg,gif,png,bmp,webp}", GLOB_BRACE);
foreach ($images as $i) { echo "<img src='images/". rawurlencode(basename($i)) ."' class='gallery'>"; }
?>
<script>
window.addEventListener("DOMContentLoaded", () => {
  // (A) GET ALL IMAGES
  var all = document.querySelectorAll(".gallery img");
  
  // (B) CLICK ON IMAGE TO TOGGLE FULLSCREEN
  if (all.length>0) { for (let img of all) {
    img.onclick = () => { img.classList.toggle("full"); };
  }}
});
</script>
<?php
/*session_start();*/

if($_SERVER['REQUEST_METHOD']=="POST")
{
if(!isset($_SESSION['login'])){
   exit("A funkció csak bejelentkezés után elérhető");
}
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    //echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "A feltöltendő fájl nem kép\n";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "A fájl már létezik\n";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "A fájl mérete túl nagy\n";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Csak JPG, JPEG, PNG és GIF formátumok engedélyezettek\n";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "A feltöltés nem sikerült";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "A fájl ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " sikeresen feltöltve";
    header("Refresh:0");
  } else {
    echo "Nem sikerült a feltöltés";
  }
}
}
?>