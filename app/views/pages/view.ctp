<?php
if($this->request->params['pass'][0]=='home'){ ?>

	<h2><?php echo $page['Page']['title']; ?></h2> 
	<?php echo $page['Page']['content']; ?>

<?php }else if($this->request->params['pass'][0]=='about-us'){ ?>

	<div id="side2" class="about-bg grid_23 clearfix">
	<h2 class="about"><?php echo $page['Page']['title']; ?></h2>
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	</div>

<?php }else if($this->request->params['pass'][0]=='career'){ ?>
	
	<div id="side2" class="career-bg grid_23 clearfix">
	<h2 class="career-head"><?php echo $page['Page']['title']; ?></h2> 
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	</div>
	

<?php }elseif($this->request->params['pass'][0]=='distributor'){ ?>
	
	<div id="side2" class="ditributor-bg grid_23 clearfix">
	<h2 class="ditributor-head"><?php echo $page['Page']['title']; ?></h2> 
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	

<?php }elseif($this->request->params['pass'][0]=='contactus'){ ?>

	<div id="side2" class="contact-bg grid_23 clearfix">
	<h2 class="contact-head"><?php echo $page['Page']['title']; ?></h2>
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	

<?php }elseif($this->request->params['pass'][0]=='privacy-policy'){ ?>
	
	<div id="side2" class="privacy-bg grid_23 clearfix">
	<h2 class="privacy-head"><?php echo $page['Page']['title']; ?></h2>
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content"> 
	<?php echo $page['Page']['content']; ?>
	</div>
	</div>

<?php }elseif($this->request->params['pass'][0]=='disclaimer'){ ?>

	<div id="side2" class="disclaimer-bg grid_23 clearfix">
	<h2 class="disclaimer-head"><?php echo $page['Page']['title']; ?></h2>
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	</div> 

<?php }elseif($this->request->params['pass'][0]=='terms-of-use'){ ?>
	
	<div id="side2" class="terms-bg grid_23 clearfix">
	<h2 class="terms-head"><?php echo $page['Page']['title']; ?></h2> 
	</div>
	<div id="side3" class="grid_23">
	<div class="about-content">
	<?php echo $page['Page']['content']; ?>
	</div>
	</div>
<?php }elseif($this->request->params['pass'][0]=='company'){ ?>
    <div class="register-block grid_23">
        <div class="deal-side2 login-side2 deal">
            <div class="deal-inner-block deal-bg round-15 clearfix">
              <h3><?php echo __l('Business'); ?></h3>
              <h3><?php echo __l('Sign Up / Sign In'); ?></h3>
              <p> <?php echo $this->Html->link(__l('Login'), array('controller' => 'users', 'action' => 'login'), array('title' => __l('Login')));?></p>
               <p> <?php echo $this->Html->link(__l('Register'), array('controller' => 'company', 'action' => 'user', 'register'), array('title' => __l('Register')));?>
              </p>
              <div class="deal-bot-bg"> </div>
            </div>
          </div>
     </div>
	<div id="side3" class="grid_23">
        <div class="about-content">
        <?php echo $page['Page']['content']; ?>
        </div>
	</div>
<?php
}else if($this->request->params['pass'][0]=='api' || $this->request->params['pass'][0]=='api-terms-of-use' || $this->request->params['pass'][0]=='api-branding-requirements' || $this->request->params['pass'][0]=='api-instructions'){ ?>
	<div id="side2" class="newsletter-bg clearfix grid_23">
		<h2><?php echo $page['Page']['title']; ?></h2>
	</div>
	<div id="side3" class="grid_23">
		<div class="about-content">
			<?php echo $page['Page']['content']; ?>
		</div>
	</div>
	<div>
		<ul class="api-list">
			<li><?php echo $this->Html->link(__l('Terms of Use'), array('controller' => 'pages', 'action' => 'view', 'api-terms-of-use'), array('title' => __l('Terms of Use'), 'target' => '_blank'));?></li>
			<li><?php echo $this->Html->link(__l('Branding Requirements'), array('controller' => 'pages', 'action' => 'view', 'api-branding-requirements'), array('title' => __l('Branding Requirements'), 'target' => '_blank'));?></li>
			<li><?php echo $this->Html->link(__l('API Instructions'), array('controller' => 'pages', 'action' => 'view', 'api-instructions'), array('title' => __l('API Instructions'), 'target' => '_blank'));?></li>
		</ul>
	</div>
<?php } else { ?>
<div class="clearfix">
  
	<div class="clearfix">
	<h2><?php echo $page['Page']['title']; ?></h2>
	<?php if(!empty($this->request->params['named']['type']) && $this->request->params['named']['type']): ?>
	    <span><?php echo $this->Html->link(__l('Continue Editing'), array('action' => 'edit', $page['Page']['id']), array('class' => 'edit js-edit', 'title' => __l('Continue Editing')));?></span>
		<?php endif; ?>
	
	<div class="static-content common-outet-block">
	<?php echo $page['Page']['content']; ?>
	</div>
	</div>
	
  </div>
<?php } ?>