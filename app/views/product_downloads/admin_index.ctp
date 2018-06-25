<?php /* SVN: $Id: admin_index.ctp 2871 2010-08-27 10:15:41Z sakthivel_135at10 $ */ ?>
<div class="productDownloads index js-response">
    <div class="page-count-block clearfix">
    <div class="grid_left"> <?php echo $this->element('paging_counter');?> </div>
    <div class="grid_left">
     <?php echo $this->Form->create('ProductDownload' , array('type' => 'post', 'class' => 'normal search-form clearfix','action' => 'index')); ?>
    	<div class="filter-section grid_left clearfix">
    	 <div class="clearfix">
    	    <?php echo $this->Form->input('q', array('label' => 'Keyword')); ?>
    		<?php echo $this->Form->submit(__l('Search'));?>
    		</div>
    		</div>
    	<?php echo $this->Form->end(); ?>
    	</div>
    </div>
    <?php echo $this->Form->create('ProductDownload' , array('class' => 'normal clearfix','action' => 'update')); ?>
    <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
    <table class="list">
        <tr>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Downloaded Time'), 'created');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('User'), 'User.username');?></div></th>
            <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Product'), 'Product.title');?></div></th>
			<th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('IP'), 'Ip.ip');?></div></th>
		</tr>
        <?php
        if (!empty($productDownloads)):
            $i = 0;
            foreach ($productDownloads as $productDownload):
                $class = null;
                if ($i++ % 2 == 0) :
                    $class = ' class="altrow"';
                endif;
                ?>
                <tr<?php echo $class;?>>
     				<td><?php echo $this->Html->cDateTimeHighlight($productDownload['ProductDownload']['created']);?></td>
                    <td><?php echo !empty($productDownload['User']['username']) ? $this->Html->link($this->Html->cText($productDownload['User']['username']), array('controller' => 'users', 'action' => 'view', $productDownload['User']['username'], 'admin' => false), array('escape' => false, 'title' => $this->Html->cText($productDownload['User']['username'], false))) : __l('Guest'); ?></td>
                    <td><?php echo $this->Html->link($this->Html->cText($productDownload['Product']['title']), array('controller' => 'products', 'action' => 'view', $productDownload['Product']['slug'], 'admin' => false), array('escape' => false,'title' => $this->Html->cText($productDownload['Product']['title'], false))); ?></td>
	                    <td class="dl">
                        <?php if(!empty($productDownload['Ip']['ip'])): ?>
                            <?php echo  $this->Html->link($productDownload['Ip']['ip'], array('controller' => 'users', 'action' => 'whois', $productDownload['Ip']['ip'], 'admin' => false), array('target' => '_blank', 'title' => 'whois ', 'escape' => false));
							?>
							<p>
							<?php
                            if(!empty($productDownload['Ip']['Country'])):
                                ?>
                                <span class="flags flag-<?php echo strtolower($productDownload['Ip']['Country']['iso2']); ?>" title ="<?php echo $productDownload['Ip']['Country']['name']; ?>">
									<?php echo $productDownload['Ip']['Country']['name']; ?>
								</span>
                                <?php endif; if(!empty($productDownload['Ip']['City'])): ?>
                            <span> 	<?php echo $productDownload['Ip']['City']['name']; ?>    </span>
                            <?php endif; ?>
                            </p>
                        <?php else: ?>
			<?php echo __l('N/A'); ?>
			<?php endif; ?>
			</td>
                </tr>
                <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="11"><p class="notice"><?php echo __l('No Product Downloads available');?></p></td>
            </tr>
            <?php
        endif;
        ?>
    </table>

    <?php
    if (!empty($productDownloads)) :
        ?>
		<div class="clearfix">
			<div class="grid_right js-pagination">
				<?php echo $this->element('paging_links'); ?>
			</div>
			 <div class="hide">
				<?php echo $this->Form->submit('Submit');  ?>
			</div>
		</div>
        <?php
    endif;
    echo $this->Form->end();
    ?>
</div>