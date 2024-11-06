-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS mi_aplicacion;

-- Usar la base de datos recién creada o existente
USE mi_aplicacion;

-- Crear la tabla usuarios si no existe
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
