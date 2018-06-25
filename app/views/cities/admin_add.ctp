<?php /* SVN: $Id: admin_add.ctp 1456 2010-04-28 08:53:26Z vinothraja_091at09 $ */ ?>
            <?php echo $this->Form->create('City', array('class' => 'normal clearfix','action'=>'add'));?>
            <?php
                echo $this->Form->input('country_id', array('empty' => __l('Please select'),'label'=>__l('Country')));
                echo $this->Form->input('state_id', array('empty' => __l('Please select'),'label'=>__l('State')));
                echo $this->Form->input('name', array('label'=> __l('Name')));
                echo $this->Form->input('latitude', array('label'=> __l('Latitude')));
                echo $this->Form->input('longitude', array('label'=> __l('Longitude')));
                echo $this->Form->input('timezone', array('label'=> __l('Timezone')));
                echo $this->Form->input('county', array('label'=> __l('County')));
                echo $this->Form->input('code', array('label'=> __l('Code')));
                echo $this->Form->input('is_approved', array('label' =>__l('Approved?')));
            ?>
           <div class="submit-block clearfix"> <?php echo $this->Form->submit(__l('Add'));?></div>
            <?php echo $this->Form->end();?>
