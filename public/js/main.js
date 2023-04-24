// écouteur d'évènement pour le choix des catégories,
// Pour la redirection vers l'URL d'affichage de la description de catégorie.
const elListeCategorie = document.getElementById('listeCategorie');
elListeCategorie.addEventListener('change', () => {
    const choixUtilisateur = elListeCategorie.value;
    const labelOption = elListeCategorie.options[elListeCategorie.selectedIndex].text;
    // document.location.href = '/categorie/' + choixUtilisateur;

    document.location.href = '/categorie/' + labelOption;
});

// Gestion des champs du formulaire de recherche de prestataire pour une cohérence des données.
//////////////////////////////////////////////////////////////////////////////////////////////
const elCommune = document.getElementById('commune');
const elProvince = document.getElementById('province');
const elCodePostal = document.getElementById('cp');
const elListeCommune = document.getElementById('listeCommune');

/**
 * Après avoir introduit une commune, j'insère les données correspondantes à celle-ci
 * dans les champs code postal et province.
 */
elCommune.addEventListener('blur', () => {
    const index = [...elListeCommune.options] //*1
        .map(o => o.value) //*2
        .indexOf(elCommune.value);  //*3
    if (index === -1) {
        // msg.innerHTML = "Aucun id à afficher."
    } else {
        // insertion du code postal dans le champ code postal
        elCodePostal.value = elListeCommune.options[index].id;
        // insertion de la province dans le champ province
        insertProvince(elListeCommune.options[index].id);

    }

}, false);


/**
 *  Fonction qui modifie le select HTML de la liste des provinces
 * @param codePostal un code postal belge à 4 chiffres
 * @param isCommune boolean Si je suis dans le cas de la modification du champ commune au départ d'une insertion dans le champ code postal
 */
function insertProvince(codePostal, isCommune = false) {

    let requestURL = 'http://127.0.0.1:8000/data/Region-Ville-CodePostal.json';
    let request = new XMLHttpRequest();
    request.open('GET', requestURL, true);
    request.responseType = 'json';
    request.send();
    request.onload = function () {
        let response = request.response;
        // console.log(typeof response);

        for (let cpt = 0; cpt < response.length; cpt++) { // je parcours le tableau d'object
            obj = response[cpt];
            // console.log(response[cpt]);


            // Si je suis dans le cas d'une insertion de code postal OU d'une insertion de commune
            if (obj.codePostal == codePostal) { // Si le code postal est correspondant
                // Si je suis dans le cas d'une insertion de code postal
                if (isCommune) {
                    // console.log(obj.ville); // donne le nom de la commune
                    elCommune.value = obj.ville;
                }


                // console.log(obj.region);  // renvoie la province en fonction d'un code postal donné en paramètre
                // parcourir l'élément HTML select du formulaire pour y placer un attribut selected
                for (let provinceNum = 0; provinceNum < elProvince.length; provinceNum++) {
                    if (obj.region === elProvince[provinceNum].value) {
                        for (let provinceNum2 = 0; provinceNum2 < elProvince.length; provinceNum2++) {
                            elProvince[provinceNum2].removeAttribute('selected'); // retrait dd tous les attributs selected, ou qu'il soit
                        }

                        elProvince[provinceNum].setAttribute("selected", "");

                        return;
                    }
                }
            }
        }
    }
}

/**
 * Après avoir introduit un code postal, j'insère les données correspondantes à celui-ci
 * dans les champs 'commune' et 'province'.
 */
elCodePostal.addEventListener('blur', () => {
    let codePostal = elCodePostal.value;
    insertProvince(codePostal, true);

}, false);









