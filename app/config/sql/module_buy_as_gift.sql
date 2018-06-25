ALTER TABLE  `carts` ADD  `is_send_as_gift` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `quantity` ,ADD  `gift_friend_email` VARCHAR( 255 ) NOT NULL AFTER  `is_send_as_gift` ,ADD  `gift_wrap_note` TEXT NOT NULL AFTER  `gift_friend_email` ,ADD  `is_gift_wrap` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `gift_wrap_note` ,ADD  `user_address_id` BIGINT NULL DEFAULT  '0' AFTER  `gift_wrap_note` ;
ALTER TABLE  `carts` ADD INDEX (  `user_address_id` ) ;

ALTER TABLE  `order_items` ADD  `is_send_as_gift` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `quantity` ,ADD  `gift_friend_email` VARCHAR( 255 ) NOT NULL AFTER  `is_send_as_gift` ,ADD  `gift_wrap_note` TEXT NOT NULL AFTER  `gift_friend_email` ,ADD  `is_gift_wrap` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `gift_wrap_note` ,ADD  `gift_wrap_fee` DOUBLE( 10, 2 ) NOT NULL AFTER  `gift_wrap_note` ;

ALTER TABLE  `products` ADD  `maximum_quantity_to_send_as_gift` INT( 11 ) NULL AFTER  `quantity` ;

INSERT INTO `setting_categories` (`id`, `created`, `modified`, `name`, `description`) VALUES (29, '', '', 'Buy as Gift', 'You can update gift related settings here');

INSERT INTO  `settings` (`id` ,`setting_category_id` ,`name` ,`value` ,`description` ,`type` ,`options` ,`label` ,`order` ,`fieldset` ,`fieldset_order`) VALUES 
(NULL ,  '29',  'buy_as_gift.gift_wrap_fee_for_one_item',  '5',  '',  'text', NULL ,  'Gift wrap fee for one item',  '0',  '',  '0'),
(NULL ,  '29',  'buy_as_gift.gift_wrap_fee_for_additional_item',  '5',  '',  'text', NULL ,  'Gift wrap fee for additional item',  '0',  '',  '0');