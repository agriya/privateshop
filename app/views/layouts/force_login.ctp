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
<meta content="<?php echo Configure::read('facebook.fb_app_id'); ?>" property="og:app_id" />
<meta content="<?php echo Configure::read('facebook.fb_app_id'); ?>" property="fb:app_id" />
<meta property="og:site_name" content="<?php echo Configure::read('site.name'); ?>"/>
<?php if (!empty($meta_for_layout['title'])): ?>
<meta property="og:title" content="<?php echo $meta_for_layout['title']; ?>"/>
<?php else: ?>
<meta property="og:title" content="<?php echo Configure::read('site.name'); ?>"/>
<?php endif; ?>
<?php if (!empty($meta_for_layout['image'])): ?>
<meta property="og:image" content="<?php echo $meta_for_layout['image']; ?>"/>
<?php else: ?>
<meta property="og:image" content="<?php echo Router::url('/', true); ?>img/logo.png"/>
<?php endif; ?>
<?php
if (strpos(env('HTTP_USER_AGENT'), 'facebookexternalhit')===false):
    echo '-->', "\n";
endif;
// <--
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
<?php
	$original_image = '';
	if (!empty($background_attachment['Attachment']['id']) && empty($this->request->params['requested']) && $this->request->params['controller'] != 'images'):
		$original_image = $this->Html->getImageUrl('Login', $background_attachment['Attachment'], array('dimension' => 'original'));
	endif; 
	
?>
	<div id="bg-stretch"> <img src="<?php echo $original_image; ?>" alt=""/> </div>
	<div id="<?php echo $this->Html->getUniquePageId();?>" class="login-page content">
    <div class="login-block clearfix">
        <div id="header" class="clearfix">
            <h1 class="login-logo"><?php echo $this->Html->link(Configure::read('site.name'), '/', array('class' => Configure::read('site.name'))); ?></h1>
        </div>
  		<div class="login-inner-block clearfix">
				<?php echo $content_for_layout;?>
		</div>
     </div>
			<div class="footer clearfix">
    <ul class="footer-nav1 grid_left">
		  <li><?php echo $this->Html->link(__l('About'), array('controller' => 'pages', 'action' => 'view', 'about', 'admin' => false), array('title' => __l('About')));?></li>
		  <li><?php echo $this->Html->link(__l('Terms and Conditions'), array('controller' => 'pages', 'action' => 'view', 'term-and-conditions', 'admin' => false), array('title' => __l('Terms and Conditions')));?></li>
		  <li><?php echo $this->Html->link(__l('Privacy Policy'), array('controller' => 'pages', 'action' => 'view', 'privacy_policy', 'admin' => false), array('title' => __l('Privacy Policy')));?></li>
    </ul>
    <p class="copy grid_left">&copy;<?php echo date('Y');?> <?php echo $this->Html->link(Configure::read('site.name'), Router::Url('/',true), array('title' => Configure::read('site.name'), 'escape' => false));?>. <?php echo __l('All rights reserved');?>.</p>
    <div class="footer-share-block grid_right clearfix"> <span class="grid_left"><?php echo __l('Follow Us'); ?></span>
      <ul class="footer-nav2 grid_left">
          <li class="facebook"> <?php echo $this->Html->link(__l('Facebook'), Configure::read('facebook.site_facebook_url'), array('title' => __l('See Our Profile in Facebook'), 'escape' => false));?></li>
          <li  class="twitter"> <?php echo $this->Html->link(__l('Twitter'),  Configure::read('twitter.site_twitter_url'), array('title' => __l('Follow Us in Twitter'), 'escape' => false));?></li>
      </ul>
    </div>
  </div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
<?php if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'hashbang')) { ?>
</body>
</html>
<?php } ?>