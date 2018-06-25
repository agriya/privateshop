<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="users index js-response">
	   <ul class="filter-list-block filter-list clearfix">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>><span class="green-block" title="<?php echo __l('Active Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($active,false).'<span>' .__l('Active Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> </li>
            <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Inactive Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($inactive,false).'<span>' .__l('Inactive Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span> </li>
            <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Site) { echo 'class="active"';} ?>><span class="brown-block" title="<?php echo __l('Site Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($site,false).'<span>' .__l('Site Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Site), array('escape' => false));?></span> </li>
            <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::OpenID) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('OpenID Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($openid,false).'<span>' .__l('OpenID Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::OpenID), array('escape' => false));?></span> </li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Facebook) { echo 'class="active"';} ?>><span class="blue-block" title="<?php echo __l('Facebook Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($facebook,false).'<span>' .__l('Facebook Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Facebook), array('escape' => false));?></span> </li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Twitter) { echo 'class="active"';} ?>><span class="lightblue-block" title="<?php echo __l('Twitter Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($twitter,false).'<span>' .__l('Twitter Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Twitter), array('escape' => false));?></span> </li>
     		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Gmail) { echo 'class="active"';} ?>><span class="gmail-block" title="<?php echo __l('Gmail Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($gmail,false).'<span>' .__l('Gmail Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Gmail), array('escape' => false));?></span> </li>
     		<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Yahoo) { echo 'class="active"';} ?>><span class="yahoo-block" title="<?php echo __l('Yahoo Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($yahoo,false).'<span>' .__l('Yahoo Users'). '</span>', array('controller'=>'users','action'=>'index','filter_id' => ConstMoreAction::Yahoo), array('escape' => false));?></span> </li>
			<li <?php if (empty($this->request->params['named']['filter_id']) && (!empty($this->request->params['named']['main_filter_id']) and $this->request->params['named']['main_filter_id'] == ConstUserTypes::Admin)) { echo 'class="active"';} ?>><span class="meroon-block" title="<?php echo __l('Admin Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($admin_count,false).'<span>' .__l('Admin Users'). '</span>', array('controller'=>'users','action'=>'index','main_filter_id' => ConstUserTypes::Admin), array('escape' => false));?></span> </li>
            <li <?php if (empty($this->request->params['named']['filter_id']) and empty($this->request->params['named']['main_filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('Total Users'); ?>"><?php echo $this->Html->link($this->Html->cInt($active + $inactive,false).'<span>' .__l('Total Users'). '</span>', array('controller'=>'users','action'=>'index'), array('escape' => false));?></span> </li>
		</ul>
	 <div class="page-count-block clearfix">
	    <div class="grid_left">
	      <?php echo $this->element('paging_counter'); ?>
		</div>
		<div class="grid_left">
			<?php echo $this->Form->create('User', array('type' => 'post', 'class' => 'normal search-form clearfix', 'action'=>'index')); ?>
			<?php echo $this->Form->input('filter_id',array('type' =>'hidden')); ?>
			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
			<?php echo $this->Form->submit(__l('Search'));?>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="add-block grid_right">
			<?php 
				echo $this->Html->link(__l('Add'), array('controller' => 'users', 'action' => 'add'), array('class' => 'add','title'=>__l('Add'))); 
				 echo $this->Html->link(__l('Export'), array('controller' => 'users', 'action' => 'export', 'ext' => 'csv', 'q' => !empty($this->request->params['named']['q'])?$this->request->params['named']['q']:'', 'filter_id' => !empty($this->request->params['named']['filter_id'])?$this->request->params['named']['filter_id']:'', 'admin' => true), array('class' => 'export', 'title' => __l('Export'))); 
			?>
		</div>
  </div>
<?php
	
	echo $this->Form->create('User' , array('class' => 'normal','action' => 'update'));
?>
<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

<table class="list">
	<tr>
		<th rowspan="2" class="select"></th>
		<th rowspan="2"><?php echo __l('Action'); ?></th>
		<th class="dl" rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username'); ?></div></th>
		<th class="dc" colspan="2"><div class="js-pagination"><?php echo __l('Orders'); ?></div></th>
		<?php if(Configure::read('user.is_enable_openid')): ?>
			<th class="dc" rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Available Balance'), 'User.available_balance_amount').' ('.Configure::read('site.currency').')'; ?></div></th>
  	    <?php endif; ?>
        <th class="dc" colspan="3"><div class="js-pagination"><?php echo __l('Logins'); ?></div></th>
		<th class="dc" rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Registered On'),'created'); ?></div></th>
	</tr>
	<tr>
	<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Orders'), 'User.buyer_order_count'); ?></div></th>
	<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Addresses'), 'User.user_address_count'); ?></div></th>
	<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Count'), 'user_login_count'); ?></div></th>
	<th class="dc"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Time'), 'User.last_logged_in_time'); ?></div></th>
	<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('IP'), 'LastLoginIp.ip'); ?></div></th>
	</tr>
    <?php
	if (!empty($users)):
	$i = 0;
	foreach ($users as $user):
	$class = null;
	$active_class = '';
	if ($i++ % 2 == 0):
	$class = 'altrow';
	endif;
	$email_active_class = ' email-not-comfirmed';
	if($user['User']['is_email_confirmed']):
	$email_active_class = ' email-comfirmed';
	endif;
	if($user['User']['is_active']):
	$active_class = ' active-record';
	$status_class = 'js-checkbox-active';
	else:
	$active_class = ' inactive-record';
	$status_class = 'js-checkbox-inactive';
	endif;
	$online_class = 'offline';
	if (!empty($user['CkSession']['user_id'])) {
	$online_class = 'online';
	}
	?>
	<tr class="<?php echo $class.$active_class;?>">
		<td><?php echo $this->Form->input('User.'.$user['User']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$user['User']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
		<td class="actions">
            <div class="action-block">
                <span class="action-information-block">
                    <span class="action-left-block">&nbsp;&nbsp;</span>
                        <span class="action-center-block">
                            <span class="action-info">
                                <?php echo __l('Action');?>
                             </span>
                        </span>
                    </span>
                    <div class="action-inner-block">
                    <div class="action-inner-left-block">
                        <ul class="action-link clearfix">
                			<?php if(Configure::read('user.is_email_verification_for_register') and (!$user['User']['is_email_confirmed'])): ?>
                	         <li><?php echo $this->Html->link(__l('Resend Activation'), array('controller' => 'users', 'action'=>'resend_activation', $user['User']['id'], 'admin' => false),array('class' => 'reloader', 'title' => __l('Resend Activation'))); ?></li>
                     	    <?php endif; ?>
                			<li><?php echo $this->Html->link(__l('Edit'), array('controller' => 'user_profiles', 'action'=>'edit', $user['User']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></li>

                            <?php if($user['User']['user_type_id'] != ConstUserTypes::Admin){ ?>
                                <li><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $user['User']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
                            <?php } ?>
							<li><?php echo $this->Html->link(__l('Ban Signup IP'), array('controller'=> 'banned_ips', 'action' => 'add', $user['Ip']['ip']), array('class' => 'network-ip','title'=>__l('Ban Signup IP'), 'escape' => false));?></li>
							<?php if($user['User']['is_facebook_register'] == 0 && $user['User']['is_twitter_register'] == 0 && $user['User']['is_gmail_register'] == 0 && $user['User']['is_yahoo_register'] == 0 && $user['User']['is_openid_register'] == 0){ ?>
					        <li><?php echo $this->Html->link(__l('Change password'), array('controller' => 'users', 'action'=>'admin_change_password', $user['User']['id']), array('class'=>'change_password', 'title' => __l('Change password')));?></li>
							<?php }?>
                		 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
              </div>
        </td>
		<td class="dl">
                        <div class="clearfix user-info-block">
                        <div class="user-img-left grid_left">
                        	<?php
						$chnage_user_info = $user['User'];
						$chnage_user_info['UserAvatar'] = $user['UserAvatar'];
						$user['User']['full_name'] = (!empty($user['UserProfile']['first_name']) || !empty($user['UserProfile']['last_name'])) ? $user['UserProfile']['first_name'] . ' ' . $user['UserProfile']['last_name'] :  $user['User']['username'];
						echo $this->Html->getUserAvatarLink($chnage_user_info, 'micro_thumb',false);
						?>
                            <?php

                                 echo $this->Html->getUserLink($user['User']);
                            ?>
                            </div>
							  <?php if($user['User']['user_type_id']==ConstUserTypes::Admin){?>
							   <div class="user-img-right grid_left clearfix">
								   <span title="<?php echo $user['UserType']['name']; ?>" class="user-types-info user-types-<?php echo strtolower(str_replace(" ","",$user['UserType']['name']));?>"><?php echo $this->Html->cText($user['UserType']['name']); ?> 
									</span>
								</div>
						<?php } ?>
                        </div>
                        <div class="clearfix user-status-block user-info-block">
                        <?php
							if(!empty($user['UserProfile']['Country'])):
								?>
                                <span class="flags flag-<?php echo strtolower($user['UserProfile']['Country']['iso2']); ?>" title ="<?php echo $user['UserProfile']['Country']['name']; ?>">
									<?php echo $user['UserProfile']['Country']['name']; ?>
								</span>
                                <?php
	                        endif;
						?>
                        <?php if($user['User']['is_openid_register']):?>
								<span class="open_id" title="OpenID"> <?php echo __l('OpenID'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_gmail_register']):?>
								<span class="gmail" title="Gmail"> <?php echo __l('Gmail'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_yahoo_register']):?>
								<span class="yahoo" title="Yahoo"> <?php echo __l('Yahoo'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_facebook_register']):?>
								<span class="facebook" title="Facebook"> <?php echo __l('Facebook'); ?> </span>
						<?php endif; ?>
                        <?php if($user['User']['is_twitter_register']):?>
								<span class="twitter" title="Twitter"> <?php echo __l('Twitter'); ?> </span>
						<?php endif; ?>
                        <?php if(!empty($user['User']['email'])):?>
								<span class="email <?php echo $email_active_class; ?>" title="<?php echo $user['User']['email']; ?>">
								<?php
								if(strlen($user['User']['email'])>20) :
									echo '..' . substr($user['User']['email'], strlen($user['User']['email'])-15, strlen($user['User']['email']));
								else:
									echo $user['User']['email'];
								endif;
								?>
                                </span>
						<?php endif; ?>
						</div>
                        </td>
            <td class="dc">
			<?php echo $this->Html->link($this->Html->cInt($user['User']['buyer_order_count']), array('controller' => 'orders', 'action' => 'index', 'user_id' => $user['User']['id']), array('escape' => false));?>
             </td>
			 <td class="dc">
			<?php echo $this->Html->link($this->Html->cInt($user['User']['user_address_count']), array('controller' => 'user_addresses', 'action' => 'index', 'user_id' => $user['User']['id']), array('escape' => false));?>
             </td>
        <?php if(Configure::read('user.is_enable_openid')): ?>
            <td class="dc"><?php echo $this->Html->cCurrency($user['User']['available_balance_amount']);?></td>
        <?php endif; ?>
        <td class="dc"><?php echo $this->Html->link($this->Html->cInt($user['User']['user_login_count'], false), array('controller' => 'user_logins', 'action' => 'index', 'username' => $user['User']['username']));?></td>
        <td class="dc">
                        	<?php if($user['User']['last_logged_in_time'] == '0000-00-00 00:00:00' || empty($user['User']['last_logged_in_time'])){
                                echo '-';
                            }else{
                                echo $this->Html->cDateTimeHighlight($user['User']['last_logged_in_time']);
                            }?>
						</td>
        <td class="dc ip-block">
                        <?php if(!empty($user['LastLoginIp']['ip'])): ?>
                            <?php echo  $this->Html->link($user['LastLoginIp']['ip'], array('controller' => 'users', 'action' => 'whois', $user['LastLoginIp']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois '.$this->Html->cText($user['LastLoginIp']['host'],false), 'escape' => false));
							?>
      	                   <p>
							<?php
                            if(!empty($user['LastLoginIp']['Country'])):
                                ?>
                                <span class="flags flag-<?php echo strtolower($user['LastLoginIp']['Country']['iso2']); ?>" title ="<?php echo $user['LastLoginIp']['Country']['name']; ?>">
									<?php echo $user['LastLoginIp']['Country']['name']; ?>
								</span>
                                <?php
                            endif;
							 if(!empty($user['LastLoginIp']['City'])):
                            ?>
                            <span> 	<?php echo $user['LastLoginIp']['City']['name']; ?>    </span>
                            <?php endif; ?>
                            </p>
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>
						</td>
		<td class="dc"><?php echo $this->Html->cDateTimeHighlight($user['User']['created']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="14"><p  class="notice"><?php echo __l('No users available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
<?php
if (!empty($users)):
?>
   <div class="clearfix">
    	<div class="admin-select-block grid_left">
    		<?php echo __l('Select:'); ?>
    		<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
    		<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
    		<?php echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive'))); ?>
    		<?php echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active'))); ?>
    	</div>
    	<div class="admin-checkbox-button grid_4 grid_left"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
    	<div class="js-pagination grid_right">
            <?php echo $this->element('paging_links'); ?>
        </div>
    </div>
    <div class="hide">
	    <?php echo $this->Form->submit('Submit'); ?>
    </div>
<?php
endif;
echo $this->Form->end();
?>
</div>