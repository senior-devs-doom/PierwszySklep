var ceny=[["REKSIO",0],["Krecik",6.66],["Kortaderia pampasowa",50],["Nasiona",3]];//te dane powinny być pobierane z zewnątrz
function przeobrazowanie(){
	document.getElementsByClassName("ppierwszy")[0].firstChild.src=event.target.src;
}
function startkoszyka(){
	if(!localStorage.getItem("MyLashesCart")){
		localStorage.setItem("MyLashesCart", "PUSTY");
	}
}
function filtruj(){
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
function linkfiltruj1(){
	localStorage.setItem("MyLashesSearch", event.target.innerHTML.toLowerCase());
	window.location.href = "../../index.html";
}
function linkfiltruj2(){
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
function walidacjaIlość1(){
	var inputy=document.getElementsByTagName("input");
	for(var i=0;i<inputy.length;i++){
		inputy[i].addEventListener( "click", walidacjaIlość2);
		inputy[i].addEventListener( "keyup", walidacjaIlość2);
	}
}
function walidacjaIlość2(){
	var liczba=parseInt(event.target.value.replace(".",","));
	if(liczba<=0){
		event.target.value=1;
	}
	else{
		event.target.value=liczba;
	}
	if(document.getElementById("zaladujkoszyk")){
		koszykTabelaOdswiez();
	}
}
function koszykDodaj(){
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
function koszykOdswiez(){
	var koszyk=localStorage.getItem("MyLashesCart")
	var przedmioty=0;
	if(koszyk!="PUSTY"){
		for(var i=0;i<koszyk.length;i++){
			if(koszyk[i]==";"){
				przedmioty++;
			}
		}
	}
	if(przedmioty/2==1){
		document.getElementById("koszykliczba").innerHTML="W twom koszyku jest "+przedmioty/2+" produkt"	
	}
	if(przedmioty/2>1){
		document.getElementById("koszykliczba").innerHTML="W twom koszyku jest "+przedmioty/2+" produktów!"	
	}
	console.log(localStorage.getItem("MyLashesCart"));
}
function koszykTabelaOdswiez(){
var MyLashesCart="";
var tabela=document.getElementsByTagName("table")[0].children[0].children;
var suma=0;
for(var i=1;i<tabela.length;i++){
	var produkt=tabela[i].children[1].innerHTML;
	var ilosc=Math.round(parseInt(tabela[i].children[3].firstChild.value) * 100) / 100;
	for(j=0;j<ceny.length;j++){
		if(produkt==ceny[j][0]){
			var cena=ceny[j][1];
			break;
		}
	}
	suma+=Math.round(cena*ilosc * 100) / 100;
	document.getElementsByTagName("table")[0].children[0].children[i].children[4].innerHTML=`${ Math.round(cena*ilosc * 100) / 100 } zł`;
	MyLashesCart+=produkt+";"+ilosc+";";
	}
localStorage.setItem("MyLashesCart",MyLashesCart)
document.getElementsByClassName("Sumatabela")[0].innerHTML="SUMA = "+suma+" zł"
}
function koszykZaladuj(){
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
	tabela="<h2 class='Koszyktabela'>Koszyk :</h2><hr>";
	tabela+="<table><tr><th></th><th>Produkt</th> <th>Cena</th><th>ilość</th> <th>Cena całkowita</th><th></th></tr>";
	for(i=0;i<tablica.length;i++){
	tabela+=`<tr><td style="width:10%;"><img  src='../../Pliki/${ tablica[i][0] }.jpg' alt='${ tablica[i][0] }'></td>`;
	tabela+="<td>"+tablica[i][0]+"</td>";
	for(j=0;j<ceny.length;j++){
		if(tablica[i][0]==ceny[j][0]){
			var cena=ceny[j][1];
			break;
		}
	}
	tabela+=`<td>${ cena } zł</td>`;
	tabela+=`<td><input type="number" value='${ tablica[i][1] }'></td>`;
	tabela+=`<td>${ cena*tablica[i][1] } zł</td>`;
	suma+=cena*tablica[i][1];
	tabela+="<td><button onclick='koszykUsun()'>Usuń</button></td></tr>";	
	}
	tabela+="</table>";
	tabela+="<h2 class='Sumatabela'>SUMA = "+suma+" zł</h2>";
	document.getElementById("zaladujkoszyk").innerHTML=tabela;
}
function koszykUsun(){
	delete event.target.parentNode.parentNode.remove();
	koszykTabelaOdswiez();
}
startkoszyka();
koszykOdswiez();
if(localStorage.getItem("MyLashesCart")!="PUSTY" && document.getElementById("zaladujkoszyk")){
	koszykZaladuj();
}
if(localStorage.getItem("MyLashesSearch")){
	linkfiltruj2()
}
walidacjaIlość1();
