# MySQL-Front 3.2  (Build 6.11)

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES 'latin1' */;

# Host: robb0254.publiccloud.com.br    Database: calorysistemas_delivery
# ------------------------------------------------------
# Server version 5.7.32-35-log

DROP DATABASE IF EXISTS `calorysistemas_delivery`;
CREATE DATABASE `calorysistemas_delivery` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `calorysistemas_delivery`;
/*!40101 SET NAMES utf8 */;


#
# Table structure for table categorias
#

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table categorias
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (1,NULL,'Bebidas','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (2,NULL,'PIZZA','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (3,NULL,'Combos','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (4,NULL,'pizzas','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (5,NULL,'promo','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (7,1,'teste txtt','',1);
INSERT INTO `categorias` (`id`,`id_login`,`nome`,`imagem`,`status`) VALUES (8,2,'pizza','',1);

/*!40101 SET NAMES utf8 */;

#
# Table structure for table forma_pgto
#

CREATE TABLE `forma_pgto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `opcao` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pgto_ibfk_1` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table forma_pgto
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `forma_pgto` (`id`,`id_login`,`opcao`) VALUES (1,NULL,'Pix');
INSERT INTO `forma_pgto` (`id`,`id_login`,`opcao`) VALUES (2,NULL,'Cart');
INSERT INTO `forma_pgto` (`id`,`id_login`,`opcao`) VALUES (3,NULL,'Dinheiro');

/*!40101 SET NAMES utf8 */;

#
# Table structure for table login
#

CREATE TABLE `login` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeResp` varchar(100) DEFAULT NULL,
  `cpfResp` varchar(11) DEFAULT NULL,
  `celularResp` varchar(20) DEFAULT NULL,
  `dataNaciResp` date DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `nomeFanta` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cnpj` varchar(14) DEFAULT NULL,
  `inscricaoEstadual` varchar(15) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `logo` text,
  `status` varchar(1) DEFAULT NULL,
  `aberta` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

#
# Dumping data for table login
#

INSERT INTO `login` (`Id`,`nomeResp`,`cpfResp`,`celularResp`,`dataNaciResp`,`nome`,`nomeFanta`,`telefone`,`cnpj`,`inscricaoEstadual`,`endereco`,`cidade`,`estado`,`email`,`senha`,`logo`,`status`,`aberta`) VALUES (1,'LUIZ HENRIQUE PIZZA','13648718908','(44) 9 8843-0083','2003-06-12','LUIZ HENRIQUE PIZZARIA','LUIZ HENRIQUE PIZZA','(44) 9 8843-0083','81731929000192',NULL,'CEP: 87490000, RUA: CURITIBA, N: 12, BAIRRO: CENTRO, COMPLEMENTO: CASA','NOVA OLIMPIA','PR','luiz.henriq1206@gmail.com','$2y$10$zjczsHLxvSRNLHnVqK8HbeU0hs2PwZLNk./y6nCUZFcD/t.SWOGc2','./images/logo.jpg','a',1);
INSERT INTO `login` (`Id`,`nomeResp`,`cpfResp`,`celularResp`,`dataNaciResp`,`nome`,`nomeFanta`,`telefone`,`cnpj`,`inscricaoEstadual`,`endereco`,`cidade`,`estado`,`email`,`senha`,`logo`,`status`,`aberta`) VALUES (2,'PAULO','13648718908','(44) 9 8843-0083','2005-06-12','PAULO PIZZA','PAULO PIZZA','(44) 9 8843-0083','81731929000192',NULL,'CEP: 87490000, RUA: CURITIBA, N: 12, BAIRRO: CENTRO, COMPLEMENTO: CASA','NOVA OLIMPIA','PR','gamesll056@gmail.com','$2y$10$OzlbEyI.3mRQPqGJ.hlg0.CYO.BhyI20IWkxHqh5mhzYb0EiYou0O','./images/logo2.png','a',1);

#
# Table structure for table montar
#

CREATE TABLE `montar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `id_variedades` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `id_variedades` (`id_variedades`),
  KEY `id_login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table montar
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (1,NULL,1,'Chocolate ao Leite',0,'pizza-chocolate.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (2,2,1,'Nutella com Morango',0,'pizza-nuttela.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (3,1,1,'Brigadeiro',0,'pizza-brigadeiro.jpg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (4,NULL,1,'Chocolate Branco',0,'pizza-choco-branco.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (5,NULL,2,'Calabresa',0,'Pizza-Calabresa.jpg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (7,NULL,2,'Havaiana',0,'pizza-hava.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (8,2,2,'Moda da Casa',0,'pizza-moda.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (11,NULL,2,'Camarao',0,'pizza-camarao.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (12,NULL,2,'Salame',0,'pizza-salame.jpg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (13,NULL,4,'Catupiry',0,'borda-catupiry.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (14,NULL,4,'Cheddar',0,'borda-cheddar.png',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (15,NULL,4,'Chocolate',0,'borda-choco.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (16,NULL,1,'Abacaxi com Coco',0,'pizza-abacaxi.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (17,NULL,4,'Sem Borda',0,'borda-sem.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (18,NULL,3,'Bacon',4.99,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (19,NULL,3,'Mussarela',4.99,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (20,NULL,5,'Calabresa',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (21,NULL,5,'4 queijos',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (22,NULL,5,'Salame',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (23,NULL,6,'Chocolate',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (24,NULL,6,'Brigadeiro',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (25,NULL,7,'Coca cola 2L',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (26,NULL,7,'Fanta 2L',0,NULL,1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (27,2,4,'borda Brigadeiro',0,'borda-choco.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (30,1,4,'borda testeeee',0,'borda-sem.jpeg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (31,1,2,'Calabrasa',0,'../images/Pizza-Calabresa.jpg',1);
INSERT INTO `montar` (`Id`,`id_login`,`id_variedades`,`nome`,`price`,`imagem`,`status`) VALUES (32,1,2,'choco',0,'pizza-salame.jpg',1);

/*!40101 SET NAMES utf8 */;

#
# Table structure for table pedidosvendas
#

CREATE TABLE `pedidosvendas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `item_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `cliente_nome` varchar(200) NOT NULL,
  `cliente_contato` varchar(50) NOT NULL,
  `cliente_endereco` text NOT NULL,
  `cliente_opc_pgt` int(11) NOT NULL,
  `observacao` text NOT NULL,
  `order_date` date NOT NULL,
  `order_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `cliente_opc_pgt` (`cliente_opc_pgt`),
  KEY `id_login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table pedidosvendas
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (27,NULL,1,'P',49.99,1,'Elian','44998132947','nestor, 1288 - centro - PÃ¨rola-PR ',3,'nÃ£o esque','2023-11-06',655276);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (28,NULL,1,'PIZZA   G BORDA Cheddar   SABOR Brigadeiro',69.99,1,'Elian','44998132947','nestor, 1288 - centro - PÃ¨rola-PR ',3,'nÃ£o esque','2023-11-06',655276);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (31,NULL,1,'PIZZA   P BORDA Cheddar   SABOR Nutella, Havaiana, Moda da Casa',49.99,1,'Elian','5856698885','Rua Nestor Victor , 1288 - Centro - Perola-Pr Casa',2,'','2023-11-09',851358);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (33,NULL,2,'PIZZA:   G BORDA: Cheddar, Chocolate   SABOR: Nutella, Bacon, Havaiana, Moda da Casa',69.99,1,'Luiz','123','Rua, 123 - Vai - No-Pr Casa',2,'','2023-11-09',356418);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (35,NULL,1,'PIZZA   G BORDA Catupiry, Chocolate   SABOR Brigadeiro, Calabresa, Bacon, Moda da Casa',69.99,1,'Luiz Henrique','88430083','Curitiba, 400 - Centro - Nova OlÃ­mpia -PR Casa',2,'','2023-11-09',901978);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (36,NULL,1,'PIZZA   G BORDA Catupiry, Chocolate   SABOR Nutella, Moda da Casa, Frango, Camarao',69.99,1,'Xnnc','134','Ajeh, 134 - Nsnd - Xbdb-Nxbc Sjdn',2,'','2023-11-09',597677);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (38,NULL,1,'PIZZA:   G BORDA: Cheddar, Chocolate   SABOR: Brigadeiro, Calabresa, Havaiana, Moda da Casa',69.99,1,'L','1','A, 1 - B - N-P C',2,'','2023-11-10',212051);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (39,NULL,1,'PIZZA   M BORDA Cheddar   SABOR Bacon, Havaiana, Moda da Casa',59.99,1,'c','1','a, 1 - b - d-r a',1,'','2023-11-10',262370);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (40,NULL,1,'PIZZA   P BORDA Cheddar   SABOR Moda da Casa, Frango',49.99,1,'L','1','A, 2 - B - D-E C',2,'','2023-11-10',570222);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (41,NULL,1,'PIZZA   M BORDA Catupiry   SABOR Havaiana, Moda da Casa, Frango',59.99,1,'P','1','A, 1 - B - D-P C',2,'','2023-11-11',394458);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (42,NULL,7,'Coca Cola 2L Zero',8.99,1,'sdf','123','sdff, 12 - dsfsd - wsved-wrvfws casa',3,'','2023-11-11',190457);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (44,NULL,1,'PIZZA   M BORDA Cheddar   SABOR Bacon, Havaiana, Moda da Casa',59.99,1,'luiz','234','Curitiba, 400 - Centro - no-Pr Casa',1,'','2023-11-13',781037);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (45,NULL,1,'PIZZA   M BORDA Cheddar   SABOR Havaiana, Moda da Casa, Lombinho',59.99,1,'B','7','J, 9 - N - B-B N',2,'','2023-11-13',479323);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (46,NULL,1,'PIZZA   M BORDA Cheddar   SABOR Havaiana, Moda da Casa, Lombinho',59.99,1,'N','8','K, 8 - N - N-N N',2,'','2023-11-13',763202);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (47,NULL,1,'PIZZA   M BORDA Cheddar   SABOR Bacon, Havaiana, Moda da Casa',59.99,1,'M','44988430083','M, 9 - N - M-Mmm M',2,'','2023-11-13',580913);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (48,NULL,1,'PIZZA   Big BORDA    SABOR Calabresa, Havaiana, Camarao, Chocolate ao Leite, Nutella com Morango',99.99,1,'Elian Cortonezi','(44)99813-2947','Rua Nestor Victor , 1288 - centro - PÃ©rola-ParanÃ¡ ',1,'','2023-11-14',142833);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (49,NULL,6,'Coca Cola 2L',8.99,1,'Elian Cortonezi','(44)99813-2947','Rua Nestor Victor , 1288 - centro - PÃ©rola-ParanÃ¡ ',1,'','2023-11-14',142833);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (50,NULL,1,'PIZZA   M BORDA Sem Borda   SABOR Calabresa, Bacon, Chocolate ao Leite',79.99,1,'Luiz Henrique','44988430083','sdff, 12 - dsfsd - no-P casa',2,'','2023-11-20',658661);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (51,NULL,6,'Coca Cola 2L',8.99,1,'Luiz Henrique','44988430083','sdff, 12 - dsfsd - no-P casa',2,'','2023-11-20',658661);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (52,NULL,1,'PIZZA   M * BORDA Catupiry* Cheddar *  SABOR Calabresa* Bacon* Havaiana',79.99,1,'Luiz Henrique','44988430083','Curitiba, 12 - Centro - no-Pr casa',1,'','2023-12-02',125176);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (53,NULL,1,'PIZZA   M * BORDA Catupiry* Cheddar *  SABOR Calabresa* Bacon* Havaiana',79.99,1,'Bzsb','54848451548','Hab, 12 - Jzbd - Bxdb-Sbsb Zbbd',1,'','2023-12-15',319130);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (54,NULL,12,'Fanta 2L',7.99,1,'Luiz Henrique pizza','(44) 9 8843-0083','Curitiba, 12 - Centro - Nova Olimpia-pr Casa',1,'','2024-01-16',521330);
INSERT INTO `pedidosvendas` (`id`,`id_login`,`item_id`,`name`,`price`,`quantity`,`cliente_nome`,`cliente_contato`,`cliente_endereco`,`cliente_opc_pgt`,`observacao`,`order_date`,`order_id`) VALUES (55,2,12,'Fanta 2L',7.99,1,'Luiz Henrique pizza','(44) 9 8843-0083','Curitiba, 123 - Centro - Nova Olimpia-pr Casa',1,'','2024-01-16',663163);

/*!40101 SET NAMES utf8 */;

#
# Table structure for table produtos
#

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `name` text NOT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `images` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_login` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table produtos
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (1,1,'P',3,74.99,'1 Sabor','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (2,2,'M',3,84.99,'2 Sabores','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (3,1,'G',3,89.99,'3 Sabores','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (4,2,'Big',3,99.99,'4 Sabores','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (5,1,'PIZZA',2,0,'Monte sua pizza do jeito que desejar\r\n','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (6,1,'Coca Cola 2L',1,8.99,'gelada','coca-cola.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (7,2,'Coca Cola 2L Zero',1,8.99,'gelada','coca-2L-zero.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (8,1,'Coca Cola 600ml',1,4.49,'Gelada','coca-600ml.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (11,1,'Guarana 2L',1,7.99,'gelada','Guarana.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (12,2,'Fanta 2L',1,7.99,'Geladaaa','fanta.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (13,1,'P',4,69.99,'','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (14,2,'Coca Cola 350ml',1,2.99,'','coca-lata-350ml.png',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (15,1,'Coca Cola 350ml Zero',1,2.99,'gelada','coca-lata-zero.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (16,2,'Fanta 600ml',1,4.49,'','fantinha-600ml.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (17,1,'Fanta 350ml',1,2.99,'gelada','fanta-lata.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (18,2,'Fanta Uva 2L',1,7.99,'','fanta-uva.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (19,1,'Fanta Uva 350ml',1,2.99,'','fanta-uva-350ml.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (20,2,'Guarana Antartica 2L Zero',1,7.99,'','Guarana-zero.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (21,1,'Guarana 350ml',1,2.99,'','Guarana-Lata-350ml.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (22,2,'Sprit 2L',1,7.99,'','sprit.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (23,1,'Sprit 2L Zero',1,7.99,'','sprit-zero.jpeg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (24,2,'M',4,79.99,'','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (25,1,'G',4,89.99,'','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (26,2,'Big',4,99.99,'','Pizza-Calabresa.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (27,1,'coca cola 200ml',1,1.99,'','coca_200.jpg',1);
INSERT INTO `produtos` (`id`,`id_login`,`name`,`id_categoria`,`price`,`description`,`images`,`status`) VALUES (41,2,'PIZZA',2,0,'Monte','Pizza-Calabresa.jpg',0);

/*!40101 SET NAMES utf8 */;

#
# Table structure for table variedade
#

CREATE TABLE `variedade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `status_var` tinyint(3) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `ifbk4` (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

#
# Dumping data for table variedade
#

/*!40101 SET NAMES utf8mb4 */;

INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (1,NULL,'sabores doces',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (2,NULL,'sabores salgados',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (3,NULL,'adicionais',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (4,NULL,'bordas',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (5,NULL,'combo-sabor-salgado',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (6,NULL,'combo-sabor-doce',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (7,NULL,'combo-refrigerante',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (10,2,'Sabor Salagdo',NULL,1);
INSERT INTO `variedade` (`Id`,`id_login`,`nome`,`imagem`,`status_var`) VALUES (11,1,'Sabor Salagdo',NULL,1);

/*!40101 SET NAMES utf8 */;

#
#  Foreign keys for table categorias
#

ALTER TABLE `categorias`
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`);

#
#  Foreign keys for table forma_pgto
#

ALTER TABLE `forma_pgto`
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`);

#
#  Foreign keys for table montar
#

ALTER TABLE `montar`
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`);

#
#  Foreign keys for table pedidosvendas
#

ALTER TABLE `pedidosvendas`
  ADD FOREIGN KEY (`item_id`) REFERENCES `produtos` (`id`),
  ADD FOREIGN KEY (`cliente_opc_pgt`) REFERENCES `forma_pgto` (`id`),
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`);

#
#  Foreign keys for table produtos
#

ALTER TABLE `produtos`
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`),
  ADD FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

#
#  Foreign keys for table variedade
#

ALTER TABLE `variedade`
  ADD FOREIGN KEY (`id_login`) REFERENCES `login` (`Id`);

/*!40101 SET NAMES latin1 */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
