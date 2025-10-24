CREATE DATABASE  IF NOT EXISTS `secretaria_fiap` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `secretaria_fiap`;
-- MySQL dump 10.13  Distrib 8.0.44, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: secretaria_fiap
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `administradores`
--

DROP TABLE IF EXISTS `administradores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `administradores` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_administradores_nome` (`nome`),
  KEY `idx_administradores_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administradores`
--

LOCK TABLES `administradores` WRITE;
/*!40000 ALTER TABLE `administradores` DISABLE KEYS */;
INSERT INTO `administradores` VALUES (1,'Administrador','admin@fiap.com.br','$2a$12$gFoTbDwoyy5oocIBgBU22u3fZ6PQlZ5nDrHFKkUGeDqaAeh3IGO8y','2025-10-23 01:43:51');
/*!40000 ALTER TABLE `administradores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alunos`
--

DROP TABLE IF EXISTS `alunos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alunos` (
  `id_aluno` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_nascimento` date NOT NULL,
  `cpf` char(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_aluno`),
  UNIQUE KEY `cpf` (`cpf`),
  UNIQUE KEY `email` (`email`),
  KEY `idx_alunos_nome` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alunos`
--

LOCK TABLES `alunos` WRITE;
/*!40000 ALTER TABLE `alunos` DISABLE KEYS */;
INSERT INTO `alunos` VALUES (27,'EDUARDA MENDES ROCHA','1997-09-30','56789012345','eduarda.rocha@email.com','$2y$10$UxiaA9wmZ2sNNcPPE3dFPu3xVee0sKasHYW0CUvaAswufNzj07r.e','2025-10-24 12:13:10'),(28,'FELIPE GONçALVES ARAúJO','1985-12-04','67890123456','felipe.araujo@email.com','$2y$10$j1RhVlfSnnAGbeTkxlG0JunA/vI4wGYvaJ1q0KDWqhEdSUqt5op4q','2025-10-24 12:14:00'),(29,'GABRIELA NUNES PEREIRA','2000-06-21','78901234567','gabriela.pereira@email.com','$2y$10$ohL9LUrY.xO.EPaytN0EbO4czuqeH9dX74WtEnpZ0.CwXh4Dz8SM6','2025-10-24 12:14:39'),(30,'ANA CLARA SILVA SANTOS','1995-03-12','12345678901','ana.silva@email.com','$2y$10$s8WbLlBGQqX3pIhEnzMYN.wT4/rXAj5kGfynsR.qOTgSHO5JW6cLy','2025-10-24 12:14:59'),(31,'HENRIQUE BARBOSA TEIXEIRA','1993-08-15','89012345678','henrique.teixeira@email.com','$2y$10$AB9sVoOQrFF36yhd4FkgOetWRdzQKPebULie6oVofhWIcEesVR9ne','2025-10-24 12:15:09'),(32,'ISABEL CRISTINA RAMOS','0089-04-07','90123456789','isabel.ramos@email.com','$2y$10$4/3o6sDdrsxa6cz.IqJVEunIDe/inkckq2IPanKt.sDZxs079wKHS','2025-10-24 12:15:44'),(33,'BRUNO HENRIQUE OLIVEIRA','1988-07-25','23456789012','bruno.oliveira@email.com','$2y$10$CCxQg/xl.WO/YxQSRg2pxeVEoXk1AE9bO0nVwzP7mcMPpcm4.UEj6','2025-10-24 12:15:54'),(34,'JOãO PEDRO CARDOSO MARTINS','1996-10-22','01234567890','joao.martins@email.com','$2y$10$HWemDMibl3czRlhGBczGK.vwAvspQuk1me9Jk4dOS7MujuJzeitba','2025-10-24 12:16:06'),(35,'CAMILA FERREIRA LIMA','2001-11-09','34567890123','camila.lima@email.com','$2y$10$q/LRsJe8PgKIWSuEAvGv6OgXJOf9qKb1uWRL7Ocb8yk5Kxf6bC/9q','2025-10-24 12:16:42'),(36,'DIEGO ALMEIDA COSTA','1992-05-18','45678901234','diego.costa@email.com','$2y$10$TIalU8xprD1DV.tIuX8hteRcBYZs5lWgWjLnaHeSesDlMTUTBwUk2','2025-10-24 12:17:31');
/*!40000 ALTER TABLE `alunos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matriculas`
--

DROP TABLE IF EXISTS `matriculas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `matriculas` (
  `id_matricula` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_aluno` int(10) unsigned NOT NULL,
  `id_turma` int(10) unsigned NOT NULL,
  `data_matricula` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_matricula`),
  UNIQUE KEY `id_aluno` (`id_aluno`,`id_turma`),
  KEY `id_turma` (`id_turma`),
  CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_aluno`) REFERENCES `alunos` (`id_aluno`) ON DELETE CASCADE,
  CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`id_turma`) REFERENCES `turmas` (`id_turma`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matriculas`
--

LOCK TABLES `matriculas` WRITE;
/*!40000 ALTER TABLE `matriculas` DISABLE KEYS */;
INSERT INTO `matriculas` VALUES (24,30,18,'2025-10-24 12:28:31'),(25,30,17,'2025-10-24 12:34:02'),(26,30,19,'2025-10-24 12:34:31'),(27,35,30,'2025-10-24 12:34:48'),(28,29,30,'2025-10-24 12:35:06'),(29,32,30,'2025-10-24 12:35:19'),(30,31,18,'2025-10-24 12:35:30'),(31,32,20,'2025-10-24 12:35:38'),(32,34,20,'2025-10-24 12:35:47'),(33,27,19,'2025-10-24 12:36:35'),(34,36,22,'2025-10-24 12:36:50'),(35,31,20,'2025-10-24 12:37:00'),(36,32,22,'2025-10-24 12:37:13'),(37,36,20,'2025-10-24 12:37:47'),(38,28,23,'2025-10-24 12:38:03'),(39,34,23,'2025-10-24 12:38:09'),(40,30,23,'2025-10-24 12:38:13');
/*!40000 ALTER TABLE `matriculas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turmas`
--

DROP TABLE IF EXISTS `turmas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `turmas` (
  `id_turma` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_turma`),
  KEY `idx_turmas_nome` (`nome`),
  KEY `idx_turmas_created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turmas`
--

LOCK TABLES `turmas` WRITE;
/*!40000 ALTER TABLE `turmas` DISABLE KEYS */;
INSERT INTO `turmas` VALUES (17,'Administração 2025.1 – Turma A','Formada por futuros gestores e empreendedores, essa turma foca em liderança, planejamento estratégico e inovação nos negócios.','2025-10-23 16:52:42'),(18,'Arquitetura e Urbanismo 2025.1 – Turma B','Jovens criativos que buscam equilibrar arte, técnica e sustentabilidade na construção de espaços urbanos modernos e funcionais.','2025-10-23 16:52:52'),(19,'Biomedicina 2025.1 – Turma C','Turma dedicada ao estudo da saúde e das ciências biológicas, com foco em diagnósticos laboratoriais e pesquisa científica.','2025-10-23 16:53:08'),(20,'Ciência da Computação 2025.1 – Turma D','Com paixão por tecnologia e inovação, esses alunos exploram algoritmos, programação e inteligência artificial para criar o futuro digital.','2025-10-23 16:53:18'),(21,'Direito 2025.1 – Turma E','Futuros defensores da justiça, essa turma se destaca pela oratória, senso crítico e comprometimento com a ética e o direito.','2025-10-23 16:53:28'),(22,'Educação Física 2025.1 – Turma F','Com energia e espírito de equipe, esses estudantes promovem saúde, esporte e qualidade de vida em diferentes contextos sociais.','2025-10-23 16:53:39'),(23,'Enfermagem 2025.1 – Turma G','Turma vocacionada para o cuidado e o bem-estar humano, com dedicação e empatia em todas as áreas da saúde.','2025-10-23 16:53:48'),(24,'Engenharia Civil 2025.1 – Turma H','Focados em cálculos, projetos e construção, esses futuros engenheiros sonham em transformar ideias em obras sólidas e sustentáveis.','2025-10-23 16:54:00'),(25,'Jornalismo 2025.1 – Turma I','Apaixonados por comunicação e verdade, esses alunos buscam informar com ética, clareza e responsabilidade social.','2025-10-23 16:54:09'),(27,'Jornalismo 2025.1 – Turma 2','Apaixonados por comunicação e verdade, esses alunos buscam informar com ética, clareza e responsabilidade social.','2025-10-23 20:59:18'),(30,'Cálculos Complexos 2025.01 - Turma A','Aulas de matemática avançada, cálculo e geometria de nível superior.','2025-10-24 02:51:08');
/*!40000 ALTER TABLE `turmas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-24 10:20:20
