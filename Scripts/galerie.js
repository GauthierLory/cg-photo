// var bouton = document.getElementsByClassName("bouton-ajouter-panier");
//
// bouton.onclick = function(){
//   var r1 = bouton.childNodes[1].value;
//   // var r1 = bouton.attr("value");
//
//   alert(r1);
// }

var buttons = document.getElementsByClassName('bouton-ajouter-panier');
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
        alert(this.childNodes[1].value;);
    });
}
