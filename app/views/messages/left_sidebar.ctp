<ul class="side-menu clearfix">
<?php if ($inbox == 0): ?>
			<li class="inbox round-3 <?php echo (((isset($folder_type)) and ($folder_type == 'inbox')) ? 'active' : 'inactive'); ?>">
				<?php echo $this->Html->link(__l('Inbox') , array('controller' => 'messages', 'action' => 'inbox'), array('title'=>__l('Inbox'))); ?>
			</li>
<?php else: ?>
			<li class="inbox round-3 <?php echo (((isset($folder_type)) and ($folder_type == 'inbox')) ? 'active' : 'inactive'); ?>">
				<?php echo $this->Html->link(__l('Inbox') .' (' . $inbox . ')' , array('controller' => 'messages', 'action' => 'inbox'), array('title'=>__l('Inbox'))); ?>
			</li>
<?php endif; ?>			
<?php if ($draft == 0) :  ?>
			<li class="starred round-3 clearfix <?php echo (isset($folder_type) and $folder_type == 'all' and isset($is_starred) and $is_starred == 1) ? 'active' : 'inactive'; ?>">
				<?php echo $this->Html->link(__l('Starred').' (' . $stared . ')' , array('controller' => 'messages', 'action' => 'starred'), array('title'=>__l('Starred'))); ?><em class="starred"></em>
			</li>
<?php else : ?>
			<li class="round-3 starred <?php echo (isset($folder_type) and $folder_type == 'all' and isset($is_starred) and $is_starred == 1) ? 'active' : 'inactive'; ?>">
				<?php echo $this->Html->link(__l('Starred') . ' (' . $stared . ')' , array('controller' => 'messages', 'action' => 'starred'), array('title'=>__l('Starred'))); ?><em class="starred"></em>
			</li>
<?php endif; ?>			
		</ul>
