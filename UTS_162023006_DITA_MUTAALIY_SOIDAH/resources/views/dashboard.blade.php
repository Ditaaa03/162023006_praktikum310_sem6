<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold">Warehouse Admin</a>

        <div class="ms-auto">
            <span class="me-3">Halo, {{ session('user') }}</span>
            <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="header">
        <h2>Dashboard</h2>
        <p>Selamat datang, {{ session('user') }}</p>
    </div>

    <div class="row g-3">
        <div class="card-box d-flex align-items-center justify-content-between">
            <div>
                <h6 class="text-muted">Total Produk</h6>
                <h3 class="fw-bold text-primary mb-0">{{ $totalProduk }}</h3>
            </div>
            <div style="font-size: 30px;">📦</div>
        </div>
    </div>

    <div class="table-box mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Produk</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            + Tambah Produk
        </button>
    </div>

    <div class="row">
        @foreach($products as $item)
        <div class="col-md-4 mb-3">
            <div class="product-card p-3">

                <h5>{{ $item->nama_produk }}</h5>
                <small>Kode: {{ $item->kode_produk }}</small>

                <p>
                    Stok: <b>{{ $item->stok_produk }}</b>
                    @if($item->stok_produk < 5)
                        <span class="text-danger small">(Low)</span>
                    @endif
                </p>

                <p class="text-danger fw-bold">
                    Rp {{ number_format($item->harga) }}
                </p>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $item->id }}">
                        Edit
                    </button>

                    <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">
                            Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>

        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <form action="{{ route('products.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5>Edit Produk</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <input type="text" name="nama_produk" class="form-control mb-2"
                                value="{{ $item->nama_produk }}">
                            <input type="text" name="kode_produk" class="form-control mb-2"
                                value="{{ $item->kode_produk }}">
                            <input type="number" name="stok_produk" class="form-control mb-2"
                                value="{{ $item->stok_produk }}">
                            <input type="number" name="harga" class="form-control"
                                value="{{ $item->harga }}">
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button class="btn btn-warning">Update</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('products.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Produk</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="nama_produk" class="form-control mb-2" placeholder="Nama Produk" required>
                        <input type="text" name="kode_produk" class="form-control mb-2" placeholder="Kode Produk" required>
                        <input type="number" name="stok_produk" class="form-control mb-2" placeholder="Stok" required>
                        <input type="number" name="harga" class="form-control" placeholder="Harga" required>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

</div>

</body>
</html>