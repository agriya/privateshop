<?php /* SVN: $Id: index_list.ctp 99 2008-07-09 09:33:42Z rajesh_04ag02 $ */ ?>
<div class="states index js-response">
	<ul class="clearfix filter-list-block filter-list">
          <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('Approved Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Approved Records'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> </li>
		  <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Disapproved Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Disapproved Records'). '</span>', array('controller'=>'states','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span> </li>
          <li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('Total Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved + $pending,false).'<span>' .__l('Total Records'). '</span>', array('controller'=>'states','action'=>'index'), array('escape' => false));?></span> </li>
    </ul>
	 <div class="page-count-block clearfix">
		<div class="grid_left">
			<?php echo $this->element('paging_counter'); ?>
		</div>
	<div class="grid_left">
    <?php echo $this->Form->create('State', array('type' => 'post', 'class' => 'normal search-form clearfix', 'action'=>'index')); ?>
	<div class="filter-section clearfix">
            <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
			<?php echo $this->Form->submit(__l('Search'));?>

	</div>
	<?php echo $this->Form->end(); ?>
</div>
<div class="clearfix add-block1 grid_right">
<?php echo $this->Html->link(__l('Add'),array('controller'=>'states','action'=>'add'),array('class' => 'add', 'title' => __l('Add New State')));?>
</div>
</div>
        <?php
        echo $this->Form->create('State' , array('action' => 'update','class'=>'normal'));?>
        <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
		<div class="form-outer-block clearfix"> 
        <table class="list">
            <tr>
                <th class="select"></th>
                <th class="actions"><?php echo __l('Action');?></th>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Country'), 'Country.name');?></div></th>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort('name');?></div></th>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Status'),'is_approved');?></div></th>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort('code');?></div></th>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort('adm1code');?></div></th>
            </tr>
            <?php
                if (!empty($states)):
                $i = 0;
                    foreach ($states as $state):
                        $class = null;
                        if ($i++ % 2 == 0) :
                            $class = ' altrow';
                        endif;
                        if($state['State']['is_approved'])  :
                            $status_class = 'js-checkbox-active';
							$active_class = 'active-record';
                        else:
                            $status_class = 'js-checkbox-inactive';
							$active_class = 'inactive-record';
                        endif;
                        ?>
                        <tr class="<?php echo $active_class.$class;?>">
                            <td>
                                <?php
                                    echo $this->Form->input('State.'.$state['State']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$state['State']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));
                                ?>
                            </td>
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
							<ul class="action-link clearfix">
                                <?php if($state['State']['is_approved']):?><li><span>
                                <?php echo $this->Html->link(__l('Disapprove'),array('controller'=>'states','action'=>'update_status',$state['State']['id'],'disapprove'),array('class' =>'disapprove','title' => __l('Disapprove')));?></span></li>
                                <?php else:?>
                                <li><span><?php echo $this->Html->link(__l('Approve'),array('controller'=>'states','action'=>'update_status',$state['State']['id'],'approve') ,array('class' =>'approve','title' => __l('Approve')));?></span></li>
                                <?php endif; ?>
                                <li><span><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $state['State']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
								</span></li>
								<li><span>
								<?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $state['State']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?>
                           </span></li>
										   </ul></div>
							 <div class="action-bottom-block"></div>
							 </div>
							 </div>
							</td>
                            <td><?php echo !empty($state['Country']['name'])?$state['Country']['name']:'';?></td>
							<td><?php echo !empty($state['Country']['name'])?$state['State']['name']:'';?></td>
						    <td><?php if($state['State']['is_approved']): echo __l('Approved'); else: echo __l('Disapproved'); endif;?></td>
							<td><?php echo !empty($state['Country']['name'])?$state['State']['code']:'';?></td>
							<td><?php echo !empty($state['Country']['name'])?$state['State']['adm1code']:'';?></td>
                        </tr>
                        <?php
                    endforeach;
            else:
                ?>
                <tr>
                    <td colspan="7"><p class="notice"><?php echo __l('No states available');?></p></td>
                </tr>
                <?php
            endif;
            ?>
        </table>
        <?php
         if (!empty($states)) : ?>
		<div class="clearfix">
  <div class="admin-select-block grid_left">
	<div class="select-options">
                <?php echo __l('Select:'); ?>
                <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title'=>__l('All'))); ?>
                <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title'=>__l('None'))); ?>
                <?php echo $this->Html->link(__l('Disapproved'), '#', array('class' => 'js-admin-select-pending','title'=>__l('Disapproved'))); ?>
                <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-admin-select-approved','title'=>__l('Approved'))); ?>
            </div>
          </div>
          <div class="admin-checkbox-button grid_4 grid_left">
                 <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
            </div>
            
			  <div class="js-pagination grid_right">
            <?php  echo $this->element('paging_links'); ?>
            </div>
            </div>
            <div class="hide">
                <?php echo $this->Form->submit('Submit');  ?>
            </div>
            <?php
         endif; ?>
        </div>
            <?php echo $this->Form->end();?>
        </div>
