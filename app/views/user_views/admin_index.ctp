<?php /* SVN: $Id: admin_index.ctp 2871 2010-08-27 10:15:41Z sakthivel_135at10 $ */ ?>
<div class="userViews index js-response">
<div class="page-count-block clearfix">
  <div class="grid_left"> <?php echo $this->element('paging_counter');?> </div>
  <div class="grid_left"> <?php echo $this->Form->create('UserView' , array('type' => 'post', 'class' => 'normal search-form clearfix','action' => 'index')); ?>
    <div class="filter-section">
      <div class="clearfix"> <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?> <?php echo $this->Form->submit(__l('Search'));?> </div>
    </div>
    <?php echo $this->Form->end(); ?> </div>
</div>
	
    <?php echo $this->Form->create('UserView' , array('class' => 'normal clearfix','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    
    <table class="list">
        <tr>
            <th class="select"></th>
            <th class="actions"><?php echo __l('Action');?></th>
            <th ><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Viewed Time'),'created');?></div></th>
            <th ><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
            <th ><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Viewed User'), 'ViewingUser.username');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('IP'), 'Ip.ip');?></div></th>
		</tr>
        <?php
        if (!empty($userViews)):
            $i = 0;
            foreach ($userViews as $userView):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                    <td><?php echo $this->Form->input('UserView.'.$userView['UserView']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userView['UserView']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
                    <td class="actions">
                   	  <div class="action-block">
                		<span class="action-information-block">
                            <span class="action-left-block">&nbsp;&nbsp;</span>
                                <span class="action-center-block">
                                    <span class="action-info">
                                        Action                                     </span>
                                </span>
                            </span>
							<div class="action-inner-block">
                            <div class="action-inner-left-block">
							<ul class="action-link clearfix"><li>
	                        <span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userView['UserView']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></span>
                        </li>
                        </ul>
                        </div>
                        <div class="action-bottom-block"></div>
                        </div>
                        </div>
                        </td>
                    <td><?php echo $this->Html->cDateTimeHighlight($userView['UserView']['created']);?></td>
                    <td><?php echo $this->Html->link($this->Html->cText($userView['User']['username']), array('controller' => 'users', 'action' => 'view', $userView['User']['username'], 'admin' => false), array('escape' => false, 'title' => $this->Html->cText($userView['User']['username'], false))); ?></td>
                    <td><?php echo !empty($userView['ViewingUser']['username']) ? $this->Html->link($this->Html->cText($userView['ViewingUser']['username']), array('controller' => 'users', 'action' => 'view', $userView['ViewingUser']['username'], 'admin' => false), array('escape' => false,'title' => $this->Html->cText($userView['ViewingUser']['username'], false))) : __l('Guest'); ?></td>
      <td class="dl">
                        <?php if(!empty($userView['Ip']['ip'])): ?>
                            <?php echo  $this->Html->link($userView['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $userView['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois ', 'escape' => false));
							?>
							<p>
							<?php
                            if(!empty($userView['Ip']['Country'])):
                                ?>
                                <span class="flags flag-<?php echo strtolower($userView['Ip']['Country']['iso2']); ?>" title ="<?php echo $userView['Ip']['Country']['name']; ?>">
									<?php echo $userView['Ip']['Country']['name']; ?>
								</span>
                                <?php
                            endif;
							 if(!empty($userView['Ip']['City'])):
                            ?>
                            <span> 	<?php echo $userView['Ip']['City']['name']; ?>    </span>
                            <?php endif; ?>
                            </p>
                        <?php else: ?>
							<?php echo __l('N/A'); ?>
						<?php endif; ?>
						</td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="11" ><p class="notice"><?php echo __l('No User Views available');?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>

    <?php
    if (!empty($userViews)) :
        ?>
        <div class="clearfix">
  <div class="admin-select-block grid_left">
    <div class="select-options"> <?php echo __l('Select:'); ?> <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?> <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?> </div>
  </div>
   <div class="admin-checkbox-button grid_4 grid_left"> <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?> </div>
  <div class="js-pagination grid_right"> <?php echo $this->element('paging_links'); ?> </div>
  </div>
        <div class="hide">
            <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>