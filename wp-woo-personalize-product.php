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

add_action('init', 'handle_WPP_add_to_cart');
function handle_WPP_add_to_cart(){
  $post   = $_POST;
  $salida = [];

  if (count($post) == 0) { return false; }

  $product = new WC_Product();
  $product->set_name(htmlspecialchars($post['material_n']).' '.htmlspecialchars($post['forma_n'])).' '.htmlspecialchars($post['tamanio_n']);
  $product->set_status('publish');
  $product->set_catalog_visibility('visible');
  $product->set_description("Producto personalizado ".htmlspecialchars($post['material_n']).' '.htmlspecialchars($post['forma_n'])).' '.htmlspecialchars($post['tamanio_n']);
  $product->set_price(htmlspecialchars($post['precio']));
  $product->set_manage_stock(true);
  $product->set_stock_quantity(htmlspecialchars($post['cantidad']));
  $product->set_stock_status('instock');
  $product->set_backorders('no');
  $product->set_reviews_allowed(true);
  $product->set_sold_individually(false);

  $productImagesIDs = [];
  $images[]         = $post['imagen'];

  foreach($images as $image){
	   $mediaID = coode_WPP_uploadMedia($image);
	   if($mediaID) $productImagesIDs[] = $mediaID;
  }

  if($productImagesIDs){
  	$product->set_image_id($productImagesIDs[0]); // set the first image as primary image of the product
    //in case we have more than 1 image, then add them to product gallery.
  	if(count($productImagesIDs) > 1){
  		$product->set_gallery_image_ids($productImagesIDs);
  	}
  }

  $salida['product_id'] = $product->save();

  $attributes = [
  	["name"=>"material_name","options"=>[htmlspecialchars($post['material_n'])],"position"=>1,"visible"=>1,"variation"=>1],
  	["name"=>"material_id","options"=>[htmlspecialchars($post['material'])],"position"=>1,"visible"=>1,"variation"=>1],
    ["name"=>"forma_id","options"=>[htmlspecialchars($post['forma'])],"position"=>1,"visible"=>1,"variation"=>1],
    ["name"=>"forma_name","options"=>[htmlspecialchars($post['forma_n'])],"position"=>1,"visible"=>1,"variation"=>1],
    ["name"=>"tamanio_id","options"=>[htmlspecialchars($post['tamanio'])],"position"=>1,"visible"=>1,"variation"=>1],
    ["name"=>"tamanio_n","options"=>[htmlspecialchars($post['tamanio_n'])],"position"=>1,"visible"=>1,"variation"=>1],
    ["name"=>"imagen","options"=>[$post['imagen']],"position"=>1,"visible"=>1,"variation"=>1]
  ];
  if($attributes){
  	$productAttributes=[];
  	foreach($attributes as $attribute){
  		$attr = wc_sanitize_taxonomy_name(stripslashes($attribute["name"])); // remove any unwanted chars and return the valid string for taxonomy name
  		$attr = 'pa_'.$attr; // woocommerce prepend pa_ to each attribute name
  		if($attribute["options"]){
  			foreach($attribute["options"] as $option){
  				wp_set_object_terms($salida['product_id'],$option,$attr,true); // save the possible option value for the attribute which will be used for variation later
  			}
  		}
  		$productAttributes[sanitize_title($attr)] = array(
  			'name' => sanitize_title($attr),
  			'value' => $attribute["options"],
  			'position' => $attribute["position"],
  			'is_visible' => $attribute["visible"],
  			'is_variation' => $attribute["variation"],
  			'is_taxonomy' => '1'
  		);
  	}
  	update_post_meta($salida['product_id'],'_product_attributes',$productAttributes); // save the meta entry for product attributes
  }

  echo json_encode($salida);
  die();
}

function coode_WPP_uploadMedia($image_url){
	require_once('wp-admin/includes/image.php');
	require_once('wp-admin/includes/file.php');
	require_once('wp-admin/includes/media.php');
  $image_url = preg_replace( '/data:image\/.*;base64,/', '', $image_url );
  $output_file = getcwd().'/wp-content/uploads/'.round(microtime(true) * 1000).'personalizado.png';
  file_put_contents( $output_file, base64_decode( $image_url ) );

	$media = media_sideload_image($image_url,0);
	$attachments = get_posts(array(
		'post_type' => 'attachment',
		'post_status' => null,
		'post_parent' => 0,
		'orderby' => 'post_date',
		'order' => 'DESC'
	));
	return $attachments[0]->ID;
}

function coode_WPP_short_code_tour() {
    return '
<div class="WPP_container">
    <div class="WPP_pop_up_wrapper">
      <div class="WPP_editor_inf_wr">
        <h5><b>Instrucciones</b></h5>
        <p>Use el mouse para arrastrar la imagen seleccionada</p>
        <p>Puede cambiar el tamaño de la imagen con los cuadros de los extremos de la selección</p>
        <p>Puede girar la imagen con el cuadro superior de la selección de la imagen</p>
        <p>Si pierde la selección, puede volver a visualizarla haciendo click sobre la imagen</p>
      </div>
      <div class="WPP_editor_wrapper">
        <div>
          <canvas id="canvas" width="300px" height="300px"></canvas>
        </div>
        <div class="closer-edit"><div id="edit-closer" class="closer"></div></div>
        <div class="WPP_editor_btn">
          <div class="upload-photo">Reemplazar imagen</div>
          <div class="go-to-cart">Bien, estoy satisfecho</div>
        </div>
      </div>
    </div>
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
                      <div class="icon upload-photo">
                          <i class="fa fa-upload" aria-hidden="true"></i>
                          <p>Subir imagen</p>
                      </div>
                    <!--  <div class="icon" id="go-take-photo">
                          <i class="fa fa-camera" aria-hidden="true"></i>
                          <p>Sacar foto</p>
                      </div>-->
                    </div>
                </div>
                <input type="file" id="file-reader" />
            </div>

            <div class="stg down" id="stage-5">
                    <div class="before-checkout" id="before-checkout">
                        <div class="the-details">
                            <div class="center-wrapper">
                                <div class="center">
                                    <h5>Su producto:</h5>
                                    <p class="m-t-10" style="color: white; display: block; line-height: 1.2; background: transparent; padding: 0; font-size: 14px">
                                        <span id="final-name"></span>
                                    </p>
                                    <p>
                                        $<span id="final-price"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="final-image">
                          <img id="WPP-img-final" src="" alt="">
                          <div class="overlay">
                            <div class="center-wrapper ta-c">
                              <div class="center"><i class="fa fa-search-plus final-image-magnifier"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="buttons m-t-20">
                        <div class="helper-buttons-row m-t-20">
                            <div class="quantity" id="helper-quantity">
                                <label>Cantidad: </label>
                                <input type="number" min="0" max="20" value="1" id="helper-quantity-input">
                            </div>
                            <div class="button green" id="special-add-to-cart">
                                <i class="fa fa-cart-plus" aria-hidden="true"></i> Agregar al carrito
                            </div>
                        </div>
                        <div class="button red small m-t-20" id="start-over">
                            <i class="fa fa-undo" aria-hidden="true"></i>
                            Empezar de nuevo
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
  var WPP_URL      = "'.plugins_url('data', __FILE__).'";
  var WPP_POST_URL = "'.admin_url('wppaddtocart').'";
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
