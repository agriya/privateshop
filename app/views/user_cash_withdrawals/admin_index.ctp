<?php /* SVN: $Id: admin_index.ctp 71492 2011-11-15 14:01:05Z aravindan_111act10 $ */ ?>
	<?php 
		if(!empty($this->request->params['isAjax'])):
			echo $this->element('flash_message');
		endif;
	?>   
<div class="userCashWithdrawals index js-response">
	<div>
		<ul class="clearfix filter-list-block filter-list">
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending) { echo 'class="active"';} ?>><span class="gmail-block" title="<?php echo __l('Pending'); ?>"><?php echo $this->Html->link($this->Html->cInt($pending,false).'<span>' .__l('Pending'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index', 'filter_id' => ConstWithdrawalStatus::Pending), array('escape' => false));?></span> </li>
            <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved) { echo 'class="active"';} ?>><span class="blue-block" title="<?php echo __l('Under Process'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved,false).'<span>' .__l('Under Process'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Approved), array('escape' => false));?></span> </li>
            <li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Rejected) { echo 'class="active"';} ?>><span class="purple-block" title="<?php echo __l('Rejected'); ?>"><?php echo $this->Html->link($this->Html->cInt($rejected,false).'<span>' .__l('Rejected'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Rejected), array('escape' => false));?></span> </li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Success) { echo 'class="active"';} ?>><span class="green-block" title="<?php echo __l('Success'); ?>"><?php echo $this->Html->link($this->Html->cInt($success,false).'<span>' .__l('Success'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Success), array('escape' => false));?></span> </li>
			<li <?php if (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Failed) { echo 'class="active"';} ?>><span class="red-block" title="<?php echo __l('Failed'); ?>"><?php echo $this->Html->link($this->Html->cInt($failed,false).'<span>' .__l('Failed'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index','filter_id' => ConstWithdrawalStatus::Failed), array('escape' => false));?></span> </li>
			<li <?php if (empty($this->request->params['named']['filter_id'])) { echo 'class="active"';} ?>><span class="import-block" title="<?php echo __l('All'); ?>"><?php echo $this->Html->link($this->Html->cInt($approved + $pending + $rejected + $success + $failed,false).'<span>' .__l('All'). '</span>', array('controller'=>'user_cash_withdrawals','action'=>'index'), array('escape' => false));?></span> </li>
        </ul>
    </div>
		<?php 
		if(!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == 4):?>
		<div class="page-info">
			<?php echo __l('Withdrawal fund frequest which were unable to process will be returned as failed. The amount requested will be automatically refunded to the user.');?>			
		</div>
	<?php endif;?>
		<?php if($this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved): ?>
			<div class="page-info">		
				<?php echo __l('Following withdrawal request has been submitted to payment gateway API, These are waiting for IPN from the payment gateway API. Either it will move to Success or Failed'); ?>
			</div>
		<?php endif; ?>
			<div class="clearfix page-count-block">
        <div class="grid_left">
		<?php echo $this->element('paging_counter');?>
		</div>
		<ul class="transfer-list grid_right clearfix">
		<li class="transfer-amount"><?php echo __l('Transfer Account: '); ?></li>
		<?php $class = ( !isset($this->request->params['named']['account_id']) || $this->request->params['named']['account_id'] == 'all' ) ? 'active' : null; ?>
		<li class="<?php echo $class ?>"><div class="js-pagination"><?php echo $this->Html->link(__l('All'), array('controller'=>'user_cash_withdrawals', 'action' => 'index'), array('title' => __l('All')));?></div></li>
		<?php foreach($paymentGateways as $paymentGateway): ?>
			<?php $class = (isset($this->request->params['named']['account_id']) && $this->request->params['named']['account_id'] == $paymentGateway['PaymentGateway']['id'] ) ? 'active' : null; ?>
			<li class="<?php echo $class ?>"><div class="js-pagination"><?php echo $this->Html->link($this->Html->cText($paymentGateway['PaymentGateway']['display_name'], false), array('controller'=>'user_cash_withdrawals', 'action' => 'index', 'filter_id' => $this->request->params['named']['filter_id'], 'account_id' => $paymentGateway['PaymentGateway']['id']), array('title' => $this->Html->cText($paymentGateway['PaymentGateway']['display_name'], false)));?></div></li>
		<?php endforeach; ?>
	</ul>
	</div>
		
       
  
    <?php echo $this->Form->create('UserCashWithdrawal' , array('class' => 'normal','action' => 'update')); ?> <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
  
    <table class="list">
        <tr>
		    <?php if (!empty($userCashWithdrawals) && (empty($this->request->params['named']['filter_id']) || (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending))):?>
            <th class="select"></th>
			<?php endif;?>
			 <?php if (!empty($userCashWithdrawals) && (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved)):?>
			<th>
            	<?php echo __l('Action'); ?>
			</th>    
            <?php endif;?>        
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Requested on'),'UserCashWithdrawal.created');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'),'User.username');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Amount'), 'UserCashWithdrawal.amount').' ('.Configure::read('site.currency').')';?> </div></th>
            <?php if(!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Success) { ?>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Paid on'),'UserCashWithdrawal.modified');?></div></th>
            <?php } ?>
            <?php if(!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == 'all') { ?>
                <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Status'),'WithdrawalStatus.name');?></div></th>
            <?php } ?>
        </tr>
    <?php
    if (!empty($userCashWithdrawals)):
    
    $i = 0;
    foreach ($userCashWithdrawals as $userCashWithdrawal):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
    ?>
        <tr<?php echo $class;?>>
		    <?php if (!empty($userCashWithdrawals) && (empty($this->request->params['named']['filter_id']) || (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending))):?>
			<td>			
                <?php echo $this->Form->input('UserCashWithdrawal.'.$userCashWithdrawal['UserCashWithdrawal']['id'].'.id', array('type' => 'checkbox', 'id' => "admin_checkbox_".$userCashWithdrawal['UserCashWithdrawal']['id'], 'label' => false, 'class' => 'js-checkbox-list ' )); ?>
			</td>
			<?php endif;?>
		    <?php if (!empty($userCashWithdrawals) && (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Approved)):?>
			<td class="actions">
                      <div class="action-block">
                        <span class="action-information-block">
                            <span class="action-left-block">&nbsp;
                            </span>
                                <span class="action-center-block">
                                    <span class="action-info">
                                        <?php echo __l('Action');?>
                                     </span>
                                </span>
                            </span>
                            <div class="action-inner-block">
                            <div class="action-inner-left-block">
                                <ul class="action-link clearfix">
            						<li><?php echo $this->Html->link(__l('Move to success'), array('action' => 'move_to', $userCashWithdrawal['UserCashWithdrawal']['id'], 'type' => 'success'), array('class' => 'approve', 'title' => __l('Move to success')));?></li>
            						<li><?php echo $this->Html->link(__l('Move to failed'), array('action' => 'move_to', $userCashWithdrawal['UserCashWithdrawal']['id'], 'type' => 'failed'), array('class' => 'delete', 'title' => __l('Move to failed')));?></li>
        						</ul>
        					   </div>
        						<div class="action-bottom-block"></div>
							  </div>
						 </div>
  					</td>
			<?php endif;?>
           <td class="dc">	<?php  echo $this->Html->cDateTimeHighlight($userCashWithdrawal['UserCashWithdrawal']['created']);  ?> </td>
			<td class="dl">
            <div class="paypal-status-info">
            	<?php
			  foreach($userCashWithdrawal['User']['MoneyTransferAccount'] as $moneyTransferAccount):
				if(!empty($moneyTransferAccount['PaymentGateway'])):?>
					<span class="paypal-block round-5"><?php echo $this->Html->cText($moneyTransferAccount['PaymentGateway']['display_name']);?></span>
			<?php
				endif;
			  endforeach;
			?>
			</div>
			<?php echo $this->Html->getUserAvatarLink($userCashWithdrawal['User'], 'micro_thumb',false);	?>
            <span class="username-block"><?php echo $this->Html->getUserLink($userCashWithdrawal['User']);?></span>
		
			</td>
            <td class="dr"><?php echo $this->Html->cCurrency($userCashWithdrawal['UserCashWithdrawal']['amount']);?></td>
             <?php if(!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Success) { ?>
            <td class="dc">	<?php  echo $this->Html->cDateTimeHighlight($userCashWithdrawal['UserCashWithdrawal']['modified']);  ?> </td>
            <?php } ?>
            <?php if(!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == 'all') { ?>
                <td><?php echo $this->Html->cText($userCashWithdrawal['WithdrawalStatus']['name']);?></td>
            <?php } ?>
        </tr>
    <?php
        endforeach;
    else:
    ?>
        <tr>
            <td colspan="8" class="notice"><?php echo __l('No records available');?></td>
        </tr>
    <?php
    endif;
    ?>
    </table>
    <div class="clearfix">
    <?php if (!empty($userCashWithdrawals) && (empty($this->request->params['named']['filter_id']) || (!empty($this->request->params['named']['filter_id']) && $this->request->params['named']['filter_id'] == ConstWithdrawalStatus::Pending))):?>
		<div class="admin-select-block grid_left">
				<?php echo __l('Select:'); ?>
				<?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all', 'title' => __l('All'))); ?>
				<?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none', 'title' => __l('None'))); ?>
			</div>
			<div class="admin-checkbox-button grid_4 grid_left"><?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?></div>
			<div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
      <?php endif; ?>
			
    <?php
    if (!empty($userCashWithdrawals)) {
        ?>
            <div class="js-pagination grid_right">
                <?php echo $this->element('paging_links'); ?>
            </div>
        <?php
    }
    ?>
    </div>
      <?php echo $this->Form->end(); ?>
    </div>