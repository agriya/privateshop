<div class="js-response js-clone">
<?php if (!empty($setting_categories['SettingCategory']['description'])):?>
	<div class="page-info"><?php 
	if(stristr($setting_categories['SettingCategory']['description'], '##PAYMENT_SETTINGS_URL##') === FALSE) {
		echo $setting_categories['SettingCategory']['description'];
	} else {
		$settingCategoriesReplace = array(
		            '##PAYMENT_SETTINGS_URL##' => $this->Html->link(__('Update Payment Gateway Settings'), array(
                    'controller' => 'payment_gateways',
                    'action' => 'index',
                )));
		echo strtr($setting_categories['SettingCategory']['description'], $settingCategoriesReplace);
	}	
	
	?> 
    </div>
<?php endif;?>
<?php
	if (!empty($settings)):
		echo $this->Form->create('Setting', array('action' => 'edit', 'class' => 'normal setting-add-form add-live-form'));
			echo $this->Form->input('setting_category_id', array('label' => __l('Setting Category'),'type' => 'hidden'));
		// hack to delete the thumb folder in img directory
		$inputDisplay = 0;
		$is_changed = $prev_cat_id = 0;
	
    	foreach ($settings as $setting):
				if($setting['Setting']['name'] == 'site.language'):
					$empty_language = 0;
					$get_language_options = $this->Html->getLanguage();
					if(!empty($get_language_options)):
						$options['options'] = $get_language_options;
					else:
						$empty_language = 1;
					endif;
				endif;
				$field_name = explode('.', $setting['Setting']['name']);
				if(isset($field_name[2]) && ($field_name[2] == 'is_not_allow_resize_beyond_original_size' || $field_name[2] == 'is_handle_aspect')){
					continue;
				}
				$options['type'] = $setting['Setting']['type'];
				$options['value'] = $setting['Setting']['value'];
				$options['div'] = array('id' => "setting-{$setting['Setting']['name']}");
				if($options['type'] == 'checkbox' && $options['value']):
					$options['checked'] = 'checked';
				endif;
				if($options['type'] == 'select'):
					$selectOptions = explode(',', $setting['Setting']['options']);
					$setting['Setting']['options'] = array();
					if(!empty($selectOptions)):
						foreach($selectOptions as $key => $value):
							if(!empty($value)):
								$setting['Setting']['options'][trim($value)] = trim($value);
							endif;
						endforeach;
					endif;
					$options['options'] = $setting['Setting']['options'];
				endif;	
				?>
				<?php
					if(empty($prev_cat_id)){
						$prev_cat_id = $setting['SettingCategory']['id'];
						$is_changed = 1;
					} else {
						$is_changed = 0;
						if($setting_categories['SettingCategory']['id'] != 10 && $setting['SettingCategory']['id'] != $prev_cat_id ){ ?>
							</fieldset>
						<?php
							$is_changed = 1;
							$prev_cat_id  = $setting['SettingCategory']['id'];	
						}				
					}
				?>
				<?php
					if(!empty($is_changed)):
						 if($setting_categories['SettingCategory']['id'] != 121) :
						 
					?>
					<fieldset  class="form-block" id="<?php echo $setting['SettingCategory']['name'];?>">
					<h3 id="<?php echo str_replace(' ','',$setting['SettingCategory']['name']); ?>"> <?php echo $setting['SettingCategory']['name']; ?></h3>
					<?php if (!empty($setting['SettingCategory']['description']) && $setting_categories['SettingCategory']['id'] != 10):?>
						<div class="page-info"><?php
							$findReplace = array(
								'##TRANSLATIONADD##' => $this->Html->link(Router::url('/', true).'admin/translations/add', Router::url('/', true).'/admin/translations/add', array('title' => __l('Translations add'))),										
							);
											
						 $setting['SettingCategory']['description'] = strtr($setting['SettingCategory']['description'], $findReplace);
						 echo $setting['SettingCategory']['description'];
						
						
						?> </div>
					<?php endif;?>
	
				<?php	
					endif;
					endif;
				?>
<?php		
		if(in_array( $setting['Setting']['id'], array(210, 208, 371, 226, 228, 224) ) ) : ?>
                     
                        <h3>
                           <?php echo (in_array($setting['Setting']['id'], array('210', 226) ) )? __l('Application Info') : ''; ?>
                           <?php echo (in_array($setting['Setting']['id'], array('208', 228) ) )? __l('Credentials') : ''; ?>
                           <?php echo (in_array($setting['Setting']['id'], array('371', 224) ) )? __l('Other Info') : ''; ?>
                        </h3>
						<?php if(in_array( $setting['Setting']['id'], array(208, 228, 145))):?>
                            <div class="page-info">
                                <?php 
                                    if($setting['Setting']['id'] == 208) : 
                                        echo __l('Here you can update Facebook credentials . Click \'Update Facebook Credentials\' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.');
                                    elseif($setting['Setting']['id'] == 228) :
                                        echo __l('Here you can update Twitter credentials like Access key and Accss Token. Click \'Update Twitter Credentials\' link below and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.');
                                    elseif($setting['Setting']['id'] == 145) : 
                                        echo __l('Here you can update Foursquare credentials . Click  \'Update Foursquare Credentials\' link below and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.');
                                    endif;
                                ?>
                            </div>
                        <?php endif;?>             
						<?php 
							if($setting['Setting']['id'] == 208) : ?>
							
							<div class="clearfix credentials-info-block">
							<div class="credentials-left">
						      	<div class="credentials-right">
        							<?php	echo $this->Html->link(__l('<span>Update Facebook Credentials</span>'), array('controller' => 'settings', 'action' => 'update_facebook',true), array('escape'=>false,'class' => 'facebook-link', 'title' => __l('Here you can update Facebook credentials . Click this link and Follow the steps. Please make sure that you have updated the API Key and Secret before you click this link.')));
                                    ?>
                                </div>
                            </div>
                            <div class="credentials-right-block">
                            <?php
                            elseif($setting['Setting']['id'] == 228) :
                            ?>
                            <div class="clearfix credentials-info-block">
                            <div class="credentials-left">
						      	<div class="credentials-right">
                                    <?php
                                    	echo $this->Html->link(__l('<span>Update Twitter Credentials</span>'), array('controller' => 'settings', 'action' => 'update_twitter',true), array('escape'=>false,'class' => 'twitter-link', 'title' => __l('Here you can update Twitter credentials like Access key and Accss Token. Click this link and Follow the steps. Please make sure that you have updated the Consumer Key and  Consumer secret before you click this link.')));
                                    ?>
                                </div>
                             </div>
                             <div class="credentials-right-block">
                            
                            <?php
                        	endif;
						?>
<?php 				endif; ?>                        
                
				<?php
					if($setting['Setting']['name'] == 'site.is_ssl_for_deal_buy_enabled' && !($ssl_enable)){
						$options['disabled'] = 'disabled';
					}
				?>
				<?php
				if($setting['Setting']['name'] == 'affiliate.commission_on_every_deal_purchase'):
				?>
					<div class="add-block affiliate-links">
					<?php
					echo $this->Html->link(__l('Commission Settings'), array('controller' =>'affiliate_types', 'action' => 'edit'), array('class' => 'affiliate-settings', 'title' => __l('Here you can update and modify affiliate types')));
					?>
					</div>
				<?php
				endif;
				?>
	
				<?php
					if($setting['Setting']['name'] == 'twitter.site_user_access_key' || $setting['Setting']['name'] == 'twitter.site_user_access_token' || $setting['Setting']['name'] == 'facebook.fb_access_token' || $setting['Setting']['name'] == 'facebook.fb_user_id' || $setting['Setting']['name'] == 'foursquare.site_user_fs_id' || $setting['Setting']['name'] == 'foursquare.site_user_access_token'):
					$options['readonly'] = TRUE;
					$options['class'] = 'disabled';		
					endif;				
					if($setting['Setting']['name'] == 'site.language'):
						$options['options'] = $this->Html->getLanguage();				
					endif;
					if($setting['Setting']['name'] == 'site.timezone_offset'):
						$options['options'] = $timezoneOptions;				
					endif;
					if($setting['Setting']['name'] == 'site.city'):
						$options['options'] = $cityOptions;
					endif;
					if($setting['Setting']['name'] == 'site.currency_id'):
						$options['options'] = $this->Html->getCurrencies();	
					endif;									
					$options['label'] = $setting['Setting']['label'];
									
					// if ($setting['Setting']['name'] == 'user.referral_deal_buy_time' || $setting['Setting']['name'] == 'user.referral_cookie_expire_time'):
					if(in_array($setting['Setting']['name'], array('user.referral_deal_buy_time', 'user.referral_cookie_expire_time', 'invite.referral_cookie_expire_time', 'invite.referral_purchase_time', 'affiliate.referral_cookie_expire_time'))):
						$options['after'] = __l('hrs') . '<span class="info">' . $setting['Setting']['description'] . '</span>';
					endif;
					if( in_array( $setting['Setting']['name'], array('wallet.min_wallet_amount', 'wallet.max_wallet_amount', 'user.minimum_withdraw_amount', 'user.maximum_withdraw_amount', 'invite.referral_amount', 'affiliate.payment_threshold_for_threshold_limit_reach', 'buy_as_gift.gift_wrap_fee_for_one_item', 'buy_as_gift.gift_wrap_fee_for_additional_item'))):
						$options['after'] = Configure::read('site.currency'). '<span class="info">' . $setting['Setting']['description'] . '</span>';
					endif;
					
					$findReplace = array(
								'##SITE_NAME##' => Configure::read('site.name'),
								'##MASTER_CURRENCY##' => $this->Html->link(Router::url('/', true).'admin/currencies', Router::url('/', true).'/admin/currencies', array('title' => __l('Currencies'))),
								'##USER_LOGIN##' => $this->Html->link(Router::url('/', true).'admin/user_logins', Router::url('/', true).'/admin/user_logins', array('title' => __l('User Logins'))),															
								'##REGISTER##' => $this->Html->link('registration', '#', array('title' => __l('registration'))),
					);
													
					$setting['Setting']['description'] = strtr($setting['Setting']['description'], $findReplace);
					if (!empty($setting['Setting']['description']) && empty($options['after'])):
						$options['help'] = "{$setting['Setting']['description']}";
					endif;					
					//default account
					if($is_module){
						if(!in_array($setting['Setting']['id'], array(ConstModuleEnableFields::Affiliate, ConstModuleEnableFields::Friends) )){
							$options['class'] = 'js-disabled-inputs';
						}
						else{
							$options['class'] = 'js-disabled-inputs-active';						
						}
						if(!$active_module && !in_array($setting['Setting']['id'], array(ConstModuleEnableFields::Affiliate, ConstModuleEnableFields::Friends) )){
							$options['disabled'] = 'disabled';
						}
					}
					if($is_submodule){
						if(in_array($setting['Setting']['setting_category_id'], array(ConstSettingsSubCategory::Commission) )){
							if(!in_array($setting['Setting']['id'], array(ConstModuleEnableFields::Commission) )){
								$options['class'] = 'js-disabled-inputs';
							}
							else{
								$options['class'] = 'js-disabled-inputs-active';						
							}
							if(!$active_submodule && !in_array($setting['Setting']['id'], array(ConstModuleEnableFields::Commission) )){
								$options['disabled'] = 'disabled';
							}
						}	
					}
					if(in_array($setting['Setting']['name'], array('facebook.like_box_title','facebook.feeds_code_title','twitter.tweets_around_city_title'))): 
					if($setting['Setting']['name'] == 'facebook.like_box_title')
					{
						$count = 1;
					} 
					elseif($setting['Setting']['name'] == 'facebook.feeds_code_title')
					{
						$count = 2;
					}
					elseif($setting['Setting']['name'] == 'twitter.tweets_around_city_title')
					{
						$count = 3;
					}
					?>
					<fieldset  class="form-block">
					<h3><?php echo __l('Widget #'). $count;?></h3>
                    <?php
					endif;
					
					if($setting['Setting']['name'] == 'barcode.is_barcode_enabled')
					{
						$options['onclick']='javascript:manage_bardiv(this.id);';
					}
					
					echo $this->Form->input("Setting.{$setting['Setting']['id']}.name", $options);
					if(in_array($setting['Setting']['name'], array('facebook.like_box','facebook.feeds_code','twitter.tweets_around_city'))): ?>
                    </fieldset>
                    <?php
					endif;
							   
					$inputDisplay = ($inputDisplay == 2) ? 0 : $inputDisplay;
					unset($options);
					if(in_array($setting['Setting']['id'], array(171) ) ) {
					?>
                        </div>
                        </div>
					<?php
					}
		endforeach;
		?> 
        </fieldset>
		<?php
		if(!empty($beyondOriginals)){
            echo $this->Form->input('not_allow_beyond_original', array('label' => __l('Not Allow Beyond Original'),'type' => 'select', 'multiple' => 'multiple', 'options' => $beyondOriginals));
        }
        if(!empty($aspects)){
            echo $this->Form->input('allow_handle_aspect', array('label' => __l('Allow Handle Aspect'),'type' => 'select', 'multiple' => 'multiple', 'options' => $aspects));
        } ?>
    <div class="submit-block clearfix">
    <?php	echo $this->Form->submit('Update'); ?>
    </div>
	<?php	echo $this->Form->end(); ?>
    <?php
	else:
?>
		<div class="notice"><?php echo __l('No settings available'); ?></div>
<?php
	endif;
?>
</div>
