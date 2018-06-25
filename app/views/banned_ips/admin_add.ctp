<?php /* SVN: $Id: admin_add.ctp 66983 2011-09-27 11:09:58Z josephine_065at09 $ */ ?>
<div class="bannedIps form">
    <div class="js-corner round-5" id="form-content">
        <?php echo $this->Form->create('BannedIp', array('class' => 'normal clearfix'));?>
		<fieldset class="form-block round-5">
			<h3><?php echo __l('Current User Information'); ?></h3>
		  	<dl class="list clearfix">
				<dt><?php echo __l('Your IP: ');?></dt>
					<dd><?php echo $ip;?></dd>
        		<dt><?php echo __l('Your Hostname: ');?></dt>
					<dd><?php echo gethostbyaddr($ip);?></dd>
			</dl>

			<h3><?php echo __l('Ban Type'); ?></h3>
        	<div>

                <?php echo $this->Form->input('type_id', array('type' => 'radio', 'label' => __l('Select method'),'legend' => false));?>
                <?php echo $this->Form->input('address', array('label' => __l('Address/Range'))); ?>
                <?php echo $this->Form->input('range', array('label' => false, 'after' => __l('(IP address, domain or hostname)'))); ?>
            </div>
			 <div class="info-details page-info">
            	<h4><?php echo __l('Possibilities:'); ?></h4>
               	<div>
        			<p><?php echo __l('- Single IP/Hostname: Fill in either a hostname or IP address in the first field.'); ?></p>
        			<p><?php echo __l('- IP Range: Put the starting IP address in the left and the ending IP address in the right field.'); ?></p>
        			<p><?php echo __l('- Referer block: To block google.com put google.com in the first field. To block google altogether.'); ?></p>
                </div>
            </div>
      		<h3><?php echo __l('Ban Details'); ?></h3>
            <?php
        		echo $this->Form->input('reason', array('label' => __l('Reason'),'info' => __l('(optional, shown to victim)')));
        		echo $this->Form->input('redirect', array('label' => __l('Redirect'),'info' => __l('(optional)')));
        		echo $this->Form->input('duration_id', array('label' => __l('How long')));
        		echo $this->Form->input('duration_time', array('label' => false, 'info' => __l('Leave field empty when using permanent. Fill in a number higher than 0 when using another option!')));
        	?>
        	<div class="info-details page-info">
        		<h4><?php echo __l('Hints and tips:'); ?></h4>
        		<div>
            		<p><?php echo __l('- Banning hosts in the 10.x.x.x / 169.254.x.x / 172.16.x.x or 192.168.x.x range probably won\'t work.'); ?></p>
            		<p><?php echo __l('- Banning by internet hostname might work unexpectedly and resulting in banning multiple people from the same ISP!'); ?></p>
            		<p><?php echo __l('- Wildcards on IP addresses are allowed. Block 84.234.*.* to block the whole 84.234.x.x range!'); ?></p>
            		<p><?php echo __l('- Setting a ban on a range of IP addresses might work unexpected and can result in false positives!'); ?></p>
            		<p><?php echo __l('- An IP address always contains 4 parts with numbers no higher than 254 separated by a dot!'); ?></p>
            		<p><?php echo __l('- If a ban does not seem to work try to find out if the person you\'re trying to ban doesn\'t use <a href="http://en.wikipedia.org/wiki/DHCP" target="_blank" title="DHCP">DHCP.</a>'); ?></p>
                </div>
        	</div>
			</fieldset>


        <div class="submit-block clearfix">
		<?php echo $this->Form->submit(__l('Add'));?>
        <div class="cancel-block">
            <?php echo $this->Html->link(__l('Cancel'), array('controller' => 'banned_ips', 'action' => 'index'), array('class' => '', 'title' => __l('Cancel'), 'escape' => false));?>
        </div>
	</div>
    <?php echo $this->Form->end(); ?>
    </div>
</div>