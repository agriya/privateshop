ALTER TABLE  `products` ADD  `credits` INT( 10 ) NULL AFTER  `end_date` ;

ALTER TABLE  `products` ADD  `is_credit_product` TINYINT( 1 ) NOT NULL AFTER  `credits` ;

ALTER TABLE  `products` ADD  `credit_expiry_date` DATETIME NOT NULL AFTER  `credits` ;

ALTER TABLE  `order_items` ADD  `credits` INT( 10 ) NULL AFTER  `price` ,
ADD  `credit_expiry_date` DATETIME NOT NULL AFTER  `credits` ;

ALTER TABLE  `carts` ADD  `credits` INT( 10 ) NULL AFTER  `quantity` ;