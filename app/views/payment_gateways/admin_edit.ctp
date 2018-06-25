<?php /* SVN: $Id: admin_edit.ctp 2895 2010-09-02 10:58:05Z sakthivel_135at10 $ */ ?>
<div class="paymentGateways form">
	<?php echo $this->Form->create('PaymentGateway', array('class' => 'normal add-form clearfix'));?>
		<fieldset>
			<?php
				echo $this->Form->input('id');
				echo $this->Form->input('display_name ', array('label' => __l('Display Name'), 'info' => __l('Display name is the name displayed in the payment options for user.')));
				if($payment_gateway['PaymentGateway']['name'] == 'Wallet'):
					$info = __l('On activating this, users can pay from the site using site wallet payment option.');
					elseif($payment_gateway['PaymentGateway']['name'] == 'PayPal'):
					$info = __l('On activating this, users can pay from the site using PayPal payment option.');
				endif;
				echo $this->Form->input('PaymentGateway.is_active', array('label' => __l('Active'), 'info' => $info));
				if ($this->request->data['PaymentGateway']['id'] != ConstPaymentGateways::Wallet):
					echo $this->Form->input('PaymentGateway.is_test_mode', array('label' => __l('Live Mode?'),'info' => __l('On enabling this, live account will used instead of sandbox payment details. (Enable this, When site is in production stage)')));
					echo $this->Form->input('is_mass_pay_enabled', array('label' => __l('Enable for Mass Pay'),'type'=> 'checkbox', 'help' =>__l('On enabling this, admin can use this gateway to transfer amount to multiple account.')));
				endif;
				foreach($paymentGatewaySettings as $paymentGatewaySetting) {
					$options['type'] = $paymentGatewaySetting['PaymentGatewaySetting']['type'];
					if($paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'is_enable_for_purchase'):
						$options['label'] = __l('Enable for Purchase');
					elseif($paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'is_enable_for_add_to_wallet'):
						$options['label'] = __l('Enable for Add to Wallet');
					endif;
					$options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['test_mode_value'];
					$options['div'] = array('id' => "setting-{$paymentGatewaySetting['PaymentGatewaySetting']['key']}");
					if($options['type'] == 'checkbox' && !empty($options['value'])):
						$options['checked'] = 'checked';
					else:
						$options['checked'] = '';
					endif;
					if($options['type'] == 'select'):
						$selectOptions = explode(',', $paymentGatewaySetting['PaymentGatewaySetting']['options']);
						$paymentGatewaySetting['PaymentGatewaySetting']['options'] = array();
						if(!empty($selectOptions)):
							foreach($selectOptions as $key => $value):
								if(!empty($value)):
									$paymentGatewaySetting['PaymentGatewaySetting']['options'][trim($value)] = trim($value);
								endif;
							endforeach;
						endif;
						$options['options'] = $paymentGatewaySetting['PaymentGatewaySetting']['options'];
					endif;
					if (!empty($paymentGatewaySetting['PaymentGatewaySetting']['description']) && empty($options['after'])):
						$options['help'] = "{$paymentGatewaySetting['PaymentGatewaySetting']['description']}";
					else:
						$options['help'] = '';
					endif;
					if ($paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'is_enable_for_purchase' || $paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'is_enable_for_add_to_wallet'):
						echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.test_mode_value", $options);
					endif;
				}
				if ($paymentGatewaySettings && $this->request->data['PaymentGateway']['id'] != ConstPaymentGateways::Wallet) {
			?>
			<div class="clearfix">
				<div class="test-mode-left test-mode-label grid_6 prefix_2">
					<label for="PaymentGatewaySetting1TestModeValue"><?php echo __l('Test Mode'); ?></label>
				</div>
				<div class="test-mode-right test-mode-label grid_5">
					<label for="PaymentGatewaySetting1LiveModeValue"><?php echo __l('Live Mode'); ?></label>
				</div>
			</div>
			<?php
				$j = $i = $z = $n = 0;
				foreach($paymentGatewaySettings as $paymentGatewaySetting) {
					$options['type'] = $paymentGatewaySetting['PaymentGatewaySetting']['type'];
					$options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['test_mode_value'];
					$options['div'] = array('id' => "setting-{$paymentGatewaySetting['PaymentGatewaySetting']['key']}");
					if($options['type'] == 'checkbox' && $options['value']):
						$options['checked'] = 'checked';
					endif;
					if($options['type'] == 'select'):
                        $selectOptions = explode(',', $paymentGatewaySetting['PaymentGatewaySetting']['options']);
                        $paymentGatewaySetting['PaymentGatewaySetting']['options'] = array();
                        if(!empty($selectOptions)):
                            foreach($selectOptions as $key => $value):
                                if(!empty($value)):
                                    $paymentGatewaySetting['PaymentGatewaySetting']['options'][trim($value)] = trim($value);
                                endif;
                            endforeach;
                        endif;
                        $options['options'] = $paymentGatewaySetting['PaymentGatewaySetting']['options'];
                    endif;
					$options['label'] = false;
					if (!empty($paymentGatewaySetting['PaymentGatewaySetting']['description']) && empty($options['after'])):
						$options['help'] = "{$paymentGatewaySetting['PaymentGatewaySetting']['description']}";
					else:
						$options['help'] = '';
					endif;
			?>
					<?php if($paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'payee_account' || $paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'receiver_emails'): ?>
						<?php if($z == 0):?>
							<fieldset class="form-block1 round-5">
								<h3><?php echo __l('Payee Details'); ?></h3>
						<?php endif; ?>
								<div class="clearfix test-mode-content">
									<span class="label-content"><?php echo Inflector::humanize($paymentGatewaySetting['PaymentGatewaySetting']['key']); ?></span>
                                   <div class="clearfix">
                                	<div class="test-mode-left">
										<?php echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.test_mode_value", $options); ?>
									</div>
									<div class="test-mode-right">
										<?php
											$options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['live_mode_value'];
											echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.live_mode_value", $options);
										?>
									</div>
									</div>
								</div>
						<?php if ($z == 1): ?>
							</fieldset>
						<?php endif;?>
						<?php $z++;?>
					<?php endif; ?>
					<?php if($paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'masspay_API_UserName' || $paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'masspay_API_Password' || $paymentGatewaySetting['PaymentGatewaySetting']['key'] == 'masspay_API_Signature'): ?>
						<?php if($j == 0):?>
							<fieldset class="fields-block round-5">
								<h3><?php echo __l('Mass Payment Details'); ?></h3>
								<div class="page-info">
									<p><?php echo __l('Masspay used to send money to user.');?></p>
									<p><?php echo __l('Create masspay API from paypal profile. Refer').' ';?><a href='https://www.paypal.com/in/cgi-bin/webscr'>https://www.paypal.com/in/cgi-bin/webscr</a></p>
								</div>
						<?php endif;?>
								<div class="clearfix test-mode-content">
									<span class="label-content"><?php echo Inflector::humanize($paymentGatewaySetting['PaymentGatewaySetting']['key']); ?></span>
	                       	<div class="clearfix">
                                	<div class="test-mode-left">
										<?php echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.test_mode_value", $options); ?>
									</div>
									<div class="test-mode-right">
										<?php
											$options['value'] = $paymentGatewaySetting['PaymentGatewaySetting']['live_mode_value'];
											echo $this->Form->input("PaymentGatewaySetting.{$paymentGatewaySetting['PaymentGatewaySetting']['id']}.live_mode_value", $options);
										?>
									</div>
									</div>
								</div>
						<?php if($j == 2):?>
							</fieldset>
						<?php endif;?>
						<?php $j++;?>
					<?php endif;?>
	<?php
            }
		}
	?>
	</fieldset>
	<div class="submit-block clearfix"><?php echo $this->Form->submit(__l('Update'));?></div>
	<?php echo $this->Form->end();?>
</div>