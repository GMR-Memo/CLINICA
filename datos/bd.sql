CREATE DATABASE clinica_salud;

CREATE TABLE IF NOT EXISTS usuarios (
    id SERIAL PRIMARY KEY,
    correo VARCHAR(255) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    rol VARCHAR(20) NOT NULL CHECK (rol IN ('doctor', 'paciente'))
);

CREATE TABLE IF NOT EXISTS pacientes (
    id INT PRIMARY KEY REFERENCES usuarios(id) ON DELETE CASCADE,
    nombre VARCHAR(100) NOT NULL,
    genero VARCHAR(15),         -- M: Masculino, F: Femenino, O: Otro
    edad INT,                  -- Edad del paciente
    telefono VARCHAR(10),
    direccion TEXT
);

CREATE TABLE IF NOT EXISTS doctores (
    id INT PRIMARY KEY REFERENCES usuarios(id) ON DELETE CASCADE,
    nombre VARCHAR(100) NOT NULL,
    cedula VARCHAR(50) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    telefono VARCHAR(10),
    direccion TEXT
);
CREATE TABLE IF NOT EXISTS citas (
    id SERIAL PRIMARY KEY,
    paciente_id INT NOT NULL REFERENCES pacientes(id) ON DELETE CASCADE,
    doctor_id INT NOT NULL REFERENCES doctores(id) ON DELETE CASCADE,
    fecha TIMESTAMP NOT NULL,
    motivo TEXT NOT NULL
);



