<?php /* SVN: $Id: admin_add.ctp 1922 2010-05-18 14:03:06Z jayashree_028ac09 $ */ ?>
<div class="countries form">
            <?php echo $this->Form->create('Country', array('class' => 'normal clearfix','action'=>'add'));?>
        	<?php
        		echo $this->Form->input('name', array('label'=> __l('Name')));
        		echo $this->Form->input('fips104');
        		echo $this->Form->input('iso2');
        		echo $this->Form->input('iso3');
        		echo $this->Form->input('ison');
        		echo $this->Form->input('internet', array('label'=> __l('Internet')));
        		echo $this->Form->input('capital', array('label'=> __l('Capital')));
        		echo $this->Form->input('map_reference', array('label'=> __l('Map Reference')));
        		echo $this->Form->input('nationality_singular', array('label'=> __l('Nationality Singular')));
        		echo $this->Form->input('nationality_plural', array('label'=> __l('Nationality Plural')));
        		echo $this->Form->input('currency', array('label'=> __l('Currency')));
        		echo $this->Form->input('currency_code', array('label'=> __l('Currency Code')));
        		echo $this->Form->input('population', array('label' => __l('Population'),'info' => 'Eg.,: 2001600'));
        		echo $this->Form->input('title', array('label'=> __l('Title')));
        		echo $this->Form->input('comment', array('label'=> __l('Comment')));
        	?>
           <div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Add'));?></div>
   <?php echo $this->Form->end();?>
</div>