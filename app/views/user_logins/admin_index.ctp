<?php /* SVN: $Id: admin_index.ctp 4648 2010-05-07 03:28:35Z vidhya_112act10 $ */ ?>
<div class="userLogins index js-response">
       <div class="clearfix">
            <?php echo $this->Form->create('UserLogin' , array('type' => 'post', 'class' => 'normal search-form','action' => 'index')); ?>

        	<div class="filter-section grid_left clearfix">
			
				<div class="grid_left"> <?php echo $this->element('paging_counter');?> </div>
        		
           		<div class="grid_left">
				    <?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
        			<?php echo $this->Form->submit(__l('Search'));?>
        		</div>
        	</div>
        	<?php echo $this->Form->end(); ?>
    	</div>
    	
    <?php echo $this->Form->create('UserLogin' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    
    <table class="list">
        <tr>
            <th class="select"></th>
            <th class="actions" ><?php echo __l('Action');?></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Login Time'), 'created');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Login IP'), 'Ip.ip');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort('user_agent');?></div></th>
		</tr>
		<?php
           if (!empty($userLogins)):
            $i = 0;
            foreach ($userLogins as $userLogin):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                    <td class="select"><?php echo $this->Form->input('UserLogin.'.$userLogin['UserLogin']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userLogin['UserLogin']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                  		<li><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userLogin['UserLogin']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
                                        <?php if (!empty($userLogin['Ip']['ip'])): ?>
                							<li><?php echo $this->Html->link(__l('Ban Login IP'), array('controller'=> 'banned_ips', 'action' => 'add', $userLogin['Ip']['ip']), array('class' => 'network-ip','title'=>__l('Ban Login IP'), 'escape' => false));?></li>
                						<?php endif; ?>
                					 </ul>
                					</div>
                					<div class="action-bottom-block"></div>
                				  </div>
                          </div>
                     </td>
                    <td><?php echo $this->Html->cDateTimeHighlight($userLogin['UserLogin']['created']);?></td>
                    <td><?php echo $this->Html->link($this->Html->cText($userLogin['User']['username']), array('controller'=> 'users', 'action'=>'view', $userLogin['User']['username'], 'admin' => false), array('escape' => false));?></td>
					<td class="dc ip-block">
                        <?php if(!empty($userLogin['Ip']['ip'])): ?>
                            <?php echo  $this->Html->link($userLogin['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userLogin['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois ', 'escape' => false));
							?>
      	               
							<?php
                            if(!empty($userLogin['Ip']['Country']['name'])):
                                ?>
                            <p>
                                <span class="flags flag-<?php echo strtolower($userLogin['Ip']['Country']['iso2']); ?>" title ="<?php echo $userLogin['Ip']['Country']['name']; ?>">
									<?php echo $userLogin['Ip']['Country']['name']; ?>
								</span>
								</p>
                                <?php
                            endif;
							 if(!empty($userLogin['Ip']['City']['name'])):
                            ?>
                            <p>
                            <span> 	<?php echo $userLogin['Ip']['City']['name']; ?>    </span></p>
                            <?php endif; ?>
                            
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>
						</td>
						<td><?php echo $this->Html->cText($userLogin['UserLogin']['user_agent']);?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="10"><p class="notice"><?php echo __l('No User Logins available');?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>

    <?php
    if (!empty($userLogins)) :
        ?>
        <div class="clearfix">
            <div class="admin-select-block grid_left">
                <?php echo __l('Select:'); ?>
                <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
            </div>
            <div class="admin-checkbox-button grid_left">
                <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
            </div>
            <div class="hide grid_left">
                <?php echo $this->Form->submit('Submit');  ?>
            </div>
            <div class="js-pagination grid_right">
                <?php echo $this->element('paging_links'); ?>
            </div>
        </div>

        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>