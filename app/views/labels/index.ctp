<?php /* SVN: $Id: $ */ ?>
<div class="clearfix">
<h2 class="title"><?php echo __l('Labels');?></h2>
<div class="mail-right-block alpha omega grid_6 grid_left">
<div class="shad-bg">
    <?php echo $this->element('message_message-left_sidebar', array('config' => 'sec')); ?>
</div>
</div>
<div class="labels index messages common-outet-block alpha omega grid_18 grid_right">
<div class="clearfix">
	<?php
	echo $this->Html->link(__l('Add'), array('action' => 'add'), array('class' => 'add grid_right','title'=>__l('Add')));
	?>
</div>
<?php echo $this->element('paging_counter');?>
<table class="list list1">
    <tr>
        <th class="actions"><?php echo __l('Actions');?></th>
        <th><?php echo $this->Paginator->sort('name');?></th>
    </tr>
<?php
if (!empty($labels)):

$i = 0;
foreach ($labels as $label):
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
								Action							</span>
						</span>
					</span>
					<div class="action-inner-block">
						<div class="action-inner-left-block">
							<ul class="action-link clearfix">
									<li><span><?php echo $this->Html->link(__l('Edit'), array('action' => 'edit', $label['User'][0]['LabelsUser']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span></li>
									<li><span><?php echo $this->Html->link(__l('Delete'), array('action' => 'delete',  $label['User'][0]['LabelsUser']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></li>
					</ul>
						</div>
						<div class="action-bottom-block"></div>
					</div>
				</div>
			</td>
        <td><?php echo $this->Html->cText($label['Label']['name']);?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="6"><p class="notice"><?php echo __l('No Labels available');?></p></td>
	</tr>
<?php
endif;
?>
</table>

<?php
if (!empty($labels)) {
    echo $this->element('paging_links');
}
?>
</div>
</div>
