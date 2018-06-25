<div class="email-top-block">	
<?php
	if (!empty($emailTemplates)):
?>
	
	<div class="js-accordion">
<?php
		foreach ($emailTemplates as $emailTemplate):
?>		
<h3><?php echo $this->Html->link($this->Html->cText($emailTemplate['EmailTemplate']['name'], false).' - '. '<span>'.$this->Html->cText($emailTemplate['EmailTemplate']['description'], false).'</span>', array('controller' => 'email_templates', 'action' => 'edit', $emailTemplate['EmailTemplate']['id']), array('escape' => false,'title' => $this->Html->cText($emailTemplate['EmailTemplate']['name'], false), 'rel' => 'address:/' . str_replace(' ', '_', $emailTemplate['EmailTemplate']['name'])));?></h3>
<div></div>
<?php
		endforeach; 
?>
	
<?php
	else:
?><p class= "notice"><?php echo __l('No e-mail templates added yet.'); ?></p>
<?php
	endif;
?>	
</div>
</div>