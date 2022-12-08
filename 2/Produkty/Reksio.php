<?php $produktid=3;?><!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="../Pliki/style.css">
<title>My lashes</title>
</head>
<body>
<header>
	<div class="headerdiv boczki">	
	<p> </p>
	</div>
	<div class="headerdiv">		
		<div><a href="tel:+48123456789">+48 123 456 789</a></div>
		<div>Poniedziałek - Piątek </br> 8:00 - 16:00</div>
	</div>		
	<div class="headerdiv" id="logodiv">
		<div style="text-align:center;" id="logo">
		<h1><a href="index.php"><img style="width:50%;" src="../Pliki/logo.png" title="My lashes" alt="My lashes"/></a></h1>
		</div>
	</div>
	<div class="headerdiv ">
		<div>
		<a href="Koszyk/index.php">Twój koszyk</a>
		<p id="koszykliczba">Twój koszyk Jest pusty!</p>
		</div>
	</div>
	<div class="headerdiv boczki">	
	<p> </p>
	</div>	
</header>
<div id="menu">
     <ul>
		<li class="boczki"><a style="color:gray;"> a</a></li>
  		<li><h2><a onclick="linkfiltruj1()" >Trawy</a></h2></li>
		<li><h2><a onclick="linkfiltruj1()" >Krety</a></h2></li>
		<li><h2><a onclick="linkfiltruj1()" >Psy</a></h2></li>
		<li><h2><a onclick="linkfiltruj1()" >Promocje</a></h2></li>
		<li><h2><a onclick="linkfiltruj1()" >Pozostałe</a></h2></li>
		<li class="boczki"><h2><a style="color:gray;" > a</a></li>
  	</ul>
</div>
<main>
	<?php
	$link=mysqli_connect("localhost","root","","mylashes");
	$zapytanie=mysqli_query($link,"SELECT * FROM `produkty` WHERE produkty.id=$produktid;");
	$x=mysqli_fetch_array($zapytanie);
	$zapytanie3=mysqli_query($link,"SELECT produkty.nazwa,kategorie.nazwa FROM `kategorie` inner join produkty_kategorie on kategorie.id=produkty_kategorie.kategorieid inner join produkty on produkty.id=produkty_kategorie.produktyid where produkty.nazwa='${x[1]}';");
	$klasa=mysqli_fetch_array($zapytanie3)[1];
	if (file_exists('../Pliki/'.$x[1].'.png'))
		$obraz='../Pliki/'.$x[1].'.png';
	else
		$obraz='../Pliki/'.$x[1].'.jpg';
	?>
	<div class="sciezka"><p><a onclick="linkfiltruj1()">Sklep</a> - <a onclick="linkfiltruj1()"><?=$klasa?></a> - <a><?=$x[1]?></a></p></div>
	<h1 class="nazwa"><?=$x[1]?></h1>
	<div class="produktgowny">
	<div class="ppierwszy"><img style="width:100%;" src="<?=$obraz?>" alt="<?=$x[1]?>"></div>
	<div class="pdrugi">
				<span class="lewus">Dostępność:</span><span class="prawus"><?=$x[3]?></span>
				<span class="lewus">Wysyłka w:</span><span class="prawus"><?=$x[4]?></span>
				<span class="lewus">Dostawa:</span><span class="prawus"><?=$x[5]?></span>
				<span class="lewus"></span><span class="prawus"></span>
				<h2 class="cena"><?=$x[2]?> zł</h2>
				<span class="lewus"></span><span class="prawus"></span>
				<span class="lewus"><input class="produktilosc" type="number" value="1"> szt.</span><button class="prawus" onclick="koszykDodaj()">dodaj do koszyka</button>
				<br/><br/><br/><br/><br/><br/><br/>
				<span class="lewus">Producent:</span><span class="prawus"><?=$x[6]?></span>
				<span class="lewus">Kod Produktu:</span><span class="prawus"><?=$x[7]?></span>
	</div>
	<div id="obrazki">
	<?php
	$pliki=scandir("../Pliki");
	$obrazy= array();
	$regexio="/$x[1]/i";
	for($i=0;$i<count($pliki);$i++){
		if(preg_match($regexio, $pliki[$i])){
			array_push($obrazy,$pliki[$i]);
		}
	}
	$width=(100/count($obrazy))*1;
	for($i=0;$i<count($obrazy);$i++){
		echo "<img style='width:$width%;' src='../Pliki/$obrazy[$i]'  onmouseover='przeobrazowanie()'>";
	}
	?>
	</div>
		<br>	<br>
	<div class="opis">
	<h3>Opis</h3>
	</div>
	<div class="Opistresc">	
	<p><?=$x[8]?></p>
	</div>
</main>
<footer>
	<div>
		<ul>
		<li><a>Reklamacje</a></li>
		<li><a>Regulamin</a></li>
		</ul>
	</div>
	<div>
		<ul>
		<li><a>Twój koszyk</a></li>
		<li><a>Rejestracja</a></li>
		<li><a>Logowanie</a></li>
		</ul>
	</div>
	<div>
		<ul>
		<li><a>Metody płatności</a></li>
		<li><a>Czas i koszt dostawy</a></li>
		<li><a>Czas realizacji zamówienia</a></li>
		<li><a>Śledzenie przesyłki</a></li>
		<li><a>Zwrot lub wymiana</a></li>
		<li><a>Reklamacje</a></li>
		</ul>
	</div>
	<div>
		<ul>
		<li><a>Polityka prywatności</a></li>
		<li><a>Polityka cookies</a></li>
		</ul>
	</div>
	<div>
		<ul>
		<li><a>Kontakt i dane firmy</a></li>
		<li><a>O firmie</a></li>
		<li><a>Regulamin sklepu</a></li>
		</ul>
	</div>

</footer>
</body>
<script type="text/javascript" src="../Pliki/skrypt.js"></script>
</html>