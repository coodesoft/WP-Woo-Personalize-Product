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
                <span id="helper-headline-text">
                    Diseña tu producto
                </span>
                <div class="back-button" id="helper-back-button">
                    <i class="fa fa-chevron-left"></i>
                    Volver
                </div>
            </h2>
        </div>

        <div class="deal-headline" id="deal-headline">
            <div class="inner">
                <span id="deal-headline-text">
                    <span id="deal-headline-text-a"></span>
                    <span id="deal-headline-text-b"></span>
                </span>
            </div>
        </div>

        <div class="stages-headline m-t-50" id="stages-headline">
            <div class="line first" id="stage-line-1"><div class="inner-line"></div></div>
            <div class="line second" id="stage-line-2"><div class="inner-line"></div></div>
            <div class="line third" id="stage-line-3"><div class="inner-line"></div></div>
            <div class="line fourth" id="stage-line-4"><div class="inner-line"></div></div>
            <div class="stage-headline" id="stage-headline-1" data-target="1">
                <div class="circle">1</div>
                <h5>Material</h5>
                <div class="indication" id="indication-kind">OSB</div>
            </div>
            <div class="stage-headline" id="stage-headline-2" data-target="2">
                <div class="circle">2</div>
                <h5>Forma</h5>
                <div class="indication" id="indication-shape">Rectangle</div>
            </div>
            <div class="stage-headline" id="stage-headline-3" data-target="3">
                <div class="circle">3</div>
                <h5>Tamaño</h5>
                <div class="indication" id="indication-size">20/20 cm</div>
            </div>
            <div class="stage-headline" id="stage-headline-4">
                <div class="circle">4</div>
                <h5>Imagen</h5>
            </div>
            <div class="stage-headline" id="stage-headline-5">
                <div class="circle">5</div>
                <h5>Añadir al carrito</h5>
            </div>
            <div class="clear"></div>
        </div>

        <div class="stages" id="stages" data-position="1">
            <div class="stg down" id="stage-1">
                <div class="square">
                    <div class="inner">
                        <div class="images-wrapper mat-btn" data-kind="osb" data-kind-name="OSB" data-id="13">
                            <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/02/osb-e1498717936720.jpg)"></div>
                            <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/01/insta-4-2.jpg)"></div>
                        </div>
                        <div class="details m-t-20">
                            <h5>OSB</h5>
                            <div class="wpp-info-mat">
                                <i class="fa fa-info-circle"></i>Sobre el material
                            </div>
                            <div class="text-tip">
                                <div class="inner-w">
                                    <ul>
                                        <li>The OSB Block is industrially processed, durable and strong, made of wood chips and resin.&nbsp; Each piece is different in shading and in the shape of the wood chips</li>
                                        <li>The wood’s natural markings and holes may be visible through the photo</li>
                                        <li>The colors of the photo may be affected by the wood’s pigments</li>
                                        <li>it is not recommended to add a handwritten note on the photo.&nbsp; OSB has a grainy texture that can distort images with fine details</li>
                                        <li>Suitable for sharp, clear images only – images may be sharpened and highlighted before printing</li>
                                        <li>Our recommendation when printing on OSB Instablocks is to use an image with a large surface area, without small or fine details</li>
                                        <li>A photo that looks good to you, will look beautiful on your Instablock</li>
                                        <li>Frames around images are not suitable for Instablock and will be removed</li>
                                        <li>You can upload images with text.&nbsp; The text should be centered and kept away from the image edges</li>
                                        <li>Our recommendation: Add a personalized handwritten dedication on the back of the packaging</li>
                                        <li>Unfortunately we are unable to print collage photos on this material</li>
                                    </ul>
                                    <div class="closer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="square">
                    <div class="inner">
                        <div class="images-wrapper mat-btn" data-kind="wood" data-kind-name="Wood" data-id="11">
                            <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/04/wood.jpg)"></div>
                            <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/03/wood-deal-3-back.jpg)"></div>
                        </div>
                        <div class="details m-t-20">
                            <h5>
                                Wood                    </h5>
                            <div class="wpp-info-mat">
                                <i class="fa fa-info-circle"></i>
                                Sobre el material
                            </div>
                            <div class="text-tip">
                                <div class="inner-w">
                                    <ul>
                                        <li>Print on natural solid pine, where each photo is unique with its own shade of color and shapes of wood grain</li>
                                        <li>The transparency of the wood through the image depends on the image and its colors.&nbsp; Wood grain may be visible on the image</li>
                                        <li>The colors of the image may change due to the wood pigmentation</li>
                                        <li>The block of wood may contain cracks, wood knots, depressions and holes. These are part of the beauty of solid wood</li>
                                        <li>A photo that looks good to you, will look beautiful on your Instablock</li>
                                        <li>Frames around images are not suitable for Instablock and will be removed</li>
                                        <li>You can upload images with text.&nbsp; The text should be centered and kept away from the image edges</li>
                                        <li>Our recommendation: Add a personalized handwritten dedication on the back of the packaging</li>
                                        <li>You may upload a photo collage.&nbsp; Keep important details away from the edges</li>
                                    </ul>
                                    <div class="closer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>
            </div>

            <div class="stg down" id="stage-2">
              <div id="stage-2-inner">

                  <div class="square">
                      <div class="inner s-shape" data-shape="circle" data-shape-name="Circle" data-id="17">
                          <div class="images-wrapper">
                            <div class="form-circle wpp-form-btn"></div>
                          </div>
                          <div class="details m-t-20">
                              <h5>Circulo</h5>
                          </div>
                      </div>
                  </div>

                  <div class="square">
                      <div class="inner s-shape" data-shape="rectangle" data-shape-name="Rectangle" data-id="37">
                          <div class="images-wrapper">
                              <div class="form-rectangle wpp-form-btn"></div>
                                          </div>
                          <div class="details m-t-20">
                              <h5>Rectángulo</h5>
                          </div>
                      </div>
                  </div>

                  <div class="square">
                      <div class="inner s-shape" data-shape="square" data-shape-name="Square" data-id="36">
                          <div class="images-wrapper">
                              <div class="form-square wpp-form-btn"></div>
                                          </div>
                          <div class="details m-t-20">
                              <h5>Cuadrado</h5>
                          </div>
                      </div>
                  </div>

                </div>
                <div class="clear"></div>
            </div>

            <div class="stg down" id="stage-3">
                <div id="stage-3-inner">
                    <div class="square">
                        <div class="inner s-size" data-size="25-30" data-id="145" data-name="OXXL" data-size-name="10/12" data-price="54.99">
                            <div class="images-wrapper">

                                <div class="form-rectangle wpp-size-btn" style="width: 100px; margin-left: -50px; height: 120px; margin-top: -60px;"></div>
                                </div>
                            <div class="details">
                                <h5>
                                    Size:
                                    10/12                        <span>
                                        inch
                                    </span>
                                </h5>
                                <h5 class="m-t-5">
                                    Price:
                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>109.99</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>54.99</span></ins>                    </h5>
                                                        <h6 class="m-t-10">
                                        ---
                                    </h6>
                                                    <div class="example">
                                    <i class="fa fa-eye"></i>
                                    Example
                                    <div class="image-tip">
                                        <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/02/OXXL.jpg)"></div>
                                        <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/02/OXXL2.jpg)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="square">
                        <div class="inner s-size" data-size="14-21" data-id="140" data-name="ON" data-size-name="5.5/8.25" data-price="34.99">
                            <div class="images-wrapper">

                                    <div class="form-rectangle wpp-size-btn" style="width: 56px; margin-left: -28px; height: 84px; margin-top: -42px;"></div>
                                        </div>
                            <div class="details">
                                <h5>
                                    Size:
                                    5.5/8.25                        <span>
                                        inch
                                    </span>
                                </h5>
                                <h5 class="m-t-5">
                                    Price:
                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>69.99</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>34.99</span></ins>                    </h5>
                                                        <h6 class="green m-t-10">
                                                                                                                2 for $59.99<br>
                                                                                                </h6>
                                                    <div class="example">
                                    <i class="fa fa-eye"></i>
                                    Example
                                    <div class="image-tip">
                                        <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/02/ON.jpeg)"></div>
                                        <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/02/ON2.jpeg)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="square">
                        <div class="inner s-size" data-size="9-14" data-id="135" data-name="OS" data-size-name="3.5/5.25" data-price="19.99">
                            <div class="images-wrapper">
                                    <div class="form-rectangle wpp-size-btn" style="width: 36px; margin-left: -18px; height: 56px; margin-top: -28px;"></div>
                                        </div>
                            <div class="details">
                                <h5>
                                    Size:
                                    3.5/5.25                        <span>
                                        inch
                                    </span>
                                </h5>
                                <h5 class="m-t-5">
                                    Price:
                                    <del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>39.99</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>19.99</span></ins>                    </h5>
                                                        <h6 class="green m-t-10">
                                                                                                                3 for $54.99<br>
                                                                                                </h6>
                                                    <div class="example">
                                    <i class="fa fa-eye"></i>
                                    Example
                                    <div class="image-tip">
                                        <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/02/OS.jpg)"></div>
                                        <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/02/OS2-2.jpg)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="clear"></div>
            </div>

            <div class="stg down" id="stage-4">
                <h5 class="ta-c m-t-20" style="line-height: 1.2"> Great. This is where the fun starts. <br> Please choose an awesome image and upload it to the system. </h5>
                <div class="icons m-t-40">
                    <div class="icon" id="upload-photo">
                        <i class="fa fa-upload" aria-hidden="true"></i>
                        <p>Subir imagen</p>
                    </div>
                    <div class="icon" id="go-take-photo">
                        <i class="fa fa-camera" aria-hidden="true"></i>
                        <p>Sacar foto</p>
                    </div>
                </div>
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
  wp_enqueue_script('coode_WPP_main');
}
add_action('wp_enqueue_scripts', 'coode_WPP_enqueue_scripts');

register_activation_hook(__FILE__,'coode_WPP_on_activate');
?>
