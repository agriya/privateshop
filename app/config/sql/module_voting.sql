INSERT INTO `product_statuses` (`id` ,`created` ,`modified` ,`name` ,`product_count`) VALUES (9 ,  '',  '',  'Open For Voting',  '0');

DROP TABLE IF EXISTS `product_votings`;
CREATE TABLE IF NOT EXISTS `product_votings` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `voting` double(5,2) NOT NULL default '0.00',
  `ip_id` varchar(255) collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `ip_id` (`ip_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE  `products` ADD  `product_voting_count` BIGINT( 20 ) NOT NULL AFTER  `sales_lost_amount` ;
ALTER TABLE  `products` ADD  `total_votings` BIGINT( 20 ) NOT NULL AFTER  `product_voting_count` ;
ALTER TABLE  `users` ADD  `product_voting_count` BIGINT( 20 ) NOT NULL AFTER  `buyer_order_completed_count` ;