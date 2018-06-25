<?php /* SVN: $Id: admin_index.ctp 17696 2010-08-05 12:37:07Z boopathi_026ac09 $ */ ?>
<div class="translations index">
<div class="clearfix">
<div class="grid_right">
	<?php echo $this->Html->link(__l('Make New Translation'), array('controller' => 'translations', 'action' => 'add'), array('class' => 'add', 'title'=>__l('Make New Translation'))); ?>
	<?php echo $this->Html->link(__l('Add New Text'), array('controller' => 'translations', 'action' => 'add_text'), array('class' => 'add', 'title'=>__l('Add New Text'))); ?>
</div>
</div>
<table class="list">
    <tr>
    	<th class="actions"><?php echo __l('Action');?></th>
		<th class="dl"><?php echo __l('Language');?></th>
		<th><?php echo __l('Verified');?></th>
		<th><?php echo __l('Not Verified');?></th>
	</tr>
<?php
if (!empty($translations)):

$i = 0;
foreach ($translations as $language_id => $translation):
	$class = null;
	if ($i++ % 2 == 0):
		$class = ' class="altrow"';
    endif;
?>
	<tr<?php echo $class;?>>
<td class="actions">
		<div class="action-block">
		<span class="action-information-block">
                            <span class="action-left-block">&nbsp;&nbsp;</span>
                                <span class="action-center-block">
                                    <span class="action-info">
                                        Action                                     </span>
                                </span>
                            </span>
							<div class="action-inner-block">
                            <div class="action-inner-left-block">
							<ul class="action-link clearfix"><li>
			<span><?php echo $this->Html->link(__l('Manage'), array('action' => 'manage', 'language_id' => $language_id), array('class' => 'edit js-edit', 'title' => __l('Edit')));?></span>
			</li>
			<li>
				<span><?php echo $this->Html->link(__l('Delete'), array('action' => 'index', 'remove_language_id' => $language_id), array('class' => 'delete js-delete', 'title' => __l('Delete Translation')));?></span>
				</li>
			</ul></div>
			 <div class="action-bottom-block"></div>
			 </div>
			 </div>
		</td>
		<td class="dl"><?php echo $this->Html->cText($translation['name']);?></td>
		<td><?php 
			if($translation['verified']){
				echo $this->Html->link($translation['verified'], array('action' => 'manage', 'filter' => 'verified', 'language_id' => $language_id));
			} else {
				echo $this->Html->cText($translation['verified']);
			}
			;?></td>
		<td><?php 
			if($translation['not_verified']){
				echo $this->Html->link($translation['not_verified'], array('action' => 'manage', 'filter' => 'unverified', 'language_id' => $language_id));
			} else {
				echo $this->Html->cText($translation['not_verified']);
			}
			;?></td>
	</tr>
<?php
    endforeach;
else:
?>
	<tr>
		<td colspan="7"><p class="notice"><?php echo __l('No Translations available');?></p></td>
	</tr>
<?php
endif;
?>
</table>
</div>