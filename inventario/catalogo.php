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
    <title>Catalogo de Repuestos</title>
    <style>
        :root {
            --bg: #101723;
            --panel: #172334;
            --panel-2: #1e2d44;
            --text: #f2f6fb;
            --muted: #a7b6ca;
            --accent: #2ec4b6;
            --danger: #ff6b6b;
            --line: rgba(255, 255, 255, 0.12);
            --ok: #42d392;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Segoe UI, Tahoma, sans-serif;
            background: radial-gradient(circle at top right, #22456f, #101723 50%);
            color: var(--text);
            min-height: 100vh;
            padding: 24px;
        }

        .layout {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 18px;
            align-items: start;
        }

        .catalog-box, .cart-box {
            background: linear-gradient(180deg, var(--panel), var(--panel-2));
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 18px 30px rgba(0, 0, 0, 0.22);
        }

        .catalog-box { padding: 18px; }

        h1 { margin: 0 0 8px; font-size: 1.8rem; }
        p { margin: 0; color: var(--muted); }

        .top-controls {
            margin-top: 16px;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 12px;
        }

        .top-controls input {
            width: 100%;
            padding: 11px 12px;
            border-radius: 10px;
            border: 1px solid var(--line);
            background: #101a2a;
            color: var(--text);
        }

        .filters, .tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 12px;
        }

        .chip {
            border: 1px solid var(--line);
            background: #122033;
            color: var(--text);
            border-radius: 999px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .chip.active {
            border-color: var(--accent);
            background: rgba(46, 196, 182, 0.15);
        }

        .grid {
            margin-top: 16px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
        }

        .card {
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
            background: #122033;
            display: flex;
            flex-direction: column;
        }

        .thumb {
            height: 160px;
            width: 100%;
            object-fit: cover;
            background: #0d1622;
        }

        .card-body {
            padding: 12px;
            display: grid;
            gap: 8px;
        }

        .code {
            font-size: 0.82rem;
            color: var(--muted);
        }

        .name {
            margin: 0;
            font-size: 1rem;
            min-height: 44px;
        }

        .meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .price {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--accent);
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            flex: 1;
            border: 0;
            border-radius: 8px;
            padding: 9px;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
        }

        .btn-view { background: #3a6ea5; }
        .btn-add { background: var(--ok); color: #052f24; }

        .empty {
            margin-top: 18px;
            border: 1px dashed var(--line);
            border-radius: 10px;
            padding: 18px;
            text-align: center;
            color: var(--muted);
        }

        .cart-box {
            position: sticky;
            top: 16px;
            padding: 14px;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
        }

        .cart-list {
            display: grid;
            gap: 10px;
            max-height: 420px;
            overflow: auto;
            padding-right: 4px;
        }

        .cart-item {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px;
            display: grid;
            gap: 6px;
            background: #122033;
        }

        .cart-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 0.92rem;
        }

        .remove {
            background: transparent;
            color: var(--danger);
            border: 1px solid rgba(255, 107, 107, 0.5);
            border-radius: 7px;
            cursor: pointer;
            padding: 6px 8px;
        }

        .cart-total {
            margin-top: 12px;
            border-top: 1px solid var(--line);
            padding-top: 12px;
            display: grid;
            gap: 8px;
        }

        .clear-btn {
            border: 1px solid rgba(255, 107, 107, 0.5);
            color: var(--danger);
            background: transparent;
            border-radius: 8px;
            padding: 8px;
            cursor: pointer;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.72);
            display: none;
            place-items: center;
            padding: 18px;
            z-index: 20;
        }

        .modal.open { display: grid; }

        .modal-card {
            width: min(800px, 100%);
            background: #162438;
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .modal-image {
            width: 100%;
            height: 100%;
            min-height: 290px;
            object-fit: cover;
            background: #0d1622;
        }

        .modal-info { padding: 16px; display: grid; gap: 12px; }

        .close {
            background: transparent;
            color: #fff;
            border: 1px solid var(--line);
            border-radius: 8px;
            cursor: pointer;
            padding: 7px 10px;
            justify-self: end;
        }

        @media (max-width: 1100px) {
            .layout { grid-template-columns: 1fr; }
            .cart-box { position: static; }
        }

        @media (max-width: 760px) {
            .top-controls { grid-template-columns: 1fr; }
            .modal-card { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <main class="catalog-box">
            <h1>Catalogo de Repuestos</h1>
            <p>Carrito activo, precios en pesos colombianos e imagenes al abrir cada producto.</p>

            <div class="top-controls">
                <input id="searchInput" type="text" placeholder="Buscar por nombre o codigo">
                <div class="filters" id="filterButtons">
                    <button class="chip active" data-filter="all">Todos</button>
                    <button class="chip" data-filter="stock">En stock</button>
                    <button class="chip" data-filter="low">Poco stock</button>
                    <button class="chip" data-filter="price-low">Menor precio</button>
                    <button class="chip" data-filter="price-high">Mayor precio</button>
                </div>
            </div>

            <div class="tabs" id="categoryTabs"></div>
            <section class="grid" id="catalogGrid"></section>
            <div id="emptyState" class="empty" style="display:none;">No hay productos para esos filtros.</div>
        </main>

        <aside class="cart-box">
            <div class="cart-header">
                <h2>Carrito</h2>
                <span id="cartCount">0 items</span>
            </div>
            <div id="cartList" class="cart-list"></div>
            <div class="cart-total">
                <div class="cart-row"><strong>Total</strong><strong id="cartTotal">$0</strong></div>
                <button id="clearCart" class="clear-btn">Vaciar carrito</button>
            </div>
        </aside>
    </div>

    <div id="productModal" class="modal" aria-hidden="true">
        <div class="modal-card">
            <img id="modalImage" class="modal-image" alt="Producto">
            <div class="modal-info">
                <button id="closeModal" class="close">Cerrar</button>
                <div id="modalCode" class="code"></div>
                <h3 id="modalName"></h3>
                <div id="modalCategory" class="code"></div>
                <div id="modalStock" class="code"></div>
                <div id="modalPrice" class="price"></div>
                <button id="modalAdd" class="btn btn-add">Agregar al carrito</button>
            </div>
        </div>
    </div>

    <script>
        const COP_RATE = 4000;
        const catalogo = <?php echo json_encode($catalogo, JSON_UNESCAPED_UNICODE); ?>;

        let activeCategory = "all";
        let activeFilter = "all";
        let searchTerm = "";
        let selectedCode = null;
        let cart = JSON.parse(localStorage.getItem("cart_kapy") || "{}");

        const categoryIcons = {
            "Transmision": "[TR]",
            "Suspension": "[SU]",
            "Motor": "[MO]",
            "Electrico": "[EL]",
            "Frenos": "[FR]",
            "Accesorios": "[AC]"
        };

        function imageFor(item) {
            return `https://picsum.photos/seed/${encodeURIComponent(item.codigo)}/640/420`;
        }

        function toCop(basePrice) {
            return Math.round(basePrice * COP_RATE);
        }

        function formatCop(value) {
            return new Intl.NumberFormat("es-CO", {
                style: "currency",
                currency: "COP",
                maximumFractionDigits: 0
            }).format(value);
        }

        function getItems() {
            const list = [];
            Object.keys(catalogo).forEach((categoria) => {
                catalogo[categoria].forEach((item) => {
                    list.push({ ...item, categoria, precioCop: toCop(item.precio) });
                });
            });
            return list;
        }

        function findByCode(code) {
            return getItems().find((item) => item.codigo === code) || null;
        }

        function renderTabs() {
            const tabs = document.getElementById("categoryTabs");
            tabs.innerHTML = "";
            const allBtn = document.createElement("button");
            allBtn.className = `chip ${activeCategory === "all" ? "active" : ""}`;
            allBtn.dataset.category = "all";
            allBtn.textContent = "Todos";
            tabs.appendChild(allBtn);

            Object.keys(catalogo).forEach((cat) => {
                const btn = document.createElement("button");
                btn.className = `chip ${activeCategory === cat ? "active" : ""}`;
                btn.dataset.category = cat;
                btn.textContent = `${categoryIcons[cat] || ""} ${cat}`.trim();
                tabs.appendChild(btn);
            });
        }

        function filteredItems() {
            let items = getItems();

            if (activeCategory !== "all") {
                items = items.filter((item) => item.categoria === activeCategory);
            }

            if (searchTerm) {
                const term = searchTerm.toLowerCase();
                items = items.filter((item) =>
                    item.nombre.toLowerCase().includes(term) || item.codigo.toLowerCase().includes(term)
                );
            }

            if (activeFilter === "stock") items = items.filter((item) => item.stock > 5);
            if (activeFilter === "low") items = items.filter((item) => item.stock <= 5);
            if (activeFilter === "price-low") items = items.sort((a, b) => a.precioCop - b.precioCop);
            if (activeFilter === "price-high") items = items.sort((a, b) => b.precioCop - a.precioCop);

            return items;
        }

        function renderCatalog() {
            const grid = document.getElementById("catalogGrid");
            const empty = document.getElementById("emptyState");
            const items = filteredItems();

            if (!items.length) {
                grid.innerHTML = "";
                empty.style.display = "block";
                return;
            }

            empty.style.display = "none";
            grid.innerHTML = items.map((item) => {
                return `
                    <article class="card">
                        <img class="thumb" src="${imageFor(item)}" alt="${item.nombre}">
                        <div class="card-body">
                            <div class="code">${item.codigo}</div>
                            <h3 class="name">${item.nombre}</h3>
                            <div class="meta">
                                <span>Stock: ${item.stock}</span>
                                <strong class="price">${formatCop(item.precioCop)}</strong>
                            </div>
                            <div class="actions">
                                <button class="btn btn-view" data-action="view" data-code="${item.codigo}">Ver</button>
                                <button class="btn btn-add" data-action="add" data-code="${item.codigo}">Agregar</button>
                            </div>
                        </div>
                    </article>
                `;
            }).join("");
        }

        function saveCart() {
            localStorage.setItem("cart_kapy", JSON.stringify(cart));
        }

        function addToCart(code) {
            const item = findByCode(code);
            if (!item) return;

            if (!cart[code]) {
                cart[code] = {
                    codigo: item.codigo,
                    nombre: item.nombre,
                    precioCop: item.precioCop,
                    qty: 0
                };
            }
            cart[code].qty += 1;
            saveCart();
            renderCart();
        }

        function removeFromCart(code) {
            delete cart[code];
            saveCart();
            renderCart();
        }

        function clearCart() {
            cart = {};
            saveCart();
            renderCart();
        }

        function renderCart() {
            const list = document.getElementById("cartList");
            const count = document.getElementById("cartCount");
            const total = document.getElementById("cartTotal");
            const entries = Object.values(cart);

            const totalQty = entries.reduce((acc, item) => acc + item.qty, 0);
            const totalCop = entries.reduce((acc, item) => acc + item.qty * item.precioCop, 0);

            count.textContent = `${totalQty} item${totalQty === 1 ? "" : "s"}`;
            total.textContent = formatCop(totalCop);

            if (!entries.length) {
                list.innerHTML = '<div class="empty">Tu carrito esta vacio.</div>';
                return;
            }

            list.innerHTML = entries.map((item) => `
                <div class="cart-item">
                    <div class="cart-row"><strong>${item.nombre}</strong></div>
                    <div class="cart-row"><span>${item.qty} x ${formatCop(item.precioCop)}</span><strong>${formatCop(item.qty * item.precioCop)}</strong></div>
                    <button class="remove" data-action="remove" data-code="${item.codigo}">Quitar</button>
                </div>
            `).join("");
        }

        function openModal(code) {
            const item = findByCode(code);
            if (!item) return;

            selectedCode = code;
            document.getElementById("modalImage").src = imageFor(item);
            document.getElementById("modalCode").textContent = item.codigo;
            document.getElementById("modalName").textContent = item.nombre;
            document.getElementById("modalCategory").textContent = `Categoria: ${item.categoria}`;
            document.getElementById("modalStock").textContent = `Stock: ${item.stock}`;
            document.getElementById("modalPrice").textContent = formatCop(item.precioCop);
            document.getElementById("productModal").classList.add("open");
        }

        function closeModal() {
            document.getElementById("productModal").classList.remove("open");
        }

        function bindEvents() {
            document.getElementById("searchInput").addEventListener("input", (event) => {
                searchTerm = event.target.value.trim();
                renderCatalog();
            });

            document.getElementById("filterButtons").addEventListener("click", (event) => {
                const btn = event.target.closest("[data-filter]");
                if (!btn) return;
                activeFilter = btn.dataset.filter;
                document.querySelectorAll("#filterButtons .chip").forEach((node) => node.classList.remove("active"));
                btn.classList.add("active");
                renderCatalog();
            });

            document.getElementById("categoryTabs").addEventListener("click", (event) => {
                const btn = event.target.closest("[data-category]");
                if (!btn) return;
                activeCategory = btn.dataset.category;
                renderTabs();
                renderCatalog();
            });

            document.getElementById("catalogGrid").addEventListener("click", (event) => {
                const btn = event.target.closest("[data-action]");
                if (!btn) return;
                const code = btn.dataset.code;
                if (btn.dataset.action === "view") openModal(code);
                if (btn.dataset.action === "add") addToCart(code);
            });

            document.getElementById("cartList").addEventListener("click", (event) => {
                const btn = event.target.closest("[data-action='remove']");
                if (!btn) return;
                removeFromCart(btn.dataset.code);
            });

            document.getElementById("clearCart").addEventListener("click", clearCart);
            document.getElementById("closeModal").addEventListener("click", closeModal);
            document.getElementById("modalAdd").addEventListener("click", () => {
                if (selectedCode) addToCart(selectedCode);
            });

            document.getElementById("productModal").addEventListener("click", (event) => {
                if (event.target.id === "productModal") closeModal();
            });
        }

        function init() {
            renderTabs();
            renderCatalog();
            renderCart();
            bindEvents();
        }

        document.addEventListener("DOMContentLoaded", init);
    </script>
</body>
</html>
