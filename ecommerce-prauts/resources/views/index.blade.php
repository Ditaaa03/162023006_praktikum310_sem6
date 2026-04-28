<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Viya Market - Katalog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet"/> 
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #d0667f;">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fas fa-shopping-cart me-2"></i>Viya Market</a>
        <div class="ms-auto">
            <a href="{{ route('cart') }}" class="btn btn-outline-light me-2">
                <i class="fas fa-shopping-basket"></i> Keranjang
            </a>
            <a href="{{ route('logout') }}" class="btn btn-light">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4 text-center">Katalog Produk</h2>
    <div class="row">
        @foreach($products as $item)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $item->product_name }}</h5>
                    @foreach($item->categories as $cat)
                        <span class="badge bg-info text-dark mb-2">{{ $cat->category_name }}</span>
                    @endforeach
                    <p class="text-danger fw-bold">Rp {{ number_format($item->product_price, 0, ',', '.') }}</p>
                    <p class="small text-muted">Stok: {{ $item->product_stock }}</p>
                    <a href="{{ route('cart.add', $item->id) }}" class="btn btn-primary w-100">
                        <i class="fas fa-plus me-1"></i>Tambah ke Keranjang
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</body>
</html>