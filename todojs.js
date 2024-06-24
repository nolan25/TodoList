
/*
// Create h1 element
const h1 = document.createElement('h1');
h1.textContent = 'Todo List';
document.body.appendChild(h1);

// Create todoContainer div
const todoContainer = document.createElement('div');
todoContainer.id = 'todoContainer';
document.body.appendChild(todoContainer);

// Create maDiv div
const maDiv = document.createElement('div');
maDiv.id = 'maDiv';
document.body.appendChild(maDiv);
console.log('DOM fully loaded and parsed');

*/
    
     


    

    

document.addEventListener('DOMContentLoaded', function() {
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

    const todoForm = createTodoForm();
    document.body.appendChild(todoForm); // Ajoute le formulaire au corps du document

    // Fonction pour créer le formulaire de création de todo
    function createTodoForm() {
        const form = document.createElement('form');
        form.id = 'todoForm';

        const titleLabel = document.createElement('label');
        titleLabel.textContent = 'Title:';
        form.appendChild(titleLabel);

        const titleInput = document.createElement('input');
        titleInput.type = 'text';
        titleInput.name = 'title';
        titleInput.id = 'title';
        titleInput.required = true;
        form.appendChild(titleInput);

        form.appendChild(document.createElement('br'));

        const descriptionLabel = document.createElement('label');
        descriptionLabel.textContent = 'Description:';
        form.appendChild(descriptionLabel);

        const descriptionTextarea = document.createElement('textarea');
        descriptionTextarea.name = 'description';
        descriptionTextarea.id = 'description';
        descriptionTextarea.rows = 4;
        descriptionTextarea.required = true;
        form.appendChild(descriptionTextarea);

        const submitButton = document.createElement('button');
        submitButton.type = 'submit';
        submitButton.textContent = 'Create Todo';
        form.appendChild(submitButton);

        // Écouteur d'événement pour soumettre le formulaire
        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Empêche l'envoi par défaut du formulaire
        
            const formData = new FormData(this); // Récupère les données du formulaire
        
            fetch('http://localhost/phptodo/index.php?route=todo', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to create todo');
                }
                return response.text(); // Convertit la réponse en texte brut pour la journalisation
            })
            .then(text => {
                console.log('Raw response:', text); // Journaliser la réponse brute
                return JSON.parse(text); // Convertit la réponse en JSON
            })
            .then(data => {
                console.log('Todo created successfully:', data);
                fetchTodos(); // Re-fetch todos to update the list
            })
            .catch(error => {
                console.error('Error creating todo:', error);
            });
        });

        return form;
    }
});