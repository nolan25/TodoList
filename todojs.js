

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

    */
     


   

    

    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded and parsed');
        fetchTodos();
    
        function fetchTodos() {
            console.log('Fetching todos...');
            fetch('http://localhost/phptodo/index.php?route=todo')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Lire la réponse en tant que texte
                })
                .then(rawData => {
                    console.log('Raw response:', rawData); // Afficher la réponse brute
                    try {
                        const data = JSON.parse(rawData); // Tenter de parser en JSON
                        console.log('Data parsed:', data);
                        displayTodos(data);
                    } catch (error) {
                        console.error('Error parsing JSON:', error);
                        const todoContainer = document.getElementById('todoContainer');
                        todoContainer.innerHTML = `<p>There was a problem with your fetch operation: ${error.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('There was a problem with your fetch operation:', error);
                });
        }
    
        function displayTodos(todos) {
            console.log('Displaying todos...');
            const todoContainer = document.getElementById('todoContainer');
            todoContainer.innerHTML = ''; // Clear any existing content
    
            if (todos.length === 0) {
                todoContainer.innerHTML = '<p>No todos found.</p>';
                return;
            }
    
            todos.forEach(todo => {
                console.log('Todo:', todo); // Log each todo
                const todoElement = document.createElement('div');
                todoElement.classList.add('todo');
                todoElement.innerHTML = `
                    <h3>${todo.titre}</h3>
                    <p>${todo.description}</p>
                `;
                todoContainer.appendChild(todoElement);
            });
            console.log('Todos displayed'); // Log debug
        }
    });


    function createTodo() {
        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
    
        fetch('http://localhost/phptodo/index.php?route=todo', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ title: title, description: description })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to create todo');
            }
            return response.json();
        })
        .then(data => {
            console.log('Todo created successfully:', data);
            // Traitez la réponse ou mettez à jour l'interface utilisateur
        })
        .catch(error => {
            console.error('Error creating todo:', error);
        });
    }