<?php /* SVN: $Id: admin_index.ctp 2871 2010-08-27 10:15:41Z sakthivel_135at10 $ */ ?>
<div class="userAddresses-index js-response">
<div class="page-count-block clearfix">
<div class="grid_left"> <?php echo $this->element('paging_counter');?> </div>
<div class="grid_left">
    <?php echo $this->Form->create('UserAddress' , array('type' => 'post', 'class' => 'normal search-form clearfix', 'action' => 'index')); ?>
	<div class="filter-section grid_left clearfix">
	 <div class="clearfix">
	    <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
		<?php echo $this->Form->submit(__l('Search'));?>
		</div>
		</div>
	<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="form-outer-block clearfix">
    <?php echo $this->Form->create('UserAddress' , array('class' => 'normal clearfix', 'action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>

    <table class="list">
        <tr>
            <th class="select"></th>
            <th class="actions"><?php echo __l('Action');?></th>            
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Created'), 'UserAddress.created');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Full Name'), 'UserAddress.full_name');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Address'), 'UserAddress.address');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('City'), 'City.name');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('State'), 'State.name');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Country'), 'Country.name');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Zipcode'), 'UserAddress.zipcode');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Phone'), 'UserAddress.phone');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Active'), 'UserAddress.is_active');?></div></th>
		</tr>
        <?php
        if (!empty($userAddresses)):
            $i = 0;
            foreach ($userAddresses as $userAddress):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                if($userAddress['UserAddress']['is_active'])
                {
                  $class = ' class="active-record"';
                }
                else
                {
                   $class = ' class="inactive-record"';
                }
                ?>
                <tr<?php echo $class;?>>
                    <td><?php echo $this->Form->input('UserAddress.'.$userAddress['UserAddress']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userAddress['UserAddress']['id'], 'label' => false, 'class' => 'js-checkbox-list')); ?></td>
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
                                		  <li><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete', $userAddress['UserAddress']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
                    					</ul>
                    				</div>
                    					<div class="action-bottom-block"></div>
                    				  </div>
                              </div>
                    </td>
					<td><?php echo $this->Html->cDateTimeHighlight($userAddress['UserAddress']['created']);?></td>
					<td><?php echo $this->Html->link($this->Html->cText($userAddress['User']['username']), array('controller' => 'users', 'action' => 'view', $userAddress['User']['username'], 'admin' => false), array('escape' => false, 'title' => $this->Html->cText($userAddress['User']['username'], false))); ?></td>
					<td><?php echo $this->Html->cText($userAddress['UserAddress']['full_name']);?></td>
					<td><?php echo $this->Html->cText($userAddress['UserAddress']['address']);?></td>
					<td><?php echo $this->Html->cText($userAddress['City']['name']);?></td>
					<td><?php echo $this->Html->cText($userAddress['State']['name']);?></td>
					<td><?php echo $this->Html->cText($userAddress['Country']['name']);?></td>
					<td><?php echo $this->Html->cText($userAddress['UserAddress']['zipcode']);?></td>
					<td><?php echo $this->Html->cText($userAddress['UserAddress']['phone']);?></td>
					<td><?php echo $this->Html->cText(($userAddress['UserAddress']['is_active'])? "Yes" : "No");?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="11"><p class="notice"><?php echo __l('No shipping addresses available') ?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
	<?php if (!empty($userAddresses)): ?>
	 <div class="clearfix">
		<div class="admin-select-block grid_left">
            <?php echo __l('Select:'); ?>
            <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
            <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
        </div>
        <div class="admin-checkbox-button grid_left"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
        <div class="hide grid_left"><?php echo $this->Form->submit('Submit');  ?></div>
        <div class="js-pagination grid_right"><?php echo $this->element('paging_links'); ?></div>
      </div>
   	<?php endif; ?>
	<?php echo $this->Form->end(); ?>
</div>
</div>