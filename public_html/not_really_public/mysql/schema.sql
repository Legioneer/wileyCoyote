DROP TABLE `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_firstName_lastName_UNIQUE` (`firstName`,`lastName`),
  UNIQUE KEY `username_UNIQUE` (`username`)
);

DROP TABLE `product`;
CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO product (`id`, `name`, `description`, `price`, `img_url`) VALUES
('1', 'Anvil', '', '9.58', 'http://csis02.slcc.edu/dhunter3/productImages/1.jpg'),
('2', 'Axle Grease', '', '15.16', 'http://csis02.slcc.edu/dhunter3/productImages/2.jpg'),
('3', 'Atom Re-Arranger', '', '47.05', 'http://csis02.slcc.edu/dhunter3/productImages/3.jpg'),
('4', 'Bed Springs', '', '89.76', 'http://csis02.slcc.edu/dhunter3/productImages/4.jpg'),
('5', 'Bird Seed', '', '7.68', 'http://csis02.slcc.edu/dhunter3/productImages/5.jpg'),
('6', 'Blasting Powder', '', '69.11', 'http://csis02.slcc.edu/dhunter3/productImages/6.jpg'),
('7', 'Cork', '', '22.52', 'http://csis02.slcc.edu/dhunter3/productImages/7.jpg'),
('8', 'Dsintigration Pistol', '', '5.25', 'http://csis02.slcc.edu/dhunter3/productImages/8.jpg'),
('9', 'Earthquake Pills', '', '58.70', 'http://csis02.slcc.edu/dhunter3/productImages/9.jpg'),
('10', 'Female Roadrunner costume', '', '77.73', 'http://csis02.slcc.edu/dhunter3/productImages/10.jpg'),
('11', 'Giant Rubber Band', '', '12.56', 'http://csis02.slcc.edu/dhunter3/productImages/11.jpg'),
('12', 'Instant Girl', '', '29.60', 'http://csis02.slcc.edu/dhunter3/productImages/12.jpg'),
('13', 'Iron Carrot', '', '10.33', 'http://csis02.slcc.edu/dhunter3/productImages/13.jpg'),
('14', 'Jet Propelled Unicycle', '', '62.86', 'http://csis02.slcc.edu/dhunter3/productImages/14.jpg'),
('15', 'Out-Board Motor', '', '83.31', 'http://csis02.slcc.edu/dhunter3/productImages/15.jpg'),
('16', 'Railroad Track', '', '27.95', 'http://csis02.slcc.edu/dhunter3/productImages/16.jpg'),
('17', 'Rocket Sled', '', '89.81', 'http://csis02.slcc.edu/dhunter3/productImages/17.jpg'),
('18', 'Super Outfit', '', '65.23', 'http://csis02.slcc.edu/dhunter3/productImages/18.jpg'),
('19', 'Time Space Gun', '', '56.72', 'http://csis02.slcc.edu/dhunter3/productImages/19.jpg'),
('20', 'X-Ray', '', '87.92', 'http://csis02.slcc.edu/dhunter3/productImages/20.jpg');
