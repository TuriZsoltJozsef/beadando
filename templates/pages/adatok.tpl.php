<!DOCTYPE html>
<html>
<head>
    <title>E-mail</title>
    <meta charset="utf-8">
</head>
<body>
<?php
    if(isset($_POST['cimzett']) && isset($_POST['targy']) && isset($_POST['email'])) {
        try {
            // Kapcsolódás
            
            $dbh = new PDO('mysql:host=localhost;dbname=gyakorlat7', 'root', '',
                            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
            
            // Létezik már a felhasználói név?
            $sqlCreate = "CREATE TABLE IF NOT EXISTS `email` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `cimzett` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `targy` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , `email` TEXT CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
            $dbh->exec($sqlCreate);


            /*if($row = $sth->fetch(PDO::FETCH_ASSOC)) {
                $uzenet = "A felhasználói név már foglalt!";
                $ujra = "true";
            }*/
            /*else {*/
                // Ha nem létezik, akkor regisztráljuk
                $sqlInsert = "insert into email(id, cimzett, targy, email)
                          values(NULL, :cimzett, :targy, :email)";
                $stmt = $dbh->prepare($sqlInsert); 
                $stmt->execute(array(':cimzett' => $_POST['cimzett'], ':targy' => $_POST['targy'],
                                 ':email' => $_POST['email']));
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