<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Page Design</title>
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .discount-price {
      color: red;
      font-weight: bold;
    }

    .original-price {
      text-decoration: line-through;
      color: #888;
      margin-left: 5px;
    }

    .discount-percent {
      color: green;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">MyApp</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#products">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#orders">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-4">
    <!-- Home Section -->
    <section id="home" class="mb-5">
      <h1 class="mb-3">Welcome to MyApp</h1>
      <p>This is the home section where you can highlight key information about your website.</p>
    </section>

    <!-- Products Section -->
    <section id="products" class="mb-5">
      <h2 class="mb-3">Our Products</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Product ID: {{ $product->product_id }}</p>
                        <p class="discount-price">
                            Tk: {{ $product->price }} 
                            <span class="original-price">TK{{ $product->original_price }}</span>
                            <span class="discount-percent">{{ $product->discount_percent }}</span>
                        </p>
                        <a href="{{ route('checkout', $product->id) }}" class="btn btn-success">Buy</a>
                      </div>
                </div>
            </div>
         @endforeach
        {{-- <div class="col">
          <div class="card product-card h-100">
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 2">
            <div class="card-body">
              <h5 class="card-title">Product 2</h5>
              <p class="card-text">Product ID: #002</p>
              <p class="discount-price">&#8377;599 <span class="original-price">&#8377;900</span> <span class="discount-percent">-33%</span></p>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card product-card h-100">
            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Product 3">
            <div class="card-body">
              <h5 class="card-title">Product 3</h5>
              <p class="card-text">Product ID: #003</p>
              <p class="discount-price">&#8377;299 <span class="original-price">&#8377;500</span> <span class="discount-percent">-40%</span></p>
            </div>
          </div>
        </div> --}}
      </div>
    </section>

    <!-- Orders Section -->
    {{-- <section id="orders">
      <h2 class="mb-3">Your Orders</h2>
      <p>Here you can track and manage your orders.</p>
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Product 1</td>
            <td>2</td>
            <td>Shipped</td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Product 2</td>
            <td>1</td>
            <td>Processing</td>
          </tr>
        </tbody>
      </table>
    </section> --}}
  </div>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>