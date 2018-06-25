<?php /* SVN: $Id: admin_index.ctp 4534 2010-05-06 02:45:43Z vidhya_112act10 $ */ ?>
<div class="languages index js-response">
	<ul class="filter-list  filter-list-block clearfix">
          <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('Active'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Active'). '</span>', array('controller'=>'languages','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> </li>
		  <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Inactive'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Inactive'). '</span>', array('controller'=>'languages','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span> </li>
          <li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('Total Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved + $pending,false).'<span>' .__l('Total Records'). '</span>', array('controller'=>'languages','action'=>'index'), array('escape' => false));?></span> </li>
    </ul>
      <div class="clearfix">
       <div class="grid_left"><?php echo $this->element('paging_counter');?></div>
        <div class="grid_left">
    	<?php echo $this->Form->create('Language', array('type' => 'post', 'class' => 'normal search-form', 'action'=>'index')); ?>
    		<div>
    			<?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
               	<?php echo $this->Form->submit(__l('Search'));?>
            </div>
    	<?php echo $this->Form->end(); ?>
    	</div>
    	<div class="add-block grid_right">
        	<?php echo $this->Html->link(__l('Add'), array('controller' => 'languages', 'action' => 'add'), array('class' => 'add', 'title' => __l('Add'), 'escape' => false)); ?>
        </div>
    </div>
    <?php echo $this->Form->create('Language' , array('class' => 'normal','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

    <table class="list">
        <tr>
            <th class="select"></th>
			<th class="actions"><?php echo __l('Actions');?></th>
            <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'),'name');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('ISO2'),'iso2');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('ISO3'),'iso3');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Status'), 'is_active'); ?></div></th>
        </tr>
        <?php
        if (!empty($languages)):
            $i = 0;
            foreach ($languages as $language):
              	$class = null;
					if ($i++ % 2 == 0):
						$class = ' altrow';
					endif;
					if($language['Language']['is_active']):
						$status_class = 'js-checkbox-active';
						$active_class = 'active-record';
					else:
						$status_class = 'js-checkbox-inactive';
						$active_class = 'inactive-record';
					endif;
                ?>
                <tr class="<?php echo $active_class.$class; ?>">
                    <td class="select"><?php echo $this->Form->input('Language.'.$language['Language']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$language['Language']['id'], 'label' => false, 'class' => $status_class.' js-checkbox-list')); ?></td>
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
                		<li>
						<?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $language['Language']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
					   </li>
					   <li><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $language['Language']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
              </div>
                    </td>
                    <td class="dl"><?php echo $this->Html->cText($language['Language']['name']);?></td>
                    <td><?php echo $this->Html->cText($language['Language']['iso2']);?></td>
                    <td><?php echo $this->Html->cText($language['Language']['iso3']);?></td>
                    <td><?php echo ($language['Language']['is_active']) ? __l('Active') : __l('Inactive'); ?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="6"><p class="notice"><?php echo __l('No Languages available');?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
    <?php
    if (!empty($languages)) :
        ?>
        <div class="clearfix">
            <div class="admin-select-block grid_left">
        		<?php echo __l('Select:'); ?>
        		<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
        		<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
    			<?php
    				if(!empty($this->request->params['named']['filter_id'])):
    					if($this->request->params['named']['filter_id'] == ConstMoreAction::Active):
    						echo $this->Html->link(__l('Inactive'), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive')));
    					elseif($this->request->params['named']['filter_id'] == ConstMoreAction::Inactive):
    						echo $this->Html->link(__l('Active'), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active')));
    					endif;
    				else:
    					echo $this->Html->link(__l('Active '), '#', array('class' => 'js-admin-select-approved', 'title' => __l('Active')));
    					echo $this->Html->link(__l('Inactive '), '#', array('class' => 'js-admin-select-pending', 'title' => __l('Inactive')));
    				endif;
    				?>
        	</div>
            <div class="admin-checkbox-button grid_left">
            <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
           </div>
        	<div class="js-pagination grid_right">
            <?php echo $this->element('paging_links'); ?>
           </div>
        </div>

        <div class="hide">
            <?php echo $this->Form->submit('Submit');  ?>
        </div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>