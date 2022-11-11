<!DOCTYPE html>
<html>
<head>
    <title>E-mail</title>
    <meta charset="utf-8">
</head>
<body>
<?php
   if ($_SERVER['REQUEST_METHOD'] == 'POST'){
   
	$re = '/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/'; 
	if(!isset($_POST['cimzett']) || !preg_match($re,$_POST['cimzett']) || strlen($_POST['cimzett']) < 5 || strlen($_POST['cimzett']) > 30)
	{
		exit("Hibás email cím: ".$_POST['cimzett']);
	}

	if(!isset($_POST['targy']) || strlen($_POST['targy']) < 5 || strlen($_POST['targy']) > 50)
	{
		exit("Hibás tárgy: ".$_POST['targy']);
	}
	if(!isset($_POST['email']) || empty($_POST['email']) || strlen($_POST['email']) > 1000)
	{
		exit("Hibás email: ".$_POST['email']);
	}
	}
    else{
    header("location: ?oldal=kapcsolat");
    }
  ?>
<?php
    if(isset($_POST['cimzett']) && isset($_POST['targy']) && isset($_POST['email'])) {
        try {
       
       if(!isset($_SESSION['login'])){
       $_POST['kikuldte']="Vendég";
       }
       else{
       $_POST['kikuldte']=$_SESSION['login'];
       }
       $_POST['kuldesideje']= date("Y-m-d H:i:s");
            // Kapcsolódás
            
            $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            
            // Létezik már a felhasználói név?
            //$sqlCreate = "CREATE TABLE IF NOT EXISTS `email` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `cimzett` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `targy` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `email` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
            $sqlCreate="CREATE TABLE IF NOT EXISTS `email2` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `cimzett` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `targy` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `email` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `kuldesideje` DATETIME NOT NULL , `kikuldte` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";

            $dbh->exec($sqlCreate);

        
            /*if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $uzenet = "A felhasználói név már foglalt!";
                $ujra = "true";
            }*/
            /*else {*/
                // Ha nem létezik, akkor regisztráljuk
                $sqlInsert = "insert into email2(id, cimzett, targy, email, kuldesideje, kikuldte)
                          values(NULL, :cimzett, :targy, :email, :kuldesideje, :kikuldte)";
                $stmt = $dbh->prepare($sqlInsert); 
                $stmt->execute(array(':cimzett' => $_POST['cimzett'], ':targy' => $_POST['targy'],
                                 ':email' => $_POST['email'], ':kuldesideje' => $_POST['kuldesideje'], ':kikuldte' => $_POST['kikuldte']));
                if($count = $stmt->rowCount()) {
                    $newid = $dbh->lastInsertId();
                    $uzenet = "A regisztrációja sikeres.<br>Azonosítója: {$newid}";                     
                    $ujra = false;
                }
                else {
                    $uzenet = "A regisztráció nem sikerült.";
                    $ujra = true;
                }
                $dbh;
            /*}*/
        }
        catch (PDOException $e) {
            echo "Hiba: ".$e->getMessage();
        }      
    }

?>


	<?php
		echo "Címzett: ".$_POST["cimzett"]."<br>";
		echo "Tárgy: ".$_POST["targy"]."<br>";
		echo "E-mail: ".$_POST["email"]."<br>";
	?>
    
</body>
</html>