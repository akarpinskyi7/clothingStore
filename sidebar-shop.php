<!-- Start Sidebar Area Wrapper -->
<div class="col-lg-3 order-last order-lg-first mt-md-54 mt-sm-44">
    <div class="sidebar-area-wrapper">

        <?php $product_categories = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true ) ); ?>
        
            <?php if( $product_categories ) : ?>
            <!-- Start Single Sidebar -->
                <div class="single-sidebar-wrap">
                    <h3 class="sidebar-title">Категории товаров</h3>
                    <div class="sidebar-body">
                        <ul class="sidebar-list">
                            <?php foreach( $product_categories as $product_category ) : ?>
                                <li><a href="<?php echo get_term_link( $product_category ) ?>"><? echo $product_category->name ?> <span>(<?php echo $product_category->count ?>)</span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- End Single Sidebar -->
            <?php endif; ?>



        <?php $product_colors = get_terms( array( 'taxonomy' => 'pa_color', 'hide_empty' => true ) ); ?>

            <?php if( $product_colors ) : ?>
                <!-- Start Single Sidebar -->
                <div class="single-sidebar-wrap">
                    <h3 class="sidebar-title">Цвет</h3>
                    <div class="sidebar-body">
                        <ul class="sidebar-list">
                            <?php foreach( $product_colors as $product_color ) : ?>
                                <li><a href="?filter_color=<?php echo $product_color->slug ?>"><?php echo $product_color->name ?> <span>(<?php echo $product_color->count ?>)</span></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- End Single Sidebar -->
            <?php endif; ?>

                <!-- Start Single Sidebar -->
                <div class="single-sidebar-wrap">
                    <h3 class="sidebar-title">Цена</h3>
                    <div class="sidebar-body">
                        <div class="price-range-wrap">
                            <div class="price-range" data-min="10" data-max="100"></div>
                            <div class="range-slider">
                                <form action="" id="price_filter" method="GET">
                                    <label for="amount">Цена: </label>
                                    <input type="text" id="amount" value="" />
                                    <input type="hidden" id="min_price" name="min_price" value="<?php echo isset( $_GET[ 'min_price' ] ) ? intval( $_GET[ 'min_price' ] ) : 10 ?>" />
                                    <input type="hidden" id="max_price" name="max_price" value="<?php echo isset( $_GET[ 'max_price' ] ) ? intval( $_GET[ 'max_price' ] ) : 100 ?>" />
                                    <?php echo wc_query_string_form_fields( null, array( 'min_price', 'max_price', 'paged' ), '', true ); ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Single Sidebar -->

        <?php $product_attributes = get_terms( array( 'taxonomy' => 'pa_size', 'hide_empty' => true ) ); ?>

            <?php if( $product_attributes ) : 
                
                $shop_page_url = get_permalink( wc_get_page_id( 'shop' ) );
                if( !empty( $_GET[ 'min_price' ] ) ) {
                    $shop_page_url = add_query_arg( 'min_price', $_GET[ 'min_price' ], $shop_page_url );
                }

                if( !empty( $_GET[ 'max_price' ] ) ) {
                    $shop_page_url = add_query_arg( 'max_price', $_GET[ 'max_price' ], $shop_page_url );
                }
                
            ?>
                <!-- Start Single Sidebar -->
                <div class="single-sidebar-wrap">
                    <h3 class="sidebar-title">Размер</h3>
                    <div class="sidebar-body">
                        <ul class="size-list">
                            <?php foreach( $product_attributes as $product_attribut ) : ?>
                                <li><a href="<?php echo add_query_arg( 'filter_size', $product_attribut->slug, $shop_page_url ) ?>" <?php if( isset( $_GET[ 'filter_size' ] ) && $product_attribut->slug == $_GET[ 'filter_size' ] ) : ?>class="active"<?php endif; ?>><?php echo $product_attribut->name ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <!-- End Single Sidebar -->
            <?php endif; ?>

    </div>
</div>
<!-- End Sidebar Area Wrapper -->