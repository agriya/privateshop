<?php
/* SVN FILE: $Id: ajax.ctp 1895 2010-05-18 09:05:38Z jayashree_028ac09 $ */
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework (http://www.cakephp.org)
 * Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc. (http://www.cakefoundation.org)
 * @link          http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @version       $Revision: 7805 $
 * @modifiedby    $LastChangedBy: AD7six $
 * @lastmodified  $Date: 2008-10-30 23:00:26 +0530 (Thu, 30 Oct 2008) $
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<?php if ($this->Session->check('Message.error') || $this->Session->check('Message.success') || $this->Session->check('Message.flash')): ?>
	<div class="js-flash-message flash-message-block">
		<?php
			if ($this->Session->check('Message.error')):
				echo $this->Session->flash('error');
			endif;
			if ($this->Session->check('Message.success')):
				echo $this->Session->flash('success');
			endif;
			if ($this->Session->check('Message.flash')):
				echo $this->Session->flash();
			endif;
		?>
	</div>
<?php endif; ?>
<?php echo $content_for_layout; ?>