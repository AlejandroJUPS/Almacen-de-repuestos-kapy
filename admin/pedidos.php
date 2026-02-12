<?php
include("../config/db.php");

if (!isset($_SESSION['admin'])) {
    die("No autorizado");
}

$allowedEstados = ['pendiente', 'procesando', 'completado'];

// Obtener pedidos con opciÛn de filtrado
$filtro_estado = $_GET['estado'] ?? 'todos';
if ($filtro_estado !== 'todos' && !in_array($filtro_estado, $allowedEstados, true)) {
    $filtro_estado = 'todos';
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

// Procesar actualizaciÛn de estado si se enviÛ el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['actualizar_estado'])) {
    $id_pedido = (int)($_POST['id_pedido'] ?? 0);
    $nuevo_estado = $_POST['nuevo_estado'] ?? '';
    $token = $_POST['csrf_token'] ?? '';

    if (!hash_equals($csrf_token, $token)) {
        die("Token inv·lido");
    }

    if ($id_pedido > 0 && in_array($nuevo_estado, $allowedEstados, true)) {
        $stmt = $conn->prepare("UPDATE pedidos SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $nuevo_estado, $id_pedido);
        $stmt->execute();
        $stmt->close();
    }
    
    // Redirigir para evitar reenvÌo del formulario
    header("Location: " . $_SERVER['PHP_SELF'] . "?estado=" . urlencode($filtro_estado));
    exit();
}

if ($filtro_estado === 'todos') {
    $r = $conn->query("SELECT * FROM pedidos ORDER BY fecha DESC");
} else {
    $stmt = $conn->prepare("SELECT * FROM pedidos WHERE estado = ? ORDER BY fecha DESC");
    $stmt->bind_param("s", $filtro_estado);
    $stmt->execute();
    $r = $stmt->get_result();
    $stmt->close();
}

// Obtener estadÌsticas para el dashboard
$stats = $conn->query("SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN estado = 'pendiente' THEN 1 ELSE 0 END) as pendientes,
    SUM(CASE WHEN estado = 'procesando' THEN 1 ELSE 0 END) as procesando,
    SUM(CASE WHEN estado = 'completado' THEN 1 ELSE 0 END) as completados
    FROM pedidos")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pedidos - Administraci√≥n</title>
    <link rel="stylesheet" href="/assets/css/dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3a0ca3;
            --success: #4cc9f0;
            --warning: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 10px;
            --shadow: 0 4px 6px rgba(0,0,0,0.1);
            --transition: all 0.3s ease;
        }

        body {
            background-color: #121212;
            color: #e0e0e0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }

        h1 {
            color: #4cc9f0;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border-left: 5px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .stat-card.pendientes {
            border-left-color: #f72585;
        }

        .stat-card.procesando {
            border-left-color: #ff9e00;
        }

        .stat-card.completados {
            border-left-color: #4cc9f0;
        }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 10px 0;
        }

        .stat-card .stat-label {
            color: #aaa;
            font-size: 0.9rem;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
            background: #1e1e1e;
            padding: 20px;
            border-radius: var(--border-radius);
        }

        .filters {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 20px;
            background-color: #2a2a2a;
            color: #e0e0e0;
            cursor: pointer;
            transition: var(--transition);
        }

        .filter-btn.active {
            background-color: var(--primary);
            color: white;
        }

        .filter-btn:hover {
            background-color: #3a3a3a;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #2a2a2a;
            border-radius: 20px;
            padding: 8px 15px;
        }

        .search-box input {
            background: transparent;
            border: none;
            color: #e0e0e0;
            padding: 5px 10px;
            width: 200px;
        }

        .search-box input:focus {
            outline: none;
        }

        .pedidos-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 25px;
        }

        .pedido-card {
            background: linear-gradient(145deg, #1e1e1e, #2a2a2a);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .pedido-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .pedido-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
        }

        .pedido-card.pendiente::before {
            background-color: #f72585;
        }

        .pedido-card.procesando::before {
            background-color: #ff9e00;
        }

        .pedido-card.completado::before {
            background-color: #4cc9f0;
        }

        .pedido-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .cliente-info h3 {
            margin: 0 0 5px 0;
            color: #4cc9f0;
        }

        .cliente-info .telefono {
            color: #aaa;
            font-size: 0.9rem;
        }

        .fecha {
            background-color: #3a0ca3;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
        }

        .detalle-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid #333;
        }

        .detalle-item:last-child {
            border-bottom: none;
        }

        .detalle-label {
            color: #aaa;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 5px;
        }

        .detalle-valor {
            color: #e0e0e0;
            font-weight: 500;
        }

        .mensaje {
            background-color: #2a2a2a;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            border-left: 3px solid #3a0ca3;
        }

        .mensaje-label {
            color: #aaa;
            font-size: 0.9rem;
            margin-bottom: 8px;
            display: block;
        }

        .estado-control {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #333;
        }

        .estado-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .estado-pendiente {
            background-color: rgba(247, 37, 133, 0.2);
            color: #f72585;
        }

        .estado-procesando {
            background-color: rgba(255, 158, 0, 0.2);
            color: #ff9e00;
        }

        .estado-completado {
            background-color: rgba(76, 201, 240, 0.2);
            color: #4cc9f0;
        }

        .estado-form {
            display: flex;
            gap: 10px;
        }

        .estado-select {
            background-color: #2a2a2a;
            color: #e0e0e0;
            border: 1px solid #444;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .btn-actualizar {
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 15px;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn-actualizar:hover {
            background-color: #3a0ca3;
        }

        .empty-state {
            text-align: center;
            padding: 50px 20px;
            color: #777;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 20px;
            color: #444;
        }

        @media (max-width: 768px) {
            .pedidos-container {
                grid-template-columns: 1fr;
            }
            
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-motorcycle"></i> Panel de Pedidos</h1>
            <div class="user-info">
                <span class="muted">Administrador</span>
            </div>
        </div>

        <!-- Dashboard de estad√≠sticas -->
        <div class="dashboard-cards">
            <div class="stat-card">
                <div class="stat-label">Total de Pedidos</div>
                <div class="stat-value"><?php echo $stats['total']; ?></div>
                <div class="stat-desc">Todos los pedidos recibidos</div>
            </div>
            
            <div class="stat-card pendientes">
                <div class="stat-label">Pendientes</div>
                <div class="stat-value"><?php echo $stats['pendientes']; ?></div>
                <div class="stat-desc">Requieren atenci√≥n</div>
            </div>
            
            <div class="stat-card procesando">
                <div class="stat-label">En Proceso</div>
                <div class="stat-value"><?php echo $stats['procesando']; ?></div>
                <div class="stat-desc">En preparaci√≥n</div>
            </div>
            
            <div class="stat-card completados">
                <div class="stat-label">Completados</div>
                <div class="stat-value"><?php echo $stats['completados']; ?></div>
                <div class="stat-desc">Entregados/finalizados</div>
            </div>
        </div>

        <!-- Controles de filtro y b√∫squeda -->
        <div class="controls">
            <div class="filters">
                <button class="filter-btn <?php echo $filtro_estado == 'todos' ? 'active' : ''; ?>" onclick="filtrar('todos')">
                    Todos (<?php echo $stats['total']; ?>)
                </button>
                <button class="filter-btn <?php echo $filtro_estado == 'pendiente' ? 'active' : ''; ?>" onclick="filtrar('pendiente')">
                    Pendientes (<?php echo $stats['pendientes']; ?>)
                </button>
                <button class="filter-btn <?php echo $filtro_estado == 'procesando' ? 'active' : ''; ?>" onclick="filtrar('procesando')">
                    En Proceso (<?php echo $stats['procesando']; ?>)
                </button>
                <button class="filter-btn <?php echo $filtro_estado == 'completado' ? 'active' : ''; ?>" onclick="filtrar('completado')">
                    Completados (<?php echo $stats['completados']; ?>)
                </button>
            </div>
            
            <div class="search-box">
                <i class="fas fa-search muted" style="margin-right: 8px;"></i>
                <input type="text" id="searchInput" placeholder="Buscar por cliente, modelo o repuesto..." onkeyup="buscarPedidos()">
            </div>
        </div>

        <!-- Lista de pedidos -->
        <div class="pedidos-container" id="pedidosList">
            <?php if($r->num_rows > 0): ?>
                <?php while($p = $r->fetch_assoc()): 
                    // Determinar clase de estado
                    $estado = isset($p['estado']) ? $p['estado'] : 'pendiente';
                    $estado_clase = $estado;
                    $estado_texto = ucfirst($estado);
                    
                    // Formatear fecha
                    $fecha_formateada = date('d/m/Y H:i', strtotime($p['fecha']));
                ?>
                <div class="pedido-card <?php echo $estado_clase; ?>">
                    <div class="pedido-header">
                        <div class="cliente-info">
                            <h3><?php echo htmlspecialchars($p['nombre']); ?></h3>
                            <div class="telefono">
                                <i class="fas fa-phone"></i> <?php echo htmlspecialchars($p['telefono']); ?>
                            </div>
                        </div>
                        <div class="fecha"><?php echo $fecha_formateada; ?></div>
                    </div>
                    
                    <div class="detalle-item">
                        <span class="detalle-label"><i class="fas fa-motorcycle"></i> Modelo de Moto</span>
                        <div class="detalle-valor"><?php echo htmlspecialchars($p['modelo_moto']); ?></div>
                    </div>
                    
                    <div class="detalle-item">
                        <span class="detalle-label"><i class="fas fa-cog"></i> Repuesto Solicitado</span>
                        <div class="detalle-valor"><?php echo htmlspecialchars($p['repuesto']); ?></div>
                    </div>
                    
                    <?php if(!empty($p['mensaje'])): ?>
                    <div class="mensaje">
                        <span class="mensaje-label"><i class="fas fa-comment"></i> Mensaje adicional:</span>
                        <div><?php echo nl2br(htmlspecialchars($p['mensaje'])); ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="estado-control">
                        <div class="estado-badge estado-<?php echo $estado_clase; ?>">
                            <i class="fas fa-<?php echo $estado == 'pendiente' ? 'clock' : ($estado == 'procesando' ? 'cog' : 'check-circle'); ?>"></i>
                            <?php echo $estado_texto; ?>
                        </div>
                        
                        <form method="POST" class="estado-form">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
                            <input type="hidden" name="id_pedido" value="<?php echo $p['id']; ?>">
                            <select name="nuevo_estado" class="estado-select" onchange="this.form.submit()">
                                <option value="pendiente" <?php echo $estado == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="procesando" <?php echo $estado == 'procesando' ? 'selected' : ''; ?>>En Proceso</option>
                                <option value="completado" <?php echo $estado == 'completado' ? 'selected' : ''; ?>>Completado</option>
                            </select>
                            <button type="submit" name="actualizar_estado" class="btn-actualizar">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>No hay pedidos</h3>
                    <p>No se encontraron pedidos <?php echo $filtro_estado != 'todos' ? "con estado '$filtro_estado'" : ""; ?>.</p>
                    <?php if($filtro_estado != 'todos'): ?>
                        <button class="filter-btn active" onclick="filtrar('todos')">Ver todos los pedidos</button>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Filtrar pedidos por estado
        function filtrar(estado) {
            window.location.href = "?estado=" + estado;
        }
        
        // B√∫squeda en tiempo real
        function buscarPedidos() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toLowerCase();
            const cards = document.querySelectorAll('.pedido-card');
            
            cards.forEach(card => {
                const text = card.textContent.toLowerCase();
                if (text.includes(filter)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }
        
        // Confirmaci√≥n al cambiar estado
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('.estado-form');
            forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    const select = this.querySelector('.estado-select');
                    const nuevoEstado = select.options[select.selectedIndex].text;
                    
                    if(!confirm(`¬øEst√° seguro de cambiar el estado a "${nuevoEstado}"?`)) {
                        e.preventDefault();
                    }
                });
            });
        });
        
        // Animaci√≥n de entrada para las tarjetas
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.pedido-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.05}s`;
                card.classList.add('fade-in');
            });
        });
    </script>
</body>
</html>

