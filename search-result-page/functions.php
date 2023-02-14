<?php

add_action('wp_enqueue_scripts', 'wplms_child_enqueue_styles');

function wplms_child_enqueue_styles()
{
    wp_enqueue_style('dash-style', get_stylesheet_directory_uri() . '/assets/css/style.css', array(), true);
    wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/assets/css/slick.css', array(), true);
    wp_enqueue_style('slick-theme-style', get_stylesheet_directory_uri() . '/assets/css/slick-theme.css', array(), true);
    wp_enqueue_script('slick-min-srcipt', get_stylesheet_directory_uri() . '/assets/js/slick.min.js', array('jquery'), NULL, true);
}

add_action('wp_ajax_nopriv_sortingOnclick_janets', 'sorting_onclick_janets');
add_action('wp_ajax_sortingOnclick_janets', 'sorting_onclick_janets');

function sorting_onclick_janets()
{

    $mha      = $_REQUEST['customData'];
    $mhaCat      = $_REQUEST['catID'] ? $_REQUEST['catID'] : '';

    if ($mha == 'popular') {
        $args = array(
            'post_type'       => array('course'),
            'orderby'   => 'meta_value_num',
            'meta_query' => array(
                array(
                    'key'     => 'vibe_students',
                ),
            ),
            'order' => 'DESC',
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
    } elseif ($mha == 'rated') {

        $args = array(
            'post_type'       => array('course'),
            'orderby'   => 'meta_value_num',
            'meta_query' => array(
                array(
                    'key'     => 'average_rating',
                ),
            ),
            'order' => 'DESC',
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
    } else {
        $args = array(
            'post_type'       => array('course'),
            'orderby' => $mha,
            'order' => 'ASC',
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
        );
    }
    if ($mhaCat != '') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'course-cat',
                'field' => 'term_id',
                'terms' => $mhaCat
            )
        );
    }

    $query = new WP_Query($args);

    while ($query->have_posts()) : $query->the_post();
?>

        <div class="col-md-4">
            <div class="mha_search_boxGrid mha_search_boxList">
                <div class="s_header">
                    <h3 class="mha_stats"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/bookmarks.png">On Demand course</h3>
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } else {
                            echo '<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/dummy_330x150_ffffff_cccccc.png" alt="alt image" />';
                        }
                        ?>
                    </a>
                </div>
                <div class="s_content">
                    <a class="mha_courseTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <div class="mha_courseStd">
                        <img src="https://www.janets.org.uk/wp-content/uploads/2023/02/groups_2.png" alt="">
                        <span><?php echo get_post_meta(get_the_ID(), 'vibe_students', true); ?> Enrolled Students</span>
                    </div>
                    <div class="mha_courseRating">
                        <?php $average_rating = get_post_meta(get_the_ID(), 'average_rating', true); ?>
                        <div class="mha_rating_content">
                            <div class="mha_rating">
                                <div class="mha_rating-upper" style="width:<?php echo $average_rating ? 20 * $average_rating : 0; ?>%">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                </div>

                            </div>
                        </div>
                        <span>(<?php
                                if (!empty($average_rating)) {
                                    echo $average_rating;
                                } else {
                                    echo '0';
                                }
                                ?> reviews)</span>
                    </div>
                    <div class="mha_units"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/article-1.png" />
                        <?php
                        $units = bp_course_get_curriculum_units(get_the_ID());

                        if (count($units) == 0) {
                            echo '0';
                        } else {
                            echo count($units);
                        }

                        ?>
                        Units </div>
                    <div class="mha_price">
                        <?php
                        $product_ID = get_post_meta(get_the_ID(), 'vibe_product', true);

                        // echo '<pre>';
                        // var_dump($product_ID);
                        // echo '</pre>';

                        $regular_price = get_post_meta($product_ID, '_regular_price', true);
                        $sale_price = get_post_meta($product_ID, '_sale_price', true);
                        $current_currency = get_woocommerce_currency_symbol();


                        if (!empty($product_ID)) {
                            if ($sale_price !== "") {
                                $m_price = '<del>' . $current_currency . $regular_price . '</del>' . ' ' . $current_currency . '<span>' . $sale_price . '</span>';
                            } elseif ($regular_price !== "") {
                                $m_price = $current_currency . '<span>' . $regular_price . '</span>';
                            } else {
                                $m_price = '';
                            }
                            echo $m_price;
                        } else {
                            echo "Free";
                        }

                        ?>
                    </div>
                    <a class="mha_search_cView" href="<?php the_permalink(); ?>">View Course</a>
                </div>
            </div>
        </div>

    <?php endwhile;

    wp_reset_postdata();
    wp_die();
}

add_action('wp_ajax_nopriv_sortingCat_janets', 'sorting_cat_janets');
add_action('wp_ajax_sortingCat_janets', 'sorting_cat_janets');

function sorting_cat_janets()
{
    $category = $_REQUEST['category'];
    $args = array(
        'post_type'       => array('course'),
        'order' => 'ASC',
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );

    if (isset($category)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'course-cat',
                'field' => 'term_id',
                'terms' => $category
            )
        );
    }
    $query = new WP_Query($args);
    while ($query->have_posts()) : $query->the_post();
    ?>
        <div class="col-md-4">
            <div class="mha_search_boxGrid mha_search_boxList">
                <div class="s_header">
                    <h3 class="mha_stats"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/bookmarks.png">On Demand course</h3>
                    <a href="<?php the_permalink(); ?>">
                        <?php
                        if (has_post_thumbnail()) {
                            the_post_thumbnail();
                        } else {
                            echo '<img src="https://www.janets.org.uk/wp-content/uploads/2023/02/dummy_330x150_ffffff_cccccc.png" alt="alt image" />';
                        }
                        ?>
                    </a>
                </div>
                <div class="s_content">
                    <a class="mha_courseTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <div class="mha_courseStd">
                        <img src="https://www.janets.org.uk/wp-content/uploads/2023/02/groups_2.png" alt="">
                        <span><?php echo get_post_meta(get_the_ID(), 'vibe_students', true); ?> Enrolled Students</span>
                    </div>
                    <div class="mha_courseRating">
                        <?php $average_rating = get_post_meta(get_the_ID(), 'average_rating', true); ?>
                        <div class="mha_rating_content">
                            <div class="mha_rating">
                                <div class="mha_rating-upper" style="width:<?php echo $average_rating ? 20 * $average_rating : 0; ?>%">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                </div>

                            </div>
                        </div>
                        <span>(<?php
                                if (!empty($average_rating)) {
                                    echo $average_rating;
                                } else {
                                    echo '0';
                                }
                                ?> reviews)</span>
                    </div>
                    <div class="mha_units"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/article-1.png" />
                        <?php
                        $units = bp_course_get_curriculum_units(get_the_ID());

                        if (count($units) == 0) {
                            echo '0';
                        } else {
                            echo count($units);
                        }

                        ?>
                        Units </div>
                    <div class="mha_price">
                        <?php
                        $product_ID = get_post_meta(get_the_ID(), 'vibe_product', true);

                        // echo '<pre>';
                        // var_dump($product_ID);
                        // echo '</pre>';

                        $regular_price = get_post_meta($product_ID, '_regular_price', true);
                        $sale_price = get_post_meta($product_ID, '_sale_price', true);
                        $current_currency = get_woocommerce_currency_symbol();


                        if (!empty($product_ID)) {
                            if ($sale_price !== "") {
                                $m_price = '<del>' . $current_currency . $regular_price . '</del>' . ' ' . $current_currency . '<span>' . $sale_price . '</span>';
                            } elseif ($regular_price !== "") {
                                $m_price = $current_currency . '<span>' . $regular_price . '</span>';
                            } else {
                                $m_price = '';
                            }
                            echo $m_price;
                        } else {
                            echo "Free";
                        }

                        ?>
                    </div>
                    <a class="mha_search_cView" href="<?php the_permalink(); ?>">View Course</a>
                </div>
            </div>
        </div>
    <?php endwhile;

    wp_reset_postdata();
    wp_die();
}


function my_scripts_method()
{ ?>

    <script>
        // this script for janets search 
        (function($) {
            $(document).ready(function() {
                $('.mha_search_slider').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 667,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        })(jQuery);

        (function($) {
            $(document).ready(function() {
                $('.mha_searchRelated').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 667,
                            settings: {
                                arrows: true,
                                centerMode: true,
                                centerPadding: '10px',
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
        })(jQuery);

        (function($) {
            $(document).ready(function() {
                $('#course_search_submit').before('<i class="fa fa-search"></i>');
                $('#course_search_submit').val('');

                $('.mha_searchRelated .slick-prev').text('PREV');
                $('.mha_searchRelated .slick-next').text('NEXT');

                $(".mha_toggle a").click(function(e) {
                    e.preventDefault();
                    $(".search_results > div").toggleClass("col-listview");
                });

            });
        })(jQuery);


        (function($) {
            let category = '';
            $(document).ready(function() {
                $(document).on('click', '.js-filter-item > a', function(e) {
                    $("#loader, .overlap").show();
                    e.preventDefault();

                    category = $(this).data('category');

                    var actClass = $(this).parent("li");

                    $.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        data: {
                            action: 'sortingCat_janets',
                            category: category
                        },
                        type: 'get',
                        success: function(result) {
                            $("#loader, .overlap").hide();
                            $('.search_results').html(result);
                            $('#nav li').removeClass('active');
                            actClass.addClass('active');
                        },
                        error: function(result) {
                            console.warn(result);
                        }
                    });
                });
            });




            $(document).ready(function() {
                $(document).on('change', '#course-order-by', function(e) {
                    $("#loader, .overlap").show();
                    e.preventDefault();

                    var selectVal = $(this).val();


                    //console.log(category);
                    $.ajax({
                        url: "<?php echo admin_url('admin-ajax.php'); ?>",
                        data: {
                            action: 'sortingOnclick_janets',
                            customData: selectVal,
                            catID: category
                        },
                        type: 'get',
                        success: function(result) {
                            $("#loader, .overlap").hide();
                            $('.search_results').html(result);
                        },
                        error: function(result) {
                            console.warn(result);
                        }
                    });
                });
            });

        })(jQuery);
    </script>




<?php }

add_action('wp_footer', 'my_scripts_method');

//this search specific only course
function search_only_specific_post_type($query)
{
    if ($query->is_search) {
        $query->set('post_type', 'course');
    }
    return $query;
}
add_filter('pre_get_posts', 'search_only_specific_post_type');
