<?php /* SVN: $Id: $ */ ?>
<div class="orderStatus index">
<?php echo $this->element('paging_counter');?>
<div class="overflow-block">
<table class="list">
    <tr>
        <th class="actions"><?php echo __l('Actions');?></th>
        <th><?php echo $this->Paginator->sort(__l('Name'),'name');?></th>
    </tr>
<?php
if (!empty($orderStatuses)):

$i = 0;
foreach ($orderStatuses as $orderStatus):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
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
                       		<li><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $orderStatus['OrderStatus']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></li>
    					 </ul>
    					</div>
    					<div class="action-bottom-block"></div>
    				  </div>
              </div>
			</td>
		<td><?php echo $this->Html->cText($orderStatus['OrderStatus']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p class="notice"><?php echo __l('No Order Status available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
</div>
<?php
if (!empty($orderStatuses)) {
    echo $this->element('paging_links');
}
?>
</div>