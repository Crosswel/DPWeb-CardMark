-- --------------------------------------------------------
-- Anfitrião:                    127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- SO do servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- A despejar estrutura da base de dados para cartas
DROP DATABASE IF EXISTS `cartas`;
CREATE DATABASE IF NOT EXISTS `cartas` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `cartas`;

-- A despejar estrutura para tabela cartas.cartas_pokemon
DROP TABLE IF EXISTS `cartas_pokemon`;
CREATE TABLE IF NOT EXISTS `cartas_pokemon` (
  `id_pk_carta` int NOT NULL AUTO_INCREMENT,
  `nome_carta` varchar(50) DEFAULT NULL,
  `box_set` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `preco` decimal(20,2) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_pk_carta`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.cartas_pokemon: ~20 rows (aproximadamente)
INSERT INTO `cartas_pokemon` (`id_pk_carta`, `nome_carta`, `box_set`, `preco`, `imagem`) VALUES
	(1, 'Arven', 'OBF', 0.02, '../www/static/pokemon/Arven.png'),
	(2, 'Buddy-Buddy Poffin', 'TEF', 0.02, '../www/static/pokemon/Buddy-Buddy Poffin.png'),
	(3, 'Ceruledge ex', 'SSP', 1.99, '../www/static/pokemon/Ceruledge ex.png'),
	(4, 'Dusknoir', 'SFA', 0.06, '../www/static/pokemon/Dusknoir.png'),
	(5, 'Earthen Vessel', 'PAR', 0.02, '../www/static/pokemon/Earthen Vessel.png'),
	(6, 'Alolan Exeggutor ex', 'SSP', 0.49, '../www/static/pokemon/Alolan Exeggutor ex.png'),
	(7, 'Fezandipiti ex', 'SFA', 4.99, '../www/static/pokemon/Fezandipiti ex.png'),
	(8, 'Garchomp ex', 'PAR', 1.50, '../www/static/pokemon/Garchomp ex.png'),
	(9, 'Gardevoir ex', 'PAF', 0.49, '../www/static/pokemon/Gardevoir ex.png'),
	(10, 'Hydreigon ex', 'SSP', 0.99, '../www/static/pokemon/Hydreigon ex.png'),
	(11, 'Latias ex', 'SSP', 0.95, '../www/static/pokemon/Latias ex.png'),
	(12, 'Mewscarada ex', 'PAL', 0.29, '../www/static/pokemon/Mewscarada ex.png'),
	(13, 'Milotic ex', 'SSP', 0.30, '../www/static/pokemon/Milotic ex.png'),
	(14, 'Miraidon ex', 'SVI', 0.48, '../www/static/pokemon/Miraidon ex.png'),
	(15, 'Night Stretcher', 'SFA', 0.57, '../www/static/pokemon/Night Stretcher.png'),
	(16, 'Palafin', 'PAF', 0.59, '../www/static/pokemon/Palafin.png'),
	(17, 'Pikachu ex', 'SSP', 2.99, '../www/static/pokemon/Pikachu ex.png'),
	(18, 'Precious Trolley', 'SSP', 1.99, '../www/static/pokemon/Precious Trolley.png'),
	(19, 'Super Rod', 'PAL', 0.02, '../www/static/pokemon/Super Rod.png'),
	(20, 'Sylveon ex', 'SSP', 1.99, '../www/static/pokemon/Sylveon ex.png');

-- A despejar estrutura para tabela cartas.cartas_vg
DROP TABLE IF EXISTS `cartas_vg`;
CREATE TABLE IF NOT EXISTS `cartas_vg` (
  `id_vg_carta` int NOT NULL AUTO_INCREMENT,
  `nome_carta` varchar(50) DEFAULT NULL,
  `box_set` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `preco` decimal(20,2) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_vg_carta`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.cartas_vg: ~20 rows (aproximadamente)
INSERT INTO `cartas_vg` (`id_vg_carta`, `nome_carta`, `box_set`, `preco`, `imagem`) VALUES
	(1, 'Unparalleled Drekasleif, Varga Dragres "Rakshasa"', 'D-BT05', 19.99, '../static/vanguard/1.png'),
	(2, 'Summit Flare Dragon', 'D-BT05', 3.50, '../static/vanguard/2.png'),
	(3, 'Anachronous Dragon', 'D-BT05', 3.50, '../static/vanguard/3.png'),
	(4, 'Destined One of Time, Liael=Odium', 'D-BT05', 16.99, '../static/vanguard/4.png'),
	(5, 'Demonic Path Autocrat, Vasargo', 'D-BT05', 3.99, '../static/vanguard/5.png'),
	(6, 'Headway Router Dragon', 'D-BT05', 1.75, '../static/vanguard/6.png'),
	(7, 'Fated King of Miracles, Rezael Vita', 'D-BT05', 24.99, '../static/vanguard/7.png'),
	(8, 'Blest Dragon, Gabwelius', 'D-BT05', 17.99, '../static/vanguard/8.png'),
	(9, 'Destined King of Infinity, Levidras Empireo', 'D-BT05', 16.00, '../static/vanguard/9.png'),
	(10, 'Sequence Wizard', 'D-BT05', 0.99, '../static/vanguard/10.png'),
	(11, 'Veleno Soldato, Lephonohyla', 'D-BT05', 0.99, '../static/vanguard/11.png'),
	(12, 'FL∀MMe-Glam sup.Gt. Grenadine', 'D-BT05', 2.00, '../static/vanguard/12.png'),
	(13, 'Clover Hearts, Nellinea', 'D-BT05', 1.00, '../static/vanguard/13.png'),
	(14, 'Storm Slasher Dragon', 'D-BT05', 2.00, '../static/vanguard/14.png'),
	(15, 'Almanac Colossus', 'D-BT05', 2.00, '../static/vanguard/15.png'),
	(16, 'Direful Doll, Bartolomea', 'D-BT05', 1.40, '../static/vanguard/16.png'),
	(17, 'Aurora Battle Princess, Capture Cherrino', 'D-BT05', 0.24, '../static/vanguard/17.png'),
	(18, 'Knight of Formosity, Charmnet', 'D-BT05', 1.00, '../static/vanguard/18.png'),
	(19, 'Inquisitive Squarrol', 'D-BT05', 0.34, '../static/vanguard/19.png'),
	(20, 'Morning Practice in the Calm Sea, Tolmana', 'D-BT05', 0.35, '../static/vanguard/20.png');

-- A despejar estrutura para tabela cartas.cartas_yugioh
DROP TABLE IF EXISTS `cartas_yugioh`;
CREATE TABLE IF NOT EXISTS `cartas_yugioh` (
  `id_yg_carta` int NOT NULL AUTO_INCREMENT,
  `nome_carta` varchar(50) DEFAULT NULL,
  `box_set` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `preco` decimal(20,2) DEFAULT NULL,
  `imagem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_yg_carta`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.cartas_yugioh: ~0 rows (aproximadamente)
INSERT INTO `cartas_yugioh` (`id_yg_carta`, `nome_carta`, `box_set`, `preco`, `imagem`) VALUES
	(1, 'Mereologic Aggregator', 'DABL', 1.90, '../static/yugioh/1.png'),
	(2, 'Tidal, Dragon Ruler of Waterfalls', 'RA03', 0.05, '../static/yugioh/2.png'),
	(3, 'Blaster, Dragon Ruler of Infernos', 'RA03', 0.05, '../static/yugioh/3.png'),
	(4, 'Tempest, Dragon Ruler of Storms', 'RA03', 0.02, '../static/yugioh/4.png'),
	(5, 'Reactan, Dragon Ruler of Pebbles', 'RA03', 0.49, '../static/yugioh/5.png'),
	(6, 'Stream, Dragon Ruler of Droplets', 'RA03', 1.49, '../static/yugioh/6.png'),
	(7, 'Burner, Dragon Ruler of Sparks', 'RA03', 9.99, '../static/yugioh/7.png'),
	(8, 'Lightning, Dragon Ruler of Drafts', 'RA03', 0.25, '../static/yugioh/8.png'),
	(9, 'Ice Ryzeal', 'CRBR', 18.50, '../static/yugioh/9.png'),
	(10, 'Ryzeal Detonator', 'CRBR', 1.00, '../static/yugioh/10.png'),
	(11, 'Maliss <P> White Rabbit', 'CRBR', 23.20, '../static/yugioh/11.png'),
	(12, 'Maliss <P> Chessy Cat', 'CRBR', 0.02, '../static/yugioh/12.png'),
	(13, 'Maliss <P> Dormouse', 'CRBR', 0.02, '../static/yugioh/13.png'),
	(14, 'Maliss <P> Red Ransom', 'CRBR', 0.02, '../static/yugioh/14.png'),
	(15, 'Maliss <P> White Binder', 'CRBR', 0.02, '../static/yugioh/15.png'),
	(16, 'Maliss <P> Hearts Crypter', 'CRBR', 0.25, '../static/yugioh/16.png'),
	(17, 'Maliss in Underground', 'CRBR', 20.00, '../static/yugioh/17.png'),
	(18, 'Maliss <C> MTP-07', 'CRBR', 0.19, '../static/yugioh/18.png'),
	(19, 'Maliss <C> TB-11', 'CRBR', 0.02, '../static/yugioh/19.png'),
	(20, 'Sosei Ryu-Ge Mistva', 'CRBR', 3.40, '../static/yugioh/20.png');

-- A despejar estrutura para tabela cartas.compra
DROP TABLE IF EXISTS `compra`;
CREATE TABLE IF NOT EXISTS `compra` (
  `id_compra` int NOT NULL AUTO_INCREMENT,
  `vendedor_id` int NOT NULL DEFAULT '0',
  `id_user` int NOT NULL DEFAULT '0',
  `id_yg_carta` int NOT NULL DEFAULT '0',
  `id_vg_carta` int NOT NULL DEFAULT '0',
  `id_pk_carta` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_compra`),
  KEY `vendedor_id` (`vendedor_id`),
  KEY `id_user` (`id_user`),
  KEY `id_vg_carta` (`id_vg_carta`),
  KEY `id_pk_carta` (`id_pk_carta`),
  KEY `id_yg_carta` (`id_yg_carta`),
  CONSTRAINT `id_pk_carta` FOREIGN KEY (`id_pk_carta`) REFERENCES `cartas_pokemon` (`id_pk_carta`),
  CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`),
  CONSTRAINT `id_vg_carta` FOREIGN KEY (`id_vg_carta`) REFERENCES `cartas_vg` (`id_vg_carta`),
  CONSTRAINT `id_yg_carta` FOREIGN KEY (`id_yg_carta`) REFERENCES `cartas_yugioh` (`id_yg_carta`),
  CONSTRAINT `vendedor_id` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`vendedor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.compra: ~0 rows (aproximadamente)

-- A despejar estrutura para tabela cartas.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `morada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` int DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.users: ~0 rows (aproximadamente)
INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `morada`, `role`) VALUES
	(1, 'Cruz', '12345', 'teste@gmail.com', '3045-451', 1),
	(2, 'teste2', '12345', 'teste2@gmail.com', '3045-451', 0);

-- A despejar estrutura para tabela cartas.vendedor
DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
  `vendedor_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `id_pk_carta` int DEFAULT NULL,
  `id_vg_carta` int DEFAULT NULL,
  `id_yg_carta` int DEFAULT NULL,
  `vendedor_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`vendedor_id`) USING BTREE,
  KEY `FK_vendedor_users` (`user_id`),
  KEY `FK_vendedor_cartas_pokemon` (`id_pk_carta`),
  KEY `FK_vendedor_cartas_vg` (`id_vg_carta`),
  KEY `FK_vendedor_cartas_yugioh` (`id_yg_carta`) USING BTREE,
  CONSTRAINT `FK_vendedor_cartas_pokemon` FOREIGN KEY (`id_pk_carta`) REFERENCES `cartas_pokemon` (`id_pk_carta`),
  CONSTRAINT `FK_vendedor_cartas_vg` FOREIGN KEY (`id_vg_carta`) REFERENCES `cartas_vg` (`id_vg_carta`),
  CONSTRAINT `FK_vendedor_cartas_yugioh` FOREIGN KEY (`id_yg_carta`) REFERENCES `cartas_yugioh` (`id_yg_carta`),
  CONSTRAINT `FK_vendedor_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- A despejar dados para tabela cartas.vendedor: ~0 rows (aproximadamente)
INSERT INTO `vendedor` (`vendedor_id`, `user_id`, `id_pk_carta`, `id_vg_carta`, `id_yg_carta`, `vendedor_name`) VALUES
	(1, 1, NULL, NULL, NULL, 'Cruz');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
