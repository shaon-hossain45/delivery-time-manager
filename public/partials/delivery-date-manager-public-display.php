<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Delivery_Date_Manager
 * @subpackage Delivery_Date_Manager/public/partials
 */
?>
<?php

/**
* DeliveryDateHooks class
*/

class DeliveryDateHooks {

    /**
     * Add engraving text to cart item.
     *
     * @param array $cart_item_data
     * @param int   $product_id
     * @param int   $variation_id
     *
     * @return array
     */
    public function deliveryoptions_filed() {
        ?>
        <div class="iconic-engraving-field">
            <label for="iconic-engraving"><?php _e( 'Delivery Date', 'Date' ); ?></label>
            <input type="text" id="datepicker" name="iconic-engraving" placeholder="<?php _e( 'Enter delivery date', 'iconic' ); ?>" required>
        </div>
        <?php
    }
       
    /**
     * Add engraving text to cart item.
     *
     * @param array $cart_item_data
     * @param int   $product_id
     * @param int   $variation_id
     *
     * @return array
     */
    public function deliveryoptions_filed_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
        $engraving_text = filter_input( INPUT_POST, 'iconic-engraving' );
    
        if ( empty( $engraving_text ) ) {
            return $cart_item_data;
        }
    
        $cart_item_data['iconic-engraving'] = $engraving_text;
    
        return $cart_item_data;
    }
    
    /**
     * Display engraving text in the cart.
     *
     * @param array $item_data
     * @param array $cart_item
     *
     * @return array
     */
    public function deliveryoptions_filed_display_text_cart( $item_data, $cart_item ) {
        if ( empty( $cart_item['iconic-engraving'] ) ) {
            return $item_data;
        }
    
        $item_data[] = array(
            'key'     => __( 'Delivery Date', 'iconic' ),
            'value'   => wc_clean( $cart_item['iconic-engraving'] ),
            'display' => '',
        );
    
        return $item_data;
    }
    
    
    /**
     * Add engraving text to order.
     *
     * @param WC_Order_Item_Product $item
     * @param string                $cart_item_key
     * @param array                 $values
     * @param WC_Order              $order
     */
    public function iconic_add_engraving_text_to_order_items( $item, $cart_item_key, $values, $order ) {
        if ( empty( $values['iconic-engraving'] ) ) {
            return;
        }
    
        $item->add_meta_data( __( 'Delivery Date', 'iconic' ), $values['iconic-engraving'] );
    }
    
    
    
    /**
     * @snippet       WooCommerce Max 1 Product @ Cart
     * @how-to        Get CustomizeWoo.com FREE
     * @author        Rodolfo Melogli
     * @compatible    WC 5.1
     * @donate $9     https://businessbloomer.com/bloomer-armada/
     */
    
    public function bbloomer_only_one_in_cart( $passed, $added_product_id ) {
       wc_empty_cart();
       return $passed;
    }
    
    public function custom_woocommerce_billing_fields( $fields )
    {
    
        $fields['billing_options'] = array(
            'label' => __('Delivery Date', 'woocommerce'), // Add custom field label
            'placeholder' => _x('Your Delivery Date here....', 'placeholder', 'woocommerce'), // Add custom field placeholder
            'required' => true, // if field is required or not
            'clear' => true, // add clear or not
            'type' => 'text', // add field type
            'class' => array('my-css'),    // add class name
            'id' => 'datepicker2',
        );
    
        return $fields;
    }
    
    
    // Process the checkout and overwriting the normal button
    public function change_proceed_to_checkout() {
        remove_action( 'woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20 );
    
        if(is_cart()){
    // Loop over $cart items
    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        if( isset( $cart_item['iconic-engraving'] ) ) {
            $product55 = $cart_item['iconic-engraving'];
        }
    }
    
        }
        ?>
        <form id="checkout_form" method="POST" action="<?php echo wc_get_checkout_url(); ?>">
            <input type="hidden" name="customer_notes" id="customer_notes" value="<?php echo $product55; ?>">
            <button type="submit" class="checkout-button button alt wc-forward" style="width:100%;"><?php
            esc_html_e( 'Proceed to checkout', 'woocommerce' ) ?></button>
        </form>
        <?php
    }
    
    
    
    
    // Jquery script for cart and checkout pages
    public function customer_notes_jquery() {
        ?>
        <script>
        jQuery(function($) {
            <?php // For cart
            if( is_checkout() && ! is_wc_endpoint_url() ) : ?>
                $('#datepicker2').val("<?php echo sanitize_text_field( $_POST['customer_notes'] ); ?>");
            <?php endif; ?>
        });
        </script>
        <?php
    }
}