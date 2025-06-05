-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_backend
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `imagem` varchar(80) DEFAULT NULL,
  `cpf` char(14) DEFAULT NULL,
  `email` char(100) DEFAULT NULL,
  `whatsapp` char(16) DEFAULT NULL,
  `logradouro` char(150) NOT NULL,
  `numero` char(20) NOT NULL,
  `complemento` char(40) NOT NULL,
  `bairro` char(40) NOT NULL,
  `cidade` char(30) NOT NULL,
  `cep` char(9) NOT NULL,
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (2,'Bruno Marques Lobo',NULL,'18',NULL,NULL,'Rua adélia david santos','158','','','Taubaté','12051-447',NULL),(3,'mariano lopes',NULL,'18',NULL,NULL,'Rua adélia david santos','158','','','Taubaté','12051-447',NULL),(4,'Ana Maria Braga',NULL,'80',NULL,NULL,'Rua do Sol','101','','Leblon','Rio de Janeiro','34567-890',NULL),(5,'João Silva',NULL,'25',NULL,NULL,'Rua das Palmeiras','45','Apto 101','Centro','São Paulo','01001-000',NULL),(6,'Maria Oliveira',NULL,'30',NULL,NULL,'Avenida Brasil','500','','Jardim América','Rio de Janeiro','20031-000',NULL),(7,'Carlos Pereira',NULL,'40',NULL,NULL,'Rua das Acácias','78','','Bela Vista','Curitiba','80010-000',NULL),(8,'Ana Costa',NULL,'35',NULL,NULL,'Rua do Comércio','120','Bloco B','Centro','Belo Horizonte','30110-000',NULL),(9,'Pedro Santos',NULL,'28',NULL,NULL,'Rua das Laranjeiras','90','','Jardim Botânico','Porto Alegre','90010-000',NULL),(10,'Fernanda Lima',NULL,'22',NULL,NULL,'Rua das Rosas','15','','Vila Mariana','São Paulo','04001-000',NULL),(11,'RICARDO',NULL,'23',NULL,NULL,'Rua eusebio marcondes','123','casa','Centro','Taubaté','SP','12'),(13,'sampo',NULL,'15',NULL,NULL,'Rua do Comércio','20','Bloco c','Centro','Belo Horizonte','39110-000',NULL),(15,'mike','57a0eeb8371893e48459d99aa146e476.jpg','987.287.987-79','ewrewjrekw@kfjnsne.com','(16) 5 4654-2512','Rua José Cândido Vítor','11','djsdnoj','Residencial Paraíso','Taubaté','12090-802','SP');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fornecedores` (
  `id_fornecedor` int(11) NOT NULL AUTO_INCREMENT,
  `razao_social` char(100) DEFAULT NULL,
  `cnpj` char(18) DEFAULT NULL,
  `telefone` char(14) DEFAULT NULL,
  `email` char(100) NOT NULL,
  `logradouro` char(150) DEFAULT NULL,
  `numero` char(20) DEFAULT NULL,
  `complemento` char(40) DEFAULT NULL,
  `bairro` char(40) DEFAULT NULL,
  `cidade` char(40) DEFAULT NULL,
  `cep` char(9) DEFAULT NULL,
  `estado` char(2) DEFAULT NULL,
  PRIMARY KEY (`id_fornecedor`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fornecedores`
--

LOCK TABLES `fornecedores` WRITE;
/*!40000 ALTER TABLE `fornecedores` DISABLE KEYS */;
INSERT INTO `fornecedores` VALUES (3,'gbdffhdh','05.654.106/4605-4','(54) 65401-243','4164kgfpj@jg.com','Rua José Cândido Vítor','20','dfwfw','Residencial Paraíso','Taubaté',NULL,'SP');
/*!40000 ALTER TABLE `fornecedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marcas`
--

DROP TABLE IF EXISTS `marcas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL AUTO_INCREMENT,
  `marca` char(40) DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marcas`
--

LOCK TABLES `marcas` WRITE;
/*!40000 ALTER TABLE `marcas` DISABLE KEYS */;
INSERT INTO `marcas` VALUES (1,'cerura'),(2,'qualquer'),(3,'vzin');
/*!40000 ALTER TABLE `marcas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `produto` char(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `id_marca` int(11) DEFAULT NULL,
  `imagem` char(80) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `preco` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`id_produto`),
  KEY `id_marca` (`id_marca`),
  CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (6,'teste','nokia',1,'e3b485d616daf5cd46d0dcc33d20ae09.png',9,22.30),(7,'sampinho','cghcvg',2,'20057e50d3780dda045ed63e9381f2ce.webp',657467,1244.00),(8,'nghfjgffgj','vhff',1,'69ba82101a51e47af800eccd7fd4f211.png',20,1244.00),(9,'sampinho','um cafe quentin',2,'00d63c7818e6e075f12f649dd781d4c0.png',23,1.00);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `senha` varchar(80) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Glauco Luiz','glauco@senac.com.br','7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),(3,'mike','mike@adm.com','40bd001563085fc35165329ea1ff5c5ecbdbbeef'),(4,'mike','mikezin@adm.com','8cb2237d0679ca88db6464eac60da96345513964');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-05 17:10:28
