// panduan perjalanan

document.getElementById('searchButton').addEventListener('click', function() {
    const query = document.getElementById('search').value;
    alert("Search for: " + query);
});

const editButtons = document.querySelectorAll('.edit-button');
const deleteButtons = document.querySelectorAll('.delete-button');

deleteButtons.forEach(button => {
    button.addEventListener('click', () => {
        if (confirm("Are you sure you want to delete this item?")) {
            alert("Item deleted");
        }
    });
});

// pagination
document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 3; // Tetapkan 3 baris per halaman
    let currentPage = 1;

    const table = document.querySelector("table tbody");
    const rows = Array.from(table.querySelectorAll("tr"));
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function displayRows() {
        rows.forEach(row => (row.style.display = "none"));
        const start = (currentPage - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        rows.slice(start, end).forEach(row => (row.style.display = ""));
        updatePagination();
    }

    function updatePagination() {
        const pagination = document.getElementById("pagination");
        pagination.innerHTML = "";

        const createPageButton = (page) => {
            const button = document.createElement("button");
            button.textContent = page;
            if (page === currentPage) {
                button.classList.add("active");
            }
            button.addEventListener("click", () => {
                currentPage = page;
                displayRows();
            });
            return button;
        };

        if (currentPage > 1) {
            const prevButton = document.createElement("button");
            prevButton.textContent = "<";
            prevButton.addEventListener("click", () => {
                currentPage--;
                displayRows();
            });
            pagination.appendChild(prevButton);
        }

        for (let i = 1; i <= totalPages; i++) {
            pagination.appendChild(createPageButton(i));
        }

        if (currentPage < totalPages) {
            const nextButton = document.createElement("button");
            nextButton.textContent = ">";
            nextButton.addEventListener("click", () => {
                currentPage++;
                displayRows();
            });
            pagination.appendChild(nextButton);
        }
    }

    displayRows();
});
