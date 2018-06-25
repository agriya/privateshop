<div class="clearfix js-responses js-cache-load-admin-charts-transactions">
     <div class="admin-side1-tl">
         <div class="admin-side1-tr">
           <div class="admin-side1-tm">
               <div class="admin-header-inner page-title-info">
    			<h2 class="chart-dashboard-title"><?php echo __l('Overview'); ?>
    			<span class="js-chart-showhide up-arrow {'chart_block':'admin-dashboard-overview'}">&nbsp;</span></h2>
    		  </div>
            </div>
        </div>
     </div>
	<div id="admin-dashboard-overview">
	<div class="admin-side1-cl">
     <div class="admin-side1-cr">
	<div class="clearfix">
    <div class="clearfix">
	 <?php echo $this->Form->create('Chart' , array('class' => 'normal language-form', 'action' => 'chart_overview')); ?>
		<?php
		echo $this->Form->input('select_range_id', array('class' => 'js-chart-autosubmit', 'label' => __l('Select Range'))); ?>
		<div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
	<?php echo $this->Form->end(); ?>
	</div>
	<div class="js-load-line-graph chart-half-section {'data_container':'transactions_line_data', 'chart_container':'transactions_line_chart', 'chart_title':'<?php echo __l('Transactions') ;?>', 'chart_y_title': '<?php echo __l('Value');?>'}">
     <div class="dashboard-tl">
         <div class="dashboard-tr">
             <div class="dashboard-tc">
             </div>
         </div>
     </div>
     <div class="dashboard-cl">
         <div class="dashboard-cr">
         <div class="dashboard-cc clearfix">
           	<div id="transactions_line_chart" class="admin-dashboard-chart"></div>
    		<div class="hide">
    			<table id="transactions_line_data" class="list">
    			<thead>
    				<tr>
    				   <th>Peried</th>
    					   <?php foreach($chart_transactions_periods as $_period): ?>
    						 <th><?php echo $_period['display']; ?></th>
    					   <?php endforeach; ?>
    				</tr>
    				</thead>
    				<tbody>
    				   <?php foreach($chart_transactions_data as $display_name => $chart_data): ?>
    						<tr>
    							<th><?php echo $display_name; ?></th>
    							<?php foreach($chart_data as $val): ?>
    								<td><?php echo $val; ?></td>
    							<?php endforeach; ?>
    						</tr>
    				   <?php endforeach; ?>
    			 </tbody>
    			</table>
    		</div>
		</div>
		</div>
		</div>
        <div class="dashboard-bl">
             <div class="dashboard-br">
                 <div class="dashboard-bc">
                 </div>
             </div>
         </div>
    </div>
	<div class="js-load-line-graph chart-half-section {'data_container':'order_line_data', 'chart_container':'order_line_chart', 'chart_title':'<?php echo __l('Orders') ;?>', 'chart_y_title': '<?php echo __l('Value');?>'}">
     <div class="dashboard-tl">
     <div class="dashboard-tr">
         <div class="dashboard-tc">
             </div>
         </div>
     </div>
     <div class="dashboard-cl">
         <div class="dashboard-cr">
         <div class="dashboard-cc clearfix">
        <div id="order_line_chart" class="admin-dashboard-chart"></div>
		<div class="hide">
    			<table id="order_line_data" class="list">
    			<thead>
    				<tr>
    				   <th>Peried</th>
    					   <?php foreach($chart_order_periods as $_period): ?>
    						 <th><?php echo $_period['display']; ?></th>
    					   <?php endforeach; ?>
    				</tr>
    				</thead>
    				<tbody>
    				   <?php foreach($chart_order_data as $display_name => $chart_data): ?>
    						<tr>
    							<th><?php echo $display_name; ?></th>
    							<?php foreach($chart_data as $val): ?>
    								<td><?php echo $val; ?></td>
    							<?php endforeach; ?>
    						</tr>
    				   <?php endforeach; ?>
    			 </tbody>
    			</table>
		</div>
	   </div>
		</div>
		</div>
        <div class="dashboard-bl">
             <div class="dashboard-br">
                 <div class="dashboard-bc">
                 </div>
             </div>
         </div>
	</div>
   </div>
	</div>
   </div>
<div class="admin-side1-bl">
         <div class="admin-side1-br">
         <div class="admin-side1-bm">
            </div>
        </div>
        </div>
</div>
</div>