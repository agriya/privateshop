<div class="userOpenids index">
<div class="side-content-block question-tags js-corner round-5">
<h2><?php echo __l('Manage your OpenIDs'); ?></h2>
<?php
	echo sprintf(__l('The following OpenIDs are currently attached to your %s account. You can use any of them to sign in.'), Configure::read('site.name'));
?>
<?php echo $this->element('paging_counter'); ?>
<ol class="list" start="<?php echo $this->Paginator->counter(array(
    'format' => '%start%'
));?>">
<?php
if (!empty($userOpenids)):

$i = 0;
foreach ($userOpenids as $userOpenid):
	$class = null;
	if ($i++ % 2 == 0) :
		$class = ' class="altrow"';
    endif;
?>
	<li<?php echo $class;?>>
		<p><?php echo $this->Html->cText($userOpenid['UserOpenid']['openid']);?></p>
		<div class="actions"><?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $userOpenid['UserOpenid']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete')));?></div>
	</li>
<?php
    endforeach;
else:
?>
	<li>
		<p class="notice"><?php echo __l('No OpenIDs available');?></p>
	</li>
<?php
endif;
?>
</ol>

<?php
if (!empty($userOpenids)) :
    echo $this->element('paging_links');
endif;
echo $this->Html->link(__l('Attach a new OpenID'), array('controller' => 'user_openids', 'action' => 'add'), false);
?>
</div>
</div>