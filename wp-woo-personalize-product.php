<?php

/*
Plugin Name: WP-Woo-Personalize-Product (En Desarrollo)
Plugin URI:
Description: Plugin de creación de productos personalizados, para ser usado en conjunto con WooCommerce, por parte de posibles clientes.
Version: 1.0
Author: Coodesoft
Author URI: https://www.coodesoft.com.ar
License: GPL v3
*/

function coode_WPP_short_code_tour() {
    return '
<div class="WPP_container">
    <div class="WPP-inner-wrapper">

        <div class="headline">
            <h2>
                <span id="helper-headline-text"> Diseña tu producto </span>

                <div class="back-button" id="helper-back-button">  <i class="fa fa-chevron-left"></i>  Volver </div>
            </h2>
        </div>

        <div class="deal-headline" id="deal-headline">
            <div class="inner">
                <span id="deal-headline-text"> <span id="deal-headline-text-a"></span> <span id="deal-headline-text-b"></span>  </span>
            </div>
        </div>

        <div class="stages-headline m-t-50" id="stages-headline">
            <div class="line first" id="stage-line-1"><div class="inner-line"></div></div>
            <div class="line second" id="stage-line-2"><div class="inner-line"></div></div>
            <div class="line third" id="stage-line-3"><div class="inner-line"></div></div>
            <div class="line fourth" id="stage-line-4"><div class="inner-line"></div></div>

            <div class="stage-headline" id="stage-headline-1" data-target="1">
                <div class="circle">1</div><h5>Material</h5><h5 class="indication" id="indication-kind">OSB</h5>
            </div>

            <div class="stage-headline" id="stage-headline-2" data-target="2">
                <div class="circle">2</div><h5>Forma</h5><h5 class="indication" id="indication-shape">Rectangle</h5>
            </div>

            <div class="stage-headline" id="stage-headline-3" data-target="3">
                <div class="circle">3</div><h5>Tamaño</h5><h5 class="indication" id="indication-size">20/20 cm</h5>
            </div>

            <div class="stage-headline" id="stage-headline-4">
                <div class="circle">4</div><h5>Imagen</h5>
            </div>

            <div class="stage-headline" id="stage-headline-5">
                <div class="circle">5</div><h5>Añadir al carrito</h5>
            </div>

            <div class="clear"></div>
        </div>

        <div class="stages" id="stages" data-position="1">
            <div class="stg down" id="stage-1"> </div>

            <div class="stg down" id="stage-2"> </div>

            <div class="stg down" id="stage-3"></div>

            <div class="stg down" id="stage-4">
                <div class="st5-edit-1">
                  <h5 class="ta-c m-t-20" style="line-height: 1.2"> Bien, ahora suba la imagen que quiere incluir en el producto. </h5>
                  <div class="icons m-t-40">
                      <div class="icon" id="upload-photo">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                          <p>Subir imagen</p>
                      </div>
                    <!--  <div class="icon" id="go-take-photo">
                          <i class="fa fa-camera" aria-hidden="true"></i>
                          <p>Sacar foto</p>
                      </div>-->
                    </div>
                </div>

                  <canvas id="canvas" width="200px" height="200px"></canvas>

            </div>

            <div class="stg down" id="stage-5">
                    <div class="before-checkout" id="before-checkout">
                        <div class="the-details">
                            <div class="center-wrapper">
                                <div class="center">
                                    <h5>
                                         Your Instablock:
                                    </h5>
                                    <p class="m-t-10" style="color: white; display: block; line-height: 1.2; background: transparent; padding: 0; font-size: 14px">
                                        <span id="final-name"></span>
                                    </p>
                                    <p>
                                        $<span id="final-price"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons m-t-20">
                        <div class="helper-buttons-row m-t-20">
                            <div class="quantity" id="helper-quantity">
                                <label>
                                    Quantity:
                                </label>
                                <input type="number" min="0" max="20" value="1" id="helper-quantity-input">
                            </div>
                            <div class="button green" id="special-add-to-cart" onclick="productAdded()">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i>
                                Add to cart
                            </div>
                        </div>
                        <div class="button red small m-t-20" id="start-over">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Start over
                        </div>
                    </div>
                    <div class="added-panel down" id="added-panel">
                        <h5>
                            Great! This Instablock is now in your cart
                        </h5>
                        <div class="buttons">
                            <div class="button red" id="start-over-2">
                                Design another Instablock
                            </div>
                            <div class="button green" id="open-cart">
                                View Cart
                            </div>
                            <!-- <a href="https://instablock.me/checkout">
                                <div class="button green">
                                    Checkout
                                </div>
                            </a> -->
                            <div class="button green" onclick="onCheckout()">
                                Checkout
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>
</div>
<script>
  var WPP_URL = "'.plugins_url('data', __FILE__).'";
</script>
';
}

function coode_WPP_on_activate()
{
    //add_option('mi_opcion',255,'','yes');
}


add_shortcode('coode_WPP_tour', 'coode_WPP_short_code_tour');

function coode_WPP_enqueue_scripts() {
	$file_url = plugins_url('css/WPP_style.css', __FILE__);

	wp_enqueue_style('WPP_style', $file_url );
  wp_enqueue_style( 'load-fa', 'https://use.fontawesome.com/releases/v5.3.1/css/all.css' );

  wp_register_script('coode_WPP_main', plugins_url('js/WPP_main.js', __FILE__));
  wp_register_script('coode_WPP_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
  wp_enqueue_script('coode_WPP_main');
  wp_enqueue_script('coode_WPP_jquery');
}
add_action('wp_enqueue_scripts', 'coode_WPP_enqueue_scripts');

register_activation_hook(__FILE__,'coode_WPP_on_activate');
?>
