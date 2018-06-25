DROP TABLE IF EXISTS `gift_cards`;
CREATE TABLE IF NOT EXISTS `gift_cards` (
  `id` int(11) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `amount_to_pay` double(10,2) NOT NULL,
  `gift_card_user_count` bigint(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `gift_card_users`;
CREATE TABLE IF NOT EXISTS `gift_card_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `gift_card_id` bigint(20) NOT NULL,
  `payment_gateway_id` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL,
  `paid_amount` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `redeem_code` varchar(50) collate utf8_unicode_ci NOT NULL,
  `is_redeemed` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `payment_gateway_id` (`payment_gateway_id`),
  KEY `gift_card_id` (`gift_card_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE  `users` ADD  `gift_card_user_count` BIGINT NOT NULL AFTER  `order_item_count` ;

INSERT INTO  `payment_gateway_settings` (`id` ,`created` ,`modified` ,`payment_gateway_id` ,`key` ,`type` ,`options` ,`test_mode_value` ,`live_mode_value` ,`description`) VALUES 
(NULL ,  '2010-07-15 12:21:33',  '2010-07-15 12:21:33',  '1',  'is_enable_for_gift_card_purchase',  'checkbox',  '',  '1',  '1',  'Enable/Disable the current payment option for purchase gift card.'),
(NULL ,  '2010-07-15 12:21:33',  '2010-07-15 12:21:33',  '2',  'is_enable_for_gift_card_purchase',  'checkbox',  '',  '1',  '1',  'Enable/Disable the current payment option for purchase gift card.');

INSERT INTO `transaction_types` (`id`, `created`, `modified`, `name`, `is_credit`, `message`, `transaction_variables`) VALUES
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gift card purchased by user', 0, 'Gift card purchased by user ##USER##', 'USER'),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Gift card amount credited in user wallet', 1, 'Gift card amount credited in user ##USER## wallet', 'USER');

INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_content`, `email_variables`) VALUES
(NULL, '0000-00-00 00:00:00', '2011-06-03 13:21:03', '##FROM_EMAIL##', '', 'Gift purchase notification', 'Internal mail sent to\r\nthe\r\nuser when he makes a new gift card purchase.', 'You have purchased gift card', 'You have purchased new gift card in ##SITE_NAME##\r\n\r\nRedeem Code:##REDEEM_CODE##\r\n\r\nRedeem Url:##URL##\r\n\r\nNote: Keep it your redeem code as confidential and safe.', 'SITE_NAME,USERNAME,REDEEM_CODE,URL');