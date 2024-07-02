-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: proyecto
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Administrator`
--

DROP TABLE IF EXISTS `Administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Administrator` (
  `idAdministrator` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `state` tinyint NOT NULL,
  PRIMARY KEY (`idAdministrator`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Administrator`
--

LOCK TABLES `Administrator` WRITE;
/*!40000 ALTER TABLE `Administrator` DISABLE KEYS */;
INSERT INTO `Administrator` VALUES (1,'Admin','Admin','admin@udistrital.edu.co','202cb962ac59075b964b07152d234b70',NULL,'123','123',1);
/*!40000 ALTER TABLE `Administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Bloom`
--

DROP TABLE IF EXISTS `Bloom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Bloom` (
  `idBloom` int NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  PRIMARY KEY (`idBloom`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Bloom`
--

LOCK TABLES `Bloom` WRITE;
/*!40000 ALTER TABLE `Bloom` DISABLE KEYS */;
INSERT INTO `Bloom` VALUES (1,'Nivel 1','Conocimiento: En este nivel, los estudiantes deben ser capaces de recordar información previamente aprendida o recordar hechos.'),(4,'Nivel 2','Comprensión: Implica la capacidad de comprender el significado de la información y explicar ideas de manera propia'),(5,'Nivel 3','Aplicación: En este nivel, los estudiantes deben ser capaces de aplicar el conocimiento adquirido en nuevas situaciones o contextos.'),(6,'Nivel 4','Análisis: Implica la capacidad de descomponer la información en partes más pequeñas para comprender su estructura y relaciones.'),(7,'Nivel 5','Síntesis (o Creación): Los estudiantes en este nivel son capaces de combinar partes para formar un todo nuevo y original, generar nuevas ideas o productos.'),(8,'Nivel 6','Evaluación: Implica la capacidad de juzgar la validez, la calidad o la importancia de la información, ideas o productos basados en criterios específicos.');
/*!40000 ALTER TABLE `Bloom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Calificacion`
--

DROP TABLE IF EXISTS `Calificacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Calificacion` (
  `idCalificacion` int NOT NULL AUTO_INCREMENT,
  `nivel` varchar(45) NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `criterio_idCriterio` int NOT NULL,
  PRIMARY KEY (`idCalificacion`),
  KEY `criterio_idCriterio` (`criterio_idCriterio`),
  CONSTRAINT `Calificacion_ibfk_1` FOREIGN KEY (`criterio_idCriterio`) REFERENCES `Criterio` (`idCriterio`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calificacion`
--

LOCK TABLES `Calificacion` WRITE;
/*!40000 ALTER TABLE `Calificacion` DISABLE KEYS */;
INSERT INTO `Calificacion` VALUES (1,'Excelente (5)','El diagrama está muy bien organizado y presenta una estructura clara que facilita una comprensión completa y rápida del sistema.',1),(2,'Muy bueno (4)','El diagrama está claramente organizado, facilitando la comprensión de la estructura del sistema.',1),(3,'Bueno (3)','El diagrama está bien organizado, pero algunos elementos podrían estar mejor dispuestos para facilitar la comprensión.',1),(4,'Aceptable (2)','El diagrama es rudimentario y puede causar cierta confusión en la comprensión de la estructura del sistema.',1),(5,'Insuficiente (1)','El diagrama es confuso y desorganizado, dificultando la comprensión de la estructura del sistema.',1),(6,'Excelente (5)','El diagrama proporciona información detallada, precisa y relevante sobre la estructura del sistema, cubriendo todos los aspectos importantes de manera clara y concisa.',2),(7,'Muy bueno (4)','El diagrama proporciona información precisa y relevante sobre la estructura del sistema, aunque podría incluir más detalles para una comprensión completa.',2),(8,'Bueno (3)','El diagrama proporciona la mayoría de la información necesaria, pero algunos detalles importantes pueden estar incompletos o poco claros.',2),(9,'Aceptable (2)','El diagrama proporciona información básica pero omite detalles importantes sobre la estructura del sistema.',2),(10,'Insuficiente (1)','El diagrama carece de información esencial y contiene elementos irrelevantes que no contribuyen a la comprensión del sistema.',2),(11,'Excelente (5)','El diagrama demuestra una gran creatividad y originalidad en la representación de la estructura del sistema, presentando ideas innovadoras y fuera de lo común.',3),(12,'Muy bueno (4)','El diagrama muestra un nivel notable de creatividad en la representación de la estructura del sistema, introduciendo algunas ideas originales y únicas',3),(13,'Bueno (3)','El diagrama muestra un intento de originalidad en la representación de la estructura del sistema, aunque podría ser más innovador.',3),(14,'Aceptable (2)','El diagrama muestra cierta creatividad en la representación, pero sigue patrones convencionales sin innovación significativa.',3),(15,'Insuficiente (1)','El diagrama carece de creatividad y originalidad, mostrando una estructura genérica sin aportar ideas nuevas.',3),(16,'Excelente (5)','El diagrama es altamente coherente y consistente en el diseño, mostrando una representación uniforme y cuidadosamente diseñada de todos los elementos del sistema.',4),(17,'Muy bueno (4)','El diagrama es coherente y consistente en la representación de los elementos del sistema, manteniendo un estilo uniforme en toda la estructura.',4),(18,'Bueno (3)','El diagrama es coherente en su mayor parte, aunque puede haber algunas discrepancias menores en la representación de los elementos.',4),(19,'Aceptable (2)','El diagrama muestra cierta coherencia en el diseño, pero hay inconsistencias notables en la representación de algunos elementos.',4),(20,'Insuficiente (1)','El diagrama es incoherente y carece de consistencia en la representación de los elementos del sistema.',4),(21,'Excelente (5)','La presentación del diagrama es excelente, utilizando efectivamente elementos visuales para facilitar la comprensión y hacer que el diagrama sea atractivo y fácil de interpretar.',5),(22,'Muy bueno (4)','La presentación del diagrama es buena, utilizando colores y estilos que mejoran la comprensión y la visualización.',5),(23,'Bueno (3)','La presentación del diagrama es aceptable, aunque algunos aspectos visuales podrían ser más pulidos para mejorar la claridad.',5),(24,'Aceptable (2)','La presentación del diagrama es básica y podría mejorarse para hacerlo más atractivo y fácil de entender.',5),(25,'Insuficiente (1)','La presentación del diagrama es descuidada y poco atractiva, dificultando su comprensión.',5);
/*!40000 ALTER TABLE `Calificacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CategoriaRa`
--

DROP TABLE IF EXISTS `CategoriaRa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CategoriaRa` (
  `idCategoriaRa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`idCategoriaRa`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CategoriaRa`
--

LOCK TABLES `CategoriaRa` WRITE;
/*!40000 ALTER TABLE `CategoriaRa` DISABLE KEYS */;
INSERT INTO `CategoriaRa` VALUES (1,'PRINCIPIOS DE DISEÑO DE SOFTWARE'),(2,'PRINCIPIOS DE DISEÑO DE INGENIERÍA TELEMÁTICA'),(3,'RESOLVER PROBLEMAS DE DESARROLLO DE SOFTWARE'),(4,'RESOLVER PROBLEMAS DE INGENIERÍA TELEMÁTICA'),(5,'RESPONSABILIDAD SOCIAL, PROFESIONAL Y ÉTICA');
/*!40000 ALTER TABLE `CategoriaRa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Criterio`
--

DROP TABLE IF EXISTS `Criterio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Criterio` (
  `idCriterio` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `detalle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCriterio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Criterio`
--

LOCK TABLES `Criterio` WRITE;
/*!40000 ALTER TABLE `Criterio` DISABLE KEYS */;
INSERT INTO `Criterio` VALUES (1,'Claridad y organización del diagrama',''),(2,'Precisión y relevancia de la información',''),(3,'Creatividad y originalidad',''),(4,'Coherencia y consistencia en el diseño',''),(5,'Presentación y calidad visual','');
/*!40000 ALTER TABLE `Criterio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dashboard`
--

DROP TABLE IF EXISTS `Dashboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Dashboard` (
  `idDashboard` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `detalle` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idDashboard`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dashboard`
--

LOCK TABLES `Dashboard` WRITE;
/*!40000 ALTER TABLE `Dashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `Dashboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Estrategia`
--

DROP TABLE IF EXISTS `Estrategia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Estrategia` (
  `idEstrategia` int NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `resultadoAprendizaje_idResultadoAprendizaje` int NOT NULL,
  PRIMARY KEY (`idEstrategia`),
  KEY `resultadoAprendizaje_idResultadoAprendizaje` (`resultadoAprendizaje_idResultadoAprendizaje`),
  CONSTRAINT `Estrategia_ibfk_1` FOREIGN KEY (`resultadoAprendizaje_idResultadoAprendizaje`) REFERENCES `ResultadoAprendizaje` (`idResultadoAprendizaje`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Estrategia`
--

LOCK TABLES `Estrategia` WRITE;
/*!40000 ALTER TABLE `Estrategia` DISABLE KEYS */;
INSERT INTO `Estrategia` VALUES (1,'Estudio de Casos','Presenta a los estudiantes casos reales de arquitecturas de software y sistemas, luego pídeles que creen diagramas arquitectónicos basados en esos casos. Esto les permite aplicar los conceptos aprendidos a situaciones prácticas',1),(2,'Mentoría y Tutoría','Proporciona sesiones de tutoría o mentoría donde los estudiantes trabajen individualmente o en grupos pequeños con un experto en arquitectura de software. Esto les brinda la oportunidad de recibir retroalimentación personalizada y orientación durante el proceso de creación de los diagramas.',1),(3,'Ejercicios Prácticos Guiados','Proporciona ejercicios prácticos paso a paso donde los estudiantes puedan seguir instrucciones detalladas para crear diferentes tipos de diagramas arquitectónicos. Estos ejercicios pueden aumentar gradualmente en complejidad.',1),(4,'Proyectos de Colaboración','Asigna proyectos de diseño arquitectónico donde los estudiantes trabajen en equipos para desarrollar diagramas arquitectónicos para sistemas de software completos. Fomenta la colaboración, la comunicación y el trabajo en equipo.',1),(5,'Uso de Herramientas de Software','Introduce a los estudiantes en herramientas de software especializadas para crear diagramas arquitectónicos, como Lucidchart, Microsoft Visio o draw.io. Proporciona tutoriales y prácticas para que se familiaricen con estas herramientas.',1),(6,'Estudio Independiente','Proporciona recursos, como libros, tutoriales en línea y documentación técnica, para que los estudiantes puedan estudiar de forma independiente y profundizar en los conceptos relacionados con la creación de diagramas arquitectónicos.',1),(7,'Análisis y Evaluación de Diagramas','Presenta a los estudiantes una variedad de diagramas arquitectónicos existentes y pídeles que los analicen y evalúen. Esto les ayudará a comprender diferentes enfoques y estilos de diseño arquitectónico.',1),(8,'Sesiones de Revisión en Grupo','Organiza sesiones regulares de revisión en grupo donde los estudiantes puedan presentar y discutir sus diagramas arquitectónicos con sus compañeros. Esto fomenta la retroalimentación entre pares y el intercambio de ideas.',1),(9,'Simulaciones y Juegos de Roles','Crea simulaciones o juegos de roles donde los estudiantes actúen como arquitectos de software y deban crear diagramas arquitectónicos en respuesta a escenarios específicos o requisitos del cliente.',1),(10,'Entrevistas','Realizar entrevistas con los stakeholders y usuarios del sistema para comprender sus necesidades y requerimientos de información. Es importante preparar preguntas específicas y estructuradas para obtener la información necesaria.',3),(11,'Identificación de requisitos de acceso a los datos','Comprender los requisitos de acceso a los datos dentro del contexto de la infraestructura telemática, incluyendo qué datos necesitan ser accedidos, desde dónde y con qué frecuencia. Esto implica analizar las necesidades de los usuarios y las aplicaciones que interactúan con la infraestructura.',2),(12,'Estudio de casos','Presenta a los estudiantes casos de estudio de empresas reales que hayan implementado infraestructuras de redes corporativas exitosas. Analiza con ellos los desafíos que enfrentaron, las decisiones que tomaron y los resultados obtenidos. Esto ayuda a los estudiantes a comprender cómo se aplica el diseño de infraestructura de redes en entornos empresariales reales.',4),(13,'Proyectos prácticos','Divida a los estudiantes en equipos y pídales que diseñen una infraestructura de redes corporativas para un escenario empresarial ficticio. Proporciónales una lista de requisitos y restricciones para que consideren durante el diseño. Esto les permitirá aplicar los conceptos teóricos aprendidos en un entorno práctico y trabajar en equipo para desarrollar soluciones.',4);
/*!40000 ALTER TABLE `Estrategia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EstrategiaCriterio`
--

DROP TABLE IF EXISTS `EstrategiaCriterio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `EstrategiaCriterio` (
  `idEstrategiaCriterio` int NOT NULL AUTO_INCREMENT,
  `estrategia_idEstrategia` int NOT NULL,
  `criterio_idCriterio` int NOT NULL,
  PRIMARY KEY (`idEstrategiaCriterio`),
  KEY `estrategia_idEstrategia` (`estrategia_idEstrategia`),
  KEY `criterio_idCriterio` (`criterio_idCriterio`),
  CONSTRAINT `EstrategiaCriterio_ibfk_1` FOREIGN KEY (`estrategia_idEstrategia`) REFERENCES `Estrategia` (`idEstrategia`),
  CONSTRAINT `EstrategiaCriterio_ibfk_2` FOREIGN KEY (`criterio_idCriterio`) REFERENCES `Criterio` (`idCriterio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EstrategiaCriterio`
--

LOCK TABLES `EstrategiaCriterio` WRITE;
/*!40000 ALTER TABLE `EstrategiaCriterio` DISABLE KEYS */;
/*!40000 ALTER TABLE `EstrategiaCriterio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grafica`
--

DROP TABLE IF EXISTS `Grafica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Grafica` (
  `idGrafica` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `detalle` varchar(45) DEFAULT NULL,
  `config` varchar(45) NOT NULL,
  `fila` varchar(45) NOT NULL,
  `posicion` varchar(45) NOT NULL,
  `tam` varchar(45) DEFAULT NULL,
  `dashboard_idDashboard` int NOT NULL,
  PRIMARY KEY (`idGrafica`),
  KEY `dashboard_idDashboard` (`dashboard_idDashboard`),
  CONSTRAINT `Grafica_ibfk_1` FOREIGN KEY (`dashboard_idDashboard`) REFERENCES `Dashboard` (`idDashboard`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grafica`
--

LOCK TABLES `Grafica` WRITE;
/*!40000 ALTER TABLE `Grafica` DISABLE KEYS */;
/*!40000 ALTER TABLE `Grafica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LogAdministrator`
--

DROP TABLE IF EXISTS `LogAdministrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LogAdministrator` (
  `idLogAdministrator` int NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `information` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `os` varchar(45) NOT NULL,
  `browser` varchar(45) NOT NULL,
  `administrator_idAdministrator` int NOT NULL,
  PRIMARY KEY (`idLogAdministrator`),
  KEY `administrator_idAdministrator` (`administrator_idAdministrator`),
  CONSTRAINT `LogAdministrator_ibfk_1` FOREIGN KEY (`administrator_idAdministrator`) REFERENCES `Administrator` (`idAdministrator`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LogAdministrator`
--

LOCK TABLES `LogAdministrator` WRITE;
/*!40000 ALTER TABLE `LogAdministrator` DISABLE KEYS */;
INSERT INTO `LogAdministrator` VALUES (1,'Log In','','2024-06-24','18:39:58','127.0.0.1','Linux','Chrome',1),(2,'Create Categoria Ra','Nombre: PRINCIPIOS DE DISEÑO DE SOFTWARE','2024-06-24','18:42:38','127.0.0.1','Linux','Chrome',1),(3,'Create Categoria Ra','Nombre: PRINCIPIOS DE DISEÑO DE INGENIERÍA TELEMÁTICA','2024-06-24','18:43:07','127.0.0.1','Linux','Chrome',1),(4,'Create Categoria Ra','Nombre: APLICAR CONOCIMIENTOS EN DESARROLLO DE SOFTWARE','2024-06-24','18:43:41','127.0.0.1','Linux','Chrome',1),(5,'Create Categoria Ra','Nombre: APLICAR CONOCIIMIENTOS EN INGENIERÍA TELEMÁTICA','2024-06-24','18:43:58','127.0.0.1','Linux','Chrome',1),(6,'Create Categoria Ra','Nombre: RESOLVER PROBLEMAS DE DESARROLLO DE SOFTWARE','2024-06-24','18:44:23','127.0.0.1','Linux','Chrome',1),(7,'Create Categoria Ra','Nombre: RESOLVER PROBLEMAS DE INGENIERÍA TELEMÁTICA','2024-06-24','18:44:50','127.0.0.1','Linux','Chrome',1),(8,'Create Categoria Ra','Nombre: RESPONSABILIDAD SOCIAL, PROFESIONAL Y ÉTICA','2024-06-24','18:45:05','127.0.0.1','Linux','Chrome',1),(9,'Create Categoria Ra','Nombre: CONOCIMIENTOS DEL TSD: EN ARQUITECTURA, DESARROLLO DE SOFTWARE','2024-06-24','18:45:25','127.0.0.1','Linux','Chrome',1),(10,'Create Categoria Ra','Nombre: APLICA TÉCNICAS, HERRAMIENTAS Y METODOLOGÍAS: SOFTWARE','2024-06-24','18:46:05','127.0.0.1','Linux','Chrome',1),(11,'Create Categoria Ra','Nombre: CONSTRUYE SOLUCIONES QUE PROCESAN DATOS CON ESTÁNDARES DE CALIDAD','2024-06-24','18:47:44','127.0.0.1','Linux','Chrome',1),(12,'Create Categoria Ra','Nombre: CONOCMIENTOS MATEMÁTICOS PARA TSD QUE LE PERMITEN OPTIMIZAR LOS DESARROLLOS DE SOFTWARE','2024-06-24','18:48:28','127.0.0.1','Linux','Chrome',1),(13,'Create Categoria Ra','Nombre: CONOCMIENTOS MATEMÁTICOS PARA IT QUE LE PERMITEN OPTIMIZAR LAS SOLUCIONES TELEMÁTICAS PROPUESTAS','2024-06-24','18:49:14','127.0.0.1','Linux','Chrome',1),(14,'Create Bloom','Nombre: Nivel 1; Detalle: Conocimiento: En este nivel, los estudiantes deben ser capaces de recordar información previamente aprendida o recordar hechos.;','2024-06-24','18:58:24','127.0.0.1','Linux','Chrome',1),(15,'Create Bloom','Nombre: Nivel 1; Detalle: Conocimiento: En este nivel, los estudiantes deben ser capaces de recordar información previamente aprendida o recordar hechos.;','2024-06-24','18:59:11','127.0.0.1','Linux','Chrome',1),(16,'Create Bloom','Nombre: Nivel 1; Detalle: ;','2024-06-24','19:02:20','127.0.0.1','Linux','Chrome',1),(17,'Create Bloom','Nombre: Nivel 1; Detalle: ;','2024-06-24','19:05:01','127.0.0.1','Linux','Chrome',1),(18,'Create Bloom','Nombre: Nivel 2; Detalle: Comprensión: Implica la capacidad de comprender el significado de la información y explicar ideas de manera propia.;','2024-06-24','19:18:50','127.0.0.1','Linux','Chrome',1),(19,'Create Bloom','Nombre: Nivel 2; Detalle: ;','2024-06-24','19:20:06','127.0.0.1','Linux','Chrome',1),(20,'Create Bloom','Nombre: Nivel 2; Detalle: ;','2024-06-24','19:20:30','127.0.0.1','Linux','Chrome',1),(21,'Create Bloom','Nombre: Nivel 2; Detalle: Comprensión: Implica la capacidad de comprender el significado de la información y explicar ideas de manera propia;','2024-06-24','19:21:09','127.0.0.1','Linux','Chrome',1),(22,'Create Bloom','Nombre: Nivel 2; Detalle: Comprensión: Implica la capacidad de comprender el significado de la información y explicar ideas de manera propia;','2024-06-24','19:23:10','127.0.0.1','Linux','Chrome',1),(23,'Create Bloom','Nombre: Nivel 3; Detalle: Aplicación: En este nivel, los estudiantes deben ser capaces de aplicar el conocimiento adquirido en nuevas situaciones o contextos.;','2024-06-24','19:23:58','127.0.0.1','Linux','Chrome',1),(24,'Create Bloom','Nombre: Nivel 4; Detalle: Análisis: Implica la capacidad de descomponer la información en partes más pequeñas para comprender su estructura y relaciones.;','2024-06-24','19:24:27','127.0.0.1','Linux','Chrome',1),(25,'Create Bloom','Nombre: Nivel 5; Detalle: Síntesis (o Creación): Los estudiantes en este nivel son capaces de combinar partes para formar un todo nuevo y original, generar nuevas ideas o productos.;','2024-06-24','19:24:46','127.0.0.1','Linux','Chrome',1),(26,'Create Bloom','Nombre: Nivel 6; Detalle: Evaluación: Implica la capacidad de juzgar la validez, la calidad o la importancia de la información, ideas o productos basados en criterios específicos.;','2024-06-24','19:25:03','127.0.0.1','Linux','Chrome',1),(27,'Create Resultado Aprendizaje','Nombre: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software; Detalle: ; Bloom: Nivel 5;; Categoria Ra: PRINCIPIOS DE DISEÑO DE INGENIERÍA TELEMÁTICA','2024-06-24','20:01:50','127.0.0.1','Linux','Chrome',1),(28,'Log In','','2024-06-25','15:02:56','127.0.0.1','Linux','Chrome',1),(29,'Create Estrategia','Nombre: Estudio de Casos; Detalle: Presenta a los estudiantes casos reales de arquitecturas de software y sistemas, luego pídeles que creen diagramas arquitectónicos basados en esos casos. Esto les permite aplicar los conceptos aprendidos a situaciones prácticas; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:07:36','127.0.0.1','Linux','Chrome',1),(30,'Create Estrategia','Nombre: Mentoría y Tutoría; Detalle: Proporciona sesiones de tutoría o mentoría donde los estudiantes trabajen individualmente o en grupos pequeños con un experto en arquitectura de software. Esto les brinda la oportunidad de recibir retroalimentación personalizada y orientación durante el proceso de creación de los diagramas.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:08:01','127.0.0.1','Linux','Chrome',1),(31,'Create Estrategia','Nombre: Ejercicios Prácticos Guiados; Detalle: Proporciona ejercicios prácticos paso a paso donde los estudiantes puedan seguir instrucciones detalladas para crear diferentes tipos de diagramas arquitectónicos. Estos ejercicios pueden aumentar gradualmente en complejidad.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:08:12','127.0.0.1','Linux','Chrome',1),(32,'Create Estrategia','Nombre: Proyectos de Colaboración; Detalle: Asigna proyectos de diseño arquitectónico donde los estudiantes trabajen en equipos para desarrollar diagramas arquitectónicos para sistemas de software completos. Fomenta la colaboración, la comunicación y el trabajo en equipo.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:08:22','127.0.0.1','Linux','Chrome',1),(33,'Create Estrategia','Nombre: Uso de Herramientas de Software; Detalle: Introduce a los estudiantes en herramientas de software especializadas para crear diagramas arquitectónicos, como Lucidchart, Microsoft Visio o draw.io. Proporciona tutoriales y prácticas para que se familiaricen con estas herramientas.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:08:37','127.0.0.1','Linux','Chrome',1),(34,'Create Estrategia','Nombre: Estudio Independiente; Detalle: Proporciona recursos, como libros, tutoriales en línea y documentación técnica, para que los estudiantes puedan estudiar de forma independiente y profundizar en los conceptos relacionados con la creación de diagramas arquitectónicos.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:08:59','127.0.0.1','Linux','Chrome',1),(35,'Create Estrategia','Nombre: Análisis y Evaluación de Diagramas; Detalle: Presenta a los estudiantes una variedad de diagramas arquitectónicos existentes y pídeles que los analicen y evalúen. Esto les ayudará a comprender diferentes enfoques y estilos de diseño arquitectónico.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:09:09','127.0.0.1','Linux','Chrome',1),(36,'Create Estrategia','Nombre: Sesiones de Revisión en Grupo; Detalle: Organiza sesiones regulares de revisión en grupo donde los estudiantes puedan presentar y discutir sus diagramas arquitectónicos con sus compañeros. Esto fomenta la retroalimentación entre pares y el intercambio de ideas.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:09:19','127.0.0.1','Linux','Chrome',1),(37,'Create Estrategia','Nombre: Simulaciones y Juegos de Roles; Detalle: Crea simulaciones o juegos de roles donde los estudiantes actúen como arquitectos de software y deban crear diagramas arquitectónicos en respuesta a escenarios específicos o requisitos del cliente.; Resultado Aprendizaje: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','2024-06-25','15:09:31','127.0.0.1','Linux','Chrome',1),(38,'Create Criterio','Nombre: Claridad y organización del diagrama; Detalle: ','2024-06-25','15:10:49','127.0.0.1','Linux','Chrome',1),(39,'Create Criterio','Nombre: Precisión y relevancia de la información; Detalle: ','2024-06-25','15:10:53','127.0.0.1','Linux','Chrome',1),(40,'Create Criterio','Nombre: Creatividad y originalidad; Detalle: ','2024-06-25','15:10:57','127.0.0.1','Linux','Chrome',1),(41,'Create Criterio','Nombre: Coherencia y consistencia en el diseño; Detalle: ','2024-06-25','15:11:03','127.0.0.1','Linux','Chrome',1),(42,'Create Criterio','Nombre: Presentación y calidad visual; Detalle: ','2024-06-25','15:11:09','127.0.0.1','Linux','Chrome',1),(43,'Create Calificacion','Nivel: Excelente (5); Detalle: El diagrama está muy bien organizado y presenta una estructura clara que facilita una comprensión completa y rápida del sistema.; Criterio: Claridad y organización del diagrama','2024-06-25','15:12:24','127.0.0.1','Linux','Chrome',1),(44,'Create Calificacion','Nivel: Muy bueno (4); Detalle: (4) El diagrama está claramente organizado, facilitando la comprensión de la estructura del sistema.; Criterio: Claridad y organización del diagrama','2024-06-25','15:12:39','127.0.0.1','Linux','Chrome',1),(45,'Create Calificacion','Nivel: Bueno (3); Detalle: El diagrama está bien organizado, pero algunos elementos podrían estar mejor dispuestos para facilitar la comprensión.; Criterio: Claridad y organización del diagrama','2024-06-25','15:12:55','127.0.0.1','Linux','Chrome',1),(46,'Create Calificacion','Nivel: Aceptable (2); Detalle: El diagrama es rudimentario y puede causar cierta confusión en la comprensión de la estructura del sistema.; Criterio: Claridad y organización del diagrama','2024-06-25','15:13:12','127.0.0.1','Linux','Chrome',1),(47,'Create Calificacion','Nivel: Insuficiente (1); Detalle: El diagrama es confuso y desorganizado, dificultando la comprensión de la estructura del sistema.; Criterio: Claridad y organización del diagrama','2024-06-25','15:13:36','127.0.0.1','Linux','Chrome',1),(48,'Edit Calificacion','Nivel: Muy bueno (4); Detalle: El diagrama está claramente organizado, facilitando la comprensión de la estructura del sistema.; Criterio: Claridad y organización del diagrama','2024-06-25','15:14:16','127.0.0.1','Linux','Chrome',1),(49,'Create Calificacion','Nivel: Excelente (5); Detalle: El diagrama proporciona información detallada, precisa y relevante sobre la estructura del sistema, cubriendo todos los aspectos importantes de manera clara y concisa.; Criterio: Precisión y relevancia de la información','2024-06-25','15:17:02','127.0.0.1','Linux','Chrome',1),(50,'Create Calificacion','Nivel: Muy bueno (4); Detalle: El diagrama proporciona información precisa y relevante sobre la estructura del sistema, aunque podría incluir más detalles para una comprensión completa.; Criterio: Precisión y relevancia de la información','2024-06-25','15:17:16','127.0.0.1','Linux','Chrome',1),(51,'Create Calificacion','Nivel: Bueno (3); Detalle: El diagrama proporciona la mayoría de la información necesaria, pero algunos detalles importantes pueden estar incompletos o poco claros.; Criterio: Precisión y relevancia de la información','2024-06-25','15:17:28','127.0.0.1','Linux','Chrome',1),(52,'Create Calificacion','Nivel: Aceptable (2); Detalle: El diagrama proporciona información básica pero omite detalles importantes sobre la estructura del sistema.; Criterio: Precisión y relevancia de la información','2024-06-25','15:17:45','127.0.0.1','Linux','Chrome',1),(53,'Create Calificacion','Nivel: Insuficiente (1); Detalle: El diagrama carece de información esencial y contiene elementos irrelevantes que no contribuyen a la comprensión del sistema.; Criterio: Precisión y relevancia de la información','2024-06-25','15:17:57','127.0.0.1','Linux','Chrome',1),(54,'Create Calificacion','Nivel: Excelente (5); Detalle: El diagrama demuestra una gran creatividad y originalidad en la representación de la estructura del sistema, presentando ideas innovadoras y fuera de lo común.; Criterio: Creatividad y originalidad','2024-06-25','15:18:43','127.0.0.1','Linux','Chrome',1),(55,'Create Calificacion','Nivel: Muy bueno (4); Detalle: El diagrama muestra un nivel notable de creatividad en la representación de la estructura del sistema, introduciendo algunas ideas originales y únicas; Criterio: Creatividad y originalidad','2024-06-25','15:18:54','127.0.0.1','Linux','Chrome',1),(56,'Create Calificacion','Nivel: Bueno (3); Detalle: El diagrama muestra un intento de originalidad en la representación de la estructura del sistema, aunque podría ser más innovador.; Criterio: Creatividad y originalidad','2024-06-25','15:19:07','127.0.0.1','Linux','Chrome',1),(57,'Create Calificacion','Nivel: Aceptable (2); Detalle: El diagrama muestra cierta creatividad en la representación, pero sigue patrones convencionales sin innovación significativa.; Criterio: Creatividad y originalidad','2024-06-25','15:19:19','127.0.0.1','Linux','Chrome',1),(58,'Create Calificacion','Nivel: Insuficiente (1); Detalle: El diagrama carece de creatividad y originalidad, mostrando una estructura genérica sin aportar ideas nuevas.; Criterio: Creatividad y originalidad','2024-06-25','15:19:32','127.0.0.1','Linux','Chrome',1),(59,'Create Calificacion','Nivel: Excelente (5); Detalle: El diagrama es altamente coherente y consistente en el diseño, mostrando una representación uniforme y cuidadosamente diseñada de todos los elementos del sistema.; Criterio: Coherencia y consistencia en el diseño','2024-06-25','15:19:51','127.0.0.1','Linux','Chrome',1),(60,'Create Calificacion','Nivel: Muy bueno (4); Detalle: El diagrama es coherente y consistente en la representación de los elementos del sistema, manteniendo un estilo uniforme en toda la estructura.; Criterio: Coherencia y consistencia en el diseño','2024-06-25','15:20:02','127.0.0.1','Linux','Chrome',1),(61,'Create Calificacion','Nivel: Bueno (3); Detalle: El diagrama es coherente en su mayor parte, aunque puede haber algunas discrepancias menores en la representación de los elementos.; Criterio: Coherencia y consistencia en el diseño','2024-06-25','15:20:16','127.0.0.1','Linux','Chrome',1),(62,'Create Calificacion','Nivel: Aceptable (2); Detalle: El diagrama muestra cierta coherencia en el diseño, pero hay inconsistencias notables en la representación de algunos elementos.; Criterio: Coherencia y consistencia en el diseño','2024-06-25','15:20:29','127.0.0.1','Linux','Chrome',1),(63,'Create Calificacion','Nivel: Insuficiente (1); Detalle: El diagrama es incoherente y carece de consistencia en la representación de los elementos del sistema.; Criterio: Coherencia y consistencia en el diseño','2024-06-25','15:20:42','127.0.0.1','Linux','Chrome',1),(64,'Create Calificacion','Nivel: Excelente (5); Detalle: La presentación del diagrama es excelente, utilizando efectivamente elementos visuales para facilitar la comprensión y hacer que el diagrama sea atractivo y fácil de interpretar.; Criterio: Presentación y calidad visual','2024-06-25','15:21:02','127.0.0.1','Linux','Chrome',1),(65,'Create Calificacion','Nivel: Muy bueno (4); Detalle: La presentación del diagrama es buena, utilizando colores y estilos que mejoran la comprensión y la visualización.; Criterio: Presentación y calidad visual','2024-06-25','15:21:13','127.0.0.1','Linux','Chrome',1),(66,'Create Calificacion','Nivel: Bueno (3); Detalle: La presentación del diagrama es aceptable, aunque algunos aspectos visuales podrían ser más pulidos para mejorar la claridad.; Criterio: Presentación y calidad visual','2024-06-25','15:21:24','127.0.0.1','Linux','Chrome',1),(67,'Create Calificacion','Nivel: Aceptable (2); Detalle: La presentación del diagrama es básica y podría mejorarse para hacerlo más atractivo y fácil de entender.; Criterio: Presentación y calidad visual','2024-06-25','15:21:35','127.0.0.1','Linux','Chrome',1),(68,'Create Calificacion','Nivel: Insuficiente (1); Detalle: La presentación del diagrama es descuidada y poco atractiva, dificultando su comprensión.; Criterio: Presentación y calidad visual','2024-06-25','15:21:46','127.0.0.1','Linux','Chrome',1),(69,'Log In','','2024-06-25','15:23:13','127.0.0.1','Linux','Chrome',1),(70,'Create Usuario','Name: prueba; Last Name: dashboard; Email: prueba@udistrital.edu.co; Password: 123; Phone: ; Mobile: ; State: 1','2024-06-25','15:23:43','127.0.0.1','Linux','Chrome',1),(71,'Log In','','2024-06-25','15:47:42','127.0.0.1','Linux','Chrome',1),(72,'Create Resultado Aprendizaje','Nombre: Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática; Detalle: ; Bloom: Nivel 5;; Categoria Ra: PRINCIPIOS DE DISEÑO DE INGENIERÍA TELEMÁTICA','2024-06-25','15:48:34','127.0.0.1','Linux','Chrome',1),(73,'Edit Resultado Aprendizaje','Nombre: Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software; Detalle: ; Bloom: Nivel 5;; Categoria Ra: PRINCIPIOS DE DISEÑO DE SOFTWARE','2024-06-25','15:48:49','127.0.0.1','Linux','Chrome',1),(74,'Create Resultado Aprendizaje','Nombre: Identifica los requerimientos y la información necesarios para el desarrollo de sistemas de software; Detalle: ; Bloom: Nivel 2;; Categoria Ra: PRINCIPIOS DE DISEÑO DE SOFTWARE','2024-06-25','15:49:20','127.0.0.1','Linux','Chrome',1),(75,'Log In','','2024-06-25','17:18:01','127.0.0.1','Linux','Chrome',1),(76,'Log In','','2024-06-26','18:55:49','127.0.0.1','Linux','Chrome',1),(77,'Log In','','2024-07-01','14:27:34','::1','Linux','Chrome',1),(78,'Log In','','2024-07-01','15:14:22','::1','Linux','Chrome',1),(79,'Create Estrategia','Nombre: Entrevistas; Detalle: Realizar entrevistas con los stakeholders y usuarios del sistema para comprender sus necesidades y requerimientos de información. Es importante preparar preguntas específicas y estructuradas para obtener la información necesaria.; Resultado Aprendizaje: Identifica los requerimientos y la información necesarios para el desarrollo de sistemas de software','2024-07-01','15:14:50','::1','Linux','Chrome',1),(80,'Log In','','2024-07-01','21:58:39','::1','Linux','Chrome',1),(81,'Create Estrategia','Nombre: Identificación de requisitos de acceso a los datos; Detalle: Comprender los requisitos de acceso a los datos dentro del contexto de la infraestructura telemática, incluyendo qué datos necesitan ser accedidos, desde dónde y con qué frecuencia. Esto implica analizar las necesidades de los usuarios y las aplicaciones que interactúan con la infraestructura.; Resultado Aprendizaje: Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática','2024-07-01','21:59:48','::1','Linux','Chrome',1),(82,'Create Estrategia','Nombre: Identificación de requisitos de acceso a los datos; Detalle: Comprender los requisitos de acceso a los datos dentro del contexto de la infraestructura telemática, incluyendo qué datos necesitan ser accedidos, desde dónde y con qué frecuencia. Esto implica analizar las necesidades de los usuarios y las aplicaciones que interactúan con la infraestructura.; Resultado Aprendizaje: Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática','2024-07-01','22:02:39','::1','Linux','Chrome',1),(83,'Create Estrategia','Nombre: Identificación de requisitos de acceso a los datos; Detalle: Comprender los requisitos de acceso a los datos dentro del contexto de la infraestructura telemática, incluyendo qué datos necesitan ser accedidos, desde dónde y con qué frecuencia. Esto implica analizar las necesidades de los usuarios y las aplicaciones que interactúan con la infraestructura.; Resultado Aprendizaje: Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática','2024-07-01','22:04:19','::1','Linux','Chrome',1),(84,'Create Estrategia','Nombre: Identificación de requisitos de acceso a los datos; Detalle: Comprender los requisitos de acceso a los datos dentro del contexto de la infraestructura telemática, incluyendo qué datos necesitan ser accedidos, desde dónde y con qué frecuencia. Esto implica analizar las necesidades de los usuarios y las aplicaciones que interactúan con la infraestructura.; Resultado Aprendizaje: Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática','2024-07-01','22:05:32','::1','Linux','Chrome',1),(85,'Create Resultado Aprendizaje','Nombre: Diseña una infraestructura de redes corporativas para la transmisión de información con calidad; Detalle: ; Bloom: Nivel 5;; Categoria Ra: PRINCIPIOS DE DISEÑO DE INGENIERÍA TELEMÁTICA','2024-07-01','22:06:23','::1','Linux','Chrome',1),(86,'Create Estrategia','Nombre: Estudio de casos; Detalle: Presenta a los estudiantes casos de estudio de empresas reales que hayan implementado infraestructuras de redes corporativas exitosas. Analiza con ellos los desafíos que enfrentaron, las decisiones que tomaron y los resultados obtenidos. Esto ayuda a los estudiantes a comprender cómo se aplica el diseño de infraestructura de redes en entornos empresariales reales.; Resultado Aprendizaje: Diseña una infraestructura de redes corporativas para la transmisión de información con calidad','2024-07-01','22:06:42','::1','Linux','Chrome',1),(87,'Create Estrategia','Nombre: Proyectos prácticos; Detalle: Divida a los estudiantes en equipos y pídales que diseñen una infraestructura de redes corporativas para un escenario empresarial ficticio. Proporciónales una lista de requisitos y restricciones para que consideren durante el diseño. Esto les permitirá aplicar los conceptos teóricos aprendidos en un entorno práctico y trabajar en equipo para desarrollar soluciones.; Resultado Aprendizaje: Diseña una infraestructura de redes corporativas para la transmisión de información con calidad','2024-07-01','22:06:58','::1','Linux','Chrome',1);
/*!40000 ALTER TABLE `LogAdministrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LogUsuario`
--

DROP TABLE IF EXISTS `LogUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `LogUsuario` (
  `idLogUsuario` int NOT NULL AUTO_INCREMENT,
  `action` varchar(100) NOT NULL,
  `information` text NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `os` varchar(45) NOT NULL,
  `browser` varchar(45) NOT NULL,
  `usuario_idUsuario` int NOT NULL,
  PRIMARY KEY (`idLogUsuario`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`),
  CONSTRAINT `LogUsuario_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LogUsuario`
--

LOCK TABLES `LogUsuario` WRITE;
/*!40000 ALTER TABLE `LogUsuario` DISABLE KEYS */;
INSERT INTO `LogUsuario` VALUES (1,'Log In','','2024-06-25','15:23:50','127.0.0.1','Linux','Chrome',1),(2,'Log In','','2024-06-25','16:21:33','127.0.0.1','Linux','Chrome',1),(3,'Log In','','2024-06-25','17:14:28','127.0.0.1','Linux','Chrome',1),(4,'Log In','','2024-06-26','14:51:56','127.0.0.1','Linux','Chrome',1),(5,'Log In','','2024-06-26','15:21:53','127.0.0.1','Linux','Chrome',1),(6,'Log In','','2024-06-26','19:03:29','127.0.0.1','Linux','Chrome',1),(7,'Log In','','2024-07-01','12:16:46','::1','Linux','Chrome',1),(8,'Log In','','2024-07-01','19:12:45','::1','Linux','Chrome',1),(9,'Log In','','2024-07-01','20:17:11','::1','Linux','Chrome',1);
/*!40000 ALTER TABLE `LogUsuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ResultadoAprendizaje`
--

DROP TABLE IF EXISTS `ResultadoAprendizaje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ResultadoAprendizaje` (
  `idResultadoAprendizaje` int NOT NULL AUTO_INCREMENT,
  `nombre` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `detalle` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `bloom_idBloom` int NOT NULL,
  `categoriaRa_idCategoriaRa` int NOT NULL,
  PRIMARY KEY (`idResultadoAprendizaje`),
  KEY `bloom_idBloom` (`bloom_idBloom`),
  KEY `categoriaRa_idCategoriaRa` (`categoriaRa_idCategoriaRa`),
  CONSTRAINT `ResultadoAprendizaje_ibfk_1` FOREIGN KEY (`bloom_idBloom`) REFERENCES `Bloom` (`idBloom`),
  CONSTRAINT `ResultadoAprendizaje_ibfk_2` FOREIGN KEY (`categoriaRa_idCategoriaRa`) REFERENCES `CategoriaRa` (`idCategoriaRa`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ResultadoAprendizaje`
--

LOCK TABLES `ResultadoAprendizaje` WRITE;
/*!40000 ALTER TABLE `ResultadoAprendizaje` DISABLE KEYS */;
INSERT INTO `ResultadoAprendizaje` VALUES (1,'Crea diagramas arquitectónicos que representen visualmente la estructura y el diseño de un sistema de software','',7,1),(2,'Diseña mecanismos de acceso a los datos al interior de una infraestructura telemática','',7,2),(3,'Identifica los requerimientos y la información necesarios para el desarrollo de sistemas de software','',4,1),(4,'Diseña una infraestructura de redes corporativas para la transmisión de información con calidad','',7,2);
/*!40000 ALTER TABLE `ResultadoAprendizaje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `picture` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `state` tinyint NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'prueba','dashboard','prueba@udistrital.edu.co','202cb962ac59075b964b07152d234b70','','','',1);
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsuarioDashboard`
--

DROP TABLE IF EXISTS `UsuarioDashboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `UsuarioDashboard` (
  `idUsuarioDashboard` int NOT NULL AUTO_INCREMENT,
  `usuario_idUsuario` int NOT NULL,
  `dashboard_idDashboard` int NOT NULL,
  PRIMARY KEY (`idUsuarioDashboard`),
  KEY `usuario_idUsuario` (`usuario_idUsuario`),
  KEY `dashboard_idDashboard` (`dashboard_idDashboard`),
  CONSTRAINT `UsuarioDashboard_ibfk_1` FOREIGN KEY (`usuario_idUsuario`) REFERENCES `Usuario` (`idUsuario`),
  CONSTRAINT `UsuarioDashboard_ibfk_2` FOREIGN KEY (`dashboard_idDashboard`) REFERENCES `Dashboard` (`idDashboard`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsuarioDashboard`
--

LOCK TABLES `UsuarioDashboard` WRITE;
/*!40000 ALTER TABLE `UsuarioDashboard` DISABLE KEYS */;
/*!40000 ALTER TABLE `UsuarioDashboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'proyecto'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-07-01 22:27:17
