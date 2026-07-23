-- Simple Backup SQL Dump
-- Version 1.0.3
-- https://www.github.com/coderatio/simple-backup/
--
-- Host: localhost:3306
-- Generation Time: Dec 02, 2025 at 09:40 AM
-- MYSQL Server Version: 8.4.3
-- PHP Version: 7.4.29
-- Developer: Josiah O. Yahaya
-- Copyright: Coderatio

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00"

--
-- Database: `web_hospital`
-- Total Tables: 32
--

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anidada`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anidada` (
  `id_tabla_anidada` int NOT NULL AUTO_INCREMENT,
  `id_modulos` int DEFAULT NULL,
  `nivel_db` varchar(100) DEFAULT NULL,
  `tabla_db` varchar(100) DEFAULT NULL,
  `consulta_crear_tabla` text,
  `template_fields_db` varchar(100) NOT NULL,
  `active_filter_db` varchar(100) NOT NULL,
  `clone_row_db` varchar(100) NOT NULL,
  `active_popup_db` varchar(100) NOT NULL,
  `active_search_db` varchar(100) NOT NULL,
  `activate_deleteMultipleBtn_db` varchar(100) NOT NULL,
  `button_add_db` varchar(100) NOT NULL,
  `actions_buttons_grid_db` varchar(100) NOT NULL,
  `activate_nested_table_db` varchar(100) NOT NULL,
  `buttons_actions_db` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tabla_anidada`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anidada`
--

LOCK TABLES `anidada` WRITE;
/*!40000 ALTER TABLE `anidada` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `anidada` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `anidada` with 0 row(s)
--

--
-- Table structure for table `backup`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backup` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario` varchar(100) NOT NULL,
  `archivo` varchar(300) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup`
--

LOCK TABLES `backup` WRITE;
/*!40000 ALTER TABLE `backup` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `backup` VALUES (61,'admin','procedimiento1709047088.sql','2024-02-27','12:18:08'),(62,'admin','procedimiento1709047233.sql','2024-02-27','12:20:33'),(63,'admin','procedimiento1709047314.sql','2024-02-27','12:21:54'),(64,'admin','procedimiento1729712513.sql','2024-10-23','16:41:53');
/*!40000 ALTER TABLE `backup` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `backup` with 4 row(s)
--

--
-- Table structure for table `barra_inferior`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barra_inferior` (
  `id_barra_inferior` int NOT NULL AUTO_INCREMENT,
  `imagen` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id_barra_inferior`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barra_inferior`
--

LOCK TABLES `barra_inferior` WRITE;
/*!40000 ALTER TABLE `barra_inferior` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barra_inferior` VALUES (1,'1756904438_thumbnail_1. BOTON OIRS.jpg','https://oirs.minsal.cl/'),(2,'1756904531_thumbnail_2. TRANSPARENCIA ACTIVA.jpg','https://www.portaltransparencia.cl/PortalPdT/pdtta?codOrganismo=AO074'),(3,'1756904555_thumbnail_3. SOLICITUD TRANSPARENCIA.png','https://transparencia.redsalud.gob.cl/transparencia/public/ssp/solicitud_informacion.html'),(4,'1756904575_thumbnail_4. CHILE ATIENDE.png','https://www.chileatiende.gob.cl/'),(5,'1756904694_thumbnail_5. LEY LOBBY.png','https://www.leylobby.gob.cl/instituciones/AO074'),(6,'1756904716_thumbnail_6. MINSAL.jpg','https://www.minsal.cl/');
/*!40000 ALTER TABLE `barra_inferior` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barra_inferior` with 6 row(s)
--

--
-- Table structure for table `barra_lateral_derecha`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barra_lateral_derecha` (
  `id_barra_lateral_derecha` int NOT NULL AUTO_INCREMENT,
  `tipo_contenido` varchar(100) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `video` text NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id_barra_lateral_derecha`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barra_lateral_derecha`
--

LOCK TABLES `barra_lateral_derecha` WRITE;
/*!40000 ALTER TABLE `barra_lateral_derecha` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barra_lateral_derecha` VALUES (1,'Imagen','1756829388_thumbnail_1. PORTAL PACIENTE.png','','https://portalpaciente.minsal.cl/'),(2,'Imagen','1756829422_thumbnail_2. COPAGO CERO.png','','https://www.gob.cl/copagocero/'),(3,'Imagen','1756829441_thumbnail_4. SALUD RESPONDE.png','','https://saludresponde.minsal.cl/'),(4,'Imagen','1756829500_thumbnail_5. VACUNACIÓN.png','','https://www.minsal.cl/campana-vacunacion-e-inmunizacion-de-invierno-2025-introduccion-y-documentos/'),(5,'Imagen','1756829517_thumbnail_6. VACUNATORIOS.png','','https://diprece.minsal.cl/wp-content/uploads/2024/02/puntos-vacunacion.html'),(6,'Imagen','1756829542_thumbnail_7. TURNOS FARMACIA.png','','https://seremienlinea.minsal.cl/asdigital/index.php?mfarmacias'),(7,'Imagen','1756829631_thumbnail_8. LÍNEA 4141.png','','https://portalsaluddigital.minsal.cl/telemedicina-sincronica/4141-linea-prevencion-del-suicidio/'),(8,'Imagen','1756829654_thumbnail_9. LEY TABACO.png','','https://www.minsal.cl/advertencia-sanitaria-para-envases-de-productos-de-tabaco-y-vapeo/'),(9,'Imagen','1756829674_thumbnail_10. LEY ALIMENTOS.png','','https://www.minsal.cl/reglamento-de-la-ley-de-etiquetado-de-alimentos-introduccion/'),(10,'Imagen','1756829700_thumbnail_11. SALUD DIGITAL.png','','https://portalsaluddigital.minsal.cl/'),(11,'Imagen','1756829724_thumbnail_12. SEGURIDAD PACIENTE.png','','https://www.minsal.cl/seguridad-y-calidad-de-la-atencion-marco-legal/'),(12,'Imagen','1756829743_thumbnail_13. 100 AÑOS MINSAL.png','','https://www.minsal.cl/100-anos-de-la-creacion-del-ministerio-de-higiene-asistencia-y-prevision-social-100-anos-de-salud-y-seguridad-social/'),(13,'Imagen','1759417705_1758033410_thumbnail_14. PREVIENE VIH.png','','https://diprece.minsal.cl/informacion-a-la-comunidad-vih-sida-e-its/'),(14,'Imagen','1759417722_1758033426_thumbnail_15. SALUD NNA.jpg','','https://diprece.minsal.cl/programas-de-salud/programas-ciclo-vital/informacion-a-la-comunidad-programa-salud-de-la-infancia/');
/*!40000 ALTER TABLE `barra_lateral_derecha` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barra_lateral_derecha` with 14 row(s)
--

--
-- Table structure for table `barra_lateral_izquierda`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barra_lateral_izquierda` (
  `id_barra_lateral_izquierda` int NOT NULL AUTO_INCREMENT,
  `tipo_contenido` varchar(100) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `video` text NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id_barra_lateral_izquierda`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barra_lateral_izquierda`
--

LOCK TABLES `barra_lateral_izquierda` WRITE;
/*!40000 ALTER TABLE `barra_lateral_izquierda` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `barra_lateral_izquierda` VALUES (1,'Imagen','1756827866_thumbnail_1. AGENDA TU RECETA.png','','https://farmaciahospitaldemelipilla.youcanbook.me/'),(2,'Imagen','1756828026_thumbnail_2. AGENDA DONACIÓN.png','','https://donasangremelipilla.youcanbook.me/'),(3,'Imagen','1756828048_thumbnail_3. VISITA GUIADA MATERNIDAD.png','','https://docs.google.com/forms/d/e/1FAIpQLScxX_pts6yTclcfCf-6N2UUkhbCsmJexHo6RaAIqyX4hZqAfg/viewform'),(4,'Imagen','1756828477_thumbnail_4. HUMANIZACIÓN.png','','/web_hospital/pagina/Plan-de-Humanizacion'),(5,'Imagen','1756828556_thumbnail_5. LEY MILA.png','','/web_hospital/pagina/Ley-Mila'),(6,'Imagen','1756828595_thumbnail_6. LEY DOMINGA.png','','/web_hospital/pagina/Ley-Dominga'),(7,'Imagen','1756828660_thumbnail_7. CHILE CRECE CONTIGO.png','','/web_hospital/pagina/Chile-Crece-Contigo'),(8,'Imagen','1756828687_thumbnail_8. LEY CUIDADOS PALIATIVOS.png','','https://www.minsal.cl/ley-cuidados-paliativos/'),(9,'Imagen','1756828730_thumbnail_9. HOSPITAL AMIGO.png','','/web_hospital/pagina/Hospital-Amigo'),(10,'Imagen','1756828757_thumbnail_10. PRAIS.png','','https://prais.minsal.cl/'),(11,'Imagen','1756828778_thumbnail_11. ESCUELA HOSPITALARIA.png','','/web_hospital/pagina/Escuela-Hospitalaria'),(14,'Imagen','1756828878_thumbnail_12. DERECHOS Y DEBERES.png','','https://www.minsal.cl/derechos-y-deberes-de-los-pacientes/'),(15,'Imagen','1756829066_thumbnail_13. CUENTA PÚBLICA.png','','https://hospitaldemelipilla.cl/wp-content/uploads/2025/07/CUENTA-PUBLICA-PARTICIPATIVA-GESTION-2024-2.pdf'),(21,'Video','','&lt;iframe width=\"100%\" src=\"https://www.youtube.com/embed/GJm0QqlYgzk?si=DrWkxGK7kib2hLtu\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen&gt;&lt;/iframe&gt;',''),(22,'Video','','&lt;iframe width=\"100%\" src=\"https://www.youtube.com/embed/-znE1zQN828?si=ycofpttp8zf4uuv9\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen&gt;&lt;/iframe&gt;','');
/*!40000 ALTER TABLE `barra_lateral_izquierda` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `barra_lateral_izquierda` with 15 row(s)
--

--
-- Table structure for table `carga_masiva`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carga_masiva` (
  `id_carga_masiva` int NOT NULL AUTO_INCREMENT,
  `archivo` varchar(255) NOT NULL,
  `modulo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_carga_masiva`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carga_masiva`
--

LOCK TABLES `carga_masiva` WRITE;
/*!40000 ALTER TABLE `carga_masiva` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `carga_masiva` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `carga_masiva` with 0 row(s)
--

--
-- Table structure for table `categorias`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `id_categorias` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categorias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `categorias` VALUES (1,'Noticias');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `categorias` with 1 row(s)
--

--
-- Table structure for table `configuracion`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `id_configuracion` int NOT NULL AUTO_INCREMENT,
  `logo_login` varchar(300) NOT NULL,
  `logo_panel` varchar(300) NOT NULL,
  `titulo_sistema` varchar(200) NOT NULL,
  `color_fondo_menu_panel` varchar(100) NOT NULL,
  `banner_superior` varchar(300) NOT NULL,
  PRIMARY KEY (`id_configuracion`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `configuracion` VALUES (1,'1753278586_1710180276_hospital.jpg','1753278586_1710180276_hospital.jpg','Web Hospital','#9e4141','1756821695_header.jpeg');
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `configuracion` with 1 row(s)
--

--
-- Table structure for table `configuraciones_api`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones_api` (
  `id_configuraciones_api` int NOT NULL AUTO_INCREMENT,
  `generar_jwt_token` varchar(100) NOT NULL,
  `autenticar_jwt_token` varchar(100) DEFAULT NULL,
  `tiempo_caducidad_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_configuraciones_api`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones_api`
--

LOCK TABLES `configuraciones_api` WRITE;
/*!40000 ALTER TABLE `configuraciones_api` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `configuraciones_api` VALUES (1,'No',NULL,NULL);
/*!40000 ALTER TABLE `configuraciones_api` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `configuraciones_api` with 1 row(s)
--

--
-- Table structure for table `configuraciones_pdf`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuraciones_pdf` (
  `id_configuraciones_pdf` int NOT NULL AUTO_INCREMENT,
  `logo_pdf` varchar(300) DEFAULT NULL,
  `marca_agua_pdf` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id_configuraciones_pdf`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuraciones_pdf`
--

LOCK TABLES `configuraciones_pdf` WRITE;
/*!40000 ALTER TABLE `configuraciones_pdf` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `configuraciones_pdf` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `configuraciones_pdf` with 0 row(s)
--

--
-- Table structure for table `creador_de_panel`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creador_de_panel` (
  `id_creador_de_panel` int NOT NULL AUTO_INCREMENT,
  `cantidad_columnas` int NOT NULL,
  PRIMARY KEY (`id_creador_de_panel`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creador_de_panel`
--

LOCK TABLES `creador_de_panel` WRITE;
/*!40000 ALTER TABLE `creador_de_panel` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `creador_de_panel` VALUES (5,9);
/*!40000 ALTER TABLE `creador_de_panel` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `creador_de_panel` with 1 row(s)
--

--
-- Table structure for table `crear_tablas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crear_tablas` (
  `id_crear_tablas` int NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) NOT NULL,
  `query_tabla` text NOT NULL,
  `modificar_tabla` text,
  `tabla_modificada` varchar(100) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id_crear_tablas`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crear_tablas`
--

LOCK TABLES `crear_tablas` WRITE;
/*!40000 ALTER TABLE `crear_tablas` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `crear_tablas` VALUES (28,'personas','id_personas INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,\r\nnombre VARCHAR(100)  NOT NULL,\r\napellido VARCHAR(100)  NOT NULL,\r\nfecha_nacimiento DATE  NOT NULL,\r\nadjunto VARCHAR(300)  NOT NULL',NULL,'No'),(29,'empleados','id_empleados INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,\r\nid_personas INT(11)  NOT NULL,\r\nnombre_empleado VARCHAR(100)  NOT NULL,\r\napellido_empleado VARCHAR(100)  NOT NULL',NULL,'No');
/*!40000 ALTER TABLE `crear_tablas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `crear_tablas` with 2 row(s)
--

--
-- Table structure for table `custom_panel`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `custom_panel` (
  `id_custom_panel` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `url` varchar(300) NOT NULL,
  `id_creador_de_panel` int NOT NULL,
  PRIMARY KEY (`id_custom_panel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `custom_panel`
--

LOCK TABLES `custom_panel` WRITE;
/*!40000 ALTER TABLE `custom_panel` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `custom_panel` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `custom_panel` with 0 row(s)
--

--
-- Table structure for table `empleados`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empleados` (
  `id_empleados` int NOT NULL AUTO_INCREMENT,
  `id_personas` int NOT NULL,
  `nombre_empleado` varchar(100) NOT NULL,
  `apellido_empleado` varchar(100) NOT NULL,
  PRIMARY KEY (`id_empleados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleados`
--

LOCK TABLES `empleados` WRITE;
/*!40000 ALTER TABLE `empleados` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `empleados` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `empleados` with 0 row(s)
--

--
-- Table structure for table `estructura_tabla`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estructura_tabla` (
  `id_estructura_tabla` int NOT NULL AUTO_INCREMENT,
  `id_crear_tablas` int NOT NULL,
  `nombre_campo` varchar(200) NOT NULL,
  `nombre_nuevo_campo` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `caracteres` varchar(100) DEFAULT NULL,
  `autoincremental` varchar(100) NOT NULL,
  `indice` varchar(100) NOT NULL,
  `valor_nulo` varchar(100) DEFAULT NULL,
  `modificar_campo` varchar(100) NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id_estructura_tabla`)
) ENGINE=InnoDB AUTO_INCREMENT=163 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estructura_tabla`
--

LOCK TABLES `estructura_tabla` WRITE;
/*!40000 ALTER TABLE `estructura_tabla` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `estructura_tabla` VALUES (154,28,'id_personas','','Entero','11','Si','Primario','No','No'),(155,28,'nombre','','Caracteres','100','No','Sin Indice','No','No'),(156,28,'apellido','','Caracteres','100','No','Sin Indice','No','No'),(157,28,'fecha_nacimiento','','Fecha','','No','Sin Indice','No','No'),(158,28,'adjunto','','Caracteres','300','No','Sin Indice','No','No'),(159,29,'id_empleados','','Entero','11','Si','Primario','No','No'),(160,29,'id_personas','','Entero','11','No','Sin Indice','No','No'),(161,29,'nombre_empleado','','Caracteres','100','No','Sin Indice','No','No'),(162,29,'apellido_empleado','','Caracteres','100','No','Sin Indice','No','No');
/*!40000 ALTER TABLE `estructura_tabla` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `estructura_tabla` with 9 row(s)
--

--
-- Table structure for table `galeria`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galeria` (
  `id_galeria` int NOT NULL AUTO_INCREMENT,
  `nombre_imagen` varchar(200) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galeria`
--

LOCK TABLES `galeria` WRITE;
/*!40000 ALTER TABLE `galeria` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `galeria` VALUES (1,'imagen1','1757011659_WhatsApp-Image-2025-08-14-at-10.11.00-645x362.jpeg'),(2,'imagen2','1757011747_WhatsApp-Image-2025-08-07-at-16.03.25.jpeg'),(3,'imagen3','1757011757_WhatsApp-Image-2025-08-13-at-15.58.16.jpeg'),(4,'imagen4','1757011765_WhatsApp-Image-2024-10-04-at-12.11.50-645x361.jpeg'),(5,'imagen5','1757011774_WhatsApp-Image-2024-10-11-at-17.02.20-645x361.jpeg'),(6,'imagen6','1757011782_WhatsApp-Image-2025-02-14-at-10.54.12-645x362.jpeg'),(7,'imagen7','1757011791_Sin-titulo-2-645x403.png'),(8,'imagen8','1757011803_WhatsApp-Image-2025-05-07-at-14.48.09-645x362.jpeg'),(9,'imagen9','1757011814_WhatsApp-Image-2025-06-13-at-11.40.53-645x432.jpeg'),(10,'imagen10','1757011860_WhatsApp-Image-2025-06-13-at-11.59.21-645x362.jpeg'),(11,'imagen11','1757011878_WhatsApp-Image-2025-06-16-at-08.26.25-645x346.jpeg'),(12,'imagen12','1757011890_WhatsApp-Image-2025-07-24-at-13.01.56-645x362.jpeg'),(13,'imagen3','1757011903_WhatsApp-Image-2025-08-06-at-12.25.45-645x362.jpeg'),(14,'imagen14','1757011912_WhatsApp-Image-2025-08-12-at-11.26.01-645x362.jpeg');
/*!40000 ALTER TABLE `galeria` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `galeria` with 14 row(s)
--

--
-- Table structure for table `menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id_menu` int NOT NULL AUTO_INCREMENT,
  `nombre_menu` varchar(100) NOT NULL,
  `url_menu` varchar(300) NOT NULL,
  `icono_menu` varchar(100) NOT NULL,
  `submenu` varchar(100) NOT NULL,
  `orden_menu` tinyint NOT NULL,
  `area_protegida_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=275 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu` VALUES (4,'usuarios','/usuarios','fas fa-users','No',11,'Si'),(5,'Perfil','/perfil','far fa-user','No',13,'Si'),(6,'Respalda tus Datos','/respaldos','fas fa-database','No',5,'Si'),(7,'Salir','/salir','fas fa-sign-out-alt','No',14,'Si'),(10,'Mantenedor Menu','/menu','fas fa-bars','No',6,'Si'),(12,'Acceso Menus','/acceso_menus','fas fa-outdent','No',9,'Si'),(19,'Generador de Módulos','/modulos','fas fa-table','No',1,'Si'),(141,'Documentación','/Documentacion/index','fas fa-book','No',10,'Si'),(269,'Noticias','/noticias','far fa-newspaper','No',2,'Si'),(270,'Carga Masiva','/carga_masiva_noticias','fas fa-file-upload','No',4,'Si'),(271,'Web Menu','/web_menu','fas fa-bars','No',8,'Si'),(272,'Slider','/slider','fas fa-sliders-h','No',7,'Si'),(273,'Configuración','/Configuracion','fas fa-cogs','No',12,'Si'),(274,'Páginas','/paginas','far fa-file','No',3,'Si');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu` with 14 row(s)
--

--
-- Table structure for table `menu_web`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_web` (
  `id_menu_web` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `visibilidad` varchar(100) NOT NULL,
  PRIMARY KEY (`id_menu_web`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_web`
--

LOCK TABLES `menu_web` WRITE;
/*!40000 ALTER TABLE `menu_web` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `menu_web` VALUES (1,'Inicio','/web_hospital/','Visible'),(2,'Nuestro Hospital','#','Visible'),(3,'¿Cómo me atiendo?','#','Visible'),(4,'Información a los usuarios','#','Visible'),(5,'Intranet','http://10.5.131.63/intranet/','Visible');
/*!40000 ALTER TABLE `menu_web` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `menu_web` with 5 row(s)
--

--
-- Table structure for table `modulos`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `id_modulos` int NOT NULL AUTO_INCREMENT,
  `tabla` varchar(100) NOT NULL,
  `id_tabla` varchar(100) DEFAULT NULL,
  `crud_type` varchar(100) NOT NULL,
  `query` text,
  `controller_name` varchar(100) NOT NULL,
  `columns_table` text,
  `name_view` varchar(100) NOT NULL,
  `add_menu` varchar(100) NOT NULL,
  `template_fields` varchar(100) NOT NULL,
  `id_menu` int DEFAULT NULL,
  `active_filter` varchar(100) NOT NULL,
  `clone_row` varchar(100) NOT NULL,
  `active_popup` varchar(100) NOT NULL,
  `active_search` varchar(100) NOT NULL,
  `activate_deleteMultipleBtn` varchar(100) NOT NULL,
  `button_add` varchar(100) NOT NULL,
  `actions_buttons_grid` varchar(100) DEFAULT NULL,
  `modify_query` text,
  `activate_nested_table` varchar(100) NOT NULL,
  `buttons_actions` varchar(100) DEFAULT NULL,
  `logo_pdf` varchar(300) DEFAULT NULL,
  `marca_de_agua_pdf` varchar(300) DEFAULT NULL,
  `activate_pdf` varchar(100) NOT NULL,
  `refrescar_grilla` varchar(100) NOT NULL,
  `consulta_pdf` text,
  `id_campos_insertar` varchar(100) DEFAULT NULL,
  `encryption` varchar(100) DEFAULT NULL,
  `mostrar_campos_busqueda` varchar(300) NOT NULL,
  `mostrar_columnas_grilla` varchar(300) DEFAULT NULL,
  `mostrar_campos_formulario` varchar(300) DEFAULT NULL,
  `activar_recaptcha` varchar(100) NOT NULL,
  `sitekey_recaptcha` varchar(500) DEFAULT NULL,
  `sitesecret_repatcha` varchar(500) DEFAULT NULL,
  `mostrar_campos_filtro` varchar(300) DEFAULT NULL,
  `tipo_de_filtro` text,
  `function_filter_and_search` varchar(100) DEFAULT NULL,
  `activar_union_interna` varchar(100) NOT NULL,
  `mostrar_campos_formulario_editar` varchar(300) DEFAULT NULL,
  `posicion_botones_accion_grilla` varchar(100) NOT NULL,
  `campos_requeridos` varchar(100) NOT NULL,
  `mostrar_columna_acciones_grilla` varchar(100) NOT NULL,
  `mostrar_paginacion` varchar(100) NOT NULL,
  `activar_numeracion_columnas` varchar(100) NOT NULL,
  `activar_registros_por_pagina` varchar(100) NOT NULL,
  `cantidad_de_registros_por_pagina` varchar(100) NOT NULL,
  `activar_edicion_en_linea` varchar(100) NOT NULL,
  `nombre_modulo` varchar(100) DEFAULT NULL,
  `ordenar_grilla_por` varchar(500) DEFAULT NULL,
  `tipo_orden` varchar(100) DEFAULT NULL,
  `posicionarse_en_la_pagina` varchar(100) DEFAULT NULL,
  `nombre_columnas` text,
  `nuevo_nombre_columnas` text,
  `ocultar_id_tabla` varchar(100) NOT NULL,
  `nombre_campos` text,
  `nuevo_nombre_campos` text,
  `totalRecordsInfo` varchar(100) NOT NULL,
  `area_protegida_por_login` varchar(100) NOT NULL,
  `tabla_principal_union` varchar(500) DEFAULT NULL,
  `tabla_secundaria_union` varchar(500) DEFAULT NULL,
  `campos_relacion_union_tabla_principal` text,
  `campos_relacion_union_tabla_secundaria` text,
  `posicion_filtro` varchar(100) DEFAULT NULL,
  `file_callback` varchar(100) DEFAULT NULL,
  `type_callback` text,
  `type_fields` text NOT NULL,
  `text_no_data` varchar(100) DEFAULT NULL,
  `type_union` varchar(100) DEFAULT NULL,
  `send_email` varchar(100) NOT NULL,
  `activar_union_izquierda` varchar(100) NOT NULL,
  `tabla_principal_union_izquierda` varchar(500) DEFAULT NULL,
  `campos_relacion_union_tabla_principal_izquierda` varchar(500) DEFAULT NULL,
  `tabla_secundaria_union_izquierda` varchar(500) DEFAULT NULL,
  `campos_relacion_union_tabla_secundaria_izquierda` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id_modulos`)
) ENGINE=InnoDB AUTO_INCREMENT=302 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `modulos` with 0 row(s)
--

--
-- Table structure for table `noticias`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `noticias` (
  `id_noticias` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(300) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `enviar_imagen_a_slider` tinyint NOT NULL,
  `contenido` text NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `publicado_por` varchar(100) NOT NULL,
  PRIMARY KEY (`id_noticias`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `noticias`
--

LOCK TABLES `noticias` WRITE;
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `noticias` VALUES (1,'hospital-de-melipilla-es-nominado-en-tres-categorias-del-ranking-nacional-de-practicas-de-impacto-en-economia-de-salud','2025-08-21','1756991869_WhatsApp-Image-2025-08-14-at-10.10.17-645x362.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El Hospital San José de Melipilla ha sido nominado oficialmente en tres categorías del Ranking Nacional de Prácticas de Impacto en Economía de Salud e Investigación de Resultados, certamen que es organizado por la Sociedad de Economía de la Salud e Investigación de Resultados (ISPOR Chile) y la Universidad Andrés Bello.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La iniciativa, que este año 2025 realizará su segunda versión, reconoce a las organizaciones de salud, tanto públicas como privadas, que trabajan día a día en la implementación de estrategias innovadoras en gestión sanitaria, evidenciando un impacto positivo en el bienestar de los usuarios de salud.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Es así que, por segundo año consecutivo, el Hospital de Melipilla fue nominado en tres categorías:&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Grupos Relacionados por Diagnóstico: con la estrategia de&amp;nbsp;&lt;span style=\"font-weight: 700;\"&gt;&lt;em&gt;costeo vía GRD de intervenciones quirúrgicas de Prótesis de Rodilla a través de cirugía mayor ambulatoria.&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;a href=\"/web_hospital/app/libs/artify/uploads/1757011757_WhatsApp-Image-2025-08-13-at-15.58.16.jpeg\" data-fancybox=\"gallery\" data-caption=\"Foto\"&gt;&lt;img src=\"/web_hospital/app/libs/artify/uploads/1757011757_WhatsApp-Image-2025-08-13-at-15.58.16.jpeg\" style=\"width: 1533px;\" width=\"150\"&gt;&lt;/a&gt;&lt;span style=\"font-weight: 700;\"&gt;&lt;em&gt;&lt;br&gt;&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Modelos de Atención Vanguardistas:&amp;nbsp;&lt;span style=\"font-weight: 700;\"&gt;&lt;em&gt;en colaboración con la Empresa Allm Inc. y la incorporación de nuevas tecnologías&lt;/em&gt;&lt;/span&gt;&amp;nbsp;y la implementación del pilotaje en las áreas de reumatología, diabetología y proceso prequirúrgico, que nos permitirá potenciar el rol de profesionales no médicos, descentralizando la atención de los especialistas y favoreciendo la priorización de la atención de salud de los pacientes.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;a href=\"/web_hospital/app/libs/artify/uploads/1757011747_WhatsApp-Image-2025-08-07-at-16.03.25.jpeg\" data-fancybox=\"gallery\" data-caption=\"Foto\"&gt;&lt;img src=\"/web_hospital/app/libs/artify/uploads/1757011747_WhatsApp-Image-2025-08-07-at-16.03.25.jpeg\" style=\"width: 1533px;\" width=\"150\"&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Distinciones especiales:&amp;nbsp;&lt;span style=\"font-weight: 700;\"&gt;&lt;em&gt;con estrategias de disminución de tiempos de espera en la especialidad de traumatología&lt;/em&gt;&lt;/span&gt;, en colaboración con el Instituto Traumatológico en alianza con Departamento de Hospital Digital MINSAL, Hospital de Melipilla y Hospital de Curacaví.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;a href=\"/web_hospital/app/libs/artify/uploads/1757011659_WhatsApp-Image-2025-08-14-at-10.11.00-645x362.jpeg\" data-fancybox=\"gallery\" data-caption=\"Foto\"&gt;&lt;img src=\"/web_hospital/app/libs/artify/uploads/1757011659_WhatsApp-Image-2025-08-14-at-10.11.00-645x362.jpeg\" style=\"width: 100%;\" width=\"150\"&gt;&lt;/a&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La noticia de esta nueva nominación, fue bien valorada por el director del Hospital de Melipilla, Dr. Óscar Vargas Duranti, quien señaló que&amp;nbsp;&lt;em&gt;“es una noticia que nos enorgullece, porque una institución externa nos ha escogido dentro de un sinnúmero de instituciones públicas y privadas, donde postulamos proyectos de innovación y mejora para la atención de nuestros usuarios y por segundo año consecutivo hemos sido seleccionados. Esto nos coloca dentro de los hospitales pioneros en Chile en términos de innovación”.&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Destacamos el trabajo de los equipos locales que participaron en la implementación de las iniciativas seleccionadas: Traumatología, GRD, Transformación Digital, Telemedicina, Subdirección Médica de Atención Ambulatoria, Subdirección de Análisis de la Información para la Gestión, Proceso Quirúrgico y Gestión de la Demanda, entre otras.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La ceremonia de premiación de se realizará el próximo 12 de noviembre y nuestro hospital participará por segundo año consecutivo, consolidándose como un establecimiento con sello innovador y comprometido con la mejora continua en beneficio de la comunidad usuaria.&lt;/p&gt;','Noticias','Daniel'),(2,'hospital-de-melipilla-se-suma-a-la-primera-evaluacion-de-atencion-de-salud-humanizada-de-la-red-occidente','2025-08-14','1756991997_WhatsApp-Image-2025-08-12-at-11.26.01-645x362.jpeg',2,'&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;A contar del próximo viernes 15 de agosto, nuestro equipo de Humanización encabezará la aplicación del&amp;nbsp;&lt;/span&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;Primer Cuestionario de Percepción de Atención Humanizada&lt;/span&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;, estrategia que se estará desarrollando de manera simultánea en siete establecimientos de salud de la Red Occidente.&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;La evaluación contempla la medición de diez ámbitos relacionados con el entorno, dignidad de la atención, comunicación y cuidados centrados en la persona y familia, además de la valoración de cinco atributos de la humanización en salud. Cuestionario que nos servirá como diagnóstico inicial para la implementación de diversas estrategias de atención humanizada, como parte de los planes locales de cada establecimiento.&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;La encuesta, que es de carácter voluntaria, se aplicará al momento del egreso hospitalario en aquellos pacientes con indicación de alta en los distintos servicios clínicos, cuestionario que podrá ser respondido por usuarios mayores de 18 años, y en caso de pacientes menores de edad por sus tutores legales.&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"a_GcMg font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;El equipo de encuestadores está compuesto por trabajadoras sociales de los servicios clínicos y orientadoras de OIRS, con el apoyo de los integrantes del Comité de Humanización local.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;El cuestionario se estará aplicando hasta el 15 de septiembre de 2025.&lt;/p&gt;','Noticias','Daniel'),(3,'hospital-de-melipilla-participa-en-primer-telecomite-oncologico-junto-a-hospital-digital-estrategia-que-busca-disminuir-los-tiempos-de-espera','2025-08-12','1756992061_WhatsApp-Image-2025-08-06-at-12.25.45-645x362.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Con el objetivo de disminuir los tiempos de espera y brindar una atención, tratamiento y derivación más oportuna a los usuarios, durante este mes de agosto se realizó el primer telecomité oncológico junto al equipo de Hospital Digital.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Esta instancia permite resolver las necesidades de salud de aquellos pacientes que presentan alguna patología oncológica, a través de la evaluación individual de cada usuario, opciones de tratamiento y elaboración de planes personalizados para cada necesidad, gracias al apoyo del equipo de Hospital Digital, quienes ponen a disposición a su equipo multidisciplinario.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Por otra parte, &amp;nbsp;los profesionales del hospital se encargan de la presentación de los casos que deben ser evaluados, fortaleciendo una estrategia que incorpora la salud digital como herramienta para la disminución de los tiempos de espera otorgando respuesta a las necesidades de salud de los pacientes.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Para Mackarena Zapata, subdirectora de análisis de la información del Hospital de Melipilla y coordinadora de las estrategias de salud digital, esta vinculación permite avanzar en materia de gestión de listas de espera ya que,&amp;nbsp;&lt;em&gt;“gracias al trabajo con hospital digital, logramos atender a nuestros pacientes, a través de su comité oncológico. Este es un importante avance porque nosotros como hospital no contamos con este comité o con los subespecialistas, por lo cual debemos buscar la prestación en otras instituciones de la red y esto nos abre una puerta para disminuir los tiempos de espera, dar una solución rápida a los usuarios y tener contacto con profesionales que nos estan dando esta prestación.”&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;El equipo local, que participó en esta iniciativa, está compuesto por el Dr. Diego Peña, la gestora oncológica del Hospital de Melipilla, Valeria Marambio; la encargada de la unidad de Telemedicina, Elena Garrido y la subdirectora de Análisis de la Información, Mackarena Zapata.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Esta primera sesión del telecomité oncológico fue bien valorada a nivel hospitalario, ya que significa un importante avance para la salud de los usuarios de la Provincia de Melipilla y una mejora sustantiva en la oportunidad de la atención.&lt;/p&gt;','Noticias','Daniel'),(4,'director-del-hospital-de-melipilla-encabeza-ceremonia-de-cuenta-publica-participativa-2024-destacando-principales-avances-e-hitos-de-la-gestion-hospitalaria','2025-08-25','1756992203_WhatsApp-Image-2025-07-24-at-13.01.56-645x362.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Ante más de 160 asistentes, representantes de la comunidad hospitalaria, realizamos la rendición de nuestra Cuenta Pública de Gestión del año 2024.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La actividad, que fue encabezada por nuestro director, Dr. Óscar Vargas Duranti, contempló la presentación de los principales avances del establecimiento en el área asistencial, reducción de tiempos de espera, presupuesto y satisfacción usuaria, entre otros.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Entre los principales hitos de la gestión 2024 destacan:&lt;/p&gt;&lt;ul style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; border: 0px none; padding: 0.5em 0px 0.5em 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;La implementación de la UTI Pediátrica, que durante el año pasado permitió la disminución en un 33% de los traslados pediátricos a Santiago.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;La disminución de tiempos de espera tanto en resolución quirúrgica, consulta nueva de especialidad y odontología, posicionando al hospital muy por debajo de la mediana nacional de espera.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;El aumento de las intervenciones quirúrgicas durante el año 2024, que superaron las 12 mil cirugías al año. Además, registrando un incremento de un 58,7% de las cirugías mayores ambulatorias.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;Gracias a la telemedicina avanzamos dos años en la lista de espera de consulta nueva de traumatología, para pacientes de toda la Provincia de Melipilla que estaban en espera en el Instituto Traumatológico.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;Iniciamos el piloto “acto único prequirúrgico” en las especialidades de cirugía adulto y cirugía plástica, logrando un éxito del 65% en la resolución de pacientes derivados desde APS.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;Redujimos el índice de ausentismo de nuestros funcionarios, alcanzando durante el año 2024 un índice de 18,1 días, muy por debajo del promedio nacional.&lt;/li&gt;&lt;li style=\"border: 0px none; margin: 0px 0px 0.5em; padding: 0px; text-align: justify;\"&gt;El año 2024 logramos, por tercer año consecutivo, el número 1 en el ranking de hospitales autogestionados en red, tras una evaluación que contempló a 74 establecimientos de todo el país, logrando un cumplimiento del 97,8%&lt;/li&gt;&lt;/ul&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Nuestro director, Dr. Óscar Vargas Duranti, valoró el éxito de la gestión del año 2024, indicando que “las cifras que presentamos hoy en nuestra cuenta pública son fruto del trabajo, compromiso y esfuerzo de todos los equipos del Hospital de Melipilla, de la colaboración permanente con nuestras asociaciones gremiales y el apoyo permanente de la comunidad organizada. Estos avances nos permiten brindar una atención más oportuna y de calidad a nuestros usuarios de toda la provincia”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La ceremonia finalizó con los avances del nuevo hospital, cuya construcción ya alcanza el 100%&amp;nbsp; y el anuncio del ingreso de los primeros documentos oficiales a la Seremi de Salud para la tramitación de la autorización sanitaria del futuro recinto asistencial.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El cambio está previsto para el último cuatrimestre de este año 2025, por lo que esta cuenta pública es la última que se realizaría en el actual Hospital de Melipilla.&lt;/p&gt;','Noticias','Daniel'),(5,'Mejora-en-la-Gestión-de-Box-de-Atención-Médica-en-tiempo-real-conoce-el-desafío-presentado-por-el-Hospital-de-Melipilla-en-encuentro-de-innovación-ECO-SD','2025-06-16','1756992263_WhatsApp-Image-2025-06-16-at-08.26.25-645x346.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Fomentar la colaboración, el intercambio de experiencias y la formación de relaciones estratégicas en el ámbito de la innovación en salud fueron los objetivos del Encuentro ECO-SD que se realizó recientemente en la ciudad de Santiago.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El evento es organizado por el Centro Nacional en Sistemas de Información en Salud (CENS), el ecosistema ECO-SD, la Universidad de Chile y Deep Ecosystems, y reunió a diversos actores del ecosistema de salud digital, incluyendo instituciones de salud tanto públicas como privadas, empresas, startups y centros de investigación, entre otros.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El Hospital de Melipilla fue seleccionado para participar en esta importante instancia, presentando, en modalidad Pitch, el desafío institucional sobre la&amp;nbsp;&lt;em&gt;“Mejora en la Gestión de Box de Atención Médica en tiempo real”.&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Este desafío, que fue trabajado por nuestro equipo de innovación, busca mejorar el sistema de asignación de box de atención del área ambulatoria, a través de un sistema que optimice la asignación de los boxes, registro de la disponibilidad diaria en tiempo real y favorecer la continuidad de la atención de nuestros usuarios.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span style=\"font-weight: 700;\"&gt;&lt;em&gt;Este desafío aborda un problema real existente en nuestro Centro de Diagnóstico y Tratamiento, ya que la asignación de box de atención ambulatoria se realiza de forma manual mediante planillas Excel, sin un sistema centralizado que permita el seguimiento y actualización en tiempo real. Un problema que ocurre diariamente y que afecta la continuidad de la atención, retrasa los controles, y compromete la experiencia usuaria, especialmente en pacientes que viajan desde localidades distantes.&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;&lt;span style=\"font-weight: 700;\"&gt;Equipo local y participación en espacios de innovación&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Como Hospital de Melipilla, valoramos enormemente la participación en estas instancias, ya que nos permite avanzar en la gestión de innovación y el empoderamiento del trabajo institucional, promoviendo una cultura de innovación.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Así lo señaló Javiera Klein, encargada de la unidad de Proyectos e Innovación de nuestro hospital, quién valoró esta oportunidad ya que&amp;nbsp;&lt;em&gt;“durante la jornada creo que marcamos la diferencia, nuestro equipo es muy activo, muy motivado y siento que esta cultura de innovación se ha ido institucionalizando cada vez más y se ha logrado visibilizar que nuestro hospital está trabajando en estos temas, con una diversidad de actores, desde distintas áreas y cada vez sumamos a más personas (…) como encargada de innovación estoy feliz y queremos seguir avanzando y potenciar a futuro esta línea a nivel institucional”.&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Por su parte, Felipe Fuentes, encargado de Farmacia Ambulatoria y parte del equipo de innovación señaló que&amp;nbsp;&lt;em&gt;«desde ya un tiempo, el Hospital de Melipilla con su equipo de innovación, desde el programa Juégatela&amp;nbsp;por la Innovación, ha participado de forma permanente en estas instancias multisectoriales orientadas a la innovación y la mejora continua, y uno se da cuenta que el hospital ha logrado resolver varios dolores que otros centros aún enfrentan. Se nota la experiencia y la motivación del&amp;nbsp; equipo de innovación, donde en esta oportunidad en el desafío eco-sd, presentó su problemática de forma precisa y planteando soluciones realistas y colaborativas.»&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Reconocemos el trabajo de nuestro equipo de innovación que se sumó a esta importante actividad, la que sigue avanzando, ahora a la espera de las postulaciones por parte de las empresas y startups que quieran ser parte de la solución a nuestra problemática planteada.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;De esta forma, gracias a la colaboración público – privada, nuestro hospital puede avanzar hacia estrategias de mejoramiento continuo, en beneficio de los usuarios de salud de la Provincia de Melipilla.&amp;nbsp;&lt;/p&gt;','Noticias','Daniel'),(6,'hospital-de-melipilla-organiza-II-jornadas-de-enfermeria-en-el-año-del-cambio','2025-06-13','1756992321_WhatsApp-Image-2025-06-13-at-11.59.21-645x362.jpeg',1,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Relevar el rol de la enfermería y conocer su importancia en este año trascendental para nuestro establecimiento, fue el objetivo de las&amp;nbsp;&lt;em&gt;&lt;span style=\"font-weight: 700;\"&gt;II Jornadas de Enfermería: en el año del cambio&lt;/span&gt;&lt;/em&gt;, que se desarrollaron el pasado martes 10 de junio.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La actividad fue organizada por el equipo de Buenas Prácticas Clínicas BPSO y contó con la participación de importantes expositores relacionados al ámbito de salud tanto público como privado.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Este 2025, el Hospital de Melipilla se prepara para el cambio al nuevo recinto asistencial y las presentaciones de esta jornada buscaron incentivar el intercambio de experiencias y factores de éxito relacionados al cambio, desde la gestión de los cuidados. Además, de temáticas propias de la enfermería, buenas prácticas clínicas, entre otras.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Agradecemos a los asistentes, expositores y comité organizador por esta actividad.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;&lt;em&gt;&lt;span style=\"font-weight: 700;\"&gt;Galería Fotográfica de Expositores:&lt;/span&gt;&lt;/em&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;&lt;em&gt;&lt;span style=\"font-weight: 700;\"&gt;Revisa las impresiones de nuestra Subdirectora de Enfermería, Evelyn Manzor:&lt;/span&gt;&lt;/em&gt;&lt;/p&gt;','Noticias','Daniel'),(7,'comite-paritario-recibe-certificacion-categoria-oro-y-galardon-especial-por-compromiso-e-innovacion','2025-06-13','1756995238_WhatsApp-Image-2025-06-13-at-11.40.53-645x432.jpeg',1,'&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;El Comité Paritario de Higiene y Seguridad del Hospital de Melipilla recibió la certificación Categoría Oro en reconocimiento a su trabajo realizado durante la gestión del año 2024.&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;La certificación, que es entregada por parte de la Mutual de Seguridad, acredita el cumplimiento en un 100% de los requisitos de dicha categoría y que son monitoreados de manera permanente por el organismo.&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;Con este logro, el Comité Paritario de nuestro hospital se posiciona por primera vez la categoría más alta junto a otros los hospitales de la red occidente.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El reconocimiento fue recibido por nuestro director, Dr. Óscar Vargas Duranti, en compañía de la Presidenta del Comité Paritario del Hospital de Melipilla, Carol Durán; nuestro equipo de prevención de riesgos, representantes del comité y el Subdirector de Gestión de las Personas, Teddy Pérez.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Este sello respalda el trabajo de nuestro comité en temas relacionados a la prevención de accidentes laborales y enfermedades profesionales de los funcionarios, promoviendo espacios de trabajo más seguros y libres de accidentabilidad.&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span style=\"font-weight: 700;\"&gt;Además, nuestro comité recibió un galardón especial que destaca la responsabilidad, ética, innovación y compromiso con la cultura de seguridad a nivel institucional, una distinción que viene a reconocer el trabajo del equipo local.&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;En este sentido, el director del Hospital de Melipilla, Dr. Óscar Vargas Duranti señaló que&amp;nbsp;&lt;em&gt;«quiero felicitar al equipo que conforma el Comité Paritario por este importante avance en materia de seguridad laboral. Su trabajo y compromiso van en directo beneficio de todas las funcionarias y funcionarios de este hospital».&lt;/em&gt;&lt;/span&gt;&lt;/p&gt;&lt;p class=\"cvGsUA direction-ltr align-justify para-style-body\" style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span class=\"OYPEnA font-feature-liga-off font-feature-clig-off font-feature-calt-off text-decoration-none text-strikethrough-none\"&gt;Felicitamos a los integrantes del comité local y agradecemos su compromiso con las estrategias preventivas a nivel institucional.&lt;/span&gt;&lt;/p&gt;','Noticias','Daniel'),(8,'hospital-de-melipilla-participa-en-importante-encuentro-nacional-de-sostenibilidad-financiera-y-gestion-hospitalaria','2025-05-08','1756995293_WhatsApp-Image-2025-05-07-at-14.48.09-645x362.jpeg',1,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;“Sostenibilidad financiera y gestión de presupuesto: ¿cómo afecta a los pacientes?” fue el nombre del encuentro organizado por la Facultad de Economía y Negocios y la Asociación Gremial de Dispositivos Médicos de Chile ADIMECH y que reunió a importantes figuras del ámbito de salud tanto público como privado del país.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;En la oportunidad, nuestro director, Dr. Óscar Vargas Duranti, fue invitado a participar como parte de una mesa de discusión sobre gestión financiera, productividad y eficiencia; una importante oportunidad para compartir la experiencia y buenas prácticas implementadas desde el Hospital de Melipilla en este ámbito.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;En este sentido, nuestro director valoró la invitación indicando que “fue muy grato exponer nuestros indicadores y resultados, sentí que la audiencia estaba muy interesada en nuestros aportes y fue una forma de demostrar que los servicios públicos lo podemos hacer bien cuando logramos identificar liderazgos en los equipos”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El panel, también contó con importantes figuras del ámbito de salud, tales como: el ex ministro de salud, Enrique Paris; la presidenta del Colegio Médico de Chile, Dra. Ana maría Arriagada y el director del Hospital Clínico Guillermo Grant Benavente de Concepción, Claudio Baeza.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El encuentro tuvo por objetivo discutir sobre la relevancia de la gestión financiera en los establecimientos de salud públicos del país y el impacto de las distintas estrategias de sostenibilidad para garantizar la atención de los pacientes.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;En este sentido, el director compartió con los asistentes, algunos de los logros alcanzados por el establecimiento, tales como: el incremento del porcentaje de ocupación de pabellones, que durante el año 2024 superó el 96%.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Asimismo, el fortalecimiento de la Cirugía Mayor Ambulatoria, que corresponden al 22% del total de las intervenciones quirúrgicas realizadas en el Hospital de Melipilla, además de la incorporación&amp;nbsp;de nuevas intervenciones que durante el año pasado lograron ambulatorizarse para una mayor productividad y eficiencia.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Para el director, estas positivas cifras es fruto del esfuerzo y trabajo permanente de los equipos de salud, ya que “nuestros trabajadores han logrado hoy día posicionar a nuestro hospital dentro de la red pública en Chile”, finalizó.&lt;/p&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;','Noticias','Daniel'),(9,'pacientes-del-hospital-san-jose-de-melipilla-reciben-las-primeras-atenciones-de-la-nueva-estrategia-de-neurologia-de-salud-digital','2025-03-31','1756995348_Sin-titulo-2-645x403.png',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La señora Rosenda Acevedo, fue una de las cinco pacientes atendidas este jueves 27 de marzo, vía telemedicina sincrónica, por el Dr. Rodrigo Villalobos, que desde Talcahuano y con la asistencia de María Elena Cortés y Elena Garrido, Tens e Ingeniera Informática respectivamente del Hospital, dando inicio a esta nueva estrategia.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;“Me pareció muy buena la atención, el Dr. Villalobos habla muy claro, uno entiende todo lo que él dice, hace muchas más preguntas, más ejercicios y me parece muy bien. Mi mano temblaba mucho, sobre todo mi mano izquierda, no pronunciaba bien mis palabras, no dormía bien y entonces me ha cambiado mucho la vida tratarme con el neurólogo” indicó la señora Rosenda, tras su segundo control con el especialista, esta vez a través de la Unidad Hospital Digital y siempre con la asistencia de funcionarios del Hospital.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La Ingeniera Informática Elena Garrido, dice que este trabajo coordinado, le permitirá al Hospital San José de Melipilla ampliar su oferta sobre todo para pacientes que requieren controles más periódicos de neurología, como es el caso de la señora Rosenda. “Tenemos neurólogos, pero no tantos, entonces la lista de espera era muy larga entonces por eso los controles eran muy escasos, los pacientes tenían que esperar mucho tiempo, entonces ahora con esta opción y con el Dr. Villalobos, se han podido atender más personas”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Tras las atenciones de estos pacientes de Melipilla, el Dr. Rodrigo Villalobos, especialista y director de la estrategia de neurología de Salud Digital, señaló desde Talcahuano que “es sumamente importante poder tomar recursos informáticos y tecnológicos para convertirlos en activos que nos permitan poder disminuir la brecha de falta de especialistas en neurología y poder disminuir las listas de espera” destacando que ya se trabaja para &amp;nbsp;expandir esta estrategia y “agregar&amp;nbsp; atenciones asincrónicas, lo que también nos va a permitir extender aún más la disponibilidad de especialistas para los pacientes que están en lista de espera en otros lugares del país”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Finalmente, Eva Guzmán jefa de la Unidad Hospital Digital, destaca el trabajo coordinado con el Hospital de Melipilla y el Servicio de Salud Metropolitano Occidente, &amp;nbsp;además de un vínculo previo entre el doctor y el Hospital para iniciar esta nueva estrategia en este recinto asistencial.&amp;nbsp; “Neurología tiene una lista de espera importante en consulta nueva de especialidad en todo el país. Gracias a la telemedicina aportaremos con estas prestaciones, pero también lo haremos con controles de seguimiento a pacientes como la señora Rosenda de Melipilla, para que al igual que ella y luego de su primera consulta, no tengan que esperar tanto tiempo para poder ser atendidos nuevamente por el neurólogo, asegurándonos de ir evaluando progresos o nuevas necesidades de salud de estos pacientes” precisó la profesional de Salud Digital.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;Fuente:&amp;nbsp;&lt;a href=\"https://portalsaluddigital.minsal.cl/pacientes-del-hospital-san-jose-de-melipilla-reciben-las-primeras-atenciones-de-la-nueva-estrategia-de-neurologia-de-salud-digital/\" style=\"color: rgb(120, 61, 152);\"&gt;Portal Salud Digital Minsal&lt;/a&gt;&lt;/p&gt;','Noticias','Daniel'),(10,'hospital-de-melipilla-inaugura-nueva-urgencia-pediatrica','2025-02-14','1756995416_WhatsApp-Image-2025-02-14-at-10.54.12-645x362.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Desde este viernes 14 de febrero el Hospital de Melipilla cuenta con una nueva y remodelada urgencia pediátrica, la que incorpora 10 camillas para la atención de niños y niñas de toda la Provincia de Melipilla.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El proyecto busca brindar una atención más cómoda, digna y oportuna a los usuarios, a través de un espacio exclusivo para pacientes pediátricos, el que cuenta también con una sala de espera más acogedora para sus acompañantes.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La inauguración de este nuevo recinto estuvo encabezada por la directora (s) del recinto asistencial, Dra. Luz Quiroga Irreño, en compañía del equipo de urgencias, representantes del Consejo Consultivo de Usuarios y dirigentes gremiales del establecimiento.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La Dra. Quiroga valoró este esfuerzo ya que “hoy contamos con esta área mucho más bonita, adaptada, con una sala de espera didáctica para los niños, para que su estadía en urgencia durante el tiempo que estén sea más amena”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Por su parte, María Cantillana, presidenta del Consejo Consultivo de usuarios se mostró muy contenta con esta inauguración, señalando que “la nueva unidad pediátrica de urgencias es espectacular. Es muy bonita y tiene todo lo que necesitamos para que los pediatras puedan atender y da un gusto traer a los niños. Estamos felices del trabajo que ha hecho el hospital, la dirección y todo el equipo de urgencias que está acá presente”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif;\"&gt;&lt;span style=\"font-weight: 700;\"&gt;Impacto para la atención de adultos&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Este nuevo espacio no solo significa un avance para el proceso de atención de pacientes pediátricos, sino también trae consigo un impacto en los flujos de atención de pacientes adultos, con la reconversión de los espacios y la incorporación de seis nuevas camillas.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;De esta forma la urgencia de adultos contará actualmente con 27 camillas de atención distribuidas en los distintos box de atención.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;“La atención de pacientes adultos ha venido en aumento (…) por lo que era necesario hacer una individualización de las áreas de atención para que fuera un poco más rápido el flujo, para que fuera más eficiente y hubiese más disponibilidad de camillas. La verdad es que mucho de los usuarios, la mayoría requiere atención en camilla, así que va a ser mucho más cómodo y más digno para la atención de los pacientes”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La nueva urgencia pediátrica se encuentra ubicada dentro del servicio de urgencia, en un sector diferenciado de la atención de adulto, donde actualmente se encuentra la sala de espera infantil. El ingreso de pacientes se realiza de la manera habitual, donde se mantiene la atención de admisión en ventanilla y categorización en selector de demanda, para luego ser derivados a sala de espera pediátrica y posteriormente el ingreso a los nuevos box de atención.&lt;/p&gt;','Noticias','Daniel'),(11,'salud-digital-piloto-de-telemedicina-permitira-acercar-la-atencion-de-traumatologia-a-pacientes-de-zonas-mas-alejadas-de-la-provincia-de-melipilla','2024-10-17','1756995466_WhatsApp-Image-2024-10-11-at-17.02.20-645x361.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;El pasado viernes se marcó un hito en materia de salud digital en la Provincia de Melipilla. Gracias a una coordinación en red, se logró la atención de los primeros tres pacientes de la zona que se encontraban a la espera de sus controles de consulta nueva de especialidad en el Instituto Traumatológico.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Este piloto permite otorgar atenciones traumatológicas de manera más oportuna, permitiéndole a las personas beneficiarias ahorrar tiempo y dinero en traslados a Santiago, disminuyendo así los tiempos de espera de la especialidad y acercando la atención de especialistas a las zonas más rurales de la red occidente.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Este es el caso de la Sra. María Castro, proveniente desde Alhué y Don Juan Valdenegro desde Litueche, ambos pacientes que fueron beneficiados con esta modalidad de atención.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Elba Toro, hija de la paciente, manifestó que “me parece fantástico, imagínese que para mi mamá es un alivio porque un viaje desde Alhué a Santiago son tres horas, hasta tres horas y media. Así que para nosotros es una muy buena noticia tener esta atención más cerca de la casa”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Por su parte Mackarena Zapata, subdirectora de análisis de la información y referente de salud digital de nuestro hospital, indicó que este es un importante avance en esta materia ya que “esta coordinación con el Instituto Traumatológico y Salud Digital nos permite colaborar como establecimiento, acercando la atención de especialistas a los usuarios gracias a la incorporación de la tecnología que es una herramienta fundamental para brindar más salud a nuestros usuarios de zonas tan alejadas como Alhué”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;En tanto, Eva Guzmán, jefa de la unidad de Hospital Digital del Ministerio de Salud, señaló que “estas estrategias de salud digital van en directo beneficio de las personas, mejorando el acceso, la oportunidad, la calidad y la continuidad en todos los procesos que hoy día están para las listas de espera en nuestro país”.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Estos pacientes fueron los primeros beneficiados con este piloto que busca incorporar a nuevos usuarios que, gracias a la tecnología, podrán acceder a teleconsulta de traumatología de manera más cercana y oportuna.&lt;/p&gt;','Noticias','Daniel'),(12,'dia-del-hospital-con-emotiva-ceremonia-reconocemos-a-nuestros-funcionarios-que-cumplen-30-y-40-anos-al-servicio-de-la-salud-publica-de-melipilla','2024-10-04','1756995534_WhatsApp-Image-2024-10-04-at-12.11.50-645x361.jpeg',2,'&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Con la presencia de autoridades de salud y la comunidad hospitalaria, la mañana de este viernes se realizó la tradicional ceremonia del “Día del Hospital”, actividad que año a año reúne a las funcionarias y funcionarios del establecimiento para celebrar la conmemoración de la creación del primer hospital de Chile.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;La ceremonia, estuvo encabezada por el director del hospital, Dr. Óscar Vargas Duranti, y contó con la participación de la Dra. Daniella Greibe, directora del Servicio de Salud Metropolitano Occidente, personal del establecimiento, representantes de asociaciones gremiales, organizaciones vinculadas al hospital, entre otros.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;En la oportunidad el director del recinto, Dr. Óscar Vargas, hizo especial hincapié en la importancia de esta fecha para los funcionarios hospitalarios, agradeciendo el esfuerzo y compromiso que ha permitido importantes logros para el establecimiento y avanzar hacia el anhelado cambio al nuevo hospital.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Por su parte, la Dra. Daniella Greibe, calificó como “un orgullo” que el Hospital de Melipilla sea parte de la red de Salud Occidente y que es un gran honor para ella liderar, junto al director del hospital, el gran desafío que significa la entrada en operaciones del futuro recinto asistencial.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;&lt;span style=\"font-weight: 700;\"&gt;Reconocimiento por años de servicio&lt;/span&gt;&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Durante la ceremonia, se realizó el reconocimiento por años de servicio a aquellos funcionarios y funcionarias que este 2024 cumplieron 30 y 40 años trabajando en el Hospital de Melipilla.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Los galardonados estuvieron acompañados de sus familiares, compañeros de trabajo, gremios y equipos, quienes celebraron con ellos este importante hito en sus carreras funcionarias.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;Los funcionarios reconocidos este año fueron: Juan Carlos León Muñoz, Soledad Martínez Carreño, Nancy Águila Ulloa, María Cortés Rojas, Claudio Sanhueza Muñoz, Rossana Yañez Ercoli y Olga Mandiche Ruiz.&lt;/p&gt;&lt;p style=\"margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; border: 0px none; padding: 0px; line-height: 1.5em; color: rgb(74, 71, 75); font-family: Lato, sans-serif; text-align: justify;\"&gt;De esta forma, el Hospital San José de Melipilla cierra un nuevo año de celebraciones en el marco del Día del Hospital, sin duda una fecha significativa para la comunidad hospitalaria y donde se da valor a los 183 años al servicio de la salud pública de la Provincia de Melipilla.&lt;/p&gt;','Noticias','Daniel');
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `noticias` with 12 row(s)
--

--
-- Table structure for table `pagina`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina` (
  `id_pagina` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `contenido` text NOT NULL,
  `categoria` varchar(100) NOT NULL,
  `publicado_por` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pagina`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagina`
--

LOCK TABLES `pagina` WRITE;
/*!40000 ALTER TABLE `pagina` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `pagina` VALUES (1,'quienes-somos','2025-09-05','1759421883_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(2,'Mision-Vision-y-valores-institucionales','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(3,'Autoridades','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(4,'Organigrama','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(5,'Reglamento-Interno','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(6,'Hospitalizacion','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(7,'Atencion-Ambulatoria','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(8,'Especialidades-Medicas','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(9,'Especialidades-Odontológicas','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(10,'Urgencias','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(11,'Laboratorio-Clinico','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(12,'Imagenologia','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(13,'UTM','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(14,'Medicina-Fisica-y-Rehabilitacion','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(15,'Nutricion-y-SEDILE','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(16,'Farmacia-Ambulatoria','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(17,'OIRS','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(18,'Sistema-de-Visitas','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(19,'Hospital-Amigo','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(20,'GES-y-Ley-Ricarte-Soto','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(21,'Agendamiento','2025-09-05','1759421890_images.png','&lt;p&gt;&lt;strong style=\"margin: 0px; padding: 0px; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;Lorem Ipsum&lt;/strong&gt;&lt;span style=\"color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\"&gt;&amp;nbsp;es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.&lt;/span&gt;&lt;/p&gt;','Pagina','Daniel'),(22,'Plan-de-Humanizacion','2025-10-02','1759424664_images.png','&lt;p&gt;asdasdasd&lt;/p&gt;','Pagina','Daniel'),(23,'Ley-Mila','2025-10-02','1759424799_images.png','&lt;p&gt;asasdasd&lt;/p&gt;','Pagina','Daniel'),(24,'Ley-Dominga','2025-10-02','1759424799_images.png','&lt;p&gt;asasdasd&lt;/p&gt;','Pagina','Daniel'),(25,'Chile-Crece-Contigo','2025-10-02','1759424799_images.png','&lt;p&gt;asasdasd&lt;/p&gt;','Pagina','Daniel'),(26,'Hospital-Amigo','2025-10-02','1759424799_images.png','&lt;p&gt;asasdasd&lt;/p&gt;','Pagina','Daniel'),(27,'Escuela-Hospitalaria','2025-10-02','1759424799_images.png','&lt;p&gt;asasdasd&lt;/p&gt;','Pagina','Daniel');
/*!40000 ALTER TABLE `pagina` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `pagina` with 27 row(s)
--

--
-- Table structure for table `personas`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `id_personas` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `adjunto` varchar(300) NOT NULL,
  PRIMARY KEY (`id_personas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `personas` with 0 row(s)
--

--
-- Table structure for table `redes_sociales`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `redes_sociales` (
  `id_redes_sociales` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) NOT NULL,
  `icono` varchar(100) NOT NULL,
  `url` varchar(300) NOT NULL,
  PRIMARY KEY (`id_redes_sociales`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `redes_sociales`
--

LOCK TABLES `redes_sociales` WRITE;
/*!40000 ALTER TABLE `redes_sociales` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `redes_sociales` VALUES (1,'youtube','@hosp_melipilla','fa-brands fa-youtube','https://www.youtube.com/@hosp_melipilla'),(2,'twitter','@hosp_melipilla','fa-brands fa-x-twitter','https://x.com/hosp_melipilla'),(3,'Instagram','@hospitaldemelipilla','fa fa-instagram','https://www.instagram.com/hospitaldemelipilla/'),(4,'Facebook','@hospitaldemelipilla','fa fa-facebook','https://www.facebook.com/hospitaldemelipilla/');
/*!40000 ALTER TABLE `redes_sociales` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `redes_sociales` with 4 row(s)
--

--
-- Table structure for table `renombrar_campos_grilla`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `renombrar_campos_grilla` (
  `id_renombrar_campos_grilla` int NOT NULL AUTO_INCREMENT,
  `id_modulos` int NOT NULL,
  `campo` varchar(100) NOT NULL,
  `nuevo_nombre_campo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_renombrar_campos_grilla`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renombrar_campos_grilla`
--

LOCK TABLES `renombrar_campos_grilla` WRITE;
/*!40000 ALTER TABLE `renombrar_campos_grilla` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `renombrar_campos_grilla` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `renombrar_campos_grilla` with 0 row(s)
--

--
-- Table structure for table `rol`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idrol` int NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(100) NOT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `rol` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `rol` with 2 row(s)
--

--
-- Table structure for table `slider`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `id_slider` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) NOT NULL,
  `imagen` varchar(300) NOT NULL,
  `url` varchar(300) NOT NULL,
  `contenido` text,
  PRIMARY KEY (`id_slider`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `slider` VALUES (28,'prueba','1756995293_WhatsApp-Image-2025-05-07-at-14.48.09-645x362.jpeg','hospital de melipilla participa en importante encuentro nacional de sostenibilidad financiera y gestion hospitalaria',''),(29,'img2','1756995238_WhatsApp-Image-2025-06-13-at-11.40.53-645x432.jpeg','comite paritario recibe certificacion categoria oro y galardon especial por compromiso e innovacion',''),(30,'img3','1756992321_WhatsApp-Image-2025-06-13-at-11.59.21-645x362.jpeg','hospital de melipilla organiza II jornadas de enfermeria en el ano del cambio','');
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `slider` with 3 row(s)
--

--
-- Table structure for table `submenu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenu` (
  `id_submenu` int NOT NULL AUTO_INCREMENT,
  `id_menu` int NOT NULL,
  `nombre_submenu` varchar(100) NOT NULL,
  `url_submenu` varchar(300) NOT NULL,
  `icono_submenu` varchar(100) NOT NULL,
  `orden_submenu` tinyint NOT NULL,
  `area_protegida_submenu` varchar(100) NOT NULL,
  PRIMARY KEY (`id_submenu`),
  KEY `id_menu` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenu`
--

LOCK TABLES `submenu` WRITE;
/*!40000 ALTER TABLE `submenu` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `submenu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `submenu` with 0 row(s)
--

--
-- Table structure for table `submenu_web`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenu_web` (
  `id_submenu_web` int NOT NULL,
  `id_menu_web` int NOT NULL,
  `nombre_submenu` varchar(100) NOT NULL,
  `url_submenu` varchar(300) NOT NULL,
  `visibilidad_submenu` varchar(100) NOT NULL,
  PRIMARY KEY (`id_submenu_web`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenu_web`
--

LOCK TABLES `submenu_web` WRITE;
/*!40000 ALTER TABLE `submenu_web` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `submenu_web` VALUES (1,2,'Quiénes Somos','/web_hospital/pagina/quienes-somos','Visible'),(2,2,'Misión, Visión y Valores Institucionales','/web_hospital/pagina/Mision-Vision-y-valores-institucionales','Visible'),(3,2,'Autoridades','/web_hospital/pagina/Autoridades','Visible'),(4,2,'Organigrama','/web_hospital/pagina/Organigrama','Visible'),(5,2,'Reglamento Interno','/web_hospital/pagina/Reglamento-Interno','Visible'),(6,3,'Hospitalización','/web_hospital/pagina/Hospitalizacion','Visible'),(7,3,'Atención Ambulatoria','/web_hospital/pagina/Atencion-Ambulatoria','Visible'),(8,3,'Especialidades','#','Visible'),(9,3,'Urgencias','/web_hospital/pagina/Urgencias','Visible'),(10,3,'Apoyo Clínico','#','Visible'),(11,4,'OIRS','/web_hospital/pagina/OIRS','Visible'),(12,4,'Sistema de Visitas','/web_hospital/pagina/Sistema-de-Visitas','Visible'),(13,4,'Hospital Amigo','/web_hospital/pagina/Hospital-Amigo','Visible'),(14,4,'GES y Ley Ricarte Soto','/web_hospital/pagina/GES-y-Ley-Ricarte-Soto','Visible'),(15,4,'Agendamiento','/web_hospital/pagina/Agendamiento','Visible');
/*!40000 ALTER TABLE `submenu_web` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `submenu_web` with 15 row(s)
--

--
-- Table structure for table `submenudos_web`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `submenudos_web` (
  `id_submenudos_web` int NOT NULL AUTO_INCREMENT,
  `id_submenu_web` int NOT NULL,
  `nombre_submenudos` varchar(100) NOT NULL,
  `url_submenudos` varchar(300) NOT NULL,
  `visibilidad_submenudos` varchar(100) NOT NULL,
  PRIMARY KEY (`id_submenudos_web`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `submenudos_web`
--

LOCK TABLES `submenudos_web` WRITE;
/*!40000 ALTER TABLE `submenudos_web` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `submenudos_web` VALUES (1,8,'Especialidades Médicas','/web_hospital/pagina/Especialidades-Medicas','Visible'),(2,8,'Especialidades Odontologicas','/web_hospital/pagina/Especialidades-Odontologicas','Visible'),(3,10,'Laboratorio Clínico','/web_hospital/pagina/Laboratorio-Clinico','Visible'),(4,10,'Imagenología','/web_hospital/pagina/Imagenologia','Visible'),(5,10,'UMT','/web_hospital/pagina/UTM','Visible'),(6,10,'Medicina Física y Rehabilitación','/web_hospital/pagina/Medicina-Fisica-y-Rehabilitacion','Visible'),(7,10,'Nutrición y SEDILE','/web_hospital/pagina/Nutricion-y-SEDILE','Visible'),(8,10,'Farmacia Ambulatoria','/web_hospital/pagina/Farmacia-Ambulatoria','Visible');
/*!40000 ALTER TABLE `submenudos_web` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `submenudos_web` with 8 row(s)
--

--
-- Table structure for table `usuario`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `password` varchar(200) NOT NULL,
  `token` longtext NOT NULL,
  `token_api` longtext NOT NULL,
  `expiration_token` int DEFAULT NULL,
  `idrol` int NOT NULL,
  `estatus` int NOT NULL,
  `avatar` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario` VALUES (1,'Daniel','daniel.telematico@gmail.com','admin','$2y$10$2BrYaf/9dFNYyZ9ywg4xXeicVrZqrp5HhcpcLykept50WhY242J9m','$2y$10$sUHfVgHv92C8XLnqJL0HEOwUBD0BGzKJJp2S9hPD6eDYbmpbuqAPm','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJlbWFpbCI6ImRhbmllbC50ZWxlbWF0aWNvQGdtYWlsLmNvbSIsInRpbWVzdGFtcCI6MTcyOTg3ODA3OSwiZXhwIjoxNzI5ODgxNjc5fQ.3ixpmkuvXfjnCkmoaCFtjEh0FyZm3vuYcrqEZYMHVac',0,1,1,'1707312535_1707234514_1668021806_2.png'),(24,'Grethel Durán','grethel.duran@redsalud.gob.cl','grethel','$2y$10$8nGbo1b3nlou9WuoZ7B7NuwES4R9ykbQhoTGHNHuhz39nJO9Mn14.','$2y$10$5sx06hkeB50mYd6eQ4rBsuDGBsyoNrLY5ncpowmQ4CziuorKjK/A.','',0,1,1,'1710162578_user.png'),(25,'Christopher Muñoz','christopher.munoz@redsalud.gocb.cl','christopher','$2y$10$rusrZNNEQPF1Q2VgMzQPP.q6pqFLq9hHfxBe0muM7.jiZeDIY2R.m','$2y$10$5sx06hkeB50mYd6eQ4rBsuDGBsyoNrLY5ncpowmQ4CziuorKjK/A.','',0,1,1,'1710162578_user.png');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario` with 3 row(s)
--

--
-- Table structure for table `usuario_menu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_menu` (
  `id_usuario_menu` int NOT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_menu` int DEFAULT NULL,
  `visibilidad_menu` varchar(100) NOT NULL,
  PRIMARY KEY (`id_usuario_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_menu`
--

LOCK TABLES `usuario_menu` WRITE;
/*!40000 ALTER TABLE `usuario_menu` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `usuario_menu` VALUES (1156,1,1,'Mostrar'),(1159,1,4,'Mostrar'),(1160,1,5,'Mostrar'),(1161,1,6,'Mostrar'),(1162,1,7,'Mostrar'),(1165,1,10,'Mostrar'),(1166,20,1,'Mostrar'),(1169,20,4,'Mostrar'),(1170,20,5,'Mostrar'),(1171,20,6,'Mostrar'),(1172,20,7,'Mostrar'),(1175,20,10,'Mostrar'),(1176,1,12,'Mostrar'),(1179,1,19,'Ocultar'),(1299,1,141,'Ocultar'),(1427,1,269,'Mostrar'),(1428,1,270,'Ocultar'),(1429,1,271,'Mostrar'),(1430,1,272,'Ocultar'),(1431,1,273,'Mostrar'),(1432,1,274,'Mostrar'),(1433,20,12,'Mostrar'),(1434,20,141,'Mostrar'),(1435,20,269,'Mostrar'),(1436,20,270,'Mostrar'),(1437,20,271,'Mostrar'),(1438,20,272,'Mostrar'),(1439,20,273,'Mostrar'),(1440,20,274,'Mostrar'),(1441,24,4,'Mostrar'),(1442,24,5,'Mostrar'),(1443,24,6,'Mostrar'),(1444,24,7,'Mostrar'),(1445,24,10,'Mostrar'),(1446,24,12,'Ocultar'),(1447,24,269,'Mostrar'),(1448,24,271,'Mostrar'),(1449,24,272,'Mostrar'),(1450,24,273,'Mostrar'),(1451,24,274,'Mostrar'),(1452,25,4,'Mostrar'),(1453,25,5,'Mostrar'),(1454,25,6,'Mostrar'),(1455,25,7,'Mostrar'),(1456,25,10,'Mostrar'),(1457,25,269,'Mostrar'),(1458,25,271,'Mostrar'),(1459,25,272,'Mostrar'),(1460,25,273,'Mostrar'),(1461,25,274,'Mostrar');
/*!40000 ALTER TABLE `usuario_menu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario_menu` with 50 row(s)
--

--
-- Table structure for table `usuario_submenu`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_submenu` (
  `id_usuario_submenu` int NOT NULL,
  `id_submenu` int NOT NULL,
  `id_menu` int NOT NULL,
  `visibilidad_submenu` varchar(100) NOT NULL,
  `id_usuario` int NOT NULL,
  PRIMARY KEY (`id_usuario_submenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_submenu`
--

LOCK TABLES `usuario_submenu` WRITE;
/*!40000 ALTER TABLE `usuario_submenu` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `usuario_submenu` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

-- Dumped table `usuario_submenu` with 0 row(s)
--

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Tue, 02 Dec 2025 09:00:40 -0300
