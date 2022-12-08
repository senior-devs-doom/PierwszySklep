<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8" />
<link rel="stylesheet" href="../Pliki/style.css">
<title>My lashes</title>
</head>
<body>
<main id="zaladujkoszyk">
<?php
	var_dump($_GET);
	$link=mysqli_connect("localhost","root","","mylashes");
	$zapytanie1=mysqli_query($link,"SELECT id FROM `zamowienia` ORDER BY id DESC limit 1");
	$przeloncznik=true;
	$produktyTablica=array();
	$wiersz=array(0,0);
	foreach ($_GET as $key => $value) {//wyciąga zamówione produkty z GET do tabeli 2 wymiarowej
		if(substr($key, 0, 7)=="produkt"){
			if($przeloncznik){
				$wiersz[0]=$value;
				$przeloncznik=false;
			}
			else{
				$wiersz[1]=$value;
				$przeloncznik=true;
				array_push($produktyTablica,$wiersz);
			}
		}
	}
	$zapytanie2=mysqli_query($link,"SELECT id,nazwa,cena FROM `produkty`");
	$produkty="";
	$suma=0;
	for($i=0;$i<mysqli_num_rows($zapytanie2);$i++){//wkładanie zamówienia do stringa i obliczenie sumy
			$x=mysqli_fetch_array($zapytanie2);
			foreach($produktyTablica as  $value){
				if($x[0]==$value[0]){
					$produkty.=$x[1] . " sztuk " . $value[1] . ";";
					$suma+=$x[2]*$value[1];
				}	
			}
			
	}

?>
	<form method="get" action="zaplac.php" ><!--https://sklep.przelewy24.pl/zakup.php-->
	<?php
	foreach($_GET as $name => $value) {//kopiuj cały get żeby został po przeładowaniu, gówniane rozwiązanie, trzeba zmienić jak już sie ogarnie przelewy24
		$name = htmlspecialchars($name);
		$value = htmlspecialchars($value);
		echo '<input type="hidden" name="'. $name .'" value="'. $value .'">';
	}
	echo '<input type="hidden" name="produkty" value="'. $produkty .'">';
	echo '<input type="hidden" name="suma" value="'. $suma .'">';	
	?>
		<input  name="z24_id_sprzedawcy" value="{TWOJ_ID}">
		<input  name="z24_crc" value="{KLUCZ_ZAKUPU}">
		<input  name="z24_return_url" value="{STRONA_DO_KTOREJ_WRACA}">
		<input  name="z24_language" value="pl">
		<table>
			<tr>
			<td align="right">Nazwa zamówienia:</td> 
			<td><input type="text" name="z24_nazwa" value="<?='zamówienie nr. ' . '0'?>"></td>
			</tr>
			<tr>
			<td align="right">Kwota do zapłaty:</td>
			<td><input type="text" name="z24_kwota" value="<?=$suma*100?>"></td><!--KWOTA W GROSZACH-->
			</tr>
		</table>
		Wypełnia klient:<br/>
		Imie i Nazwisko:<br/>
		<input type="text" name="k24_nazwa" value="<?=$_GET['imie'] . " "  .$_GET['nazwisko']?>"><br/>
		Email:</td><br/>
		<input type="text" name="k24_email" value="<?=$_GET['k24_email']?>"><br/>
		Miasto:</td><br/>
		<input type="text" name="k24_miasto" value="<?=$_GET['k24_miasto']?>"><br/>
		Ulica:</td><br/>
		<input type="text" name="k24_ulica" value="<?=$_GET['k24_ulica']?>"><br/>
		Numer domu:<br/>
		<input type="text" name="k24_numer_dom" value="<?=$_GET['k24_numer_dom']?>"><br/>
		<input type="submit" value="zapłać z przelewy24.pl">
	</form>
<?php	
 if(@$_GET['k24_nazwa']){
	 $nazwa=$_GET['k24_nazwa'];
	 $produkty=$_GET['produkty'];
	 $suma=$_GET['suma'];
	 $k24_email=$_GET['k24_email'];
	 $k24_miasto=$_GET['k24_miasto'];
	 $k24_ulica=$_GET['k24_ulica'];
	 $k24_numer_dom=$_GET['k24_numer_dom'];
	 $kod_pocztowy=$_GET['kod_pocztowy'];
	$pytanko="INSERT INTO `zamowienia` VALUES ('','$nazwa','$produkty','$suma','$k24_email','$k24_miasto','$k24_ulica','$k24_numer_dom','$kod_pocztowy',NOW(),'');";
	echo $pytanko;
	$zapytanie3=mysqli_query($link,$pytanko);
	}
?>
</main>
</body>
</html>