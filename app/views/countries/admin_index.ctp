<?php /* SVN: $Id: admin_index.ctp 1792 2010-05-06 09:53:44Z vinothraja_091at09 $ */ ?>
<div class="countries index js-response">
    <div class="page-count-block clearfix">
	<div class="grid_left">
			<?php echo $this->element('paging_counter');?>
		</div>
        <div class="grid_left">
        <?php echo $this->Form->create('Country', array('type' => 'post', 'class' => 'normal search-form clearfix','action'=>'index'));?>
        <div>
            <?php echo $this->Form->input('q', array('label' => __l('Keyword'))); ?>
            <?php echo $this->Form->submit(__l('Filter')); ?>
        </div>
        <?php echo $this->Form->end(); ?>
        </div>
        <div class="add-block grid_right clearfix">
            <?php echo $this->Html->link(__l('Add'),array('controller'=>'countries','action'=>'add'),array('class' => 'add', 'title' => __l('Add New Country')));?>
        </div>
    </div>
    <div>

        <div>
            <?php echo $this->Form->create('Country' , array('action' => 'update','class'=>'normal clearfix'));?>
            <?php echo $this->Form->input('r', array('type' => 'hidden', 'value' => $this->request->url)); ?>
            <table class="list">
                <tr>
                    <th rowspan="2"></th>
                    <th rowspan="2"><?php echo __l('Actions');?></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'), 'name');?></div></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Fips104'), 'fips104');?></div></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Iso2'), 'iso2');?></div></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Iso3'), 'iso3');?></div></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Ison'), 'ison');?></div></th>
                    <th rowspan="2"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Internet'), 'internet');?></div></th>
                    <th rowspan="2" class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Capital'), 'capital');?></div></th>
                    <th rowspan="2" class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Map Reference'), 'map_reference');?></div></th>
                    <th colspan="2"><?php echo __l('Nationality');?></th>
                    <th colspan="2"><?php echo __l('Currency');?></th>
                </tr>
                <tr>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Singular'), 'nationality_singular');?></div></th>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Plural'), 'nationality_plural');?></div></th>
                    <th class="dl"><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Name'), 'currency');?></div></th>
                    <th><div class="js-pagination"><?php echo $this->Paginator->sort(__l('Code'), 'currency_code');?></div></th>

                </tr>
                <?php
                if (!empty($countries)):
                    $i = 0;
                    foreach ($countries as $country):
                        $class = null;
                        if ($i++ % 2 == 0) :
                            $class = ' class="altrow"';
                        endif;
                        ?>
                        <tr<?php echo $class;?>>
                            <td><?php
                                echo $this->Form->input('Country.'.$country['Country']['id'].'.id',array('type' => 'checkbox', 'id' => "admin_checkbox_".$country['Country']['id'],'label' => false , 'class' => 'js-checkbox-list'));
                                ?>
                            </td>
                            <td class="actions">
                                <div class="action-block">
                                    <span class="action-information-block">
                                        <span class="action-left-block">&nbsp;&nbsp;</span>
                                            <span class="action-center-block">
                                                <span class="action-info">
                                                    <?php echo __l('Action');?>
                                                 </span>
                                            </span>
                                        </span>
                                        <div class="action-inner-block">
                                        <div class="action-inner-left-block">
                                            <ul class="action-link clearfix">
                                                <li>
                                                   <?php
                                                        echo $this->Html->link(__l('Edit'), array('action'=>'edit', $country['Country']['id']), array('class' => 'edit js-edit', 'title' => __l('Edit')));?>
                                                 </li>
                    							  <li>
                    								<?php echo $this->Html->link(__l('Delete'), array('action'=>'delete', $country['Country']['id']), array('class' => 'delete js-delete', 'title' => __l('Delete'))); ?>
                                                </li>
                        					 </ul>
                        					</div>
                        					<div class="action-bottom-block"></div>
                        				  </div>
                                  </div>
                            </td>
                            <td><?php echo !empty($country['Country']['name'])?$this->Html->cText($country['Country']['name']):'';?></td>
							<td><?php echo !empty($country['Country']['fips104'])?$this->Html->cText($country['Country']['fips104']):'';?></td>
							<td><?php echo !empty($country['Country']['iso2'])?$this->Html->cText($country['Country']['iso2']):'';?></td>
							<td><?php echo !empty($country['Country']['iso3'])?$this->Html->cText($country['Country']['iso3']):'';?></td>
							<td><?php echo !empty($country['Country']['ison'])?$this->Html->cText($country['Country']['ison']):'';?></td>
							<td><?php echo !empty($country['Country']['internet'])?$this->Html->cText($country['Country']['internet']):'';?></td>
							<td><?php echo !empty($country['Country']['capital'])?$this->Html->cText($country['Country']['capital']):'';?></td>
							<td><?php echo !empty($country['Country']['map_reference'])?$this->Html->cText($country['Country']['map_reference']):'';?></td>
							<td><?php echo !empty($country['Country']['nationality_singular'])?$this->Html->cText($country['Country']['nationality_singular']):'';?></td>
							<td><?php echo !empty($country['Country']['nationality_plural'])?$this->Html->cText($country['Country']['nationality_plural']):'';?></td>
							<td><?php echo !empty($country['Country']['currency'])?$this->Html->cText($country['Country']['currency']):'';?></td>
							<td><?php echo !empty($country['Country']['currency_code'])?$this->Html->cText($country['Country']['currency_code']):'';?></td>
                        </tr>
                        <?php
                    endforeach;
                else:
                    ?>
                    <tr>
                        <td colspan="19"><p class="notice"><?php echo __l('No countries available');?></p></td>
                    </tr>
                    <?php
                endif;
                ?>
            </table>
            <?php if (!empty($countries)): ?>
            <div class="clearfix">
                <div class="admin-select-block grid_left">
                    <?php echo __l('Select:'); ?>
                    <?php echo $this->Html->link(__l('All'), '#', array('class' => 'js-admin-select-all','title' => __l('All'))); ?>
                    <?php echo $this->Html->link(__l('None'), '#', array('class' => 'js-admin-select-none','title' => __l('None'))); ?>
                </div>
                <div class="admin-checkbox-button grid_4 grid_left">
                    <?php echo $this->Form->input('more_action_id', array('class' => 'js-admin-index-autosubmit', 'label' => false, 'empty' => __l('-- More actions --'))); ?>
                </div>
                <div class="js-pagination grid_right">
                    <?php echo $this->element('paging_links');  ?>
                </div>
               </div>

                <div class="hide">
                    <?php echo $this->Form->submit('Submit');  ?>
                </div>
                <?
            endif;
            echo $this->Form->end();
            ?>
        </div>
    </div>
</div>