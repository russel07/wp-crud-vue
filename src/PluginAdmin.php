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
        wp_enqueue_style( $this->plugin_name.'bootstrap', plugin_dir_url( PLUGIN_FILE_URL ) . 'public/css/bootstrap.min.css', array(), $this->plugin_version, 'all' );
    }

    public function enqueue_scripts(){
        wp_register_script($this->plugin_name.'main', plugin_dir_url( PLUGIN_FILE_URL ) . 'public/js/main.js', array(), $this->plugin_version, 'all' );
        wp_register_script($this->plugin_name.'vue', plugin_dir_url( PLUGIN_FILE_URL ) . 'admin/assets/vue.js', array(), $this->plugin_version, true );

        wp_enqueue_script( $this->plugin_name.'vue' );
        wp_enqueue_script( $this->plugin_name.'main' );

    }

    public function get_products(){
        global $wpdb;
        $table_name = $wpdb->prefix . PRODUCT_TABLE;
        $this->items = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

        echo json_encode($this->items,JSON_PRETTY_PRINT);
        die();
    }

    public function get_product(){
        global $wpdb;
        $table_name = $wpdb->prefix.PRODUCT_TABLE;

        if(isset($_REQUEST['id']) && $_REQUEST['id']) {
            $id = $_REQUEST['id'];
            $result = $wpdb->get_row("select * from $table_name where id =  $id");

            wp_send_json(array(
                'status' => true,
                'data' => $result
            ));
            wp_die();
        }else{
            wp_send_json(array(
                'status' => false,
                'message' => 'Invalid request submitted'
            ));
            wp_die();
        }
    }

    public function save_product(){
        global $wpdb;
        $table_name = $wpdb->prefix.PRODUCT_TABLE;

        $default = array(
            'id' => 0,
            'product_title' => '',
            'product_description' => '',
            'price' => 0.0,
        );

        $item = shortcode_atts($default, $_REQUEST);
        $validate = $this->validate_product_form_data($item);
        if($validate){
            if($item['id']){
                $wpdb->update($table_name, $item, array('id'=> $item['id']));
            }else {
                $wpdb->insert($table_name, $item);
                $item['id'] = $wpdb->insert_id;
            }
            echo json_encode(array(
                'status' => true,
                'data' => $item
            ),JSON_PRETTY_PRINT);
            die();
        }else{
            echo json_encode(array(
                'status' => false,
                'message' => $validate
            ),JSON_PRETTY_PRINT);
            die();
        }
    }

    public function delete_product(){
        global $wpdb;
        $table_name = $wpdb->prefix.PRODUCT_TABLE;

        if(isset($_REQUEST['id']) && $_REQUEST['id']){
            $id = $_REQUEST['id'];
            $wpdb->delete($table_name, array('id' => $id));

            wp_send_json(array(
                'status' => true,
                'message' => 'Invalid request submitted'
            ));
            wp_die();
        }else{
            wp_send_json(array(
                'status' => false,
                'message' => 'Invalid request submitted'
            ));
            wp_die();
        }
    }

    function validate_product_form_data($item){
        $messages = array();

        if (empty($item['product_title'])) $messages[] = __('Product title can not be blank', 'custom_product_crud');
        if (empty($item['product_description'])) $messages[] = __('Product Description can not be blank', 'custom_product_crud');
        if (empty($item['price'])) $messages[] = __('Price can not be blank', 'custom_product_crud');
        if (!is_numeric($item['price'])) $messages[] = __('Product price should be a valid number', 'custom_product_crud');

        if (empty($messages)) return true;
        return implode('<br />', $messages);
    }

    public function rus_crud_shortcode(){
        add_shortcode( 'WPCRUDVUE', array($this, 'ruscrud_shortcode') );
    }

    public function ruscrud_shortcode($atts = [], $content = null, $tag = ''){
        $atts = array_change_key_case( (array) $atts, CASE_LOWER );

        $rows = $this->getProduct($atts);
        $o = "<div class='product-wrap row'>";
        if(!empty($rows)) {
            foreach ($rows as $row) {
                $o .= "<div class='card m-2'><div class='card-header'><h3 class='card-title'>$row->product_title</h3></div>";
                $o .= "<div class='card-body'><p>$row->product_description</p></div>";
                $o .= "<div class='card-footer'>$row->price</div></div>";
            }
        }
        else $o .= '<span>No product found</span>';
        if ( ! is_null( $content ) ) {
            // secure output by executing the_content filter hook on $content
            $o .= apply_filters( 'the_content', $content );

            // run shortcode parser recursively
            $o .= do_shortcode( $content );
        }
        $o .= '</div>';
        return $o;
    }

    public function getProduct($atts){
        global $wpdb;
        $table_name = $wpdb->prefix.PRODUCT_TABLE;
        $id = $atts['id'];

        return $wpdb->get_results("select * from $table_name where id IN( $id)");
    }

}
