<div class="clearfix js-responses js-loadadmin-chart-users-activities-ctp">
<?php
 $page_title = __l('User Activities');
 $user_type_id = (!empty($this->request->data['Chart']['user_type_id']))?$this->request->data['Chart']['user_type_id']:'';
 ?>
 <?php 
 		$arrow = "down-arrow";
 		if(isset($this->request->params['named']['is_ajax_load'])){ 
 		$arrow = "up-arrow";
	   }
 ?>
 <div class="admin-side1-tl">
         <div class="admin-side1-tr">
           <div class="admin-side1-tm">
            <div class="admin-header-inner page-title-info">
		<h2 class="chart-dashboard-title"><?php echo $page_title; ?>
		<span class="js-chart-showhide <?php echo $arrow; ?> {'chart_block':'admin-dashboard-user-activities<?php echo $user_type_id; ?>', 'dataloading':'div.js-loadadmin-chart-users-activities-ctp',  'dataurl':'admin/charts/chart_user_activities/is_ajax_load:1/user_type_id:<?php echo $user_type_id; ?>'}">&nbsp;</span></h2>
	  </div>
	</div>
</div>
</div>

<?php if(isset($this->request->params['named']['is_ajax_load'])){ ?>
	<div id="admin-dashboard-user-activities<?php echo $user_type_id; ?>">
	<div class="admin-side1-cl">
     <div class="admin-side1-cr">
      <div class="clearfix">
    <div class="clearfix">
     <?php echo $this->Form->create('Chart' , array('class' => "normal language-form {'dataloading':'div.js-loadadmin-chart-users-activities-ctp'}", 'action' => 'chart_user_activities')); ?>
		<?php
		echo $this->Form->input('user_type_id', array('type' => 'hidden'));
		echo $this->Form->input('is_ajax_load', array('type' => 'hidden', 'value' => 1));
		echo $this->Form->input('select_range_id', array('class' => 'js-chart-autosubmit', 'label' => __l('Select Range'))); ?>
		<div class="hide"> <?php echo $this->Form->submit('Submit');  ?> </div>
	<?php echo $this->Form->end(); ?>
    </div>
	<div class="js-load-column-chart chart-half-section {'data_container':'user_view_column_data', 'chart_container':'user_view_column_chart', 'chart_title':'<?php echo __l('User Views') ;?>', 'chart_y_title': '<?php echo __l('Views');?>'}">
     <div class="dashboard-tl">
     <div class="dashboard-tr">
         <div class="dashboard-tc">
             </div>
         </div>
     </div>
     <div class="dashboard-cl">
         <div class="dashboard-cr">
         <div class="dashboard-cc clearfix">
        <div id="user_view_column_chart" class="admin-dashboard-chart"></div>
		<div class="hide">
			<table id="user_view_column_data" class="list">
			<tbody>
				<?php foreach($user_view_model_data as $key => $_data): ?>
				<tr>
				   <th><?php echo $key; ?></th>
				   <td><?php echo $_data[0]; ?></td>
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
	<div class="js-load-line-graph chart-half-section {'data_container':'user_views_line_data<?php echo $user_type_id; ?>', 'chart_container':'user_views_line_chart<?php echo $user_type_id; ?>', 'chart_title':'<?php echo __l('User Messages') ;?>', 'chart_y_title': '<?php echo __l('Messages');?>'}">
     <div class="dashboard-tl">
             <div class="dashboard-tr">
                 <div class="dashboard-tc">
             </div>
         </div>
     </div>
     <div class="dashboard-cl">
         <div class="dashboard-cr">
         <div class="dashboard-cc clearfix">

    	<div id="user_views_line_chart<?php echo $user_type_id; ?>" class="admin-dashboard-chart"></div>
		<div class="hide">
			<table id="user_views_line_data<?php echo $user_type_id; ?>" class="list">
			<thead>
				<tr>
				   <th>Peried</th>
					   <?php foreach($chart_user_message_periods as $_period): ?>
						 <th><?php echo $_period['display']; ?></th>
					   <?php endforeach; ?>
				</tr>
				</thead>
				<tbody>
				   <?php foreach($chart_user_message_data as $display_name => $chart_data): ?>
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
<?php } ?>
</div>