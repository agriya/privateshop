<?php if (Configure::read('module.credits')): ?>
	<fieldset class="js-credit-block fields-block">
		<h3><?php echo __l('Credits'); ?></h3>
		<div>
			<?php
				echo $this->Form->input('credit_price', array('label' => __l('Price')));
				echo $this->Form->input('credits', array('label' => __l('Credits')));
				echo $this->Form->input('credit_expiry_date', array('orderYear' => 'asc', 'minYear' => date('Y')));
			?>
		</div>
	</fieldset>
<?php endif; ?>