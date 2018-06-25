<div class="force_login form"> 
<?php if (Configure::read('site.force_login')): ?>
        <fieldset>             
			<div class="page-info">
				<?php echo __l('Here you can change the background image for the privateShop Login page.');?>
			</div>
            <?php
				echo $this->Form->create('User', array('url'=>array('action'=>'admin_customise_force_login'),'class' => 'normal', 'enctype' => 'multipart/form-data'));
			?>
  			<fieldset class="form-block ">
			<h3><?php echo __l('Background Image'); ?></h3>
            <?php	
				echo $this->Form->input('Attachment.filename', array('type' => 'file','size' => '33', 'label' => __l('Background'), 'class' =>'browse-field'));

				if(!empty($logo['Attachment'])){
				?>
				<div class="bgimg-input-block">
				<?php	echo $this->Form->input('Attachment.'.$logo['Attachment']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$logo['Attachment']['id'], 'label' => __l('Delete?'), 'class' => ' js-checkbox-list'));
				 ?>
                 
                    <div class="bg-img">
                    <?php
                        echo $this->Html->showImage('Login', $logo['Attachment'], array('dimension' => 'medium_thumb', 'alt' => Inflector::humanize($logo['Attachment']['description']) , 'title' => 'Force Login Background'));
                    ?></div> 
                 </div>
                

                <?php 
				} ?>	
                </fieldset>
                <div class="submit-block clearfix">
                <?php echo $this->Form->submit(__l('Update')); ?>
               </div>
            	<?php echo $this->Form->end(); ?>
        </fieldset>
		<?php else: ?>
		<div class="page-info">
				<?php echo __l('Site act as privateShop is currently disabled. You can enable it from').' '. $this->Html->link(__l('Settings'), array('controller' => 'settings', 'action' => 'edit', 3),array('title' => __l('Settings'))).' '.__l('page');?>
			</div>
		<?php endif; ?>
 </div>
