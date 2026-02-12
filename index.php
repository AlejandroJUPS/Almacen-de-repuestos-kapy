<?php
session_start();
include("config/db.php");

$isLoggedIn = isset($_SESSION['user']);
$username = $isLoggedIn ? htmlspecialchars($_SESSION['user']) : null;
$error = '';

// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $r = $stmt->get_result();
    $u = $r->fetch_assoc();
    
    if ($u && password_verify($pass, $u['password'])) {
        $_SESSION['user'] = $u['nombre'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Credenciales incorrectas";
    }
}

// Procesar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $pass = $_POST['password'] ?? '';
    
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $pass_hash);
    
    if ($stmt->execute()) {
        $_SESSION['user'] = $nombre;
        header("Location: index.php");
        exit();
    } else {
        $error = "Error al registrar. El email puede estar ya registrado.";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kapy Repuestos · Bienvenido</title>
    <link rel="stylesheet" href="assets/css/dark.css">
    <style>
        /* Estilo Microsoft - Clean & Professional */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: #0a0c0e;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            color: #e9e9e9;
            line-height: 1.5;
        }
        
        .ms-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 24px 32px;
        }
        
        /* Header estilo Microsoft */
        .ms-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #2d2f31;
            margin-bottom: 48px;
        }
        
        .ms-logo {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .ms-logo h1 {
            font-size: 24px;
            font-weight: 500;
            color: #fff;
            letter-spacing: -0.5px;
        }
        
        .ms-logo span {
            color: #00a8e8;
            font-weight: 600;
        }
        
        .ms-nav {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        
        .ms-nav a {
            color: #c9c9c9;
            text-decoration: none;
            font-size: 15px;
            transition: color 0.2s;
        }
        
        .ms-nav a:hover {
            color: #00a8e8;
        }
        
        .user-greeting {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #1e1f21;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
        }
        
        .user-greeting i {
            color: #00a8e8;
        }
        
        /* Hero estilo Microsoft */
        .ms-hero {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 48px;
            align-items: center;
            margin-bottom: 64px;
            background: linear-gradient(145deg, #0f1113 0%, #1a1c1e 100%);
            border-radius: 24px;
            padding: 48px 56px;
        }
        
        .ms-hero-content h2 {
            font-size: 48px;
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 16px;
            color: #fff;
        }
        
        .ms-hero-content p {
            font-size: 18px;
            color: #a0a0a0;
            margin-bottom: 32px;
            max-width: 90%;
        }
        
        .ms-hero-buttons {
            display: flex;
            gap: 16px;
        }
        
        .ms-btn {
            background: #00a8e8;
            color: #000;
            border: none;
            padding: 12px 28px;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            text-decoration: none;
            display: inline-block;
        }
        
        .ms-btn:hover {
            background: #0095d1;
            transform: scale(0.98);
        }
        
        .ms-btn-outline {
            background: transparent;
            border: 1px solid #4a4c4e;
            color: #fff;
        }
        
        .ms-btn-outline:hover {
            background: #2a2c2e;
            border-color: #00a8e8;
        }
        
        /* Auth Cards */
        .auth-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 32px;
            margin: 48px 0;
        }
        
        .auth-card {
            background: #141618;
            border-radius: 16px;
            padding: 32px;
            border: 1px solid #2d2f31;
            transition: all 0.3s;
        }
        
        .auth-card:hover {
            border-color: #00a8e8;
            box-shadow: 0 8px 24px rgba(0,168,232,0.1);
        }
        
        .auth-card h3 {
            font-size: 24px;
            font-weight: 500;
            margin-bottom: 24px;
            color: #fff;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-size: 14px;
            color: #a0a0a0;
            margin-bottom: 6px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            background: #0c0e10;
            border: 1px solid #3a3c3e;
            border-radius: 6px;
            color: #fff;
            font-size: 15px;
            transition: border 0.2s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #00a8e8;
            background: #0a0c0e;
        }
        
        .error-message {
            background: rgba(232, 17, 35, 0.1);
            border: 1px solid #e81123;
            color: #ff8a8a;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 14px;
        }
        
        /* Features */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 32px;
            margin: 64px 0 32px;
        }
        
        .feature-item {
            padding: 24px;
            background: #141618;
            border-radius: 12px;
            border: 1px solid #2d2f31;
        }
        
        .feature-item h4 {
            font-size: 20px;
            font-weight: 500;
            margin-bottom: 12px;
            color: #fff;
        }
        
        .feature-item p {
            color: #a0a0a0;
            font-size: 15px;
        }
        
        .feature-icon {
            font-size: 32px;
            margin-bottom: 16px;
            color: #00a8e8;
        }
        
        /* Dashboard para usuarios logueados */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 32px;
            margin: 32px 0;
        }
        
        .welcome-card {
            background: #141618;
            border-radius: 24px;
            padding: 40px;
            border: 1px solid #2d2f31;
        }
        
        .welcome-card h2 {
            font-size: 36px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #fff;
        }
        
        .welcome-card h2 span {
            color: #00a8e8;
        }
        
        .quick-actions {
            display: flex;
            gap: 16px;
            margin-top: 32px;
        }
        
        .action-card {
            background: #1e1f21;
            padding: 24px;
            border-radius: 16px;
            flex: 1;
            border: 1px solid #3a3c3e;
            transition: all 0.2s;
        }
        
        .action-card:hover {
            border-color: #00a8e8;
            background: #252729;
        }
        
        .action-card a {
            text-decoration: none;
            color: #fff;
            display: block;
        }
        
        .action-card h3 {
            font-size: 20px;
            margin-bottom: 8px;
        }
        
        .action-card p {
            color: #a0a0a0;
            font-size: 14px;
        }
        
        /* Admin link */
        .admin-link {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #1e1f21;
            padding: 8px 20px;
            border-radius: 30px;
            border: 1px solid #3a3c3e;
            color: #a0a0a0;
            text-decoration: none;
            font-size: 13px;
            transition: all 0.2s;
            opacity: 0.7;
        }
        
        .admin-link:hover {
            opacity: 1;
            border-color: #00a8e8;
            color: #00a8e8;
        }
        
        @media (max-width: 900px) {
            .ms-hero {
                grid-template-columns: 1fr;
                padding: 32px;
            }
            
            .auth-section {
                grid-template-columns: 1fr;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="ms-container">
        
        <!-- HEADER MICROSOFT STYLE -->
        <header class="ms-header">
            <div class="ms-logo">
                <h1>Kapy <span>Repuestos</span></h1>
            </div>
            
            <nav class="ms-nav">
                <a href="inventario/catalogo.php">Catálogo</a>
                
                <?php if ($isLoggedIn): ?>
                    <div class="user-greeting">
                        <span>👋</span>
                        <span><?= $username ?></span>
                    </div>
                    <a href="auth/logout.php">Cerrar sesión</a>
                <?php else: ?>
                    <!-- Sin links de login/register separados, todo está en la misma página -->
                <?php endif; ?>
            </nav>
        </header>
        
        <?php if ($isLoggedIn): ?>
            <!-- DASHBOARD PARA USUARIOS LOGUEADOS - ESTILO MICROSOFT -->
            <div class="dashboard-grid">
                <div class="welcome-card">
                    <h2>Hola, <span><?= $username ?></span></h2>
                    <p style="color: #a0a0a0; font-size: 18px; margin-bottom: 24px;">
                        ¿Qué necesitas hacer hoy?
                    </p>
                    
                    <div style="background: #0f1113; padding: 24px; border-radius: 16px; margin-top: 16px;">
                        <div style="display: flex; gap: 16px; align-items: center;">
                            <div style="background: #00a8e8; width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 24px;">
                                🛵
                            </div>
                            <div>
                                <h3 style="margin-bottom: 4px;">Tu tienda de repuestos</h3>
                                <p style="color: #a0a0a0;">Accede al catálogo completo o realiza un pedido</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="quick-actions">
                        <div class="action-card">
                            <a href="inventario/catalogo.php">
                                <h3>🔍 Catálogo</h3>
                                <p>Explora repuestos</p>
                            </a>
                        </div>
                        <div class="action-card">
                            <a href="pedidos/formulario.php">
                                <h3>📦 Pedidos</h3>
                                <p>Solicitar repuestos</p>
                            </a>
                        </div>
                        <div class="action-card">
                            <a href="#">
                                <h3>📋 Mis pedidos</h3>
                                <p>Historial</p>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div style="background: #141618; border-radius: 24px; padding: 32px; border: 1px solid #2d2f31;">
                    <h3 style="font-size: 20px; margin-bottom: 24px;">Recomendados</h3>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <div style="display: flex; gap: 12px; align-items: center; padding: 12px; background: #1e1f21; border-radius: 12px;">
                            <span style="font-size: 24px;">⚙️</span>
                            <div>
                                <strong>Frenos</strong>
                                <p style="color: #a0a0a0; font-size: 13px;">Pastillas y discos</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center; padding: 12px; background: #1e1f21; border-radius: 12px;">
                            <span style="font-size: 24px;">🔧</span>
                            <div>
                                <strong>Motor</strong>
                                <p style="color: #a0a0a0; font-size: 13px;">Repuestos originales</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php else: ?>
            <!-- HERO PARA VISITANTES - ESTILO MICROSOFT -->
            <div class="ms-hero">
                <div class="ms-hero-content">
                    <h2>Repuestos para motos en un solo lugar</h2>
                    <p>
                        Explora nuestro catálogo de repuestos y realiza solicitudes 
                        de forma rápida y sencilla. Regístrate gratis y comienza a pedir.
                    </p>
                    <div class="ms-hero-buttons">
                        <a href="inventario/catalogo.php" class="ms-btn">Ver catálogo →</a>
                    </div>
                </div>
                <div style="display: flex; justify-content: center;">
                    <div style="background: #1e1f21; width: 100%; height: 200px; border-radius: 16px; display: flex; align-items: center; justify-content: center; border: 1px solid #3a3c3e;">
                        <span style="font-size: 80px;">🛵</span>
                    </div>
                </div>
            </div>
            
            <!-- SECCIÓN DE LOGIN/REGISTRO INTEGRADA - ESTILO MICROSOFT -->
            <?php if ($error): ?>
                <div class="error-message">
                    ⚠️ <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <div class="auth-section">
                <!-- TARJETA DE LOGIN -->
                <div class="auth-card">
                    <h3>Iniciar sesión</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="tu@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" placeholder="••••••" required>
                        </div>
                        <button type="submit" name="login" class="ms-btn" style="width: 100%;">Entrar</button>
                    </form>
                    <p style="margin-top: 20px; color: #a0a0a0; font-size: 14px; text-align: center;">
                        ¿No tienes cuenta? Regístrate gratis
                    </p>
                </div>
                
                <!-- TARJETA DE REGISTRO -->
                <div class="auth-card">
                    <h3>Crear cuenta gratis</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Nombre completo</label>
                            <input type="text" name="nombre" placeholder="Ej: Juan Pérez" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" placeholder="tu@email.com" required>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="password" placeholder="Mínimo 6 caracteres" required>
                        </div>
                        <button type="submit" name="register" class="ms-btn ms-btn-outline" style="width: 100%;">Registrarse</button>
                    </form>
                    <p style="margin-top: 20px; color: #a0a0a0; font-size: 12px; text-align: center;">
                        Al registrarte, aceptas nuestros términos y condiciones.
                    </p>
                </div>
            </div>
            
            <!-- FEATURES -->
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">⚡</div>
                    <h4>Rápido y sencillo</h4>
                    <p>Realiza tus pedidos en menos de 2 minutos</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🛡️</div>
                    <h4>Garantía incluida</h4>
                    <p>Todos nuestros repuestos tienen garantía</p>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">🚚</div>
                    <h4>Envíos a todo el país</h4>
                    <p>Recibí tus repuestos en 24/48 horas</p>
                </div>
            </div>
        <?php endif; ?>
        
        <!-- FOOTER SILENCIOSO -->
        <div style="margin-top: 64px; padding-top: 32px; border-top: 1px solid #2d2f31; color: #6c6e70; text-align: center; font-size: 13px;">
            Kapy Repuestos © 2024 - Tu tienda de confianza
        </div>
        
    </div>
    
    <!-- ACCESO ADMIN (siempre visible) -->
    <a href="admin/admin_login.php" class="admin-link">
        ⚙️ Acceso administrador
    </a>
</body>
</html>