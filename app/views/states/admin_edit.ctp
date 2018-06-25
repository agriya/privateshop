<?php /* SVN: $Id: admin_edit.ctp 1456 2010-04-28 08:53:26Z vinothraja_091at09 $ */ ?>
<div class="states form">
    <?php echo $this->Form->create('State',  array('class' => 'normal clearfix','action'=>'edit'));?>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('country_id', array('empty' => __l('Please select'),'label'=>__l('Country')));
        echo $this->Form->input('name', array('label'=> __l('Name')));
        echo $this->Form->input('code', array('label'=> __l('Code')));
        echo $this->Form->input('adm1code');
        echo $this->Form->input('is_approved', array('label' => __l('Approved?')));
    ?>
    <div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Update'));?></div>
    <?php echo $this->Form->end();?>
</div>
