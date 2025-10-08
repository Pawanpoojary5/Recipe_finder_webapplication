// Redirect to index2.html when button1 is clicked
const button1 = document.getElementById('button1');
if (button1) {
    button1.addEventListener('click', function () {
        window.location.href = 'index2.html';
    });
}

// Handle search functionality
const searchButton = document.getElementById('searchButton');
if (searchButton) {
    searchButton.addEventListener('click', function () {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            const query = searchInput.value.toLowerCase();
            if (query) {
                alert('Search functionality is not implemented yet.');
                // Implement search functionality here
            }
        } else {
            console.error('Search input element not found.');
        }
    });
}

// Redirect to nonvegetarian.html when nonveg button is clicked
const nonvegButton = document.getElementById('nonveg');
if (nonvegButton) {
    nonvegButton.addEventListener('click', function () {
        window.location.href = 'nonveg.html';
    });
}







