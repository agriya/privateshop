<?php /* SVN: $Id: do_payment.ctp 54285 2011-05-23 10:16:38Z aravindan_111act10 $ */ ?>
<h2><?php echo __l('Awesome!'); ?></h2>
<h3><?php echo __l('You are being redirected to the payment page...'); ?></h3>
<div class="progress"></div>
<div class="hide">
	<?php $this->Gateway->paypal($gateway_options); ?>
</div>