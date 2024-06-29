document.addEventListener('DOMContentLoaded', function () {
    initialize();

    function initialize() {
        createHeader();
        createTodoContainer();
        //createAddButton();
        createTodoForm();
        addEventListeners();
        fetchTodos();
    }

    function createHeader() {
        const header = document.createElement('header');
        header.classList.add('header');
        document.body.appendChild(header);
    
        // Container for all buttons
        const buttonContainer = document.createElement('div');
        buttonContainer.classList.add('button-container');
        header.appendChild(buttonContainer);
    
        // Left section with logout button
        const logoutButton = document.createElement('button');
        logoutButton.id = 'logoutButton';
        logoutButton.classList.add('header-button');
        logoutButton.textContent = 'Déconnexion';
        buttonContainer.appendChild(logoutButton);
    
        // Center section with add todo button
        const addTodoButton = document.createElement('button');
        addTodoButton.id = 'addTodoButton';
        addTodoButton.classList.add('header-button');
        addTodoButton.textContent = 'Ajouter Todo';
        buttonContainer.appendChild(addTodoButton);
    
        // Right section with empty button (like the "Todo" button)
        const emptyButton = document.createElement('button');
        emptyButton.id = 'emptyButton';
        emptyButton.classList.add('header-button');
        emptyButton.textContent = 'Todo';
        buttonContainer.appendChild(emptyButton);
    }
    
    

    function createTodoContainer() {
        const todoContainer = document.createElement('div');
        todoContainer.id = 'todoContainer';
        document.body.appendChild(todoContainer);
    }

    function createAddButton() {
        const addButton = document.createElement('button');
        addButton.id = 'addTodoButton';
        addButton.textContent = 'Ajouter Todo';
        document.body.appendChild(addButton);
    }

   

    function createTodoForm() {
        const form = document.createElement('form');
        form.id = 'todoForm';
        form.style.display = 'none'; // Hide the form initially

        form.innerHTML = `
            <label for="titre">Titre:</label>
            <input type="text" id="titre" name="titre" required>
            <br>
            <label for="description">Description:</label>
            <input type="text" id="description" name="description" required>
            <br>
            <label for="idPriorite">Priorité:</label>
            <input type="number" id="idPriorite" name="idPriorite" required>
            <br>
            <label for="idUsers">ID Utilisateur:</label>
            <input type="number" id="idUsers" name="idUsers" required>
            <br>
            <label for="dateEcheance">Date d'échéance:</label>
            <input type="date" id="dateEcheance" name="dateEcheance">
            <br>
            <button type="submit">Ajouter</button>
        `;

        document.body.appendChild(form);
    }

    function addEventListeners() {
        document.getElementById('addTodoButton').addEventListener('click', toggleFormVisibility);
        document.getElementById('todoForm').addEventListener('submit', handleFormSubmit);
    }

    function toggleFormVisibility() {
        const form = document.getElementById('todoForm');
        const todoContainer = document.getElementById('todoContainer');

        // Hide todos when showing the form
        todoContainer.style.display = 'none';

        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
            // Show todos after hiding the form
            todoContainer.style.display = 'block';
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();

        const formData = new FormData(event.target);
        const todoData = {
            titre: formData.get('titre'),
            description: formData.get('description'),
            idPriorite: formData.get('idPriorite'),
            idUsers: formData.get('idUsers'),
            dateEcheance: new Date().toISOString().slice(0, 19).replace('T', ' '),
            dateCreation: new Date().toISOString().slice(0, 19).replace('T', ' ')
        };

        postToDo(todoData.titre, todoData.description, todoData.idPriorite, todoData.dateEcheance, todoData.idUsers, todoData.dateCreation);

        // Hide the form after submission
        event.target.reset();  // Reset the form fields
        event.target.style.display = 'none';  // Hide the form

        // Show todos after hiding the form
        document.getElementById('todoContainer').style.display = 'block';
    }

    function postToDo(titre, description, idPriorite, dateEcheance, idUser, dateCreation, idStatut = 1) {
        fetch(`./index.php?route=todo/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `route=todo&titre=${encodeURIComponent(titre)}&idPriorite=${encodeURIComponent(idPriorite)}&description=${encodeURIComponent(description)}&echeance=${encodeURIComponent(dateEcheance)}&idUsers=${idUser}&idStatut=${idStatut}&dateCreation=${dateCreation}`,
        })
        .then(response => response.text())
        .then(text => {
            try {
                const data = JSON.parse(text);
                if (data.id) {
                   displayTodos(data.id);
                }
            } catch (error) {
                console.error('Erreur lors du parsing JSON :', error);
                console.log('Réponse brute du serveur :', text);
            }
        })
        .catch(error => console.error('Erreur lors de la requête :', error));
    }

    function fetchTodos() {
        fetch('http://localhost/phptodo/index.php?route=todo')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(rawData => {
                try {
                    const data = JSON.parse(rawData);
                    displayTodos(data);
                    fetchTodos();
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                    document.getElementById('todoContainer').innerHTML = `<p>There was a problem with your fetch operation: ${error.message}</p>`;
                }
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
    }

    function getPriorityLabel(idPriorite) {
        return new Promise((resolve, reject) => {
            fetch(`http://localhost/phptodo/index.php?route=priorite&id=${idPriorite}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                    
                })
                .then(data => {
                    resolve(data.label); // Renvoyer le libellé récupéré
                    console.log('Label:', data.label);
                })
                .catch(error => {
                    console.error('Error fetching priority:', error);
                    reject('Priorité inconnue'); // En cas d'erreur, renvoyer un message par défaut
                });
        });
    }

   
    function displayTodos(todos) {
        const todoContainer = document.getElementById('todoContainer');
        todoContainer.innerHTML = ''; // Clear any existing content
    
        if (todos.length === 0) {
            todoContainer.innerHTML = '<p>No todos found.</p>';
            return;
        }
    
        todos.forEach(todo => {
            
            const todoElement = document.createElement('div');
            todoElement.classList.add('todo');
            todoElement.innerHTML = `
                <h3>Titre : ${todo.titre}</h3>
                <p>Description : ${todo.description}</p>
                <p>Priorité : </p>
                <p>Echéance : ${todo.echeance}</p>
                
    
                <button onclick="updateTodoForm">Modifier</button>
                <button onclick="deleteTodo(${todo.id})">Supprimer</button>
            `;
            todoContainer.appendChild(todoElement);
        });
    }
    
    // Fonction pour pré-remplir et afficher le formulaire de modification
    function updateTodoForm(id, titre, description, echeance) {
        const form = document.createElement('form');
        form.id = 'updateTodoForm';
    
        const titreLabel = document.createElement('label');
        titreLabel.setAttribute('for', 'titre');
        titreLabel.textContent = 'Titre:';
        form.appendChild(titreLabel);
    
        const titreInput = document.createElement('input');
        titreInput.type = 'text';
        titreInput.id = 'titre';
        titreInput.name = 'titre';
        titreInput.required = true;
        titreInput.value = titre; // Pré-remplissage avec le titre actuel
        form.appendChild(titreInput);
    
        const lineBreak1 = document.createElement('br');
        form.appendChild(lineBreak1);
    
        const descriptionLabel = document.createElement('label');
        descriptionLabel.setAttribute('for', 'description');
        descriptionLabel.textContent = 'Description:';
        form.appendChild(descriptionLabel);
    
        const descriptionInput = document.createElement('input');
        descriptionInput.type = 'text';
        descriptionInput.id = 'description';
        descriptionInput.name = 'description';
        descriptionInput.required = true;
        descriptionInput.value = description; // Pré-remplissage avec la description actuelle
        form.appendChild(descriptionInput);
    
        const lineBreak2 = document.createElement('br');
        form.appendChild(lineBreak2);
    
        const echeanceLabel = document.createElement('label');
        echeanceLabel.setAttribute('for', 'echeance');
        echeanceLabel.textContent = 'Echéance:';
        form.appendChild(echeanceLabel);
    
        const echeanceInput = document.createElement('input');
        echeanceInput.type = 'date';
        echeanceInput.id = 'echeance';
        echeanceInput.name = 'echeance';
        echeanceInput.value = echeance; // Pré-remplissage avec l'échéance actuelle, assurez-vous que la valeur soit correctement formatée
        form.appendChild(echeanceInput);
    
        const lineBreak3 = document.createElement('br');
        form.appendChild(lineBreak3);
    
        const submitButton = document.createElement('button');
        submitButton.type = 'button';
        submitButton.textContent = 'Enregistrer';
        submitButton.addEventListener('click', function() {
            const updatedTodo = {
                id: id,
                titre: titreInput.value,
                description: descriptionInput.value,
                echeance: echeanceInput.value
            };
            updateTodo(updatedTodo);
        });
        form.appendChild(submitButton);
    
        // Remplacer le formulaire existant s'il y en a déjà un
        const existingForm = document.getElementById('updateTodoForm');
        if (existingForm) {
            existingForm.replaceWith(form);
        } else {
            todoContainer.appendChild(form);
        }
    }
    
    // Fonction pour mettre à jour le todo côté serveur
    function updateTodo(todo) {
        fetch(`http://localhost/phptodo/index.php?route=todo/${todo.id}`, {
            method: 'PUT', // Utilisez PUT pour une mise à jour
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(todo),
        })
        .then(response => response.json())
        .then(updatedTodo => {
            console.log('Todo mis à jour avec succès:', updatedTodo);
            // Rechargez la liste des todos après la mise à jour
            fetchTodos();
        })
        .catch(error => console.error('Erreur lors de la mise à jour du todo:', error));
    }
    
    // Fonction pour supprimer un todo
    function deleteTodo(id) {
        fetch(`http://localhost/phptodo/index.php?route=todo/${id}`, {
            method: 'DELETE',
        })
        .then(response => {
            if (response.ok) {
                console.log(`Todo ${id} supprimé avec succès`);
                // Rechargez la liste des todos après la suppression
                fetchTodos();
            } else {
                throw new Error('Erreur lors de la suppression du todo');
            }
        })
        .catch(error => console.error('Erreur lors de la suppression du todo:', error));
    }
});
