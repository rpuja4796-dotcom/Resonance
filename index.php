<?php
session_start();

$products = [
    [
        'id' => 1,
        'name' => 'Aurora Noise-Cancelling Headphones',
        'category' => 'Electronics',
        'gender' => 'All',
        'price' => 129.99,
        'rating' => 4.8,
        'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=900&q=80',
        'description' => 'Rich wireless sound, plush cushions, and all-day battery life.'
    ],
    [
        'id' => 2,
        'name' => 'Lumen Smart Watch',
        'category' => 'Watches',
        'gender' => 'Men',
        'price' => 189.00,
        'rating' => 4.7,
        'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?auto=format&fit=crop&w=900&q=80',
        'description' => 'A polished smartwatch with wellness tracking and a stainless finish.'
    ],
    [
        'id' => 3,
        'name' => 'Serene Gold Mesh Watch',
        'category' => 'Watches',
        'gender' => 'Women',
        'price' => 154.50,
        'rating' => 4.6,
        'image' => 'https://images.unsplash.com/photo-1542496658-e33a6d0d50f6?auto=format&fit=crop&w=900&q=80',
        'description' => 'Slim profile, soft gold tone, and a refined mesh bracelet.'
    ],
    [
        'id' => 4,
        'name' => 'Nova Cotton Overshirt',
        'category' => 'Clothing',
        'gender' => 'Men',
        'price' => 58.00,
        'rating' => 4.5,
        'image' => 'https://images.unsplash.com/photo-1516257984-b1b4d707412e?auto=format&fit=crop&w=900&q=80',
        'description' => 'A clean everyday layer made with breathable brushed cotton.'
    ],
    [
        'id' => 5,
        'name' => 'Iris Linen Wrap Dress',
        'category' => 'Clothing',
        'gender' => 'Women',
        'price' => 76.25,
        'rating' => 4.8,
        'image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=900&q=80',
        'description' => 'Lightweight linen blend with a flattering adjustable waist.'
    ],
    [
        'id' => 6,
        'name' => 'Vertex 4K Action Camera',
        'category' => 'Electronics',
        'gender' => 'All',
        'price' => 249.00,
        'rating' => 4.7,
        'image' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?auto=format&fit=crop&w=900&q=80',
        'description' => 'Compact 4K capture with rugged protection and vivid stabilization.'
    ],
    [
        'id' => 7,
        'name' => 'Studio Notebook Set',
        'category' => 'Stationery',
        'gender' => 'All',
        'price' => 22.99,
        'rating' => 4.9,
        'image' => 'https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&w=900&q=80',
        'description' => 'Premium ruled notebooks for planning, sketching, and daily notes.'
    ],
    [
        'id' => 8,
        'name' => 'Precision Pen Collection',
        'category' => 'Stationery',
        'gender' => 'All',
        'price' => 18.75,
        'rating' => 4.6,
        'image' => 'https://images.unsplash.com/photo-1583485088034-697b5bc54ccd?auto=format&fit=crop&w=900&q=80',
        'description' => 'Smooth-writing pens in a handsome desk-ready presentation box.'
    ],
    [
        'id' => 9,
        'name' => 'Arc Wireless Keyboard',
        'category' => 'Electronics',
        'gender' => 'All',
        'price' => 84.00,
        'rating' => 4.5,
        'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?auto=format&fit=crop&w=900&q=80',
        'description' => 'Low-profile keys, quiet travel, and multi-device Bluetooth pairing.'
    ],
    [
        'id' => 10,
        'name' => 'Atlas Leather Strap Watch',
        'category' => 'Watches',
        'gender' => 'Men',
        'price' => 139.00,
        'rating' => 4.4,
        'image' => 'https://images.unsplash.com/photo-1539874754764-5a96559165b0?auto=format&fit=crop&w=900&q=80',
        'description' => 'Classic analog watch with a textured dial and leather strap.'
    ],
    [
        'id' => 11,
        'name' => 'Mira Tailored Blazer',
        'category' => 'Clothing',
        'gender' => 'Women',
        'price' => 112.00,
        'rating' => 4.7,
        'image' => 'https://images.unsplash.com/photo-1551803091-e20673f15770?auto=format&fit=crop&w=900&q=80',
        'description' => 'A refined blazer for polished workdays and evening plans.'
    ],
    [
        'id' => 12,
        'name' => 'Desk Essentials Organizer',
        'category' => 'Stationery',
        'gender' => 'All',
        'price' => 34.50,
        'rating' => 4.8,
        'image' => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?auto=format&fit=crop&w=900&q=80',
        'description' => 'A tidy workspace kit with trays, clips, sticky notes, and markers.'
    ],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = isset($_POST['product_id']) ? (int) $_POST['product_id'] : 0;

    if (($action === 'add_to_cart' || $action === 'buy_now') && $productId > 0) {
        $_SESSION['cart'][$productId] = ($_SESSION['cart'][$productId] ?? 0) + 1;
        $message = $action === 'buy_now'
            ? 'Great choice. Your item is ready for checkout.'
            : 'Added to cart successfully.';
    }

    if ($action === 'login') {
        $_SESSION['customer_name'] = trim($_POST['email'] ?? 'Customer');
        $message = 'Welcome back. You are signed in for this session.';
    }

    if ($action === 'signup') {
        $_SESSION['customer_name'] = trim($_POST['name'] ?? 'New Customer');
        $message = 'Your account preview has been created for this session.';
    }

    if ($action === 'remove_from_cart' && $productId > 0) {
        unset($_SESSION['cart'][$productId]);
        $message = 'Item removed from cart.';
    }
}

$search = trim($_GET['search'] ?? '');
$category = $_GET['category'] ?? 'All';
$gender = $_GET['gender'] ?? 'All';

$filteredProducts = array_values(array_filter($products, function ($product) use ($search, $category, $gender) {
    $matchesSearch = $search === ''
        || stripos($product['name'], $search) !== false
        || stripos($product['category'], $search) !== false
        || stripos($product['description'], $search) !== false;
    $matchesCategory = $category === 'All' || $product['category'] === $category;
    $matchesGender = $gender === 'All' || $product['gender'] === $gender || $product['gender'] === 'All';

    return $matchesSearch && $matchesCategory && $matchesGender;
}));

$cartCount = array_sum($_SESSION['cart']);
$cartTotal = 0;
$productById = [];
foreach ($products as $product) {
    $productById[$product['id']] = $product;
}

foreach ($_SESSION['cart'] as $id => $quantity) {
    if (isset($productById[(int) $id])) {
        $cartTotal += $productById[(int) $id]['price'] * $quantity;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resonance Market | Premium Online Store</title>
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <nav class="nav-shell">
            <a class="brand" href="index.php" aria-label="Resonance Market home">
                <span class="brand-mark">R</span>
                <span>Resonance Market</span>
            </a>
            <div class="nav-links" aria-label="Main navigation">
                <a href="#products">Products</a>
                <a href="#account">Login</a>
                <a href="#account">Signup</a>
            </div>
            <a class="cart-pill" href="#cart" aria-label="View shopping cart">
                <span>Cart</span>
                <strong><?php echo $cartCount; ?></strong>
            </a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="hero-copy">
                <p class="eyebrow">Premium shopping for everyday essentials</p>
                <h1>Shop electronics, clothing, watches, and stationery in one polished store.</h1>
                <p class="hero-text">Discover refined products for men and women, built around quick search, beautiful product cards, and simple buying actions.</p>
                <div class="hero-actions">
                    <a class="primary-link" href="#products">Shop Products</a>
                    <a class="secondary-link" href="#account">Create Account</a>
                </div>
            </div>
            <div class="hero-showcase" aria-label="Featured product preview">
                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1100&q=80" alt="Premium sneakers displayed for online shopping">
                <div class="floating-card">
                    <span>Weekend Deal</span>
                    <strong>Up to 35% off select styles</strong>
                </div>
            </div>
        </section>

        <?php if ($message !== ''): ?>
            <section class="notice" role="status"><?php echo htmlspecialchars($message); ?></section>
        <?php endif; ?>

        <section class="toolbar" id="products" aria-label="Product search and filters">
            <div>
                <p class="eyebrow">Catalog</p>
                <h2>Find your next favorite product</h2>
            </div>
            <form class="search-panel" method="GET" action="index.php#products">
                <label for="search">Search products</label>
                <div class="search-row">
                    <input id="search" name="search" type="search" placeholder="Search electronics, clothing, watches..." value="<?php echo htmlspecialchars($search); ?>">
                    <select name="category" aria-label="Choose category">
                        <?php foreach (['All', 'Electronics', 'Clothing', 'Watches', 'Stationery'] as $option): ?>
                            <option value="<?php echo $option; ?>" <?php echo $category === $option ? 'selected' : ''; ?>><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="gender" aria-label="Choose audience">
                        <?php foreach (['All', 'Men', 'Women'] as $option): ?>
                            <option value="<?php echo $option; ?>" <?php echo $gender === $option ? 'selected' : ''; ?>><?php echo $option; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Search</button>
                </div>
            </form>
        </section>

        <section class="category-strip" aria-label="Popular categories">
            <a href="index.php?category=Electronics#products">Electronics</a>
            <a href="index.php?category=Clothing&gender=Men#products">Men's Clothing</a>
            <a href="index.php?category=Clothing&gender=Women#products">Women's Clothing</a>
            <a href="index.php?category=Watches#products">Watches</a>
            <a href="index.php?category=Stationery#products">Stationery</a>
        </section>

        <section class="product-grid" aria-label="Product list">
            <?php if (count($filteredProducts) === 0): ?>
                <div class="empty-state">
                    <h3>No products found</h3>
                    <p>Try a different search term or browse all categories.</p>
                    <a href="index.php#products">Reset filters</a>
                </div>
            <?php endif; ?>

            <?php foreach ($filteredProducts as $product): ?>
                <article class="product-card">
                    <div class="product-image">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <span><?php echo htmlspecialchars($product['category']); ?></span>
                    </div>
                    <div class="product-body">
                        <div class="product-meta">
                            <span><?php echo htmlspecialchars($product['gender']); ?></span>
                            <span><?php echo number_format($product['rating'], 1); ?> rating</span>
                        </div>
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="product-footer">
                            <strong>$<?php echo number_format($product['price'], 2); ?></strong>
                            <form method="POST" class="product-actions">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="action" value="add_to_cart" class="ghost-button">Add to Cart</button>
                                <button type="submit" name="action" value="buy_now" class="solid-button">Buy Now</button>
                            </form>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>

        <section class="account-cart-layout">
            <section class="account-panel" id="account">
                <div class="section-heading">
                    <p class="eyebrow">Account</p>
                    <h2>Login or create an account</h2>
                </div>
                <div class="forms-grid">
                    <form method="POST" class="auth-form">
                        <h3>Login</h3>
                        <label>Email address</label>
                        <input type="email" name="email" placeholder="you@example.com" required>
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" required>
                        <button type="submit" name="action" value="login">Login</button>
                    </form>
                    <form method="POST" class="auth-form">
                        <h3>Signup</h3>
                        <label>Full name</label>
                        <input type="text" name="name" placeholder="Your name" required>
                        <label>Email address</label>
                        <input type="email" name="email" placeholder="you@example.com" required>
                        <button type="submit" name="action" value="signup">Create Account</button>
                    </form>
                </div>
            </section>

            <aside class="cart-panel" id="cart">
                <p class="eyebrow">Order Summary</p>
                <h2>Your Cart</h2>
                <?php if (isset($_SESSION['customer_name'])): ?>
                    <p class="signed-in">Signed in as <?php echo htmlspecialchars($_SESSION['customer_name']); ?></p>
                <?php endif; ?>
                <div class="cart-stat">
                    <span>Items</span>
                    <strong><?php echo $cartCount; ?></strong>
                </div>
                <div class="cart-stat">
                    <span>Subtotal</span>
                    <strong>$<?php echo number_format($cartTotal, 2); ?></strong>
                </div>

                <div class="cart-items">
                    <?php if ($cartCount === 0): ?>
                        <p>Your cart is empty. Add a product to begin checkout.</p>
                    <?php endif; ?>

                    <?php foreach ($_SESSION['cart'] as $id => $quantity): ?>
                        <?php if (!isset($productById[(int) $id])) continue; ?>
                        <?php $cartProduct = $productById[(int) $id]; ?>
                        <div class="cart-item">
                            <img src="<?php echo htmlspecialchars($cartProduct['image']); ?>" alt="<?php echo htmlspecialchars($cartProduct['name']); ?>">
                            <div>
                                <strong><?php echo htmlspecialchars($cartProduct['name']); ?></strong>
                                <span>Qty <?php echo (int) $quantity; ?> · $<?php echo number_format($cartProduct['price'] * $quantity, 2); ?></span>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo (int) $id; ?>">
                                <button type="submit" name="action" value="remove_from_cart" aria-label="Remove <?php echo htmlspecialchars($cartProduct['name']); ?>">Remove</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button class="checkout-button" type="button" <?php echo $cartCount === 0 ? 'disabled' : ''; ?>>Proceed to Checkout</button>
                <p class="cart-note">Checkout is ready for integration with payment and delivery details.</p>
            </aside>
        </section>
    </main>

    <footer class="site-footer">
        <p>Resonance Market</p>
        <span>Professional PHP storefront for modern online shopping.</span>
    </footer>
</body>
</html>
