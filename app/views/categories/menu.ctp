<ul class="menu clearfix">
<?php $treeArray = array();
$menu = 1;
$total_dropdown = count($categories)+5;
foreach($categories as $parent) {
	$drop_down_class = '';
    if(!empty($parent['children'])) {
		$drop_down_class = 'dropdown';
	}
?>
<li class="<?php echo $drop_down_class; ?>" style="z-index:<?php echo $total_dropdown--; ?>"><span><?php echo $this->Html->link($parent['Category']['name'] , array('controller'=> 'categories', 'action' => 'view', $parent['Category']['slug']),array('escape' => false, 'title' => $parent['Category']['name'])); ?></span>
<?php
    if(!empty($parent['children'])) { ?>
        <div class="submenu-block js-menu-container {'id':'<?php echo $menu; ?>'}">
		<div class="submenu-tr">
		  <div class="submenu-tm"></div>
		</div>
          <div class="submenu-cl">
            <div class="submenu-cr">
              <div class="submenu-inner clearfix">
                <ul class="js-ul-menu-container<?php echo $menu++; ?>">
                	<li class="clearfix">
					<?php
						$i = 1;
						foreach($parent['children'] as $key => $childCategory) {
					?>
                    	<div class="submenu-list-block grid_left <?php if($i > 1){ echo __l('submenu-list-block').$i; }?>">
                          <h4><?php echo $this->Html->link($childCategory['Category']['name'] , array('controller'=> 'categories', 'action' => 'view', $childCategory['Category']['slug'], 'admin' => false,),array('title' => $childCategory['Category']['name'])); ?></h4>
                          	<?php if(!empty($childCategory['children'])) { ?>
                          	<ul class="clearfix">
                          		<?php foreach($childCategory['children'] as $key => $child_2_Category) { ?>
                                	<li><span><?php echo $this->Html->link($child_2_Category['Category']['name'] , array('controller'=> 'products', 'action' => 'index', 'admin' => false, 'category' => $child_2_Category['Category']['slug']),array('title' => $child_2_Category['Category']['name'])); ?></span></li>
                          		<?php }  ?>
                        	</ul>
                        	<?php } ?>
                        </div>
                    <?php
						$i++;
						}  ?>
                    </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="submenu-bl">
            <div class="submenu-br">
              <div class="submenu-bm"></div>
            </div>
          </div>
        </div>
		<?php  } ?>
    </li>
		<?php } ?>
</ul>

