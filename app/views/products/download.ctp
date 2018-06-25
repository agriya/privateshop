<?php /* SVN: $Id: $ */ ?>
<div class="common-outet-block">
	<div class="check-inthis->Formation-block">
<?php 
    if(!empty($error)):
	  ?>
      <h2><?php echo __l('Oops'); ?></h2>
     <div class="page-info">  <p><?php echo __l('something went wrong.'); ?></p>
	   <p><?php echo __l('Are you sure you have enterted the right e-mail address? Try again:'); ?></p>
     </div>
	<?php
	elseif(!empty($success)):
	  ?><h2><?php echo __l('Thanks'); ?></h2>
	     <div class="page-info"> 	<p><?php echo sprintf(__l('We have sent a new download link to').' <b>%s</b>.', $this->Html->cText($this->data['OrderItem']['sender_email'])); ?></p></div>
	<?php
	else:		
		?>
        <h2><?php echo __l('This download is expired'); ?></h2>
<div class="page-info">
        <p><?php echo __l('It is seems that you have used this download link already. Our download links only work one time for safety reasons.'); ?></p>
		<p><?php echo __l('But hey, that is no problem, enter your e-mail address below to get a new download link '); ?></p>
		</div>
	<?php
	endif;
 ?>
 </div>
<?php if(empty($success)): ?>
     <?php echo $this->Form->create('Product', array('url' =>array('controller'=>'products','action'=>'download',$this->request->params['pass'][0]), 'class' => 'normal'));
      echo $this->Form->input('OrderItem.id', array('type'=>'hidden'));
	  echo $this->Form->input('OrderItem.product_download_count', array('type'=>'hidden'));	  
	  echo $this->Form->input('OrderItem.is_downloaded', array('type'=>'hidden','value'=>1));	  
	  echo $this->Form->input('OrderItem.sender_email', array('label'=>__l('E-mail address:'))); ?>
	 <div class="submit-block clearfix"> <?php echo $this->Form->end(__l('Submit'));?> </div>
	  <?php echo $this->Form->end(); ?>
      <?php endif; ?>
      </div>