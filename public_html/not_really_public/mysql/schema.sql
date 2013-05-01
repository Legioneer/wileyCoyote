CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contact_firstName_lastName_UNIQUE` (`firstName`,`lastName`)
);

CREATE TABLE IF NOT EXISTS `product` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `description` TEXT NOT NULL ,
  `price` DECIMAL(10,2) NOT NULL ,
  PRIMARY KEY (`id`)
);

INSERT INTO product (`name`) VALUES
('Anvil'),
('Axle Grease'),
('Atom Re-Arranger'),
('Bed Springs'),
('Bird Seed'),
('Blasting Powder'),
('Cork'),
('Dsintigration Pistol'),
('Earthquake Pills'),
('Female Roadrunner costume'),
('Giant Rubber Band'),
('Instant Girl'),
('Iron Carrot'),
('Jet Propelled Unicycle'),
('Out-Board Motor'),
('Railroad Track'),
('Rocket Sled'),
('Super Outfit'),
('Time Space Gun'),
('X-Ray');

