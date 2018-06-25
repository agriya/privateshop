<ul class="admin-links clearfix">
  <?php $class = ($this->request->params['controller'] == 'users' && $this->request->params['action'] == 'admin_stats') ? 'active' : null; ?>
  <li class="grid_3 <?php echo $class;?>"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center dashboard"><?php echo __l('Dashboard');?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
            <ul class="admin-sub-links">
                 <li class="<?php echo $class;?>"> <?php echo $this->Html->link(__l('Snapshot'), array('controller' => 'users', 'action' => 'stats'),array('title' => __l('Snapshot'))); ?> </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
  </li>
    <?php $class = (($this->request->params['controller'] == 'users' && $this->request->params['action'] != 'admin_send_mail' && $this->request->params['action'] != 'admin_stats') || ($this->request->params['controller'] == 'user_profiles' && $this->request->params['action'] == 'edit')) ? ' active' : null; ?>
  <li class="grid_3 <?php echo $class;?>">  <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-users"><?php echo __l('Users');?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
            <ul class="admin-sub-links">
			<li><?php echo $this->Html->link(__l('Users'), array('controller' => 'users', 'action' => 'index'),array('title' => __l('Users'))); ?></li>
			<li><?php echo $this->Html->link(__l('Add User'), array('controller' => 'users', 'action' => 'add'),array('title' => __l('Add User'))); ?></li>
			<li><?php echo $this->Html->link(__l('User Logins'), array('controller' => 'user_logins', 'action' => 'index'),array('title' => __l('User Logins'))); ?></li>
			<li><?php echo $this->Html->link(__l('User Shipping Addresses'), array('controller' => 'user_addresses', 'action' => 'index'),array('title' => __l('User Shipping Addresses'))); ?></li>
			<li><?php echo $this->Html->link(__l('Send Email to Users'), array('controller' => 'users', 'action' => 'send_mail'),array('title' => __l('Send Email to Users'))); ?></li>
		</ul>
	   </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
  <li class="grid_3"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-products"><?php echo __l('Products'); ?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
		<ul class="admin-sub-links">
			<li><?php echo $this->Html->link(__l('Products'), array('controller' => 'products', 'action' => 'index'),array('title' => __l('Products'))); ?></li>
			<li><?php echo $this->Html->link(__l('Add Product'), array('controller' => 'products', 'action' => 'add'),array('title' => __l('Add Product'))); ?></li>
			<li><?php echo $this->Html->link(__l('Variants'), array('controller' => 'attributes', 'action' => 'index'),array('title' => __l('variants'))); ?></li>
			<li><?php echo $this->Html->link(__l('Product Views'), array('controller' => 'product_views', 'action' => 'index'),array('title' => __l('Product Views'))); ?></li>
			<li><?php echo $this->Html->link(__l('Product Downloads'), array('controller' => 'product_downloads', 'action' => 'index'),array('title' => __l('Product Downloads'))); ?></li>
       </ul>
          </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
	<li class="grid_3"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-orders"><?php echo __l('Orders'); ?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
		<ul class="admin-sub-links">
			<li><?php echo $this->Html->link(__l('Orders'), array('controller' => 'orders', 'action' => 'index','status_filter_id'=>2),array('title' => __l('Orders'))); ?></li>
       </ul>
          </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
  <li class="grid_3"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-messages"><?php echo __l('Messages'); ?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
		<ul class="admin-sub-links">
			<li><?php echo $this->Html->link(__l('Messages'), array('controller' => 'messages', 'action' => 'index'),array('title' => __l('User messages'))); ?></li>
		</ul>
           </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
  <li class="grid_3"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-payments"><?php echo __l('Payments'); ?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock">
		<ul class="admin-sub-links">
			<li class="setting-overview"><?php echo $this->Html->link(__l('Payment Gateways'), array('controller' => 'payment_gateways', 'action' => 'index'),array('title' => __l('Payment Gateways'))); ?></li>
			<li><?php echo $this->Html->link(__l('Transactions'), array('controller' => 'transactions', 'action' => 'index'),array('title' => __l('Transactions'))); ?></li>
			<?php if ($this->Html->isWalletEnabled('is_enable_for_add_to_wallet')): ?>
			<li class="withdraw-block">
                <h4>Withdraw Fund Requests</h4>
              </li>
              <li class="withdraw-block1 <?php echo $class;?>"><?php echo $this->Html->link(__l('Users'), array('controller' => 'user_cash_withdrawals', 'action' => 'index'),array('title' => __l('Users'))); ?></li>
          <?php  endif; ?>
		</ul>
            </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
  <li class="grid_3 masters setting-masters-block masters-block">
  <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-settings"><?php echo __l('Settings'); ?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock clearfix">
		<ul class="admin-sub-links clearfix">
			<?php $class = ($this->request->params['controller'] == 'settings') ? ' active' : null; ?>
          <li  class=" masters setting-masters-block masters-block <?php echo $class;?>">

            <ul class="admin-sub-links clearfix">
              <li class="clearfix">
                <ul>
                  <li class="setting-overview setting-overview1 clearfix"><?php echo $this->Html->link(__l('Overview'), array('controller' => 'settings', 'action' => 'index'),array('title' => __l('Overview'), 'class' => 'setting-overview')); ?></li>
                  <li class="clearfix">
                    <h4 class="setting-title"><?php echo __l('Settings'); ?></h4>
                    <ul>
                      <li class="admin-sub-links-left">
                        <ul>
                          <li>
                            <ul>
                              <li><?php echo $this->Html->link(__l('System'), array('controller' => 'settings', 'action' => 'edit', 1),array('title' => __l('System'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Developments'), array('controller' => 'settings', 'action' => 'edit', 5),array('title' => __l('Developments'))); ?></li>
							  <li><?php echo $this->Html->link(__l('SEO'), array('controller' => 'settings', 'action' => 'edit', 2),array('title' => __l('SEO'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Regional, Currency & Language'), array('controller' => 'settings', 'action' => 'edit', 6),array('title' => __l('Regional, Currency & Language'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Account'), array('controller' => 'settings', 'action' => 'edit', 3),array('title' => __l('Account'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Product'), array('controller' => 'settings', 'action' => 'edit', 11),array('title' => __l('Product'))); ?></li>
							 <li><?php echo $this->Html->link(__l('Payment'), array('controller' => 'settings', 'action' => 'edit', 12),array('title' => __l('Payment'))); ?></li>                              
                            </ul>
                          </li>
                        </ul>
                      </li>
                      <li class="admin-sub-links-right">
                        <ul>
                          <li>
                            <ul>
							  <li><?php echo $this->Html->link(__l('Referrals'), array('controller' => 'settings', 'action' => 'edit', 26),array('title' => __l('Referrals'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Messages'), array('controller' => 'settings', 'action' => 'edit', 13),array('title' => __l('Messages'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Third Party API'), array('controller' => 'settings', 'action' => 'edit', 4),array('title' => __l('Third Party API'))); ?></li>
							  <li><?php echo $this->Html->link(__l('CDN'), array('controller' => 'settings', 'action' => 'edit', 8),array('title' => __l('CDN'))); ?></li>
							  <li><?php echo $this->Html->link(__l('Module Manager'), array('controller' => 'settings', 'action' => 'edit', 10),array('title' => __l('Module Manager'))); ?></li>    
							  <li class="<?php echo $class;?>"><?php echo $this->Html->link(__l('Customize New Landing Page'), array('controller' => 'landing_page_photos', 'action' => 'admin_index'),array('title' => __l('Customize New Landing Page'))); ?></li>
							  <li class="<?php echo $class;?>"><?php echo $this->Html->link(__l('Customize PrivateShop Login'), array('controller' => 'users', 'action' => 'admin_customise_force_login'),array('title' => __l('Customize PrivateShop Login'))); ?></li></ul>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
    
     </li>
		</ul>
             </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
	</li>
  <li class="grid_3 masters masters-block gird_right<?php echo $class;?>"> <span class="amenu-left"> <span class="amenu-right"> <span class="menu-center admin-masters"><?php echo __l('Master');?></span> </span> </span>
    <div class="admin-sub-block">
      <div class="admin-top-lblock">
        <div class="admin-top-rblock">
          <div class="admin-top-cblock"></div>
        </div>
      </div>
      <div class="admin-sub-lblock">
        <div class="admin-sub-rblock">
          <div class="admin-sub-cblock clearfix">
            <ul class="admin-sub-links clearfix">
			<li>
			   <div class="page-info master-page-info"><?php echo __l('Warning! Please edit with caution.');?></div>
			<ul>
              <li class="admin-sub-links-left">
                <ul>
                  <li>
                    <h4><?php echo __l('Regional'); ?></h4>
                    <ul>
                      <li><?php echo $this->Html->link(__l('Banned IPs'), array('controller' => 'banned_ips', 'action' => 'index'),array('title' => __l('Banned IPs'))); ?></li>
                      <li><?php echo $this->Html->link(__l('Cities'), array('controller' => 'cities', 'action' => 'index'),array('title' => __l('Cities'))); ?></li>
                      <li><?php echo $this->Html->link(__l('Countries'), array('controller' => 'countries', 'action' => 'index'),array('title' => __l('Countries'))); ?></li>
                      <li ><?php echo $this->Html->link(__l('States'), array('controller' => 'states', 'action' => 'index'),array('title' => __l('States'))); ?></li>
                    </ul>
                  </li>
                  <li>
                    <h4><?php echo __l('Languages'); ?></h4>
                    <ul>
                      <li><?php echo $this->Html->link(__l('Languages'), array('controller' => 'languages', 'action' => 'index'),array('title' => __l('Languages'))); ?></li>
                      <li><?php echo $this->Html->link(__l('Translations'), array('controller' => 'translations', 'action' => 'index'),array('title' => __l('Translations'))); ?></li>
                    </ul>
                  </li>
                </ul>
              </li>
			  </ul>
			   </li>
              <li class="admin-sub-links-right">
                <ul>
				 <li>
                    <h4><?php echo __l('Static pages'); ?></h4>
                    <ul>
                      <li><?php echo $this->Html->link(__l('Manage Static Pages'), array('controller' => 'pages', 'action' => 'index'),array('title' => __l('Manage Static Pages'))); ?></li>
                    </ul>
                  </li>
				   <li>
                    <h4><?php echo __l('Email'); ?></h4>
                    <ul>
                      <li><?php echo $this->Html->link(__l('Email Templates'), array('controller' => 'email_templates', 'action' => 'index'),array('title' => __l('Email Templates'))); ?></li>
                     <li>
                    <h4><?php echo __l('Others'); ?></h4>
                    <ul>
                      	<li class="<?php echo $class;?>"><?php echo $this->Html->link(__l('Categories'), array('controller' => 'categories', 'action' => 'index'),array('title' => __l('Categories'))); ?></li>
						<li class="<?php echo $class;?>"><?php echo $this->Html->link(__l('IPs'), array('controller' => 'ips', 'action' => 'index'),array('title' => __l('IPs'))); ?></li>
					</ul>
                  </li>
                </ul>
              </li>
            </ul>
            </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="admin-bot-lblock">
        <div class="admin-bot-rblock">
          <div class="admin-bot-cblock"></div>
        </div>
      </div>
    </div>
  </li>
</ul>