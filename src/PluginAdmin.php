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
}