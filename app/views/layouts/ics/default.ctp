<?php /* SVN FILE: $Id: default.ctp 843 2010-04-02 05:40:58Z jayashree_028ac09 $ */ ?>
<?php
header('Content-Disposition: inline; filename="' . str_replace('/', '_', $this->request->url) . '"');
?>
<?php echo $content_for_layout; ?>