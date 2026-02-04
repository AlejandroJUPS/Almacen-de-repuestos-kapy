<?php
session_start();
if(!isset($_SESSION['admin'])) {
    die("No autorizado");
}

// Datos de ejemplo para estadísticas
$estadisticas = [
    'pedidos_pendientes' => 15,
    'pedidos_completados' => 128,
    'usuarios_activos' => 42,
    'ingresos_mes' => 2845.50
];

// Pedidos recientes de ejemplo
$pedidos_recientes = [
    ['id' => 1001, 'cliente' => 'Juan Pérez', 'estado' => 'Pendiente', 'fecha' => '2023-10-15', 'total' => 89.99],
    ['id' => 1002, 'cliente' => 'María García', 'estado' => 'Completado', 'fecha' => '2023-10-14', 'total' => 145.50],
    ['id' => 1003, 'cliente' => 'Carlos López', 'estado' => 'En proceso', 'fecha' => '2023-10-14', 'total' => 67.80],
    ['id' => 1004, 'cliente' => 'Ana Martínez', 'estado' => 'Pendiente', 'fecha' => '2023-10-13', 'total' => 230.00],
    ['id' => 1005, 'cliente' => 'Pedro Sánchez', 'estado' => 'Completado', 'fecha' => '2023-10-12', 'total' => 55.25]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/assets/css/dark.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #6a11cb;
            --secondary: #2575fc;
            --success: #00b09b;
            --warning: #ffa726;
            --danger: #ff416c;
            --dark: #1a1a2e;
            --light: #f8f9fa;
            --gray: #6c757d;
            --card-bg: #162447;
            --hover-effect: brightness(1.1);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--dark) 0%, #16213e 100%);
            color: var(--light);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        /* Header */
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .admin-header h1 {
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .admin-header h1 i {
            font-size: 2.2rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
            background: rgba(255, 255, 255, 0.1);
            padding: 12px 20px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }
        
        .user-avatar {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
        
        /* Estadísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transition: var(--transition);
            border-left: 5px solid;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
        }
        
        .stat-card:nth-child(1) { border-left-color: var(--warning); }
        .stat-card:nth-child(2) { border-left-color: var(--success); }
        .stat-card:nth-child(3) { border-left-color: var(--primary); }
        .stat-card:nth-child(4) { border-left-color: var(--secondary); }
        
        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }
        
        .stat-card:nth-child(1) .stat-icon { background: rgba(255, 167, 38, 0.2); color: var(--warning); }
        .stat-card:nth-child(2) .stat-icon { background: rgba(0, 176, 155, 0.2); color: var(--success); }
        .stat-card:nth-child(3) .stat-icon { background: rgba(106, 17, 203, 0.2); color: var(--primary); }
        .stat-card:nth-child(4) .stat-icon { background: rgba(37, 117, 252, 0.2); color: var(--secondary); }
        
        .stat-info h3 {
            font-size: 2rem;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }
        
        /* Secciones principales */
        .main-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        @media (max-width: 1100px) {
            .main-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background: var(--card-bg);
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            margin-bottom: 30px;
        }
        
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .card-header h2 {
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        /* Tabla de pedidos */
        .pedidos-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .pedidos-table th {
            text-align: left;
            padding: 15px 10px;
            color: rgba(255, 255, 255, 0.7);
            font-weight: 600;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .pedidos-table td {
            padding: 15px 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .pedidos-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }
        
        .estado-badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        
        .estado-pendiente { background: rgba(255, 167, 38, 0.2); color: var(--warning); }
        .estado-completado { background: rgba(0, 176, 155, 0.2); color: var(--success); }
        .estado-proceso { background: rgba(37, 117, 252, 0.2); color: var(--secondary); }
        
        /* Acciones rápidas */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .action-btn {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            border: none;
            border-radius: 12px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
            text-align: center;
            text-decoration: none;
        }
        
        .action-btn:hover {
            filter: var(--hover-effect);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(106, 17, 203, 0.3);
        }
        
        .action-btn i {
            font-size: 2rem;
        }
        
        .action-btn:nth-child(3) {
            background: linear-gradient(135deg, var(--success), #00d2ff);
        }
        
        .action-btn:nth-child(4) {
            background: linear-gradient(135deg, var(--warning), #ff5e62);
        }
        
        /* Footer */
        .admin-footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }
        
        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }
        
        /* Estilos responsivos */
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
            
            .user-info {
                align-self: flex-start;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-actions {
                grid-template-columns: 1fr;
            }
            
            .pedidos-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header class="admin-header fade-in">
            <h1><i class="fas fa-shield-alt"></i> Panel de Administración</h1>
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div>
                    <p style="font-weight: 600;">Administrador</p>
                    <p style="font-size: 0.8rem; color: rgba(255, 255, 255, 0.7);">Sesión activa</p>
                </div>
                <a href="logout.php" style="color: var(--danger); margin-left: 10px;" title="Cerrar sesión">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </header>
        
        <!-- Estadísticas -->
        <section class="stats-grid">
            <div class="stat-card fade-in delay-1">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $estadisticas['pedidos_pendientes']; ?></h3>
                    <p>Pedidos Pendientes</p>
                </div>
            </div>
            
            <div class="stat-card fade-in delay-2">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $estadisticas['pedidos_completados']; ?></h3>
                    <p>Pedidos Completados</p>
                </div>
            </div>
            
            <div class="stat-card fade-in delay-3">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3><?php echo $estadisticas['usuarios_activos']; ?></h3>
                    <p>Usuarios Activos</p>
                </div>
            </div>
            
            <div class="stat-card fade-in delay-4">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-info">
                    <h3>$<?php echo number_format($estadisticas['ingresos_mes'], 2); ?></h3>
                    <p>Ingresos del Mes</p>
                </div>
            </div>
        </section>
        
        <!-- Contenido principal -->
        <div class="main-grid">
            <!-- Sección izquierda: Pedidos recientes -->
            <section>
                <div class="card fade-in">
                    <div class="card-header">
                        <h2><i class="fas fa-shopping-cart"></i> Pedidos Recientes</h2>
                        <a href="pedidos.php" class="action-btn" style="padding: 10px 20px; font-size: 0.9rem;">
                            Ver Todos <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    
                    <div class="table-container">
                        <table class="pedidos-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pedidos_recientes as $pedido): ?>
                                <tr>
                                    <td>#<?php echo $pedido['id']; ?></td>
                                    <td><?php echo $pedido['cliente']; ?></td>
                                    <td>
                                        <span class="estado-badge estado-<?php echo str_replace(' ', '', strtolower($pedido['estado'])); ?>">
                                            <?php echo $pedido['estado']; ?>
                                        </span>
                                    </td>
                                    <td><?php echo $pedido['fecha']; ?></td>
                                    <td>$<?php echo number_format($pedido['total'], 2); ?></td>
                                    <td>
                                        <a href="detalle_pedido.php?id=<?php echo $pedido['id']; ?>" style="color: var(--secondary);">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            
            <!-- Sección derecha: Acciones rápidas -->
            <section>
                <div class="card fade-in delay-1">
                    <div class="card-header">
                        <h2><i class="fas fa-bolt"></i> Acciones Rápidas</h2>
                    </div>
                    
                    <div class="quick-actions">
                        <a href="pedidos.php" class="action-btn">
                            <i class="fas fa-shopping-cart"></i>
                            Gestionar Pedidos
                        </a>
                        
                        <a href="productos.php" class="action-btn">
                            <i class="fas fa-box-open"></i>
                            Productos
                        </a>
                        
                        <a href="clientes.php" class="action-btn">
                            <i class="fas fa-users"></i>
                            Clientes
                        </a>
                        
                        <a href="informes.php" class="action-btn">
                            <i class="fas fa-chart-bar"></i>
                            Informes
                        </a>
                    </div>
                </div>
                
                <div class="card fade-in delay-2">
                    <div class="card-header">
                        <h2><i class="fas fa-cog"></i> Configuración Rápida</h2>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Modo Oscuro</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span>Notificaciones</span>
                            <label class="switch">
                                <input type="checkbox" checked>
                                <span class="slider round"></span>
                            </label>
                        </div>
                        
                        <a href="configuracion.php" style="color: var(--primary); text-align: center; margin-top: 10px;">
                            <i class="fas fa-cogs"></i> Configuración Avanzada
                        </a>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Footer -->
        <footer class="admin-footer fade-in delay-3">
            <p>Sistema de Administración © <?php echo date('Y'); ?> | Último acceso: <?php echo date('d/m/Y H:i'); ?></p>
        </footer>
    </div>
    
    <script>
        // Animaciones y efectos interactivos
        document.addEventListener('DOMContentLoaded', function() {
            // Efecto hover en tarjetas de estadísticas
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Alternar switches
            const switches = document.querySelectorAll('.switch input');
            switches.forEach(switchInput => {
                switchInput.addEventListener('change', function() {
                    const label = this.nextElementSibling;
                    if(this.checked) {
                        label.style.backgroundColor = '#6a11cb';
                    } else {
                        label.style.backgroundColor = '#ccc';
                    }
                });
            });
            
            // Mostrar/ocultar detalles en la tabla (ejemplo)
            const eyeIcons = document.querySelectorAll('.fa-eye');
            eyeIcons.forEach(icon => {
                icon.addEventListener('click', function(e) {
                    e.preventDefault();
                    const row = this.closest('tr');
                    alert('Aquí se mostrarían los detalles del pedido');
                });
            });
            
            // Actualizar la hora en el footer
            function updateTime() {
                const now = new Date();
                const timeString = now.toLocaleDateString('es-ES') + ' ' + now.toLocaleTimeString('es-ES');
                const timeElement = document.querySelector('.admin-footer p');
                if(timeElement) {
                    timeElement.innerHTML = `Sistema de Administración © ${now.getFullYear()} | Último acceso: ${timeString}`;
                }
            }
            
            // Actualizar cada minuto
            setInterval(updateTime, 60000);
        });
        
        // Estilos para los switches
        const style = document.createElement('style');
        style.textContent = `
            .switch {
                position: relative;
                display: inline-block;
                width: 50px;
                height: 24px;
            }
            
            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }
            
            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: #ccc;
                transition: .4s;
                border-radius: 34px;
            }
            
            .slider:before {
                position: absolute;
                content: "";
                height: 16px;
                width: 16px;
                left: 4px;
                bottom: 4px;
                background-color: white;
                transition: .4s;
                border-radius: 50%;
            }
            
            input:checked + .slider {
                background-color: var(--primary);
            }
            
            input:checked + .slider:before {
                transform: translateX(26px);
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>