let previewContainer = document.querySelector('.card-preview');
let previewBox = document.querySelectorAll('.preview-container');

document.querySelectorAll('.container .card').forEach(card => {
    card.onclick = () => {
        previewContainer.style.display = 'flex';
        let name = card.getAttribute('data-name');
        previewBox.forEach(previewContainer => {
            let target = previewContainer.getAttribute('data-target');
            if(name === target) {
                previewContainer.classList.add('active');
            }
        });
    };
});

document.querySelectorAll('#close').forEach(closeBtn => {
    closeBtn.onclick = () => {
        previewContainer.style.display = 'none';
        previewBox.forEach(previewContainer => {
            previewContainer.classList.remove('active');
        });
    };
});

document.addEventListener('click', (event) => {
    if (!event.target.closest('.card') && !event.target.closest('.preview-container')) {
        previewContainer.style.display = 'none';
        previewBox.forEach(previewContainer => {
            previewContainer.classList.remove('active');
        });
    }
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

function limit_size(event){
    const limit = 3 * 1024 *1024;
    var file = event.target.files[0];
    var path = URL.createObjectURL(event.target.files[0]);
    var photo = document.getElementById("upload-file").value;
    var title = document.getElementById("title-img");
    var image = document.getElementById("up-img");
    var ext = file.name.split(".").pop();

    if (file.size > limit){
        alert("Maksimal File adalah 3 MB");
        event.target.value = "";
        return;
    }

    if (ext == "png" || ext == "jpg" || ext =="jpeg"){
        if (photo){
            image.style.display = "block";
            title.style.display = "none";
            image.src = path;
            console.log(ext);
            return;
        }
    }

    alert("Ekstensi File Harus png, jpg, jpeg");
}


// preview foto profile 
function previewImage(event) {
    const image = document.getElementById('foto-preview');
    if (event.target.files && event.target.files[0]) {
        image.src = URL.createObjectURL(event.target.files[0]);
    }
}