<?php  
/**
 * @package WC Buy Now Button
 * 
 * WC Buy Now Button Frontend
 */

// ABSPATH Defined
if(!defined('ABSPATH')){
    exit('not valid');
}


/* ===================================================
    Single Product Page Buy Not Button
=================================================== */
if(get_option('wcbuynow-inppage') == 'true'){

    add_action( 'woocommerce_after_add_to_cart_button', 'wcbuynow_button_redirect_checkout');
    function wcbuynow_button_redirect_checkout() {
        global $product;

        // check if product is simple type
        if($product->is_type('simple')){
        
            $checkout_url = wc_get_checkout_url();
            $product_id = $product->get_id();

            print '<a href="' . $checkout_url . '?add-to-cart=' . $product_id . '" class="button wcbuynow-button">' . get_option('wcbuynow-text') . '</a>';

        }
        
    }

};
    

/* ===================================================
    Shop Page Buy Now Button
=================================================== */
if(get_option('wcbuynow-inshoppage') == 'true'){

    // condition for button up/down
    if(get_option('wcbuynow-spbeforeafter') == 'true'){
        $btnposition = 20;
    }else{
        $btnposition = 10;
    };

    add_action( 'woocommerce_after_shop_loop_item', 'wcbuynow_button_redirect_checkout_shop', $btnposition);
    function wcbuynow_button_redirect_checkout_shop(){
        global $product;

        // check if product is simple type
        if($product->is_type('simple')){

            $checkout_url = wc_get_checkout_url();
            $product_id = $product->get_id();

            print '<a href="' . $checkout_url . '?add-to-cart=' . $product_id . '" class="button wcbuynow-button">' . get_option('wcbuynow-text') . '</a>';

        }
        
    }

};


/* ========================
    Button Style 
======================== */
add_action('wp_head', 'wcbuynow_button_style');
function wcbuynow_button_style(){ 

if(get_option('wcbuynow-btncustomize') == 'true'){ ?>

<!-- Woocommerce Buy Now Button Style -->
<style>
    ul.products li a.wcbuynow-button,
    .summary.entry-summary a.wcbuynow-button{
    <?php if(!empty(get_option('wcbuynow-primaryclr'))) : ?>
    color: <?php print get_option('wcbuynow-primaryclr') ?>;
    <?php endif; ?>
    <?php if(!empty(get_option('wcbuynow-bgclr'))) : ?>
    background-color: <?php print get_option('wcbuynow-bgclr') ?>;
    <?php endif; ?>
    <?php if(!empty(get_option('wcbuynow-btnradius'))) : ?>
    border-radius: <?php print get_option('wcbuynow-btnradius') ?>;
    <?php endif; ?>
    <?php if(!empty(get_option('wcbuynow-btngap'))) : ?>
    margin: <?php print get_option('wcbuynow-btngap') ?> 0;
    <?php endif; ?>
        transition: .4s;
    }
    ul.products li a.wcbuynow-button:hover,
    .summary.entry-summary a.wcbuynow-button:hover{
    <?php if(!empty(get_option('wcbuynow-hoverclr'))) : ?>
    color: <?php print get_option('wcbuynow-hoverclr') ?>;
    <?php endif; ?>
    <?php if(!empty(get_option('wcbuynow-bghoverclr'))) : ?>
    background-color: <?php print get_option('wcbuynow-bghoverclr') ?>;
    <?php endif; ?> 
    }
</style>

<?php
}

}