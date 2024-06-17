

// fetch('/index.php?route=statut')

//     .then(response => {
//         document.getElementById('container').innerHTML = '<p>Contenu ajouté</p>';
        
//         if (!response.ok) {
//             throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(statutsData => {
//         // Les données de statut sont maintenant disponibles dans la variable statutsData
//         console.log(statutsData);

//         // Vous pouvez trier les données comme vous le souhaitez ici
//         var statutsTries = statutsData.sort((a, b) => a.label.localeCompare(b.label));

//         // Exemple d'affichage des statuts triés
//         statutsTries.forEach(statut => {
//             console.log(`ID: ${statut.id}, Label: ${statut.label}`);
            
//         });
//     })
//     .catch(error => {
//         console.error('There was a problem with your fetch operation:', error);
//     });

/* 
// Fonction pour créer et insérer des éléments HTML

function afficherStatuts(statuts) {
    const container = document.getElementById('container');
    container.innerHTML = ''; // Effacer le contenu existant

    statuts.forEach(statut => {
        const statutElement = document.createElement('div');
        statutElement.className = 'statut';
        statutElement.innerHTML = `<p>ID: ${statut.id}</p><p>Label: ${statut.label}</p>`;
        container.appendChild(statutElement);
    });
}


// Récupérer les données JSON depuis le serveur

fetch('/index.php?route=statut')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(statutsData => {
        // Afficher les données dans le HTML
        afficherStatuts(statutsData);
        
        // Utiliser les données dans le JS
        console.log('Données des statuts:', statutsData);

        // Par exemple, trier les données par label
        const statutsTries = statutsData.sort((a, b) => a.label.localeCompare(b.label));
        console.log('Statuts triés:', statutsTries);

        // Afficher les statuts triés dans le HTML (vous pouvez appeler la fonction ci-dessus à nouveau)
        afficherStatuts(statutsTries);
    })
    .catch(error => {
        console.error('There was a problem with your fetch operation:', error);
    });
test
    */
     
    function fetchAndDisplayStatuts() {
        fetch('fetch_statuts.php')
            .then(response => response.json())
            .then(data => {
                const statutsContainer = document.getElementById('statuts');
                statutsContainer.innerHTML = ''; // Efface le contenu actuel

                // Vérifie s'il y a des erreurs
                if (data.error) {
                    statutsContainer.innerHTML = `<p>Error: ${data.error}</p>`;
                    return;
                }

                // Affiche les statuts
                data.forEach(statut => {
                    const statutElement = document.createElement('div');
                    statutElement.classList.add('statut');
                    statutElement.innerHTML = `<strong>ID:</strong> ${statut.id} <br> <strong>Label:</strong> ${statut.label}`;
                    statutsContainer.appendChild(statutElement);
                });
            })
            .catch(error => {
                const statutsContainer = document.getElementById('statuts');
                statutsContainer.innerHTML = `<p>There was a problem with your fetch operation: ${error.message}</p>`;
            });
    }

    // Appel de la fonction au chargement de la page
    window.onload = fetchAndDisplayStatuts;
    

   