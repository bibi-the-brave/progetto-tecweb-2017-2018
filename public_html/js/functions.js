
function ajax(url, dest){ //funzione per richieste ajax
    var xhttp;
    if(window.XMLHttpRequest){
        // Codice per IE7+, Firefox, Chrome, Opera, Safari
        xhttp=new XMLHttpRequest();
    } else{
        // Codice per IE5, IE6
        xhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhttp.onreadystatechange = function(){
        if(xhttp.readyState==4 && xhttp.status==200){
            document.getElementById(dest).innerHTML = xhttp.responseText;
        }
    }
    xhttp.open("GET", url, true);
    xhttp.send();
}


function menuResponsive() {
    var x = document.getElementById("nav");
    if (x.className === "On") {
        x.className = "Off";
        document.getElementById('hamburgerMenu').title='Mostra barra di navigazione';
    } else {
        x.className = "On";
        document.getElementById('hamburgerMenu').title='Nascondi barra di navigazione';
    }
}
function menuOff() {
    var x = document.getElementById("nav");
    x.className = "Off";
}


// true se il numero di telefono inserito è nel formato corretto
function phonenumber(inputtxt)  { 
    var phoneno = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;  
    if((inputtxt.value.match(phoneno))) {  
      // Il numero di telefono è inserito nel formato corretto
      return true;  
    }  
    else  
    {  
      alert('Il numero di telefono non è stato inserito nel modo corretto: deve essere nel formato a 10 cifre con o senza spazi. Es: 320 123 4567');  
      return false;  
    }  
  }

// scrive nell'apposito div il selettore della durata
function writeDurata(){
    document.getElementById("durataFinita").innerHTML="          <label for=\"ore_e\">Ore</label><input name=\"ore_e\" placeholder=\"Ore\" type=\"number\" min=\"0\" required/><label for=\"minuti_e\">Minuti</label><input name=\"minuti_e\" placeholder=\"Minuti\" type=\"number\" min=\"0\" max=\"59\" required/>";
}

function writeDurataWithValues(ore,minuti){
    document.getElementById("durataFinita").innerHTML="          <label for=\"ore_e\">Ore</label><input name=\"ore_e\" placeholder=\"Ore\" type=\"number\" min=\"0\" value=\""+ore+"\" required/><label for=\"minuti_e\">Minuti</label><input name=\"minuti_e\" placeholder=\"Minuti\" type=\"number\" min=\"0\" max=\"59\" value=\""+minuti+"\" required/>";
}

//togliete dall'apposito div il selettore della durata
function deleteDurata(){
    document.getElementById("durataFinita").innerHTML=""
}