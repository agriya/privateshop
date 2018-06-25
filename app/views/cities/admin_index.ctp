<?php /* SVN: $Id: admin_index.ctp 1916 2010-05-18 13:35:04Z jayashree_028ac09 $ */ ?>
<div class="cities index js-response">
   <ul class="filter-list-block filter-list clearfix">
          <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Active) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('Approved Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Approved Records'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Active), array('escape' => false));?></span> </li>
		  <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstMoreAction::Inactive) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Disapproved Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Disapproved Records'). '</span>', array('controller'=>'cities','action'=>'index','filter_id' => ConstMoreAction::Inactive), array('escape' => false));?></span> </li>
          <li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('Total Records'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved + $pending,false).'<span>' .__l('Total Records'). '</span>', array('controller'=>'cities','action'=>'index'), array('escape' => false));?></span> </li>
    </ul>
   <div class="clearfix">
    	<div class="grid_left"><?php echo $this->element('paging_counter');?> </div>
    <div class="grid_left">
    <?php echo $this->Form->create('City', array('type' => 'post', 'class' => 'normal search-form clearfix', 'action'=>'index')); ?>
	<div class="filter-section  clearfix">
			<?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
     		<?php echo $this->Form->submit(__l('Search'));?>
		</div>
	<?php echo $this->Form->end(); ?>
	</div>

			<div class="add-block grid_right clearfix">
				  <?php echo $this->Html->link(__l('Add'),array('controller'=>'cities','action'=>'add'),array('class' => 'add', 'title' => __l('Add New City')));?>
			</div>
	</div>
	
    <div>
       
        <div>
            <?php
            echo $this->Form->create('City', array('action' => 'update','class'=>'normal clearfix')); ?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>


            <table class="list">
                <tr>
                    <th class="select"></th>
                    <th><?php echo __l('Actions');?></th>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Country'), 'Country.name', array('url'=>array('controller'=>'cities', 'action'=>'index')));?></div></th>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('State'), 'State.name', array('url'=>array('controller'=>'cities', 'action'=>'index')));?></div></th>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'), 'name');?></div></th>
                    <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Latitude'), 'latitude');?></div></th>
                    <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Longitude'), 'longitude');?></div></th>
                </tr>
                <?php
                if (!empty($cities)):
                    $i = 0;
                    foreach ($cities as $city):
                        $class = null;
                        if ($i++ % 2 == 0) :
                           $class = ' altrow';
                        endif;
                        if($city['City']['is_approved'])  :
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
                                echo $this->Form->input('City.'.$city['City']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$city['City']['id'],'label' => false , 'class' => $status_class.' js-checkbox-list'));
                                ?>
                            </td>
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

						
                                <?php
                                    if($city['City']['is_approved']): ?>
									<li> <?php	echo $this->Html->link(__l('Disapproved'),array('controller'=>'cities','action'=>'update_status',$city['City']['id'],'disapprove') ,array('class' =>'disapprove','title' => __l('Disapproved'))); ?></li>
                                    <?php else: ?>
                                     <li>   <?php echo $this->Html->link(__l('Approved'),array('controller'=>'cities','action'=>'update_status',$city['City']['id'],'approve'),array('class' =>'approve','title' => __l('Approved'))); ?></li>
                                     <?php endif; ?>
                                      
                                      <li><?php echo $this->Html->link(__l('Edit'), array('action'=>'edit', $city['City']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></li>
									  <li><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $city['City']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));
                                ?></li>
                        					 </ul>
                        					</div>
                        					<div class="action-bottom-block"></div>
                        				  </div>
                                  </div>


                            
                            </td>
                            <td class="dl"><?php echo $this->Html->cText($city['Country']['name'], false);?></td>
                            <td class="dl"><?php echo $this->Html->cText($city['State']['name'], false);?></td>
                            <td class="dl"><?php echo $this->Html->cText($city['City']['name'], false);?></td>
                            <td><?php echo $this->Html->cFloat($city['City']['latitude']);?></td>
                            <td><?php echo $this->Html->cFloat($city['City']['longitude']);?></td>
                        </tr>
                    <?php
                    endforeach;
                    else:
                    ?>
                    <tr>
                        <td colspan="10"><p class="notice"><?php echo __l('No cities available');?></p></td>
                    </tr>
                    <?php
                    endif;
                    ?>
            </table>
            <?php
                if (!empty($cities)) :
                    ?>
                    <div class="clearfix">
                        <div class="admin-select-block grid_left">
                            <?php echo __l('Select:'); ?>
                            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
                            <?php echo $this->Html->link(__l('Disapproved'), '#', array('class' => 'js-admin-select-pending','title' => __l('Disapproved'))); ?>
                            <?php echo $this->Html->link(__l('Approved'), '#', array('class' => 'js-admin-select-approved','title' => __l('Approved'))); ?>
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
                endif;
            ?>
        <?
        echo $this->Form->end();
        ?>
        </div>
    </div>
</div>