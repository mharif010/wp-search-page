<?php
get_header(vibe_get_header());
global $wp_query;
$total_results = $wp_query->found_posts;
?>

<section class="mha_search_hero">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="mha_search_header">
                    <h2><?php _e('Courses related to "', 'vibe');
                        the_search_query(); ?>"</h2>
                    <h5><?php echo __(' Your search yielded about ', 'vibe') . vibe_sanitizer($total_results) . __(' results. Scroll down to see the results.', 'vibe');  ?></h5>
                    <div class="mha_search_form">
                        <?php
                        bp_directory_course_search_form();
                        ?>
                    </div>
                    <div class="mha_search_tag">
                        <a href="https://www.janets.org.uk/prime">Lifetime Subscription</a>
                        <a href="https://www.janets.org.uk/subscription-offer/">Yearly Subscription</a>
                        <a href="https://www.janets.org.uk/exclusive-discount/">Hot Deal</a>
                        <a href="https://www.janets.org.uk/for-business-new/">Team Training</a>
                    </div>
                    <div class="mha_search_topics">
                        <h4>Courses by Popular topics</h4>
                        <div class="mha_search_slider">
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=beauty">Beauty</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=digital marketing">Digital marketing</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=excel">Excel</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=project+management">Project management</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=spanish">Spanish</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=counselling">Counselling</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=health+and+social+care">Health and social care</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=copywriting">Copywriting</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=english">English</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=mental+health">Mental health</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=law">Law</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=psychology">Psychology</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=hr">hr</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=bsl">Bsl</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=teaching">Teaching</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=photography">Photography</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=teaching+assistant">Teaching assistant</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=massage">Massage</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=first+aid">First aid</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=python">Python</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=nutrition">Nutrition</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=business">Business</a>
                            </div>
                            <div class="msg">
                                <a href="https://www.janets.org.uk/?post_type=course&s=accounting">Accounting</a><br>
                                <a href="https://www.janets.org.uk/?post_type=course&s=management">Management</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="xxcontent" class="mha_seach_content">
    <div class="<?php echo vibe_get_container(); ?>">
        <div class="row">
            <div class="col-md-5 col-sm-5">
                <p class="return_result">Your search returned about <?php echo  vibe_sanitizer($total_results); ?> results</p>
            </div>
            <div class="col-md-7 col-sm-7">
                <div class="mha_search_shorting">
                    <div class="mha_search_sorting">
                        <h5>Sort by</h5>
                        <select id="course-order-by">
                            <option value="none"><?php _e('Select Order', 'vibe'); ?></option>
                            <option value="date"><?php _e('Newly Published', 'vibe'); ?></option>
                            <option value="title"><?php _e('Alphabetical', 'vibe'); ?></option>
                            <option value="popular"><?php _e('Most Popular', 'vibe'); ?></option>
                            <option value="rated"><?php _e('Highest Rated', 'vibe'); ?></option>
                        </select>
                    </div>
                    <div class="mha_toggle">
                        Toggle View
                        <a href="#"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/view_list.png" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <h2 class="mha_search_sidebar">Course Categories</h2>
                <div class="mha_search_category">
                    <ul id="nav">
                        <?php
                        $categories = get_terms(array(
                            'taxonomy' => 'course-cat',
                            'hide_empty' => false,
                            'number' => 10
                        ));
                        foreach ($categories as $cat) : ?>

                            <li class="js-filter-item"><img src="https://www.janets.org.uk/wp-content/uploads/2023/02/quiz.png" /><a class="<?php echo $_REQUEST['category']; ?>" data-category="<?= $cat->term_id; ?>" href="<?= get_category_link($cat->term_id); ?>"><?= $cat->name; ?></a></li>

                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="col-md-9 col-sm-9">
                <div id="loader"></div>
                <div class="overlap"></div>
                <div class="search_results row">

                    <?php
                    if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <div class="col-md-4 col-sm-6">
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
                    <?php
                        endwhile;
                    else :
                        echo '<h3>' . __('Sorry, No results found.', 'vibe') . '</h3>';
                    endif;

                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </div>





    </div>
</section>

<section class="mha_search_pagination">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mha_search_pag">
                <?php pagination(); ?>
            </div>
        </div>
    </div>
</section>

<section class="mha_search_related">
    <div class="container">
        <div class="row">
            <h2 class="mha_search_relTitle">On demand courses</h2>
        </div>
        <?php
        global $post;
        $pid = $post->ID;
        $category_term = get_the_terms($pid, 'course-cat');
        $terms_list =  wp_list_pluck($category_term, 'slug');

        $related_args = array(
            'post_type' => 'course',
            'posts_per_page' => 10,
            'post_status' => 'publish',
            'post__not_in'      => array($pid),
            'orderby'   => 'meta_value_num',
            'order' => 'DESC',
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'course-cat',
                    'field' => 'slug',
                    'terms' => $terms_list
                )
            ),
            'meta_query' => array(
                array(
                    'key'     => 'vibe_students',
                ),
            )
        );

        $related = new WP_Query($related_args);

        if ($related->have_posts()) {
            echo '<div class="row mha_searchRelated">';
            while ($related->have_posts()) : $related->the_post(); ?>
                <div class="col-md-4">
                    <div class="mha_search_boxGrid">
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

            <?php
            endwhile; ?>
            <div class="col-md-4">
                <div class="mha_search_boxGrid">
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
            <div class="col-md-4">
                <div class="mha_search_boxGrid">
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
        <?php
            echo '</div>';
            wp_reset_query();
        } ?>

    </div>
</section>

<?php
get_footer(vibe_get_footer());
?>