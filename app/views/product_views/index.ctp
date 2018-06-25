<?php /* SVN: $Id: admin_index.ctp 2871 2010-08-27 10:15:41Z sakthivel_135at10 $ */ ?>
<div class="productViews index js-response">
    <h2><?php echo $this->pageTitle;?></h2>
    <?php echo $this->Form->create('ProductView' , array('type' => 'post', 'class' => 'normal filter-form clearfix','action' => 'index')); ?>
	<div class="filter-section clearfix">
		<div>
			<?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
		</div>
		<div class="submit-block clearfix">
			<?php echo $this->Form->submit(__l('Search'));?>
		</div>
	</div>
	<?php echo $this->Form->end(); ?>
    <?php echo $this->Form->create('ProductView' , array('class' => 'normal clearfix','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <?php echo $this->element('paging_counter');?>
    <table class="list">
        <tr>
            <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
            <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Product'), 'Product.title');?></div></th>
			<th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Viewed Time'), 'created');?></div></th>
            <th colspan="6"><?php echo __l('Auto detected');?></th>
		</tr>
		<tr>
			<th><?php echo __l('IP');?></th>
			<th><?php echo __l('City');?></th>
			<th><?php echo __l('State');?></th>
			<th><?php echo __l('Country');?></th>
			<th><?php echo __l('Latitude');?></th>
			<th><?php echo __l('Longitude');?></th>
		</tr>
        <?php
        if (!empty($productViews)):
            $i = 0;
            foreach ($productViews as $productView):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
                    <td><?php echo $this->Html->link($this->Html->cText($productView['User']['username']), array('controller' => 'users', 'action' => 'view', $productView['User']['username'], 'admin' => false), array('escape' => false, 'title' => $this->Html->cText($productView['User']['username'], false))); ?></td>
                    <td><?php echo !empty($productView['Product']['title']) ? $this->Html->link($this->Html->cText($productView['Product']['title']), array('controller' => 'products', 'action' => 'view', $productView['Product']['title'], 'admin' => false), array('escape' => false,'title' => $this->Html->cText($productView['Product']['title'], false))) : __l('Guest'); ?></td>
					<td><?php echo $this->Html->cDateTimeHighlight($productView['ProductView']['created']);?></td>
                    <td><?php echo !empty($productView['Ip']['ip']) ? $this->Html->cText($productView['Ip']['ip']) : '-'; ?></td>
					<td><?php echo !empty($productView['Ip']['City']['name']) ? $this->Html->cText($productView['Ip']['City']['name']) : '-'; ?></td>
					<td><?php echo !empty($productView['Ip']['State']['name']) ? $this->Html->cText($productView['Ip']['State']['name']) : '-'; ?></td>
					<td><?php echo !empty($productView['Ip']['Country']['name']) ? $this->Html->cText($productView['Ip']['Country']['name']) : '-'; ?></td>
					<td><?php echo !empty($productView['Ip']['latitude']) ? $this->Html->cText($productView['Ip']['latitude']) : '-'; ?></td>
					<td><?php echo !empty($productView['Ip']['longitude']) ? $this->Html->cText($productView['Ip']['longitude']) : '-'; ?></td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="11"><p class="notice"><?php echo __l('No Product Views available');?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>
    <?php
    echo $this->Form->end();
    ?>
</div>