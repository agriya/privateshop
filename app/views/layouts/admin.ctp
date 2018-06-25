<?php
/* SVN FILE: $Id: default.ctp 7805 2008-10-30 17:30:26Z AD7six $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<?php if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'hashbang')) { ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo sprintf(__l('Admin - %s'), $this->Html->cText($title_for_layout, false)); ?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		echo $this->Html->css('admin.cache', null, array('inline' => true));
		$js_inline = "document.documentElement.className = 'js';";
		$js_inline .= 'var cfg = ' . $this->Javascript->object($js_vars_for_layout) . ';';
		$js_inline .= "(function() {";
		$js_inline .= "var js = document.createElement('script'); js.type = 'text/javascript'; js.async = true;";
		if (!$_jsPath = Configure::read('cdn.js')) {
			$_jsPath = Router::url('/', true);
		}
		$js_inline .= "js.src = \"" . $_jsPath . 'js/default.cache.js' . "\";";
		$js_inline .= "var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(js, s);";
		$js_inline .= "})();";
		echo $this->Javascript->codeBlock($js_inline, array('inline' => true));
		echo $this->element('site_tracker', array('cache' => array('config' => 'sec')));
	?>
</head>
<body class="admin">
<?php } ?>
<?php
	$meta = '';
	if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'hashbang') {
		$meta_arr = array(
			'title' => Configure::read('site.name') . ' | ' . $this->Html->cText($title_for_layout, false),
			'keywords' => $meta_for_layout['keywords'],
			'description' => $meta_for_layout['description'],
		);
		$meta = ' js-meta ' . str_replace('"', '\'', json_encode($meta_arr));
	}
?>
	<?php if ($this->Session->check('Message.error') || $this->Session->check('Message.success') || $this->Session->check('Message.flash')): ?>
		<div class="js-flash-message flash-message-block">
			<?php
				if ($this->Session->check('Message.error')):
					echo $this->Session->flash('error');
				endif;
				if ($this->Session->check('Message.success')):
					echo $this->Session->flash('success');
				endif;
				if ($this->Session->check('Message.flash')):
					echo $this->Session->flash();
				endif;
			?>
		</div>
	<?php endif; ?>
	<div id="<?php echo $this->Html->getUniquePageId();?>" class="admin-content">
    <div class="admin-container-24 clearfix">
        	<div id="header" class="clearfix<?php echo $meta; ?>">
			<div class="header-top-content clearfix">
	  			<h1 class="grid_4 mega alpha">
					<?php echo $this->Html->link((Configure::read('site.name').' '.'<span>Admin</span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false, 'title' => (Configure::read('site.name').' '.'Admin')));?>
    			</h1>
				<ul class="admin-menu grid_right clearfix">
					<li><?php echo $this->Html->link(__l('View Site'), '/', array('title' => __l('View Site')));?></li>
                    <li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('title' => __l('My Account')));?></li>
                    <li><?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true),array('title' => __l('Diagnostics'))); ?></li>
                    <li><?php echo $this->Html->link(__l('Tools'), array('controller' => 'pages', 'action' => 'display', 'tools', 'admin' => true), array('title' => __l('Tools'))); ?></li>
                   	<li><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));?></li>
				</ul>
          </div>
            	<?php echo $this->element('admin-sidebar', array('cache' => array('config' => 'sec'))); ?>
                <div class="header-bottom-content clearfix">
            	<p class="admin-welcome-info grid_10 omega alpha"><?php echo __l('Welcome, ').$this->Html->link($this->Auth->user('username'), array('controller' => 'users', 'action' => 'stats', 'admin' => true),array('title' => $this->Auth->user('username'))); ?></p>
                </div>
			</div>

		<div id="main" class="clearfix">
		<?php 
				$user_menu = array('users', 'user_profiles', 'user_logins', 'user_views', 'user_addresses');
				$product_menu = array('products', 'product_views', 'product_downloads', 'attributes', 'orders');
				$message_menu = array('messages');
				$payment_menu = array('payment_gateways', 'transactions', 'user_cash_withdrawals');
				$master_menu = array('banned_ips', 'cities',  'countries', 'states', 'languages', 'translations',  'pages', 'email_templates', 'categories', 'landing_page_photos', 'order_statuses', 'product_statuses','transaction_types','ips');
				$diagnostics_menu = array('paypal_transaction_logs','devs');
				$settings_menu = array('settings');
				if(in_array($this->request->params['controller'], $user_menu) && $this->request->params['action'] != 'admin_diagnostics' && $this->request->params['action'] != 'admin_customise_force_login') {
					$class = "user-title";
				} elseif(in_array($this->request->params['controller'], $product_menu)) {
					$class = "product-title";
				} elseif(in_array($this->request->params['controller'], $message_menu)) {
					$class = "message-title";
				} elseif(in_array($this->request->params['controller'], $payment_menu)) {
					$class = "payment-title";
				} elseif(in_array($this->request->params['controller'], $master_menu)) {
					$class = "master-title";
				} elseif(in_array($this->request->params['controller'], $diagnostics_menu)) {
					$class = "diagnostics-title";
				} elseif(in_array($this->request->params['controller'], $settings_menu) || $this->request->params['action'] == 'admin_customise_force_login') {
					$class = "settings-title";
				}elseif($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_diagnostics') {
					$class = "diagnostics-title";
				}
				if(($this->request->params['controller'] == 'users' && ($this->request->params['action'] == 'admin_stats'))){
                echo $content_for_layout;
				} else { ?>
		 <div class="admin-side1-tl">
         <div class="admin-side1-tr">
         <div class="admin-side1-tm clearfix">
         <h2 class="ribbon-title clearfix <?php echo $class; ?>">
							<?php if($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'index') { ?>
								<?php echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));?>
							<?php }elseif($this->request->params['controller'] == 'settings' && $this->request->params['action'] == 'admin_edit' ) { ?>
								<?php echo $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'index'), array('title' => __l('Back to Settings')));?> &raquo; <?php echo $setting_categories['SettingCategory']['name']; ?>
							<?php } elseif(in_array( $this->request->params['controller'], $diagnostics_menu) || $this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_logs') { ?>
							<?php echo $this->Html->link(__l('Diagnostics'), array('controller' => 'users', 'action' => 'diagnostics', 'admin' => true), array('title' => __l('Diagnostics')));?> &raquo; <?php echo $this->pageTitle;?>
							<?php } else { ?>
								<?php echo $this->pageTitle; ?>
							<?php }
				            if(($this->request->params['controller'] == 'settings') || ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_customise_force_login') || ($this->request->params['controller'] == 'landing_page_photos' && $this->request->params['action'] == 'admin_index')) {?>
							<span class="setting-info info grid_right"><?php echo __l('To reflect setting changes, you need to') . ' ' . $this->Html->link(__l('clear cache'), array('controller' => 'devs', 'action' => 'clear_cache', '?f=' . $this->request->url), array('title' => __l('clear cache'), 'class' => 'js-delete'));  ?>.</span>
								<?php
								}?>
						</h2>
        </div>
        </div>
        </div>
		 <div class="admin-side1-cl">
         <div class="admin-side1-cr clearfix">
    			<?php echo $content_for_layout;?>
         </div>
         </div>
		  <div class="admin-side1-bl">
         <div class="admin-side1-br">
         <div class="admin-side1-bm">
            </div>
        </div>
        </div>
   	<?php } ?>
		</div>
 	</div>
		<div id="footer">
				<div class="agriya">
          	    <p class="grid_left">&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?>. <?php echo __l('All rights reserved');?>.</p>
    		    <p class="powered grid_left"><span><a href="http://privateshop.dev.agriya.com/" title="<?php echo __l('Powered by Privateshop');?>" target="_blank" class="powered"><?php echo __l('Powered by Privateshop');?></a>,</span> <span>made in</span> <?php echo $this->Html->link('Agriya Web Development', 'http://www.agriya.com/', array('target' => '_blank', 'title' => 'Agriya Web Development', 'class' => 'company'));?>  <span><?php echo Configure::read('site.version');?></span></p>
    	        <p class="grid_left"><?php echo $this->Html->link('CSSilized by CSSilize, PSD to XHTML Conversion', 'http://www.cssilize.com/', array('target' => '_blank', 'title' => 'CSSilized by CSSilize, PSD to XHTML Conversion', 'class' => 'cssilize'));?></p>
        	</div>
		</div>
		</div>

	<?php echo $this->element('sql_dump'); ?>
<?php if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'hashbang')) { ?>
</body>
</html>
<?php } ?>