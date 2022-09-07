<?php

/* подключение стилей и скриптов */
add_action( 'wp_enqueue_scripts', 'add_css_and_js' );

function add_css_and_js() {

  wp_enqueue_style( 'open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,800', array(), null );
  wp_enqueue_style( 'playfair-font', 'https://fonts.googleapis.com/css?family=Playfair+Display', array(), null );

  wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/assets/css/vendor/bootstrap.min.css', array(), null );
  wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/assets/css/vendor/font-awesome.css', array(), null );
  wp_enqueue_style( 'dl-icon', get_stylesheet_directory_uri() . '/assets/css/vendor/dl-icon.css', array(), null );
  wp_enqueue_style( 'plugins', get_stylesheet_directory_uri() . '/assets/css/plugins.css', array(), null );
  wp_enqueue_style( 'helper', get_stylesheet_directory_uri() . '/assets/css/helper.min.css', array(), null );
  wp_enqueue_style( 'main', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), time() );

  wp_enqueue_script( 'jquery' );
  wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', 'jquery', null, true );
  wp_enqueue_script( 'plugins', get_stylesheet_directory_uri() . '/assets/js/plugins.js', 'jquery', null, true );
  wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/assets/js/scripts.js', array(), time(), true );

  wp_deregister_style( 'woocommerce-general' );
  wp_deregister_style( 'woocommerce-layout' );

}

/* регистрация меню */
register_nav_menus( array(
  'head_menu' => 'Меню в head',
  'foot_1' => 'Футер 1: Каталог',
  'foot_2' => 'Футер 2: Страницы',
  'foot_3' => 'Футер 3: Товары',
) );


add_theme_support( 'woocommerce' );


add_filter( 'woocommerce_breadcrumb_defaults', function() {

  return array(
    'delimiter' => '',
    'wrap_before' => '<nav class="page-breadcrumb"><ul class="d-flex justify-content-center">',
    'wrap_after' => '</ul></nav>',
    'before' => '<li>',
    'after' => '</li>',
    'home' => 'Главная',
  );

} );


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


add_action( 'wp_footer', function(){

?>

  <!-- <script>
    jQuery( function( $ ) {

      $( '.change_size' ).click(function() {
        var el = $(this),
            name = el.text(),
            val = el.data( 'value' );

        $( '.change_size' ).removeClass( 'active' );
        el.addClass( 'active' );

        $( '#pa_size' ).val( val );
        $( '#pa_size' ).change();

        $( '#configurable-name' ).html( 'Размер: <b>' + name + '</b>' );

      });

      $('.single_variation_wrap').on( 'show_variation', function( event, variation ) {

        $('product_price').html( variation.price_html );
        console.log( variation );
      } );

    } ),
  </script> -->

<?php

} );



/*
 * $num число, от которого будет зависеть форма слова
 * $form_for_1 первая форма слова, например Товар
 * $form_for_2 вторая форма слова - Товара
 * $form_for_5 третья форма множественного числа слова - Товаров
 */
function true_wordform($num, $form_for_1, $form_for_2, $form_for_5){
	$num = abs($num) % 100; // берем число по модулю и сбрасываем сотни (делим на 100, а остаток присваиваем переменной $num)
	$num_x = $num % 10; // сбрасываем десятки и записываем в новую переменную
	if ($num > 10 && $num < 20) // если число принадлежит отрезку [11;19]
		return $form_for_5;
	if ($num_x > 1 && $num_x < 5) // иначе если число оканчивается на 2,3,4
		return $form_for_2;
	if ($num_x == 1) // иначе если оканчивается на 1
		return $form_for_1;
	return $form_for_5;
}



add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {

  $fragments[ '.cart-count' ] = '<span class="cart-count">' . count( WC()->cart->get_cart() ) . '</span>';

  return $fragments;

});


add_filter( 'woocommerce_checkout_fields', function( $checkout_fields ) {

  $checkout_fields[ 'billing' ][ 'billing_first_name' ][ 'placeholder' ] = 'Как вас зовут?';
  //echo '<pre>'; print_r( $checkout_fields ); exit;
  return $checkout_fields;

} );

add_filter( 'woocommerce_order_button_html', function( $html ) {

  return str_replace( 'button alt', 'btn btn-full btn-black mt-26', $html );

});