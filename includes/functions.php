<?php

/**
 * Fetch Addresses
 *
 * @param  array  $args
 *
 * @return array
 */
function hlc_get_patients($args = [])
{
    global $wpdb;
    $args = [
        'number' => 10,
        'offset' => 0,
        'orderby' => 'umeta_id',
        'order' => 'DESC',
        'patients-order' => 'patients-order',
    ];

    $sql = $wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}usermeta
            WHERE meta_key = %s
            ORDER BY {$args['orderby']} {$args['order']}
            LIMIT %d, %d",
        $args['patients-order'], $args['offset'], $args['number']
    );

    $items = $wpdb->get_results($sql);

    return $items;
}

/**
 * Get the count of total address
 *
 * @return int
 */
function wd_ac_address_count()
{
    global $wpdb;

    return (int) $wpdb->get_var("SELECT count(umeta_id) FROM {$wpdb->prefix}usermeta WHERE meta_key ='patients-order'");
}

/**
 * Fetch a single contact from the DB
 *
 * @param  int $id
 *
 * @return object
 */
function hlc_get_patients_order_meta($id)
{
    global $wpdb;

    $patients_meta = $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}usermeta WHERE umeta_id = %d", $id)
    );

    return $patients_meta;
}

/**
 * Insert a new address
 *
 * @param  array  $args
 *
 */
function hlc_insert_order_meta($args = [])
{
    global $wpdb;

    $defaults = [
        'meta_value' => '',
    ];

    // print_r($args);

    $data = wp_parse_args($args, $defaults);

    $id = $data['umeta_id'];

    $updated = $wpdb->update(
        $wpdb->prefix . 'usermeta',
        $data,
        ['umeta_id' => $id],
    );

    return $wpdb->insert_id;
}
