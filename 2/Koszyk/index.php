<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="../Pliki/style.css">
<title>My lashes</title>
</head>
<body>
<form method="POST" location=".." style="display:none;" onkeydown="return event.key != 'Enter';">>
<button></button>
</form>
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
<main id="zaladujkoszyk">
<form method="get" action="zaplac.php" onkeydown="return event.key != 'Enter';"  onsubmit="return sprawdzDaneKlienta();">
	<?php
	if(count($_POST)){//tworzy tabele z produktami
		$link=mysqli_connect("localhost","root","","mylashes");
		$zapytanie=mysqli_query($link,"SELECT * FROM `produkty`");
		echo "
		<h2 class='Koszyktabela'>Koszyk :</h2>
		<hr>
		<table>
		<tr>
			<th></th>
            <th>Produkt</th>
            <th>Cena</th>
            <th>ilość</th>
            <th>Cena całkowita</th>
            <th></th>
        </tr>";
		$suma=0;
		$nrproduktu=0;
		for($i=0;$i<mysqli_num_rows($zapytanie);$i++){
			$x=mysqli_fetch_array($zapytanie);
			if(@$_POST[str_replace(" ","_",$x[1])]){
				$id=$x[0];
				$nazwa=$x[1];
				$cena=$x[2];
				$ilosc=$_POST[str_replace(" ","_",$x[1])];
				$wartość=$cena*$ilosc;
				if (file_exists('../Pliki/'.$x[1].'.png'))
					$obraz='../Pliki/'.$x[1].'.png';
				else
					$obraz='../Pliki/'.$x[1].'.jpg';
				echo "
				<tr>
					   <input type='hidden' name='produktnr$nrproduktu' value='$id'>
					<td style='width:10%;'><img src='$obraz' alt='$nazwa'></td>
					<td>$nazwa</td>
					<td>$cena zł</td>
					<td><input class='produktilosc' type='number' name='produktiloscnr$nrproduktu' value='$ilosc'></td>
					<td>$wartość zł</td>
					<td><button onclick='koszykUsun()'>Usuń</button></td>
				</tr>";
				$suma+=$wartość;
				$nrproduktu++;		
			}
		}
		echo "
		</table>
		<h2 class='Sumatabela'>SUMA = $suma zł</h2>
		";
		//tworzy formularz na dane klienta
		echo "
		<h2 class='Koszyktabela'>Dane Klienta :</h2>
		<hr>
		<div class='daneklienta'>
		<div id='daneklient1'>
			<label>Imie :</label><br/>
			<input type='text' name='imie'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient2'>
			<label>Nazwisko:</label><br/>
			<input type='text' name='nazwisko'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient3'>
			<label>Email:</td></label><br/>
			<input type='email' name='k24_email'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient4'>
			<label>Miasto:</td></label><br/>
			<input type='text' name=' k24_miasto'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient5'>
			<label>Ulica:</td></label><br/>
			<input type='text' name='k24_ulica'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient6'>
			<label>Numer domu:</label><br/>
			<input type='text' name='k24_numer_dom'>
			<p></p><br/><br/>
		</div>
		<div >
			<label>Numer lokalu:</label><br/>
			<input type='text' name='k24_numer_lok'>
			<p></p><br/><br/>
		</div>
		<div id='daneklient7'>
			<label>Kod pocztowy:</label><br/>
			<input type='text' name='kod_pocztowy'>
			<p></p><br/><br/>
		</div>
		</div>
		";
		echo "<button id='dokasy'>DO KASY</button>";
	}
	else
		echo "<h2 class='pusty'>TWÓJ KOSZYK JEST PUSTY!</h2>";
	?>
</form onkeydown="return event.key != 'Enter';">
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