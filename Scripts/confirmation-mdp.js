 function confirmationMdp()
  {
    var mdp = document.getElementById("mdp").value
        var confMdp = document.getElementById("confMdp").value
        if(mdp != confMdp) {
            alert('Le mot de passe nest pas identique');
        }
  }