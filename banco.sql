-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.39-0ubuntu0.24.04.2 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para carnes_db
CREATE DATABASE IF NOT EXISTS `carnes_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `carnes_db`;

-- Copiando estrutura para tabela carnes_db.carnes
CREATE TABLE IF NOT EXISTS `carnes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `valor_total` decimal(10,2) NOT NULL DEFAULT (0),
  `quantidade_parcelas` int NOT NULL,
  `data_primeiro_vencimento` date NOT NULL,
  `periodicidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valor_entrada` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT (now()),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela carnes_db.parcelas
CREATE TABLE IF NOT EXISTS `parcelas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `carne_id` int NOT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_vencimento` date NOT NULL,
  `numero` int DEFAULT NULL,
  `entrada` enum('TRUE','FALSE') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `valor_por_parcela` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carne_id` (`carne_id`),
  CONSTRAINT `parcelas_ibfk_1` FOREIGN KEY (`carne_id`) REFERENCES `carnes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1259 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
