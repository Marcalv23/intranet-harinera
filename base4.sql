-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-11-2024 a las 06:19:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `base4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE `archivos` (
  `idArchivos` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) DEFAULT NULL,
  `idEmpleado` int(11) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL,
  `idProveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicasescolaboradores`
--

CREATE TABLE `caracteristicasescolaboradores` (
  `id` int(11) NOT NULL,
  `ESColaboradores_id` int(11) NOT NULL,
  `tipo_equipo` varchar(50) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `numero_serie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caracteristicasescolaboradores`
--

INSERT INTO `caracteristicasescolaboradores` (`id`, `ESColaboradores_id`, `tipo_equipo`, `marca`, `modelo`, `numero_serie`) VALUES
(21, 30, 'PC de escritorio', '12', '12', '12'),
(22, 31, 'PC de escritorio', '121212', '1212', '121212');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `idCliente` int(11) NOT NULL,
  `nombreCliente` varchar(255) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(20) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `informacion` text DEFAULT NULL,
  `tipoCliente` varchar(100) DEFAULT NULL,
  `preferencia` varchar(100) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fechaUltimaActividad` date DEFAULT NULL,
  `estadoCuenta` varchar(100) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`idCliente`, `nombreCliente`, `apellidoPaterno`, `apellidoMaterno`, `direccion`, `ciudad`, `estado`, `codigoPostal`, `pais`, `fechaRegistro`, `informacion`, `tipoCliente`, `preferencia`, `notas`, `fechaUltimaActividad`, `estadoCuenta`, `fechaNacimiento`, `foto`) VALUES
(1, 'Cliente A', 'Gómez', 'Hernández', 'Av. Principal 789', 'Ciudad C', 'Estado C', '67890', 'País C', '2023-05-10 12:00:00', 'Información sobre el cliente A', 'Tipo A', 'Preferencia A', 'Notas adicionales sobre el cliente A', '2024-04-25', 'Activo', '1990-05-15 00:00:00', 'fotoc1.png'),
(2, 'Cliente B', 'Díaz', 'Torres', 'Calle Secundaria 321', 'Ciudad D', 'Estado D', '09876', 'País D', '2023-06-20 14:00:00', 'Descripción del cliente B', 'Tipo B', 'Preferencia B', 'Detalles adicionales sobre el cliente B', '2024-05-01', 'Inactivo', '1985-07-20 00:00:00', 'fotoc2.png'),
(3, 'Cliente C', 'Hernández', 'Martínez', 'Ruta Principal 753', 'Ciudad E', 'Estado E', '35791', 'País E', '2023-07-25 15:00:00', 'Información sobre el cliente C', 'Tipo C', 'Preferencia C', 'Notas adicionales sobre el cliente C', '2024-06-10', 'Activo', '1995-08-10 00:00:00', 'fotoc3.png'),
(4, 'Cliente D', 'García', 'López', 'Plaza Secundaria 147', 'Ciudad F', 'Estado F', '57913', 'País F', '2023-08-30 16:00:00', 'Descripción del cliente D', 'Tipo D', 'Preferencia D', 'Detalles adicionales sobre el cliente D', '2024-07-15', 'Activo', '1992-09-25 00:00:00', 'fotoc4.png'),
(5, 'Cliente E', 'López', 'Gómez', 'Calle Importante 369', 'Ciudad G', 'Estado G', '79135', 'País G', '2023-09-15 17:00:00', 'Información sobre el cliente E', 'Tipo E', 'Preferencia E', 'Notas adicionales sobre el cliente E', '2024-08-20', 'Activo', '1988-10-05 00:00:00', 'fotoc5.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactocliente`
--

CREATE TABLE `contactocliente` (
  `idContacto` int(11) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipoTelefono` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `horaAtencionSemana` varchar(50) DEFAULT NULL,
  `horaAtencionFinseman` varchar(50) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `idTipoContato` int(11) DEFAULT NULL,
  `Tipo` varchar(100) DEFAULT NULL,
  `genero` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactocliente`
--

INSERT INTO `contactocliente` (`idContacto`, `idCliente`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `tipoTelefono`, `email`, `password`, `horaAtencionSemana`, `horaAtencionFinseman`, `notas`, `idTipoContato`, `Tipo`, `genero`) VALUES
(1, 1, 'Laura', 'González', 'Pérez', '555-1111', 'Celular', 'laura@clienteA.com', 'hashedpassword1', '09:00-18:00', '10:00-14:00', 'Notas sobre Laura', 1, 'Cliente', NULL),
(2, 1, 'Carlos', 'Martínez', 'Gómez', '555-2222', 'Oficina', 'carlos@clienteA.com', 'hashedpassword2', '08:30-17:30', '09:30-13:30', 'Notas sobre Carlos', 2, 'Cliente', NULL),
(3, 2, 'Sofía', 'Hernández', 'Sánchez', '555-3333', 'Celular', 'sofia@clienteB.com', 'hashedpassword3', '08:00-17:00', '11:00-15:00', 'Notas sobre Sofía', 1, 'Cliente', NULL),
(4, 2, 'Javier', 'López', 'Torres', '555-4444', 'Oficina', 'javier@clienteB.com', 'hashedpassword4', '09:30-18:30', '10:30-14:30', 'Notas sobre Javier', 2, 'Cliente', NULL),
(5, 3, 'Eva', 'García', 'Martínez', '555-5555', 'Celular', 'eva@clienteC.com', 'hashedpassword5', '08:00-17:00', '11:00-15:00', 'Notas sobre Eva', 1, 'Cliente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactoproveedor`
--

CREATE TABLE `contactoproveedor` (
  `idContacto` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `nombreProveedor` varchar(255) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `tipoTelefono` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `horaAtencionSemana` varchar(30) DEFAULT NULL,
  `horaAtencionFinsemana` varchar(30) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `idTipoContacto` int(11) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `genero` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactoproveedor`
--

INSERT INTO `contactoproveedor` (`idContacto`, `idProveedor`, `nombreProveedor`, `apellidoPaterno`, `apellidoMaterno`, `telefono`, `tipoTelefono`, `email`, `password`, `horaAtencionSemana`, `horaAtencionFinsemana`, `notas`, `idTipoContacto`, `foto`, `genero`) VALUES
(1, 1, 'Juan', 'González', 'López', '555-1234', 'Oficina', 'juan@empresaA.com', 'hashedpassword1', '08:00 a 17:00', '10:00 a 14:00', 'Notas sobre Juan', 1, '1.png', NULL),
(2, 1, 'María', 'Martínez', 'Ramírez', '555-5678', 'Celular', 'maria@empresaA.com', 'hashedpassword2', '09:00 a 18:00', '11:00 a 15:00', 'Notas sobre María', 2, '2.png', NULL),
(3, 2, 'Pedro', 'Sánchez', 'Pérez', '555-9876', 'Oficina', 'pedro@empresaB.com', 'hashedpassword3', '08:30 a 17:30', '09:30 a 13:30', 'Notas sobre Pedro', 1, '3.png', NULL),
(4, 2, 'Ana', 'López', 'García', '555-4321', 'Celular', 'ana@empresaB.com', 'hashedpassword4', '09:30 a 18:30', '10:30 a 14:30', 'Notas sobre Ana', 2, '4.png', NULL),
(5, 3, 'Pablo', 'Hernández', 'Martínez', '555-2468', 'Oficina', 'pablo@empresaC.com', 'hashedpassword5', '08:00 a 17:00', '11:00 a 15:00', 'Notas sobre Pablo', 1, '5.png', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratoscliente`
--

CREATE TABLE `contratoscliente` (
  `idContrato` int(11) NOT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `estadoContrato` varchar(100) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratoscliente`
--

INSERT INTO `contratoscliente` (`idContrato`, `fechaInicio`, `fechaFin`, `estadoContrato`, `idCliente`) VALUES
(1, '2023-07-01 00:00:00', '2024-06-30 00:00:00', 'Vigente', 1),
(2, '2023-08-15 00:00:00', '2023-12-31 00:00:00', 'Vencido', 2),
(3, '2023-09-20 00:00:00', '2024-09-19 00:00:00', 'Vigente', 3),
(4, '2023-10-10 00:00:00', '2023-12-09 00:00:00', 'Vigente', 4),
(5, '2023-11-15 00:00:00', '2023-11-30 00:00:00', 'Vencido', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratosproveedor`
--

CREATE TABLE `contratosproveedor` (
  `idContrato` int(11) NOT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `estadoContrato` varchar(100) DEFAULT NULL,
  `idProveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contratosproveedor`
--

INSERT INTO `contratosproveedor` (`idContrato`, `fechaInicio`, `fechaFin`, `estadoContrato`, `idProveedor`) VALUES
(1, '2023-03-01 00:00:00', '2024-02-29 00:00:00', 'Vigente', 1),
(2, '2023-04-15 00:00:00', '2023-10-14 00:00:00', 'Vencido', 2),
(3, '2023-05-20 00:00:00', '2024-05-19 00:00:00', 'Vigente', 3),
(4, '2023-06-10 00:00:00', '2023-12-09 00:00:00', 'Vigente', 4),
(5, '2023-07-15 00:00:00', '2023-11-14 00:00:00', 'Vencido', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correosforms`
--

CREATE TABLE `correosforms` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `formName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `correosforms`
--

INSERT INTO `correosforms` (`id`, `email`, `formName`) VALUES
(12, 'marcalvarez177@gmail.com', 'ESColaboradores'),
(14, 'marcalvarez392@gmail.com', 'vacanteLaboral'),
(17, 'marcalvarez900@gmail.com', 'vacanteLaboral'),
(20, 'hhshd0158@gmail.com', 'SolicitudMercancia'),
(21, 'marcalvarez900@gmail.com', 'SolicitudMercancia'),
(23, 'prueba@correo.com', 'repIncidencias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `idDepto` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepto`, `nombre`) VALUES
(1, 'Administracion'),
(2, 'Laboratorio'),
(3, 'Mantenimiento industrial'),
(4, 'Taller automotriz'),
(5, 'Logistica'),
(6, 'Sindicato'),
(7, 'Vigilancia'),
(8, 'Seguridad industrial'),
(9, 'Almacen maiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombreEmpleado` varchar(255) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `fechaNacimiento` datetime DEFAULT NULL,
  `genero` varchar(20) DEFAULT NULL,
  `emailEmpleado` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `hashed_password` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(20) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `fechaContratacion` datetime DEFAULT NULL,
  `salario` decimal(10,2) DEFAULT NULL,
  `noEmpleado` varchar(50) DEFAULT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `tipoEmpleado` varchar(100) DEFAULT NULL,
  `estadoEmpleado` varchar(100) DEFAULT NULL,
  `fechaUltimaActividad` date DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `numeroSeguroSocial` varchar(50) DEFAULT NULL,
  `tipoSnage` varchar(100) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  `idRol` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `verification_code` varchar(64) DEFAULT NULL,
  `correo_verificado` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombreEmpleado`, `apellidoPaterno`, `apellidoMaterno`, `fechaNacimiento`, `genero`, `emailEmpleado`, `password`, `hashed_password`, `telefono`, `direccion`, `ciudad`, `estado`, `codigoPostal`, `pais`, `fechaContratacion`, `salario`, `noEmpleado`, `tipo`, `tipoEmpleado`, `estadoEmpleado`, `fechaUltimaActividad`, `notas`, `numeroSeguroSocial`, `tipoSnage`, `rfc`, `idDepartamento`, `idRol`, `foto`, `verification_code`, `correo_verificado`) VALUES
(1, 'Juan', 'Martínez', 'Gómez', '1990-05-15 00:00:00', 'Masculino', 'juan@empresa.com', 'hashedpassword1', '$2y$10$uSlGJEYJyOeS4wWbYneb5e4EepVtQcmEwQXB8PYAWAPQC0ST2OyLy', '555-1234', 'Calle Principal 123', 'Ciudad A', 'Estado A', '12345', 'País A', '2018-01-15 08:00:00', 35000.00, 'EM001', NULL, 'Empleado', 'Activo', '2024-05-20', 'Notas sobre Juan', '12345678901234567', 'Tipo A', 'RFC12345678', 1, 1, 'foto1.png', NULL, 0),
(2, 'María', 'López', 'Hernández', '1995-08-10 00:00:00', 'Femenino', 'maria@empresa.com', 'hashedpassword2', '$2y$10$QWpewNwj2P6SLpjNcd47ZupjlHk2EBhTPht4YIReNicHprCnlWz3W', '555-5678', 'Avenida Secundaria 456', 'Ciudad B', 'Estado B', '54321', 'País B', '2019-02-20 09:30:00', 30000.00, 'EM002', NULL, 'Empleado', 'Activo', '2024-06-01', 'Notas sobre María', '98765432109876543', 'Tipo B', 'RFC87654321', 2, 2, 'foto2.png', NULL, 0),
(3, 'Pedro', 'Sánchez', 'García', '1985-07-20 00:00:00', 'Masculino', 'pedro@empresa.com', '1234', '$2y$10$rP.Uc25ClAyFmfDhNoObLOmt7AO50mz4A42Ho.HmpfXDjCcD9uVsi', '555-9876', 'Av. Importante 789', 'Ciudad C', 'Estado C', '67890', 'País C', '2020-03-25 10:00:00', 40000.00, 'EM003', NULL, 'Empleado', 'Activo', '2024-07-05', 'Notas sobre Pedro', '24680135792468013', 'Tipo C', 'RFC24680135', 3, 1, 'foto3.png', NULL, 0),
(4, 'Ana', 'Rodríguez', 'Martínez', '1992-09-25 00:00:00', 'Femenino', 'ana@empresa.com', 'hashedpassword4', '$2y$10$pGtCUkPKabmVA52xjbBxseP/po.OJF24BWUbXPA4co8AN2usBDmUm', '555-4321', 'Plaza Principal 246', 'Ciudad D', 'Estado D', '98765', 'País D', '2021-04-30 11:30:00', 38000.00, 'EM004', NULL, 'Empleado', 'Activo', '2024-08-10', 'Notas sobre Ana', '13579246801357924', 'Tipo D', 'RFC13579246', 4, 3, 'foto4.png', NULL, 0),
(5, 'Carlos', 'Gómez', 'López', '1988-10-05 00:00:00', 'Masculino', 'carlos@empresa.com', 'hashedpassword5', '$2y$10$lu.WirESBMRWPpYNFleqjuVmAEj4X.IU00jiOdk/MizDuvy.oRWqq', '555-2468', 'Ruta Secundaria 753', 'Ciudad E', 'Estado E', '13579', 'País E', '2022-05-15 12:00:00', 42000.00, 'EM005', NULL, 'Empleado', 'Activo', '2024-09-20', 'Notas sobre Carlos', '36925814703692581', 'Tipo E', 'RFC36925814', 5, 3, 'foto5.png', NULL, 0),
(21, 'Juan Carlos', NULL, NULL, NULL, NULL, 'carlosmluna49@gmail.com', NULL, '$2y$10$FEqNiEqZMfJ3ToIaQFHmcuH7bK9oRepRygIi4z3hiB7PfRgPKFAMW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, 0),
(22, 'Manueldfssdf', 'dsfsdfsdfsdf', 'dsfsdfssdfsdfs', '2024-07-05 00:00:00', 'Masculino', 'sdfsdfssd@gmial.com', NULL, '$2y$10$R7GTkT6UuODOaNq61AySeujhBzPwKVZV5g9JqybYpnZ8dFc5G/G4K', '4578912', 'JKSDJKSD', 'Puebladssd', 'Pueblasdsd', '789456', 'Mexicodsed', '2024-07-10 00:00:00', 78421.00, 'Emm09s', NULL, NULL, 'Activo', NULL, 'notas', '4sdfs', NULL, 'sadsfsdfs', 5, 1, NULL, NULL, 0),
(23, 'MARC', 'ALVAREZ', 'RUGERIO', NULL, NULL, 'marcalvarez392@gmail.com', '1234', NULL, '2218237538', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EM0077', 'Empleado', NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0),
(24, 'MARC', 'ALVAREZ', 'RUGERIO', NULL, NULL, 'marcalvarez392@gmail.com', NULL, NULL, '2218237538', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'EM0077', 'Empleado', NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 0),
(94, 'Víctor', 'Jiménez', 'Hernández', NULL, NULL, 'vijiher@gmail.com', NULL, NULL, '(221) 738-2157', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '32', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(95, 'Fermín', 'Vivanco', 'Orduño', NULL, NULL, 'vivancoordunofermin@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '430', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(96, 'Aarón', 'García', 'Amador', NULL, NULL, 'garciaaaron24168@gmail.com', NULL, NULL, '(222) 859-9571', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '407', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(97, 'René Gerónimo', 'Luna', 'Bueno', NULL, NULL, 'geronimo84luna@gmail.com', NULL, NULL, '(221) 141-8351', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '231', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(98, 'Alberto', 'Robles', 'Pineda', NULL, NULL, 'eljaguarrobles3@gmail.com', NULL, NULL, '(222) 858-1605', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '148', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(99, 'Alfredo', 'Bravo', 'Luna', NULL, NULL, NULL, NULL, NULL, '(221) 258-0145', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '102', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(100, 'Guillermo', 'Cházari', 'Mártínez', NULL, NULL, 'duende.chazari2112@gmail.com', NULL, NULL, '(222) 709-5694', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '116', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(101, 'Joel', 'Juárez', 'Rueda', NULL, NULL, NULL, NULL, NULL, '(222) 426-8651', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '317', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(102, 'Hernán', 'Sánchez', 'Flores', NULL, NULL, 'hernansanchezflores@gmail.com', NULL, NULL, '(222) 345-1960', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '389', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(103, 'Job Andrés', 'Juárez', 'Cuatepotzo', NULL, NULL, 'andresjobjuarez8@gmail.com', NULL, NULL, '(222) 308-8399', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '186', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(104, 'Clemente', 'Mata', 'Ortiz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '339', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(105, 'Quirino', 'Luna', 'Pérez', NULL, NULL, 'quirinoluna64@gmail.com', NULL, NULL, '(222) 781-7605', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '124', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(106, 'Isidro', 'García', 'Candelario', NULL, NULL, 'ig0442511@gmail.com', NULL, NULL, '(222) 429-2252', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '418', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(107, 'Eduardo', 'Lobato', 'Pérez', NULL, NULL, 'eduardolobatho@gmail.com', NULL, NULL, '(222) 656-9911', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '200', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(108, 'José Félix', 'Cortés', 'Martínez', NULL, NULL, NULL, NULL, NULL, '(222) 833-6530', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '86', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(109, 'José Ernesto Andrés', 'Luna', 'García', NULL, NULL, NULL, NULL, NULL, '(222) 842-3632', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '10', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(110, 'Félix', 'Ortiz', 'Hernández', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 335-1095', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '245', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(111, 'Andrés Elías', 'Jerónimo', 'Santiago', NULL, NULL, 'esme281114@gmail.com', NULL, NULL, '(221) 224-7823', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '238', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(112, 'Guadalupe', 'DeGaona', 'Santiago', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 897-6171', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '349', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(113, 'Alberto', 'Arce', 'Pérez', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '360', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(114, 'David', 'Cortés', 'Trinidad', NULL, NULL, 'moricks007@gmail.com', NULL, NULL, '(222) 327-1166', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '425', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(115, 'Ana Karen', 'Sosa', 'Carvajal', NULL, NULL, 'sosak4095@gmail.com', NULL, NULL, '(221) 427-5299', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '197', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(116, 'Oscar', 'Sánchez', 'Méndez', NULL, NULL, 'mantenimientoindustrial@horiente.mx', NULL, NULL, '(222) 330-3447', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(117, 'Luis Harón', 'Arce', 'Luna', NULL, NULL, 'haronarce43@gmail.com', NULL, NULL, '(222) 857-2387', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '78', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(118, 'José David', 'Muñoz', 'Ramírez', NULL, NULL, 'mantenimientoautomotriz@horiente.mx', NULL, NULL, '(222) 694-8792', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '322', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(119, 'Martín', 'Hernánez', 'Medardo', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(120, 'Marco Iván', 'Hernández', 'Pérez', NULL, NULL, 'marco.perez.0997@gmail.com', NULL, NULL, '(222) 906-7424', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '276', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(121, 'Daniel Fernando', 'Domínguez', 'Pérez', NULL, NULL, 'tlatzdaniel@gmail.com', NULL, NULL, '(222) 910-8209', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '302', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(122, 'Luis', 'Peña', 'Chávez', NULL, NULL, 'penachavezluis623@gmail.com', NULL, NULL, '(221) 147-6568', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '264', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(123, 'Erick Jafeth', 'Cortez', 'Alto', NULL, NULL, 'karnales71@gmail.com', NULL, NULL, '(222) 851-4987', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '241', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(124, 'Jorge', 'Ignacio', 'Arce', NULL, NULL, 'jorge.ignacioho@gmail.com', NULL, NULL, '(222) 657-5582', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '193', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(125, 'Román', 'Francisco', 'Martín', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 494-0672', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(126, 'Antonio Francisco', 'Arce', 'Mazano', NULL, NULL, 'ant_o_nio21@hotmail.com', NULL, NULL, '(221) 531-0532', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '357', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(127, 'Cirilo', 'Pérez', 'Sánchez', NULL, NULL, 'pcirilo954@gmail.com', NULL, NULL, '(221) 637-2101', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '256', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(128, 'Mariel', 'Álvarez', 'González', NULL, NULL, 'ceomejoracontinua@horiente.mx', NULL, NULL, '(225) 121-0600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '227', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(129, 'Ana Lilia', 'Fernández', 'Tecuapacho', NULL, NULL, 'laboratorio1@horiente.mx', NULL, NULL, '(246) 211-8862', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '308', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(130, 'Raúl Carlos', 'Manzano', 'Arce', NULL, NULL, 'raulitocarlos37@gmail.com', NULL, NULL, '(222) 696-8876', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '232', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(131, 'Erick', 'Herrera', 'González', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '199', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(132, 'Pascual Federico', 'Pérez', 'Flores', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 371-1964', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '201', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(133, 'Cristofer Jonathan', 'Arce', 'Conde', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 827-4847', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '417', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(134, 'Adán', 'Rodríguez', 'Hernández', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 247-0858', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '27', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(135, 'Javier', 'Domínguez', 'Arce', NULL, NULL, 'javier1995enero11@gmail.com', NULL, NULL, '(221) 126-4651', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '144', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(136, 'Pedro', 'Guzmán', 'Pérez', NULL, NULL, 'dhaguzmanperezd@gmail.com', NULL, NULL, '(221) 626-2844', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '402', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(137, 'Conde', 'Manzano', 'Ernesto', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '76', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(138, 'Marcial', 'Sánchez', 'Enríquez', NULL, NULL, 'marcialsanchezenriquez@gmail.com', NULL, NULL, '(222) 319-8897', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '314', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(139, 'Leonardo', 'Tecayatzi', 'Luna', NULL, NULL, 'tecayatzilunaleonardo@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '416', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(140, 'Aureliano', 'Luna', 'Pérez', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 414-8659', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '136', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(141, 'Flavio Miguel', 'Bueno', 'García', NULL, NULL, 'flaviomiguelbueno@gmail.com', NULL, NULL, '(222) 308-4950', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '363', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(142, 'Gaudencio', 'Martín', 'Martín', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 559-1444', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '41', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(143, 'Bartolo', 'García', 'Hernández', NULL, NULL, 'gestoria@horiente.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '33', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(144, 'Melitón Eduardo', 'Pérez', 'Pérez', NULL, NULL, 'laloperez142002@gmail.com', NULL, NULL, '(222) 355-7115', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '400', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(145, 'Luis Pedro', 'Arce', 'Arce', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '46', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(146, 'Andrés', 'Trinidad', 'Reyes', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 582-6601', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '297', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(147, 'Francisco Jonathan', 'Bueno', 'Amador', NULL, NULL, 'amadorfrancisco1260@gmail.com', NULL, NULL, '(222) 551-5957', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '386', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(148, 'Faustino', 'Méndez', 'López', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 420-5661', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '169', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(149, 'Gaspar', 'Méndez', 'Gómez', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '132', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(150, 'Antonio', 'Cruz', 'García', NULL, NULL, 'cruzz_garcia@live.com', NULL, NULL, '(222) 429-2240', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '310', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(151, 'Alma Yessica', 'Gómez', 'Cruz', NULL, NULL, 'alma.karou@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '329', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(152, 'Ocotlán', 'Pérez', 'Pérez', NULL, NULL, 'gestoria@gmail.com', NULL, NULL, '(221) 377-5469', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '52', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(153, 'Mateo', 'García', 'Vicente', NULL, NULL, '1matgv021@gmail.com', NULL, NULL, '(221) 703-2387', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '334', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(154, 'Gerardo', 'Rodríguez', 'Victoriano', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 408-9283', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(155, 'Arnulfo', 'Pérez', 'Pérez', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(221) 139-0314', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '183', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(156, 'José Gabriel', 'Cházari', 'Martínez', NULL, NULL, 'josegabrielchazari@gmail.com', NULL, NULL, '(222) 429-2251', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '101', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(157, 'José Luis', 'Romero', 'Trinidad', NULL, NULL, 'ventascorp@horiente.mx', NULL, NULL, '(222) 429-2245', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '217', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(158, 'José Daniel', 'Mata', 'Ortiz', NULL, NULL, 'matitaortiz21@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '404', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(159, 'Rubén', 'Guevara', 'Santiago', NULL, NULL, 'rubenguevara1111@gmail.com', NULL, NULL, '(222) 813-0638', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '347', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(160, 'Jorge', 'Reyes', 'Potrero', NULL, NULL, 'jorgechosa85@gmail.com', NULL, NULL, '(222) 563-0446', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '26', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(161, 'Berenice Sarahí', 'Herrera', 'Luna', NULL, NULL, 'recursoshumanos@horiente.mx', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '213', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(162, 'Elizabeth', 'Hernández', 'Laureno', NULL, NULL, 'recursoshumanos@horiente.mx', NULL, NULL, '(222) 416-7437', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(163, 'Erica', 'Tlatelpa', 'Tieco', NULL, NULL, 'compras@horiente.mx', NULL, NULL, '(222) 891-7500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '415', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(164, 'Nallely', 'Tlatelpa', 'Tieco', NULL, NULL, 'conta2@horiente.mx', NULL, NULL, '(221) 230-8796', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '385', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(165, 'Juan Eduardo', 'Pérez', 'Ocotitla', NULL, NULL, 'contabilidad@horiente.mx', NULL, NULL, '(221) 111-7854', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '327', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(166, 'Candelario', 'García', 'Rodríguez', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 275-9970', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(167, 'Miguel Uriel', 'García', 'Ortega', NULL, NULL, 'urielortega010@gmail.com', NULL, NULL, '(222) 377-7942', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '275', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(168, 'Alexis', 'Reyes', 'Gaspariano', NULL, NULL, 'alexisreyesgaspariano456@gmail.com', NULL, NULL, '(222) 280-3551', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '410', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(169, 'Ángel Fernando', 'Sánchez', 'Vera', NULL, NULL, 'angelho501@gmail.com', NULL, NULL, '(222) 429-2248', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '80', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(170, 'Luciano Martín', 'Trinidad', 'Reyes', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 450-7471', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '11', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(171, 'Mario Sergio', 'Alcántara', 'Monterrosas', NULL, NULL, 'compras@horiente.mx', NULL, NULL, '(222) 156-2199', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '44', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(172, 'Stephanie', 'Duarte', 'Gómez', NULL, NULL, 'fani.duarteg@gmail.com', NULL, NULL, '(221) 267-1775', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '433', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(173, 'Alejandra', 'García', 'López', NULL, NULL, 'contaharinera@horiente.mx', NULL, NULL, '(222) 344-7661', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '71', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(174, 'José Guadalupe', 'González', 'Reyes', NULL, NULL, 'contraloria@horiente.com', NULL, NULL, '(222) 563-0429', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '15', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(175, 'Oscar', 'Jiménez', 'Romero', NULL, NULL, 'gestoria@horiente.mx', NULL, NULL, '(222) 661-3710', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '55', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(176, 'Elizabeth', 'Herrera', 'Luna', NULL, NULL, 'facturacion@horiente.mx', NULL, NULL, '(222) 432-3244', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '355', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(177, 'Yolanda', 'Pérez', 'Sánchez', NULL, NULL, 'creditoycobranza@horiente.mx', NULL, NULL, '(222) 272-7230', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '236', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(178, 'Karla', 'Meza', 'Palomino', NULL, NULL, 'comunicacionadd@horiente.mx', NULL, NULL, '(221) 412-4782', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '382', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(179, 'Abigail', 'Ramírez', 'Esparza', NULL, NULL, 'gestiondecalidad@horiente.mx', NULL, NULL, '(248) 124-3739', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '152', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(180, 'Juan Carlos', 'Monroy', 'Martínez', NULL, NULL, 'direccion@horiente.mx', NULL, NULL, '(222) 172-8953', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '13', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(181, 'José Luis', 'Argüello', 'Ortiz', NULL, NULL, 'ventascorp@horiente.mx', NULL, NULL, '(222) 429-2109', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '374', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(182, 'Juan', 'Hernández', 'Cabrera', NULL, NULL, 'ventasmaiz@horiente.mx', NULL, NULL, '(222) 429-2249', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(183, 'Alejandra', 'Juarez', 'Tecayehuatl', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '344', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(184, 'Lizbeth', 'Barrera', 'Amelco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '352', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 3, NULL, NULL, 0),
(185, 'Javier', 'Cruz', 'Pacheco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '42', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(186, 'Jaime Enrique', 'Merino', 'Olivares', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '62', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(187, 'Manuel', 'Lopez', 'Pacheco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '209', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 7, 3, NULL, NULL, 0),
(188, 'Jose Mauricio', 'Alvarez', 'Gonzalez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '74', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(189, 'Eustolia', 'Santiago', 'Sanchez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '261', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 2, 3, NULL, NULL, 0),
(190, 'Miguel', 'Sanchez', 'Flores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '69', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(191, 'Isidro', 'De Aurelio', 'Ramirez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '226', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(192, 'Jose Juan', 'Velazquez', 'Ascencion', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '251', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(193, 'Eduardo Vicente', 'Pacheco', 'Hernandez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '298', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(194, 'Luis Gerardo', 'Torres', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '307', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(195, 'Martin', 'Flores', 'Ramirez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '311', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(196, 'Antonio De', 'Aguila', 'Ruiz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '369', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(197, 'Ramiro', 'Valdez', 'Mora', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '438', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 5, 3, NULL, NULL, 0),
(198, 'Jose Vicente', 'Torres', 'Muñoz', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 9, 3, NULL, NULL, 0),
(199, 'Jose Abraham', 'Ramos', 'Sosa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '431', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(200, 'Gustavo', 'Sanchez', 'Mendez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '432', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 3, 3, NULL, NULL, 0),
(201, 'Bartolome', 'Camacho', 'Lezama', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '17', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(202, 'Pascual', 'Martin', 'Martin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '35', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(203, 'Jose Juan', 'Amador', 'Zepeda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '58', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(204, 'Salomon', 'Arce', 'Luna', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '72', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(205, 'Julian Luis', 'Zepeda', 'Bueno', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '79', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(206, 'Francisco', 'Martin', 'Hernandez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '94', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(207, 'Juventino', 'De Gaona', 'Santiago', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '109', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(208, 'Luis Angel', 'Arce', 'Rojas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '160', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(209, 'Moises', 'Zepeda', 'Flores', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '176', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(210, 'Israel', 'Lucero', 'Vidal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '219', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(211, 'Orlando Eusebio', 'Perez', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '254', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(212, 'Oscar', 'Luna', 'Arce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '270', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(213, 'Cesar', 'Luna', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '277', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(214, 'Felix', 'Perez', 'Sanchez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '291', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(215, 'Miguel', 'Conde', 'Rojas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '301', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(216, 'Luis Miguel', 'Luna', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '315', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(217, 'Agustin Frumencio', 'Peña', 'Chavez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '333', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(218, 'Felipe', 'Tirzo', 'Sanchez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '335', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(219, 'Jonathan', 'Sanchez', 'Enriquez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '350', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(220, 'Carlos Alberto', 'Lucero', 'Vidal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '351', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(221, 'Alexis', 'Reyes', 'Lopez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '358', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(222, 'Marco Antonio', 'Amador', 'Garcia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '359', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(223, 'Jaime', 'Flores', 'Manzano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '366', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(224, 'Lorenzo', 'Flores', 'Manzano', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '394', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(225, 'Cesar Ivan', 'Rojas', 'Tlatelpa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '399', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(226, 'Miguel Angel', 'Flores', 'Dominguez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '401', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(227, 'Adolfo', 'Arce', 'Zepeda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '411', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(228, 'Antoni', 'Peña', 'Chavez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '413', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(229, 'Luis Gonzalo', 'Flores', 'Sanchez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '419', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(230, 'Felix Gustavo', 'Hernandez', 'Piña', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '420', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(231, 'Roberto Carlos', 'Alvarado', 'Tlacomulco', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '427', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(232, 'Javier Francisco', 'Perez', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '428', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(233, 'Julio', 'Arce', 'Perez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '434', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(234, 'Miguel Osvaldo', 'Gonzalez', 'Xaxalpa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '435', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(235, 'Angel Omar', 'Arce', 'Arce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '436', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(236, 'Luis Antonio', 'Lopez', 'Arce', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '437', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(237, 'Martin', 'Aparicio', 'Mil', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '439', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 6, 3, NULL, NULL, 0),
(238, 'Admin', 'Admin', 'Admin', NULL, 'masculino', 'admin@horiente.mx', 'abcd1234', NULL, NULL, 'Admin', 'Admin', 'Admin', NULL, 'Admin', NULL, 155555.00, '439', 'Admin', 'Admin', 'Activo', NULL, 'Admin', '121212121212', NULL, NULL, 1, 1, NULL, NULL, 0),
(239, 'MARC', 'Alvarez', 'RUGERIO', '2000-11-23 00:00:00', 'Masculino', 'marcalvarez392@gmail.com', NULL, '$2y$10$oHq5DLUmeb55Ani8VFnC6.iFX7zWl1kpIoZThToTKBy77QBobbgMe', '2218237538', '36 de Los Andes', 'Puebla', 'Pue.', '72229', 'México', '2024-08-04 00:00:00', 10000.00, '11', NULL, NULL, 'Activo', NULL, 'hola', '112232', NULL, '2323232323', 1, 1, NULL, NULL, 0),
(240, 'Juan', 'Pérez', 'Gómez', NULL, NULL, 'test@example.com', 'password123', NULL, '555-1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, 0),
(241, '', 'Apellido1', 'Apellido2', NULL, NULL, '', 'Marc', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, 0),
(242, '1234', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez@gmail.com', 'Marc', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, 0),
(243, 'Marc', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez3921@gmail.com', '1234', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 2, NULL, NULL, 0),
(244, 'Marc', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez39200@gmail.com', '1234', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0),
(245, 'Marc', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez39299@gmail.com', '$2y$10$yi38CI0UmUwU7S6eDysHEO8S7gOUHXW/.X5nOzCtbQKDmKwqOWLfa', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0),
(246, 'Marc', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez39288@gmail.com', '$2y$10$oxcGJNROG18j4fKyM.Hq4uMMprmxj0IX1OhnE13zZ/5m5.dtRTIvy', NULL, '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0),
(247, 'Marc', 'Apellido1', 'Apellido2', NULL, NULL, 'marcalvarez392111@gmail.com', NULL, '$2y$10$ltcVe.2Kg9BxwnSyJoZmCuJV5g1Tz0zyxjFvwBPIkaeESlACDy6ga', '000-000-0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, 'Activo', NULL, NULL, NULL, NULL, NULL, 1, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escolaboradores`
--

CREATE TABLE `escolaboradores` (
  `id` int(11) NOT NULL,
  `noEmpleado` varchar(20) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `nombreEmpleado` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(50) NOT NULL,
  `apellidoMaterno` varchar(50) NOT NULL,
  `emailEmpleado` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `folio` int(11) NOT NULL,
  `fecha_solicitud` datetime NOT NULL,
  `propietario_equipo` varchar(100) NOT NULL,
  `entrada_salida` varchar(10) NOT NULL,
  `fecha_devolucion` date NOT NULL,
  `motivo` text NOT NULL,
  `evidencia` text NOT NULL,
  `nombre_colaborador` varchar(100) NOT NULL,
  `firma_responsable` text NOT NULL,
  `aceptacion_responsabilidad` text NOT NULL,
  `nombre_autorizador` varchar(100) NOT NULL,
  `correo_autorizador` varchar(100) NOT NULL,
  `firma_autorizador` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escolaboradores`
--

INSERT INTO `escolaboradores` (`id`, `noEmpleado`, `idDepartamento`, `nombreEmpleado`, `apellidoPaterno`, `apellidoMaterno`, `emailEmpleado`, `telefono`, `folio`, `fecha_solicitud`, `propietario_equipo`, `entrada_salida`, `fecha_devolucion`, `motivo`, `evidencia`, `nombre_colaborador`, `firma_responsable`, `aceptacion_responsabilidad`, `nombre_autorizador`, `correo_autorizador`, `firma_autorizador`) VALUES
(30, '11', 1, 'Marc Anthony ', 'Alvarez', 'Rugerio', 'marcalvarez392@gmail.com', '22184598', 50, '2024-08-07 17:13:47', 'Uso personal', 'Salida', '2024-08-10', 'Hola', '66b3ffd721b6f6.25874801.png, 66b3ffd7217cc3.78259712.jpg', '12', 'Si', 'Si', 'Si', 'marcalvarez392@gmail.com', 'Si'),
(31, '11', 1, 'MARC', 'Alvarez', 'RUGERIO', 'marcalvarez392@gmail.com', '2218237538', 51, '2024-08-07 18:53:31', 'Harinera de Oriente', 'Entrada', '2024-08-08', '1212121', '66b4172d4622c0.95828922.png,66b4172d4659f1.50308176.jpg,66b4172d468328.55341526.png,66b4172d46b785.32466496.jpg,66b4172d46e0b9.76524467.jpg', '12', '', '', 'Marc', 'marcalvarez392@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esvisitantes`
--

CREATE TABLE `esvisitantes` (
  `id` int(11) NOT NULL,
  `fechaSolicitud` datetime NOT NULL,
  `nombreEmpresa` varchar(255) NOT NULL,
  `nombreVisitante` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `folio` int(11) NOT NULL,
  `prioridad` enum('Harinera de Oriente','Uso personal') NOT NULL,
  `entradaOsalida` enum('Entrada','Salida') NOT NULL,
  `fechaDevolucion` date NOT NULL,
  `finesUtilizacion` text NOT NULL,
  `nombreResponsable` varchar(255) NOT NULL,
  `firmaDeresponsable` text NOT NULL,
  `aceptacionResponsabilidad` varchar(10) NOT NULL,
  `nombreAUTho` varchar(255) NOT NULL,
  `correoAUTho` varchar(255) NOT NULL,
  `firmaAUTho` text NOT NULL,
  `evidencia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `esvisitantes`
--

INSERT INTO `esvisitantes` (`id`, `fechaSolicitud`, `nombreEmpresa`, `nombreVisitante`, `correo`, `telefono`, `folio`, `prioridad`, `entradaOsalida`, `fechaDevolucion`, `finesUtilizacion`, `nombreResponsable`, `firmaDeresponsable`, `aceptacionResponsabilidad`, `nombreAUTho`, `correoAUTho`, `firmaAUTho`, `evidencia`) VALUES
(13, '0000-00-00 00:00:00', '', '', '', '', 0, '', '', '0000-00-00', '', '', 'Si', 'Si', '', '', 'Si', ''),
(14, '2024-08-06 14:39:06', 'Mc', 'Marc', 'marcalvarez392@gmail.com', '2218237538', 1, 'Harinera de Oriente', 'Entrada', '0000-00-00', '12121212', '', '', '', '', '', '', '66b28a17e3ac63.24089502.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `esvisitantescaracteristicas`
--

CREATE TABLE `esvisitantescaracteristicas` (
  `id` int(11) NOT NULL,
  `ESVisitantes_id` int(11) NOT NULL,
  `tipoEquipo` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `modelo` varchar(255) NOT NULL,
  `numeroSerie` varchar(255) NOT NULL,
  `perteneceHO` enum('si','no') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `esvisitantescaracteristicas`
--

INSERT INTO `esvisitantescaracteristicas` (`id`, `ESVisitantes_id`, `tipoEquipo`, `marca`, `modelo`, `numeroSerie`, `perteneceHO`) VALUES
(9, 14, 'PC de escritorio', '1212', '12', '1212', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interaccion`
--

CREATE TABLE `interaccion` (
  `idInteraccion` int(11) NOT NULL,
  `fechaInteraccion` datetime DEFAULT NULL,
  `tipoInteraccion` varchar(100) DEFAULT NULL,
  `idCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `interaccion`
--

INSERT INTO `interaccion` (`idInteraccion`, `fechaInteraccion`, `tipoInteraccion`, `idCliente`) VALUES
(1, '2023-07-05 09:00:00', 'Consulta', 1),
(2, '2023-08-10 10:30:00', 'Solicitud', 2),
(3, '2023-09-15 11:45:00', 'Queja', 3),
(4, '2023-10-20 13:15:00', 'Consulta', 4),
(5, '2023-11-25 15:00:00', 'Solicitud', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mercancias_servicios`
--

CREATE TABLE `mercancias_servicios` (
  `id` int(11) NOT NULL,
  `soliMercaServi_id` int(11) DEFAULT NULL,
  `partida` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `mercancias_servicios`
--

INSERT INTO `mercancias_servicios` (`id`, `soliMercaServi_id`, `partida`, `cantidad`, `unidad`, `descripcion`) VALUES
(649, 657, 1, 1, '1', 'servicio'),
(650, 658, 1, 1, '1', 'servicio'),
(651, 659, 1, 1, '1', 'servicio'),
(652, 660, 1, 1, '4', 'servicio'),
(653, 661, 1, 1, '3', 'pza'),
(654, 662, 1, 1, '1', 'pza'),
(655, 663, 1, 1, '2', 'pza'),
(656, 664, 1, 1, '3', 'pza'),
(657, 665, 1, 1, '1', 'pza'),
(658, 666, 1, 1, '3', 'servicio'),
(659, 667, 1, 1, '1', 'pza'),
(660, 668, 1, 1, '40', 'kg'),
(661, 669, 1, 1, '1', 'pza'),
(662, 670, 1, 1, '1', 'pza'),
(663, 671, 1, 1, 'ANALISIS DE HARINA', 'pza'),
(664, 672, 1, 1, 'ANALISIS MENSUALES', 'servicio'),
(665, 673, 1, 1, '1', 'pza'),
(666, 674, 1, 1, '50', 'kg'),
(667, 675, 1, 1, '1', 'pza'),
(668, 676, 1, 1, '12', 'pza'),
(669, 677, 1, 1, '2', 'pza'),
(670, 678, 1, 1, '25', 'servicio'),
(671, 679, 1, 1, '1', 'servicio'),
(672, 680, 1, 1, '1', 'servicio'),
(673, 681, 1, 1, '1', 'servicio'),
(674, 682, 1, 2, '4', 'pza'),
(675, 683, 1, 1, '2', 'pza'),
(676, 684, 1, 1, '1', 'pza'),
(677, 685, 1, 1, '1', 'servicio'),
(678, 686, 1, 1, '3', 'pza'),
(679, 687, 1, 1, '50', 'mt'),
(680, 688, 1, 1, '1', 'servicio'),
(681, 689, 1, 1, '2', 'pza'),
(682, 690, 1, 1, '3', 'pza'),
(683, 691, 1, 1, '25', 'pza'),
(684, 692, 1, 1, '1', 'servicio'),
(685, 693, 1, 1, '2', 'pza'),
(686, 694, 1, 1, '1', 'servicio'),
(687, 695, 1, 1, '2', 'servicio'),
(688, 696, 1, 1, '6000', 'pza'),
(689, 697, 1, 1, '40', 'kg'),
(690, 698, 1, 1, '1', 'servicio'),
(691, 699, 1, 1, '1', 'servicio'),
(692, 700, 1, 1, '1', 'servicio'),
(693, 701, 1, 1, '1', 'pza'),
(694, 702, 1, 1, '17', 'servicio'),
(695, 703, 1, 1, '1', 'servicio'),
(696, 704, 1, 1, '1', 'pza'),
(697, 705, 1, 1, '1', 'servicio'),
(698, 706, 1, 1, '1', 'servicio'),
(699, 707, 1, 1, '1', 'servicio'),
(700, 708, 1, 1, '1', 'servicio'),
(701, 709, 1, 1, 'ANALISIS', 'servicio'),
(702, 710, 1, 1, '1', 'servicio'),
(703, 711, 1, 1, '20', 'LT'),
(704, 712, 1, 1, '1', 'servicio'),
(705, 713, 1, 1, '1', 'servicio'),
(706, 714, 1, 1, '1', 'servicio'),
(707, 715, 1, 1, '1', 'servicio'),
(708, 716, 1, 1, '1', 'servicio'),
(709, 717, 1, 1, '1', 'servicio'),
(710, 718, 1, 1, '1', 'pza'),
(711, 719, 1, 1, '1', 'servicio'),
(712, 720, 1, 1, '9', 'servicio'),
(713, 721, 1, 1, '1000', 'pza'),
(714, 722, 1, 1, '8', 'pza'),
(715, 723, 1, 1, '20', 'lt'),
(716, 724, 1, 1, '2', 'pza'),
(717, 725, 1, 1, '4', 'pza'),
(718, 726, 1, 1, '40', 'servicio'),
(719, 727, 1, 1, '40', 'kg'),
(720, 728, 1, 1, '1', 'servicio'),
(721, 729, 1, 1, '1', 'pza'),
(722, 730, 1, 1, '1', 'servicio'),
(723, 731, 1, 1, '2', 'pza'),
(724, 732, 1, 1, '1', 'pza'),
(725, 733, 1, 1, '1', 'pza'),
(726, 734, 1, 1, '8', 'pza'),
(727, 735, 1, 1, '3', 'kg'),
(728, 736, 1, 1, '2', 'pza'),
(729, 737, 1, 1, '1', 'pza'),
(730, 738, 1, 1, '1', 'pza'),
(731, 739, 1, 1, '1', 'servicio'),
(732, 740, 1, 1, '20', 'lt'),
(733, 741, 1, 1, '1', 'servicio'),
(734, 742, 1, 1, '1', 'servicio'),
(735, 743, 1, 1, '2', 'pza'),
(736, 744, 1, 1, '1', 'servicio'),
(737, 745, 1, 1, '1', 'servicio'),
(738, 746, 1, 1, '1', 'servicio'),
(739, 747, 1, 1, '3', 'pza'),
(740, 748, 1, 1, '1', 'servicio'),
(741, 749, 1, 1, '1', 'servicio'),
(742, 750, 1, 1, '1', 'servicio'),
(743, 751, 1, 1, '1', 'servicio'),
(744, 752, 1, 1, '30', 'pza'),
(745, 753, 1, 1, '1', 'pza'),
(746, 754, 1, 1, '2', 'servicio'),
(747, 755, 1, 1, '1', 'servicio'),
(748, 756, 1, 1, '1', 'servicio'),
(749, 757, 1, 1, '1', 'servicio'),
(750, 758, 1, 1, '1', 'servicio'),
(751, 759, 1, 1, '6', 'pza'),
(752, 760, 1, 1, '1', 'servicio'),
(753, 761, 1, 1, '30000', 'pza'),
(754, 762, 1, 1, '40', 'pza'),
(755, 763, 1, 1, '1', 'pza'),
(756, 764, 1, 1, '1', 'pza'),
(757, 765, 1, 1, '1', 'pza'),
(758, 766, 1, 1, '1', 'pza'),
(759, 767, 1, 1, '1', 'pza'),
(760, 768, 1, 1, '400', 'lt'),
(761, 769, 1, 1, '1', 'pza'),
(762, 770, 1, 1, '1', 'pza'),
(763, 771, 1, 1, '1', 'pza'),
(764, 772, 1, 1, '1', 'pza'),
(765, 773, 1, 1, '1', 'pza'),
(766, 774, 1, 1, '1', 'pza'),
(767, 775, 1, 1, '1', 'servicio'),
(768, 776, 1, 1, '1', 'servicio'),
(769, 777, 1, 1, '1', 'servicio'),
(770, 778, 1, 1, '5', 'servicio'),
(771, 779, 1, 1, '1', 'servicio'),
(772, 780, 1, 1, '3', 'pza'),
(773, 781, 1, 1, '1', 'servicio'),
(774, 782, 1, 1, '2', 'pza'),
(775, 783, 1, 1, '15', 'lt'),
(776, 784, 1, 1, '2', 'pza'),
(777, 785, 1, 1, '1', 'pza'),
(778, 786, 1, 1, '1', 'pza'),
(779, 787, 1, 1, '1', 'pza'),
(780, 788, 1, 1, '2', 'pza'),
(781, 789, 1, 1, '1', 'servicio'),
(782, 790, 1, 1, '1', 'servicio'),
(783, 791, 1, 1, '1', 'servicio'),
(784, 792, 1, 1, '2', 'pza'),
(785, 793, 1, 1, '1', 'pza'),
(786, 794, 1, 1, '18', 'pza'),
(787, 795, 1, 1, '1', 'servicio'),
(788, 796, 1, 1, '1', 'servicio'),
(789, 797, 1, 1, '1', 'servicio'),
(790, 798, 1, 1, '1', 'servicio'),
(791, 799, 1, 1, '1', 'servicio'),
(792, 800, 1, 1, '1', 'servicio'),
(793, 801, 1, 1, '1', 'servicio'),
(794, 802, 1, 1, '1', 'servicio'),
(795, 803, 1, 1, '1', 'servicio'),
(796, 804, 1, 1, '1', 'servicio'),
(797, 805, 1, 1, '1', 'servicio'),
(798, 806, 1, 1, '1', 'servicio'),
(799, 807, 1, 1, '40', 'kg'),
(800, 808, 1, 1, '5', 'pza'),
(801, 809, 1, 1, '1', 'pza'),
(802, 810, 1, 1, '1', 'pza'),
(803, 811, 1, 1, '25', 'pza'),
(804, 812, 1, 1, '1', 'pza'),
(805, 813, 1, 1, '1', 'pza'),
(806, 814, 1, 1, '40000', 'pza'),
(807, 815, 1, 1, '400', 'pza'),
(808, 816, 1, 1, '50', 'mt'),
(809, 817, 1, 1, '282', ''),
(810, 818, 1, 1, '1', 'pza'),
(811, 819, 1, 1, '1', 'pza'),
(812, 820, 1, 1, '2', 'pza'),
(813, 821, 1, 1, '1', 'pza'),
(814, 822, 1, 1, '1', 'pza'),
(815, 823, 1, 1, '1', 'pza'),
(816, 824, 1, 1, '120', 'pza'),
(817, 825, 1, 1, '1', 'pza'),
(818, 826, 1, 1, '1', 'pza'),
(819, 827, 1, 1, '1', 'pza'),
(820, 828, 1, 1, '1', 'pza'),
(821, 829, 1, 1, '1', 'pza'),
(822, 830, 1, 1, '1', 'pza'),
(823, 831, 1, 1, '4', 'pza'),
(824, 832, 1, 1, '12', 'pza'),
(825, 833, 1, 1, '3', 'pza'),
(826, 834, 1, 1, '12', 'lt'),
(827, 835, 1, 1, '10', 'pza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id` int(11) NOT NULL,
  `cv_documento` text NOT NULL,
  `constancia_documento` varchar(255) NOT NULL,
  `nss_documento` varchar(255) NOT NULL,
  `curp_documento` varchar(255) NOT NULL,
  `puesto_postula` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` enum('Masculino','Femenino','Otro') NOT NULL,
  `correo` varchar(255) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `colonia` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  `institucion_academica` varchar(255) NOT NULL,
  `grado_estudio` varchar(255) NOT NULL,
  `nombre_carrera` varchar(255) NOT NULL,
  `experiencia_laboral` text DEFAULT NULL,
  `exp_soli` text DEFAULT NULL,
  `tipo_licencia` varchar(255) DEFAULT NULL,
  `pariente` enum('Sí','No') NOT NULL,
  `nombre_pariente` varchar(255) DEFAULT NULL,
  `documentacion` text DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulaciones`
--

INSERT INTO `postulaciones` (`id`, `cv_documento`, `constancia_documento`, `nss_documento`, `curp_documento`, `puesto_postula`, `nombre`, `apellido`, `edad`, `sexo`, `correo`, `telefono`, `direccion`, `colonia`, `ciudad`, `estado`, `codigo_postal`, `institucion_academica`, `grado_estudio`, `nombre_carrera`, `experiencia_laboral`, `exp_soli`, `tipo_licencia`, `pariente`, `nombre_pariente`, `documentacion`, `fecha_registro`) VALUES
(18, '66b15ccda39d34.90516222.docx', 'Constancia de Situación Fiscal', 'Número de Seguridad Social', 'CURP', 'obrero', 'MARC', 'RUGERIO', 23, 'Masculino', 'marcalvarez392@gmail.com', '2218237538', '36 de Los Andes', 'Jardines de San jose', 'Puebla', 'Pue.', '72229', 'UTP', 'Técnico Superior Universitario', 'desarrollo de software multiplataforma', 'Sin experiencia', '1', 'No aplica', 'No', 'no', '66b15ccda39d34.90516222.docx', '2024-08-05 23:14:21'),
(19, '66b2895f985ab4.72088677.pdf', 'Constancia de Situación Fiscal', 'Número de Seguridad Social', 'CURP', 'obrero', 'Marc Anthony', 'Alvarez Rugerio', 23, 'Masculino', 'marcalvarez392@gmail.com', '2218237538', '36 de Los Andes', 'Jardines de San jose', 'Puebla', 'Pue.', '72229', 'UTP', 'Técnico Superior Universitario', 'Desarrollo de software multiplataforma', 'Sin experiencia', '3 meses', 'No aplica', 'No', '', '66b2895f985ab4.72088677.pdf', '2024-08-06 20:36:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `nombreEmpresa` varchar(255) DEFAULT NULL,
  `direccionProveedor` varchar(255) DEFAULT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `codigoPostal` varchar(20) DEFAULT NULL,
  `pais` varchar(100) DEFAULT NULL,
  `fechaRegistro` datetime DEFAULT NULL,
  `informacionProveedor` text DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `tipoProveedor` varchar(100) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fechaUltimaActividad` datetime DEFAULT NULL,
  `estadoProveedor` varchar(100) DEFAULT NULL,
  `sitioWeb` varchar(255) DEFAULT NULL,
  `rfc` varchar(50) DEFAULT NULL,
  `tipoBanco` varchar(100) DEFAULT NULL,
  `cuentaBancaria` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `nombreEmpresa`, `direccionProveedor`, `ciudad`, `estado`, `codigoPostal`, `pais`, `fechaRegistro`, `informacionProveedor`, `logo`, `tipoProveedor`, `notas`, `fechaUltimaActividad`, `estadoProveedor`, `sitioWeb`, `rfc`, `tipoBanco`, `cuentaBancaria`) VALUES
(1, 'Empresa A', 'Calle Principal 123', 'Ciudad A', 'Estado A', '12345', 'País A', '2023-01-15 08:00:00', 'Información detallada sobre la empresa A', 'logo_empresaA.png', 'Tipo A', 'Notas adicionales sobre la empresa A', '2024-05-20 10:30:00', 'Eliminado', 'http://www.sitioA.com', 'RFC12345', 'Banco A', '1234567890'),
(2, 'Empresa B', 'Avenida Secundaria 456', 'Ciudad B', 'Estado B', '54321', 'País B', '2023-02-20 09:30:00', 'Descripción de la empresa B', 'logo_empresaB.png', 'Tipo B', 'Detalles adicionales sobre la empresa B', '2024-06-01 14:00:00', 'Activo', 'http://www.sitioB.com', 'RFC54321', 'Banco B', '0987654321'),
(3, 'Empresa C', 'Av. Importante 789', 'Ciudad C', 'Estado C', '67890', 'País C', '2023-03-25 10:00:00', 'Información detallada sobre la empresa C', 'logo_empresaC.png', 'Tipo C', 'Notas adicionales sobre la empresa C', '2024-07-05 11:30:00', 'Activo', 'http://www.sitioC.com', 'RFC67890', 'Banco C', '1357924680'),
(4, 'Empresa D', 'Plaza Principal 246', 'Ciudad D', 'Estado D', '98765', 'País D', '2023-04-30 11:30:00', 'Descripción de la empresa D', 'logo_empresaD.png', 'Tipo D', 'Detalles adicionales sobre la empresa D', '2024-08-10 15:00:00', 'Activo', 'http://www.sitioD.com', 'RFC98765', 'Banco D', '2468013579'),
(5, 'Empresa E', 'Ruta Secundaria 753', 'Ciudad E', 'Estado E', '13579', 'País E', '2023-05-15 12:00:00', 'Información detallada sobre la empresa E', 'logo_empresaE.png', 'Tipo E', 'Notas adicionales sobre la empresa E', '2024-09-20 16:30:00', 'Activo', 'http://www.sitioE.com', 'RFC13579', 'Banco E', '3692581470');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reinci`
--

CREATE TABLE `reinci` (
  `id` int(11) NOT NULL,
  `noEmpleado` varchar(50) DEFAULT NULL,
  `idDepartamento` int(11) NOT NULL,
  `nombreEmpleado` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `emailEmpleado` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `folio` int(50) DEFAULT NULL,
  `fecha_reporte` datetime DEFAULT NULL,
  `tipo_inc` varchar(100) DEFAULT NULL,
  `dep_rep` varchar(100) DEFAULT NULL,
  `descrip_inc` text DEFAULT NULL,
  `evidencia` text DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL,
  `firma_de_conformidad` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reinci`
--

INSERT INTO `reinci` (`id`, `noEmpleado`, `idDepartamento`, `nombreEmpleado`, `apellidoPaterno`, `apellidoMaterno`, `emailEmpleado`, `telefono`, `folio`, `fecha_reporte`, `tipo_inc`, `dep_rep`, `descrip_inc`, `evidencia`, `fecha_atencion`, `firma_de_conformidad`) VALUES
(87, 'EM003', 3, 'Pedro', 'Sánchez', 'García', 'marcalvarez900@gmail.com', '555-9876', 12121213, '2024-08-04 19:07:28', 'Hardware (pantalla, impresora, disco duro ...)', '121212', '12121212', 'image.png', '2024-08-05', ''),
(99, '11', 1, 'MARC', 'Alvarez', 'RUGERIO', 'marcalvarez392@gmail.com', '2218237538', 12121214, '2024-08-06 14:28:15', 'Hardware (pantalla, impresora, disco duro ...)', 'Gestion', 'no funciona la base de datos', '66b28782c46fe3.04386013.png', '2024-08-07', ''),
(100, '11', 1, 'MARC', 'Alvarez', 'RUGERIO', 'marcalvarez392@gmail.com', '2218237538', 12121215, '2024-08-08 13:34:56', 'Hardware', 'Gestion', 'Prueba', '66b52371a7b236.94823056.png,66b52371a7dea9.60367795.png,66b52371a7fe36.77802653.jpg', '2024-08-09', 'Si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombre`) VALUES
(1, 'administrador'),
(2, 'moderador'),
(3, 'colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solimercaservi`
--

CREATE TABLE `solimercaservi` (
  `id` int(11) NOT NULL,
  `noEmpleado` varchar(50) DEFAULT NULL,
  `idDepartamento` varchar(100) DEFAULT NULL,
  `nombreEmpleado` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `emailEmpleado` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `folio` int(50) DEFAULT NULL,
  `Prioridad` varchar(50) DEFAULT NULL,
  `gestiona` varchar(100) DEFAULT NULL,
  `fecha_pedido` datetime DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `fines_utilizacion` text DEFAULT NULL,
  `nombre_solicitud` varchar(100) DEFAULT NULL,
  `firma_solicitud` varchar(100) DEFAULT NULL,
  `nombre_jefe` varchar(100) DEFAULT NULL,
  `correo_jefe` varchar(100) DEFAULT NULL,
  `nombre_recibe` varchar(100) DEFAULT NULL,
  `firma_recibe` varchar(100) DEFAULT NULL,
  `firma_jefe_recibe` varchar(255) DEFAULT NULL,
  `solicitando` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `solimercaservi`
--

INSERT INTO `solimercaservi` (`id`, `noEmpleado`, `idDepartamento`, `nombreEmpleado`, `apellidoPaterno`, `apellidoMaterno`, `emailEmpleado`, `telefono`, `folio`, `Prioridad`, `gestiona`, `fecha_pedido`, `fecha_entrega`, `fines_utilizacion`, `nombre_solicitud`, `firma_solicitud`, `nombre_jefe`, `correo_jefe`, `nombre_recibe`, `firma_recibe`, `firma_jefe_recibe`, `solicitando`) VALUES
(657, '447', 'Administración', 'Cesar Rodrigo ', 'Ortiz ', 'Cantoral', 'gestoria.chosa@hotmail.com', NULL, 322, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-12 09:13:00', '1970-01-01', 'PAGO DE FACTURA LINEAS TELCEL MES DE AGOSTO', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(658, '447', 'Administración', 'Cesar Rodrigo', 'Ortiz ', 'Cantoral', 'gestoria.chosa@hotmail.com', NULL, 285, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-12 08:12:00', '1970-01-01', 'PAGO DE 2DA FACTURA DECENAL VIAPASS BC 147373 DEL 01 AL 10 DE AGOSTO', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(659, '55', 'Administración', 'Oscar ', 'Jiménez ', 'Romero', 'gestoria@horiente.mx', NULL, 285, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-09 09:00:00', '1970-01-01', 'RENOVACION TELCEL Y CONTRATO DE LINEAS NUEVAS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(660, '213', 'Administración', 'Berenice Sarahí ', 'Herrera ', 'Luna', 'recursoshumanos@horiente.mx', NULL, 285, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-08-09 09:16:00', '2024-07-31', 'Revisiones medicas a personal de Harinera de Oriente y examen medico  a posibles  candidatos a contratación. ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Lic. Elizabeth Hernadez Laureano', NULL, NULL, 'Servicio'),
(661, '355', 'Administración', 'Elizabeth ', 'Herrera', 'Luna', 'facturacion@horiente.mx', NULL, 285, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-08-09 08:04:00', '1970-01-01', 'VENTA DE AGENTE 1, ELIZABETH HERRERA (2 CAJAS) Y AGENTE 19, URIEL GARCIA  (1 CAJA).', 'Elizabeth Herrera Luna', NULL, 'CP. ALEJANDRA GARCIA LOPEZ ', 'contaharinera@horiente.mx', 'ING. SERGIO ALCANTARA ', NULL, NULL, 'Material'),
(662, '50', 'Mantenimiento Industrial', 'Oscar Sánchez Méndez', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 285, 'Urgente', 'Compras (Departamento de compras)', '2024-08-08 10:43:00', NULL, 'Cargador de repuesto de la báscula de 10 kg. Nave 2', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(663, '50', 'Mantenimiento Industrial', 'Oscar Sánchez Méndez', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 310, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-08 08:18:00', NULL, 'Cambio de tapas para bancos de molienda del molino 1.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(664, '50', 'Mantenimiento Industrial', 'Oscar Sánchez Méndez', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 309, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-08 08:08:00', NULL, 'Las tapas actuales no cumplen con los requisitos del sistema de gestión de inocuidad.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara ', NULL, NULL, 'Material'),
(665, '50', 'Mantenimiento Industrial', 'Oscar Sánchez Méndez', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 308, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-08 08:04:00', NULL, 'La ventana se encuentra en malas condiciones y se requiere cambio de soportes de aluminio para garantizar una buena apertura.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Servicio'),
(666, '50', 'Mantenimiento Industrial', 'Oscar Sánchez Méndez', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 285, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-08 07:57:00', NULL, 'El cambio de ventanas convencional por corredizas con mosquitero es para evitar accidentes por desprendimiento de ventanas y evitar que entren plagas al área de producción.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Servicio'),
(667, '433', 'Administración', 'Stephanie ', 'Duarte ', 'Gómez', 'fani.duarteg@gmail.com', NULL, 285, 'Programado', 'Compras (Departamento de compras)', '2024-08-07 14:23:00', NULL, 'COMPUTADORA DE ESCRITORIO NUEVA PARA CONTABILIDAD Dell ', 'Stephanie Duarte Gómez', NULL, 'ADRIANA GARCIA RIVERA', 'chosa-estacion@gmail.com', 'ADRIANA GARCIA RIVERA', NULL, NULL, 'Material'),
(668, '209', 'Vigilancia', 'Manuel ', 'López ', 'Pacheco', 'lopezmanuel2671@gmail.com', NULL, 285, 'Programado', 'Compras (Departamento de compras)', '2024-08-07 13:18:00', NULL, 'ALIMENTO PARA K9 (PERROS) DE VIGILANCIA ', 'Manuel López Pacheco', NULL, 'J. GUADALUPE GONZALEZ REYES ', 'gerenteadministrativo@horiente.mx', 'MARIO SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(669, '344', 'Seguridad Industrial', 'Alejandra', 'Juárez', 'Tecayéhuatl', 'seguridadindustrial@horiente.mx', NULL, 285, 'Programado', 'Compras (Departamento de compras)', '2024-08-07 09:02:00', NULL, 'CAMBIO DE SILLA PARA VICENTE TORRES MUÑOZ', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(670, '431', 'Mantenimiento Industrial', 'Nallely', 'Tlatelpa', 'Tieco', 'abraham7nik@gmail.com', NULL, 297, 'Programado', 'Compras (Departamento de compras)', '2024-08-06 10:56:00', NULL, 'Para tomas de lecturas de temperatura con exactitud para tableros y maquinaria BUHLER.', 'José Abraham Ramos Sosa', NULL, 'Oscar Sanchez Mendez ', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(671, '308', 'Laboratorio', 'Oscar', 'Jiménez', 'Romero', 'laboratorio1@horiente.mx', NULL, 290, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-08-05 12:30:00', '1970-01-01', 'CUMPLIMIENTO NORMATIVO ', 'Ana Lilia Fernández Tecuapacho', NULL, 'Ing. Juan Carlos Monroy ', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(672, '308', 'Laboratorio', 'Luciano Martín', 'Trinidad', 'Reyes', 'laboratorio1@horiente.mx', NULL, 285, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-08-05 12:22:00', '1970-01-01', 'Cumplimiento normativo ', 'Ana Lilia Fernández Tecuapacho', NULL, 'Ing. Juan Carlos Monroy ', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(673, '344', 'Seguridad Industrial', 'José Mauricio', 'Álvarez', 'González', 'seguridadindustrial@horiente.mx', NULL, 285, 'Programado', 'Compras (Departamento de compras)', '2024-08-05 11:59:00', NULL, 'PAPELERÍA DEL MES DE AGOSTO DE PARA SEGURIDAD INDUSTRIAL Y MEDIO AMBIENTE PARA LA ELABORACIÓN DE CREDENCIALES INSTITUCIONALES', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(674, '50', 'Mantenimiento Industrial', 'Erica', 'Tlatelpa', 'Tieco', 'mantenimientoindustrial@horiente.mx', NULL, 287, 'Urgente', 'Compras (Departamento de compras)', '2024-08-05 12:02:00', NULL, 'Limpieza general del taller de mantenimiento industrial.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(675, '50', 'Mantenimiento Industrial', 'Andrés Elías', 'Jerónimo', 'Santiago', 'mantenimientoindustrial@horiente.mx', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-02 10:00:00', NULL, 'Mantenimiento a motor del reidler de descarga de maiz.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(676, '344', 'Seguridad Industrial', 'Alberto', 'Robles', 'Pineda', 'seguridadindustrial@horiente.mx', NULL, 277, 'Programado', 'Compras (Departamento de compras)', '2024-08-01 10:22:00', '1970-01-01', 'Materiales para área de producción', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(677, '50', 'Mantenimiento Industrial', 'Román ', 'Francisco', 'Martín', 'mantenimientoindustrial@horiente.mx', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-01 09:46:00', NULL, 'Moto vibradores para equipo separador de trigo del área de limpia y acondicionamiento.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(678, '447', 'Administración', 'Ana Karen', 'Sosa', 'Carvajal', 'gestoria.chosa@hotmail.com', NULL, 266, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-01 08:27:00', '1970-01-01', 'FACTURA DE SERVICIO DE GPS AT&T AB 240723-00576988820', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(679, '447', 'Administración', 'Alejandra', 'Juárez', 'Tecayéhuatl', 'gestoria.chosa@hotmail.com', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-08-01 08:25:00', '1970-01-01', 'SERVICIO DE TAG VIAPASS FACTURA DECENAL BC 146521 DEL 01-08-2024 ', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(680, '55', 'Administración', 'Marco Iván', 'Hernández', 'Pérez', 'gestoria@horiente.mx', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-31 09:59:00', '2024-07-31', 'RECARGA VIAPASS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(681, '55', 'Administración', 'Oscar', 'Sánchez', 'Méndez', 'gestoria@horiente.mx', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-30 09:57:00', '2024-07-30', 'MANTENIMIENTO PREVENTIVO ECO 10 100 MIL KM', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(682, '11', 'Administración', 'Berenice Sarahí', 'Herrera', 'Luna', 'gestoria@horiente.mx', NULL, 256, 'Programado', 'Compras (Departamento de compras)', '2024-07-30 08:27:00', NULL, 'Para economico 15', 'Luciano Martín Trinidad Reyes', NULL, 'Ing Juan Carlos Monrroy', 'DIRECCION@HORIENTE.MX', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(683, '50', 'Mantenimiento Industrial', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'mantenimientoindustrial@horiente.mx', NULL, 259, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-29 09:10:00', NULL, 'Fabricación y montaje de dos bandas retractiles para embarque de harina de las líneas buhler e imeco de la nave 2.', 'Oscar Sánchez Méndez', NULL, 'Ing. Juan Carlos Monroy Martinez ', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Servicio'),
(684, '50', 'Mantenimiento Industrial', 'Manuel', 'López', 'Pacheco', 'mantenimientoindustrial@horiente.mx', NULL, 258, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-29 08:50:00', NULL, 'Usó general del personal de producción área bancos de molienda.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(685, '447', 'Administración', 'Mariel', 'Álvarez', 'González', 'gestoria.chosa@hotmail.com', NULL, 256, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-27 12:14:00', '2024-07-29', 'Pago de Prima Total Poliza 4898872 ECO D-5 Mercedes Benz Lic. Jose Barquin Sabate', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(686, '415', 'Administración', 'Cirilo', 'Pérez', 'Sánchez', 'compras@horiente.mx', NULL, 255, 'Urgente', 'Compras (Departamento de compras)', '2024-07-25 16:04:00', NULL, 'HOJAS PARA IMPRESIONES DE OFICINA.', 'Erica Tlatelpa Tieco', NULL, 'Sergio Alcantara Monterrosas ', 'compras@horiente.mx', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(687, '276', 'Mantenimiento Industrial', 'José Mauricio', 'Álvarez', 'González', 'marco.perez.0997@gmail.com', NULL, 251, 'Programado', 'Compras (Departamento de compras)', '2024-07-25 10:54:00', NULL, 'Para conexión del motor reductor del transportador helicoidal que alimentará la tolva del carrusel Imeco ', 'Marco Iván Hernández Pérez', NULL, 'Ing. Oscar Sánchez Méndez ', 'mantenimientoindustrial@horiente.mx', 'Ing. Sergio Alcántara Monterrosas  ', NULL, NULL, 'Material'),
(688, '55', 'Administración', 'Mateo', 'García', 'Vicente', 'gestoria@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-25 08:43:00', '2024-07-29', 'COMPRA DE LICENCIAS MICROSOFT PARA EQUIPOS DE COMPUTO', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(689, '50', 'Mantenimiento Industrial', 'Andrés Elías', 'Jerónimo', 'Santiago', 'mantenimientoindustrial@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-25 08:14:00', NULL, 'Cambio de motoreductor del micro colector de polvos del área de limpia parte de la esclusa y para rosca helicoidal de impurezas de entrada al molino de martillos.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(690, '50', 'Mantenimiento Industrial', 'Miguel Uriel', 'García', 'Ortega', 'mantenimientoindustrial@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-25 07:51:00', NULL, 'Mantenimiento a acometida principal de suministro eléctrico a los transformadores de nave 1 y nave 2.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(691, '13', 'Administración', 'José David', 'Muñoz', 'Ramírez', 'direccion@horiente.mx', NULL, 227, 'Programado', 'Compras (Departamento de compras)', '2024-07-24 14:26:00', NULL, 'AGUJAS CODIGO 9848GF200/100 PARA MAQUINA COSEDORA DE SACOS DEL CARRUSEL BUHLER NUEVA AREA DE ENVASADO DE HARINA NAVE 2.', 'Juan Carlos Monroy Martínez', NULL, 'Juan Carlos Monroy Martínez', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(692, '334', 'Laboratorio', 'Ángel Fernando', 'Sánchez', 'Vera', 'controldecalidad@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-24 13:47:00', '2024-07-23', 'Descarga de tolvas de ferrocarril en Compañía Harinera de Oriente.', 'Mateo García Vicente', NULL, 'ING. ANA LILIA FERNÁNDEZ TECUAPACHO', 'laboratorio1@horiente.mx', 'Ing. Mario Sergio Alcántara Monterosas', NULL, NULL, 'Servicio'),
(693, '209', 'Vigilancia', 'Alberto', 'Robles', 'Pineda', 'lopezmanuel2671@gmail.com', NULL, 240, 'Programado', 'Compras (Departamento de compras)', '2024-07-24 13:11:00', NULL, 'MATERIAL PARA TOMAR MEDIDAS DE LOS SILOS, INTERSILOS, TOLVAS DE MAIZ Y TOLVAS DE HARINA', 'Manuel López Pacheco', NULL, 'J. GUADALUPE GONZALEZ REYES ', 'gerenteadministrativo@horiente.mx', 'MARIO SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(694, '344', 'Seguridad Industrial', 'Alejandra', 'García', 'López', 'seguridadindustrial@horiente.mx', NULL, 227, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-24 11:49:00', '2024-07-23', 'DICTAMEN ELÉCTRICO POR RESPONSABLE DE INSTALACIONES ELÉCTRICAS. ', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(695, '50', 'Mantenimiento Industrial', 'Karla', 'Meza', 'Palomino', 'mantenimientoindustrial@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-24 11:46:00', NULL, 'Para realizar mantenimiento correctivo a equipo combinador del área de limpia.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Servicio'),
(696, '238', 'Administración', 'Stephanie', 'Duarte', 'Gómez', 'esme281114@gmail.com', NULL, 237, 'Programado', 'Compras (Departamento de compras)', '2024-07-24 11:25:00', '2024-07-24', 'Vales de combustible para el uso de las unidades de ho.', 'Andrés Elías Jerónimo Santiago ', NULL, 'Juan Carlos Monroy Martinez ', 'direccion@horiente.mx', 'Mario Sergio Alcantara Monte Rosas ', NULL, NULL, 'Material'),
(697, '209', 'Vigilancia', 'Oscar', 'Sánchez', 'Méndez', 'lopezmanuel2671@gmail.com', NULL, 227, 'Programado', 'Compras (Departamento de compras)', '2024-07-23 08:56:00', '2024-07-25', 'ALIMENTO  PARA  K9  (PERROS ) DE VIGILANCIA ', 'Manuel López Pacheco', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'MARIO SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(698, '447', 'Administración', 'José Guadalupe', 'González', 'Reyes', 'gestoria.chosa@hotmail.com', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-22 11:18:00', '2024-07-22', 'CARGA DE SALDO DE SERVICIO TAG VIAPASS DECENAL', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(699, '55', 'Administración', 'Ana Karen', 'Sosa', 'Carvajal', 'gestoria@horiente.mx', NULL, 229, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-19 13:19:00', '2024-07-24', 'FINIQUITO DE REPARACION ECO 71 POR SINIESTRO', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(700, '55', 'Administración', 'Alejandra', 'Juárez', 'Tecayéhuatl', 'gestoria@horiente.mx', NULL, 227, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-19 13:18:00', '2024-07-19', 'REPARACION DE HOLATERIA Y PINTURA ECO 202', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(701, '344', 'Seguridad Industrial', 'Marco Iván', 'Hernández', 'Pérez', 'seguridadindustrial@horiente.mx', NULL, 227, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-19 12:39:00', '2024-07-31', 'Cumplimiento a las condicionantes marcadas en la licencia de funcionamiento de operación de fuentes fijas de emisiones a la atmósfera ante la Secretaria de Medio Ambiente, Desarrollo Sustentable y Ordenamiento Territorial, se solicita una compensación ambiental para el estado de Puebla.', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Donativo'),
(702, '447', 'Administración', 'Oscar', 'Sánchez', 'Méndez', 'gestoria.chosa@hotmail.com', NULL, 224, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-18 16:09:00', '2024-07-19', 'VERIFICACIÓN DE BAJOS CONTAMINANTES DE UNIDADES 48,40,38,37,35,27,60,47,41,33,49,36,28,44,42,23,59', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(703, '55', 'Administración', 'José Abraham', 'Ramos', 'Sosa', 'gestoria@horiente.mx', NULL, 224, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-18 12:32:00', '2024-07-18', 'INCREMENTO DE DEPÓSITO EN GARANTÍA PARA TARJETAS DE PEAJE VIAPASS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(704, '50', 'Mantenimiento Industrial', 'Nallely', 'Tlatelpa', 'Tieco', 'mantenimientoindustrial@horiente.mx', NULL, 223, 'Programado', 'Compras (Departamento de compras)', '2024-07-18 10:07:00', NULL, 'Máquina de repuesto para el almacén de producto terminado ', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(705, '447', 'Administración', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'gestoria.chosa@hotmail.com', NULL, 222, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-18 09:01:00', '2024-07-18', 'RECARGA DE SALDO DE VIAPASS', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'OSCAR JIMENEZ ROMERO', 'GESTORIA@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(706, '55', 'Administración', 'Manuel', 'López', 'Pacheco', 'gestoria@horiente.mx', NULL, 212, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-18 08:55:00', '2024-07-18', 'RECARGA VIAPASS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(707, '344', 'Seguridad Industrial', 'Guadalupe', 'DeGaona', 'Santiago', 'seguridadindustrial@horiente.mx', NULL, 212, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-17 13:23:00', '1970-01-01', 'CUMPLIMIENTO A LOS REQUERIMIENTOS DE CAPACITACIÓN QUE SOLICITA LA NOM-036-STPS-2018', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(708, '55', 'Administración', 'Mariel', 'Álvarez', 'González', 'gestoria@horiente.mx', NULL, 212, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-17 12:29:00', '2024-07-19', 'GASTOS MEDICOS MAYORES LIC JOSE BARQUIN SABATE', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(709, '308', 'Laboratorio', 'Cirilo', 'Pérez', 'Sánchez', 'laboratorio1@horiente.mx', NULL, 212, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-17 12:22:00', NULL, 'ANALISIS EN HARINA DE TRIGO PARA LA MISION ', 'Ana Lilia Fernández Tecuapacho', NULL, 'Ing. Juan Carlos Monroy ', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(710, '55', 'Administración', 'Cesar Rodrigo', 'Ortiz', 'Cantoral', 'gestoria@horiente.mx', NULL, 212, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-16 12:43:00', '2024-07-16', 'VERIFICACIONES FISICO-MECÁNICAS ECO 23-47-35-38-41-27-37-60', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(711, '34', 'Mantenimiento Industrial', 'Luciano Martín', 'Trinidad', 'Reyes', 'gestoria@horiente.mx', NULL, 212, 'Programado', 'Compras (Departamento de compras)', '2024-07-15 11:49:00', NULL, 'Para limpieza y lavado de piezas mecánicas de bancos de molienda.', 'Román Francisco Martín', NULL, 'Oscar Sanchez Mendez ', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(712, '334', 'Laboratorio', 'Erica', 'Tlatelpa', 'Tieco', 'controldecalidad@horiente.mx', NULL, 212, 'Programado', 'Compras (Departamento de compras)', '2024-07-13 12:46:00', NULL, 'FINIQUITO DE FACTURA 4-2065', 'Mateo García Vicente', NULL, 'ANA LILIA FERNANDEZ T ', 'laboratorio1@horiente.mx', 'Sergio Alcántara', NULL, NULL, 'Servicio'),
(713, '308', 'Laboratorio', 'Andrés Elías', 'Jerónimo', 'Santiago', 'laboratorio1@horiente.mx', NULL, 209, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-10 13:57:00', NULL, 'CUMPLIMIENTO NORMATIVO\n', 'Ana Lilia Fernández Tecuapacho', NULL, 'Juan Carlos Monroy ', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(714, '308', 'Laboratorio', 'Miguel Uriel', 'García', 'Ortega', 'laboratorio1@horiente.mx', NULL, 193, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-10 13:56:00', NULL, 'CUMPLIMIENTO NORMATIVO', 'Ana Lilia Fernández Tecuapacho', NULL, 'Juan Carlos Monroy ', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(715, '382', 'Administración', 'Jorge', 'Reyes', 'Potrero', 'comunicacionadd@horiente.mx', NULL, 193, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-10 11:08:00', NULL, 'VIDEO DE INDUCCIÓN', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Servicio'),
(716, '55', 'Administración', 'José David', 'Muñoz', 'Ramírez', 'gestoria@horiente.mx', NULL, 193, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-09 14:49:00', '2024-06-15', 'Baño operadores', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(717, '334', 'Laboratorio', 'Ángel Fernando', 'Sánchez', 'Vera', 'controldecalidad@horiente.mx', NULL, 206, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-09 12:16:00', '2024-07-01', 'Mantenimiento a equipo de laboratorio.', 'Mateo García Vicente', NULL, 'ING. ANA LILIA FERNÁNDEZ TECUAPACHO', 'laboratorio1@horiente.mx', 'Ing. Mario Sergio Alcántara Monterosas', NULL, NULL, 'Servicio'),
(718, '50', 'Mantenimiento Industrial', 'Elizabeth', 'Herrera', 'Laureno', 'mantenimientoindustrial@horiente.mx', NULL, 193, 'Urgente', 'Compras (Departamento de compras)', '2024-07-09 09:33:00', NULL, 'Accesorio de repuesto de equipo de oxicorte del taller de mantenimiento industrial.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(719, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 193, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-09 09:22:00', NULL, 'SERVICIO PARA EL ALFA ROMERO QUE SOLICITO EL LIC JOSE JAVIER', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'José G Gonzáles Reyes', NULL, NULL, 'Servicio'),
(720, '213', 'Administración', 'Karla', 'Meza', 'Palomino', 'recursoshumanos@horiente.mx', NULL, 193, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-09 08:40:00', '2024-06-28', 'ESTUDIO ECONÓMICO A POSIBLES CANDIDATOS ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(721, '382', 'Administración', 'Román', ' Francisco', 'Martín', 'comunicacionadd@horiente.mx', NULL, 193, 'Programado', 'Compras (Departamento de compras)', '2024-07-08 13:55:00', NULL, 'TICKET DE TOLVA PARA LA BASCULA FERROCARRILERA ', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Material'),
(722, '50', 'Mantenimiento Industrial', 'Jorge', 'Reyes', 'Potrero', 'mantenimientoindustrial@horiente.mx', NULL, 193, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-08 09:59:00', NULL, 'Mantenimiento a bancos de molienda T-1,  T-3, C-1 y C-9.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(723, '334', 'Laboratorio', 'José Guadalupe', 'González', 'Reyes', 'controldecalidad@horiente.mx', NULL, 193, 'Urgente', 'Compras (Departamento de compras)', '2024-07-08 09:21:00', NULL, 'PARA CLORAR AGUA QUE VA A PRODUCCIÓN ', 'Mateo García Vicente', NULL, 'ANA LILIA FERNANDEZ T ', 'laboratorio1@horiente.mx', 'Sergio Alcántara', NULL, NULL, 'Material'),
(724, '50', 'Mantenimiento Industrial', 'Ana Karen', 'Sosa', 'Carvajal', 'mantenimientoindustrial@horiente.mx', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-08 08:59:00', NULL, 'Roscas para alimentación al carrusel buhler e imeco de las tolvas a,b,c y d.', 'Oscar Sánchez Méndez', NULL, 'José Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(725, '50', 'Mantenimiento Industrial', 'Alejandra', 'Juárez', 'Tecayéhuatl', 'mantenimientoindustrial@horiente.mx', NULL, 151, 'Urgente', 'Compras (Departamento de compras)', '2024-07-08 08:54:00', NULL, 'Mantenimiento preventivo a dosificador mecánico de trigo.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(726, '213', 'Administración', 'Marco Iván', 'Hernández', 'Pérez', 'recursoshumanos@horiente.mx', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-08 08:53:00', '2024-07-17', 'Curso venta en redes sociales para Karla Meza Palomino ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(727, '209', 'Vigilancia', 'Oscar', 'Sánchez', 'Méndez', 'lopezmanuel2671@gmail.com', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-08 08:21:00', NULL, 'ALIMENTO PARA K9 (PERROS) DE EL AREA DE VIGILANCIA ', 'Manuel López Pacheco', NULL, 'J. GUADALUPE GONZALEZ REYES ', 'gerenteadministrativo@horiente.mx', 'MARIO SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(728, '382', 'Administración', 'José Abraham', 'Ramos', 'Sosa', 'comunicacionadd@horiente.mx', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-05 14:37:00', NULL, 'MANTENIMIENTO WEB JUNIO', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Servicio'),
(729, '74', 'Laboratorio', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'produccion@horiente.mx', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-05 11:23:00', '2024-07-08', 'Escalera doble para trabajos en el molino ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Ing Sergio Alcántara ', NULL, NULL, 'Material'),
(730, '55', 'Administración', 'Manuel', 'López', 'Pacheco', 'gestoria@horiente.mx', NULL, 151, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-05 11:14:00', NULL, 'AFILIACIÓN CANACINTRA 2024', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(731, '275', 'Administración', 'Guadalupe', 'DeGaona', 'Santiago', 'urielortega010@gmail.com', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-05 10:52:00', '2024-07-05', 'Producto bajo pedido para su venta', 'Miguel Uriel García Ortega', NULL, 'Juan Carlos Monroy Martínez', 'direccion@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Material'),
(732, '256', '', 'Mariel', 'Álvarez', 'González', 'pcirilo954@gmail.com', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-05 09:58:00', NULL, 'Para comedor del área de maíz.', 'Cirilo Pérez Sánchez', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(733, '26', 'Mantenimiento Industrial', 'Cirilo', 'Pérez', 'Sánchez', 'jorgechosa85@gmail.com', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-05 09:23:00', NULL, 'Para uso del taller de Mantenimiento Industrial ', 'Jorge Reyes Potrero', NULL, 'Oscar Sanchez Mendez ', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(734, '275', 'Administración', 'Cesar Rodrigo', 'Ortiz', 'Cantoral', 'urielortega010@gmail.com', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-04 14:08:00', '2024-07-05', 'Producto bajo pedido para su venta', 'Miguel Uriel García Ortega', NULL, 'Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(735, '209', 'Vigilancia', 'Luciano Martín', 'Trinidad', 'Reyes', 'lopezmanuel2671@gmail.com', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-03 15:34:00', NULL, 'BOLSAS PARA GUARDAR DOCUMEMTOS DEL DEPARTAMENTO DE VIGILANCIA ', 'Manuel López Pacheco', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'MARIO SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(736, '322', '', 'Mateo', 'García', 'Vicente', 'mantenimientoautomotriz@horiente.mx', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-03 14:06:00', NULL, 'PARA RELLENO DE NIVELES DE TINTA', 'José David Muñoz Ramírez', NULL, 'JOSE GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MXTE', 'SERGIO ALCANTARA MONTERROSAS', NULL, NULL, 'Material'),
(737, '50', 'Mantenimiento Industrial', 'Ángel Fernando', 'Sánchez', 'Vera', 'mantenimientoindustrial@horiente.mx', NULL, 151, 'Urgente', 'Compras (Departamento de compras)', '2024-07-02 09:17:00', NULL, 'mantenimiento a puerta principal de oficinas administrativas ', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara ', NULL, NULL, 'Material'),
(738, '238', 'Administración', 'Andrea Eliza', 'Tuxpan', 'Sánchez', 'esme281114@gmail.com', NULL, 151, 'Programado', 'Compras (Departamento de compras)', '2024-07-02 08:51:00', NULL, 'PARA CAPACITACION DE CURSO DE CONTABILIDAD AREA ALSUR.', 'Andrés Elías Jerónimo Santiago ', NULL, 'J. Guadalupe Gonzáles Reyes ', 'gerenteadministrativo@horiente.mx', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(739, '213', 'Administración', 'Elizabeth', 'Herrera', 'Laureno', 'recursoshumanos@horiente.mx', NULL, 151, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-07-01 13:09:00', '2024-07-13', 'CURSO DE CAPACITACIÓN NOM 035-STPS 2018. FACTORES DE RIESGO PSICOSOCIAL EN EL TRABAJO. PARA GERENTES Y JEFES DE ÁREA ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(740, '448', 'Seguridad Industrial', 'Stephanie', 'Duarte', 'Gómez', 'seguridad.chosa@gmail.com', NULL, 162, 'Programado', 'Compras (Departamento de compras)', '2024-07-01 08:56:00', '2024-07-08', 'limpieza de oficinas de nave 2 y sanitarios del personal sindicalizado ', 'ANDREA ELIZA TUXPAN SÁNCHEZ', NULL, 'Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Material'),
(741, '447', 'Administración', 'Marco Iván', 'Hernández', 'Pérez', 'gestoria.chosa@hotmail.com', NULL, 151, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-07-01 08:06:00', '2024-07-01', 'Servicio de GPS correspondiente al mes de Julio 2024 de AT&T Comercializacion movil', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(742, '55', 'Administración', 'Berenice Sarahí', 'Herrera', 'Luna', 'gestoria@horiente.mx', NULL, 151, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-28 12:00:00', NULL, 'PIPAS DE AGUA MES DE JUNIO', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(743, '50', 'Mantenimiento Industrial', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'mantenimientoindustrial@horiente.mx', NULL, 143, 'Urgente', 'Compras (Departamento de compras)', '2024-06-28 07:36:00', NULL, 'Mantenimiento a rosca de impurezas del molino de martillos.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(744, '50', 'Mantenimiento Industrial', 'Guadalupe', 'DeGaona', 'Santiago', 'mantenimientoindustrial@horiente.mx', NULL, 143, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-27 12:14:00', NULL, 'Repuesto de la línea de almacenamiento a tolvas de producto terminado del molino 2.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Sergio Alcántara Monterrosas ', NULL, NULL, 'Servicio'),
(745, '447', 'Administración', 'Mariel', 'Álvarez', 'González', 'gestoria.chosa@hotmail.com', NULL, 143, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-27 12:05:00', '2024-06-28', 'Seguro de auto para unidad eco 10', 'Cesar Rodrigo Ortiz Cantoral', NULL, 'Oscar Jimenez Romero', 'gestoria@horiente.mx', 'Oscar Jimenez Romero', NULL, NULL, 'Servicio'),
(746, '334', 'Laboratorio', 'Cirilo', 'Pérez', 'Sánchez', 'controldecalidad@horiente.mx', NULL, 143, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-26 11:42:00', '2024-07-01', 'Descarga de tolvas de ferrocarril en Compañía Harinera de Oriente.', 'Mateo García Vicente', NULL, 'ING. ANA LILIA FERNÁNDEZ TECUAPACHO', 'laboratorio1@horiente.mx', 'Ing. Mario Sergio Alcántara Monterosas', NULL, NULL, 'Servicio'),
(747, '44', 'Administración', 'Cesar Rodrigo', 'Ortiz', 'Cantoral', 'compras@horiente.mx', NULL, 143, 'Programado', 'Compras (Departamento de compras)', '2024-06-26 10:32:00', NULL, 'Hojas blancas para impresiones.', 'Mario Sergio Alcántara Monterrosas', NULL, 'Ing. Juan Carlos Monroy Martínez ', 'compras@horiente.mx', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Material'),
(748, '213', 'Administración', 'José Mauricio', 'Álvarez', 'González', 'recursoshumanos@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-26 08:33:00', '2024-06-11', 'Consultas y revisiones medicas a colaboradores de HO y nuevos ingresos ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(749, '74', 'Laboratorio', 'Erica', 'Tlatelpa', 'Tieco', 'produccion@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-25 15:44:00', '2024-06-25', 'Servicio de limpieza y desinfección de cisterna y ya que elevado ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martínez ', 'direccion@horiente.mx', 'Ing Sergio Alcantara', NULL, NULL, 'Servicio'),
(750, '71', 'Administración', 'Juan Carlos', 'Monroy', 'Martínez', 'contaharinera@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-25 14:29:00', '2024-06-22', 'PARA EL CRECE DE CASETAS PASE', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'José G Gonzáles Reyes', NULL, NULL, 'Material'),
(751, '327', 'Administración', 'Mateo', 'García', 'Vicente', 'contabilidad@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-25 11:00:00', '2024-06-25', 'RECARGA DE SODEXO PARA  TARJETAS OPERADORES', 'Juan Eduardo Pérez Ocotitla', NULL, 'CP. ADRIANA GARCIA RIVERA ', 'CHOSAESTACION@HORIENTE.MX', 'ADRIANA GARCIA RIVERA ', NULL, NULL, 'Servicio'),
(752, '55', 'Administración', 'Mario Sergio', 'Alcántara', 'Monterrosas', 'gestoria@horiente.mx', NULL, 129, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-25 09:12:00', '2024-06-25', 'PARA CRUCE DE CASETAS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(753, '74', 'Laboratorio', 'Andrés Elías', 'Jerónimo', 'Santiago', 'produccion@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-24 13:12:00', '2024-06-24', 'Tapa de bastidor para cernido ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martínez ', 'direccion@horiente.mx', 'Ing Sergio Alcantara', NULL, NULL, 'Material'),
(754, '197', 'Administración', 'Miguel Uriel', 'García', 'Ortega', 'sosak4095@gmail.com', NULL, 129, 'Urgente', 'Compras (Departamento de compras)', '2024-06-22 09:52:00', '2024-06-22', 'Control de salidas para personal de sindicalizado y total de bultos.', 'Ana Karen Sosa Carvajal', NULL, 'Candelario Garcia Rodriguez', 'hoalmacen@gmail.com', 'ING. MARIO SERGIO ALCANTARA', NULL, NULL, 'Material'),
(755, '55', 'Administración', 'Jorge', 'Reyes', 'Potrero', 'gestoria@horiente.mx', NULL, 133, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-20 15:52:00', NULL, 'RECARGA DE TARJETAS VIAPASS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(756, '55', 'Administración', 'José David', 'Muñoz', 'Ramírez', 'gestoria@horiente.mx', NULL, 129, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-20 15:34:00', NULL, 'RECARGA DE TARJETAS VIAPASS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'OSCAR JIMENEZ ROMERO', NULL, NULL, 'Servicio'),
(757, '71', 'Administración', 'Andrea Eliza', 'Tuxpan', 'Sánchez', 'contaharinera@horiente.mx', NULL, 130, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-20 14:37:00', '2024-06-20', 'SERVICIO DE LIMPIA RECOLECCION DE CONTENEDOR ', 'Alejandra García López', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'J. GUADALUPE GONZALEZ REYES', NULL, NULL, 'Servicio'),
(758, '71', 'Administración', 'Alberto', 'Robles', 'Pineda', 'contaharinera@horiente.mx', NULL, 129, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-20 14:35:00', '2024-06-20', 'ASESORIA PARA LA VENTA DE HARINA ', 'Alejandra García López', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'J. GUADALUPE GONZALEZ REYES', NULL, NULL, 'Servicio'),
(759, '74', 'Laboratorio', 'Karla', 'Meza', 'Palomino', 'produccion@horiente.mx', NULL, 123, 'Urgente', 'Compras (Departamento de compras)', '2024-06-20 11:21:00', '2024-06-24', 'Cosmético en aerosol para las bandas del molino ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Ing Sergio Alcantara', NULL, NULL, 'Material'),
(760, '238', 'Administración', 'Stephanie', 'Duarte', 'Gómez', 'esme281114@gmail.com', NULL, 126, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-19 12:13:00', NULL, 'Curso de contabilidad y finanzas ', 'Andrés Elías Jerónimo Santiago ', NULL, 'J. Guadalupe Gonzalez Reyes ', 'gerenteadministrativo@horiente.mx', 'Ing. M. Sergio Alcantara Monterrosas', NULL, NULL, 'Servicio'),
(761, '382', 'Administración', 'Yolanda', 'Pérez', 'Sánchez', 'comunicacionadd@horiente.mx', NULL, 100, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-19 09:18:00', NULL, 'SACOS PARA ENVASAR', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Material'),
(762, '209', 'Vigilancia', 'Ana Karen', 'Sosa', 'Carvajal', 'lopezmanuel2671@gmail.com', NULL, 100, 'Programado', 'Compras (Departamento de compras)', '2024-06-18 12:44:00', NULL, 'Alimento para perros.', 'Manuel López Pacheco', NULL, 'J. Guadalupe Gonzáles Reyes ', 'gerenteadministrativo@horiente.mx', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(763, '44', 'Administración', 'Marco Iván', 'Hernández', 'Pérez', 'compras@horiente.mx', NULL, 117, 'Programado', 'Compras (Departamento de compras)', '2024-06-18 09:22:00', NULL, 'Para agente de ventas ', 'Mario Sergio Alcántara Monterrosas', NULL, 'Juan Carlos Monroy Martínez', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(764, '344', 'Seguridad Industrial', 'Berenice Sarahí', 'Herrera', 'Luna', 'seguridadindustrial@horiente.mx', NULL, 100, 'Programado', 'Compras (Departamento de compras)', '2024-06-17 15:01:00', '2024-06-24', 'VENTILADOR PARA OFICINA DE ALMACÉN DE MAÍZ, DEBIDO A QUE LA OFICINA ES PEQUEÑA Y SE ACALORA MUCHO EN ESTAS ÉPOCAS. ', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(765, '276', 'Mantenimiento Industrial', 'Nallely', 'Tlatelpa', 'Tieco', 'marco.perez.0997@gmail.com', NULL, 100, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-17 10:42:00', NULL, 'Para instalación, para el equipo de detector de metales de la nueva liena buhler ', 'Marco Iván Hernández Pérez', NULL, 'Ing. Oscar Sanchez Mendez', 'mantenimientoindustrial@horiente.mx', 'Ing. M. Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(766, '344', 'Seguridad Industrial', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'seguridadindustrial@horiente.mx', NULL, 100, 'Urgente', 'Compras (Departamento de compras)', '2024-06-17 09:46:00', '2024-06-18', 'Prevenir el desperdicio de agua generado por mezcladora obsoleta que se encuentra en vigilancia.', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(767, '34', 'Mantenimiento Industrial', 'Guadalupe', 'DeGaona', 'Santiago', 'gestoria@horiente.mx', NULL, 100, 'Programado', 'Compras (Departamento de compras)', '2024-06-15 11:45:00', NULL, 'Para tener un buen nivel de aceite en las cajas de alimentadores en bancos de molienda y realizar cambios de aceite.', 'Román Francisco Martín', NULL, 'Oscar Sanchez Mendez ', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(768, '344', 'Seguridad Industrial', 'Cirilo', 'Pérez', 'Sánchez', 'seguridadindustrial@horiente.mx', NULL, 100, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-15 10:41:00', '2024-06-15', 'Recarga de gas a tanque estacionario para regaderas de personal sindicalizado ', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(769, '275', 'Administración', 'Cesar Rodrigo', 'Ortiz', 'Cantoral', 'urielortega010@gmail.com', NULL, 100, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-14 13:53:00', '2024-06-15', 'Para asegurar llantas de unidad prestada por la agencia Volkswagen, mientras terminan la reparación del económico 07', 'Miguel Uriel García Ortega', NULL, 'Juan Carlos Monroy Martínez', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(770, '308', 'Laboratorio', 'Oscar', 'Jiménez', 'Romero', 'laboratorio1@horiente.mx', NULL, 105, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-12 14:50:00', NULL, 'Cumplimiento normativo', 'Ana Lilia Fernández Tecuapacho', NULL, 'Juan Carlos Monroy', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(771, '308', 'Laboratorio', 'Luciano Martín', 'Trinidad', 'Reyes', 'laboratorio1@horiente.mx', NULL, 100, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-12 14:47:00', NULL, 'Cumplimiento normativo ', 'Ana Lilia Fernández Tecuapacho', NULL, 'Juan Carlos Monroy', 'direccion@horiente.mx', '.', NULL, NULL, 'Servicio'),
(772, '433', 'Administración', 'José Mauricio', 'Álvarez', 'González', 'fani.duarteg@gmail.com', NULL, 103, 'Urgente', 'Compras (Departamento de compras)', '2024-06-12 13:22:00', NULL, 'Comprobación de gastos de operadores.', 'Stephanie Duarte Gómez', NULL, 'Adriana Garcia Rivera ', 'chosa-estacion@horiente.mx', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(773, '44', 'Administración', 'Juan Carlos', 'Monroy', 'Martínez', 'compras@horiente.mx', NULL, 100, 'Programado', 'Compras (Departamento de compras)', '2024-06-12 11:44:00', NULL, 'PARA IMPRESIONES EN EL ÁREA DE OFICINAS ', 'Mario Sergio Alcántara Monterrosas', NULL, 'J. Guadalupe González Reyes', 'gerenteadministrativo@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(774, '50', 'Mantenimiento Industrial', 'Mateo', 'García', 'Vicente', 'mantenimientoindustrial@horiente.mx', NULL, 100, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-12 10:38:00', NULL, 'Flecha de repuesto para molino de martillos, ya que está muy desgastada la que actualmente tiene.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(775, '344', 'Seguridad Industrial', 'Andrés Elías', 'Jerónimo', 'Santiago', 'seguridadindustrial@horiente.mx', NULL, 98, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-12 09:07:00', '2024-05-22', 'LIMPIEZA DE DUCTOS PARA MUESTREO DE AGUAS RESIDUALES', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(776, '344', 'Seguridad Industrial', 'Miguel Uriel', 'García', 'Ortega', 'seguridadindustrial@horiente.mx', NULL, 75, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-12 09:05:00', '2024-06-11', 'VERIFICACIÓN DE NOM-020-STPS-2011; PARA RSP NUEVO COLOCADO EN EL ÁREA DE USOS MÚLTIPLES', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(777, '55', 'Administración', 'Jorge', 'Reyes', 'Potrero', 'gestoria@horiente.mx', NULL, 75, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-11 15:35:00', NULL, 'POLIZA DE SEGURO ALTA DIRECCIÓN', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio');
INSERT INTO `solimercaservi` (`id`, `noEmpleado`, `idDepartamento`, `nombreEmpleado`, `apellidoPaterno`, `apellidoMaterno`, `emailEmpleado`, `telefono`, `folio`, `Prioridad`, `gestiona`, `fecha_pedido`, `fecha_entrega`, `fines_utilizacion`, `nombre_solicitud`, `firma_solicitud`, `nombre_jefe`, `correo_jefe`, `nombre_recibe`, `firma_recibe`, `firma_jefe_recibe`, `solicitando`) VALUES
(778, '213', 'Administración', 'José David', 'Muñoz', 'Ramírez', 'recursoshumanos@horiente.mx', NULL, 95, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-11 11:44:00', '2024-05-31', 'ESTUDIOS SOCIOECONOMICOS A POSIBLES CANDIDATOS ', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(779, '213', 'Administración', 'Ángel Fernando', 'Sánchez', 'Vera', 'recursoshumanos@horiente.mx', NULL, 75, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-11 11:39:00', '2024-06-25', 'Capacitación para colaboradores de Recursos Humanos y Gestión de Calidad', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(780, '344', 'Seguridad Industrial', 'Andrea Eliza', 'Tuxpan', 'Sánchez', 'seguridadindustrial@horiente.mx', NULL, 75, 'Urgente', 'Compras (Departamento de compras)', '2024-06-11 10:15:00', '2024-06-12', 'CALZADO DE PROTECCIÓN PARA PERSONAL DE NUEVO INGRESO', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(781, '71', 'Administración', 'Alberto', 'Robles', 'Pineda', 'contaharinera@horiente.mx', NULL, 75, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-10 15:14:00', NULL, 'PARA EFECTOS DE DEVOLUCION DE IVA', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'José G Gonzáles Reyes', NULL, NULL, 'Servicio'),
(782, '344', 'Seguridad Industrial', 'Oscar', 'Sánchez', 'Méndez', 'seguridadindustrial@horiente.mx', NULL, 85, 'Urgente', 'Compras (Departamento de compras)', '2024-06-10 14:09:00', '2024-06-13', 'LIMPIEZA DE UTENSILIOS DE LABORATORIO', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(783, '344', 'Seguridad Industrial', 'Jorge', 'Reyes', 'Potrero', 'seguridadindustrial@horiente.mx', NULL, 84, 'Urgente', 'Compras (Departamento de compras)', '2024-06-10 13:40:00', '2024-06-13', 'DESINFECCIÓN DE MANOS PARA ÁREAS DE PRODUCCIÓN', 'Alejandra Juárez Tecayéhuatl', NULL, 'ING. JUAN CARLOS MONROY MARTÍNEZ', 'direccion@horiente.mx', 'MARIO SERGIO ALCÁNTARA MONTERROSAS', NULL, NULL, 'Material'),
(784, '275', 'Administración', 'Miguel Uriel', 'García', 'Ortega', 'urielortega010@gmail.com', NULL, 83, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-10 11:48:00', '2024-06-14', 'PRODUCTO BAJO PEDIDO PARA SU VENTA', 'Miguel Uriel García Ortega', NULL, 'Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(785, '50', 'Mantenimiento Industrial', 'Oscar', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 75, 'Programado', 'Compras (Departamento de compras)', '2024-06-10 11:16:00', NULL, 'Equipo de impresión para el departamento de mantenimiento.', 'Oscar Sánchez Méndez', NULL, 'Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(786, '276', 'Mantenimiento Industrial', 'Marco Iván', 'Hernández', 'Pérez', 'marco.perez.0997@gmail.com', NULL, 75, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-10 10:52:00', NULL, 'Para PLC del tablero del carrusel buhler (stock)', 'Marco Iván Hernández Pérez', NULL, 'Ing. Oscar Sanchez Mendez', 'mantenimientoindustrial@horiente.mx', 'Ing. M. Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(787, '26', 'Mantenimiento Industrial', 'Jorge', 'Reyes', 'Potrero', 'jorgechosa85@gmail.com', NULL, 75, 'Urgente', 'Compras (Departamento de compras)', '2024-06-08 10:18:00', NULL, 'motor de repuesto de maquina de cosedora portátil fischbein. ', 'Jorge Reyes Potrero', NULL, 'oscar sanchez mendez', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio alcántara Monterrosa', NULL, NULL, 'Material'),
(788, '415', 'Administración', 'Erica', 'Tlatelpa', 'Tieco', 'compras@horiente.mx', NULL, 75, 'Programado', 'Compras (Departamento de compras)', '2024-06-07 14:57:00', NULL, 'PARA IMPRESIONES DE OFICINAS ', 'Erica Tlatelpa Tieco', NULL, 'M. Sergio Alcantara Monterrosas', 'compras@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(789, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 73, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-07 10:31:00', '2024-06-07', 'ASESORIA FISCAL RESPONSABILIDAD SOLIDARIA ', 'Alejandra García López', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'J. GUADALUPE GONZALEZ REYES', NULL, NULL, 'Servicio'),
(790, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 72, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-07 10:27:00', '2024-06-07', 'ALMACENAJE FACT- 86589', 'Alejandra García López', NULL, 'J. GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'gerenteadministrativo@horiente.mx', NULL, NULL, 'Servicio'),
(791, '382', 'Administración', 'Karla', 'Meza', 'Palomino', 'comunicacionadd@horiente.mx', NULL, 65, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-06 14:59:00', NULL, 'Mantenimiento de pagina web ', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Servicio'),
(792, '275', 'Administración', 'Miguel Uriel', 'García', 'Ortega', 'urielortega010@gmail.com', NULL, 65, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-06 14:23:00', NULL, 'Producto bajo pedido.', 'Miguel Uriel García Ortega', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(793, '74', 'Laboratorio', 'José Mauricio', 'Álvarez', 'González', 'produccion@horiente.mx', NULL, 65, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-06 13:51:00', NULL, 'Rejilla magnética para envasadora de maíz como método de control ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martinez', 'direccion@horiente.mc', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Material'),
(794, '308', 'Laboratorio', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'laboratorio1@horiente.mx', NULL, 65, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-06 09:46:00', NULL, 'solventes para codificadores ', 'Ana Lilia Fernández Tecuapacho', NULL, 'Juan Carlos Monroy ', 'direccion@horiente.mx', 'Sergio Alcántara', NULL, NULL, 'Material'),
(795, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 59, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-05 14:23:00', NULL, 'PAGO MENSUAL JUNIO 2024DE DONATIVO A FUNDACION TV AZTECA', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'José G Gonzáles Reyes', NULL, NULL, 'Servicio'),
(796, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 59, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-05 13:29:00', '2024-05-13', 'EMPLACAMIENTO CAMIONETA DE ALTA DIRECCION', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(797, '382', 'Administración', 'Karla', 'Meza', 'Palomino', 'comunicacionadd@horiente.mx', NULL, 59, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-05 09:35:00', NULL, 'ARRENDAMIENTO DEL DEPTO 1411', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Servicio'),
(798, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 58, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 16:13:00', '2024-06-04', 'ESTACINAMIENTO POR TRÁMITES', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(799, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 57, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 16:05:00', '2024-06-04', 'ALTA DE VEHÍCULO', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(800, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 56, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 16:02:00', '2024-06-04', 'ALTA DE VEHÍCULO', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(801, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 55, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 16:00:00', '2024-06-04', 'COPIAS CERTIFICADAS DE PERMISOS DE CARGA ESTATAL', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(802, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 46, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 11:44:00', '2024-06-04', 'PERMISOS DE CARGA ESTATAL', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(803, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 51, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 11:31:00', '2024-06-03', 'PERMISOS DE CARGA ESTATAL', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(804, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 49, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 11:15:00', '2024-06-03', 'COPIAS CERTIFICADAS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(805, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 46, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-04 11:17:00', '2024-06-03', 'Emplazamiento eco 72', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'SERGIO ALCANTARA', NULL, NULL, 'Servicio'),
(806, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 46, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-04 11:09:00', '2024-06-03', 'EMPLACAMIENTO ECO 34', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(807, '148', 'Vigilancia', 'Alberto', 'Robles', 'Pineda', 'eljaguarrobles3@gmail.com', NULL, 46, 'Urgente', 'Compras (Departamento de compras)', '2024-06-04 10:09:00', '2024-06-04', 'Alimento para perros', 'Alberto Robles Pineda', NULL, 'J. Guadalupe González Reyes', 'gerenteadministrativo@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(808, '213', 'Administración', 'Berenice Sarahí', 'Herrera', 'Luna', 'recursoshumanos@horiente.mx', NULL, 44, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-06-04 08:53:00', '2024-06-04', 'REVISIONES Y CONSULTAS MEDICAS LOS DÍAS 6,13,20, 27 Y 30 DE MAYO 2024', 'Berenice Sarahí Herrera Luna', NULL, 'Lic. Elizabeth Hernadez Laureano', 'recursoshumanos@horiente.mx', 'Ing. Alcantara Monterrosas Mario Sergio', NULL, NULL, 'Servicio'),
(809, '276', 'Mantenimiento Industrial', 'Marco Iván', 'Hernández', 'Pérez', 'marco.perez.0997@gmail.com', NULL, 42, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-03 13:08:00', NULL, 'Cambio de modulo de PLC de carrusel de envasado buhler ', 'Marco Iván Hernández Pérez', NULL, 'Ing. Oscar Sanchez Mendez', 'mantenimientoindustrial@horiente.mx', 'Ing. M. Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(810, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 20, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-06-03 09:23:00', NULL, 'PAGHO DEL 50% DE ANTICIPO A LA FACTURA P4700, TIEMPO APROXIMADO DE REPARACIÓN 30 DÍAS', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'GERENTEADMINISTRATIVO@HORIENTE.MX', 'SERGIO ALRACANTARA MONTERROSAS', NULL, NULL, 'Servicio'),
(811, '308', 'Laboratorio', 'Ana Lilia', 'Fernández', 'Tecuapacho', 'laboratorio1@horiente.mx', NULL, 20, 'Urgente', 'Compras (Departamento de compras)', '2024-06-01 10:28:00', NULL, 'PARA CLORAR EL AGUA POR CUMPLIMIENTO DE NORMA.', 'Ana Lilia Fernández Tecuapacho', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(812, '197', 'Administración', 'Ana Karen', 'Sosa', 'Carvajal', 'sosak4095@gmail.com', NULL, 20, 'Programado', 'Compras (Departamento de compras)', '2024-05-31 13:46:00', NULL, 'motivación ', 'Ana Karen Sosa Carvajal', NULL, 'Candelario Garcia Rodriguez', 'hoalmacen@gmail.com', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Servicio'),
(813, '55', 'Administración', 'Oscar', 'Jiménez', 'Romero', 'gestoria@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-31 13:20:00', NULL, 'Tarjetas de peaje', 'Oscar Jiménez Romero', NULL, 'J GUADALUPE GONZALEZ REYES', 'gerenteadministrativo@horiente.mx', 'SERGIO ALCANTARA', NULL, NULL, 'Servicio'),
(814, '382', 'Administración', 'Karla', 'Meza', 'Palomino', 'comunicacionadd@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-31 11:17:00', NULL, 'ENVASADO DE PRODUCTO', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Material'),
(815, '382', 'Administración', 'Karla', 'Meza', 'Palomino', 'comunicacionadd@horiente.mx', NULL, 20, 'Programado', 'Compras (Departamento de compras)', '2024-05-31 10:46:00', NULL, 'PAPELERIA', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(816, '276', 'Mantenimiento Industrial', 'Marco Iván', 'Hernández', 'Pérez', 'marco.perez.0997@gmail.com', NULL, 30, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-05-30 10:20:00', NULL, 'Para alimentacion de motorreductor nuevo  de la rosca de llenado de la tolva de harina del carrusel buhler ', 'Marco Iván Hernández Pérez', NULL, 'Oscar Sanchez Mendez', 'mantenimientoindustrial@horiente.mx', 'M. Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(817, '74', 'Laboratorio', 'José Mauricio', 'Álvarez', 'González', 'produccion@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-30 10:03:00', NULL, 'Mangas para el molino ', 'José Mauricio Álvarez González', NULL, 'Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Material'),
(818, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-29 15:51:00', NULL, 'PARA EL SERVICIO DE AGUA POTABLE DE LA EMPRESA', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'José G Gonzáles Reyes', NULL, NULL, 'Servicio'),
(819, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-29 11:08:00', NULL, 'AUTOMÓVIL PARA DIRECTIVO ACCIONISTA IÑIGO BARQUÍN FERNÁNDEZ ', 'Alejandra García López', NULL, 'J. Guadalupe Gonzalez Reyes', 'gerenteadministrativo@horiente.mx', 'J. GUADALUPE GONZALEZ REYES', NULL, NULL, 'Material'),
(820, '26', 'Mantenimiento Industrial', 'Jorge', 'Reyes', 'Potrero', 'jorgechosa85@gmail.com', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-29 09:42:00', NULL, 'Mantenimiento a disificador de trigo ', 'Jorge Reyes Potrero', NULL, 'Oscar Sánchez Méndez ', 'mantenimientoindustrial@horiente.mx', 'Sergio Alcántara Monterrosas ', NULL, NULL, 'Material'),
(821, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-29 10:39:00', NULL, 'consumo de alimentos conmemorativo \nAdriana García Rivera \nEduardo Perez Ocotitla\nStephanie Duarte \nNayelli Tlatelpa Tieco \nAlejandra García \nJ. Guadalupe Gonzalez Reyes ', 'Alejandra García López', NULL, 'J. Guadalupe Gonzalez Reyes ', 'gerenteadministrativo@horiente.mx', 'J. GUADALUPE GONZALEZ REYES ', NULL, NULL, 'Servicio'),
(822, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 20, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-29 09:46:00', NULL, 'PAGO DE SERVICIOS PROFECIONALES A LA CANIMOLT PROYECTOS Y SERVICIOS ', 'Alejandra García López', NULL, 'ALEJANDRA GARCIA LOPEZ ', 'contaharinera@horiente.mx', 'ALEJANDRA GARCIA LOPEZ ', NULL, NULL, 'Servicio'),
(823, '80', 'Administración', 'Ángel Fernando', 'Sánchez', 'Vera', 'angelho501@gmail.com', NULL, 20, 'Programado', 'Compras (Departamento de compras)', '2024-05-28 10:40:00', NULL, 'Para Eco 201', 'Ángel Fernando Sánchez vera', NULL, 'Ing. Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Material'),
(824, '382', 'Administración', 'Karla', 'Meza', 'Palomino', 'comunicacionadd@horiente.mx', NULL, 16, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-27 08:39:00', NULL, 'DIA DEL PADRE', 'Karla Meza Palomino', NULL, 'JUAN CARLOS MONROY MARTINEZ', 'DIRECCION@HORIENTE.MX', 'MARIO SERGIO ALCANTARA MONTEROSAS', NULL, NULL, 'Material'),
(825, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 18, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-25 12:22:00', NULL, 'Para mantener y aumentar las ventas mensuales mes abril 2024', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Servicio'),
(826, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 17, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-25 12:20:00', NULL, 'Para las capacitaciones virtuales de temas fiscales, legales y contables ', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Servicio'),
(827, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 16, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-25 12:17:00', NULL, 'POR LA SUSCRIPCION A LA CAMARA NACIONAL DE LA INDUSTRIA MOLINERA DE TRIGO', 'Alejandra García López', NULL, 'Jose G Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Servicio'),
(828, '71', 'Administración', 'Alejandra', 'García', 'López', 'contaharinera@horiente.mx', NULL, 13, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-24 11:27:00', NULL, 'Para pago de impuestos abril 2024', 'Alejandra García López', NULL, 'J Guadalupe Reyes Gonzalez', 'gerenteadministrativo@horiente.mx', 'mario sergio alcantara monterosas', NULL, NULL, 'Servicio'),
(829, '74', 'Laboratorio', 'José Mauricio', 'Álvarez', 'González', 'produccion@horiente.mx', NULL, 12, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-23 12:56:00', NULL, 'Rejilla de imanes para envasadora de maiz', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martinez', 'direccion@horiente.mx', 'Mario Sergio Alcantara Monterrosas', NULL, NULL, 'Material'),
(830, '74', 'Laboratorio', 'José Mauricio', 'Álvarez', 'González', 'produccion@horiente.mx', NULL, 12, 'Programado', 'Directa (Departamento que hace la solicitud)', '2024-05-23 12:41:00', NULL, 'Andén de carga para la nueva línea Buhler ', 'José Mauricio Álvarez González', NULL, 'Ing Juan Carlos Monroy Martínez ', 'direccion@horiente.mx', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Servicio'),
(831, '276', 'Mantenimiento Industrial', 'Marco Iván', 'Hernández', 'Pérez', 'marco.perez.0997@gmail.com', NULL, 5, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-05-22 12:21:00', NULL, 'Para mantenimiento a carrusel buhler ', 'Marco Iván Hernández Pérez', NULL, 'Oscar Sánchez Méndez ', 'mantenimientoindustrial@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(832, '50', 'Mantenimiento Industrial', 'Oscar', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 5, 'Programado', 'Compras (Departamento de compras)', '2024-05-22 08:44:00', NULL, 'Mantenimiento a aspiración del área de limpia y acondicionamiento.', 'Oscar Sánchez Méndez', NULL, 'José Mauricio Alvarez González ', 'produccion@horiente.mx', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Material'),
(833, '415', 'Administración', 'Erica', 'Tlatelpa', 'Tieco', 'compras@horiente.mx', NULL, 5, 'Programado', 'Compras (Departamento de compras)', '2024-05-21 10:03:00', NULL, 'Hojas para impresiones de oficinas.', 'Erica Tlatelpa Tieco', NULL, 'Sergio Alcantara Monterrosas ', 'compras@horiente.mx', 'Sergio Alcantara Monterrosas ', NULL, NULL, 'Material'),
(834, '50', 'Mantenimiento Industrial', 'Oscar', 'Sánchez', 'Méndez', 'mantenimientoindustrial@horiente.mx', NULL, 4, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-05-20 15:34:00', NULL, 'Pintura para el área exterior del cuarto del poso de agua.', 'Oscar Sánchez Méndez', NULL, 'José Mauricio Alvarez González ', 'produccion@horiente.mx', 'Mario Sergio Alcántara Monterrosas', NULL, NULL, 'Material'),
(835, '44', 'Administración', 'Mario Sergio', 'Alcántara', 'Monterrosas', 'compras@horiente.mx', NULL, 3, 'Urgente', 'Directa (Departamento que hace la solicitud)', '2024-05-20 11:27:00', NULL, 'para mantenimiento de bancos de molienda Nota: prueba piloto para no ejecutar la compra.', 'Mario Sergio Alcántara Monterrosas', NULL, 'Ing. Juan Carlos Monroy Martínez', 'doreccion@horiente.mx', 'Ericka Tlatelpa Tieco', NULL, NULL, 'Material');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontacto`
--

CREATE TABLE `tipocontacto` (
  `idTipoContacto` int(11) NOT NULL,
  `tipoContacto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipocontacto`
--

INSERT INTO `tipocontacto` (`idTipoContacto`, `tipoContacto`) VALUES
(1, 'Primario'),
(2, 'Secundario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocontactocliente`
--

CREATE TABLE `tipocontactocliente` (
  `idTipoContacto` int(11) NOT NULL,
  `tipoContacto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipocontactocliente`
--

INSERT INTO `tipocontactocliente` (`idTipoContacto`, `tipoContacto`) VALUES
(1, 'Primario'),
(2, 'Secundario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tu_tabla`
--

CREATE TABLE `tu_tabla` (
  `id` int(11) NOT NULL,
  `noEmpleado` varchar(50) DEFAULT NULL,
  `idDepartamento` int(11) NOT NULL,
  `nombreEmpleado` varchar(100) DEFAULT NULL,
  `apellidoPaterno` varchar(100) DEFAULT NULL,
  `apellidoMaterno` varchar(100) DEFAULT NULL,
  `emailEmpleado` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `folio` varchar(50) DEFAULT NULL,
  `fecha_reporte` datetime DEFAULT NULL,
  `tipo_inc` varchar(100) DEFAULT NULL,
  `dep_rep` varchar(100) DEFAULT NULL,
  `descrip_inc` text DEFAULT NULL,
  `evidencia` text DEFAULT NULL,
  `fecha_atencion` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contra` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `correo`, `contra`) VALUES
(7, 'Marc', 'marcalvarez392@gmail.com', '1234'),
(8, 'Marc', 'marcalvarez392@gmail.com', '1234'),
(9, 'Marc', 'marcalvarez392@gmail.com', '1234'),
(10, 'Marc', 'marcalvarez392@gmail.com', '1234'),
(11, 'marcalvarez392@gmail.com', 'Marc', '1234'),
(12, 'marcalvarez392@gmail.com', 'Marc', '1234'),
(13, 'marcalvarez392@gmail.com', 'Marc', 'sdqfklwr'),
(14, 'marcalvarez392@gmail.com', 'Marc', 'papa'),
(15, 'marcalvarez392@gmail.com', 'Marc', 'holamundo'),
(16, 'marcalvarez392@gmail.com', 'Marc', 'krodpxqgr'),
(17, 'Marc', 'marcalvarez392@gmail.com', 'krodpxqgr'),
(18, 'Marc', 'marcalvarez392@gmail.com', 'shsh'),
(19, 'Marc', 'marcalvarez392@gmail.com', 'nlor'),
(20, 'Marc', 'marcalvarez392@gmail.com', 'shsh'),
(21, 'Marc', 'marcalvarez392@gmail.com', 'jwd5hvorphmru');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD PRIMARY KEY (`idArchivos`),
  ADD KEY `idx_idEmpleado` (`idEmpleado`),
  ADD KEY `idx_idCliente` (`idCliente`),
  ADD KEY `idx_idProveedor` (`idProveedor`);

--
-- Indices de la tabla `caracteristicasescolaboradores`
--
ALTER TABLE `caracteristicasescolaboradores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ESColaboradores_id` (`ESColaboradores_id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `contactocliente`
--
ALTER TABLE `contactocliente`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `contactoproveedor`
--
ALTER TABLE `contactoproveedor`
  ADD PRIMARY KEY (`idContacto`),
  ADD KEY `idProveedor` (`idProveedor`),
  ADD KEY `idTipoContacto` (`idTipoContacto`);

--
-- Indices de la tabla `contratoscliente`
--
ALTER TABLE `contratoscliente`
  ADD PRIMARY KEY (`idContrato`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `contratosproveedor`
--
ALTER TABLE `contratosproveedor`
  ADD PRIMARY KEY (`idContrato`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `correosforms`
--
ALTER TABLE `correosforms`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`idDepto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `idDepartamento` (`idDepartamento`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `escolaboradores`
--
ALTER TABLE `escolaboradores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `folio` (`folio`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indices de la tabla `esvisitantes`
--
ALTER TABLE `esvisitantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `esvisitantescaracteristicas`
--
ALTER TABLE `esvisitantescaracteristicas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ESVisitantes_id` (`ESVisitantes_id`);

--
-- Indices de la tabla `interaccion`
--
ALTER TABLE `interaccion`
  ADD PRIMARY KEY (`idInteraccion`),
  ADD KEY `idCliente` (`idCliente`);

--
-- Indices de la tabla `mercancias_servicios`
--
ALTER TABLE `mercancias_servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soliMercaServi_id` (`soliMercaServi_id`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `reinci`
--
ALTER TABLE `reinci`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDepartamento` (`idDepartamento`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solimercaservi`
--
ALTER TABLE `solimercaservi`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipocontacto`
--
ALTER TABLE `tipocontacto`
  ADD PRIMARY KEY (`idTipoContacto`);

--
-- Indices de la tabla `tipocontactocliente`
--
ALTER TABLE `tipocontactocliente`
  ADD PRIMARY KEY (`idTipoContacto`);

--
-- Indices de la tabla `tu_tabla`
--
ALTER TABLE `tu_tabla`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDepartamento_idx` (`idDepartamento`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos`
--
ALTER TABLE `archivos`
  MODIFY `idArchivos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `caracteristicasescolaboradores`
--
ALTER TABLE `caracteristicasescolaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `idCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contactocliente`
--
ALTER TABLE `contactocliente`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contactoproveedor`
--
ALTER TABLE `contactoproveedor`
  MODIFY `idContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contratoscliente`
--
ALTER TABLE `contratoscliente`
  MODIFY `idContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contratosproveedor`
--
ALTER TABLE `contratosproveedor`
  MODIFY `idContrato` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `correosforms`
--
ALTER TABLE `correosforms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `idDepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT de la tabla `escolaboradores`
--
ALTER TABLE `escolaboradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `esvisitantes`
--
ALTER TABLE `esvisitantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `esvisitantescaracteristicas`
--
ALTER TABLE `esvisitantescaracteristicas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `interaccion`
--
ALTER TABLE `interaccion`
  MODIFY `idInteraccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `mercancias_servicios`
--
ALTER TABLE `mercancias_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=828;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reinci`
--
ALTER TABLE `reinci`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solimercaservi`
--
ALTER TABLE `solimercaservi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=836;

--
-- AUTO_INCREMENT de la tabla `tipocontacto`
--
ALTER TABLE `tipocontacto`
  MODIFY `idTipoContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipocontactocliente`
--
ALTER TABLE `tipocontactocliente`
  MODIFY `idTipoContacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tu_tabla`
--
ALTER TABLE `tu_tabla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos`
--
ALTER TABLE `archivos`
  ADD CONSTRAINT `archivos_ibfk_1` FOREIGN KEY (`idEmpleado`) REFERENCES `empleado` (`idEmpleado`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_ibfk_2` FOREIGN KEY (`idCliente`) REFERENCES `client` (`idCliente`) ON DELETE CASCADE,
  ADD CONSTRAINT `archivos_ibfk_3` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`) ON DELETE CASCADE;

--
-- Filtros para la tabla `caracteristicasescolaboradores`
--
ALTER TABLE `caracteristicasescolaboradores`
  ADD CONSTRAINT `caracteristicasescolaboradores_ibfk_1` FOREIGN KEY (`ESColaboradores_id`) REFERENCES `escolaboradores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `contactocliente`
--
ALTER TABLE `contactocliente`
  ADD CONSTRAINT `contactocliente_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `client` (`idCliente`);

--
-- Filtros para la tabla `contactoproveedor`
--
ALTER TABLE `contactoproveedor`
  ADD CONSTRAINT `contactoproveedor_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`),
  ADD CONSTRAINT `contactoproveedor_ibfk_2` FOREIGN KEY (`idTipoContacto`) REFERENCES `tipocontacto` (`idTipoContacto`);

--
-- Filtros para la tabla `contratoscliente`
--
ALTER TABLE `contratoscliente`
  ADD CONSTRAINT `contratoscliente_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `client` (`idCliente`);

--
-- Filtros para la tabla `contratosproveedor`
--
ALTER TABLE `contratosproveedor`
  ADD CONSTRAINT `contratosproveedor_ibfk_1` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepto`),
  ADD CONSTRAINT `empleado_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `escolaboradores`
--
ALTER TABLE `escolaboradores`
  ADD CONSTRAINT `escolaboradores_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepto`);

--
-- Filtros para la tabla `esvisitantescaracteristicas`
--
ALTER TABLE `esvisitantescaracteristicas`
  ADD CONSTRAINT `esvisitantescaracteristicas_ibfk_1` FOREIGN KEY (`ESVisitantes_id`) REFERENCES `esvisitantes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `interaccion`
--
ALTER TABLE `interaccion`
  ADD CONSTRAINT `interaccion_ibfk_1` FOREIGN KEY (`idCliente`) REFERENCES `client` (`idCliente`);

--
-- Filtros para la tabla `mercancias_servicios`
--
ALTER TABLE `mercancias_servicios`
  ADD CONSTRAINT `mercancias_servicios_ibfk_1` FOREIGN KEY (`soliMercaServi_id`) REFERENCES `solimercaservi` (`id`);

--
-- Filtros para la tabla `reinci`
--
ALTER TABLE `reinci`
  ADD CONSTRAINT `reinci_ibfk_1` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepto`);

--
-- Filtros para la tabla `tu_tabla`
--
ALTER TABLE `tu_tabla`
  ADD CONSTRAINT `fk_idDepartamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
