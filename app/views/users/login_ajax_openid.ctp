<div class="sign-in-block users form js-login-response ajax-login-block">
	<h2><?php echo __l('Login via OpenID'); ?></h2>
		
	<div class="common-outet-block openid-login-block">
	<?php echo $this->Form->create('User', array('action' => 'login','class' => 'normal login-form')); ?>
		<div class="padd-bg-tl">
			<div class="padd-bg-tr">
				<div class="padd-bg-tmid"></div>
			</div>
		</div>
		<div class="padd-center">
			<?php
				if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') and Configure::read('user.is_enable_openid')):
					echo $this->Form->input('openid', array('id' => 'openid_identifier','class' => 'bg-openid-input', 'label' => __l('OpenID')));
					echo $this->Form->input('type', array('type' => 'hidden', 'value' => 'openid'));
				endif;
              ?>
			  <div class="clearfix">
			  <?php
				echo $this->Form->input('User.is_remember', array('type' => 'checkbox', 'label' => __l('Remember me on this computer.')));
			?>
			<div class="formleft">
				<?php echo $this->Html->link(__l('Forgot your password?') , array('controller' => 'users', 'action' => 'forgot_password', 'admin'=>false),array('title' => __l('Forgot your password?'),'class'=>'')); ?> |
				<?php if(!(!empty($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin')): ?>
					<?php echo $this->Html->link(__l('Register'), array('controller' => 'users', 'action' => 'register', 'admin' => false), array('title' => __l('Register'))); ?> |
					<?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login'))); ?>
				<?php endif; ?>
				<?php
					$f = (!empty($_GET['f'])) ? $_GET['f'] : (!empty($this->request->data['User']['f']) ? $this->request->data['User']['f'] : (($this->request->url != 'admin/users/login' && $this->request->url != 'users/login') ? $this->request->url : ''));
					if(!empty($f)) :
						echo $this->Form->input('f', array('type' => 'hidden', 'value' => $f));
					endif;
				?>

			</div>
        	</div>


		</div>
		<div class="padd-bg-bl">
			<div class="padd-bg-br">
				<div class="padd-bg-bmid"></div>
			</div>
		</div>
		<div class="clearfix submit-block">
			<?php echo $this->Form->submit(__l('Submit'));?>	
		</div> 
	<?php echo $this->Form->end();?>
	</div>
</div>
