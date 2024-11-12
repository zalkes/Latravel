var keyword = document.getElementById('search');
var tombolCari = document.getElementById('searchButton');
var container = document.getElementById('container');

function searchData(url, queryParam) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    }

    xhr.open('GET', url + '?' + queryParam + '=' + keyword.value, true);
    xhr.send();
}

keyword.addEventListener('keyup', function() {
    var currentPage = window.location.pathname;

    if (currentPage.includes('pengguna')) {
        searchData('../search/search_pengguna.php', 'search');
    } else if (currentPage.includes('rekomendasi')) {
        searchData('../search/search_rekomendasi.php', 'search');
    } else if (currentPage.includes('destinasi')) {
        searchData('../search/search_destinasi.php', 'search');
    } else if (currentPage.includes('panduan')) {
        searchData('../search/search_panduan.php', 'search');
    }
});