<div class="users form round-5">
<div class="clearfix">
<h2 class="grid_left"><?php echo __l('Register'); ?></h2>
<div class="open-id-block openid-block grid_right clearfix">
<h5 class="grid_left"><?php echo __l('Sign In using: '); ?></h5>
<ul class="open-id-list list clearfix">
	<li class="facebook">
		 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
			<?php echo $this->Html->link(__l('Sign up with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook', 'admin'=>false), array('title' => __l('Sign up with Facebook'), 'escape' => false)); ?>
		 <?php endif; ?>
	</li>
	<?php if(Configure::read('twitter.is_enabled_twitter_connect')):?>
		<li class="twitter"><?php echo $this->Html->link(__l('Sign up with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign up with Twitter')));?></li>
	<?php endif;?>
	<?php if(Configure::read('user.is_enable_openid')):?>
		<li class="yahoo"><?php echo $this->Html->link(__l('Sign up with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type' => 'yahoo', 'admin' => false), array('title' => __l('Sign up with Yahoo')));?></li>
		<li class="gmail"><?php echo $this->Html->link(__l('Sign up with Gmail'), array('controller' => 'users', 'action' => 'login', 'type' => 'gmail', 'admin' => false), array('title' => __l('Sign up with Gmail')));?></li>
		<li class="openid"><?php echo $this->Html->link(__l('Sign up with Open ID'), array('controller' => 'users', 'action' => 'login','type'=>'openid', 'admin'=>false), array('class'=>'js-ajax-colorbox-openid {source:"js-dialog-body-open-login"}','title' => __l('Sign up with Open ID')));?></li>
	<?php endif;?>
</ul>
</div>
</div>
<div class="common-outet-block">
<?php echo $this->Form->create('User', array('action' => 'register', 'class' => 'normal register')); ?>
	<fieldset class="round-5">
	<?php
		if(!empty($this->request->data['User']['openid_url'])):
			echo $this->Form->input('openid_url', array('type' => 'hidden', 'value' => $this->request->data['User']['openid_url']));
		endif;
		echo $this->Form->input('username');
		if(empty($this->request->data['User']['openid_url']) && empty($this->request->data['User']['fb_user_id']) && empty($this->request->data['User']['twitter_user_id'])):
			echo $this->Form->input('passwd', array('label' => __l('Password')));
		endif;
		echo $this->Form->input('email');
		if (!empty($this->request->data['User']['fb_user_id'])):
			echo $this->Form->input('fb_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['fb_user_id']));
			echo $this->Form->input('is_facebook_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_facebook_register']));
		endif;
		if (!empty($this->request->data['User']['twitter_user_id'])):
			echo $this->Form->input('twitter_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_user_id']));
			echo $this->Form->input('is_twitter_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_twitter_register']));
		endif;		 
		if (!empty($this->request->data['User']['twitter_access_token'])):
			echo $this->Form->input('twitter_access_token', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_access_token']));
		endif;		 
		if (!empty($this->request->data['User']['twitter_access_key'])):
			echo $this->Form->input('twitter_access_key', array('type' => 'hidden', 'value' => $this->request->data['User']['twitter_access_key']));
		endif;		 
		if (!empty($this->request->data['User']['is_yahoo_register'])):
			echo $this->Form->input('is_yahoo_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_yahoo_register']));
		endif;
		if (!empty($this->request->data['User']['is_gmail_register'])):
			echo $this->Form->input('is_gmail_register', array('type' => 'hidden', 'value' => $this->request->data['User']['is_gmail_register']));
		endif;
		if (!empty($this->request->data['User']['referred_by_user_id'])):
			echo $this->Form->input('referred_by_user_id', array('type' => 'hidden', 'value' => $this->request->data['User']['referred_by_user_id']));
		endif;		
		echo $this->Form->input('UserProfile.country_iso_code', array('type' => 'hidden'));
		echo $this->Form->input('State.name', array('type' => 'hidden'));
		echo $this->Form->input('City.name', array('type' => 'hidden'));
		if(empty($this->request->data['User']['openid_url'])and empty($this->request->data['User']['fb_user_id'])and empty($this->request->data['User']['twitter_user_id'])): ?>
        	<div class="input captcha-block clearfix js-captcha-container">
    			<div class="captcha-left grid_left">
    	           <?php echo $this->Html->image($this->Html->url(array('controller' => 'users', 'action' => 'show_captcha', 'register', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
    	        </div>
    	        <div class="captcha-right grid_left">
        	        <?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
        			<div>
						<?php echo $this->Html->link(__l('Click to play'), Router::url('/', true) . 'flash/securimage/play.swf?audio=' . $this->Html->url(array('controller' => 'users', 'action' => 'captcha_play'), true) . '&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19&wmode=transparent', array('class' => 'js-captcha-play')); ?>
					</div>
    	        </div>
            </div>
        	<?php echo $this->Form->input('captcha', array('label' => __l('Security Code'))); ?>
    		<?php echo $this->Form->input('is_agree_terms_conditions', array('label' => sprintf(__l('I have read, understood & agree to the %s'), $this->Html->link('Terms & Policies', array('controller' => 'pages', 'action' => 'display', 'terms'), array('target' => '_blank'))))); ?>
            <?php
        endif; ?>
        <div class="submit-block clearfix"><?php echo $this->Form->Submit(__l('Sign Up')); ?></div>
	</fieldset>
        <?php echo $this->Form->end(); ?>
        </div>
</div>