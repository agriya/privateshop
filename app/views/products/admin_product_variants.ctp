<?php /* SVN: $Id: $ */ ?>
<div class="products index clearfix">
<div class="step-block-bottom">
<div class="step-left">
    <div class="step-right">
        <div class="step-mid clearfix">
            <ul class="step-list">
                <li class="step-1"><a href="#" title="step1">Step 1</a></li>
                <li class="step-2 step-2-active"><a href="#" title="step2">Step 2</a></li>
            </ul>
        </div>
    </div>
</div>
</div>
<div class="page-info"><?php echo __l('Here you can set the original price, discount price, quantity and image for different variant combinations. Please left the quantity box as empty or zero, if you not have products in that combination.'); ?></div>
	<?php echo $this->Form->create('Product' , array('class' => 'normal', 'action' => 'product_variants', 'admin' => true, 'enctype' => 'multipart/form-data')); ?>
	<?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); 
     echo $this->Form->input('Product.id', array('type' => 'hidden')); 
     echo $this->Form->input('Product.type', array('type' => 'hidden')); ?>
	 <div class="js-clone">
	<table class="list">
		<tr>
			<th class="varietns-block"><?php echo __l('Variants');?></th>
			<th><?php echo __l('Original Price ('.Configure::read('site.currency').')');?></th>
			<th><?php echo __l('Discount Percentage (%)');?></th>
			<th><?php echo __l('Discount Amount ('.Configure::read('site.currency').')');?></th>
			<th><?php echo __l('Quantity');?></th>
            <th><?php echo __l('Image');?></th>
		</tr>
        
		<?php
		$temp_array = array();
		if(!empty($product['ProductAttribute'])) {
			$i = 0;
			foreach ($product['ProductAttribute'] as $key1 => $product_attribute) {
				$i++;
				if(empty($this->request->data['ProductAttribute'][$i])) {
					$this->request->data['ProductAttribute'][$i]['original_price'] = $product_attribute['original_price'];
					$this->request->data['ProductAttribute'][$i]['discount_percentage'] = $product_attribute['discount_percentage'];
					$this->request->data['ProductAttribute'][$i]['discount_amount'] = $product_attribute['discount_amount'];
					$this->request->data['ProductAttribute'][$i]['quantity'] = $product_attribute['quantity'];
					$this->request->data['ProductAttribute'][$i]['discounted_price'] = $product_attribute['discounted_price'];
					$this->request->data['ProductAttribute'][$i]['savings'] = $product_attribute['savings'];
					$this->request->data['ProductAttribute'][$i]['id'] = $product_attribute['id'];
				}
		?>	
		<tr>
        	<td>
			        	<?php 
			$temp_array[$key1] = array();
			foreach ($product_attribute['AttributesProductAttribute'] as $key => $attribute){ $attribute_detail =  $this->Html->getAttributeGroupDetails($attribute['attribute_id']);
             	?>
              <dl class="attribute-list1 clearfix">
	        <dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
	        <dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
			</dl>
            <?php 
				echo $this->Form->input('AttributesProductAttribute.'.$i.'.'.$key.'.attribute_id', array('div' => 'input text ', 'type' => 'hidden', 'label' => false, 'value' => $attribute['attribute_id']));
				array_push($temp_array[$key1], $attribute['attribute_id']);				
			}         	
            ?>
            </td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.original_price', array('div' => 'input text ', 'type' => 'text', 'label' => false, 'class' => 'js-originalprice-product-variant {id:'.$i.'}'));?></td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.discount_percentage', array('div' => 'input text ', 'type' => 'text','label' => false, 'class' => 'js-discountpercentage-product-variant {id:'.$i.'}'));?></td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.discount_amount', array('div' => 'input text ', 'type' => 'text', 'label' => false,  'class' => 'js-discountamount-product-variant {id:'.$i.'}'));?></td>
            <td>
            <?php echo $this->Form->input('ProductAttribute.'.$i.'.quantity', array('div' => 'input text ', 'label' => false, 'type' => 'text'));
            		echo $this->Form->input('ProductAttribute.'.$i.'.discounted_price', array('div' => 'input text', 'label' => false, 'type' => 'hidden')); 
					echo $this->Form->input('ProductAttribute.'.$i.'.savings', array('div' => 'input text ', 'type' => 'hidden',  'label' => false));
					echo $this->Form->input('ProductAttribute.'.$i.'.id', array('div' => 'input text ', 'type' => 'hidden',  'label' => false));
					?>
            </td>
            <td>
            <?php if(!empty($product_attribute['Attachment'])) { 
				$this->request->data['Attachment'][$i]['id'] = $product_attribute['Attachment']['id'];
			?>
            <div class="clearfix">
            <div class="grid_left"><?php echo $this->Html->showImage('ProductAttribute', $product_attribute['Attachment'], array('dimension' => 'small_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($product['Product']['title'], false)), 'title' => $this->Html->cText($product['Product']['title'], false)));?></div>
           	<div class="grid_left">
            <?php echo $this->Form->input('Attachment.'.$i.'.id', array('div' => 'input text ', 'type' => 'hidden',  'label' => false)); } ?>
			<?php echo $this->Form->input('Attachment.'.$i.'.filename', array('type' => 'file', 'size' => 30, 'label' => false)); ?>
            </div>
            </div>
            </td>
        </tr>
		<?php	
			}
		}
		if (!empty($attributes)):
			if(!empty($product['ProductAttribute'])) {
				$i = count($product['ProductAttribute']);
			} else {
				$i = 0;
			}	
			foreach ($attributes as $attribute):				
				if (!isCombinationExist($attribute, $temp_array)) {           
				$class = null;
				if ($i++ % 2 == 0):
					$class = ' class="altrow"';
				endif;
				if(empty($this->request->data['ProductAttribute'][$i]) && empty($temp_array)) {
					$this->request->data['ProductAttribute'][$i]['original_price'] = $product['Product']['original_price'];
					$this->request->data['ProductAttribute'][$i]['discount_percentage'] = $product['Product']['discount_percentage'];
					$this->request->data['ProductAttribute'][$i]['discount_amount'] = $product['Product']['discount_amount'];
					$this->request->data['ProductAttribute'][$i]['quantity'] = $product['Product']['quantity'];
					$this->request->data['ProductAttribute'][$i]['discounted_price'] = $product['Product']['discounted_price'];
					$this->request->data['ProductAttribute'][$i]['savings'] = $product['Product']['savings'];
				}
										
		?>
		<tr<?php echo $class;?>>
        	<td>
        	<?php foreach ($attribute as $key => $attribute_id){ $attribute_detail = $this->Html->getAttributeGroupDetails($attribute_id); ?>
            <dl class="attribute-list1 clearfix">
	        <dt class="grid_left"><?php echo $attribute_detail['AttributeGroup']['display_name']; ?>:</dt>
	        <dd class="grid_left"><?php echo $attribute_detail['Attribute']['name']; ?></dd>
			</dl>
            <?php echo $this->Form->input('AttributesProductAttribute.'.$i.'.'.$key.'.attribute_id', array('div' => 'input text ', 'type' => 'hidden', 'label' => false, 'value' => $attribute_id));
            } 
            ?>
            </td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.original_price', array('div' => 'input text ', 'type' => 'text', 'label' => false, 'class' => 'js-originalprice-product-variant {id:'.$i.'}'));?></td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.discount_percentage', array('div' => 'input text ', 'type' => 'text','label' => false, 'class' => 'js-discountpercentage-product-variant {id:'.$i.'}', 'value' => 0));?></td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.discount_amount', array('div' => 'input text ', 'type' => 'text', 'label' => false,  'class' => 'js-discountamount-product-variant {id:'.$i.'}', 'value' => 0));?></td>
            <td><?php echo $this->Form->input('ProductAttribute.'.$i.'.quantity', array('div' => 'input text ', 'label' => false, 'type' => 'text'));
            		echo $this->Form->input('ProductAttribute.'.$i.'.discounted_price', array('div' => 'input text', 'label' => false, 'type' => 'hidden')); 
					echo $this->Form->input('ProductAttribute.'.$i.'.savings', array('div' => 'input text ', 'type' => 'hidden',  'label' => false));
					?>
            </td>
            <td>
            <?php echo $this->Form->input('Attachment.'.$i.'.filename', array('type' => 'file', 'size' => 30, 'label' => false)); ?>
            </td>
        </tr>
		<?php
				}
				endforeach;
			else:
		?>
		<tr>
			<td colspan="20"><p class="notice"><?php echo __l('No attributes available');?></p></td>
		</tr>
		<?php
			endif;
		?>
	</table>
    </div>
	<?php echo $this->Form->submit(__l('Update')); ?>
	<?php echo $this->Form->end(); ?>
</div>