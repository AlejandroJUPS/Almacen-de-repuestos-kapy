# Almacen-de-repuestos-kapy

## Descripción
Aplicación web para gestionar solicitudes de repuestos de motos.

## Configuración Manual de Base de Datos (Alternativa a setup.php)
Si prefieres hacerlo manualmente en phpMyAdmin:

1. Crea la tabla `users`:
   ```sql
   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) UNIQUE NOT NULL,
       password VARCHAR(255) NOT NULL,
       role ENUM('admin', 'user') DEFAULT 'user',
       created_by INT,
       FOREIGN KEY (created_by) REFERENCES users(id)
   );
   ```

2. Modifica la tabla `solicitudes`:
   ```sql
   ALTER TABLE solicitudes ADD COLUMN status VARCHAR(20) DEFAULT 'pending';
   ALTER TABLE solicitudes ADD COLUMN attended_by INT;
   ALTER TABLE solicitudes ADD FOREIGN KEY (attended_by) REFERENCES users(id);
   ```

3. Inserta el usuario admin inicial (hashea la contraseña en PHP o usa un hash precalculado):
   ```sql
   INSERT INTO users (username, password, role) VALUES ('admin', '$2y$10$examplehash', 'admin');
   ```
   (Reemplaza con el hash real de `password_hash('admin123', PASSWORD_DEFAULT)`).

Después, accede a `login.php`.

## Usuario Admin Inicial
- Usuario: admin
- Contraseña: admin123
- Cambia la contraseña después del primer login.

## Acceso
- Clientes: `index.php` para enviar solicitudes (incluye enlace a login de admin).
- Admin: `login.php` para acceder al panel y gestionar solicitudes/usuarios.
- Administradores pueden acceder a `manage_users.php` para listar, editar y eliminar usuarios.