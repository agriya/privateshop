<?php /* SVN: $Id: admin_edit.ctp 5567 2010-05-25 14:50:11Z senthilkumar_017ac09 $ */ ?>
<div class="translations form">
<?php echo $this->Form->create('Translation', array('class' => 'normal'));?>
	<fieldset>
 		<legend><?php echo $this->Html->link(__l('Translations'), array('action' => 'index'),array('title' => __l('Translations')));?> &raquo; <?php echo __l('Edit Translation');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('language_id');
		echo $this->Form->input('key');
		echo $this->Form->input('lang_text');
	?>
	</fieldset>
	<div class="submit-block clearfix">
<?php echo $this->Form->submit(__l('Update'));?>
</div>
<?php echo $this->Form->end();?>
</div>
