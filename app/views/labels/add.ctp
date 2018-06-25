<?php /* SVN: $Id: $ */ ?>
<h2 class="title"><?php echo __l('Create Label'); ?></h2>
<div class="alpha omega grid_6">
    <?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
</div>
<div class="common-outet-block alpha omega grid_18 grid_right">
<div class="labels form">
    <div class="form-blocks js-corner round-5">
        <?php
            echo $this->Form->create('Label', array('class' => 'normal js-form'));
            echo $this->Form->input('name'); ?>
            <div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Add')); ?></div>
            <?php echo $this->Form->end();
        ?>
    </div>
	</div>
</div>

