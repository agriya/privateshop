<div class="userProfiles-edit">
		<div class="form-blocks user-profile-form js-corner round-5">
			<?php echo $this->Form->create('UserProfile', array('action' => 'edit', 'class' => 'normal add-form profile-form clearfix ', 'enctype' => 'multipart/form-data'));?>
     <?php  if(empty($this->request->params['admin'])) {?>
	 <h2><?php echo sprintf(__l('Edit Profile - %s'), $this->request->data['User']['username']);?></h2><?php } ?>
					<fieldset class="fields-block">
						<h3 class="fields-title"><?php echo __l('Personal Info');?></h3>
							<div class="clearfix user-profile-block">
								<div class="profile-image">
									<?php echo $this->Html->link($this->Html->showImage('UserAvatar', $this->request->data['UserAvatar'], array('dimension' => 'small_big_thumb', 'alt' => sprintf(__l('[Image: %s]'), $this->Html->cText($this->request->data['User']['username'], false)), 'title' => $this->Html->cText($this->request->data['User']['username'], false))), array('controller' => 'users', 'action' => 'view',  $this->request->data['User']['username'], 'admin' => false), array('escape' => false)); ?>
								</div>
				
								<?php
									if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
										echo $this->Form->input('User.id');
									endif;
									if($this->request->data['User']['user_type_id'] == ConstUserTypes::Admin):
										echo $this->Form->input('User.username',array('label'=>__l('Username')));
									endif;
									if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
										echo $this->Form->input('User.email',array('label'=>__l('Email')));
									endif;
									echo $this->Form->input('first_name', array('label'=>__l('First Name')));
									echo $this->Form->input('last_name' , array('label'=>__l('Last Name')));
									echo $this->Form->input('middle_name', array('label'=>__l('Middle Name')));
									echo $this->Form->input('gender_id', array('empty' => __l('Please Select'), 'label'=>__l('Gender')));
								?>
								<div class="input date-time end-date-time-block dob-block clearfix <?PHP if($this->Auth->user('user_type_id') != ConstUserTypes::Admin){ echo "required"; } ?> js-clone">
									<div class="js-datetime">
								<?php echo $this->Form->input('dob', array('label' => __l('DOB'),'empty' => __l('Please Select'),  'minYear' => date('Y') - 100, 'maxYear' => date('Y'), 'orderYear' => 'asc', 'div' => false)); ?>
								</div>
								</div>
								<div class="aboutme-block">
								<?php echo $this->Form->input('about_me', array('label'=>__l('About me'))); ?>
                              </div>
						</div>
					</fieldset>
					<fieldset class="fields-block">
						<h3 class="fields-title"><?php echo __l('Address');?></h3>
						<div class="mapblock-info">
							<div class="clearfix">
								<?php echo $this->Form->input('address', array('label' => __l('Address'), 'id' => 'UserAddressSearch')); ?>
							</div>
							<?php
								echo $this->Form->input('latitude', array('id' => 'latitude', 'type' => 'hidden'));
								echo $this->Form->input('longitude', array('id' => 'longitude', 'type' => 'hidden'));
								echo $this->Form->input('country_id',array('id'=>'js-country_id','type' => 'hidden'));
								echo $this->Form->input('State.name', array('type' => 'hidden'));
								echo $this->Form->input('City.name', array('type' => 'hidden'));
							?>
							<div id="address-info" class="hide page-information"><?php echo __l('Please select correct address value'); ?></div>
							<div id="mapblock">
								<div id="mapframe">
									<div id="mapwindow"></div>
								</div>
							</div>
						</div>
						<?php
							echo $this->Form->input('language_id', array('empty' => __l('Please Select'), 'label'=>__l('Language')));
							echo $this->Form->input('zip_code', array('label'=>__l('Zip Code')));
						?>
				</fieldset>
				<fieldset class="fields-block">
						<h3 class="fields-title"><?php echo __l('Other');?></h3>
						<?php
							if($this->Auth->user('user_type_id') == ConstUserTypes::Admin):
								echo $this->Form->input('User.is_active', array('label' => __l('Active')));
								echo $this->Form->input('User.is_email_confirmed', array('label' => __l('Email confirmed')));
							endif;
							echo $this->Form->input('UserAvatar.filename', array('type' => 'file', 'size' => '33', 'label' => __l('Upload Photo'), 'class' => 'browse-field'));
						?>
						</fieldset>
 <div class="submit-block clearfix">	<?php echo $this->Form->submit(__l('Update')); ?></div>
<?php echo $this->Form->end(); ?>

		</div>
</div>