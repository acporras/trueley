-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: abogados
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `idCliente` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechareg` datetime DEFAULT NULL,
  `tipocliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombrefirma` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `documentofirma` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccionfirma` text COLLATE utf8_spanish_ci,
  `telefonosfirma` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `emailfirma` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechapago` datetime DEFAULT NULL,
  `proximopago` datetime DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT NULL,
  `usuarioreg` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `idclientmp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `autmp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagoinicial` tinyint(1) DEFAULT NULL,
  `afiliacion` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idCliente`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'944-5b3b0ddfd5c44','2018-07-10 00:08:43','individual','PL-5b4946d5320ea','Carlos Quintero','14624982','No Aplica','No Aplica','info.fxstudios@gmail.com','2018-07-20 09:21:32','2018-09-08 09:21:32',1,'Carlos Quintero',NULL,NULL,0,0),(9,'home','2018-07-22 23:33:39','home','na','na','na','na','na','na','2018-07-22 23:34:15','2018-07-22 23:34:12',1,'na','na',NULL,1,1),(11,'805-5b55b905eb6cc','2018-07-23 08:16:21','individual','PL-5b55764b0727f','cliente demo','123456','Direccion DEMO','+584144402460','direccion@hitcel.com','2018-07-23 08:16:21','2018-07-23 08:16:21',1,'Carlos Quintero',NULL,NULL,NULL,NULL),(21,'629-5b692cd5ceb6f','2018-08-07 02:23:33','individual','PL-5b6280664c210','vfgsxfdsdf','36407654','fhgdfgd','3764556391','matias.estigarribia2112@gmail.com','2018-08-07 02:23:33','2018-08-07 02:23:33',1,'Admin','185352943','a90112b2a83942868ccd4c226b5febcc',1,1),(22,'161-5b6a78d94721c','2018-08-08 02:00:09','individual','PL-5b6280664c210','yamil dario halley','00000000','asdasdasd','3764556391','guidohalley@hotmail.com','2018-08-08 02:00:09','2018-08-08 02:00:09',1,'Admin','','',0,0);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion` (
  `idConfig` int(255) NOT NULL AUTO_INCREMENT,
  `fechaupdate` datetime DEFAULT NULL,
  `usuarioupdate` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `demo` tinyint(1) DEFAULT NULL,
  `demolimit` int(3) DEFAULT NULL,
  `mpestatus` tinyint(1) DEFAULT NULL,
  `mpapp` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mpsecret` longtext COLLATE utf8_spanish_ci,
  `paypalestatus` tinyint(1) DEFAULT NULL,
  `paypalaccount` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `paypalclient` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `paypalsecret` longtext COLLATE utf8_spanish_ci,
  `mensajenuevo` longtext COLLATE utf8_spanish_ci,
  `mensajeclave` longtext COLLATE utf8_spanish_ci,
  `politicas` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idConfig`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'2018-07-16 20:13:41','Carlos Quintero',0,0,1,'zvfzsdfvsdvsdfv','asdfasdfgasdfasdf',0,'a@a.com','sdfgsdfgsdfgsdfg','sdgsdgsdfgsdfgsdgfsdgtgsetget','<p><span xss=\"removed\">Estimado(a) </span><b><span xss=\"removed\"><font color=\"#3984c6\">%name%</font></span></b><span xss=\"removed\"> Bienvenido(a) a </span><b><span xss=\"removed\">TrueLey</span></b><span xss=\"removed\">, plataforma web donde podrás utilizar los siguientes servicios juridicos</span></p><ul><li><span xss=\"removed\">Ver tus expedientes a Despacho</span></li><li>El sistema Busca en el despacho Cada vez que das actualizar</li><li>Sistema de Pago Seguro</li><li><span xss=\"removed\"><span xss=\"removed\"><b>PROXIMAMENTE </b>:</span></span>    <span xss=\"removed\">Gestiona Tus Clientes <br></span></li><li><span xss=\"removed\"><b>PROXIMAMENTE </b></span><span xss=\"removed\">:</span>    Administración de Gastos y ingresos  </li><li><b>PROXIMAMENTE </b>:    Estadisticas de cobro mensual </li><li><span xss=\"removed\"><b>PROXIMAMENTE</b> </span><span xss=\"removed\">:</span>    Calculo de Estampillas</li><li><b>PROXIMAMENTE :</b>   Aviso de Vencimiento y Cuando Contestar las demandas<br></li></ul><p><span xss=\"removed\">Los datos de Acceso a la Plataforma son:</span></p><p><span xss=\"removed\">Usuario: <font color=\"#085294\"><i><b>%user%</b></i></font></span></p><p><span xss=\"removed\">Clave: <font color=\"#085294\"><i><b>%pass%</b></i></font></span></p><p><span xss=\"removed\"><font color=\"#000000\">Para ingresar al Sistema, por favor visita el siguiente enlace:</font><font color=\"#085294\"> <b>%uri%</b></font></span></p><p>                                <span xss=\"removed\"><font color=\"#085294\"><b>Trueley Un servicio exclusivo para la Provincia de Misiones</b></font></span></p><div xss=\"removed\"><font color=\"#085294\"><b><br></b></font></div><p></p>','<p xss=\"removed\">Estimado <b><font color=\"#3984c6\">%name%</font></b>, Ha recibido este email en conformidad con su solicitud de cambio de clave, por favor, si dicha solicitud no fué realizada por usted o alguien de su equipo, contactenos de manera inmediata, en caso contrario por favor haga click en el siguiente enlace para continuar con el proceso:</p><p><b xss=\"removed\"><font color=\"#085294\">%url%</font></b></p>',NULL);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expedientes`
--

DROP TABLE IF EXISTS `expedientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expedientes` (
  `idExpe` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'codigo de cliente',
  `expediente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'numero de expediente',
  `cliente` text COLLATE utf8_spanish_ci,
  `portada` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'cliente o portada del expediente',
  `bis` tinyint(1) DEFAULT NULL COMMENT 'si es reabierto o no',
  `bisdata` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'codigo de reapertura',
  `basexpe` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'codigo base del expediente',
  `circunscripcion` int(255) DEFAULT NULL COMMENT 'circunscripcion',
  `localidad` int(255) DEFAULT NULL COMMENT 'localidad',
  `dependencia` int(255) DEFAULT NULL,
  `juzgado` longtext COLLATE utf8_spanish_ci COMMENT 'nombre del jusgado',
  `saliocon` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT '??',
  `fechareg` datetime DEFAULT NULL COMMENT 'fecha registro al sistema',
  `fechamod` datetime DEFAULT NULL COMMENT 'fecha modificacion',
  `fechadespacho` datetime DEFAULT NULL COMMENT 'fecha ultimo despacho',
  `fechaupdate` datetime DEFAULT NULL COMMENT 'fecha de ultima revision',
  `observacion` longtext COLLATE utf8_spanish_ci COMMENT 'observaciones del abogado',
  `estado` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'estado del registro pendiente, despachado, papelera',
  PRIMARY KEY (`idExpe`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `expedientes_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expedientes`
--

LOCK TABLES `expedientes` WRITE;
/*!40000 ALTER TABLE `expedientes` DISABLE KEYS */;
INSERT INTO `expedientes` VALUES (16,'944-5b3b0ddfd5c44','58137/2015','Divorsio Maria y José','A.  --',0,'','58137/2015',1,1,56,'Juzgado de Familia Nro. 1','POSADAS','2018-07-07 01:33:35','2018-07-07 01:33:35','2018-07-06 00:00:00','2018-07-07 01:33:35','Ninguna','a despacho'),(17,'944-5b3b0ddfd5c44','49864/2015 (EX 1128/2014)','Divorsion Marta Medina','C.  --',0,'','49864/2015 (EX 1128/2014)',1,1,56,'Juzgado de Familia Nro. 1','POSADAS','2018-07-07 01:34:47','2018-07-07 01:34:47','2018-07-06 00:00:00','2018-07-07 01:34:47','','a despacho'),(19,'944-5b3b0ddfd5c44','18438/2018','Yurakosky Marcelo Litigio III','YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/BENEFICIO DE LITIGAR SIN GASTOS  Beneficio de litigar sin gastos  YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/DAOS Y PERJUICIOS  DAOS Y PERJUICIOS  184382018',1,'1/18','18438/2018',2,13,512,'JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle','ARIST. DEL VALLE','2018-07-08 14:49:55','2018-07-08 14:49:55','2018-07-06 00:00:00','2018-07-08 14:57:41','ninguna','a despacho'),(20,'805-5b55b905eb6cc','39388/2017','nombre de cliente','DE JESUS MARIO ALBERTO pshm DADJ  y Otro/a   S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos',0,'','39388/2017',1,1,50,'Juzgado Civil y Comercial Nro. 3','POSADAS','2018-07-24 17:10:47','2018-07-24 17:10:47','2017-11-28 00:00:00','2018-07-24 17:10:47','','a despacho'),(22,'629-5b692cd5ceb6f','71809/2017',' ACOSTA CRISTINA Y VILLALBA DANIEL','A.  -- DR/A. LEIVA, CLAUDIA CAROLINA --',0,'','71809/2017',1,1,56,'Juzgado de Familia Nro. 1','POSADAS','2018-08-08 02:34:40','2018-08-08 02:34:40','2018-03-16 00:00:00','2018-08-08 02:34:40','Dni:\r\nDireccion: \r\nTelefono : ','a despacho'),(23,'629-5b692cd5ceb6f','51042/2016','Castillo Carina Patricia c/ Flemanti Angelo','C.  -- DR/A. ACOSTA, NESTOR GUSTAVO --  DR/A. LEIVA, CLAUDIA CAROLINA --  DR/A. RODRIGUEZ, LEANDRO SEBASTIAN --',0,'','51042/2016',1,1,56,'Juzgado de Familia Nro. 1','POSADAS','2018-08-08 03:00:43','2018-08-08 03:00:43','2018-07-27 00:00:00','2018-08-08 03:00:43','','a despacho'),(24,'629-5b692cd5ceb6f','318/2006  ','COSTA VICENTE MANUEL HUMBERTO C/ CABRERA VERONICA MIRIAM','',1,'1/06 ','318/2006  ',1,1,56,'Pendiente','Pendiente','2018-08-08 03:06:26','2018-08-08 03:35:19','2018-08-08 03:06:26','2018-08-08 03:35:19','Busco El expediente principal\r\n','pendiente despacho'),(25,'629-5b692cd5ceb6f','3698/2010',' FERLONI Y PERONI','F.  -- DR/A. LEIVA, CLAUDIA CAROLINA --  DR/A. Barrionuevo Mantaras, Griselda Beatriz --',0,'','3698/2010',1,1,56,'Juzgado de Familia Nro. 1','POSADAS','2018-08-08 03:18:23','2018-08-08 03:18:23','2018-07-24 00:00:00','2018-08-08 03:18:23','','a despacho'),(26,'629-5b692cd5ceb6f','956/2012','Zeppe Tatiana Muriel p.s.h.m. ZLV c/ Smeller Antonio Revino','Z.  -- DR/A. CROUX, FERNANDA ALEJANDRA --',0,'','956/2012',2,5,121,'Juzgado de Familia Nro. 1 - OBERA','OBERA','2018-08-08 03:26:19','2018-08-08 03:26:19','2014-04-09 00:00:00','2018-08-08 03:26:19','','a despacho'),(27,'629-5b692cd5ceb6f','9227/2014','PRATS MORETO JUAN P.P.M B.R.F','P.  -- DR/A. LEIVA, CLAUDIA CAROLINA --',0,'','9227/2014',3,30,162,'Juzgado Civil y Comercial, Laboral y de Familia - IGUAZU','PTO. IGUAZU','2018-08-08 03:27:43','2018-08-08 03:27:43','2015-05-04 00:00:00','2018-08-08 03:27:43','','a despacho'),(28,'629-5b692cd5ceb6f','6010/2014','PICOS ','PICOS MYRIAN LUCILA   y Otro/a   S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos',1,'1/14','6010/2014',1,1,53,'Juzgado Civil y Comercial Nro. 6','POSADAS','2018-08-08 03:30:16','2018-08-08 03:30:16','2018-08-03 00:00:00','2018-08-08 03:30:16','','a despacho'),(29,'629-5b692cd5ceb6f','123312/2015','Comoglio Virginia','COMOGLIO VIRGINIA SOLEDAD     S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos',0,'','123312/2015',1,1,52,'Juzgado Civil y Comercial Nro. 5','POSADAS','2018-08-08 03:31:14','2018-08-08 03:31:14','2018-04-20 00:00:00','2018-08-08 03:31:14','','a despacho'),(30,'629-5b692cd5ceb6f','28882/2015','Fzap Mammroch','FZAP MAMMROCH MIGUEL     S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos  FZAP MAMMROCH MIGUEL C/ FZAP SUAREZ ANDREA RAQUEL S/ Revocacin de donacin Conexidad Solicitada en autos 12645/2014  FZAP MAMMROCH MIGUEL     S/ Prueba Anticipada',1,'1/15','28882/2015',1,1,51,'Juzgado Civil y Comercial Nro. 4','POSADAS','2018-08-08 03:35:02','2018-08-08 03:35:02','2016-09-20 00:00:00','2018-08-08 03:35:02','','a despacho'),(31,'629-5b692cd5ceb6f','70287/2015','Humada','HUMADA JULIO CESAR   S/ Sucesorio  Sucesorio',0,'','70287/2015',1,1,49,'Juzgado Civil y Comercial Nro. 2','POSADAS','2018-08-08 03:38:14','2018-08-08 03:38:14','2017-09-19 00:00:00','2018-08-08 03:38:14','','a despacho'),(32,'629-5b692cd5ceb6f','1274/2010','Alcumbre','CAMARGO RAMON OSCAR   C/ ALCULUMBRE RAQUEL ROSANA   Y OTRO/A S/ EJECUCIóN DE HONORARIOS',0,'','1274/2010',1,1,54,'Juzgado Civil y Comercial Nro. 7','POSADAS','2018-08-08 03:39:44','2018-08-08 03:39:44','2014-05-23 00:00:00','2018-08-08 03:39:44','','a despacho'),(33,'629-5b692cd5ceb6f','9159/2012','LANZIANI','LANZIANI SERGIO ENZO   C/ LANZIANI SA   S/ Ejecucin Hipotecaria  Ejecucin Hipotecaria',0,'','9159/2012',1,1,55,'Juzgado Civil y Comercial Nro. 8','POSADAS','2018-08-08 03:42:27','2018-08-08 03:42:27','2018-06-01 00:00:00','2018-08-08 03:42:27','','a despacho');
/*!40000 ALTER TABLE `expedientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `histopagos`
--

DROP TABLE IF EXISTS `histopagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `histopagos` (
  `idHisto` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `monto` decimal(20,2) DEFAULT NULL,
  `metodo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pasarela` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idHisto`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `histopagos`
--

LOCK TABLES `histopagos` WRITE;
/*!40000 ALTER TABLE `histopagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `histopagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial`
--

DROP TABLE IF EXISTS `historial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial` (
  `idHisto` int(255) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `usuario` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `asunto` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idHisto`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial`
--

LOCK TABLES `historial` WRITE;
/*!40000 ALTER TABLE `historial` DISABLE KEYS */;
INSERT INTO `historial` VALUES (1,'2018-07-16 10:29:09','Carlos Quintero','Activación de Cliente','Se ha activado al Cliente Grupo EMC 2013 Publicidad C.A.'),(2,'2018-07-16 10:29:42','Carlos Quintero','Suspensión de Cliente','Se ha suspendido al Cliente Grupo EMC 2013 Publicidad C.A.'),(3,'2018-07-16 10:29:56','Carlos Quintero','Activación de Cliente','Se ha activado al Cliente Grupo EMC 2013 Publicidad C.A.'),(4,'2018-07-16 10:33:41','Carlos Quintero','Actualizada Mercadopago','Se ha modificado la Cuenta Mercadopago'),(5,'2018-07-16 19:34:05','Carlos Quintero','Edición de Plan','Se ha editado el Plan Básico'),(6,'2018-07-16 19:34:09','Carlos Quintero','Edición de Plan','Se ha editado el Plan Básico'),(7,'2018-07-16 20:13:38','Carlos Quintero','Actualizada Mercadopago','Se ha modificado la Cuenta Mercadopago'),(8,'2018-07-16 20:13:41','Carlos Quintero','Actualizada Mercadopago','Se ha modificado la Cuenta Mercadopago'),(9,'2018-07-20 02:11:18','Carlos Quintero','Nuevo Cliente','Se ha registrado al nuevo Cliente ricardo quintero'),(10,'2018-07-22 23:11:15','Carlos Quintero','Nuevo Cliente','Se ha registrado al nuevo Cliente muestras inc'),(11,'2018-07-22 23:24:56','Carlos Quintero','Nuevo Cliente','Se ha registrado al nuevo Cliente momentos legales firma'),(12,'2018-07-22 23:39:26','Carlos Quintero','Nuevo Cliente','Se ha registrado al nuevo Cliente corporacion hitcel c.a.'),(13,'2018-07-22 23:48:38','Carlos Quintero','Suspensión de Administrador','Se ha suspendido a Ricardo Quintero de la administración del sistema.'),(14,'2018-07-22 23:48:43','Carlos Quintero','Activación de Administrador','Se ha reactivado a Ricardo Quintero en la administración del sistema.'),(15,'2018-07-22 23:49:06','Carlos Quintero','Suspensión de Administrador','Se ha suspendido a Ricardo Quintero de la administración del sistema.'),(16,'2018-07-22 23:50:13','Carlos Quintero','Nuevo Administrador','Se ha Registrado a Ricardo Quintero como administrador del sistema'),(17,'2018-07-22 23:50:19','Carlos Quintero','Suspensión de Administrador','Se ha suspendido a Ricardo Quintero de la administración del sistema.'),(18,'2018-07-22 23:50:27','Carlos Quintero','Eliminación de Administrador','Se ha eliminado a Carlos Quintero del sistema.'),(19,'2018-07-22 23:52:57','Carlos Quintero','Nuevo Administrador','Se ha Registrado a ricardo quintero como administrador del sistema'),(20,'2018-07-22 23:53:01','Carlos Quintero','Suspensión de Administrador','Se ha suspendido a ricardo quintero de la administración del sistema.'),(21,'2018-07-22 23:53:09','Carlos Quintero','Eliminación de Administrador\',\'Se ha eliminado a  del sistema.',NULL),(22,'2018-07-22 23:53:50','Carlos Quintero','Nuevo Administrador','Se ha Registrado a ricardo quintero como administrador del sistema'),(23,'2018-07-22 23:53:57','Carlos Quintero','Eliminación de Administrador\',\'Se ha eliminado a  del sistema.',NULL),(24,'2018-07-22 23:54:35','Carlos Quintero','Nuevo Administrador','Se ha Registrado a ricardo quintero como administrador del sistema'),(25,'2018-07-22 23:54:40','Carlos Quintero','Eliminación de Administrador\',\'Se ha eliminado a ricardo quintero del sistema.',NULL),(26,'2018-07-22 23:55:41','Carlos Quintero','Nuevo Administrador','Se ha Registrado a ricardo quintero como administrador del sistema'),(27,'2018-07-22 23:55:48','Carlos Quintero','Eliminación de Administrador','Se ha eliminado a ricardo quintero del sistema.'),(28,'2018-07-22 23:57:38','Carlos Quintero','Modificación de Clave','Se ha modificado la clave a Carlos Quintero'),(29,'2018-07-23 03:31:39','Carlos Quintero','Nuevo Plan','Se ha registrado el Plan testplan'),(30,'2018-07-23 08:16:22','Carlos Quintero','Nuevo Cliente','Se ha registrado al nuevo Cliente cliente demo'),(31,'2018-07-23 08:23:12','Carlos Quintero','Nuevo Administrador','Se ha Registrado a Carlos Quintero como administrador del sistema'),(32,'2018-07-23 18:04:42','Admin','Nuevo Plan','Se ha registrado el Plan promo firma'),(33,'2018-07-23 18:05:02','Admin','Edición de Plan','Se ha editado el Plan Básico'),(34,'2018-07-23 18:05:37','Admin','Edición de Plan','Se ha editado el Plan Testplan'),(35,'2018-07-23 18:06:24','Admin','Edición de Plan','Se ha editado el Plan Testplan'),(36,'2018-07-23 18:09:12','Admin','Edición de Plan','Se ha editado el Plan Standard'),(37,'2018-07-23 18:09:24','Admin','Edición de Plan','Se ha editado el Plan Promo Firma'),(38,'2018-07-23 18:10:04','Admin','Edición de Plan','Se ha editado el Plan Promo Firma'),(39,'2018-07-23 18:13:08','Admin','Nuevo Plan','Se ha registrado el Plan promo firma plus'),(40,'2018-07-23 18:13:24','Admin','Edición de Plan','Se ha editado el Plan Promo Firma +3'),(41,'2018-07-23 18:13:36','Admin','Edición de Plan','Se ha editado el Plan Promo Firma Plus +5'),(42,'2018-07-23 18:15:17','Admin','Nuevo Plan','Se ha registrado el Plan promo firma plus +10'),(43,'2018-07-23 18:17:04','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente guido'),(44,'2018-08-02 00:54:14','Admin','Nuevo Plan','Se ha registrado el Plan test real no usar'),(45,'2018-08-02 00:56:17','Admin','Edición de Plan','Se ha editado el Plan Test Real No Usar'),(46,'2018-08-02 23:11:35','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente ezequiel'),(47,'2018-08-05 15:03:53','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente test1'),(48,'2018-08-06 20:06:02','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente guido'),(49,'2018-08-06 20:07:21','Admin','Edición de Plan','Se ha editado el Plan Test Real No Usar'),(50,'2018-08-06 20:07:54','Admin','Edición de Plan','Se ha editado el Plan Test Real No Usar'),(51,'2018-08-07 00:15:25','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente definitivo'),(52,'2018-08-07 01:03:18','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente test final'),(53,'2018-08-07 01:12:31','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente matias'),(54,'2018-08-07 01:12:41','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente yamil dar&iacute;o halley'),(55,'2018-08-07 01:21:06','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente aasdasd'),(56,'2018-08-07 02:23:33','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente vfgsxfdsdf'),(57,'2018-08-08 02:00:09','Admin','Nuevo Cliente','Se ha registrado al nuevo Cliente yamil dario halley'),(58,'2018-08-09 03:42:35','Alex Javier Caicedo Porras','Edición de Administrador','Se han modificado los datos de Admin'),(59,'2018-08-09 03:42:42','Alex Javier Caicedo Porras','Edición de Administrador','Se han modificado los datos de Admin');
/*!40000 ALTER TABLE `historial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mensajes`
--

DROP TABLE IF EXISTS `mensajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mensajes` (
  `idMensaje` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estatus` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mensaje` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idMensaje`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mensajes`
--

LOCK TABLES `mensajes` WRITE;
/*!40000 ALTER TABLE `mensajes` DISABLE KEYS */;
INSERT INTO `mensajes` VALUES (4,'944-5b3b0ddfd5c44','2018-07-03 11:29:27','private','','Muestra de Mensaje'),(5,'944-5b3b0ddfd5c44','2018-07-03 11:30:05','private','','Muestra de un segundo Mensaje'),(6,'805-5b55b905eb6cc','2018-07-23 18:19:27','private','','HOLA MUNDO');
/*!40000 ALTER TABLE `mensajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movimientos` (
  `idMovi` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `info` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idMovi`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimientos`
--

LOCK TABLES `movimientos` WRITE;
/*!40000 ALTER TABLE `movimientos` DISABLE KEYS */;
INSERT INTO `movimientos` VALUES (1,'944-5b3b0ddfd5c44','2018-07-05 18:16:19','Registro','Registro de Expediente Nro. <b>10396/2018</b>, Portada: <b>CALCENA NUEZ LISA C/ ESCOBAR RAMON ANIBAL S/ EJECUTIVO  Ejecutivo</b>, Dependencia: <b>JUZG.DE PAZ -PTO.IGUAZU-</b>'),(2,'944-5b3b0ddfd5c44','2018-07-05 18:37:30','Registro','Registro de Expediente Nro. <b>276/2014 bis1/15</b>, Portada: <b>DEFILIPPI MARIA CELESTE C/MARCELINA GOMEZ S/INCIDENTE DE NULIDAD  Incidente de nulidad  GOMEZ MARCELINA C/MARIA CELESTE DEFILIPPI S/EJECUTIVO</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(3,'944-5b3b0ddfd5c44','2018-07-05 18:39:09','Registro','Registro de Expediente Nro. <b>56465/2018</b>, Portada: <b>AYALA CYNTHIA KATERINE S/INSCRIPCION DE NACIMIENTO  Inscripcin de Nacimiento</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(4,'944-5b3b0ddfd5c44','2018-07-05 18:39:44','Registro','Registro de Expediente Nro. <b>56465/2021</b>, Portada: <b>nombre temporal</b>, Dependencia: <b>Pendiente</b>'),(5,'944-5b3b0ddfd5c44','2018-07-06 00:04:11','Actualización','Actualziado de Expediente Nro. <b>1879/2011</b>, Portada: <b>CARSA SA C/ ARNALDO JOSE RODRIGUEZ S/EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(6,'944-5b3b0ddfd5c44','2018-07-06 00:04:11','Actualización','Actualziado de Expediente Nro. <b>727/2012</b>, Portada: <b>CARSA SA C/ MARIO HECTOR PARRA S/ EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(7,'944-5b3b0ddfd5c44','2018-07-06 00:39:05','Actualización','Actualizado de Expediente Nro. <b>26333/2017</b>, Portada: <b>BANCO HIPOTECARIO SAC/TEOFILO ANGEL SEGOVIA S/EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(8,'944-5b3b0ddfd5c44','2018-07-06 05:44:25','Eliminación','Se ha eliminado el Expediente Nro. <b>10396/2018</b>, Portada: <b></b>, Dependencia: <b>191</b>'),(9,'944-5b3b0ddfd5c44','2018-07-06 05:46:15','Eliminación','Se ha eliminado el Expediente Nro. <b>727/2012</b>, Portada: <b></b>, Dependencia: <b>88</b>'),(10,'944-5b3b0ddfd5c44','2018-07-06 05:47:45','Eliminación','Se ha eliminado el Expediente Nro. <b>1879/2011</b>, Portada: <b></b>, Dependencia: <b>88</b>'),(11,'944-5b3b0ddfd5c44','2018-07-06 05:48:34','Eliminación','Se ha eliminado el Expediente Nro. <b>26333/2017</b>, Portada: <b>BANCO HIPOTECARIO SAC/TEOFILO ANGEL SEGOVIA S/EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(12,'944-5b3b0ddfd5c44','2018-07-06 05:55:31','Eliminación','Se ha eliminado el Expediente Nro. <b>56465/2018</b>, Portada: <b>AYALA CYNTHIA KATERINE S/INSCRIPCION DE NACIMIENTO  Inscripcin de Nacimiento</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(13,'944-5b3b0ddfd5c44','2018-07-06 05:56:48','Registro','Registro de Expediente Nro. <b>24438/2018</b>, Portada: <b>B.  -- DR/A. BALOVIER, CESAR SIMON --</b>, Dependencia: <b>JUZGADO DE FAMILIA Y VIOLENCIA FAMILIAR Nº 1</b>'),(14,'944-5b3b0ddfd5c44','2018-07-06 05:57:37','Registro','Registro de Expediente Nro. <b>17114/2018</b>, Portada: <b>G.  -- DR/A. CRISTALDO, JULIO CESAR --  DR/A. RIEGER, DORA BEATRIZ --</b>, Dependencia: <b>JUZGADO DE FAMILIA Y VIOLENCIA FAMILIAR Nº 1</b>'),(15,'944-5b3b0ddfd5c44','2018-07-06 09:13:11','Registro','Registro de Expediente Nro. <b>501/1998 bis11/15</b>, Portada: <b>DR ORTIGOZA OCAMPO HORACIO  A S/ EJECUCION  DE HONORARIOS  Honorarios  BANCO FRANCES SA C/JUAN OSCAR RIOS S/EJECUTIVO  EJECUTIVO  5011998</b>, Dependencia: <b>Juzgado de Paz en lo Contravencional</b>'),(16,'944-5b3b0ddfd5c44','2018-07-06 09:15:04','Actualización','Actualizado de Expediente Nro. <b>501/1998 bis11/15</b>, Portada: <b>DR ORTIGOZA OCAMPO HORACIO  A S/ EJECUCION  DE HONORARIOS  Honorarios  BANCO FRANCES SA C/JUAN OSCAR RIOS S/EJECUTIVO  EJECUTIVO  5011998</b>, Dependencia: <b>Juzgado de Paz en lo Contravencional</b>'),(17,'944-5b3b0ddfd5c44','2018-07-06 09:15:56','Eliminación','Se ha eliminado el Expediente Nro. <b>501/1998 bis11/15</b>, Portada: <b>DR ORTIGOZA OCAMPO HORACIO  A S/ EJECUCION  DE HONORARIOS  Honorarios  BANCO FRANCES SA C/JUAN OSCAR RIOS S/EJECUTIVO  EJECUTIVO  5011998</b>, Dependencia: <b>Juzgado de Paz en lo Contravencional</b>'),(18,'944-5b3b0ddfd5c44','2018-07-07 01:32:13','Registro','Registro de Expediente Nro. <b>1471/1999</b>, Cliente: <b>BCO INTEGDEPCOOPLTDO </b>, Portada: <b>SINDICATURA DE LA QUIEBRA DEL BCO INTEGDEPCOOPLTDO C/ ECUARDO W FERNANDEZ Y OTRO S/EJEC  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Contravencional</b>'),(19,'944-5b3b0ddfd5c44','2018-07-07 01:33:35','Registro','Registro de Expediente Nro. <b>58137/2015</b>, Cliente: <b>Divorsio Maria y José</b>, Portada: <b>A.  --</b>, Dependencia: <b>Juzgado de Familia Nro. 1</b>'),(20,'944-5b3b0ddfd5c44','2018-07-07 01:34:47','Registro','Registro de Expediente Nro. <b>49864/2015 (EX 1128/2014)</b>, Cliente: <b>Divorsion Marta Medina</b>, Portada: <b>C.  --</b>, Dependencia: <b>Juzgado de Familia Nro. 1</b>'),(21,'944-5b3b0ddfd5c44','2018-07-07 01:36:28','Eliminación','Se ha eliminado el Expediente Nro. <b>276/2014 bis1/15</b>, Portada: <b>DEFILIPPI MARIA CELESTE C/MARCELINA GOMEZ S/INCIDENTE DE NULIDAD  Incidente de nulidad  GOMEZ MARCELINA C/MARIA CELESTE DEFILIPPI S/EJECUTIVO</b>, Dependencia: <b>Juzgado de Paz en lo Civil y Comercial Nro. 2</b>'),(22,'944-5b3b0ddfd5c44','2018-07-07 01:36:35','Eliminación','Se ha eliminado el Expediente Nro. <b>24438/2018</b>, Portada: <b>B.  -- DR/A. BALOVIER, CESAR SIMON --</b>, Dependencia: <b>JUZGADO DE FAMILIA Y VIOLENCIA FAMILIAR Nº 1</b>'),(23,'944-5b3b0ddfd5c44','2018-07-07 01:36:43','Eliminación','Se ha eliminado el Expediente Nro. <b>17114/2018</b>, Portada: <b>G.  -- DR/A. CRISTALDO, JULIO CESAR --  DR/A. RIEGER, DORA BEATRIZ --</b>, Dependencia: <b>JUZGADO DE FAMILIA Y VIOLENCIA FAMILIAR Nº 1</b>'),(24,'944-5b3b0ddfd5c44','2018-07-07 20:21:39','Eliminación','Se ha eliminado el Expediente Nro. <b>1471/1999</b>, Cliente: <b>BCO INTEGDEPCOOPLTDO </b>,  Portada: <b>SINDICATURA DE LA QUIEBRA DEL BCO INTEGDEPCOOPLTDO C/ ECUARDO W FERNANDEZ Y OTRO S/EJEC  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz en lo Contravencional</b>'),(25,'944-5b3b0ddfd5c44','2018-07-08 14:14:00','Registro','Registro de Expediente Nro. <b>18438/2018 bis1/18</b>, Cliente: <b>Yurakosky Marcelo</b>, Portada: <b>YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/BENEFICIO DE LITIGAR SIN GASTOS  Beneficio de litigar sin gastos  YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/DAOS Y PERJUICIOS  DAOS Y PERJUICIOS  184382018</b>, Dependencia: <b>JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle</b>'),(26,'944-5b3b0ddfd5c44','2018-07-08 14:48:50','Eliminación','Se ha eliminado el Expediente Nro. <b>18438/2018 bis1/18</b>, Cliente: <b>Yurakosky Marcelo</b>,  Portada: <b>YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/BENEFICIO DE LITIGAR SIN GASTOS  Beneficio de litigar sin gastos  YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/DAOS Y PERJUICIOS  DAOS Y PERJUICIOS  184382018</b>, Dependencia: <b>JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle</b>'),(27,'944-5b3b0ddfd5c44','2018-07-08 14:49:55','Registro','Registro de Expediente Nro. <b>18438/2018</b>, Cliente: <b>Yurakosky Marcelo</b>, Portada: <b>YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/BENEFICIO DE LITIGAR SIN GASTOS  Beneficio de litigar sin gastos  YURAKOSKI MARCELO FABIAN Y OTROS C/ LASCAROW ROBERTO ARIEL Y OTROS S/DAOS Y PERJUICIOS  DAOS Y PERJUICIOS  184382018</b>, Dependencia: <b>JUZGADO CIVIL Y COMERCIAL Y LABORAL Y DE FAMILIA Nº 1 - Aristobulo del Valle</b>'),(28,'944-5b3b0ddfd5c44','2018-07-19 18:04:41','Actualización','Sorely Rodriguez ha actualziado los datos de Sorely Rodriguez en el sistema.'),(29,'944-5b3b0ddfd5c44','2018-07-23 07:21:14','Eliminación','Sorely Rodriguez ha eliminado al usuario  del sistema.'),(30,'805-5b55b905eb6cc','2018-07-24 17:10:47','Registro','Registro de Expediente Nro. <b>39388/2017</b>, Cliente: <b>nombre de cliente</b>, Portada: <b>DE JESUS MARIO ALBERTO pshm DADJ  y Otro/a   S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 3</b>'),(31,'805-5b55b905eb6cc','2018-07-29 14:08:35','Registro','Registro de Expediente Nro. <b>28413/2017</b>, Cliente: <b>marta</b>, Portada: <b>CARSA SAC/ORTEGA JORGE ENRIQUE S/EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz de Itaembe Mini</b>'),(32,'805-5b55b905eb6cc','2018-07-29 14:22:20','Eliminación','Se ha eliminado el Expediente Nro. <b>28413/2017</b>, Cliente: <b>marta</b>,  Portada: <b>CARSA SAC/ORTEGA JORGE ENRIQUE S/EJECUTIVO  Ejecutivo</b>, Dependencia: <b>Juzgado de Paz de Itaembe Mini</b>'),(33,'629-5b692cd5ceb6f','2018-08-08 02:34:40','Registro','Registro de Expediente Nro. <b>71809/2017</b>, Cliente: <b> ACOSTA CRISTINA Y VILLALBA DANIEL</b>, Portada: <b>A.  -- DR/A. LEIVA, CLAUDIA CAROLINA --</b>, Dependencia: <b>Juzgado de Familia Nro. 1</b>'),(34,'629-5b692cd5ceb6f','2018-08-08 03:00:43','Registro','Registro de Expediente Nro. <b>51042/2016</b>, Cliente: <b>Castillo Carina Patricia c/ Flemanti Angelo</b>, Portada: <b>C.  -- DR/A. ACOSTA, NESTOR GUSTAVO --  DR/A. LEIVA, CLAUDIA CAROLINA --  DR/A. RODRIGUEZ, LEANDRO SEBASTIAN --</b>, Dependencia: <b>Juzgado de Familia Nro. 1</b>'),(35,'629-5b692cd5ceb6f','2018-08-08 03:06:26','Registro','Registro de Expediente Nro. <b>318/2006  </b>, Cliente: <b>COSTA VICENTE MANUEL HUMBERTO C/ CABRERA VERONICA MIRIAM</b>, Portada: <b>COSTA VICENTE MANUEL HUMBERTO C/ CABRERA VERONICA MIRIAM</b>, Dependencia: <b>Pendiente</b>'),(36,'629-5b692cd5ceb6f','2018-08-08 03:18:23','Registro','Registro de Expediente Nro. <b>3698/2010</b>, Cliente: <b> FERLONI Y PERONI</b>, Portada: <b>F.  -- DR/A. LEIVA, CLAUDIA CAROLINA --  DR/A. Barrionuevo Mantaras, Griselda Beatriz --</b>, Dependencia: <b>Juzgado de Familia Nro. 1</b>'),(37,'629-5b692cd5ceb6f','2018-08-08 03:26:19','Registro','Registro de Expediente Nro. <b>956/2012</b>, Cliente: <b>Zeppe Tatiana Muriel p.s.h.m. ZLV c/ Smeller Antonio Revino</b>, Portada: <b>Z.  -- DR/A. CROUX, FERNANDA ALEJANDRA --</b>, Dependencia: <b>Juzgado de Familia Nro. 1 - OBERA</b>'),(38,'629-5b692cd5ceb6f','2018-08-08 03:27:43','Registro','Registro de Expediente Nro. <b>9227/2014</b>, Cliente: <b>PRATS MORETO JUAN P.P.M B.R.F</b>, Portada: <b>P.  -- DR/A. LEIVA, CLAUDIA CAROLINA --</b>, Dependencia: <b>Juzgado Civil y Comercial, Laboral y de Familia - IGUAZU</b>'),(39,'629-5b692cd5ceb6f','2018-08-08 03:30:16','Registro','Registro de Expediente Nro. <b>6010/2014</b>, Cliente: <b>PICOS </b>, Portada: <b>PICOS MYRIAN LUCILA   y Otro/a   S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 6</b>'),(40,'629-5b692cd5ceb6f','2018-08-08 03:31:14','Registro','Registro de Expediente Nro. <b>123312/2015</b>, Cliente: <b>Comoglio Virginia</b>, Portada: <b>COMOGLIO VIRGINIA SOLEDAD     S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 5</b>'),(41,'629-5b692cd5ceb6f','2018-08-08 03:35:02','Registro','Registro de Expediente Nro. <b>28882/2015</b>, Cliente: <b>Fzap Mammroch</b>, Portada: <b>FZAP MAMMROCH MIGUEL     S/ Beneficio de litigar sin gastos  Beneficio de litigar sin gastos  FZAP MAMMROCH MIGUEL C/ FZAP SUAREZ ANDREA RAQUEL S/ Revocacin de donacin Conexidad Solicitada en autos 12645/2014  FZAP MAMMROCH MIGUEL     S/ Prueba Anticipada  Revocacin de la Donacion  288822015</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 4</b>'),(42,'629-5b692cd5ceb6f','2018-08-08 03:38:14','Registro','Registro de Expediente Nro. <b>70287/2015</b>, Cliente: <b>Humada</b>, Portada: <b>HUMADA JULIO CESAR   S/ Sucesorio  Sucesorio</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 2</b>'),(43,'629-5b692cd5ceb6f','2018-08-08 03:39:44','Registro','Registro de Expediente Nro. <b>1274/2010</b>, Cliente: <b>Alcumbre</b>, Portada: <b>CAMARGO RAMON OSCAR   C/ ALCULUMBRE RAQUEL ROSANA   Y OTRO/A S/ EJECUCIóN DE HONORARIOS</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 7</b>'),(44,'629-5b692cd5ceb6f','2018-08-08 03:42:27','Registro','Registro de Expediente Nro. <b>9159/2012</b>, Cliente: <b>LANZIANI</b>, Portada: <b>LANZIANI SERGIO ENZO   C/ LANZIANI SA   S/ Ejecucin Hipotecaria  Ejecucin Hipotecaria</b>, Dependencia: <b>Juzgado Civil y Comercial Nro. 8</b>'),(45,'629-5b692cd5ceb6f','2018-08-13 09:53:56','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribia en el sistema.'),(46,'629-5b692cd5ceb6f','2018-08-14 15:15:02','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribia en el sistema.'),(47,'629-5b692cd5ceb6f','2018-08-14 15:15:10','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribias en el sistema.'),(48,'629-5b692cd5ceb6f','2018-08-14 15:15:29','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribia en el sistema.'),(49,'629-5b692cd5ceb6f','2018-08-15 16:18:21','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribias en el sistema.'),(50,'629-5b692cd5ceb6f','2018-08-15 16:18:30','Actualización','Alex Javier Caicedo Porras ha actualizado los datos de Matias Estigarribia en el sistema.');
/*!40000 ALTER TABLE `movimientos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `novedades`
--

DROP TABLE IF EXISTS `novedades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `novedades` (
  `idNovedad` int(255) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `para` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `info` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idNovedad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `novedades`
--

LOCK TABLES `novedades` WRITE;
/*!40000 ALTER TABLE `novedades` DISABLE KEYS */;
INSERT INTO `novedades` VALUES (1,'2018-08-07 03:23:06','all','pago','Los pagos ahora serán el día de su registro'),(2,'2018-08-07 18:06:09','All','novedad','<p><b>NOVEDAD:</b> Próximamente se estarán habilitando los pagos mediante transferencia bancaria, Trueley pensando en su comodidad y Seguridad.</p>'),(4,'2018-08-07 18:21:15','629-5b692cd5ceb6f','novedad','<p>Muestra de novedad Privada</p>');
/*!40000 ALTER TABLE `novedades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `numeros`
--

DROP TABLE IF EXISTS `numeros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `numeros` (
  `idNumeros` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `expedientes` int(255) DEFAULT NULL,
  `despachados` int(255) DEFAULT NULL,
  `pendientes` int(255) DEFAULT NULL,
  `eliminados` int(255) DEFAULT NULL,
  `abogados` int(255) DEFAULT NULL,
  PRIMARY KEY (`idNumeros`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `numeros_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `numeros`
--

LOCK TABLES `numeros` WRITE;
/*!40000 ALTER TABLE `numeros` DISABLE KEYS */;
INSERT INTO `numeros` VALUES (1,'944-5b3b0ddfd5c44',3,3,0,0,1),(10,'805-5b55b905eb6cc',1,1,0,0,1),(20,'629-5b692cd5ceb6f',12,11,1,0,1),(21,'161-5b6a78d94721c',0,0,0,0,1);
/*!40000 ALTER TABLE `numeros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagos`
--

DROP TABLE IF EXISTS `pagos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagos` (
  `idPago` int(255) NOT NULL AUTO_INCREMENT,
  `fechapago` datetime DEFAULT NULL,
  `diapago` int(2) DEFAULT NULL,
  `mespago` int(2) DEFAULT NULL,
  `anopago` int(4) DEFAULT NULL,
  `cliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` decimal(20,2) DEFAULT NULL,
  `referencia` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pasarela` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `validacion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPago`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagos`
--

LOCK TABLES `pagos` WRITE;
/*!40000 ALTER TABLE `pagos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagosmp`
--

DROP TABLE IF EXISTS `pagosmp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagosmp` (
  `idPago` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'id del pago',
  `fechareg` datetime DEFAULT NULL COMMENT 'fecha de registro del pago',
  `fechaupdate` datetime DEFAULT NULL COMMENT 'fecha de actualziacion de estado del pago',
  `fechaapproval` datetime DEFAULT NULL COMMENT 'fecha de aprovación del pago',
  `clientmpid` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'id de cliente en mercadopago',
  `clientname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'nombre del cliente en mercadopago',
  `clientphone` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'telefono dle cliente en mercadopago',
  `clientdni` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'dni del cliente en mercadopago',
  `clientemail` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'email del cliente en mercadopago',
  `nickname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'apodo del cliente asignado por mercadopago',
  `plan` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'plan cancelado en mercadopago',
  `moneda` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'tipo de moneda del pago',
  `monto` decimal(20,2) DEFAULT NULL COMMENT 'monto del cobro',
  `receive` decimal(20,2) DEFAULT NULL COMMENT 'monto que recibirá en mercadopago',
  `status` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'estatus reportado por mercadopago',
  `status_detail` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'detalle del pago reportado por mercadopago',
  `payment_type` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'forma de pago',
  `cardholder` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'datos del tarjetahabiente que cancela',
  PRIMARY KEY (`idPago`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `pagosmp_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagosmp`
--

LOCK TABLES `pagosmp` WRITE;
/*!40000 ALTER TABLE `pagosmp` DISABLE KEYS */;
INSERT INTO `pagosmp` VALUES (16,'629-5b692cd5ceb6f','4021186196','2018-08-07 02:25:07','2018-08-07 02:25:07','2018-08-07 02:25:07','185352943','matias matias','376-4458790','DNI-36407654','matias.estigarribia2112@gmail.com','ESMA292958','PL-5b6280664c210','ARS',2.00,1.89,'in_process','offline_process','credit_card','{\"name\":\"Matias estigarribia\",\"identification\":{\"number\":\"36407654\",\"type\":\"DNI\"}}');
/*!40000 ALTER TABLE `pagosmp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfil`
--

DROP TABLE IF EXISTS `perfil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `perfil` (
  `idPerfil` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechapago` datetime DEFAULT NULL,
  `proximopago` datetime DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipocliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPerfil`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `perfil_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfil`
--

LOCK TABLES `perfil` WRITE;
/*!40000 ALTER TABLE `perfil` DISABLE KEYS */;
/*!40000 ALTER TABLE `perfil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planes`
--

DROP TABLE IF EXISTS `planes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planes` (
  `idPlan` int(255) NOT NULL AUTO_INCREMENT,
  `codplan` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechareg` datetime NOT NULL,
  `fechamod` datetime DEFAULT NULL,
  `usuarioreg` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuariomod` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreplan` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `registroplan` int(255) DEFAULT '0',
  `limiteplan` int(255) DEFAULT '0',
  `costodolar` decimal(20,2) DEFAULT '0.00',
  `costopeso` decimal(20,2) DEFAULT '0.00',
  `estatus` tinyint(1) DEFAULT NULL,
  `boton` longtext COLLATE utf8_spanish_ci,
  `features` varchar(3000) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idPlan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planes`
--

LOCK TABLES `planes` WRITE;
/*!40000 ALTER TABLE `planes` DISABLE KEYS */;
INSERT INTO `planes` VALUES (4,'PL-5b4900c8a4cab','2018-07-13 15:43:04','2018-07-13 15:43:04','Carlos Quintero','Carlos Quintero','b&aacute;sico',4,1,0.00,650.00,1,'<a mp-mode=\"redirect\" href=\"http://mpago.la/jA8Y\" name=\"MP-payButton\" class=\'blue-ar-l-rn-none\'>Completar Suscripción</a>\r\n<script type=\"text/javascript\">\r\n    (function() {\r\n        function $MPC_load() {\r\n            window.$MPC_loaded !== true && (function() {\r\n                var s = document.createElement(\"script\");\r\n                s.type = \"text/javascript\";\r\n                s.async = true;\r\n                s.src = document.location.protocol + \"//secure.mlstatic.com/mptools/render.js\";\r\n                var x = document.getElementsByTagName(\'script\')[0];\r\n                x.parentNode.insertBefore(s, x);\r\n                window.$MPC_loaded = true;\r\n            })();\r\n        }\r\n        window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent(\'onload\', $MPC_load) : window.addEventListener(\'load\', $MPC_load, false)) : null;\r\n    })();\r\n</script>',NULL),(5,'PL-5b4946d5320ea','2018-07-13 20:41:57','2018-07-13 20:41:57','Carlos Quintero','Carlos Quintero','standard',0,5,0.00,850.00,1,'<a mp-mode=\"redirect\" href=\"http://mpago.la/5gsX\" name=\"MP-payButton\" class=\'blue-ar-l-rn-none\'>Completar Suscripción</a>\r\n<script type=\"text/javascript\">\r\n    (function() {\r\n        function $MPC_load() {\r\n            window.$MPC_loaded !== true && (function() {\r\n                var s = document.createElement(\"script\");\r\n                s.type = \"text/javascript\";\r\n                s.async = true;\r\n                s.src = document.location.protocol + \"//secure.mlstatic.com/mptools/render.js\";\r\n                var x = document.getElementsByTagName(\'script\')[0];\r\n                x.parentNode.insertBefore(s, x);\r\n                window.$MPC_loaded = true;\r\n            })();\r\n        }\r\n        window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent(\'onload\', $MPC_load) : window.addEventListener(\'load\', $MPC_load, false)) : null;\r\n    })();\r\n</script>',NULL),(6,'PL-5b56db05c9fb1','2018-07-24 04:53:41','2018-07-24 04:53:41','Carlos Quintero','Carlos Quintero','basic firmas',0,3,0.00,250.00,1,'<a mp-mode=\"redirect\" href=\"http://mpago.la/59Fx\" name=\"MP-payButton\" class=\'blue-ar-l-rn-none\'>Completar Suscripción</a>\r\n<script type=\"text/javascript\">\r\n    (function() {\r\n        function $MPC_load() {\r\n            window.$MPC_loaded !== true && (function() {\r\n                var s = document.createElement(\"script\");\r\n                s.type = \"text/javascript\";\r\n                s.async = true;\r\n                s.src = document.location.protocol + \"//secure.mlstatic.com/mptools/render.js\";\r\n                var x = document.getElementsByTagName(\'script\')[0];\r\n                x.parentNode.insertBefore(s, x);\r\n                window.$MPC_loaded = true;\r\n            })();\r\n        }\r\n        window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent(\'onload\', $MPC_load) : window.addEventListener(\'load\', $MPC_load, false)) : null;\r\n    })();\r\n</script>',NULL),(7,'PL-5b6280664c210','2018-08-02 00:54:14','2018-08-02 00:54:14','Admin','Admin','test real no usar',10,1,0.00,2.00,1,'<a mp-mode=\"redirect\" href=\"http://mpago.la/36kJHZ\" name=\"MP-payButton\" class=\'blue-ar-l-rn-none\'>Completar Suscripción</a>\r\n<script type=\"text/javascript\">\r\n    (function() {\r\n        function $MPC_load() {\r\n            window.$MPC_loaded !== true && (function() {\r\n                var s = document.createElement(\"script\");\r\n                s.type = \"text/javascript\";\r\n                s.async = true;\r\n                s.src = document.location.protocol + \"//secure.mlstatic.com/mptools/render.js\";\r\n                var x = document.getElementsByTagName(\'script\')[0];\r\n                x.parentNode.insertBefore(s, x);\r\n                window.$MPC_loaded = true;\r\n            })();\r\n        }\r\n        window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent(\'onload\', $MPC_load) : window.addEventListener(\'load\', $MPC_load, false)) : null;\r\n    })();\r\n</script>',NULL);
/*!40000 ALTER TABLE `planes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recuperaclaves`
--

DROP TABLE IF EXISTS `recuperaclaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recuperaclaves` (
  `idRecu` int(255) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `codigo` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `token` longtext COLLATE utf8_spanish_ci,
  `email` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estatus` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idRecu`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recuperaclaves`
--

LOCK TABLES `recuperaclaves` WRITE;
/*!40000 ALTER TABLE `recuperaclaves` DISABLE KEYS */;
INSERT INTO `recuperaclaves` VALUES (12,'2018-07-23 04:56:59','rec-5b558a4b27b8b-1532332619','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MzIzMzI2MTksImV4cCI6MTUzMjMzOTgxOSwiZXJyb3IiOmZhbHNlLCJhdWQiOiI3MzI2N2IxMmUzY2NiYzYzNTZhMWI0ZmIzZmUyYTFlZTNhYmVmYzY0IiwiZGF0YSI6eyJjb2RjbGllbnRlIjoiOTQ0LTViM2IwZGRmZDVjNDQiLCJ1c3VhcmlvIjoiaW5mby5meHN0dWRpb3NAZ21haWwuY29tIiwibm9tYnJlIjoiU29yZWx5IFJvZHJpZ3VleiIsImRvY3VtZW50byI6IjE0NjI0OTgyIiwiaWRpb21hIjoic3BhbmlzaCIsImZvdG8iOiIiLCJzaGEiOiI1ZjZiNzc1YTgzMjgxODQ3ZTg1ZGI4ZjE3ZmU1ZmQzN2U2ZGRmNzVmIiwiY29kaWdvIjoicmVjLTViNTU4YTRiMjdiOGItMTUzMjMzMjYxOSJ9fQ.5POY04wpLzxYtSm1L0Cb5WqMf_4JYU4MvDtEnANNZB4','info.fxstudios@gmail.com',1),(14,'2018-07-23 06:57:07','rec-5b55a67348c59-1532339827','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MzIzMzk4MjcsImV4cCI6MTUzMjM0NzAyNywiZXJyb3IiOmZhbHNlLCJhdWQiOiI3MzI2N2IxMmUzY2NiYzYzNTZhMWI0ZmIzZmUyYTFlZTNhYmVmYzY0IiwiZGF0YSI6eyJjb2RjbGllbnRlIjoiOTQ0LTViM2IwZGRmZDVjNDQiLCJ1c3VhcmlvIjoiaW5mby5meHN0dWRpb3NAZ21haWwuY29tIiwibm9tYnJlIjoiU29yZWx5IFJvZHJpZ3VleiIsImRvY3VtZW50byI6IjE0NjI0OTgyIiwiaWRpb21hIjoic3BhbmlzaCIsImZvdG8iOiIiLCJzaGEiOiI1ZjZiNzc1YTgzMjgxODQ3ZTg1ZGI4ZjE3ZmU1ZmQzN2U2ZGRmNzVmIiwiY29kaWdvIjoicmVjLTViNTVhNjczNDhjNTktMTUzMjMzOTgyNyJ9fQ.v2ZKThmK1VgrEbXNjH49JaFkFDyMm5Bbip30gql_CgI','10',1),(15,'2018-08-08 10:50:42','rec-5b6af532e1de4-1533736242','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1MzM3MzYyNDIsImV4cCI6MTUzMzc0MzQ0MiwiZXJyb3IiOmZhbHNlLCJhdWQiOiI4OGJiMmJkY2U3MGYzNWZmZTI2ZGY4ZWVmN2I3ZjJiNDdlNmVhZTQzIiwiZGF0YSI6eyJjb2RjbGllbnRlIjoiOTQ0LTViM2IwZGRmZDVjNDQiLCJ1c3VhcmlvIjoiaW5mby5meHN0dWRpb3NAZ21haWwuY29tIiwibm9tYnJlIjoiU29yZWx5IFJvZHJpZ3VleiIsImRvY3VtZW50byI6IjE0NjI0OTgyIiwiaWRpb21hIjoic3BhbmlzaCIsImZvdG8iOiIiLCJzaGEiOiI5ZDYxNzI5NDYwMDNjY2FkYjc2ZDQwZGVlY2U1NGQ4YTk5MGU4YTkwIiwiY29kaWdvIjoicmVjLTViNmFmNTMyZTFkZTQtMTUzMzczNjI0MiJ9fQ.WGADiBFPsz7E2zDiTkbtbWx_nIAZ1BmlU4c_iVuXz3I','info.fxstudios@gmail.com',1);
/*!40000 ALTER TABLE `recuperaclaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_proceso`
--

DROP TABLE IF EXISTS `tipo_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_proceso` (
  `idTipoproceso` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(3000) DEFAULT NULL,
  `codcliente` varchar(255) DEFAULT NULL,
  `estatus` varchar(20) DEFAULT NULL,
  `fechareg` date DEFAULT NULL,
  `fechamod` date DEFAULT NULL,
  PRIMARY KEY (`idTipoproceso`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_proceso`
--

LOCK TABLES `tipo_proceso` WRITE;
/*!40000 ALTER TABLE `tipo_proceso` DISABLE KEYS */;
INSERT INTO `tipo_proceso` VALUES (1,'Accidente de Trabajo (Art. 1113 C. Civil)','629-5b692cd5ceb6f','1','2018-08-14',NULL),(2,'Accidente de Trabajo (Ley 9.688)','629-5b692cd5ceb6f','1','2018-08-14',NULL),(3,'Acción confesoria','629-5b692cd5ceb6f','1','2018-08-14',NULL),(4,'Acción de Fraude (Art. 1298 C.Civil)','629-5b692cd5ceb6f','1','2018-08-14',NULL),(5,'Acción de Inconstitucionalidad','629-5b692cd5ceb6f','1','2018-08-14',NULL),(6,'Acción de Nulidad','629-5b692cd5ceb6f','1','2018-08-14',NULL),(7,'Acción de Reducción','629-5b692cd5ceb6f','1','2018-08-14',NULL),(8,'Acción Declarativa (Art. 322 C.Civil)','629-5b692cd5ceb6f','1','2018-08-14',NULL),(9,'Acción Negatoria','629-5b692cd5ceb6f','1','2018-08-14',NULL),(10,'Acción Posesoria','629-5b692cd5ceb6f','1','2018-08-14',NULL),(11,'Acción Reivindicatoria','629-5b692cd5ceb6f','1','2018-08-14',NULL),(12,'Acción Subrogatoria','629-5b692cd5ceb6f','1','2018-08-14',NULL),(13,'Acreditación de Vínculo','629-5b692cd5ceb6f','1','2018-08-14',NULL),(14,'Actualización de Legado','629-5b692cd5ceb6f','1','2018-08-14',NULL),(15,'Administración de Bienes','629-5b692cd5ceb6f','1','2018-08-14',NULL),(16,'Adopción','629-5b692cd5ceb6f','1','2018-08-14',NULL),(17,'Afectación al Régimen de la Ley 19.724','629-5b692cd5ceb6f','1','2018-08-14',NULL),(18,'Alimentos','629-5b692cd5ceb6f','1','2018-08-14',NULL),(19,'Alimentos y Litis Expensas','629-5b692cd5ceb6f','1','2018-08-14',NULL),(20,'Alimentos y tenencia','629-5b692cd5ceb6f','1','2018-08-14',NULL),(21,'Alimentos: aumento y cese de cuota','629-5b692cd5ceb6f','1','2018-08-14',NULL),(22,'Amparo','629-5b692cd5ceb6f','1','2018-08-14',NULL),(23,'Apelación','629-5b692cd5ceb6f','1','2018-08-14',NULL),(24,'Apremio','629-5b692cd5ceb6f','1','2018-08-14',NULL),(25,'Aseguramiento de Bienes','629-5b692cd5ceb6f','1','2018-08-14',NULL),(26,'Asesoramiento','629-5b692cd5ceb6f','1','2018-08-14',NULL);
/*!40000 ALTER TABLE `tipo_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `totales`
--

DROP TABLE IF EXISTS `totales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `totales` (
  `idControl` int(255) NOT NULL AUTO_INCREMENT,
  `ano` varchar(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `mes` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` decimal(20,2) DEFAULT NULL,
  `receive` decimal(20,2) DEFAULT NULL,
  `pendin` decimal(20,2) DEFAULT NULL,
  PRIMARY KEY (`idControl`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `totales`
--

LOCK TABLES `totales` WRITE;
/*!40000 ALTER TABLE `totales` DISABLE KEYS */;
INSERT INTO `totales` VALUES (3,'2018','08',2.00,1.89,0.00);
/*!40000 ALTER TABLE `totales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(255) NOT NULL AUTO_INCREMENT,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `documento` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fechareg` datetime NOT NULL,
  `hash` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estatus` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idioma` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`idUsuario`) USING BTREE,
  KEY `cedula` (`documento`) USING BTREE,
  KEY `cedula_2` (`documento`) USING BTREE,
  KEY `codcliente` (`codcliente`) USING BTREE,
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`codcliente`) REFERENCES `clientes` (`codcliente`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (8,'home','a@a.com','$2y$10$msrQL9wEsapruHqriVHJbumtd.qZ8VEFkeveLczamIpHCN1eS9ca.','Admin','Admin','14624982','','2017-09-21 18:47:40','14624982','Active','spanish',1),(10,'944-5b3b0ddfd5c44','info.fxstudios@gmail.com','$2y$10$qadUw4XMm8tbdtuLqJ7hAu1DssjrBkL4TqF7jDf.evMYNdMMiAVR.','Client','Sorely Rodriguez','14624982','','2018-07-03 01:47:11','14624982','Active','spanish',1),(25,'805-5b55b905eb6cc','direccion@hitcel.com','$2y$10$uTUrb70ZnfPOvYk3vMPZ7OP8FmEsl0sDGAEtAbD/GncKgO1EaiaE2','Client','Cliente Demo','123456','','2018-07-23 08:16:21','4510172','Active','spanish',1),(26,'home','carlosquintero14624@gmail.com','$2y$10$L.6Y3zXrf4TjkNyFqWsQEO6grNRI06YSR6l0J94w2N6DRsEMHcoXm','Admin','Carlos Quintero','14186540','','2018-07-23 08:23:12','14624982','Active','spanish',1),(36,'629-5b692cd5ceb6f','matias.estigarribia2112@gmail.com','$2y$10$r6YhSjLinjWkUA63NnO3FeJ0bVNeuvErNnYTYoFWUua8kPPVz1XMy','Client','Matias Estigarribia','36407654','','2018-08-07 02:23:33','20300555','Active','spanish',1),(37,'161-5b6a78d94721c','guidohalley@hotmail.com','$2y$10$B4YPk2Q/dvh08QCQFKBNiOinuCex5luNWl52MJFQuLeDYyAKY9P.e','Client','Yamil Dario Halley','00000000','','2018-08-08 02:00:09','29454068','Active','spanish',1),(38,'629-5b692cd5ceb6f','acaicedoporras@gmail.com','$2y$10$JzQYKemULwf0yU4dHskpq.VRVasu9LlNeEyEIW5Is/Q973URNafxi','Client','Alex Javier Caicedo Porras','71044015','','2018-08-09 00:00:00','14624982','Active','spanish',1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `versiones`
--

DROP TABLE IF EXISTS `versiones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versiones` (
  `idVersion` int(255) NOT NULL AUTO_INCREMENT,
  `vcode` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vname` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `vprice` decimal(10,2) DEFAULT NULL,
  `voptions` longtext COLLATE utf8_spanish_ci,
  `vinstall` int(255) DEFAULT NULL,
  `vmodules` longtext COLLATE utf8_spanish_ci,
  PRIMARY KEY (`idVersion`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `versiones`
--

LOCK TABLES `versiones` WRITE;
/*!40000 ALTER TABLE `versiones` DISABLE KEYS */;
/*!40000 ALTER TABLE `versiones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vistas`
--

DROP TABLE IF EXISTS `vistas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vistas` (
  `idVista` int(255) NOT NULL AUTO_INCREMENT,
  `mensaje` int(255) DEFAULT NULL,
  `codcliente` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idVista`) USING BTREE,
  KEY `mensaje` (`mensaje`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vistas`
--

LOCK TABLES `vistas` WRITE;
/*!40000 ALTER TABLE `vistas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vistas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-17  1:29:30
