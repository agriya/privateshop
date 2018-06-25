<?php /* SVN: $Id: admin_edit.ctp 4657 2010-12-07 12:52:49Z siva_063at09 $ */ ?>
<div class="transactionTypes form">
	<?php echo $this->Form->create('TransactionType', array('class' => 'normal'));?>
		<fieldset>
		<?php
			echo $this->Form->input('id');
			echo $this->Form->input('name', array('label'=>__l('Name')));
		?>
		</fieldset>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Update')); ?>
			<div class="cancel-block">
				<?php echo $this->Html->link(__l('Cancel'), array('controller' => 'transaction_types', 'action' => 'index'), array('title' => __l('Cancel'))); ?>
			</div>
		</div>
	<?php echo $this->Form->end();?>
</div>