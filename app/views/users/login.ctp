<div class="sign-in-block">
<?php if(Configure::read('site.force_login')): ?>
        <p class="member-block"><?php echo __l('Luxury brands. Hand-selected styles. Members-only prices.');?></p>
        <h2><?php echo __l('Member Sign In');?></h2>
<?php else: ?>
<div class="users form round-5">
	<div class="clearfix">
    <h2 class="grid_left"><?php echo __l('Login'); ?></h2>
    <div class="open-id-block openid-block grid_right clearfix">
    <h5 class="grid_left"><?php echo __l('Sign in using: '); ?></h5>
	<ul class="open-id-list list clearfix">
		<li class="facebook">
			 <?php if(Configure::read('facebook.is_enabled_facebook_connect')):  ?>
				<?php echo $this->Html->link(__l('Sign in with Facebook'), array('controller' => 'users', 'action' => 'login','type'=>'facebook', 'admin'=>false), array('title' => __l('Sign in with Facebook'), 'escape' => false)); ?>
			 <?php endif; ?>
		</li>
		<?php if(Configure::read('twitter.is_enabled_twitter_connect')):?>
			<li class="twitter"><?php echo $this->Html->link(__l('Sign in with Twitter'), array('controller' => 'users', 'action' => 'login',  'type'=> 'twitter', 'admin'=>false), array('class' => 'Twitter', 'title' => __l('Sign in with Twitter')));?></li>
		<?php endif;?>
		<?php if(Configure::read('user.is_enable_openid')):?>
			<li class="yahoo"><?php echo $this->Html->link(__l('Sign in with Yahoo'), array('controller' => 'users', 'action' => 'login', 'type' => 'yahoo', 'admin' => false), array('title' => __l('Sign in with Yahoo')));?></li>
			<li class="gmail"><?php echo $this->Html->link(__l('Sign in with Gmail'), array('controller' => 'users', 'action' => 'login', 'type' => 'gmail', 'admin' => false), array('title' => __l('Sign in with Gmail')));?></li>
			<li class="openid"><?php 	echo $this->Html->link(__l('Sign in with Open ID'), array('controller' => 'users', 'action' => 'login','type'=>'openid', 'admin'=>false), array('class'=>'js-ajax-colorbox-openid {source:"js-dialog-body-open-login"}','title' => __l('Sign in with Open ID')));?></li>
		<?php endif;?>
	</ul>
	</div>
	</div>
 </div>
<?php endif; ?>
<div class="common-outet-block ">
    <fieldset class="round-5">
    <?php
	    echo $this->Form->create('User', array('action' => 'login', 'class' => 'normal login-form'));
		echo $this->Form->input(Configure::read('user.using_to_login'));
	    echo $this->Form->input('passwd', array('label' => __l('Password')));
	?>
	<div class="clearfix">
	<?php
		echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' => __l('Remember me')));
	?>
    <?php if(Configure::read('site.force_login')): ?><div class="formleft grid_left"><?php endif; ?>
     <?php if(Configure::read('site.force_login')): ?></div><?php endif; ?>
     	<div class="forget-block grid_left">
       <?php
    	    echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin' => false),array('class'=>'forget', 'title' => __l('Forgot your password?')));
    	?>
    	<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') && !Configure::read('site.force_login')):
    	?> |
    	<?php
    			echo $this->Html->link(__l('Signup') , array('controller' => 'users',	'action' => 'register', 'admin' => false),array('title' => __l('Signup')));
    		endif;
            $f = (!empty($_GET['f'])) ? $_GET['f'] : (!empty($this->request->data['User']['f']) ? $this->request->data['User']['f'] : (($this->request->url != 'admin/users/login' && $this->request->url != 'users/login') ? $this->request->url : ''));
    		if(!empty($f)) :
                echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
            endif;
    	?>
  </div>
	</div>
      <div class="submit-block clearfix">
       	<?php echo $this->Form->submit(__l('Login')); ?>
       		<?php if(isset($this->params['named']['call_page'])):  ?>
			<div class="cancel js-cancel-block">
				<?php echo $this->Html->link(__l('Cancel'), '#', array('title' => __l('Never Mind'),'class' => "js-toggle-show-login {'container':'js-login-message', 'hide_container':'js-login-form'}"));?>
			</div>
           <?php endif; ?>
    	</div>
    <?php echo $this->Form->end(); ?>
	</fieldset>
	</div>
     
</div>
<?php if(Configure::read('site.force_login')): ?>
      <div class="sign-in-block sign-up-block">
        <h2><?php echo __l('Become a Member'); ?></h2>
<div class="common-outet-block ">
        <p class="member-block"><?php echo __l('Instant access to todays top designer labels, at up to 60% off retail.'); ?></p>
        <p class="member-block1"><?php echo __l('Membership is free, get inspired today!'); ?></p>
        <?php echo $this->Html->link(__l('Tell me more'), array('controller' => 'pages', 'action' => 'view', 'tell-me-more', 'admin' => false), array('class' => 'more', 'title' => __l('Tell me more')));?>
		<div class="clearfix">
			<div class="submit-block clearfix">
			  <div class="cancel"><?php echo $this->Html->link(__l('Signup') , array('controller' => 'users',	'action' => 'register', 'admin' => false),array('title' => __l('Signup')));?></div>
			</div>
		</div>
      </div>
      </div>
<?php endif; ?>