const btnTheme = document.getElementById('btn-theme');
const body = document.body;

document.addEventListener("DOMContentLoaded", function () {
    const btnTheme = document.getElementById('btn-theme');
    const body = document.body;

    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark-mode');
        btnTheme.innerHTML = "☀️";
    }

    btnTheme.addEventListener('click', function () {
        body.classList.toggle('dark-mode');

        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            btnTheme.innerHTML = "☀️";
        } else {
            localStorage.removeItem('theme');
            btnTheme.innerHTML = "🌙";
        }
    });
});

document.querySelectorAll('.btn-detail').forEach(function (button) {
    button.addEventListener('click', function (e) {
        const cardBody = e.target.closest('.card-body');
        const stokElement = cardBody.querySelector('.stok-text');
        let stok = parseInt(stokElement.innerText.replace("Stok: ", ""));

        if (stok > 0) {
            stok--;
            stokElement.innerText = "Stok: " + stok;

            const namaBarang = cardBody.querySelector('.card-title').innerText;

            localStorage.setItem(namaBarang, stok);

            alert("Berhasil membeli " + namaBarang);
        } else {
            alert("Stok Habis!");
            e.target.disabled = true;
            e.target.innerText = "Habis";
        }
    });
});

let wishlist = JSON.parse(localStorage.getItem('wishlist')) || [];

function updateWishlistCount() {
    document.getElementById('wishlist-count').innerText = wishlist.length;
}

document.querySelectorAll('.btn-wishlist').forEach(function (button) {
    button.addEventListener('click', function (e) {
        const cardBody = e.target.closest('.card-body');
        const namaBarang = cardBody.querySelector('.card-title').innerText;

        if (!wishlist.includes(namaBarang)) {
            wishlist.push(namaBarang);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlistCount();
            alert(namaBarang + " ditambahkan ke Wishlist!");
        } else {
            alert(namaBarang + " sudah ada di Wishlist!");
        }
    });
});

function tampilkanWishlist() {
    const daftarWishlist = document.getElementById('daftar-wishlist');
    daftarWishlist.innerHTML = '';

    if (wishlist.length === 0) {
        daftarWishlist.innerHTML = '<li class="list-group-item text-center text-muted">Wishlist masih kosong.</li>';
    } else {
        wishlist.forEach(function (item) {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.innerText = '❤️' + item;
            daftarWishlist.appendChild(li)
        });
    }
}

const wishlistModal = document.getElementById('wishlistModal');
wishlistModal.addEventListener('show.bs.modal', function () {
    tampilkanWishlist();
});

function hapusWishlist() {
    wishlist = [];
    localStorage.removeItem('wishlist');
    updateWishlistCount();
    tampilkanWishlist();
}

updateWishlistCount();

document.querySelectorAll('.card-body').forEach(function (card) {
    const namaBarang = card.querySelector('.card-title').innerText;
    const stokElement = card.querySelector('.stok-text');

    let stok = localStorage.getItem(namaBarang);

    if (stok !== null) {
        stokElement.innerText = "Stok: " + stok;
    }
});