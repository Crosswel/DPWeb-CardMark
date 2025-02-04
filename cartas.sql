-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 04-Fev-2025 às 00:09
-- Versão do servidor: 8.0.30
-- versão do PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dados: `cartas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cartas`
--

CREATE TABLE `cartas` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `box_set` varchar(50) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `quantidade` int DEFAULT '10',
  `jogo` enum('Vanguard','Pokemon','Yugioh') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `cartas`
--

INSERT INTO `cartas` (`id`, `nome`, `box_set`, `preco`, `imagem`, `quantidade`, `jogo`) VALUES
(1, 'Arven', 'OBF', 0.02, '../grupo204/static/pk1.jpg', 9, 'Pokemon'),
(2, 'Buddy-Buddy Poffin', 'TEF', 0.02, '../grupo204/static/pk2.jpg', 10, 'Pokemon'),
(3, 'Ceruledge ex', 'SSP', 1.99, '../grupo204/static/pk3.jpg', 10, 'Pokemon'),
(4, 'Dusknoir', 'SFA', 0.06, '../grupo204/static/pk4.jpg', 10, 'Pokemon'),
(5, 'Earthen Vessel', 'PAR', 0.02, '../grupo204/static/pk5.jpg', 10, 'Pokemon'),
(6, 'Alolan Exeggutor ex', 'SSP', 0.49, '../grupo204/static/pk6.jpg', 10, 'Pokemon'),
(7, 'Fezandipiti ex', 'SFA', 4.99, '../grupo204/static/pk7.jpg', 10, 'Pokemon'),
(8, 'Garchomp ex', 'PAR', 1.50, '../grupo204/static/pk8.jpg', 10, 'Pokemon'),
(9, 'Gardevoir ex', 'PAF', 0.49, '../grupo204/static/pk9.jpg', 10, 'Pokemon'),
(10, 'Hydreigon ex', 'SSP', 0.99, '../grupo204/static/pk10.jpg', 10, 'Pokemon'),
(11, 'Latias ex', 'SSP', 0.95, '../grupo204/static/pk11.jpg', 10, 'Pokemon'),
(12, 'Mewscarada ex', 'PAL', 0.29, '../grupo204/static/pk12.jpg', 10, 'Pokemon'),
(13, 'Milotic ex', 'SSP', 0.30, '../grupo204/static/pk13.jpg', 10, 'Pokemon'),
(14, 'Miraidon ex', 'SVI', 0.48, '../grupo204/static/pk14.jpg', 10, 'Pokemon'),
(15, 'Night Stretcher', 'SFA', 0.57, '../grupo204/static/pk15.jpg', 10, 'Pokemon'),
(16, 'Palafin', 'PAF', 0.59, '../grupo204/static/pk16.jpg', 10, 'Pokemon'),
(17, 'Pikachu ex', 'SSP', 2.99, '../grupo204/static/pk17.jpg', 10, 'Pokemon'),
(18, 'Precious Trolley', 'SSP', 1.99, '../grupo204/static/pk18.jpg', 10, 'Pokemon'),
(19, 'Super Rod', 'PAL', 0.02, '../grupo204/static/pk19.jpg', 10, 'Pokemon'),
(20, 'Sylveon ex', 'SSP', 1.99, '../grupo204/static/pk20.jpg', 10, 'Pokemon'),
(21, 'Unparalleled Drekasleif, Varga Dragres \"Rakshasa\"', 'D- BT05', 19.99, '../grupo204/static/cv1.png', 9, 'Vanguard'),
(22, 'Summit Flare Dragon', 'D-BT05', 3.50, '../grupo204/static/cv2.png', 9, 'Vanguard'),
(23, 'Anachronous Dragon', 'D-BT05', 3.50, '../grupo204/static/cv3.png', 10, 'Vanguard'),
(24, 'Destined One of Time, Liael=Odium', 'D-BT05', 16.99, '../grupo204/static/cv4.png', 9, 'Vanguard'),
(25, 'Demonic Path Autocrat, Vasargo', 'D-BT05', 3.99, '../grupo204/static/cv5.png', 10, 'Vanguard'),
(26, 'Headway Router Dragon', 'D-BT05', 1.75, '../grupo204/static/cv6.png', 10, 'Vanguard'),
(27, 'Fated King of Miracles, Rezael Vita', 'D-BT05', 24.99, '../grupo204/static/cv7.png', 10, 'Vanguard'),
(28, 'Blest Dragon, Gabwelius', 'D-BT05', 17.99, '../grupo204/static/cv8.png', 10, 'Vanguard'),
(29, 'Destined King of Infinity, Levidras Empireo', 'D-BT05', 16.00, '../grupo204/static/cv9.png', 10, 'Vanguard'),
(30, 'Sequence Wizard', 'D-BT05', 0.99, '../grupo204/static/cv10.png', 10, 'Vanguard'),
(31, 'Veleno Soldato, Lephonohyla', 'D-BT05', 0.99, '../grupo204/static/cv11.png', 10, 'Vanguard'),
(32, 'FL∀MMe-Glam sup.Gt. Grenadine', 'D-BT05', 2.00, '../grupo204/static/cv12.png', 10, 'Vanguard'),
(33, 'Clover Hearts, Nellinea', 'D-BT05', 1.00, '../grupo204/static/cv13.png', 10, 'Vanguard'),
(34, 'Storm Slasher Dragon', 'D-BT05', 2.00, '../grupo204/static/cv14.png', 10, 'Vanguard'),
(35, 'Almanac Colossus', 'D-BT05', 2.00, '../grupo204/static/cv15.png', 10, 'Vanguard'),
(36, 'Direful Doll, Bartolomea', 'D-BT05', 1.40, '../grupo204/static/cv16.png', 10, 'Vanguard'),
(37, 'Aurora Battle Princess, Capture Cherrino', 'D-BT05', 0.24, '../grupo204/static/cv17.png', 10, 'Vanguard'),
(38, 'Knight of Formosity, Charmnet', 'D-BT05', 1.00, '../grupo204/static/cv18.png', 10, 'Vanguard'),
(39, 'Inquisitive Squarrol', 'D-BT05', 0.34, '../grupo204/static/cv19.png', 10, 'Vanguard'),
(40, 'Morning Practice in the Calm Sea, Tolmana', 'D-BT05', 0.35, '../grupo204/static/cv20.png', 10, 'Vanguard'),
(41, 'Mereologic Aggregator', 'DABL', 1.90, '../grupo204/static/yg1.jpg', 9, 'Yugioh'),
(42, 'Tidal, Dragon Ruler of Waterfalls', 'RA03', 0.05, '../grupo204/static/yg2.jpg', 10, 'Yugioh'),
(43, 'Blaster, Dragon Ruler of Infernos', 'RA03', 0.05, '../grupo204/static/yg3.jpg', 10, 'Yugioh'),
(44, 'Tempest, Dragon Ruler of Storms', 'RA03', 0.02, '../grupo204/static/yg4.jpg', 10, 'Yugioh'),
(45, 'Reactan, Dragon Ruler of Pebbles', 'RA03', 0.49, '../grupo204/static/yg5.jpg', 10, 'Yugioh'),
(46, 'Stream, Dragon Ruler of Droplets', 'RA03', 1.49, '../grupo204/static/yg6.jpg', 10, 'Yugioh'),
(47, 'Burner, Dragon Ruler of Sparks', 'RA03', 9.99, '../grupo204/static/yg7.jpg', 10, 'Yugioh'),
(48, 'Lightning, Dragon Ruler of Drafts', 'RA03', 0.25, '../grupo204/static/yg8.jpg', 10, 'Yugioh'),
(49, 'Ice Ryzeal', 'CRBR', 18.50, '../grupo204/static/yg9.jpg', 10, 'Yugioh'),
(50, 'Ryzeal Detonator', 'CRBR', 1.00, '../grupo204/static/yg10.jpg', 10, 'Yugioh'),
(51, 'Maliss <P> White Rabbit', 'CRBR', 23.20, '../grupo204/static/yg11.jpg', 10, 'Yugioh'),
(52, 'Maliss <P> Chessy Cat', 'CRBR', 0.02, '../grupo204/static/yg12.jpg', 10, 'Yugioh'),
(53, 'Maliss <P> Dormouse', 'CRBR', 0.02, '../grupo204/static/yg13.jpg', 10, 'Yugioh'),
(54, 'Maliss <P> Red Ransom', 'CRBR', 0.02, '../grupo204/static/yg14.jpg', 10, 'Yugioh'),
(55, 'Maliss <P> White Binder', 'CRBR', 0.02, '../grupo204/static/yg15.jpg', 10, 'Yugioh'),
(56, 'Maliss <P> Hearts Crypter', 'CRBR', 0.25, '../grupo204/static/yg16.jpg', 10, 'Yugioh'),
(57, 'Maliss in Underground', 'CRBR', 20.00, '../grupo204/static/yg17.jpg', 10, 'Yugioh'),
(58, 'Maliss <C> MTP-07', 'CRBR', 0.19, '../grupo204/static/yg18.jpg', 10, 'Yugioh'),
(59, 'Maliss <C> TB-11', 'CRBR', 0.02, '../grupo204/static/yg19.jpg', 10, 'Yugioh'),
(60, 'Sosei Ryu-Ge Mistva', 'CRBR', 3.40, '../grupo204/static/yg20.jpg', 11, 'Yugioh');

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra`
--

CREATE TABLE `compra` (
  `id_compra` int NOT NULL,
  `id_user` int NOT NULL,
  `id_carta` int NOT NULL,
  `quantidade` int DEFAULT '1',
  `estado` enum('Pendente','Enviado','Entregue') DEFAULT 'Pendente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `compra`
--

INSERT INTO `compra` (`id_compra`, `id_user`, `id_carta`, `quantidade`, `estado`) VALUES
(1, 2, 22, 1, 'Pendente'),
(2, 2, 24, 1, 'Enviado'),
(3, 2, 21, 1, 'Pendente'),
(4, 2, 41, 1, 'Pendente'),
(5, 2, 1, 1, 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telemovel` varchar(15) DEFAULT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `role` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `password`, `email`, `telemovel`, `morada`, `role`) VALUES
(2, 'teste1', '$2y$10$P7pQW1ch9bAzhgjjRbAA9ur6zm08LoPn8.sTMRL.DMaaKXR5EX9FO', 'teste1@gmail.com', '930123456', 'Taveiro 3045-466', 0),
(3, 'admin', '$2y$10$f7nlZkp1gHmXymCx23UFxe.NL8NhM/KVdP0oG14VSeTaQw7DY86BG', 'admin@gmail.com', '977777777', NULL, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_carta` (`id_carta`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cartas`
--
ALTER TABLE `cartas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_carta`) REFERENCES `cartas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
