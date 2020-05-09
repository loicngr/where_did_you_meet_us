<?php

/**
 * Vérification du champ "Comment nous avez-vous connus" dans le formulaire de paiement
 */
add_action( 'woocommerce_checkout_process', 'my_custom_checkout_field_process' );
function my_custom_checkout_field_process() {
    // Check if set, if its not set add an error.
    if ( !$_POST['where_meet_us'] ) {
        wc_add_notice( __( '"Comment nous avez-vous connus ?" est obligatoire.' ), 'error' );
    }
}

/**
 * Ajout du champ "Comment nous avez-vous connus" dans le formulaire de paiement
 */
add_action( 'woocommerce_after_order_notes', 'my_custom_checkout_field' );
function my_custom_checkout_field( $checkout ) {

    echo '<div id="label_where_meet_us">';

    woocommerce_form_field( 'where_meet_us_select', array(
        'type'        => 'select',
        'required'    => true,
        'class'       => array('meet_us_select'),
        'label'       => __( 'Comment nous avez-vous connus ?' ),
        'options'     => array(
            '' => 'Choisissez une option',
            'already_client' => __('Déjà client'),
            'camper_van_driver' => __('Camping-Caristes'),
            'fairs' => __('Salons'),
            'social_network' => __('Réseaux Sociaux'),
            'other' => __('Autre')
        ),
    ), $checkout->get_value( 'where_meet_us_select' ) );

    woocommerce_form_field( 'where_meet_us', array(
        'type'        => 'textarea',
        'required'    => true,
        'class'       => array('meet_us_textarea'),
        'placeholder' => __( 'Comment nous avez-vous connus ?' ),
    ), $checkout->get_value( 'where_meet_us' ) );

    echo '</div>';

}

/**
 * Enregistrement du champ "Comment nous avez-vous connus" en base de données
 */
add_action( 'woocommerce_checkout_update_order_meta', 'save_my_custom_checkout_field_order_meta');
function save_my_custom_checkout_field_order_meta($order_id)
{
    if (!empty($_POST['where_meet_us'])) {
        update_post_meta($order_id, '_where_meet_us', sanitize_text_field($_POST['where_meet_us']));
    }
}

/**
 * Afficher "Comment nous avez-vous connus" Dans l'interface après avoir passer la commande
 */
add_action( 'woocommerce_thankyou', 'my_custom_checkout_field_display_order_data', 10, 1); // OK
function my_custom_checkout_field_display_order_data( $order_id ){
    $post_message = get_post_meta($order_id, '_where_meet_us', true );
    ?>
    <h2><?php _e( 'Informations supplémentaire : ' ); ?></h2>
    <table class="shop_table shop_table_responsive additional_info">
        <tbody>
        <tr>
            <th><?php _e( 'Comment nous avez-vous connus ?' ); ?></th>
            <td><?php echo ($post_message)? $post_message:'Pas de message...' ?></td>
        </tr>
        </tbody>
    </table>
    <?php
}

/**
 * Afficher "Comment nous avez-vous connus" Dans l'interface d'administration
 */
add_action( 'woocommerce_admin_order_data_after_shipping_address', 'my_custom_checkout_field_display_order_data_in_admin', 10, 1  ); // OK
function my_custom_checkout_field_display_order_data_in_admin( $order ){
    global $post_id;
    $order = new WC_Order( $post_id );
    $post_message = get_post_meta($order->get_id(), '_where_meet_us', true );
    ?>
    <div>
        <h2>Comment nous avez-vous connus ?</h2>
        <p><?php echo ($post_message)? $post_message:'Pas de message...' ?></p>
    </div>
    <?php
}