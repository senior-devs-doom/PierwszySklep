function przeobrazowanie(){//zmienia obraz główny po najechaniu na podstronie produktu
	document.getElementsByClassName("ppierwszy")[0].firstChild.src=event.target.src;
}
function startkoszyka(){//tworzy koszyk
	if(!localStorage.getItem("MyLashesCart")){
		localStorage.setItem("MyLashesCart", "PUSTY");
	}
}
function filtruj(){//filtruje produkty które nie są z klinkniętej klasy na stronie głównej
	var wszystko=document.getElementsByClassName("produkty")[0].children;
	var klikniente=event.target.innerHTML.toLowerCase();
	var wybrane=document.getElementsByClassName(klikniente);
	for(var i=0;i<wszystko.length;i++){
		wszystko[i].style.display="none";
	}
	for(i=0;i<wybrane.length;i++){
		wybrane[i].style.display="";
	}
	if(klikniente=="sklep"){
		for(var i=0;i<wszystko.length;i++){
			wszystko[i].style.display="";
		}
	}
}
function linkfiltruj1(){//to samo co filtruj tylko pomiędzy stronami
	localStorage.setItem("MyLashesSearch", event.target.innerHTML.toLowerCase());
	window.location.href = "../index.php";
}
function linkfiltruj2(){//dalsza część linkfiltruj1 po przejściu na strone główną
	var wszystko=document.getElementsByClassName("produkty")[0].children;
	var klikniente=localStorage.getItem("MyLashesSearch");
	localStorage.removeItem("MyLashesSearch");
	var wybrane=document.getElementsByClassName(klikniente);
	for(var i=0;i<wszystko.length;i++){
		wszystko[i].style.display="none";
	}
	for(i=0;i<wybrane.length;i++){
		wybrane[i].style.display="";
	}
	if(klikniente=="sklep"){
		for(var i=0;i<wszystko.length;i++){
			wszystko[i].style.display="";
		}
	}
}
function walidacjaIlosc1(){//'podpina' funkcje do walidacji pól ilość w koszyku
	var inputy=document.getElementsByClassName("produktilosc");
	for(var i=0;i<inputy.length;i++){
		inputy[i].addEventListener( "click", walidacjaIlosc2);
		inputy[i].addEventListener( "keyup", walidacjaIlosc2);
	}
}
function walidacjaIlosc2(){//zapobiega wpisaniu niepoprawnych danych do ilość
	var liczba=parseFloat(event.target.value.replace(".",","));
	if(liczba<=0 || isNaN(liczba)){
		event.target.value=1;
	}
	else{
		event.target.value=liczba;
	}
	if(document.getElementById("zaladujkoszyk")){
		koszykTabelaOdswiez();
	}
}
function koszykDodaj(){//dodaje produkt do koszyka, wykrywa powtórzenie produktu
	var nazwa=document.getElementsByClassName("nazwa")[0].innerHTML;
	var ilosc=document.getElementsByClassName("lewus")[5].firstChild.value;
	var koszyk=localStorage.getItem("MyLashesCart");
	var nowykoszyk="";
	var komorka="";
	var powtarzaj=false;
	var powtorzono=false
	if(koszyk!="PUSTY"){
		for(var i=0;i<koszyk.length;i++){
			if(koszyk[i]!=";"){
				komorka+=koszyk[i]
			}
			else{
				if(powtarzaj){
					powtarzaj=false;
					komorka=(parseInt(komorka)+parseInt(ilosc)).toString();
					powtorzono=true;
				}
				nowykoszyk+=komorka+";";
				if(komorka==nazwa){
					powtarzaj=true;	
				}
				komorka="";
			}
		}
	}
	if(!powtorzono){
		nowykoszyk+=nazwa+";"+ilosc+";";
	}
	localStorage.setItem("MyLashesCart", nowykoszyk);
	koszykOdswiez()
}
function koszykOdswiez(){ //wypisuje ile przedmiotów jest w koszyku w prawym górnym rogu
	var koszyk=localStorage.getItem("MyLashesCart")
	var przedmioty=0;
	if(koszyk!="PUSTY"){
		for(var i=0;i<koszyk.length;i++){
			if(koszyk[i]==";"){
				przedmioty++;
			}
		}
	}
	if(przedmioty/2<1){
		document.getElementById("koszykliczba").innerHTML="Twój koszyk Jest pusty!"	
	}
	if(przedmioty/2==1){
		document.getElementById("koszykliczba").innerHTML="W twom koszyku jest "+przedmioty/2+" produkt"	
	}
	if(przedmioty/2>1){
		document.getElementById("koszykliczba").innerHTML="W twom koszyku są "+przedmioty/2+" produkty!"	
	}
}
function koszykTabelaOdswiez(){
var MyLashesCart="";
var tabela=document.getElementsByTagName("table")[0].children[0].children;
var suma=0;
for(var i=1;i<tabela.length;i++){
	var produkt=tabela[i].children[2].innerHTML;
	var cena=tabela[i].children[3].innerHTML;
	cena = cena.substring(0, cena.length-3);
	var ilosc=Math.round(parseInt(tabela[i].children[4].firstChild.value) * 100) / 100;
	suma+=Math.round(cena*ilosc * 100) / 100;
	document.getElementsByTagName("table")[0].children[0].children[i].children[5].innerHTML=`${ Math.round(cena*ilosc * 100) / 100 } zł`;
	MyLashesCart+=produkt+";"+ilosc+";";
	}
document.getElementsByClassName("Sumatabela")[0].innerHTML="SUMA = "+suma+" zł";
localStorage.setItem("MyLashesCart",MyLashesCart)
koszykOdswiez();
}
function koszykZaladuj(){//wyciąga koszyk z localstorage,zmienia w tabele dwuwymiarową, wsadza do formularza GET i odświeża stronę, czyli w skrócie podaje koszyk php.
	var koszyk=localStorage.getItem("MyLashesCart");
	var tabela=document.getElementById("zaladujkoszyk").innerHTML;
	var dane1="";
	var dane2="";
	var tablica=new Array;
	var suma=0;
	for(var i=0;i<koszyk.length;i++){
		if(koszyk[i]!=";"){
			dane2+=koszyk[i];
		}
		else{
			if(dane1==""&&dane2!=""){
				dane1=dane2;
				dane2="";
			}
			if(dane1!=""&&dane2!=""){
				tablica.push(new Array(dane1,dane2));
				dane1="";
				dane2="";
			}
			
		}
	}
	if(localStorage.getItem("MyLashesReload")){
		localStorage.removeItem("MyLashesReload");
	}
	else{
		localStorage.setItem("MyLashesReload","true");
		var formularz=document.getElementsByTagName("form")[0];
		for(i=0;i<tablica.length;i++){
		var input= document.createElement("INPUT");
		input.name=tablica[i][0];
		input.value=tablica[i][1];
		formularz.appendChild(input);
		};
		formularz.children[0].click();
	}
	if(localStorage.getItem("MyLashesCart")=="PUSTY"){
		document.getElementsByTagName("MAIN")[0].innerHTML="<h2 class='pusty'>TWÓJ KOSZYK JEST PUSTY!</h2>";
	}
}
function koszykUsun(){//usuwa produkt z koszyka
	delete event.target.parentNode.parentNode.remove();
	koszykTabelaOdswiez();
	if(localStorage.getItem("MyLashesCart")==""){
		document.getElementsByTagName("MAIN")[0].innerHTML="<h2 class='pusty'>TWÓJ KOSZYK JEST PUSTY!</h2>";
	}
}
function sprawdzDaneKlienta(){//sprawdza poprawność danych klienta
	var jestDobrze=true;
	for(var i=1;i<=7;i++){
		var numer="daneklient"+i;
		var pole=document.getElementById(numer).children;
		switch(i){
			case 3://validacja emaila
				var emailCheck = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
				if(!emailCheck.test(pole[2].value)){
					document.getElementById(numer).children[3].innerHTML="*wprowadź prawidłowy adres email";
					document.getElementById(numer).children[0].style.color="red";
					document.getElementById(numer).children[2].style.borderColor="#ff6666";
					jestDobrze=false;
				}
				else{
					document.getElementById(numer).children[3].innerHTML="";
					document.getElementById(numer).children[0].style.color="";
					document.getElementById(numer).children[2].style.borderColor="";
				}
			break;
			case 7://validacja kodu pocztowego
				var KodPocztowyCheck = new RegExp(/[0-9][0-9]-[0-9][0-9][0-9]/);
				if(!KodPocztowyCheck.test(pole[2].value)){
					document.getElementById(numer).children[3].innerHTML="*wprowadź prawidłowy kod pocztowy";
					document.getElementById(numer).children[0].style.color="red";
					document.getElementById(numer).children[2].style.borderColor="#ff6666";
					jestDobrze=false;
				}
				else{
					document.getElementById(numer).children[3].innerHTML="";
					document.getElementById(numer).children[0].style.color="";
					document.getElementById(numer).children[2].style.borderColor="";
				}
			break;
			default: //validacja czy pole nie jest puste
				if(!pole[2].value){
					document.getElementById(numer).children[3].innerHTML="*pole nie może być puste";
					document.getElementById(numer).children[0].style.color="red";
					document.getElementById(numer).children[2].style.borderColor="#ff6666";
					jestDobrze=false;
				}
				else{
					document.getElementById(numer).children[3].innerHTML="";
					document.getElementById(numer).children[0].style.color="";
					document.getElementById(numer).children[2].style.borderColor="";
				}
			break;
		}
	}
	return jestDobrze;
}
startkoszyka();
koszykOdswiez();
if(document.getElementById("zaladujkoszyk")){//tylko na podstronie poświęconej koszykowi
	koszykZaladuj();
}
if(localStorage.getItem("MyLashesSearch")){//tylko po kliknięciu linkfiltruj1
	linkfiltruj2()
}
if(document.getElementsByClassName("produktilosc").length){//tylko na podstronie poświęconej koszykowi
	walidacjaIlosc1();
}
