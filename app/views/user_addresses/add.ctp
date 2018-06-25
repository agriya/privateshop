<?php /* SVN: $Id: $ */ ?>
<div class="userAddresses form">
<fieldset class="fields-block">
	<h3><?php echo __l('Add Shipping Address');?></h3>
	<?php echo $this->Form->create('UserAddress', array('class' => 'normal user-address-form'));?>
		<?php 
			echo $this->Form->input('user_id',array('type' => 'hidden'));
			echo $this->Form->input('full_name', array('label' => __l('Full Name')));
		?>
		<div class="mapblock-info">
			<div class="clearfix address-input-block">
				<?php echo $this->Form->input('UserAddress.address', array('label' => __l('Address'), 'class'=> 'js-preview-address-change','id' => 'UserAddressAddressSearch')); ?>
			</div>
			<?php
				echo $this->Form->input('country_id',array('id'=>'js-country_id','type' => 'hidden'));
				echo $this->Form->input('State.name', array('type' => 'hidden'));
				echo $this->Form->input('City.name', array('type' => 'hidden'));
			?>
			<div id="address-info" class="hide"><?php echo __l('Please select correct address value'); ?></div>
			<div id="mapblock">
				<div id="mapframe">
					<div id="mapwindow"></div>
				</div>
			</div>
		</div>
		<?php
			echo $this->Form->input('zipcode');
			echo $this->Form->input('phone');
			echo $this->Form->input('is_active', array('label' => __l('Active')));			
		?>
		<div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Add'));?>
		</div>
	<?php echo $this->Form->end();?>

</fieldset>
</div>