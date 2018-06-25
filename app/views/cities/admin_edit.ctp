<?php /* SVN: $Id: admin_edit.ctp 1456 2010-04-28 08:53:26Z vinothraja_091at09 $ */ ?>
<div class="cities form">
    <?php echo $this->Form->create('City', array('class' => 'normal clearfix','action'=>'edit'));?>
    <?php
        echo $this->Form->input('id');
        echo $this->Form->input('country_id', array('empty' => __l('Please select'),'label'=>__l('Country')));
        echo $this->Form->input('state_id', array('empty' => __l('Please select'),'label'=>__l('State')));
		if (!empty($id_default_city)) {
			echo $this->Form->input('name',array('label' => __l('Name'), 'readonly' => true, 'info' => __l('You can not change default city name.')));
		} else {
			echo $this->Form->input('name',array('label' => __l('Name')));
		}
//                echo $this->Form->input('latitude', array('label'=> __l('Latitude')));
//                echo $this->Form->input('longitude', array('label'=> __l('Longitude')));
//                echo $this->Form->input('timezone', array('label'=> __l('Timezone')));
//               echo $this->Form->input('county', array('label'=> __l('County')));
//                echo $this->Form->input('code', array('label'=> __l('Code')));
		if(Configure::read('site.city') != $this->request->data['City']['slug']):
			echo $this->Form->input('is_approved', array('label' =>__l('Approved?')));
		endif;
    ?>
        <div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Update'));?></div>
        <?php echo $this->Form->end();?>
</div>
  
 
