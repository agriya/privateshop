<?php
 $current_voting_percentage = $current_voting*20;
?>
<ul class=" <?php if ($canRate): ?> starnew-rating <?php endif; ?>">
<?php $voting_array = array('','one-stars','two-stars','three-stars','four-stars','five-stars'); 
  $voting = !empty($voting)?$voting:'0';
  if ($canRate) :
?>

	<li class="current-rating <?php echo $voting_array[$voting]; ?> " style="width:<?php echo $current_voting_percentage;?>%;"  title="<?php echo $this->Html->cInt($total_voting,false);?>/<?php echo $this->Html->cInt($voting_count,false);?> <?php echo __l('Votes');?>"><?php echo $this->Html->cInt($total_voting);?>/<?php echo $this->Html->cInt($voting_count);?> <?php echo __l('Votes');?></li>
<?php
	else:
?>
	<li class="current-rating <?php echo $voting_array[$voting]; ?> "  title="<?php echo $this->Html->cInt($total_voting,false);?> <?php echo __l('Votes');?>"> <span class="vote-count-value"> <?php echo $this->Html->cInt($total_voting);?> </span></li>
<?php
	endif;

	if ($canRate) :
?>
	<li><?php echo $this->Html->link('1', array('controller' => 'product_votings', 'action' => 'add', $product_id,1), array('class' => 'one-star js-voting', 'title' => __l('+1 votes')))?></li>
    <li><?php echo $this->Html->link('2', array('controller' => 'product_votings', 'action' => 'add', $product_id,2), array('class' => 'two-stars js-voting', 'title' => __l('+2 votes')))?></li>
    <li><?php echo $this->Html->link('3', array('controller' => 'product_votings', 'action' => 'add', $product_id,3), array('class' => 'three-stars js-voting', 'title' => __l('+3 votes')))?></li>
    <li><?php echo $this->Html->link('4', array('controller' => 'product_votings', 'action' => 'add', $product_id,4), array('class' => 'four-stars js-voting', 'title' => __l('+4 votes')))?></li>
    <li><?php echo $this->Html->link('5', array('controller' => 'product_votings', 'action' => 'add', $product_id,5), array('class' => 'five-stars js-voting', 'title' => __l('+5 votes')))?></li>
<?php
    endif;
?>
</ul>