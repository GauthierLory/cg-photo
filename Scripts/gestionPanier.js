function ajoutPanier(idPhoto) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  var params = "idAjoutPhoto="+idPhoto;
  xhttp.open("POST", "../Controleurs/gestionPanier.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
  alert("Photo ajoutée au panier");
}

function suppressionPanier(idPhoto) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("demo").innerHTML = this.responseText;
    }
  };
  var params = "idSuppressionPhoto="+idPhoto;
  xhttp.open("POST", "../Controleurs/gestionPanier.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send(params);
  alert("Photo supprimée du panier");
}
