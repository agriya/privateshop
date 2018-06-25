
<div class="main-section contacts-form round-5">
<div class="user-profile-form">
    <?php
        echo $this->Form->create('Contact', array('class' => 'normal clearfix')); ?>
		    <h2><?php echo __l('Contact'); ?></h2>
	<fieldset class="fields-block">
	<?php
        echo $this->Form->input('first_name', array('label' => __l('First Name')));
        echo $this->Form->input('last_name', array('label' => __l('Last Name')));
        echo $this->Form->input('email');
        echo $this->Form->input('telephone');
        echo $this->Form->input('subject');
        echo $this->Form->input('message');
    ?>
    <div class="captcha-block clearfix js-captcha-container">
        <div class="captcha-left grid_left">
            <?php echo $this->Html->image($this->Html->url(array('controller' => 'contacts', 'action' => 'show_captcha', md5(uniqid(time()))), true), array('alt' => __l('[Image: CAPTCHA image. You will need to recognize the text in it; audible CAPTCHA available too.]'), 'title' => __l('CAPTCHA image'), 'class' => 'captcha-img'));?>
        </div>
        <div class="captcha-right grid_left">
            <?php echo $this->Html->link(__l('Reload CAPTCHA'), '#', array('class' => 'js-captcha-reload captcha-reload', 'title' => __l('Reload CAPTCHA')));?>
        	<div>
			  <?php echo $this->Html->link(__l('Click to play'), Router::url('/', true)."flash/securimage/play.swf?audio=". $this->Html->url(array('controller' => 'users', 'action'=>'captcha_play'), true) ."&bgColor1=#777&bgColor2=#fff&iconColor=#000&roundedCorner=5&height=19&width=19", array('class' => 'js-captcha-play')); ?>
		   </div>
        </div>
    </div>
    <?php
        echo $this->Form->input('captcha', array('label' => __l('Security Code')));
	?>
	<div class="submit-block clearfix">	
	<?php
		echo $this->Form->submit(__l('Send'));
	?>
	</div>
	   	</fieldset>
	<?php
        echo $this->Form->end();
    ?>
</div>
</div>

