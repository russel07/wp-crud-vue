<?php

namespace Russel\RusCrud;

class PluginDeactivator
{
    public function deactivate(){
        global $wpdb;

        $table_name = $wpdb->prefix . PRODUCT_TABLE;
        $sql = "DROP TABLE IF EXISTS $table_name";
        $wpdb->query($sql);
        delete_option("product_table_version");
    }
}