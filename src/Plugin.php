<?php

namespace Russel\RusCrud;

class Plugin {
    protected $plugin_name;
    protected $plugin_version;
    protected $plugin_loader;

    static $instance = false;

    public function __construct(){
        $this->plugin_name = 'RusCRUD';
        $this->plugin_loader = '1.0';
        $this->plugin_loader = new PluginLoader();
        $this->activateMe();
        $this->deactivateMe();
        $this->define_public_scripts();
        $this->define_admin_hooks();
    }

    /**
     * @return bool|Plugin
     */
    public static function getInstance()
    {
        if(!self::$instance)
            self::$instance = new self();

        return self::$instance;
    }

    public function activateMe(){
        $activator = new PluginActivator();
        $this->plugin_loader->add_action('activate_rus-crud/index.php', $activator, 'rus_crud_create_product_table');
    }

    public function deactivateMe(){
        $deactivator = new PluginDeactivator();
        $this->plugin_loader->add_action('deactivate_rus-crud/index.php', $deactivator, 'deactivate');
    }

    public function define_admin_hooks(){
        $admin = new PluginAdmin($this->plugin_name, $this->plugin_version);
        $this->plugin_loader->add_action( 'admin_menu', $admin, 'products_admin_menu' );
        $this->plugin_loader->add_action('admin_init', $admin, 'enqueue_style');
        $this->plugin_loader->add_action('admin_init', $admin, 'enqueue_scripts');
        $this->plugin_loader->add_action('wp_ajax_get_products', $admin, 'get_products');
        $this->plugin_loader->add_action('wp_ajax_save_product', $admin, 'save_product');
        $this->plugin_loader->add_action('wp_ajax_delete_product', $admin, 'delete_product');
        $this->plugin_loader->add_action('wp_ajax_get_product', $admin, 'get_product');
        $this->plugin_loader->add_action('init', $admin, 'rus_crud_shortcode');
    }

    public function wp_crud_enqueue_style(){
        wp_enqueue_style( 'RUSCRUDVUE_bootstrap_css', plugin_dir_url( PLUGIN_FILE_URL ) . 'public/css/bootstrap.min.css');
        wp_enqueue_style( 'RUSCRUDVUE_css', plugin_dir_url( PLUGIN_FILE_URL ) . 'public/css/style.css');
    }

    public function define_public_scripts(){
        $this->plugin_loader->add_action('init', $this, 'wp_crud_enqueue_style');
    }

    public function init(){
        $this->plugin_loader->run();
    }
}