// écouteur d'évènement pour le choix des catégories,
// Pour la redirection vers l'URL d'affichage de la description de catégorie.
const elListeCategorie = document.getElementById('listeCategorie');
elListeCategorie.addEventListener('change', () => {
    const choixUtilisateur = elListeCategorie.value;

    document.location.href = '/categorie/' + choixUtilisateur;

});





