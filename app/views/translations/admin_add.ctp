<?php /* SVN: $Id: admin_add.ctp 17696 2010-08-05 12:37:07Z boopathi_026ac09 $ */ ?>
<div class="translations form">
<?php echo $this->Form->create('Translation', array('class' => 'normal'));?>
	<fieldset>
 	<?php
		echo $this->Form->input('from_language', array('value' => __l('English'), 'disabled' => true));
		echo $this->Form->input('language_id', array('label' => __l('To Language'))); ?>
<div class="clearfix translation-index-block">
	<div class="translation-left-block grid_left">
	<div class="clearfix">
  	<?php echo $this->Form->submit('Manual Translate', array('name' => 'data[Translation][manualTranslate]')); ?>
    </div>
    <span class="info"><?php echo __l('Manual Translate: It will only populate site labels for selected new language. You need to manually enter all the equivalent translated label');?> </span>
</div>
<div class="translation-right-block grid_left">
	<div class="clearfix">
	<?php echo $this->Form->submit('Google Translate', array('name' => 'data[Translation][googleTranslate]')); ?>
    </div>
	<span class="info"><?php echo __l('Google Translate: It will automatically translate site labels into selected language with Google');?></span>

</div>
</div>
	</fieldset>
<?php echo $this->Form->end();?>
</div>
