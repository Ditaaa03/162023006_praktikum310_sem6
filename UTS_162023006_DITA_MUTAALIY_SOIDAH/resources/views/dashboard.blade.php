<div>
    <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/> 
</head>

<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#home">
            <i class="fas fa-coffee me-2"></i>Sistem Manajemen Cafe
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link me-3" href="#menu">Menu</a></li>
                
                <li class="nav-item d-flex gap-2 align-items-center mt-3 mt-lg-0">
                    <button id="btn-theme" class="btn btn-sm rounded-pill">🌙</button>

                    <button class="btn-nav-wishlist" data-bs-toggle="modal" data-bs-target="#wishlistModal">
                        <i class="fas fa-star me-1"></i> Wishlist (<span id="wishlist-count">0</span>)
                    </button>

                    @if(session()->has('user'))
                        <div class="d-flex align-items-center ms-lg-2">
                            <span class="text-white small me-2 d-none d-xl-inline">Halo, <b>{{ session('user') }}</b></span>
                            <a href="{{ route('logout') }}" class="btn-nav-logout">Logout</a>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-nav-logout" style="background: #ffdce5;">Login</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="home">
<div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('assets/foto1.jpg') }}" class="d-block w-100 carousel-img" alt="Foto 1"/>
            <div class="carousel-caption">
                <h1>Daily Drizzle Cafe</h1>
                <p>Setiap rasa punya cerita. Mana yang ingin kamu cicipi hari ini?</p>
            </div>
        </div>
            
        <div class="carousel-item">
            <img src="{{ asset('assets/foto2.jpg') }}" class="d-block w-100 carousel-img" alt="Foto 2"/>
        </div>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

</section>

<section id="statistik" class="container py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                <h5 class="card-title mt-3">Total Menu</h5>
                <p class="card-text fs-4">8 Menu</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                <h5 class="card-title mt-3">Makanan</h5>
                <p class="card-text fs-4">4</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                <h5 class="card-title mt-3">Minuman</h5>
                <p class="card-text fs-4">4</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="menu" class="container py-5">
    <div class="d-flex justify-content-between mb-3">
        <h3 class="mb-4">Daftar Menu</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProdukModal">
            Tambah Produk
        </button>
        <a href="{{ route('products') }}" class="text-decoration-none text-dark mb-3">
            Lihat Semua Menu >>>
        </a>
    </div>

    <div class="row g-4 justify-content-center" id="container-barang">
        @foreach ($products as $item)
        <div class="col-md-4 mb-4"> <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mt-2">{{ $item->nama_produk }}</h5>
                    
                    <p class="card-text text-danger">
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    </p>
                    
                    <p class="card-text">Stok: {{ $item->stok_produk }}</p>

                    <div class="d-flex justify-content-between">
                        <button class="btn btn-primary btn-detail w-50 me-2">Beli</button>
                        <button class="btn btn-outline-danger btn-wishlist w-50">❤️ Wishlist</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<div class="modal fade" id="wishlistModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">⭐ Daftar Wishlist Saya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="daftar-wishlist">
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" onclick="hapusWishlist()">Kosongkan</button>
            </div>
        </div>
    </div>
</div>

<section id="form" class="py-5">
    <div class="container">
        <h2 class="text-center mb-4">Input Menu</h2>
        <form method="POST" action="{{ route('products') }}">
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Menu</label>
                    <input type="text" name="nama_produk" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok_produk" class="form-control" required>
                </div>

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-dark px-5">Simpan Data</button>
                    </div>
                </form>
            </div>
        </form>
    </div>
</section>

<footer class="text-center text-white mt-5" style="background-color: #d0667f;">
    <div class="container p-4 pb-0">
        <section class="mb-4">
            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-facebook-f"></i
            ></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-twitter"></i
            ></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-google"></i
            ></a>

            <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"
                ><i class="fab fa-instagram"></i
            ></a>
        </section>
    </div>
  
    <div class="text-center p-3" style="background-color: #e89daf">
        © 2026 Simple Warehouse Admin
    </div>
</footer> 

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>

<div class="modal fade" id="tambahProdukModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahProdukModalLabel">Tambah Produk</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Produk</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <div class="mb-3">
                        <label for="stok_produk" class="form-label">Stok Produk</label>
                        <input type="number" class="form-control" id="stok_produk" name="stok_produk" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Simpan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
</div>