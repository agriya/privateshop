<?php if (Configure::read('module.seller')): ?>
	<?php
		if (empty($this->request->data['Product']['bonus_amount'])) {
			$this->request->data['Product']['bonus_amount'] = Configure::read('seller.bonus_amount');
		}
		if (empty($this->request->data['Product']['commission_percentage'])) {
			$this->request->data['Product']['commission_percentage'] = Configure::read('seller.commission_percentage');
		}
	?>
	<fieldset class="fields-block">
		<h3><?php echo __l('Commission from Seller'); ?></h3>
		<div class="js-subitem-not-need">
			<div class="page-info"><?php echo __l('Total Commission Amount = Bonus Amount + (Total Purchased Amount * Commission Percentage/100)'); ?></div>
			<div class="clearfix">
				<div class="commision-form-block">
					<?php echo $this->Form->input('bonus_amount', array('label' => __l('Bonus Amount'))); ?>
					<span class="info"><?php echo __l('This is the flat fee that the seller will pay for the whole product.');?></span>
					<?php 
						echo $this->Form->input('commission_percentage', array('info' => __l('This is the commission that seller  will pay for the whole product in percentage.'), 'label' => __l('Commission (%)')));
					?>
				</div>
			</div>
		</div>
	</fieldset>
<?php endif; ?>