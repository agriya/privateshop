<?php
class DevsController extends AppController
{
    var $name = 'Devs';
    var $uses = null;
    var $helpers = array(
        'Javascript'
    );
    function robots()
    {
    }
    function sitemap()
    {
        $import_models = Configure::read('sitemap.models');
        if (!empty($import_models)) {
            foreach($import_models as $model_name => $settings) {
                //condition to check when only model name given in sitemap models array
                if (!is_array($settings)) {
                    unset($import_models[$model_name]);
                    $model_name = $settings;
                    $settings = array();
                    $import_models[$model_name] = array();
                }
                //Default settings, you can override priority, fields
                $_settings = array(
                    'limit' => 20,
                    'recursive' => -1,
                    'priority' => 0.8,
                    'fields' => array(
                        'slug',
                        'id'
                    )
                );
                $settings = array_merge($_settings, $settings);
                //Adding modified field in settings to fetch in find query
                $settings['fields'][] = 'modified';
                $import_models[$model_name] = $settings;
                $this->loadModel($model_name);
            }
        }
        $this->set('_this', $this);
        $this->set('import_models', $import_models);
        $this->render('index');
    }
    //@todo favatar helper
    function favatar($base64_encoded_url)
    {
        $url = base64_decode($base64_encoded_url);
        $url_parts = parse_url($url);
        $host = str_replace(array(
            '/',
            '\\',
            '.',
            '&',
            '>',
            '<',
            ';',
            ',',
            '@',
            '$'
        ) , '-', $url_parts['host']);
        if (file_exists(IMAGES . 'favicons' . DS . $host . '.png')) {
            $this->redirect('/img/favicons/' . $host . '.png');
        }
        require_once (APP . 'vendors' . DS . 'floicon' . DS . 'floIcon.php');
        ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11');
        $icon_file = new floIcon();
        if (@copy('http://' . $url_parts['host'] . '/favicon.ico', IMAGES . 'favicons' . DS . $host . '.ico')) {
            if ($icon_file->readICO(IMAGES . 'favicons' . DS . $host . '.ico')) {
                imagepng($icon_file->getBestImage(16, 16) , IMAGES . 'favicons' . DS . $host . '.png');
            } else {
                @copy(IMAGES . 'favicons' . DS . '_no-favicon.png', IMAGES . 'favicons' . DS . $host . '.png');
            }
            @unlink(IMAGES . 'favicons' . DS . $host . '.ico');
            $this->redirect('/img/favicons/' . $host . '.png');
        }
        /* Not necessarily needed; until client insists it... so commented out
        // code from http://plugins.trac.wordpress.org/browser/favatars/trunk/favatars.php
        // start by fetching the contents of the URL they left...

        if ($html = @file_get_contents($url)) {
        if (preg_match('/<link[^>]+rel="(?:shortcut )?icon"[^>]+?href="([^"]+?)"/si', $html, $matches)) {
        // Attempt to grab a favicon link from their webpage url
        $linkUrl = html_entity_decode($matches[1]);
        if (substr($linkUrl, 0, 1) == '/') {
        $urlParts = parse_url($url);
        $faviconURL = $urlParts['scheme'] . '://' . $urlParts['host'] . $linkUrl;
        } else if (substr($linkUrl, 0, 7) == 'http://') {
        $faviconURL = $linkUrl;
        } else if (substr($url, -1, 1) == '/') {
        $faviconURL = $url . $linkUrl;
        } else {
        $faviconURL = $url . '/' . $linkUrl;
        }
        }
        } */
        @copy(IMAGES . 'favicons' . DS . '_no-favicon.png', IMAGES . 'favicons' . DS . $host . '.png');
        $this->redirect('/img/favicons/' . $host . '.png');
    }
    function _is_writable_recursive($dir)
    {
        if (!($folder = @opendir($dir))) {
            return false;
        }
        while ($file = readdir($folder)) {
            if ($file != '.' && $file != '..' && $file != '.svn' && (!is_writable($dir . DS . $file) || (is_dir($dir . DS . $file) && !$this->_is_writable_recursive($dir . DS . $file)))) {
                closedir($folder);
                return false;
            }
        }
        closedir($folder);
        return true;
    }
	public function admin_clear_cache()
    {
		$this->_traverse_directory(CACHE, 0);
		@unlink(WWW_ROOT . 'index.html');
		$this->Session->setFlash(__l('Cache has been cleared'), 'default', null, 'success');
		if (!empty($_GET['f'])) {
			$this->redirect(Router::url('/', true) . $_GET['f']);
		}
		$this->redirect(array(
			'controller' => 'devs',
			'action' => 'logs'
		));
	}
	public function _traverse_directory($dir, $dir_count)
	{
		$handle = opendir($dir);
		while (false !== ($readdir = readdir($handle))) {
			if ($readdir != '.' && $readdir != '..') {
				$path = $dir . '/' . $readdir;
				if (is_dir($path)) {
					@chmod($path, 0777);
					++$dir_count;
					$this->_traverse_directory($path, $dir_count);
				}
				if (is_file($path)) {
					@chmod($path, 0777);
					@unlink($path);
				}
			}
		}
		closedir($handle);
		return true;
	}
    public function admin_logs()
    {
        $this->pageTitle = __l('Debug & Error Log');
        $log_arr = array(
            'error_log' => LOGS . 'error.log',
            'debug_log' => LOGS . 'debug.log',
            'email_log' => LOGS . 'email.log'
        );
        foreach($log_arr as $key => $log_path) {
            if (file_exists($log_path)) {
                $handle = fopen($log_path, "r");
                fseek($handle, -10240, SEEK_END);
                $this->set($key, fread($handle, 10240));
                fclose($handle);
            }
        }
        $this->set('tmpCacheFileSize', bytes_to_higher(dskspace(TMP . 'cache')));
        $this->set('tmpLogsFileSize', bytes_to_higher(dskspace(TMP . 'logs')));
    }
    public function admin_clear_logs()
    {
        if (!empty($this->request->params['named']['type']) && in_array($this->request->params['named']['type'], array(
            'error',
            'debug',
            'email'
        ))) {
            unlink(LOGS . $this->request->params['named']['type'] . '.log');
            $this->Session->setFlash(sprintf(__l('%s log has been cleared') , ucfirst($this->request->params['named']['type'])) , 'default', null, 'success');
        }
        $this->redirect(array(
            'controller' => 'devs',
            'action' => 'logs'
        ));
    }
    function asset_js()
    {
        $this->autoRender = false;
        $args = func_get_args();
        $extension = '';
        $filename = $args[0];
        if ($args[0] == 'mobile' || $args[0] == 'touch') {
            $extension = $args[0] . DS;
            $filename = $args[1];
        }
        if (strpos($filename, '.cache') === false) {
            throw new NotFoundException(__l('Invalid request'));
        }
        list($file_name, $cache, $ext) = explode('.', $filename);
        if (!file_exists(APP . 'views' . DS . 'layouts' . DS . $extension . $file_name . '.js.inc.php')) {
            throw new NotFoundException(__l('Invalid request'));
        } else {
            if (file_exists(JS . $filename)) {
                $this->redirect(Router::url('/', true) . $this->request->url);
            } else {
                $scriptBuffer = '';
                $view = new View($this);
                $this->Javascript = $view->loadHelper('Javascript');
                App::import('Vendor', 'JSMin', true, array() , 'jsmin' . DS . 'jsmin.php');
                require_once (APP . 'views' . DS . 'layouts' . DS . $extension . $file_name . '.js.inc.php');
                if (!empty($js_inline)) {
	                $scriptBuffer = $js_inline;
				}
                foreach($js_files as $i => $script) {
                    $buffer = file_get_contents(JS . $script);
                    if (Configure::read('debug') == 0) {
                        $buffer = trim(JSMin::minify($buffer));
                    }
                    $scriptBuffer.= "\n/* $script */\n" . $buffer;
                }
                App::import('Core', 'File');
                $file = new File(JS . $extension . $filename);
                $file->write(trim($scriptBuffer));
                $this->redirect(Router::url('/', true) . $this->request->url);
            }
        }
    }
    function asset_css()
    {
        $this->autoRender = false;
        $args = func_get_args();
        $extension = '';
        $filename = $args[0];
        if ($args[0] == 'mobile' || $args[0] == 'touch') {
            $extension = $args[0] . DS;
            $filename = $args[1];
        }
        if (strpos($filename, '.cache') === false) {
            throw new NotFoundException(__l('Invalid request'));
        }
        list($file_name, $cache, $ext) = explode('.', $filename);
        if (!file_exists(APP . 'views' . DS . 'layouts' . DS . $extension . $file_name . '.css.inc.php')) {
            throw new NotFoundException(__l('Invalid request'));
        } else {
            if (file_exists(CSS . $filename)) {
                $this->redirect(Router::url('/', true) . $this->request->url);
            } else {
                $scriptBuffer = '';
                App::import('Vendor', 'csstidy', true, array() , 'csstidy' . DS . 'class.csstidy.php');
                require_once (APP . 'views' . DS . 'layouts' . DS . $extension . $file_name . '.css.inc.php');
                foreach($css_files as $i => $script) {
                    $buffer = file_get_contents(CSS . $script);
                    if (Configure::read('debug') == 0) {
                        $tidy = new csstidy();
                        $tidy->settings['merge_selectors'] = false;
                        $tidy->load_template('high_compression');
                        $tidy->parse($buffer);
                        $buffer = $tidy->print->plain();
                    }
                    $scriptBuffer.= "\n/* $script */\n" . $buffer;
                }
				if ($_imagePath = Configure::read('cdn.images')) {
					$scriptBuffer = str_ireplace('../img', $_imagePath . DS . 'img', $scriptBuffer);
				}
                App::import('Core', 'File');
                $file = new File(CSS . $extension . $filename);
                $file->write(trim($scriptBuffer));
                $this->redirect(Router::url('/', true) . $this->request->url);
            }
        }
    }
	function yadis()
	{
		Configure::write('debug', 0);
		header('Content-type: application/xrds+xml');
	}
}
