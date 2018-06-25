<div class="dashboard-center-block">
     <div class="admin-side2-tl ">
        <div class="admin-side2-tr">
          <div class="admin-side2-tm page-title-info">
            <h2 class="online-users"><?php echo __l('Online users'); ?></h2>
          </div>
        </div>
        </div>
        <div class="admin-center-block admin-dashboard-links">
            <?php
                if (!empty($onlineUsers)):
                    $users = '';
                    foreach ($onlineUsers as $user):
						$users .= sprintf('%s, ',$this->Html->link($this->Html->cText($user['User']['username'], false), array('controller'=> 'users', 'action' => 'view', $user['User']['username'], 'admin' => false), array('title' => $this->Html->cText($user['User']['username'], false))));
					endforeach;
					echo substr($users, 0, -2);
				else:
			?>
					<p class="notice"><?php echo __l('Recently no users online');?></p>
			<?php
				endif;
			?>
		</div>
			<div class="admin-side2-bl ">
                <div class="admin-side2-br">
                  <div class="admin-side2-bm">
                          </div>
                </div>
            </div>
	</div>