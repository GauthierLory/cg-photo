var ongletActuel = 0;
afficherOnglet(ongletActuel);

function afficherOnglet(n) {
  var x = document.getElementsByClassName("onglet");
  x[n].style.display = "block";
  if (n == 0) {
    document.getElementById("precBtn").style.display = "none";
  } else {
    document.getElementById("precBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Inscription";
  } else {
    document.getElementById("nextBtn").innerHTML = "Go !";
  }
  indicateurEtape(n)
}

function suivantPrec(n) {
  var x = document.getElementsByClassName("onglet");
  if (n == 1 && !formulaireValide()) return false;
  x[ongletActuel].style.display = "none";
  ongletActuel = ongletActuel + n;
  if (ongletActuel >= x.length) {
    document.getElementById("formulaire-inscription").submit();
    return false;
  }
  afficherOnglet(ongletActuel);
}

function formulaireValide() {
  var x, y, i, valid = true;
  x = document.getElementsByClassName("onglet");
  y = x[ongletActuel].getElementsByTagName("input");
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalide";
      valid = false;
    }
  }
  if (valid) {
    document.getElementsByClassName("etape")[ongletActuel].className += " fini";
  }
  return valid;
}

function indicateurEtape(n) {
  var i, x = document.getElementsByClassName("etape");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  x[n].className += " active";
}