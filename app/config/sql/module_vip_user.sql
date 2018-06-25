ALTER TABLE `products` ADD  `vip_start_date` DATETIME NOT NULL AFTER  `end_date` , ADD  `is_vip_product` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `vip_start_date` , ADD  `vip_discount_percentage` DOUBLE( 10, 2 ) NOT NULL AFTER  `is_vip_product` , ADD  `vip_discount_amount` DOUBLE( 10, 2 ) NOT NULL AFTER  `vip_discount_percentage` , ADD  `vip_discount_id` INT( 11 ) NOT NULL AFTER  `vip_discount_amount`;

ALTER TABLE  `users` ADD  `is_vip_user` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `is_twitter_register` , ADD  `vip_subscription_end_date` DATE NOT NULL AFTER  `is_vip_user` ;

DROP TABLE IF EXISTS `vip_users`;
CREATE TABLE IF NOT EXISTS `vip_users` (
  `id` bigint(20) NOT NULL auto_increment,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `payment_gateway_id` int(11) NOT NULL,
  `is_paid` tinyint(1) NOT NULL default '0',
  `paid_amount` double(10,2) NOT NULL,
  `subscription_end_date` date NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE  `users` ADD  `vip_user_count` BIGINT NOT NULL AFTER  `order_item_count` ;

INSERT INTO  `payment_gateway_settings` (`id` ,`created` ,`modified` ,`payment_gateway_id` ,`key` ,`type` ,`options` ,`test_mode_value` ,`live_mode_value` ,`description`) VALUES 
(NULL ,  '2010-07-15 12:21:33',  '2010-07-15 12:21:33',  '1',  'is_enable_for_vip_subscription',  'checkbox',  '',  '1',  '1',  'Enable/Disable the current payment option for vip subscription.'),
(NULL ,  '2010-07-15 12:21:33',  '2010-07-15 12:21:33',  '2',  'is_enable_for_vip_subscription',  'checkbox',  '',  '1',  '1',  'Enable/Disable the current payment option for vip subscription.');

INSERT INTO `transaction_types` (`id`, `created`, `modified`, `name`, `is_credit`, `message`, `transaction_variables`) VALUES
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Subscribed as VIP user', 0, 'Subscribed as VIP user', '');

INSERT INTO `setting_categories` (`id`, `created`, `modified`, `name`, `description`) VALUES (27, '', '', 'VIP', 'VIP user related settings.');

INSERT INTO `settings` (`id`, `setting_category_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`, `fieldset`, `fieldset_order`) VALUES 
(NULL, '27', 'vip.subscription_amount', '10', '', 'text', NULL, 'VIP subscription amount', '', '', ''),
(NULL, '27', 'vip.subscription_upto_valid_for_in_days', '30', 'in days', 'text', NULL, 'Subscription upto valid from payment date', '', '', ''),
(NULL, '27', 'vip.additional_discount_percentage_from_product_price', '10', 'in percentage', 'text', NULL, 'VIP user additional discount from product price', '', '', ''),
(NULL, '27', 'vip.flat_discount_amount_for_product_purchase', '10', NULL, 'text', NULL, 'Flat discount amount for VIP user', '', '', '');

ALTER TABLE  `orders` ADD  `is_new_vip_user` TINYINT( 1 ) NOT NULL DEFAULT  '0' AFTER  `phone` ;

INSERT INTO `settings` (`id`, `setting_category_id`, `name`, `value`, `description`, `type`, `options`, `label`, `order`, `fieldset`, `fieldset_order`) VALUES
(NULL, 27, 'vip.send_renew_mail_days_before', '7', 'Send renew mail the days before', 'text', NULL, 'Renew mail will send to user only mentioned days before expire ', 0, '', 0),
(NULL, 27, 'vip.renew_page_to_show_days_before', '2', 'Renew option show the days before', 'text', NULL, 'Renew form will visible to user only mentioned days before expire', 0, '', 0);

INSERT INTO `email_templates` (`id`, `created`, `modified`, `from`, `reply_to`, `name`, `description`, `subject`, `email_content`, `email_variables`) VALUES
(null, '0000-00-00 00:00:00', '2011-06-03 13:21:03', '##FROM_EMAIL##', '', 'Renewal alert', 'Internal mail sent to\r\nthe\r\nuser regarding the renewal alert', 'You VIP membership is going to expire', 'You VIP membership is going to expire. \r\n\r\nkindly renewal your membership and enjoy the features in ##SITE_NAME##\r\n\r\nURl: ##URL##', 'SITE_NAME,URL');

ALTER TABLE  `products` ADD  `vip_credits` INT( 10 ) NULL AFTER  `end_date` ;