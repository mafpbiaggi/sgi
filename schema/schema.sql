/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.2.2-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: db_sgi
-- ------------------------------------------------------
-- Server version	12.2.2-MariaDB-ubu2404

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `ata_arquivos`
--

DROP TABLE IF EXISTS `ata_arquivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ata_arquivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ata_id` int(11) DEFAULT NULL,
  `nome` varchar(60) DEFAULT NULL,
  `dataupload` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela Responsavel por armazenar os arquivos das atas e rela';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ata_arquivos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `ata_arquivos` WRITE;
/*!40000 ALTER TABLE `ata_arquivos` DISABLE KEYS */;
/*!40000 ALTER TABLE `ata_arquivos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `atas`
--

DROP TABLE IF EXISTS `atas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `atas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Todas as Atas do Sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `atas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `atas` WRITE;
/*!40000 ALTER TABLE `atas` DISABLE KEYS */;
/*!40000 ALTER TABLE `atas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `autores`
--

DROP TABLE IF EXISTS `autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `autores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de autores da biblioteca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autores`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `autores` WRITE;
/*!40000 ALTER TABLE `autores` DISABLE KEYS */;
/*!40000 ALTER TABLE `autores` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `bens`
--

DROP TABLE IF EXISTS `bens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `bens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL DEFAULT '0',
  `identificacao` varchar(100) DEFAULT NULL,
  `num_serie` varchar(100) DEFAULT NULL,
  `num_ativo` varchar(100) DEFAULT NULL,
  `garantia` varchar(100) DEFAULT NULL,
  `descricao` varchar(150) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `data_compra` date DEFAULT NULL,
  `valor_unitario` decimal(18,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `departamento_id` int(11) DEFAULT NULL,
  `congregacao_id` int(11) DEFAULT NULL,
  `membro_id` int(11) DEFAULT NULL,
  `tipo_bem_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Bens do sistema.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `bens` WRITE;
/*!40000 ALTER TABLE `bens` DISABLE KEYS */;
/*!40000 ALTER TABLE `bens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `calendarios`
--

DROP TABLE IF EXISTS `calendarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `calendarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `datainicio` datetime DEFAULT NULL,
  `assunto` varchar(50) DEFAULT NULL,
  `datafim` datetime DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `diatodo` int(11) DEFAULT NULL,
  `cor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela para guardar os eventos da igreja';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendarios`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `calendarios` WRITE;
/*!40000 ALTER TABLE `calendarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendarios` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cargos`
--

DROP TABLE IF EXISTS `cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` varchar(45) DEFAULT NULL,
  `modified` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Cargos do sistema.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cargos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cargos` WRITE;
/*!40000 ALTER TABLE `cargos` DISABLE KEYS */;
/*!40000 ALTER TABLE `cargos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `cascades`
--

DROP TABLE IF EXISTS `cascades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cascades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_de` varchar(150) DEFAULT '0',
  `controller_de` varchar(150) DEFAULT '0',
  `action_de` varchar(150) DEFAULT '0',
  `plugin_para` varchar(150) DEFAULT '0',
  `controller_para` varchar(150) DEFAULT '0',
  `action_para` varchar(150) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cascades`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `cascades` WRITE;
/*!40000 ALTER TABLE `cascades` DISABLE KEYS */;
/*!40000 ALTER TABLE `cascades` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='Cadastro de editoras da biblioteca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `churchs`
--

DROP TABLE IF EXISTS `churchs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `churchs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `numero` varchar(5) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `matriz_id` varchar(5) DEFAULT NULL,
  `tipo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro das igrejas no sistema. ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `churchs`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `churchs` WRITE;
/*!40000 ALTER TABLE `churchs` DISABLE KEYS */;
INSERT INTO `churchs` VALUES
(1,'Master',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `churchs` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `congregacao_enderecos`
--

DROP TABLE IF EXISTS `congregacao_enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `congregacao_enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(70) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(70) DEFAULT NULL,
  `bairro` varchar(45) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `estado_id` varchar(2) NOT NULL,
  `congregacao_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Endereços';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `congregacao_enderecos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `congregacao_enderecos` WRITE;
/*!40000 ALTER TABLE `congregacao_enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `congregacao_enderecos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `congregacaos`
--

DROP TABLE IF EXISTS `congregacaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `congregacaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela que armazena as informações de todas as congregações.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `congregacaos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `congregacaos` WRITE;
/*!40000 ALTER TABLE `congregacaos` DISABLE KEYS */;
/*!40000 ALTER TABLE `congregacaos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `contatos`
--

DROP TABLE IF EXISTS `contatos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contatos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `congregacao_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Armazena contatos das congregações';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `contatos` WRITE;
/*!40000 ALTER TABLE `contatos` DISABLE KEYS */;
/*!40000 ALTER TABLE `contatos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `departamentos`
--

DROP TABLE IF EXISTS `departamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` text DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Departamentos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departamentos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `departamentos` WRITE;
/*!40000 ALTER TABLE `departamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `departamentos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `dons`
--

DROP TABLE IF EXISTS `dons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `dons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  `observacoes` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Dons';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dons`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `dons` WRITE;
/*!40000 ALTER TABLE `dons` DISABLE KEYS */;
/*!40000 ALTER TABLE `dons` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `editoras`
--

DROP TABLE IF EXISTS `editoras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `editoras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='Cadastro de categorias da biblioteca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editoras`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `editoras` WRITE;
/*!40000 ALTER TABLE `editoras` DISABLE KEYS */;
/*!40000 ALTER TABLE `editoras` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `enderecos`
--

DROP TABLE IF EXISTS `enderecos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(70) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `complemento` varchar(70) DEFAULT NULL,
  `bairro` varchar(45) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `membro_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Endereços';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enderecos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `enderecos` WRITE;
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `escolaridades`
--

DROP TABLE IF EXISTS `escolaridades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `escolaridades` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '	',
  `descricao` varchar(100) DEFAULT NULL,
  `obs` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Escolaridade';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `escolaridades`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `escolaridades` WRITE;
/*!40000 ALTER TABLE `escolaridades` DISABLE KEYS */;
/*!40000 ALTER TABLE `escolaridades` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `estados`
--

DROP TABLE IF EXISTS `estados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(2) DEFAULT NULL,
  `codibge` int(11) DEFAULT NULL,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_uca1400_ai_ci COMMENT='Tabela com código, sigla e nome dos estados do Brasil';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `estados` WRITE;
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` VALUES
(1,'AC',12,'Acre'),
(2,'AL',27,'Alagoas'),
(3,'AM',13,'Amazonas'),
(4,'AP',16,'Amapá'),
(5,'BA',29,'Bahia'),
(6,'CE',23,'Ceará'),
(7,'DF',53,'Distrito Federal'),
(8,'ES',32,'Espírito Santo'),
(9,'GO',52,'Goiás'),
(10,'MA',21,'Maranhão'),
(11,'MG',31,'Minas Gerais'),
(12,'MS',50,'Mato Grosso do Sul'),
(13,'MT',51,'Mato Grosso'),
(14,'PA',15,'Pará'),
(15,'PB',25,'Paraíba'),
(16,'PE',26,'Pernambuco'),
(17,'PI',22,'Piauí'),
(18,'PR',41,'Paraná'),
(19,'RJ',33,'Rio de Janeiro'),
(20,'RN',24,'Rio Grande do Norte'),
(21,'RO',11,'Rondônia'),
(22,'RR',14,'Roraima'),
(23,'RS',43,'Rio Grande do Sul'),
(24,'SC',42,'Santa Catarina'),
(25,'SE',28,'Sergipe'),
(26,'SP',35,'São Paulo'),
(27,'TO',17,'Tocantis');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `itens`
--

DROP TABLE IF EXISTS `itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isbn` varchar(50) DEFAULT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `foto` varchar(150) DEFAULT NULL,
  `paginas` int(11) DEFAULT NULL,
  `preco` decimal(18,2) DEFAULT NULL,
  `comentarios` text DEFAULT NULL,
  `estoque` int(11) DEFAULT NULL,
  `autor_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `editora_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de itens da biblioteca (livros, cds, dvds, etc)';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `itens` WRITE;
/*!40000 ALTER TABLE `itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `itens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `membro_cargos`
--

DROP TABLE IF EXISTS `membro_cargos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `membro_cargos` (
  `id` int(11) NOT NULL,
  `membro_id` int(11) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela que relaciona os cargos com os membros. Ela é editada';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membro_cargos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `membro_cargos` WRITE;
/*!40000 ALTER TABLE `membro_cargos` DISABLE KEYS */;
/*!40000 ALTER TABLE `membro_cargos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `membros`
--

DROP TABLE IF EXISTS `membros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `membros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ativo` int(11) NOT NULL DEFAULT 1,
  `disciplina` int(11) DEFAULT NULL,
  `motivodemissao` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `sexo` int(11) DEFAULT NULL,
  `datanascimento` date DEFAULT NULL,
  `datacasamento` date DEFAULT NULL,
  `naturalidade` varchar(100) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `estadocivil` int(11) DEFAULT NULL,
  `nomeconjuge` varchar(100) DEFAULT NULL,
  `nomepai` varchar(100) DEFAULT NULL,
  `nomemae` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `cpf` varchar(20) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `fone` varchar(20) DEFAULT NULL,
  `fone2` varchar(20) DEFAULT NULL,
  `cel` varchar(20) DEFAULT NULL,
  `escolaridade_id` int(11) DEFAULT NULL,
  `profissao_id` int(11) DEFAULT NULL,
  `empresa` varchar(150) DEFAULT NULL,
  `batizado` int(11) DEFAULT NULL,
  `databatismo` date DEFAULT NULL,
  `profissaofe` int(11) DEFAULT NULL,
  `dataprofe` date DEFAULT NULL,
  `igrejabatismo` varchar(100) DEFAULT NULL,
  `pastorbatismo` varchar(100) DEFAULT NULL,
  `igrejaprofe` varchar(100) DEFAULT NULL,
  `pastorprofe` varchar(100) DEFAULT NULL,
  `areainteresse` text DEFAULT NULL,
  `ultimaigreja` varchar(100) DEFAULT NULL,
  `datamembro` date DEFAULT NULL,
  `meioadmissao` int(11) DEFAULT NULL,
  `igrejasanteriores` text DEFAULT NULL,
  `foto_caminho` varchar(255) DEFAULT NULL,
  `foto_exibicao` varchar(255) DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `tipo` enum('Membro','Visitante') DEFAULT NULL COMMENT 'Tipo de cadastro. 1 => Membro, 2 => Visitante',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de membros';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membros`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `membros` WRITE;
/*!40000 ALTER TABLE `membros` DISABLE KEYS */;
/*!40000 ALTER TABLE `membros` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `movimentacao_bens`
--

DROP TABLE IF EXISTS `movimentacao_bens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimentacao_bens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` int(11) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `motivo` varchar(50) DEFAULT NULL,
  `bem_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabela que armazena o histórico de movimentação dos bens';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacao_bens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `movimentacao_bens` WRITE;
/*!40000 ALTER TABLE `movimentacao_bens` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimentacao_bens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `movimentacao_itens`
--

DROP TABLE IF EXISTS `movimentacao_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimentacao_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade` int(11) DEFAULT NULL,
  `devolvido` int(11) NOT NULL DEFAULT 0,
  `membro_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='Tabela que armazena o histórico de empréstimo dos itens da biblioteca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacao_itens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `movimentacao_itens` WRITE;
/*!40000 ALTER TABLE `movimentacao_itens` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimentacao_itens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `movimentacaoatas`
--

DROP TABLE IF EXISTS `movimentacaoatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `movimentacaoatas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo_id` int(11) DEFAULT NULL,
  `membro_id` int(11) DEFAULT NULL,
  `ata_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Armazena a movimentação de cargos de acordo com as atas lanç';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movimentacaoatas`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `movimentacaoatas` WRITE;
/*!40000 ALTER TABLE `movimentacaoatas` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimentacaoatas` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `permissao_padraos`
--

DROP TABLE IF EXISTS `permissao_padraos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissao_padraos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin` varchar(150) DEFAULT NULL,
  `controller` varchar(150) DEFAULT NULL,
  `action` varchar(150) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `allowed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao_padraos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `permissao_padraos` WRITE;
/*!40000 ALTER TABLE `permissao_padraos` DISABLE KEYS */;
INSERT INTO `permissao_padraos` VALUES
(1,'','Users','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(2,'','Users','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(3,'','Users','addUser','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(4,'','Users','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(5,'','Users','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(6,'','Users','permissao_padrao','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(7,'Biblioteca','Itens','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(8,'Biblioteca','Itens','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(9,'Biblioteca','Itens','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(10,'Biblioteca','Itens','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(11,'Biblioteca','Itens','consulta','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(12,'Biblioteca','Itens','emprestimo','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(13,'Biblioteca','Itens','devolucao','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(14,'Biblioteca','Itens','historico','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(15,'Biblioteca','Relatorios','itens','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(16,'Biblioteca','Relatorios','emprestimos','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(17,'Patrimonio','Bens','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(18,'Patrimonio','Bens','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(19,'Patrimonio','Bens','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(20,'Patrimonio','Bens','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(21,'Patrimonio','Bens','movimentar','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(22,'Patrimonio','Relatorios','bens','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(23,'Patrimonio','Relatorios','movimentacao_bens','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(24,'Secretaria','Atas','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(25,'Secretaria','Atas','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(26,'Secretaria','Atas','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(27,'Secretaria','Atas','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(28,'Secretaria','Atas','download','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(29,'Secretaria','Cadastros','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(30,'Secretaria','Cadastros','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(31,'Secretaria','Cadastros','view','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(32,'Secretaria','Cadastros','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(33,'Secretaria','Cadastros','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(34,'Secretaria','Calendarios','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(35,'Secretaria','Calendarios','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(36,'Secretaria','Calendarios','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(37,'Secretaria','Calendarios','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(38,'Secretaria','Cargos','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(39,'Secretaria','Cargos','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(40,'Secretaria','Cargos','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(41,'Secretaria','Cargos','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(42,'Secretaria','Congregacaos','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(43,'Secretaria','Congregacaos','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(44,'Secretaria','Congregacaos','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(45,'Secretaria','Congregacaos','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(46,'Secretaria','Departamentos','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(47,'Secretaria','Departamentos','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(48,'Secretaria','Departamentos','view','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(49,'Secretaria','Departamentos','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(50,'Secretaria','Departamentos','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(51,'Secretaria','Dons','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(52,'Secretaria','Dons','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(53,'Secretaria','Dons','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(54,'Secretaria','Dons','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(55,'Secretaria','Escolaridades','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(56,'Secretaria','Escolaridades','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(57,'Secretaria','Escolaridades','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(58,'Secretaria','Escolaridades','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(59,'Secretaria','Membros','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(60,'Secretaria','Membros','search','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(61,'Secretaria','Membros','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(62,'Secretaria','Membros','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(63,'Secretaria','Membros','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(64,'Secretaria','Profissaos','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(65,'Secretaria','Profissaos','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(66,'Secretaria','Profissaos','view','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(67,'Secretaria','Profissaos','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(68,'Secretaria','Profissaos','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(69,'Secretaria','Relatorios','membros','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(70,'Secretaria','Relatorios','lista_presenca','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(71,'Secretaria','Relatorios','usuarios','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(72,'Secretaria','Relatorios','visitantes','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(73,'Secretaria','Relatorios','cargos','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(74,'Secretaria','Relatorios','profissao','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(75,'Secretaria','Relatorios','eventos','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(76,'Secretaria','Relatorios','departamentos','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(77,'Secretaria','Relatorios','congregacoes','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(78,'Secretaria','Relatorios','mapa_membros','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(79,'Secretaria','Relatorios','grafico_membros','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(80,'Secretaria','Visitantes','index','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(81,'Secretaria','Visitantes','add','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(82,'Secretaria','Visitantes','edit','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(83,'Secretaria','Visitantes','view','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1),
(84,'Secretaria','Visitantes','delete','2025-11-14 18:58:52','2025-11-14 18:58:52',1,1);
/*!40000 ALTER TABLE `permissao_padraos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `plugin` varchar(150) DEFAULT '0',
  `controller` varchar(150) DEFAULT '0',
  `action` varchar(150) DEFAULT '0',
  `allowed` int(11) DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,1,'','Users','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(2,1,'','Users','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(3,1,'','Users','addUser',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(4,1,'','Users','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(5,1,'','Users','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(6,1,'','Users','permissao_padrao',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(7,1,'Biblioteca','Itens','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(8,1,'Biblioteca','Itens','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(9,1,'Biblioteca','Itens','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(10,1,'Biblioteca','Itens','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(11,1,'Biblioteca','Itens','consulta',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(12,1,'Biblioteca','Itens','emprestimo',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(13,1,'Biblioteca','Itens','devolucao',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(14,1,'Biblioteca','Itens','historico',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(15,1,'Biblioteca','Relatorios','itens',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(16,1,'Biblioteca','Relatorios','emprestimos',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(17,1,'Patrimonio','Bens','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(18,1,'Patrimonio','Bens','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(19,1,'Patrimonio','Bens','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(20,1,'Patrimonio','Bens','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(21,1,'Patrimonio','Bens','movimentar',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(22,1,'Patrimonio','Relatorios','bens',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(23,1,'Patrimonio','Relatorios','movimentacao_bens',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(24,1,'Secretaria','Atas','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(25,1,'Secretaria','Atas','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(26,1,'Secretaria','Atas','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(27,1,'Secretaria','Atas','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(28,1,'Secretaria','Atas','download',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(29,1,'Secretaria','Cadastros','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(30,1,'Secretaria','Cadastros','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(31,1,'Secretaria','Cadastros','view',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(32,1,'Secretaria','Cadastros','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(33,1,'Secretaria','Cadastros','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(34,1,'Secretaria','Calendarios','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(35,1,'Secretaria','Calendarios','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(36,1,'Secretaria','Calendarios','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(37,1,'Secretaria','Calendarios','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(38,1,'Secretaria','Cargos','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(39,1,'Secretaria','Cargos','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(40,1,'Secretaria','Cargos','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(41,1,'Secretaria','Cargos','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(42,1,'Secretaria','Congregacaos','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(43,1,'Secretaria','Congregacaos','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(44,1,'Secretaria','Congregacaos','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(45,1,'Secretaria','Congregacaos','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(46,1,'Secretaria','Departamentos','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(47,1,'Secretaria','Departamentos','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(48,1,'Secretaria','Departamentos','view',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(49,1,'Secretaria','Departamentos','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(50,1,'Secretaria','Departamentos','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(51,1,'Secretaria','Dons','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(52,1,'Secretaria','Dons','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(53,1,'Secretaria','Dons','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(54,1,'Secretaria','Dons','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(55,1,'Secretaria','Escolaridades','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(56,1,'Secretaria','Escolaridades','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(57,1,'Secretaria','Escolaridades','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(58,1,'Secretaria','Escolaridades','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(59,1,'Secretaria','Membros','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(60,1,'Secretaria','Membros','search',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(61,1,'Secretaria','Membros','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(62,1,'Secretaria','Membros','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(63,1,'Secretaria','Membros','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(64,1,'Secretaria','Profissaos','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(65,1,'Secretaria','Profissaos','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(66,1,'Secretaria','Profissaos','view',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(67,1,'Secretaria','Profissaos','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(68,1,'Secretaria','Profissaos','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(69,1,'Secretaria','Relatorios','membros',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(70,1,'Secretaria','Relatorios','lista_presenca',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(71,1,'Secretaria','Relatorios','usuarios',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(72,1,'Secretaria','Relatorios','visitantes',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(73,1,'Secretaria','Relatorios','cargos',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(74,1,'Secretaria','Relatorios','profissao',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(75,1,'Secretaria','Relatorios','eventos',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(76,1,'Secretaria','Relatorios','departamentos',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(77,1,'Secretaria','Relatorios','congregacoes',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(78,1,'Secretaria','Relatorios','mapa_membros',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(79,1,'Secretaria','Relatorios','grafico_membros',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(80,1,'Secretaria','Visitantes','index',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(81,1,'Secretaria','Visitantes','add',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(82,1,'Secretaria','Visitantes','edit',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(83,1,'Secretaria','Visitantes','view',1,'2026-03-11 21:30:24','2026-03-11 21:38:11'),
(84,1,'Secretaria','Visitantes','delete',1,'2026-03-11 21:30:24','2026-03-11 21:38:11');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `pessoa_dons`
--

DROP TABLE IF EXISTS `pessoa_dons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pessoa_dons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dom_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pessoa_dons`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `pessoa_dons` WRITE;
/*!40000 ALTER TABLE `pessoa_dons` DISABLE KEYS */;
/*!40000 ALTER TABLE `pessoa_dons` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `profissaos`
--

DROP TABLE IF EXISTS `profissaos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `profissaos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` text DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Profissão membros';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profissaos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `profissaos` WRITE;
/*!40000 ALTER TABLE `profissaos` DISABLE KEYS */;
/*!40000 ALTER TABLE `profissaos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `relacionamentos`
--

DROP TABLE IF EXISTS `relacionamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `relacionamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `membro_id` int(11) NOT NULL,
  `tiporelacionamento_id` int(11) DEFAULT NULL,
  `membro2_id` int(11) DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastros do relacionamentos do sistema. guarda informações ';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relacionamentos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `relacionamentos` WRITE;
/*!40000 ALTER TABLE `relacionamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `relacionamentos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tipo_bens`
--

DROP TABLE IF EXISTS `tipo_bens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_bens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(80) NOT NULL,
  `descricao` text DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro Tipo Bem';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_bens`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tipo_bens` WRITE;
/*!40000 ALTER TABLE `tipo_bens` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_bens` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tipo_biblioteca`
--

DROP TABLE IF EXISTS `tipo_biblioteca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_biblioteca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT COMMENT='Cadastro de tipos da biblioteca';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_biblioteca`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tipo_biblioteca` WRITE;
/*!40000 ALTER TABLE `tipo_biblioteca` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_biblioteca` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `tiporelacionamentos`
--

DROP TABLE IF EXISTS `tiporelacionamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiporelacionamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) NOT NULL,
  `obs` text DEFAULT NULL,
  `church_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Tipo de Relacionamento. Responsável por armazena';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiporelacionamentos`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `tiporelacionamentos` WRITE;
/*!40000 ALTER TABLE `tiporelacionamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiporelacionamentos` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facebook_id` bigint(20) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `telefone` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Todos os usuários do Sistema.';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(1,NULL,'master@master','09067eb9cbc3f279cba20f4ccf70f42a3a882810','master','(11) 1111-11111','(11) 1111-11111','111.111.111-11','2026-03-11 21:22:37','2026-03-11 21:40:10',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

--
-- Table structure for table `visitantes`
--

DROP TABLE IF EXISTS `visitantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataVisita` date NOT NULL,
  `nome` varchar(50) NOT NULL,
  `idade` int(11) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `frequentaIgreja` varchar(70) DEFAULT NULL,
  `pedidoOracao` varchar(70) DEFAULT NULL,
  `origem` varchar(20) NOT NULL,
  `redesSociaisComp` varchar(50) DEFAULT NULL,
  `outroComp` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `church_id` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Cadastro de Visitantes';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitantes`
--

SET @OLD_AUTOCOMMIT=@@AUTOCOMMIT, @@AUTOCOMMIT=0;
LOCK TABLES `visitantes` WRITE;
/*!40000 ALTER TABLE `visitantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitantes` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;
SET AUTOCOMMIT=@OLD_AUTOCOMMIT;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-03-11 21:51:40
