<?php
session_start();
$error = '';

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'];
    
    // Verificar credenciales (puedes cambiar "admin123" por cualquier otra contraseña)
    if ($password === "admin123") {
        $_SESSION['admin'] = true;
        $_SESSION['login_time'] = time();
        
        // Redireccionar al dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Contraseña incorrecta. Inténtalo de nuevo.";
    }
}

// Verificar si ya está autenticado
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Si ya está autenticado, redirigir al dashboard
    if (basename($_SERVER['PHP_SELF']) !== 'dashboard.php') {
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/assets/css/dark.css">
    <style>
        /* Estilos adicionales para mejorar la interfaz */
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --danger: #ef4444;
            --dark: #1f2937;
            --darker: #111827;
            --light: #f9fafb;
            --gray: #6b7280;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, var(--darker) 0%, var(--dark) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: var(--light);
        }
        
        .container {
            background-color: rgba(31, 41, 55, 0.9);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.8s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo-icon {
            font-size: 3.5rem;
            color: var(--primary);
            margin-bottom: 10px;
            display: inline-block;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        h2 {
            text-align: center;
            color: var(--light);
            margin-bottom: 10px;
            font-size: 2rem;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .subtitle {
            text-align: center;
            color: var(--gray);
            margin-bottom: 30px;
            font-size: 0.95rem;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: var(--light);
            font-weight: 500;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
        }
        
        input[type="password"] {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(17, 24, 39, 0.8);
            color: var(--light);
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        input[type="password"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
        }
        
        input[type="password"]::placeholder {
            color: var(--gray);
        }
        
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray);
            cursor: pointer;
            font-size: 1.1rem;
        }
        
        .toggle-password:hover {
            color: var(--light);
        }
        
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(to right, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        button i {
            font-size: 1.2rem;
        }
        
        .error-message {
            background-color: rgba(239, 68, 68, 0.2);
            border-left: 4px solid var(--danger);
            color: #fca5a5;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: <?php echo $error ? 'flex' : 'none'; ?>;
            align-items: center;
            gap: 10px;
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .error-message i {
            font-size: 1.2rem;
        }
        
        .info-box {
            background-color: rgba(59, 130, 246, 0.1);
            border-left: 4px solid #3b82f6;
            color: #93c5fd;
            padding: 12px;
            border-radius: 6px;
            margin-top: 25px;
            font-size: 0.9rem;
        }
        
        .info-box i {
            margin-right: 8px;
        }
        
        .footer {
            text-align: center;
            margin-top: 30px;
            color: var(--gray);
            font-size: 0.85rem;
        }
        
        .loading {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 500px) {
            .container {
                padding: 30px 20px;
            }
            
            h2 {
                font-size: 1.7rem;
            }
        }
        
        /* Efecto de partículas de fondo (opcional) */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }
        
        .particle {
            position: absolute;
            background-color: rgba(99, 102, 241, 0.2);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Efecto de partículas de fondo -->
    <div class="particles" id="particles"></div>
    
    <div class="container">
        <div class="logo">
            <div class="logo-icon">
                <i class="fas fa-lock"></i>
            </div>
        </div>
        
        <h2>Panel de Administración</h2>
        <p class="subtitle">Acceso exclusivo para administradores autorizados</p>
        
        <?php if ($error): ?>
        <div class="error-message" id="error-message">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
        </div>
        <?php endif; ?>
        
        <form method='POST' id="login-form">
            <div class="form-group">
                <label for="password"><i class="fas fa-key"></i> Contraseña de administrador</label>
                <div class="input-with-icon">
                    <i class="fas fa-lock"></i>
                    <input type='password' name='password' id='password' placeholder='Introduce la contraseña' required autofocus>
                    <button type="button" class="toggle-password" id="toggle-password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            
            <button type="submit" id="submit-btn">
                <span>Acceder al Panel</span>
                <i class="fas fa-sign-in-alt"></i>
                <div class="loading" id="loading"></div>
            </button>
        </form>
        
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <span>Para propósitos de demostración, usa la contraseña: <strong>admin123</strong></span>
        </div>
        
        <div class="footer">
            <p>Sistema seguro &copy; <?php echo date('Y'); ?></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Crear partículas de fondo
            createParticles();
            
            // Mostrar/ocultar contraseña
            const togglePassword = document.getElementById('toggle-password');
            const passwordInput = document.getElementById('password');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
            });
            
            // Animación de envío del formulario
            const loginForm = document.getElementById('login-form');
            const submitBtn = document.getElementById('submit-btn');
            const loading = document.getElementById('loading');
            
            loginForm.addEventListener('submit', function(e) {
                // Solo mostrar animación si la validación pasa
                if (passwordInput.value.trim() !== '') {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.8';
                    loading.style.display = 'block';
                    
                    // Cambiar texto del botón
                    const buttonText = submitBtn.querySelector('span');
                    buttonText.textContent = 'Verificando...';
                }
            });
            
            // Efecto de entrada en el campo de contraseña
            passwordInput.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            passwordInput.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
            
            // Validación en tiempo real
            passwordInput.addEventListener('input', function() {
                const errorMessage = document.getElementById('error-message');
                if (errorMessage) {
                    errorMessage.style.display = 'none';
                }
            });
            
            // Efecto de partículas
            function createParticles() {
                const particlesContainer = document.getElementById('particles');
                const particleCount = 30;
                
                for (let i = 0; i < particleCount; i++) {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Tamaño aleatorio entre 5 y 30px
                    const size = Math.random() * 25 + 5;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    // Posición aleatoria
                    particle.style.left = `${Math.random() * 100}vw`;
                    
                    // Retraso de animación aleatorio
                    particle.style.animationDelay = `${Math.random() * 15}s`;
                    
                    // Duración de animación aleatoria
                    const duration = Math.random() * 10 + 15;
                    particle.style.animationDuration = `${duration}s`;
                    
                    // Opacidad aleatoria
                    particle.style.opacity = Math.random() * 0.5 + 0.1;
                    
                    particlesContainer.appendChild(particle);
                }
            }
        });
    </script>
</body>
</html>