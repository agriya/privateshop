<?php

/**
 *
 * @version $Id: cron.php 3 2010-04-07 06:03:46Z siva_063at09 $
 * @copyright 2009
 */
class CronShell extends Shell {
    function main()
    {
		require_once (LIBS . 'router.php');
        // site settings are set in config
        App::import('Model', 'Setting');
        $setting_model_obj = new Setting();
        $settings = $setting_model_obj->getKeyValuePairs();
        Configure::write($settings);
		App::import('Core', 'ComponentCollection');
		$collection = new ComponentCollection();
		App::import('Component', 'Cron');
		$this->Cron = new CronComponent($collection);
        $option = !empty($this->args[0]) ? $this->args[0] : '';
        switch ($option) {
            case 'main':
                $this->Cron->main();
                break;			
            default: ;
        } // switch
    }
}
?>