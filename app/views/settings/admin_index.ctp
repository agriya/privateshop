<ul class="setting-links   clearfix">
<?php
	foreach ($setting_categories as $setting_category):		
?>	<li class="grid_12 omega alpha">
        <div class="setting-details-info setting-category-<?php echo str_replace(',','',$setting_category['SettingCategory']['name']); ?>">
    	<h3><?php echo $this->Html->link($this->Html->cText($setting_category['SettingCategory']['name'], false), array('controller' => 'settings', 'action' => 'edit', $setting_category['SettingCategory']['id']), array('title' => $setting_category['SettingCategory']['name'], 'escape' => false)); ?></h3>
    
        <div class="js-truncate">
		<?php $settingCategoriesReplace = array(
		            '##PAYMENT_SETTINGS_URL##' => $this->Html->link(__('Update Payment Gateway Settings'), array(
                    'controller' => 'payment_gateways',
                    'action' => 'index',
                )));
       if($setting_category['SettingCategory']['id'] == 12){
          echo strtr($setting_category['SettingCategory']['description'], $settingCategoriesReplace);
       }
	   else{
	    echo $setting_category['SettingCategory']['description'];
	   }
		?>
        </div>
      
        </div>
	</li>
<?php
	endforeach;
?>
<li class="grid_12 omega alpha">
	<div class="setting-details-info setting-category-customize-login">
	<h3><?php echo $this->Html->link(__l('Customize PrivateShop Login'), array('controller' => 'users', 'action' => 'admin_customise_force_login'),array('title' => __l('Customize PrivateShop Login'))); ?></h3>

	<div class="js-truncate">
	<?php echo __l('Here you can change the background image for the privateShop Login page.');	?>
	</div>
  
	</div>
</li>
<li class="grid_12 omega alpha">
	<div class="setting-details-info setting-category-customize-landing-page">
	<h3><?php echo $this->Html->link(__l('Customize New Landing Page'), array('controller' => 'landing_page_photos', 'action' => 'admin_index'),array('title' => __l('Customize New Landing Page'))); ?></h3>

	<div class="js-truncate">
	<?php echo __l('Here you can update the landing page slideshow Image, Title, URL.');	?>
	</div>
  
	</div>
</li>
</ul>