<?php /* SVN: $Id$ */ ?>
<div class="categories category-tree index">
<div class="grid_right">
<?php echo $this->Html->link(__l("Add category"), array('controller'=> 'categories', 'action'=>'add'), array('class'=>'add','escape' => false));?></div>
<?php if (empty($categoriesForTree)): ?>
    <p><?php echo __('No categories yet.', true); ?></p>
<?php else: ?>
    <?php echo $this->Tree->generate($categoriesForTree, array('model' => 'Category', 'id' => 'navigation', 'class'=>'treeview','element' => '../categories/_edit_tree_item')); ?>
<?php endif; ?>
</div>
