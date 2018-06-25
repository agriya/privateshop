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
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
	<?php echo $this->Html->charset(), "\n";?>
	<title><?php echo Configure::read('site.name');?> | <?php echo $this->Html->cText($title_for_layout, false);?></title>
	<?php
		echo $this->Html->meta('icon'), "\n";
		echo $this->Html->meta('keywords', $meta_for_layout['keywords']), "\n";
		echo $this->Html->meta('description', $meta_for_layout['description']), "\n";
		echo $this->Html->css(Configure::read('site.theme').'.cache', null, array('inline' => true));
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
// For other than Facebook (facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)), wrap it in comments for XHTML validation...
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '<!--', "\n";
endif;
    ?>
<meta content="<?php echo Configure::read('facebook.app_id'); ?>" property="og:app_id" />
<meta content="<?php echo Configure::read('facebook.app_id'); ?>" property="fb:app_id" />
<?php if(!empty($meta_for_layout['product_name'])):?>
	<meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
	<meta property='og:title' content='<?php echo $meta_for_layout['product_name'];?>'/>
<?php endif;?>
<?php if(!empty($meta_for_layout['product_image'])):?>
	<meta property="og:image" content="<?php echo $meta_for_layout['product_image'];?>"/>
<?php else:?>
	<meta property="og:image" content="<?php echo Router::url('/', true); ?>img/logo.png"/>
<?php
endif;

if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '-->', "\n";
endif;
?>
<?php
		echo $this->element('site_tracker', array('cache' => array('config' => 'sec')));
	?>
</head>
<body>
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
	<?php if($this->Auth->sessionValid() && $this->Auth->user('user_type_id') == ConstUserTypes::Admin): ?>
			<div class="clearfix admin-wrapper">
    			<h3 class="admin-site-logo grid_left">
					<?php echo $this->Html->link((Configure::read('site.name').' '.'<span>Admin</span>'), array('controller' => 'users', 'action' => 'stats', 'admin' => true), array('escape' => false, 'title' => (Configure::read('site.name').' '.'Admin')));?>
    			</h3>
                <p class="logged-info grid_left"><?php echo __l('You are logged in as Admin'); ?></p>
    			<ul class="clearfix admin-menu grid_right">
                    <li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit', $this->Auth->user('id')), array('title' => __l('My Account')));?></li>
					<li class="logout"><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));?></li>
				</ul>
			</div>
    <?php endif; ?>
	<div id="<?php echo $this->Html->getUniquePageId();?>" class="content container_24">
        <div id="header" class="clearfix<?php echo $meta; ?>">
        <div class="header-inner clearfix">
         <h1 class="grid_left"> <?php echo $this->Html->link(Configure::read('site.name'), '/', array('class' => Configure::read('site.name'))); ?></h1>
		<?php
            $cart_count = $this->Html->getUserCartCount($this->Auth->user('id'));
            $cart_count = !empty($cart_count) ? ' ('.$cart_count.')' : '';
        ?>
        <div class="grid_right clearfix">
       <div class="<?php if($this->Auth->sessionValid()) { ?>header-r-inner1 <?php } ?> clearfix">
          <ul class="global-menu grid_right">
			<?php if (!$this->Auth->sessionValid()): ?>
                <li class="login  <?php if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'login') { echo 'active'; } ?> "><?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login'),'class'=>'login-link'));?></li>
                <li  class="join  <?php if($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'register') { echo 'active'; } ?>" ><?php echo $this->Html->link(__l('Signup'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Join us'),'class'=>'login-link'));?></li>
            <?php endif; ?>
            <li><?php echo $this->Html->link(__l('Cart ').$cart_count, array('controller' => 'payments', 'action' => 'order', 'admin' => false), array('title' => __l('Cart')));?></li>
			<?php if($this->Auth->sessionValid()) { ?>
                <?php
                    $message_count = $this->Html->getUserUnReadMessages($this->Auth->user('id'));
                    $message_count = !empty($message_count) ? ' ('.$message_count.')' : '';

                ?>
                 <li class="inbox">
                        <?php echo $this->Html->link(__l('Inbox'), array('controller' => 'messages', 'action' => 'index'), array('title' => __l('Inbox'))); ?>
                        <?php echo $message_count; ?>
                    </li>
             <?php } ?>
            <?php if ($this->Auth->sessionValid()): ?>
                <li class="username clearfix">
                    <?php
                        $reg_type_class='normal';
                        if($this->Auth->user('is_openid_register')):
                            $reg_type_class='open-id';
                        endif;
                        if($this->Auth->user('fb_user_id')):
                            $reg_type_class='facebook';
                        endif;
						if($this->Auth->user('is_yahoo_register')):
                            $reg_type_class='yahoo';
                        endif;
						if($this->Auth->user('is_gmail_register')):
                            $reg_type_class='gmail';
                        endif;
						if($this->Auth->user('is_twitter_register')):
                            $reg_type_class='twitter';
                        endif;
                        $current_user_details = array(
                            'username' => $this->Auth->user('username'),
                            'user_type_id' =>  $this->Auth->user('user_type_id'),
                            'id' =>  $this->Auth->user('id'),
                            'fb_user_id' =>  $this->Auth->user('fb_user_id')
                        );
                    ?>
                    <span class="left-menu">
                     <span class="right-menu">
                     <span class="<?php echo $reg_type_class; ?>">
                        <?php
                            $current_user_details['UserAvatar'] = $this->Html->getUserAvatar($this->Auth->user('id'));
                            echo $this->Html->getUserLink($current_user_details);
                        ?>
                        </span>
                        </span>
                    </span>
                    <div class="sub-menu shadow">
          <div class="submenu-tl">
           <div class="submenu-tr">
		  <div class="submenu-tm clearfix"></div>
		  </div>	</div>
		  <div class="submenu-cl">
            <div class="submenu-cr">
              <div class="submenu-inner submenu-inner1 clearfix">
                        <?php if ($this->Html->isWalletEnabled('is_enable_for_add_to_wallet') && !empty($user_available_balance)): ?>
                            <h4><?php echo __l('Balance: '); ?><span><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($user_available_balance)); ?></span></h4>
                        <?php endif; ?>

                        <div class="clearfix sub-menu-block">
                        <ul class="sub-menu-inner-left grid_5 clearfix">
                            <li>
                                <h5><?php echo __l('My Stuff'); ?></h5>
                                <ul>
                                    <li><?php echo $this->Html->link(__l('Dashboard'), array('controller' => 'users', 'action' => 'dashboard'), array('title' => __l('Dashboard')));?></li>
                                    <?PHP if(Configure::read('messages.is_send_email_on_new_message')) { ?>
                                    <li><?php echo $this->Html->link(__l('Email settings'), array('controller' => 'user_notifications', 'action' => 'edit'), array('title' => __l('Email settings')));?></li>
                                    <?PHP } ?>
                                        <li><?php echo $this->Html->link(__l('My Account'), array('controller' => 'user_profiles', 'action' => 'edit'), array('title' => __l('My Account')));?></li>
										<?php if($this->Auth->user('user_type_id')!= ConstUserTypes::Admin && !$this->Auth->user('is_openid_register') && !$this->Auth->user('fb_user_id') && !$this->Auth->user('twitter_user_id') && !$this->Auth->user('is_gmail_register') && !$this->Auth->user('is_yahoo_register') && !$this->Auth->user('is_facebook_register') && !$this->Auth->user('is_twitter_register')): ?>
                                        <li><?php echo $this->Html->link(__l('Change Password'), array('controller' => 'users', 'action' => 'change_password'), array('title' => __l('Change Password')));?></li>
										<?php endif; ?>
                                        <li><?php echo $this->Html->link(__l('My Shipping Address'), array('controller' => 'user_addresses', 'action' => 'index'), array('title' => __l('My Shipping Address')));?></li>
                                    <li><?php echo $this->Html->link(__l('My Transactions'), array('controller' => 'transactions', 'action' => 'index', 'admin' => false), array('title' => 'My Transactions'));?></li>
                                    <li><?php echo $this->Html->link(__l('My Purchases'), array('controller' => 'orders', 'action' => 'index', 'type' => 'mypurchases', 'status_filter_id' => ConstOrderStatus::InProcess), array('title' => __l('My Purchases')));?></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="sub-menu-inner-right grid_5 clearfix">
                            <?php if ($this->Html->isWalletEnabled('is_enable_for_add_to_wallet')): ?>
                                <li>
                                    <h5><?php echo __l('Wallet'); ?></h5>
                                    <ul>
                                            <li><?php echo $this->Html->link(__l('Add Amount to Wallet'), array('controller' => 'payments', 'action' => 'add_to_wallet'), array('title' => __l('Add amount to wallet'))); ?></li>
                                        <?php if ((Configure::read('user.is_user_can_withdraw_amount') && $this->Auth->user('user_type_id') == ConstUserTypes::User)): ?>
                                            <li><?php echo $this->Html->link(__l('Withdraw Fund Request'), array('controller' => 'user_cash_withdrawals', 'action' => 'index'), array('title' => __l('Withdraw Fund Request')));?></li>
											<li><?php echo $this->Html->link(__l('Money Transfer Accounts'), array('controller' => 'money_transfer_accounts', 'action' => 'index'), array('title' => __l('Money Transfer Accounts')));?></li>

                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php  endif; ?>
							<?php if (configure::read('invite.is_referral_system_enabled')): ?>
                                <li>
                                    <h5><?php echo __l('Referral'); ?></h5>
                                    <ul>
                                            <li><?php echo $this->Html->link(__l('Refer Friends'), array('controller' => 'pages', 'action' => 'refer_a_friend'), array('title' => __l('Refer Friends'))); ?></li>
                                    </ul>
                                </li>
                            <?php  endif; ?>
                            <li class="logout"><?php echo $this->Html->link(__l('Logout'), array('controller' => 'users', 'action' => 'logout'), array('title' => __l('Logout')));?></li>
                        </ul>
                    </div>
                    </div>
                    </div>
                    </div>
                    <div class="submenu-bl">
            <div class="submenu-br">
              <div class="submenu-bm"></div>
            </div>
          </div>
                    </div>
                </li>
            <?php endif; ?>
            </ul>
          <?php $languages = $this->Html->getLanguage();
            if(Configure::read('user.is_allow_user_to_switch_language') && !empty($languages)) : ?>
          <div class="grid_right clearfix">
               <?php echo $this->Form->create('Language', array('action' => 'change_language', 'class' => 'normal language-form'));
                echo $this->Form->input('language_id', array('class' => 'js-autosubmit', 'options' => $languages, 'value' => isset($_COOKIE['CakeCookie']['user_language']) ?  $_COOKIE['CakeCookie']['user_language'] : Configure::read('site.language')));
                echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url));
                ?>
                <div class="hide">
                    <?php echo $this->Form->submit('Submit');  ?>
                </div>
                <?php
                echo $this->Form->end(); ?>
                </div>
            <?php endif; ?>
</div>
  		  <?php if(!$this->Auth->sessionValid()): ?>
              <div class="openid-block grid_right clearfix">
                    <h5 class="grid_left"><?php echo __l('Sign In using: '); ?></h5>
                    <ul class="open-id-list grid_right clearfix">
                        <li class="facebook">
                             <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
                                <?php echo $this->Html->link(__l('Sign in with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook'), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
                             <?php endif; ?>
                        </li>
                        <?php if(Configure::read('twitter.is_enabled_twitter_connect')):?>
                            <li class="twitter"><?php echo $this->Html->link(__l('Sign in with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign in with Twitter')));?></li>
                        <?php endif;?>
                            <li class="yahoo"><?php echo $this->Html->link(__l('Sign in with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type'=>'yahoo'), array('title' => __l('Sign in with Yahoo')));?></li>
                            <li class="gmail"><?php echo $this->Html->link(__l('Sign in with Gmail'), array('controller' => 'users', 'action' => 'login', 'type'=>'gmail'), array('title' => __l('Sign in with Gmail')));?></li>
                            <li class="openid"><?php 	echo $this->Html->link(__l('Sign in with OpenID'), array('controller' => 'users', 'action' => 'login','type'=>'openid'), array('class'=>'','title' => __l('Sign in with OpenID')));?></li>
                    </ul>
              </div>
          <?php endif; ?>

          </div>


        </div>
        <!--Category Menu block start -->
        <?php if (!(Configure::read('site.force_login') && !$this->Auth->sessionValid())):
        	echo $this->element('categories-index', array('cache' => array('config' => 'sec')));
		else:?>
		<div class="no-menu"></div>
		<?php endif;?>
        <!--Category Menu block end -->
        </div>
  		<div id="main" class="container_24 clearfix">
			<?php echo $content_for_layout;?>
		</div>
	<div id="footer">
    <div class="footer-inner-block clearfix">
      <div class="footer-left-block grid_7">
        <h6><?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?></h6>
    <div class="agriya clearfix">
	<p class="copy">&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?>. <?php echo __l('All rights reserved');?>.</p>
    <p class="powered clearfix"><span><a href="http://privateshop.dev.agriya.com/" title="<?php echo __l('Powered by PrivateShop');?>" target="_blank" class="powered"><?php echo __l('Powered by PrivateShop');?></a>,</span><span>made in</span> <?php echo $this->Html->link('Agriya Web Development', 'http://www.agriya.com/', array('target' => '_blank', 'title' => 'Agriya Web Development', 'class' => 'company'));?>  <span><?php echo Configure::read('site.version');?></span></p>
    <p class="cssilize"><?php echo $this->Html->link('CSSilized by CSSilize, PSD to XHTML Conversion', 'http://www.cssilize.com/', array('target' => '_blank', 'title' => 'CSSilized by CSSilize, PSD to XHTML Conversion', 'class' => 'cssilize'));?></p>
   </div>

      </div>
      <div class="footer-section grid_4">
        <h6><?php echo __l('Customer Service'); ?></h6>
        <ul class="footer-nav">
          <li><?php echo $this->Html->link(__l('Contact'), array('controller' => 'contacts', 'action' => 'add', 'admin' => false), array('title' => __l('Contact Us'), 'escape' => false));?></li>
        </ul>
      </div>
      <div class="footer-section grid_3">
        <h6><?php echo __l('About'); ?></h6>
        <ul class="footer-nav">
		  <li><?php echo $this->Html->link(__l('About'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' => __l('About')));?></li>
		  <li><?php echo $this->Html->link(__l('FAQ'), array('controller' => 'pages', 'action' => 'view', 'faq', 'admin' => false), array('title' => __l('FAQ')));?></li>
        </ul>
      </div>
      <div class="footer-section grid_4">
        <h6><?php echo __l('Policies'); ?></h6>
        <ul class="footer-nav">
		  <li><?php echo $this->Html->link(__l('Terms and Conditions'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms and Conditions')));?></li>
		  <li><?php echo $this->Html->link(__l('Privacy Policy'), array('controller' => 'pages', 'action' => 'view', 'privacy_policy', 'admin' => false), array('title' => __l('Privacy Policy')));?></li>
        </ul>
      </div>
      <div class="footer-section grid_4">
        <h6><?php echo __l('Connect with us'); ?></h6>
        <ul class="footer-nav">
           <li class="facebook"> <?php echo $this->Html->link(__l('Facebook'), Configure::read('facebook.site_facebook_url'), array('title' => __l('See Our Profile in Facebook'), 'target'=>'_blank', 'escape' => false));?></li>
           <li  class="twitter"> <?php echo $this->Html->link(__l('Twitter'),  Configure::read('twitter.site_twitter_url'), array('title' => __l('Follow Us in Twitter'), 'target'=>'_blank', 'escape' => false));?></li>
        </ul>
      </div>
    </div>
  </div>

	</div>
	<?php echo $this->element('sql_dump'); ?>
<?php if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'hashbang')) { ?>
</body>
</html>
<?php } ?>