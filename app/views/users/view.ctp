<?php /* SVN: $Id: $ */ ?>
<div class="users view">
    <h2><?php echo ucfirst($this->Html->cText($user['User']['username'], false)); ?></h2>
	<div class="common-outet-block">
	<div class="clearfix">
	<div class="grid_4 user-avatar-block">
    <?php echo $this->Html->showImage('UserAvatar', $user['UserAvatar'], array('dimension' => 'medium_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($user['User']['username'], false)), 'title' => $this->Html->cText($user['User']['username'], false)));?>
	</div>
	<div class="grid_12">
	<dl class="list clearfix">
		<dt><?php echo __l('Member Since:');?></dt>
			<dd><?php echo $this->Html->cDate($user['User']['created']);?></dd>
	</dl>
        <?php
			$name = '';
			if (!empty($user['UserProfile']['first_name'])):
				$name .= $user['UserProfile']['first_name'] . ' ';
			endif;
			if (!empty($user['UserProfile']['middle_name'])):
				$name .= $user['UserProfile']['middle_name'] . ' ';
			endif;
			if (!empty($user['UserProfile']['last_name'])):
				$name .= $user['UserProfile']['last_name'] . ' ';
			endif;
		?>
		<?php if(!empty($name)): ?>
			<dl class="list clearfix">
			<dt><?php echo __l('Name: ');?></dt>
				<dd><?php echo $this->Html->cText($name);?></dd>
				</dl>
		<?php endif; ?>
		<?php if(!empty($user['UserProfile']['address'])): ?>
			<dl class="list clearfix">
			<dt><?php echo __l('Address: ');?></dt>
				<dd><?php echo $this->Html->cText($user['UserProfile']['address']);?></dd>
				</dl>
		<?php endif; ?>
	<?php if($referrel['Setting']['value']==1) {?>
	<dl class="list clearfix">
		<dt><?php echo __l('Referred Users: '); ?></dt>
			<dd><?php echo $this->Html->cInt($user['User']['referred_by_user_count']); ?></dd>
	</dl>
	<?php }?>
	<dl class="list clearfix">
		<dt><?php echo __l('Orders Placed: '); ?></dt>
			<dd><?php echo $this->Html->cInt($user['User']['buyer_order_count']); ?></dd>
	</dl>
</div>
</div>
	<?php if(!empty($user['UserProfile']['about_me'])): ?>
		<h3><?php echo __l('About Me: ');?></h3>
		<p><?php echo $this->Html->cText($user['UserProfile']['about_me']);?></p>
	<?php endif; ?>
</div>
</div>