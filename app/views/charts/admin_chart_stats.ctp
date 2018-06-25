<div class="js-cache-load js-cache-load-admin-charts {'data_url':'admin/charts/chart_overview', 'data_load':'js-cache-load-admin-charts-transactions', 'is_chart':'1'}">
	<?php echo $this->element('chart-admin_chart_overview', array('cache' => array('config' => 'site_element_cache_2_days'))); ?>
</div>
<?php echo $this->element('chart-admin_chart_users', array('user_type_id'=> '', 'cache' => array('key' => 'user'.ConstUserTypes::User, 'config' => 'sec'))); ?>
<?php echo $this->element('chart-admin_chart_user_logins', array('user_type_id'=> '', 'cache' => array('key' => 'user'.ConstUserTypes::User, 'config' => 'sec'))); ?>
<?php echo $this->element('chart-admin_chart_products', array('cache' => array('config' => 'sec'))); ?>