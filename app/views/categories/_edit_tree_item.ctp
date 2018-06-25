<div class="actions-handle clearfix">
<div class="row-actions-left grid_left">
    <?php echo $this->Html->link($data['Category']['name'], array('action' => 'edit', $data['Category']['id']), array('title' => __('Edit this category', true))); ?>
</div>
    <div class="row-actions-right grid_left">
             <?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $data['Category']['id']), array('class' => 'action_delete delete js-delete', 'escape' => false, 'title' => __('Delete this category', true))); ?>         
    </div>
</div>
