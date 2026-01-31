# Almacen-de-repuestos-kapy

## Descripción
Aplicación web para gestionar solicitudes de repuestos de motos.

## Instalación y Configuración
1. Sube los archivos a tu servidor web (ej. infinityfree.com) o instala XAMPP localmente.
2. Ejecuta `setup.php` en tu navegador para configurar la base de datos (crea tablas y usuario admin inicial).
3. Accede a `login.php` para iniciar sesión.

## Usuario Admin Inicial
- Usuario: admin
- Contraseña: admin123
- Cambia la contraseña después del primer login.

## Acceso
- Clientes: `index.php` para enviar solicitudes (incluye enlace a login de admin).
- Admin: `login.php` para acceder al panel y gestionar solicitudes/usuarios.
- Administradores pueden acceder a `manage_users.php` para listar, editar y eliminar usuarios.