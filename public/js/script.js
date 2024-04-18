// Une fonction pour vérifier les contraintes lors de l'inscirption
function validateFormRegister() {
    // Les valeurs des inputs
    var email = document.forms["registrationForm"]["registerEmail"].value;
    var nom = document.forms["registrationForm"]["registerNom"].value;
    var prenom = document.forms["registrationForm"]["registerPrenom"].value;
    var password = document.forms["registrationForm"]["registerPassword"].value;
    var password2 = document.forms["registrationForm"]["password2"].value;

    // Les spans qui vont contenir les messages d'eerreur
    var emailError = document.getElementById("emailError");
    var nomError = document.getElementById("nomError");
    var prenomError = document.getElementById("prenomError");
    var passwordError = document.getElementById("passwordError");
    var password2Error = document.getElementById("password2Error");
    var champsError = document.getElementById("champsError");

    // Réinitialiser les messages d'erreur
    champsError.textContent = "";
    emailError.textContent = ""; 
    nomError.textContent = "";
    prenomError.textContent = "";
    passwordError.textContent = "";
    password2Error.textContent = "";

    // Pour voir si tous les éléments sont valides
    var isValid = true;

    //Il faut remplir tous les champs 
    if (email == "" || nom == "" || prenom == "" || password == "" || password2 == "") {
      champsError.textContent = "Veuillez remplir tous les champs";
      isValid = false;
    }
  
    // Il faut que le nom et le prénom fassent au moins 2 caractèrees
    if (nom.length < 2) {
      nomError.textContent = "Le nom doit faire au moins 2 caractères !";
      isValid = false;
    }
    if (prenom.length < 2) {
        prenomError.textContent = "Le prénom doit faire au moins 2 caractères !";
        isValid = false;
      }
  
    // Il faut que le mot de passe soit correct
    if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password) || !/[^A-Za-z0-9]/.test(password)) {
      passwordError.textContent = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial !";
      isValid = false;
    }
  
    // Les 2 mdp doivent correspondre
    if (password !== password2) {
      password2Error.textContent = "Les mots de passe ne correspondent pas !";
      isValid = false;
    }
  
    return isValid;
  }

  // Une fonction pour vérifier les contraintes lors de l'ajout de coordonnées
  function validateFormCoordonnees() {
    var rue = document.forms["modificationCoordonneesForm"]["Rue"].value;
    var codePostal = document.forms["modificationCoordonneesForm"]["CodePostal"].value;
    var ville = document.forms["modificationCoordonneesForm"]["Ville"].value;
    var email = document.forms["modificationCoordonneesForm"]["email"].value;

    var rueError = document.getElementById("rueError");
    var codePostalError = document.getElementById("codePostalError");
    var villeError = document.getElementById("villeError");
    var emailError = document.getElementById("emailError");
    var champsError = document.getElementById("champsError");

    rueError.textContent = "";
    codePostalError.textContent = "";
    villeError.textContent = "";
    emailError.textContent = "";
    champsError.textContent = "";

    var isValid = true;

    if (rue == "" || codePostal == "" || ville == "" || email == "") {
        champsError.textContent = "Veuillez remplir tous les champs";
        isValid = false;
    }

    if (rue.length < 2) {
        rueError.textContent = "La rue doit faire au moins 2 caractères !";
        isValid = false;
    }

    if (codePostal.length < 5 || isNaN(parseInt(codePostal))) {
        codePostalError.textContent = "Le code postal doit être composé d'au moins 5 chiffres !";
        isValid = false;
    }

    if (ville.length < 2) {
        villeError.textContent = "La ville doit faire au moins 2 caractères !";
        isValid = false;
    }

    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        emailError.textContent = "Veuillez saisir une adresse email valide !";
        isValid = false;
    }

    return isValid;
}
