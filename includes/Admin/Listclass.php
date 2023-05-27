<?php

namespace Health\Care\Admin;

if (!class_exists('WP_List_Table')) {
    require_once HLC_PLUGIN_PATH . 'wp-admin/includes/class-wp-list-table.php';
}

/**
 * List Table Class
 */
class Listclass extends \WP_List_Table

{

    public function __construct()
    {
        parent::__construct([
            'singular' => 'contact',
            'plural' => 'contacts',
            'ajax' => false,
        ]);
    }

    /**
     * Message to show if no designation found
     *
     * @return void
     */
    public function no_items()
    {
        _e('No address found', 'wedevs-academy');
    }

    /**
     * Get the column names
     *
     * @return array
     */
    public function get_columns()
    {
        return [
            'cb' => '<input type="checkbox" />',
            'umeta_id' => __('Order Id', 'textdomain'),
            'user_id' => __('User Name', 'textdomain'),
            'meta_value' => __('Order Details', 'textdomain'),
        ];
    }

    /**
     * Get sortable columns
     *
     * @return array
     */
    public function get_sortable_columns()
    {
        $sortable_columns = [

            // 'user_id' => ['user_id', true],
        ];

        return $sortable_columns;
    }

    /**
     * Set the bulk actions
     *
     * @return array
     */
    public function get_bulk_actions()
    {
        $actions = array(
            'trash' => __('Move to Trash', 'textdomain'),
        );

        return $actions;
    }

    /**
     * Default column values
     *
     * @param  object $item
     * @param  string $column_name
     *
     * @return string
     */
    protected function column_default($item, $column_name)
    {

        switch ($column_name) {

            case 'created_at':
                return wp_date(get_option('date_format'), strtotime($item->created_at));

            default:
                return isset($item->$column_name) ? $item->$column_name : '';
        }
    }

    /**
     * Render the "cb" column
     *
     * @param  object $item
     *
     * @return string
     */
    protected function column_cb($item)
    {
        // print_r($item);
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->umeta_id
        );
    }

    /**
     * Render the umeta_id column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_umeta_id($item)
    {

        $actions = [];

        $actions['edit'] = sprintf('<a href="%s" title="%s">%s</a>', admin_url('admin.php?page=health-care-list&action=edit&id=' . $item->umeta_id), $item->umeta_id, __('Edit', 'wedevs-academy'), __('Edit', 'wedevs-academy'));
        $actions['delete'] = sprintf('<a href="%s" class="submitdelete" onclick="return confirm(\'Are you sure?\');" title="%s">%s</a>', wp_nonce_url(admin_url('admin-post.php?action=wd-ac-delete-address&id=' . $item->umeta_id), 'wd-ac-delete-address'), $item->umeta_id, __('Delete', 'wedevs-academy'), __('Delete', 'wedevs-academy'));

        return sprintf(
            '<a href="%1$s"><strong>%2$s</strong></a> %3$s', admin_url('admin.php?page=health-care-list&action=view&id' . $item->umeta_id), $item->umeta_id, $this->row_actions($actions)
        );
    }

    /**
     * Render the user_id column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_user_id($item)
    {
        $user_id = $item->user_id;
        $user_data = get_userdata($user_id);
        $user_name = $user_data->user_login;
        return $user_name;
    }

    /**
     * Render the user_id column
     *
     * @param  object $item
     *
     * @return string
     */
    public function column_meta_value($item)
    {

        $meta_value = (unserialize($item->meta_value));

        $ordererd_item = $meta_value[0];
        $pickup_date = $meta_value[1];
        $order_status = $meta_value[2];

        echo ('Test Name: ' . $ordererd_item);
        echo "<br>";
        echo ('Pickup Date: ' . $pickup_date);
        echo "<br>";
        echo ('Order Status: ' . '<b>' . $order_status . '</b>');
    }

    /**
     * Prepare the address items
     *
     * @return void
     */
    public function prepare_items()
    {
        $column = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = [$column, $hidden, $sortable];

        $per_page = 10;
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        $args = [
            'number' => $per_page,
            'offset' => $offset,
        ];

        if (isset($_REQUEST['orderby']) && isset($_REQUEST['order'])) {
            $args['orderby'] = $_REQUEST['orderby'];
            $args['order'] = $_REQUEST['order'];
        }

        $this->items = hlc_get_patients($args);

        $this->set_pagination_args([
            'total_items' => wd_ac_address_count(),
            'per_page' => $per_page,
        ]);

    }
}
