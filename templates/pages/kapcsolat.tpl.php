<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Kapcsolat</title>
</head>
<body>
<form action = "?oldal=adatok" method = "post" name="kapcsolat" onsubmit="return validateForm()">
<h1>E-mail küldés:</h1><br>
<label>Címzett:</label><br>
<input type="text" name="cimzett" value="iroda@devaigyerekek.hu"><br>
<label>Tárgy:</label><br>
<input type="text" name="targy"><br>
<label>Szöveg:</label><br>
<textarea name="email" rows="4" cols="50"></textarea><br>
<input type="submit" value="Küldés"><br>
</form>
<script>
function validateForm() {
  let cimzett = document.forms["kapcsolat"]["cimzett"].value;
  var atposition=cimzett.indexOf("@");  
  var dotposition=cimzett.lastIndexOf(".");
  if (cimzett == "") {
    alert("A címzett nem lehet üres");
    return false;
  }
  else if(cimzett.length>30){  
  alert("A címzett nem lehet 30 karakternél hosszabb");  
  return false;  
  }
  else if(cimzett.length<5){  
  alert("A címzettnek minimum 5 karakternek kell lennie");  
  return false;  
  } 
  else if (atposition<1 || dotposition<atposition+2 || dotposition+2>=cimzett.length){  
  alert("Kérjük adjon meg egy helyes e-mail címet");  
  return false;  
  }  
  
  let targy = document.forms["kapcsolat"]["targy"].value;
  if (targy == "") {
    alert("A tárgy nem lehet üres");
    return false;
  }
  else if(targy.length>50){  
  alert("A tárgy nem lehet hosszabb 50 karakternél");  
  return false;  
  }
  else if(targy.length<5){  
  alert("A tárgynak minimum 5 karakternek kell lennie");  
  return false;  
  }
  let email = document.forms["kapcsolat"]["email"].value;
  if (email == "") {
    alert("Az email nem lehet üres");
    return false;
  }
  else if(email.length>1000){  
  alert("Az email nem lehet hosszabb 1000 karakternél");  
  return false;  
  }  
}
</script>
</body>
</html>