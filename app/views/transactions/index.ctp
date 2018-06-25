<?php /* SVN: $Id: admin_index.ctp 2754 2010-08-16 06:18:32Z boopathi_026ac09 $ */ ?>


		<div class="transactions index js-response">
			<h2><?php echo __l('Transactions'); ?></h2>
			<div class="common-outet-block">
				
						
								<div class="summary-block clearfix">
									<h3><?php echo __l('Account Summary'); ?></h3>
									<dl class="list summary-list clearfix">
										<dt><?php echo __l('Account Balance');?></dt>
											<dd class="available-balance round-3"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($user_available_balance));?></dd>
										<dt><?php echo __l('Withdraw Request');?></dt>
											<dd class="widthdraw-request round-3"><?php echo $this->Html->siteCurrencyFormat($this->Html->cCurrency($blocked_amount));?></dd>
									</dl>
								</div>
								<?php echo $this->Form->create('Transaction', array('action' => 'index' ,'class' => 'normal js-ajax-form {"container":"js-response", "transaction":"true"}')); ?>
						
									<?php echo $this->Form->input('filter', array('default'=>__l('all'),'type' => 'radio','options'=>$filter,'legend'=>false,'class' =>'js-transaction-filter ')); ?>
								
										<div class="js-filter-window <?php echo (!(isset($this->request->data['Transaction']['filter']) && $this->request->data['Transaction']['filter']=='custom'))? 'hide':''; ?> clearfix">
                                        <div class="filter-section clearfix">
											<div class="clearfix transection-date-time-block date-time-block">
												<div class="input date-time clearfix">
                                                    <div class="js-datetime">
													<?php echo $this->Form->input('from_date', array('label' => __l('From'), 'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
													</div>
												</div>
												<div class="input date-time end-date-time-block clearfix">
													<div class="js-datetime">
													<?php echo $this->Form->input('to_date', array('label' => __l('To '),  'type' => 'date', 'orderYear' => 'asc', 'minYear' => date('Y')-10, 'maxYear' => date('Y'), 'div' => false, 'empty' => __l('Please Select'))); ?>
                                                    </div>
												</div>
                                            </div>
											<?php echo $this->Form->input('tab_check', array('type' => 'hidden','value' => 'tab_check')); ?>
										<?php	echo $this->Form->submit(__l('Filter')); ?> 
                                         </div>
                                        </div>
							
								<?php echo $this->Form->end(); ?>
									</div>
			<div class="clearfix counter-block space-top">
				<?php echo $this->element('paging_counter');?>
            </div>
            	<div class="table-outer-block">
					<table class="list">
						<tr>
							<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Date'),'created');?></div> </th>
							<th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Description'),'transaction_type_id'); ?></div></th>
							<th class="dr"><div class="js-pagination credit round-3"><?php echo $this->Paginator->sort(__l('Credit'), 'amount').' ('.Configure::read('site.currency').')';?></div></th>
                            <th class="dr"><div class="js-pagination debit round-3"><?php echo $this->Paginator->sort(__l('Debit'), 'amount').' ('.Configure::read('site.currency').')';?></div></th>
											</tr>
											<?php
												$total_debit=$total_credit=0;
												if (!empty($transactions)):
													$i = 0;
													foreach ($transactions as $transaction):
														$class = null;
														if ($i++ % 2 == 0) {
															$class = ' class="altrow"';
														}
											?>
											<tr<?php echo $class;?>>
												<td><?php echo $this->Html->cDateTimeHighlight($transaction['Transaction']['created']); ?></td>
												<td class="dl">
													<?php echo $this->Html->transactionDescription($transaction);?>
												</td>
												<td class="dr">
                <?php
                    if($transaction['TransactionType']['is_credit']):
					$total_credit=$total_credit+$transaction['Transaction']['amount'];
                        echo $this->Html->cCurrency($transaction['Transaction']['amount']);
                    else:
                        echo '--';
                    endif;
                 ?>
            </td>
            <td class="dr">
                <?php
                    if($transaction['TransactionType']['is_credit']):
                        echo '--';
                    else:
						$total_debit=$total_debit+$transaction['Transaction']['amount'];
                        echo $this->Html->cCurrency($transaction['Transaction']['amount']);
                    endif;
                 ?>
            </td>

											</tr>
											<?php
													endforeach; ?>
											<tr class="total-block">
				            <td class="total dr" colspan="2"><span><?php echo __l('Total ');?></span><span class="duration"><?php
			echo (!empty($duration_from))? date('M d, Y',strtotime($duration_from)): '';
			echo (!empty($duration_to))? __l(' to ').date('M d, Y',strtotime($duration_to)): '';
			?></span></td>
												<td class="dr credit-total"><?php echo $this->Html->cCurrency($total_credit_amount);?></td>
			 <td class="dr debit-total"><?php echo $this->Html->cCurrency($total_debit_amount);?></td>
			</tr>
											<?php
												else:
											?>
											<tr>
												<td colspan="11"><p class="notice"><?php echo __l('No Transactions available');?></p></td>
											</tr>
											<?php
												endif;
											?>
										</table>
										</div>
										<?php if (!empty($transactions)) : ?>
											<div class="js-pagination space-top clearfix">
												<?php echo $this->element('paging_links'); ?>
											</div>
										<?php endif; ?>
<?php if(empty($this->params['named']['stat']) && !isset($this->data['Transaction']['tab_check']) && !$isAjax): ?>
						
						
							
		
		</div>
<?php endif; ?>