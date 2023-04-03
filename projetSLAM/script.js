let card0 = document.getElementById("card1");
let card1 = document.getElementById("card2");
let card2 = document.getElementById("card3");
let card3 = document.getElementById("card4");

let card = [card0, card1, card2, card3];
let links = ["hangar.php", "vehicules.php", "intervention.php", "historique.php"]

for (let i = 0; i < links.length; i++) {
    if(card[i]){
        card[i].addEventListener("click", () => {
            document.location.href = links[i];
        });
    }
}

// POUR LA NORME EAN8

function validateEAN8(code) {
    if (code.length !== 8 || isNaN(Number(code))) {
      // Le code n'a pas une longueur de 8 chiffres ou n'est pas un nombre valide
      return false;
    }
  
    const digits = code.split("").map(Number);
    const checksum = digits.slice(0, -1).reduce((acc, digit, index) => {
      return acc + digit * (index % 2 === 0 ? 3 : 1);
    }, 0);
  
    const checkDigit = (10 - (checksum % 10)) % 10;
    return checkDigit === digits[7];
  }
  

let numero_materiel = document.querySelectorAll(".numero_materiel");

for (let i = 0; i < numero_materiel.length; i++) {
    console.log(numero_materiel[i].innerHTML);
    normeEAN8 = validateEAN8(numero_materiel[i].innerHTML);
    console.log(normeEAN8);
    if (normeEAN8 == false) {
        numero_materiel[i].innerHTML = "Une erreur est survenue";
        numero_materiel[i].style.color = "red";
    }
}


