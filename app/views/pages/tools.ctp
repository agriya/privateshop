<?php $this->pageTitle = __l('Tools'); ?>
<div class="js-response">
<div class="info-details page-info"><?php echo __l('When cron is not working, you may trigger it by clicking below link. For the processes that happen during a cron run, refer the ').$this->Html->link('product manual','http://dev1products.dev.agriya.com/doku.php?id=privateshop-install#manual_cron_update_process', array('target'=>'_blank'));?></div>
<div class="manual-block"><?php echo $this->Html->link(__l('Manually trigger cron'), array('controller' => 'crons', 'action' => 'main', '?f=' . $this->request->url, 'admin' => true), array('title' => __l('You can use this to update various status.This will be used in the scenario where cron is not working.'), 'class' => 'update-status js-trigger-cron js-delete')); ?></div>
</div>


