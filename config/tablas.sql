DROP TABLE IF EXISTS tb_detalles_pagos;
DROP TABLE IF EXISTS tb_trabajadores;
DROP TABLE IF EXISTS tb_usuarios;
DROP TABLE IF EXISTS tb_personas;
DROP TABLE IF EXISTS tb_departamentos;
DROP TABLE IF EXISTS tb_cargos;

CREATE TABLE tb_personas (
	id_persona SERIAL NOT NULL,
	nombre CHAR(50) NOT NULL,
	apellido CHAR(50) NOT NULL,
	cedula CHAR(15) NOT NULL,
	telefono CHAR(20),
	correo_electronico CHAR(50) NOT NULL,
	direccion CHAR(200),
	PRIMARY KEY (id_persona)
);

CREATE TABLE tb_usuarios (
    id_usuario SERIAL NOT NULL,
    nombre_usuario CHAR(255) NOT NULL,
    clave_usuario CHAR(255) NOT NULL,
    nombre_rol CHAR(20) NOT NULL,
	persona_id SMALLINT NOT NULL,
    estado_usuario BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (persona_id) REFERENCES tb_personas(id_persona)
);

CREATE TABLE tb_departamentos (
    id_departamento SERIAL NOT NULL,
    nombre_departamento CHAR(100) NOT NULL,
    PRIMARY KEY (id_departamento)
);

CREATE TABLE tb_cargos (
    id_cargo SERIAL NOT NULL,
    nombre_cargo CHAR(50) NOT NULL,
    salario_base MONEY NOT NULL,
    PRIMARY KEY (id_cargo)
);

CREATE TABLE tb_trabajadores (
    id_trabajador SERIAL NOT NULL,
    persona_id SMALLINT NOT NULL,
    departamento_id SMALLINT NOT NULL,
    cargo_id SMALLINT NOT NULL,
    estado_trabajador BOOLEAN DEFAULT TRUE,
    PRIMARY KEY (id_trabajador),
    FOREIGN KEY (persona_id) REFERENCES tb_personas(id_persona),
    FOREIGN KEY (departamento_id) REFERENCES tb_departamentos(id_departamento),
    FOREIGN KEY (cargo_id) REFERENCES tb_cargos(id_cargo)
);

CREATE TABLE tb_detalles_pagos (
    id_detalle SERIAL NOT NULL,
    tipo_pago CHAR(2) NOT NULL,
    descripcion CHAR(255) NOT NULL,
    fecha DATE,
    monto MONEY DEFAULT 0.00,
    trabajador_id SMALLINT,
    PRIMARY KEY (id_detalle)
);

-- insert de usuario admin
INSERT INTO tb_personas (nombre, apellido, cedula, telefono, correo_electronico, direccion) 
VALUES ('admin', 'admin', '1234', '', 'admin@admin.com', '');
INSERT INTO tb_usuarios (nombre_usuario, clave_usuario, nombre_rol, persona_id)
VALUES ('admin@admin.com', '1234', 'admin', (SELECT MAX(id_persona) FROM tb_personas));

INSERT INTO tb_departamentos (nombre_departamento) VALUES
('Gerencia Gestion y calidad de servicio'),
('Gerencia Soporte operacional'),
('Gerencia de Tecnologia de Informacion'),
('Gerencia de Procesos operativos'),
('Gerencia Gral de Operacion y Mantenimiento'),
('Gerencia Gral de Ingenieria de la red');

INSERT INTO tb_cargos (nombre_cargo, salario_base) VALUES
('Especialista', '2000'),
('Analista', '1500'),
('Consultor','2500'),
('Supervisor', '3000');


/* querys de test */
/*update usuarios set nombre='Marceloduarte', clave='Marce'
  where nombre='Marcelo';
  
 select * from tb_personas;
 select * from tb_trabajadores;
 
 UPDATE tb_personas SET nombre='Gleiber', apellido='Valdiviezo', cedula='1234567', 
 telefono='312354534', correo_electronico='gleiber@test.com', direccion='Coche'
 WHERE id_persona = 4;*/
