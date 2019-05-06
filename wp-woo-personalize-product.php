<?php

/*
Plugin Name: WP-Woo-Personalize-Product
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
            <div class="stage-headline active" id="stage-headline-1" data-target="1">
                <div class="circle">1</div>
                <h5>Material</h5>
                <div class="indication" id="indication-kind">OSB</div>
            </div>
            <div class="stage-headline" id="stage-headline-2" data-target="2">
                <div class="circle">2</div>
                <h5>Shape</h5>
                <div class="indication" id="indication-shape">Rectangle</div>
            </div>
            <div class="stage-headline" id="stage-headline-3" data-target="3">
                <div class="circle">3</div>
                <h5>Size</h5>
                <div class="indication" id="indication-size">20/20 cm</div>
            </div>
            <div class="stage-headline" id="stage-headline-4">
                <div class="circle">4</div>
                <h5>Image</h5>
            </div>
            <div class="stage-headline" id="stage-headline-5">
                <div class="circle">5</div>
                <h5>Add to bag</h5>
            </div>
            <div class="clear"></div>
        </div>

        <div class="stages" id="stages" data-position="1">
            <div class="stage" id="stage-1">
                <div class="square">
                    <div class="inner special s-kind" data-kind="osb" data-kind-name="OSB" data-id="13">
                        <div class="images-wrapper">
                            <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/02/osb-e1498717936720.jpg)"></div>
                            <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/01/insta-4-2.jpg)"></div>
                        </div>
                        <div class="details m-t-20">
                            <h5>
                                OSB                    </h5>
                            <div class="example">
                                <i class="fa fa-info-circle"></i>
                                About the material
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
                    <div class="inner special s-kind" data-kind="wood" data-kind-name="Wood" data-id="11">
                        <div class="images-wrapper">
                            <div class="image bg" style="background: url(https://instablock.me/wp-content/uploads/2017/04/wood.jpg)"></div>
                            <div class="image bg back" style="background: url(https://instablock.me/wp-content/uploads/2017/03/wood-deal-3-back.jpg)"></div>
                        </div>
                        <div class="details m-t-20">
                            <h5>
                                Wood                    </h5>
                            <div class="example">
                                <i class="fa fa-info-circle"></i>
                                About the material
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
}
add_action('wp_enqueue_scripts', 'coode_WPP_enqueue_scripts');

register_activation_hook(__FILE__,'coode_WPP_on_activate');
?>
