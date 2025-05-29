-- Crear base de datos
CREATE DATABASE IF NOT EXISTS bpm_gestion;
USE bpm_gestion;

-- Tabla de usuario
CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    correo VARCHAR(100) UNIQUE,
    rol ENUM('admin', 'analista', 'usuario') DEFAULT 'usuario'
);

-- Datos de prueba para usuario
INSERT INTO usuario (nombre, correo, rol) VALUES
('Ana Pérez', 'ana@empresa.com', 'admin'),
('Luis Torres', 'luis@empresa.com', 'analista'),
('Carlos Ruiz', 'carlos@empresa.com', 'usuario');

-- Tabla de formularios (en formato JSON)
CREATE TABLE formulario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    json_formulario LONGTEXT,
    creador INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (creador) REFERENCES usuario(id)
);

-- Datos de prueba para formularios
INSERT INTO formulario (nombre, json_formulario, creador) VALUES
('Solicitud de Vacaciones', '{ "fields": [{ "type": "text", "label": "Nombre", "name": "nombre" }] }', 2);

-- Tabla de flujos (en formato XML BPMN)
CREATE TABLE flujo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    xml LONGTEXT,
    creador INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (creador) REFERENCES usuario(id)
);

-- Datos de prueba para flujos
INSERT INTO flujo (nombre, xml, creador) VALUES
('Flujo Vacaciones', '<definitions><process id="vacaciones" /></definitions>', 2);

-- Tabla de procesos en ejecución
CREATE TABLE instancia_proceso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_flujo INT,
    id_formulario INT,
    iniciado INT,
    estado ENUM('pendiente', 'en_progreso', 'finalizado') DEFAULT 'pendiente',
    fecha_inicio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_fin TIMESTAMP NULL,
    FOREIGN KEY (id_flujo) REFERENCES flujo(id),
    FOREIGN KEY (id_formulario) REFERENCES formulario(id),
    FOREIGN KEY (iniciado) REFERENCES usuario(id)
);

-- Insertar una ejecución de prueba
INSERT INTO instancia_proceso (id_flujo, id_formulario, iniciado, estado)
VALUES (1, 1, 3, 'en_progreso');

-- Tabla de tareas asignadas por proceso
CREATE TABLE tarea (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_proceso INT,
    nombre_tarea VARCHAR(100),
    asignado INT,
    estado ENUM('pendiente', 'en_progreso', 'completado') DEFAULT 'pendiente',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_completado TIMESTAMP NULL,
    FOREIGN KEY (id_proceso) REFERENCES instancia_proceso(id),
    FOREIGN KEY (asignado) REFERENCES usuario(id)
);

-- Tareas de prueba para el proceso en ejecución
INSERT INTO tarea (id_proceso, nombre_tarea, asignado, estado)
VALUES
(1, 'Revisión RRHH', 1, 'pendiente'),
(1, 'Aprobación Jefe', 2, 'pendiente');
