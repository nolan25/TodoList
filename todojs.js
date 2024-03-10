// Utilisation de statutsData dans votre script JavaScript
console.log(statutsData); // Affiche les données des statuts dans la console

// Vous pouvez trier les données comme vous le souhaitez ici
var statutsTries = statutsData.sort((a, b) => a.label.localeCompare(b.label));

// Exemple d'affichage des statuts triés
statutsTries.forEach(statut => {
    console.log(`ID: ${statut.id}, Label: ${statut.label}`);
});