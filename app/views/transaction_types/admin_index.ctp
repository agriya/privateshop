<?php /* SVN: $Id: admin_index.ctp 5198 2010-12-15 13:11:02Z suresh_006ac09 $ */ ?>
<?php 
	if(!empty($this->request->params['isAjax'])):
		echo $this->element('flash_message');
	endif;
?>
<div class="transactionTypes index">
<?php echo $this->element('paging_counter');?>
<table class="list">
    <tr> 
        <th><?php echo __l('Action'); ?></th>
        <th class="dl"><?php echo $this->Paginator->sort(__l('Name'),'name');?></th>
     </tr>
<?php
if (!empty($transactionTypes)):

$i = 0;
foreach ($transactionTypes as $transactionType):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td class="dl actions">
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
                				<li><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $transactionType['TransactionType']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
              </div>
           </td>
          <td class="dl"><?php echo $this->Html->cText($transactionType['TransactionType']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="2"><p class="notice"><?php echo __l('No Transaction Types available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($transactionTypes)) {
    echo $this->element('paging_links');
}
?>
</div>
