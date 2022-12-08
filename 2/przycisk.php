<form method="POST">
<button>przeładuj produkty</button>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$delete=scandir ("Produkty");
	for($i=2;$i<count($delete);$i++){
		@unlink ("Produkty/$delete[$i]");
	}
	$link=mysqli_connect("localhost","root","","mylashes");
	$zapytanie=mysqli_query($link,"SELECT id,nazwa FROM `produkty`");
	for($i=0;$i<mysqli_num_rows($zapytanie);$i++){
		$x=mysqli_fetch_array($zapytanie);
		$znakiNieNie='?\/:*<>|"';
		$nazwa=$x[1];
		for($ii=0;$ii<strlen($znakiNieNie);$ii++)
			$nazwa=str_replace($znakiNieNie[$ii],"f",$nazwa);
		$myfile = fopen("Produkty/$nazwa.php", "w") or die("Unable to open file!");
		$myfile2 = fopen("podstronaprodukt.txt", "r") or die("Unable to open file!");
		$txt =fread($myfile2,filesize("podstronaprodukt.txt"));
		fwrite($myfile, '<?php $produktid='.$i.';?>');
		fwrite($myfile, $txt);
		fclose($myfile);
		fclose($myfile2);
	}
}
?>