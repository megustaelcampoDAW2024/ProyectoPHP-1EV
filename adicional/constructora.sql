--
-- Estructura de tabla para la tabla `tbl_provincias`
--

DROP TABLE IF EXISTS `tbl_provincias`;
CREATE TABLE IF NOT EXISTS `tbl_provincias` (
  `cod` CHAR(2) NOT NULL COMMENT 'Código de la provincia de dos digitos',
  `nombre` VARCHAR(50) NOT NULL COMMENT 'Nombre de la provincia',
  `comunidad_id` TINYINT(4) NOT NULL COMMENT 'Código de la comunidad a la que pertenece',
  PRIMARY KEY (`cod`),
  KEY `nombre` (`nombre`),
  KEY `FK_ComunidadAutonomaProv` (`comunidad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Provincias de españa; 99 para seleccionar a Nacional';

--
-- Estructura de tabla para la tabla `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS task (
  task_id INT AUTO_INCREMENT PRIMARY KEY,
  num_fiscal_cliente VARCHAR(255) NOT NULL,
  nombre VARCHAR(255) NOT NULL,
  apell VARCHAR(255) NOT NULL,
  tlf VARCHAR(20) NOT NULL,
  descripcion TEXT NOT NULL,
  email VARCHAR(255) NOT NULL,
  direccion VARCHAR(255),
  poblacion VARCHAR(255),
  codigo_post VARCHAR(5),
  provincia CHAR(2),
  estado ENUM('B', 'P', 'R', 'C'),
  fecha_creacion DATE NOT NULL,
  operario INT,
  fecha_realizacion DATE,
  anotaciones_anteriores TEXT,
  anotaciones_posteriores TEXT,
  fich_resu VARCHAR(255),
  foto VARCHAR(255),
  FOREIGN KEY (provincia) REFERENCES tbl_provincias(cod)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estructura de tabla para la tabla `tbl_comunidadesautonomas`
--

CREATE TABLE IF NOT EXISTS `tbl_comunidadesautonomas` (
  `id` tinyint(4) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Afiliados de alta';

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('A','O'),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO usuarios (usuario, password, status)
VALUES 
('admin1', 'pwd1', 'A'),
('admin2', 'pwd2', 'A'),
('admin3', 'pwd3', 'A'),
('admin4', 'pwd4', 'A'),
('admin5', 'pwd5', 'A'),
('operario1', 'pwd1', 'O'),
('operario2', 'pwd2', 'O'),
('operario3', 'pwd3', 'O'),
('operario4', 'pwd4', 'O'),
('operario5', 'pwd5', 'O');

-- 
-- Volcar la base de datos para la tabla `tbl_provincias`
-- 

INSERT INTO `tbl_provincias` VALUES 
('01', 'Alava', 16),
('02', 'Albacete', 7),
('03', 'Alicante', 10),
('04', 'Almera', 1),
('05', 'Avila', 8),
('06', 'Badajoz', 11),
('07', 'Balears (Illes)', 4),
('08', 'Barcelona', 9),
('09', 'Burgos', 8),
('10', 'Cáceres', 11),
('11', 'Cádiz', 1),
('12', 'Castellón', 10),
('13', 'Ciudad Real', 7),
('14', 'Córdoba', 1),
('15', 'Coruña (A)', 12),
('16', 'Cuenca', 7),
('17', 'Girona', 9),
('18', 'Granada', 1),
('19', 'Guadalajara', 7),
('20', 'Guipzcoa', 16),
('21', 'Huelva', 1),
('22', 'Huesca', 2),
('23', 'Jaén', 1),
('24', 'León', 8),
('25', 'Lleida', 9),
('26', 'Rioja (La)', 17),
('27', 'Lugo', 12),
('28', 'Madrid', 13),
('29', 'Málaga', 1),
('30', 'Murcia', 14),
('31', 'Navarra', 15),
('32', 'Ourense', 12),
('33', 'Asturias', 3),
('34', 'Palencia', 8),
('35', 'Palmas (Las)', 5),
('36', 'Pontevedra', 12),
('37', 'Salamanca', 8),
('38', 'Santa Cruz de Tenerife', 5),
('39', 'Cantabria', 6),
('40', 'Segovia', 8),
('41', 'Sevilla', 1),
('42', 'Soria', 8),
('43', 'Tarragona', 9),
('44', 'Teruel', 2),
('45', 'Toledo', 7),
('46', 'Valencia', 10),
('47', 'Valladolid', 8),
('48', 'Vizcaya', 16),
('49', 'Zamora', 8),
('50', 'Zaragoza', 2),
('51', 'Ceuta', 18),
('52', 'Melilla', 19);


--
-- Volcado de ejemplos para la tabla `task`
--

INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, codigo_post, provincia, estado, fecha_creacion, operario, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores, fich_resu, foto)
VALUES
('12345678A', 'Juan', 'Pérez', '+34123456789', 'Reparar la puerta', 'juan.perez@example.com', 'Calle Mayor, 1', 'Madrid', '28001', '28', 'P', '2024-11-12', 1, '2024-11-15', 'La puerta está rota', 'La puerta ha sido reparada', 'resumen.pdf', 'foto.jpg'),
('87654321B', 'Ana', 'García', '+34987654321', 'Instalar una ventana', 'ana.garcia@example.com', 'Calle Menor, 2', 'Barcelona', '08001', '08', 'R', '2024-11-12', 2, '2024-11-10', 'La ventana está vieja', 'La ventana ha sido instalada', 'resumen.docx', 'foto.png');
INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, codigo_post, provincia, estado, fecha_creacion, operario, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores, fich_resu, foto)
VALUES
('90123456C', 'Pedro', 'López', '+34654321098', 'Pintar la pared', 'pedro.lopez@example.com', 'Calle Larga, 3', 'Valencia', '46001', '46', 'B', '2024-11-12', 3, '2024-11-18', 'La pared está sucia', 'La pared ha sido pintada', 'resumen.txt', 'foto.gif'),
('56789012D', 'Laura', 'Martínez', '+34543210987', 'Limpiar el jardín', 'laura.martinez@example.com', 'Calle Corta, 4', 'Sevilla', '41001', '41', 'C', '2024-11-12', 4, NULL, 'El jardín está descuidado', NULL, NULL, NULL);
-- Ejemplo 3: Tarea en estado 'B' con operario asignado
INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, codigo_post, provincia, estado, fecha_creacion, operario) 
VALUES ('78901234F', 'María', 'Rodríguez', '912345678', 'Instalar una lámpara', 'maria.rodriguez@example.com', 'Calle Nueva, 5', 'Málaga', '29001', '29', 'B', '2024-11-13', 5); 
-- Ejemplo 4: Tarea en estado 'C' con fecha de realización y anotaciones
INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, direccion, poblacion, codigo_post, provincia, estado, fecha_creacion, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores) 
VALUES ('43210987G', 'Carlos', 'Sánchez', '654321098', 'Arreglar la persiana', 'carlos.sanchez@example.com', 'Calle Ancha, 6', 'Zaragoza', '50001', '50', 'C', '2024-11-13', '2024-11-12', 'Persiana atascada', 'Persiana reparada');
-- Ejemplo 5: Tarea en estado 'P' con fichero resumen
INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, estado, fecha_creacion, fich_resu) 
VALUES ('98765432H', 'Sofía', 'Gómez', '543210987', 'Cambiar el enchufe', 'sofia.gomez@example.com', 'P', '2024-11-14', 'informe_enchufe.pdf');
-- Ejemplo 6: Tarea en estado 'R' con foto
INSERT INTO task (num_fiscal_cliente, nombre, apell, tlf, descripcion, email, estado, fecha_creacion, foto) 
VALUES ('21098765I', 'Javier', 'Fernández', '987654321', 'Montar un mueble', 'javier.fernandez@example.com', 'R', '2024-11-14', 'foto_mueble.jpg');


-- 
-- Volcar la base de datos para la tabla `tbl_comunidadesautonomas`
-- 

INSERT INTO `tbl_comunidadesautonomas` VALUES (1, 'Andalucía'),
(2, 'Aragón'),
(3, 'Asturias (Principado de)'),
(4, 'Balears (IIles)'),
(5, 'Canarias'),
(6, 'Cantabria'),
(8, 'Castilla y León'),
(7, 'Castilla-La Mancha'),
(9, 'Cataluña'),
(10, 'Comunidad Valenciana'),
(11, 'Extremadura'),
(12, 'Galicia'),
(13, 'Madrid (Comunidad de)'),
(14, 'Murcia (Región de)'),
(15, 'Navarra (Comunidad Foral de)'),
(16, 'País Vasco'),
(17, 'Rioja (La)'),
(18, 'Ceuta'),
(19, 'Melilla');