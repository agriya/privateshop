<div class="users stats js-response js-responses clearfix js-admin-stats-block">
    <div class="grid_17 alpha">
    	<?php echo $this->element('admin-charts-stats', array('cache' => array('config' => 'sec'))); ?>
    </div>

    <div class="grid_7 omega">
        <div class="dashboard-center-block">
    <div class="admin-side2-tl ">
                <div class="admin-side2-tr">
                  <div class="admin-side2-tm page-title-info">
                    <h2 class="timing"><?php echo __l('Timings'); ?></h2>
                  </div>
                </div>
            </div>
		<div class="admin-center-block admin-dashboard-links">
                <p>
                	<?php $title = ' title="' . strftime(Configure::read('site.datetime.tooltip') , strtotime('now')) . ' ' . Configure::read('site.timezone_offset') . '"'; ?>
                    <?php echo __l('Current time: '); ?><span <?php echo $title; ?>><?php echo strftime(Configure::read('site.datetime.format')); ?></span>
                </p>
                <p>
                    <?php echo __l('Last login: '); ?><?php echo $this->Html->cDateTimeHighlight($this->Auth->user('last_logged_in_time')); ?>
                </p>
    		</div>
		    <div class="admin-side2-bl ">
                <div class="admin-side2-br">
                  <div class="admin-side2-bm">
                          </div>
                </div>
            </div>
	</div>
    <div class="dashboard-center-block">
    <div class="admin-side2-tl ">
                <div class="admin-side2-tr">
                  <div class="admin-side2-tm page-title-info">
                    <h2 class="action-taken"><?php echo __l('Actions to Be Taken'); ?></h2>
                  </div>
                </div>
            </div>
		<div class="admin-center-block admin-dashboard-links">
                <h4><?php echo __l('Withdraw Requests'); ?></h4>
                <ul>
                  <li> <?php echo $this->Html->link(__l('Pending ').'('.$pending.')', array('controller' => 'user_cash_withdrawals', 'action' => 'index', 'filter_id' => ConstWithdrawalStatus::Pending), array('escape' => false, 'title' => __l('Pending ').'('.$pending.')')); ?> </li>
                </ul>
		</div>
		    <div class="admin-side2-bl ">
                <div class="admin-side2-br">
                  <div class="admin-side2-bm">
                          </div>
                </div>
            </div>
	</div>
    <div class="js-cache-load js-cache-load-recent-users {'data_url':'admin/users/recent_users', 'data_load':'js-cache-load-recent-users'}">
        <?php echo $this->element('users-admin_recent_users', array('cache' => array('config' => 'sec'))); ?>
    </div>
    <div class="js-cache-load js-cache-load-online-users {'data_url':'admin/users/online_users', 'data_load':'js-cache-load-online-users'}">
        <?php echo $this->element('users-admin_online_users', array('cache' => array('config' => 'sec'))); ?>
    </div>
<div class="dashboard-center-block">
    <div class="admin-side2-tl ">
                <div class="admin-side2-tr">
                  <div class="admin-side2-tm page-title-info">
                    <h2 class="site-name"><?php echo Configure::read('site.name'); ?></h2>
                  </div>
                </div>
            </div>
		<div class="admin-center-block admin-dashboard-links">
              <ul class="admin-dashboard-list">
              <li class="version-info"> <?php echo __l('Version').' ' ?> <span> <?php echo Configure::read('site.version'); ?> </span> </li>
              <li> <?php echo $this->Html->link(__l('Product Support'), 'http://customers.agriya.com/', array('target' => '_blank', 'title' => __l('Product Support'))); ?> </li>
              <li> <?php echo $this->Html->link(__l('Product Manual'), 'http://dev1products.dev.agriya.com/doku.php?id=privateshop' ,array('target' => '_blank','title' => __l('Product Manual'))); ?> </li>
              <li> <?php echo $this->Html->link(__l('CSSlize'), 'http://www.cssilize.com/', array('target' => '_blank', 'title' => __l('CSSlize'))); ?> <small><?php echo __l("PSD to XHTML Conversion and ").Configure::read('site.name').__l(" theming");?></small> </li>
              <li> <?php echo $this->Html->link(__l('Agriya Blog'), 'http://blogs.agriya.com/' ,array('target' => '_blank','title' => __l('Agriya Blog'))); ?><small> <?php echo __l("Follow Agriya news");?></small> </li>
            </ul>
          </div>
				<div class="admin-side2-bl ">
                <div class="admin-side2-br">
                  <div class="admin-side2-bm">
                          </div>
                </div>
            </div>
	</div>
	</div>
</div>