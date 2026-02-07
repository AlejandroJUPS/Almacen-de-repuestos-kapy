<?php
$catalogo = [
    "Transmision" => [
        ["codigo" => "P001137", "nombre" => "Ajustador Cadena Traccion Gen 125", "precio" => 24.50, "stock" => 15],
        ["codigo" => "P001133", "nombre" => "Ajustador de Cadena CG-125", "precio" => 18.75, "stock" => 22],
        ["codigo" => "P001100", "nombre" => "Cadena Traccion 428H-136L", "precio" => 32.90, "stock" => 8],
        ["codigo" => "P001104", "nombre" => "Cadena Traccion 520H-120L", "precio" => 45.25, "stock" => 12],
        ["codigo" => "P020043", "nombre" => "Rear Sprocket AKT 150 520-39T", "precio" => 28.40, "stock" => 5]
    ],

    "Suspension" => [
        ["codigo" => "P002696", "nombre" => "Amortiguador Trasero Boxer BM100", "precio" => 42.80, "stock" => 7],
        ["codigo" => "P002723", "nombre" => "Amortiguador Trasero Negro XL-125R", "precio" => 38.90, "stock" => 14],
        ["codigo" => "P002764", "nombre" => "Amortiguador Trasero YBR125 (Set)", "precio" => 67.50, "stock" => 3],
        ["codigo" => "P007343", "nombre" => "Barra de Suspension CG / Serpento", "precio" => 22.30, "stock" => 19]
    ],

    "Motor" => [
        ["codigo" => "P003597", "nombre" => "Anillos CG-125 STD 56.5MM", "precio" => 12.40, "stock" => 25],
        ["codigo" => "P005248", "nombre" => "Arbol de Leva CG-125", "precio" => 84.60, "stock" => 6],
        ["codigo" => "P011016", "nombre" => "Carburador Pulsar 180", "precio" => 112.80, "stock" => 4],
        ["codigo" => "S000598", "nombre" => "Cilindro Completo CY-200", "precio" => 156.90, "stock" => 2]
    ],

    "Electrico" => [
        ["codigo" => "P001648", "nombre" => "Bateria YTX5L", "precio" => 68.50, "stock" => 9],
        ["codigo" => "P005510", "nombre" => "Bobina Inferior GXT 200", "precio" => 34.20, "stock" => 11],
        ["codigo" => "P001589", "nombre" => "CDI CG 200", "precio" => 41.80, "stock" => 13],
        ["codigo" => "P010720", "nombre" => "Motor de Arranque XR 150L", "precio" => 97.30, "stock" => 5]
    ],

    "Frenos" => [
        ["codigo" => "P001823", "nombre" => "Pastilla de Freno 125/CA-250", "precio" => 14.90, "stock" => 28],
        ["codigo" => "P001840", "nombre" => "Pastillas Pulsar NS 200 Delanteras", "precio" => 19.75, "stock" => 16],
        ["codigo" => "P014830", "nombre" => "Bomba de Freno Trasero Pulsar 200", "precio" => 52.40, "stock" => 7]
    ],

    "Accesorios" => [
        ["codigo" => "P001500", "nombre" => "Espejo Retrovisor Universal", "precio" => 16.50, "stock" => 32],
        ["codigo" => "P011972", "nombre" => "Careta con Foco Pulsar 180 Azul", "precio" => 89.90, "stock" => 8],
        ["codigo" => "P002460", "nombre" => "Malla para Casco", "precio" => 8.25, "stock" => 45]
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de Repuestos Interactivo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root {
            --primary: #2d3e50;
            --secondary: #e74c3c;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #1a2530;
            --success: #27ae60;
            --warning: #f39c12;
            --shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 10px;
        }

        body {
            background: linear-gradient(135deg, #1a2530 0%, #2d3e50 100%);
            color: var(--light);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideDown 0.8s ease;
        }

        .header h1 {
            color: var(--light);
            margin-bottom: 10px;
            font-size: 2.5rem;
            background: linear-gradient(90deg, var(--accent), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            display: inline-block;
        }

        .header p {
            color: #bdc3c7;
            font-size: 1.1rem;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
            animation: fadeIn 1s ease;
        }

        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 15px 20px 15px 50px;
            border: none;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--light);
            font-size: 1rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: var(--transition);
        }

        .search-box input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--accent);
            background: rgba(255, 255, 255, 0.15);
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            font-size: 1.2rem;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 12px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--light);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
            backdrop-filter: blur(5px);
        }

        .filter-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-3px);
        }

        .filter-btn.active {
            background: linear-gradient(90deg, var(--accent), var(--secondary));
            color: white;
            box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
        }

        .category-tabs {
            display: flex;
            overflow-x: auto;
            gap: 10px;
            margin-bottom: 30px;
            padding-bottom: 10px;
            animation: fadeIn 1.2s ease;
        }

        .category-tabs::-webkit-scrollbar {
            height: 6px;
        }

        .category-tabs::-webkit-scrollbar-thumb {
            background: var(--accent);
            border-radius: 10px;
        }

        .tab {
            padding: 15px 25px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            white-space: nowrap;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tab:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-5px);
        }

        .tab.active {
            background: linear-gradient(135deg, var(--accent), #8e44ad);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }

        .tab i {
            font-size: 1.2rem;
        }

        .catalog-content {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            animation: fadeIn 1.5s ease;
        }

        .item-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            padding: 25px;
            transition: var(--transition);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
        }

        .item-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
        }

        .item-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--accent), var(--secondary));
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .item-code {
            background: rgba(52, 152, 219, 0.2);
            color: var(--accent);
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .item-stock {
            font-size: 0.9rem;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: 600;
        }

        .in-stock {
            background: rgba(39, 174, 96, 0.2);
            color: var(--success);
        }

        .low-stock {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .item-name {
            font-size: 1.3rem;
            margin-bottom: 15px;
            line-height: 1.4;
            font-weight: 600;
        }

        .item-details {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .item-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--light);
        }

        .item-actions {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-view {
            background: rgba(52, 152, 219, 0.2);
            color: var(--accent);
        }

        .btn-cart {
            background: linear-gradient(90deg, var(--secondary), #c0392b);
            color: white;
        }

        .action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 60px 20px;
            color: #95a5a6;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 20px;
            color: #7f8c8d;
        }

        .category-header {
            grid-column: 1 / -1;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
            padding: 20px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            border-left: 5px solid var(--accent);
        }

        .category-title {
            font-size: 1.8rem;
            font-weight: 700;
        }

        .category-count {
            background: var(--accent);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @media (max-width: 768px) {
            .catalog-content {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .controls {
                flex-direction: column;
            }

            .search-box {
                min-width: 100%;
            }

            .header h1 {
                font-size: 2rem;
            }
        }

        .cart-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(90deg, var(--success), #2ecc71);
            color: white;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: var(--transition);
        }

        .cart-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .cart-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(90deg, var(--secondary), #c0392b);
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            z-index: 1000;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .cart-button:hover {
            transform: translateY(-3px);
        }

        .cart-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 2px 8px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.85rem;
        }

        .cart-panel {
            position: fixed;
            top: 0;
            right: 0;
            width: 380px;
            height: 100vh;
            background: rgba(26, 37, 48, 0.98);
            border-left: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: -8px 0 20px rgba(0, 0, 0, 0.3);
            transform: translateX(100%);
            transition: var(--transition);
            z-index: 1001;
            display: flex;
            flex-direction: column;
        }

        .cart-panel.open {
            transform: translateX(0);
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cart-header h2 {
            font-size: 1.3rem;
        }

        .cart-close {
            background: transparent;
            border: none;
            color: var(--light);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .cart-items {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .cart-item {
            background: rgba(255, 255, 255, 0.06);
            border-radius: var(--border-radius);
            padding: 12px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .cart-item-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .cart-item-meta {
            color: #bdc3c7;
            font-size: 0.9rem;
        }

        .cart-item-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--light);
            padding: 4px 8px;
            border-radius: 6px;
            cursor: pointer;
        }

        .remove-btn {
            background: rgba(231, 76, 60, 0.2);
            border: none;
            color: #e74c3c;
            padding: 6px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .cart-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .cart-clear {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--light);
            padding: 10px 12px;
            border-radius: 8px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .cart-panel {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-motorcycle"></i> Catalogo de Repuestos</h1>
            <p>Encuentra los repuestos para tu moto con navegacion intuitiva y diseno moderno</p>
        </div>

        <div class="controls">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchInput" placeholder="Buscar por nombre o codigo...">
            </div>

            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Todos</button>
                <button class="filter-btn" data-filter="stock">En Stock</button>
                <button class="filter-btn" data-filter="low">Poco Stock</button>
                <button class="filter-btn" data-filter="price-low">Menor Precio</button>
                <button class="filter-btn" data-filter="price-high">Mayor Precio</button>
            </div>
        </div>

        <div class="category-tabs" id="categoryTabs"></div>
        <div class="catalog-content" id="catalogContent"></div>
    </div>

    <button class="cart-button" id="cartButton">
        <i class="fas fa-shopping-cart"></i>
        Carrito <span class="cart-count" id="cartCount">0</span>
    </button>

    <aside class="cart-panel" id="cartPanel">
        <div class="cart-header">
            <h2><i class="fas fa-shopping-basket"></i> Tu carrito</h2>
            <button class="cart-close" id="cartClose"><i class="fas fa-times"></i></button>
        </div>
        <div class="cart-items" id="cartItems"></div>
        <div class="cart-footer">
            <div class="cart-total">
                <span>Total</span>
                <span id="cartTotal">$0.00</span>
            </div>
            <button class="cart-clear" id="cartClear">Vaciar carrito</button>
        </div>
    </aside>

    <div class="cart-notification" id="cartNotification">
        <i class="fas fa-check-circle"></i>
        <span id="notificationText">Producto agregado al carrito</span>
    </div>

    <script>
        const catalogo = <?php echo json_encode($catalogo); ?>;
        let currentCategory = 'all';
        let currentFilter = 'all';
        let searchTerm = '';

        const CART_KEY = 'repuestos_cart';
        let cart = {};

        const productMap = (() => {
            const map = {};
            Object.keys(catalogo).forEach(category => {
                catalogo[category].forEach(item => {
                    map[item.codigo] = { ...item, categoria: category };
                });
            });
            return map;
        })();

        const categoryIcons = {
            "Transmision": "fas fa-cogs",
            "Suspension": "fas fa-car-bump",
            "Motor": "fas fa-engine",
            "Electrico": "fas fa-bolt",
            "Frenos": "fas fa-stop-circle",
            "Accesorios": "fas fa-tools"
        };

        const categoryColors = {
            "Transmision": "#3498db",
            "Suspension": "#9b59b6",
            "Motor": "#e74c3c",
            "Electrico": "#f1c40f",
            "Frenos": "#2ecc71",
            "Accesorios": "#e67e22"
        };

        function renderCategoryTabs() {
            const container = document.getElementById('categoryTabs');
            container.innerHTML = '';

            const allTab = document.createElement('div');
            allTab.className = `tab ${currentCategory === 'all' ? 'active' : ''}`;
            allTab.innerHTML = `<i class="fas fa-th-large"></i> Todos`;
            allTab.dataset.category = 'all';
            allTab.addEventListener('click', () => setActiveCategory('all'));
            container.appendChild(allTab);

            Object.keys(catalogo).forEach(category => {
                const tab = document.createElement('div');
                tab.className = `tab ${currentCategory === category ? 'active' : ''}`;
                tab.innerHTML = `<i class="${categoryIcons[category]}"></i> ${category}`;
                tab.dataset.category = category;
                tab.style.borderLeft = `3px solid ${categoryColors[category]}`;
                tab.addEventListener('click', () => setActiveCategory(category));
                container.appendChild(tab);
            });
        }

        function setActiveCategory(category) {
            currentCategory = category;
            renderCategoryTabs();
            renderCatalog();
        }

        function applyFilter(filter) {
            currentFilter = filter;
            renderCatalog();
        }

        function filterItems() {
            let items = [];

            if (currentCategory === 'all') {
                Object.keys(catalogo).forEach(category => {
                    items = items.concat(catalogo[category].map(item => ({...item, categoria: category})));
                });
            } else {
                items = catalogo[currentCategory].map(item => ({...item, categoria: currentCategory}));
            }

            if (searchTerm) {
                const term = searchTerm.toLowerCase();
                items = items.filter(item =>
                    item.nombre.toLowerCase().includes(term) ||
                    item.codigo.toLowerCase().includes(term)
                );
            }

            switch(currentFilter) {
                case 'stock':
                    items = items.filter(item => item.stock > 5);
                    break;
                case 'low':
                    items = items.filter(item => item.stock <= 5);
                    break;
                case 'price-low':
                    items.sort((a, b) => a.precio - b.precio);
                    break;
                case 'price-high':
                    items.sort((a, b) => b.precio - a.precio);
                    break;
                default:
                    break;
            }

            return items;
        }

        function formatPrice(price) {
            return new Intl.NumberFormat('es-ES', {
                style: 'currency',
                currency: 'USD'
            }).format(price);
        }

        function showNotification(message) {
            const notification = document.getElementById('cartNotification');
            const notificationText = document.getElementById('notificationText');

            notificationText.textContent = message;
            notification.classList.add('show');

            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        function loadCart() {
            try {
                const raw = localStorage.getItem(CART_KEY);
                cart = raw ? JSON.parse(raw) : {};
            } catch (e) {
                cart = {};
            }
        }

        function saveCart() {
            localStorage.setItem(CART_KEY, JSON.stringify(cart));
        }

        function updateCartUI() {
            const itemsContainer = document.getElementById('cartItems');
            const totalEl = document.getElementById('cartTotal');
            const countEl = document.getElementById('cartCount');

            itemsContainer.innerHTML = '';
            let total = 0;
            let count = 0;

            const codes = Object.keys(cart);
            if (codes.length === 0) {
                itemsContainer.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-shopping-basket"></i>
                        <h3>Carrito vacio</h3>
                        <p>Agrega productos desde el catalogo</p>
                    </div>
                `;
            } else {
                codes.forEach(code => {
                    const item = cart[code];
                    const lineTotal = item.precio * item.qty;
                    total += lineTotal;
                    count += item.qty;

                    const row = document.createElement('div');
                    row.className = 'cart-item';
                    row.innerHTML = `
                        <div>
                            <div class="cart-item-title">${item.nombre}</div>
                            <div class="cart-item-meta">${item.codigo} · ${formatPrice(item.precio)}</div>
                        </div>
                        <div class="cart-item-actions">
                            <button class="qty-btn" onclick="changeQty('${code}', -1)">-</button>
                            <span>${item.qty}</span>
                            <button class="qty-btn" onclick="changeQty('${code}', 1)">+</button>
                            <button class="remove-btn" onclick="removeFromCart('${code}')">Quitar</button>
                        </div>
                    `;
                    itemsContainer.appendChild(row);
                });
            }

            totalEl.textContent = formatPrice(total);
            countEl.textContent = count.toString();
        }

        function addToCart(code) {
            const item = productMap[code];
            if (!item) return;

            if (!cart[code]) {
                cart[code] = {
                    codigo: item.codigo,
                    nombre: item.nombre,
                    precio: item.precio,
                    qty: 1
                };
            } else {
                cart[code].qty += 1;
            }

            saveCart();
            updateCartUI();
            showNotification(`${item.nombre} agregado al carrito`);
        }

        function changeQty(code, delta) {
            if (!cart[code]) return;
            cart[code].qty += delta;
            if (cart[code].qty <= 0) {
                delete cart[code];
            }
            saveCart();
            updateCartUI();
        }

        function removeFromCart(code) {
            if (!cart[code]) return;
            delete cart[code];
            saveCart();
            updateCartUI();
        }

        function renderCatalog() {
            const container = document.getElementById('catalogContent');
            const items = filterItems();

            container.innerHTML = '';

            if (items.length === 0) {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.innerHTML = `
                    <i class="fas fa-search"></i>
                    <h2>No se encontraron productos</h2>
                    <p>Intenta con otros terminos de busqueda o filtros</p>
                `;
                container.appendChild(emptyState);
                return;
            }

            if (currentCategory === 'all') {
                const categories = [...new Set(items.map(item => item.categoria))];

                categories.forEach(category => {
                    const categoryItems = items.filter(item => item.categoria === category);

                    const categoryHeader = document.createElement('div');
                    categoryHeader.className = 'category-header';
                    categoryHeader.dataset.category = category;
                    categoryHeader.style.borderLeftColor = categoryColors[category];

                    categoryHeader.innerHTML = `
                        <div class="category-title">
                            <i class="${categoryIcons[category]}"></i> ${category}
                        </div>
                        <div class="category-count">${categoryItems.length} productos</div>
                    `;

                    container.appendChild(categoryHeader);
                    renderItems(categoryItems, container);
                });
            } else {
                renderItems(items, container);
            }
        }

        function renderItems(items, container) {
            items.forEach(item => {
                const card = document.createElement('div');
                card.className = 'item-card';

                const stockClass = item.stock > 10 ? 'in-stock' : 'low-stock';
                const stockText = item.stock > 10 ? 'Disponible' : 'Poco Stock';

                card.innerHTML = `
                    <div class="item-header">
                        <div class="item-code">${item.codigo}</div>
                        <div class="item-stock ${stockClass}">${stockText} (${item.stock})</div>
                    </div>
                    <div class="item-name">${item.nombre}</div>
                    <div class="item-details">
                        <div class="item-price">${formatPrice(item.precio)}</div>
                        <div class="item-actions">
                            <button class="action-btn btn-view" onclick="viewItem('${item.codigo}')">
                                <i class="fas fa-eye"></i> Ver
                            </button>
                            <button class="action-btn btn-cart" onclick="addToCart('${item.codigo}')">
                                <i class="fas fa-cart-plus"></i> Agregar
                            </button>
                        </div>
                    </div>
                `;

                container.appendChild(card);
            });
        }

        function viewItem(code) {
            showNotification(`Viendo detalles del producto ${code}`);
        }

        function initEvents() {
            document.getElementById('searchInput').addEventListener('input', (e) => {
                searchTerm = e.target.value;
                renderCatalog();
            });

            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                    e.target.classList.add('active');
                    applyFilter(e.target.dataset.filter);
                });
            });

            document.getElementById('cartButton').addEventListener('click', () => {
                document.getElementById('cartPanel').classList.add('open');
            });

            document.getElementById('cartClose').addEventListener('click', () => {
                document.getElementById('cartPanel').classList.remove('open');
            });

            document.getElementById('cartClear').addEventListener('click', () => {
                cart = {};
                saveCart();
                updateCartUI();
            });
        }

        function initApp() {
            loadCart();
            updateCartUI();
            renderCategoryTabs();
            renderCatalog();
            initEvents();
        }

        document.addEventListener('DOMContentLoaded', initApp);
    </script>
</body>
</html>
