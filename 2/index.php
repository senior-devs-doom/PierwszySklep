<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="Pliki/style.css">
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
		<h1><a href="index.php"><img style="width:50%;" src="Pliki/logo.png" title="My lashes" alt="My lashes"/></a></h1>
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
  		<li onclick="filtruj()"><h2><a >Trawy</a></h2></li>
		<li onclick="filtruj()"><h2><a >Krety</a></h2></li>
		<li onclick="filtruj()"><h2><a >Psy</a></h2></li>
		<li onclick="filtruj()"><h2><a >Promocje</a></h2></li>
		<li onclick="filtruj()"><h2><a>Pozostałe</a></h2></li>
		<li class="boczki"><h2><a style="color:gray;" > a</a></li>
  	</ul>
</div>
<main>
	<aside>
	<div onclick="filtruj()" id="sklep">Sklep</div>
	<div>
		<ul>
		<?php //wypisuje kategorie
			$link=mysqli_connect("localhost","root","","mylashes");
			$zapytanie=mysqli_query($link,"SELECT nazwa FROM `kategorie`");
			for($i=0;$i<mysqli_num_rows($zapytanie);$i++){
				$x=mysqli_fetch_array($zapytanie);
				echo "<li onclick='filtruj()'><a >${x[0]}</a></li>";
			}
		?>
		</ul>	
    </div>   	
	</aside>
<!--produkty-->
<div class="produkty">
		<?php //wypisuje produkty
			$zapytanie2=mysqli_query($link,"SELECT * FROM produkty");
			for($i=0;$i<mysqli_num_rows($zapytanie2);$i++){
				$x=mysqli_fetch_array($zapytanie2);
				$zapytanie3=mysqli_query($link,"SELECT produkty.nazwa,kategorie.nazwa FROM `kategorie` inner join produkty_kategorie on kategorie.id=produkty_kategorie.kategorieid inner join produkty on produkty.id=produkty_kategorie.produktyid where produkty.nazwa='${x[1]}';");
				$klasa="produkt ";
				for($ii=0;$ii<mysqli_num_rows($zapytanie3);$ii++){ //przydziela produktą kategorie dla javascriptu
					$klasa.=strtolower(mysqli_fetch_array($zapytanie3)[1])." ";
				}
				if (file_exists('Pliki/'.$x[1].'.png'))
					$obraz='Pliki/'.$x[1].'.png';
				else
					$obraz='Pliki/'.$x[1].'.jpg';
				echo "<div class='$klasa'><a href='Produkty/${x[1]}.php'><img src='$obraz'><h4><p>${x[1]}</p></h4><p><b>${x[2]} zł</b></p></a></div>";
			}
			mysqli_close($link);
		?>
</div>
</main>
<br/>
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
<script type="text/javascript" src="Pliki/skrypt.js"></script>
</html>