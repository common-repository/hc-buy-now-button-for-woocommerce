<?php 
/**
 * @package WC Buy Now Button
 * 
 * WC Buy Now Button Plugin Admin Details
 * */

if(!defined('ABSPATH')){
    exit('not valid');
}

/* ========================
    Plugin Admin Details
======================== */

add_action('admin_menu', 'wcbuynow_admin_menu_in_woocommerce');
function wcbuynow_admin_menu_in_woocommerce(){
    add_submenu_page( 'woocommerce', 'WooCommerce Buy Now Button', 'Buy Now Button', 'manage_options', 'wc-buy-now-button', 'wcbuynow_button_callback' );
}

function wcbuynow_button_callback(){ ?>

    <div class="wcbuynow-option">
        <div class="container">
            <!-- Button Details Form -->
            <div class="wcbuynow-form">
                <!-- Title -->
                <div class="wcbuynow-title">
                    <h2 class="title"><?php esc_html_e('Buy Now Button Option', 'wc-buy-now-button'); ?></h2>
                </div> 
                <!-- Tabs -->
                <div class="wcbuynow-tabs">
                    <ul class="tabs-menu">
                        <li><a href="#settings-form"><?php esc_html_e('Settings', 'wc-buy-now-button'); ?></a></li>
                        <li><a href="#style-form"><?php esc_html_e('Button Style', 'wc-buy-now-button'); ?></a></li>
                    </ul>
                    <div id="settings-form">
                        <form action="options.php" method="POST">
                            <?php wp_nonce_field('update-options'); ?>

                            <label for="wcbuynow-text"><?php esc_html_e('Buy Now Button Text', 'wc-buy-now-button'); ?></label>
                            <small><?php esc_html_e('Default: Empty', 'wc-buy-now-button'); ?></small>
                            <input type="text" name="wcbuynow-text" id="wcbuynow-text" placeholder="Buy now button text here" value="<?php print esc_attr(get_option('wcbuynow-text')); ?>">
                            <div style="margin-bottom: 15px;">
                                <p class="label"> <?php esc_html_e('Do you want "Buy Now" Button in single product page?', 'wc-buy-now-button'); ?> </p>
                                <small style="display: block; margin-top: 0; margin-bottom: 8px;"><?php esc_html_e('Default: No', 'wc-buy-now-button'); ?></small>
                                <input type="radio" name="wcbuynow-inppage" id="wcbuynow-ppageyes" value="true" <?php if(get_option('wcbuynow-inppage') == 'true'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-ppageyes" class="wcbuynow-radio"><?php esc_html_e('Yes', 'wc-buy-now-button'); ?></label>
                                <input type="radio" name="wcbuynow-inppage" id="wcbuynow-ppagenot" value="false" <?php if(get_option('wcbuynow-inppage') == 'false'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-ppagenot" class="wcbuynow-radio"><?php esc_html_e('No', 'wc-buy-now-button'); ?></label>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <p class="label"> <?php esc_html_e('Do you want "Buy Now" Button in Shop/Archive Page?', 'wc-buy-now-button'); ?> </p>
                                <small style="display: block; margin-top: 0; margin-bottom: 8px;"><?php esc_html_e('Default: No', 'wc-buy-now-button'); ?></small>
                                <input type="radio" name="wcbuynow-inshoppage" id="wcbuynow-shoppageyes" value="true" <?php if(get_option('wcbuynow-inshoppage') == 'true'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-shoppageyes" class="wcbuynow-radio"><?php esc_html_e('Yes', 'wc-buy-now-button'); ?></label>
                                <input type="radio" name="wcbuynow-inshoppage" id="wcbuynow-shoppagenot" value="false" <?php if(get_option('wcbuynow-inshoppage') == 'false'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-shoppagenot" class="wcbuynow-radio"><?php esc_html_e('No', 'wc-buy-now-button'); ?></label>
                            </div>
                            <div style="margin-bottom: 15px;">
                                <p class="label"> <?php esc_html_e('Buy Now Button Before or After of "Add to Cart" in Shop Page (if yes)', 'wc-buy-now-button'); ?> </p>
                                <small style="display: block; margin-top: 0; margin-bottom: 8px;"><?php esc_html_e('Default: Before', 'wc-buy-now-button'); ?></small>
                                <input type="radio" name="wcbuynow-spbeforeafter" id="wcbuynow-spbeforeafteryes" value="true" <?php if(get_option('wcbuynow-spbeforeafter') == 'true'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-spbeforeafteryes" class="wcbuynow-radio"><?php esc_html_e('After', 'wc-buy-now-button'); ?></label>
                                <input type="radio" name="wcbuynow-spbeforeafter" id="wcbuynow-spbeforeafternot" value="false" <?php if(get_option('wcbuynow-spbeforeafter') == 'false'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-spbeforeafternot" class="wcbuynow-radio"><?php esc_html_e('Before', 'wc-buy-now-button'); ?></label>
                            </div>
                            
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="page_options" value="wcbuynow-text,  wcbuynow-inppage, wcbuynow-inshoppage, wcbuynow-spbeforeafter">
                            <input type="submit" value="Save Changes">
                        </form>
                    </div>
                    <div id="style-form">
                        <form action="options.php" method="POST">
                            <?php wp_nonce_field('update-options'); ?>

                            <div style="margin-bottom: 15px;">
                                <p class="label"> <?php esc_html_e('Do you want to customize "Buy Now" button?', 'wc-buy-now-button'); ?> </p>
                                <small style="display: block; margin-top: 0; margin-bottom: 8px;"><?php esc_html_e('Default: No', 'wc-buy-now-button'); ?></small>
                                <input type="radio" name="wcbuynow-btncustomize" id="wcbuynow-btncustomizeyes" value="true" <?php if(get_option('wcbuynow-btncustomize') == 'true'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-btncustomizeyes" class="wcbuynow-radio wcbuynow-styleshow"><?php esc_html_e('Yes', 'wc-buy-now-button'); ?></label>
                                <input type="radio" name="wcbuynow-btncustomize" id="wcbuynow-btncustomizenot" value="false" <?php if(get_option('wcbuynow-btncustomize') == 'false'){echo esc_attr('checked="checked"');} ?> >
                                <label for="wcbuynow-btncustomizenot" class="wcbuynow-radio wcbuynow-stylehide"><?php esc_html_e('No', 'wc-buy-now-button'); ?></label>
                            </div>
                            <div class="wcbuynow-stylebox">
                                <label for="wcbuynow-btnradius"><?php esc_html_e('Buy Now Button Round', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: 0px', 'wc-buy-now-button'); ?></small>
                                <input type="text" name="wcbuynow-btnradius" id="wcbuynow-btnradius" placeholder="button radius" value="<?php print esc_attr(get_option('wcbuynow-btnradius')); ?>">
                                <label for="wcbuynow-primaryclr"><?php esc_html_e('Button Text Color', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: #000000', 'wc-buy-now-button'); ?></small>
                                <input type="color" name="wcbuynow-primaryclr" id="wcbuynow-primaryclr" value="<?php print esc_attr(get_option('wcbuynow-primaryclr')); ?>">
                                <label for="wcbuynow-bgclr"><?php esc_html_e('Button Background Color', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: #000000', 'wc-buy-now-button'); ?></small>
                                <input type="color" name="wcbuynow-bgclr" id="wcbuynow-bgclr" value="<?php print esc_attr(get_option('wcbuynow-bgclr')); ?>">
                                <label for="wcbuynow-hoverclr"><?php esc_html_e('Button Text Hover Color', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: #000000', 'wc-buy-now-button'); ?></small>
                                <input type="color" name="wcbuynow-hoverclr" id="wcbuynow-hoverclr" value="<?php print esc_attr(get_option('wcbuynow-hoverclr')); ?>">
                                <label for="wcbuynow-bghoverclr"><?php esc_html_e('Button Background Hover Color', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: #000000', 'wc-buy-now-button'); ?></small>
                                <input type="color" name="wcbuynow-bghoverclr" id="wcbuynow-bghoverclr" value="<?php print esc_attr(get_option('wcbuynow-bghoverclr')); ?>">
                                <label for="wcbuynow-btngap"><?php esc_html_e('Shop Page Button Gap Top/Bottom', 'wc-buy-now-button'); ?></label>
                                <small><?php esc_html_e('Default: not set', 'wc-buy-now-button'); ?></small>
                                <input type="text" name="wcbuynow-btngap" id="wcbuynow-btngap" placeholder="Shop page buttons gap" value="<?php print esc_attr(get_option('wcbuynow-btngap')); ?>">
                            </div>
                            
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="page_options" value="wcbuynow-btncustomize, wcbuynow-btnradius, wcbuynow-primaryclr, wcbuynow-bgclr, wcbuynow-hoverclr, wcbuynow-bghoverclr, wcbuynow-btngap">
                            <input type="submit" value="Save Changes">
                        </form>
                    </div>
                </div>
                <!-- WooCommerce Buy Now Script -->
                <script>
                    jQuery(document).ready(function(){
                        // alert text show/hide
                        jQuery('#style-form .wcbuynow-stylebox').hide();
                        jQuery('#style-form label.wcbuynow-styleshow').click(function(){
                            jQuery('#style-form .wcbuynow-stylebox').show();
                        });
                        jQuery('#style-form label.wcbuynow-stylehide').click(function(){
                            jQuery('#style-form .wcbuynow-stylebox').hide();
                        });

                        if(jQuery('#style-form input#wcbuynow-btncustomizeyes').attr('checked')){
                            jQuery('#style-form .wcbuynow-stylebox').show();
                        };
                    });
                </script>
            </div>
            <!-- Author Details -->
            <div class="wcbuynow-author">
                <div class="wcbuynow-title">
                    <h2 class="title"><?php esc_html_e('Author', 'wc-buy-now-button'); ?></h2>
                </div>
                <h4 class="author-name"> <?php esc_html_e('HabibCoder', 'wc-buy-now-button'); ?> </h4>
                <div class="author-description">
                    <p><?php esc_html_e('I\'m ', 'wc-buy-now-button'); ?><a href="<?php echo esc_url('http://habibcoder.com'); ?>" target="_blank"><?php esc_html_e('Habibur Rahman', 'wc-buy-now-button') ?></a> <?php esc_html_e('and a Professional Web Developer and Web Designer. For the last some years, I\'m working in this field with national and international clients. I have done many more projects with client satisfaction.', 'wc-buy-now-button'); ?><br>
                    <?php esc_html_e('This is an open-source WordPress Plugin. If you want to support me, You can', 'wc-buy-now-button'); ?> <b><?php esc_html_e('click on the Buy Me a Coffe Button', 'wc-buy-now-button'); ?></b>. <br> <?php esc_html_e('Thank You !.', 'wc-buy-now-button'); ?> </p>
                </div>
                <div class="donate-btn">
                    <a href="<?php echo esc_url('https://www.buymeacoffee.com/habibcoder1'); ?>" target="_blank">
                    <h4><span>🍦</span><?php esc_html_e('Buy Me A Coffee', 'wc-buy-now-button'); ?></h4>
                    </a>
                </div>
                <h3 class="social-title"> 
                    <?php esc_html_e('Follow Me', 'wc-buy-now-button'); ?>
                </h3>
                <div class="social-icons">
                    <a class="facebook" title="Facebook" href="<?php echo esc_url('http://facebook.com/habibcoder1'); ?>" target="_blank"><img src="<?php echo esc_url(WCBUYNOW_PLUGIN_URL .'img/facebook.png'); ?>" alt="facebook"></a>
                    <a class="linkedin" title="LinkedIn" href="<?php echo esc_url('http://linkedin.com/in/habibcoder'); ?>" target="_blank"><img src="<?php echo esc_url (WCBUYNOW_PLUGIN_URL .'img/linkedin.png'); ?>" alt="LinkedIn"></a>
                    <a class="instagram" title="Instagram" href="<?php echo esc_url('http://instagram.com/habibcoder'); ?>" target="_blank"><img src="<?php echo esc_url(WCBUYNOW_PLUGIN_URL .'img/instagram.png'); ?>" alt="instagram"></a>
                    <a class="website" title="Website" href="<?php echo esc_url('http://habibcoder.com'); ?>" target="_blank"><img src="<?php echo esc_url(WCBUYNOW_PLUGIN_URL .'img/website.png'); ?>" alt="HabibCoder"></a>
                </div>
                <div class="thank-you">
                    <span>♥</span>
                    <h5><?php esc_html_e('Thank You', 'wc-buy-now-button'); ?></h5>
                    <span>♥</span>
                </div>
            </div>
        </div>
    </div>                  

<?php
}