<?php
// Config.class.php
class Config {
    private static $instance = null;
    
    public $root_path;
    public $server_name;
    public $server_url;
    public $app_root;
    public $app_url; 

    private function __construct() {
        $this->server_name = 'localhost';
        $this->server_url = 'http://' . $this->server_name;
        $this->app_root = '/php_04_obiektowosc';
        $this->app_url = $this->server_url . $this->app_root;
        $this->root_path = dirname(__FILE__);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Config();
        }
        return self::$instance;
    }
}
?>
