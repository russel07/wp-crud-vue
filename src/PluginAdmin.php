<?php

namespace Russel\RusCrud;

class PluginAdmin
{
    protected  $plugin_name;
    protected $plugin_version;
    protected $views = array();

    public function __construct($name, $version)
    {
        $this->plugin_name = $name;
        $this->plugin_version = $version;
    }

    public function load_view() {
        $current_views = $this->views[current_filter()];
        include(dirname(PLUGIN_FILE_URL).'/admin/view/'.$current_views.'.php');
    }

    function products_admin_menu() {
        $view_hook_name = add_menu_page( 'Manage Product',
            'Manage Product',
            'manage_options',
            'products',
            array(&$this, 'load_view')
        );
        $this->views[$view_hook_name] = 'products';
    }


    public function enqueue_style(){
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( PLUGIN_FILE_URL ) . 'public/css/style.css', array(), $this->plugin_version, 'all' );
    }

    public function enqueue_scripts(){
        wp_register_script($this->plugin_name.'main', plugin_dir_url( PLUGIN_FILE_URL ) . 'public/js/main.js', array(), $this->plugin_version, 'all' );
        wp_register_script($this->plugin_name.'vue', plugin_dir_url( PLUGIN_FILE_URL ) . 'view/dist/js/app.fb3d4d2e.js', array(), $this->plugin_version, 'all' );

        wp_enqueue_script( $this->plugin_name.'vue' );
        wp_enqueue_script( $this->plugin_name.'main' );

    }
}