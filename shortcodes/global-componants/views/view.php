<?php
/**
 * Variables
 */
//Unique id for slider
global $wpdb;
$resourcesID = uniqid('base_shortcode_resources_');

// Configurations
$_resource_types = $atts['resource_types'];
$_show_featured = (bool)$atts['show_featured'];
$_show_default_featured = (bool)$atts['show_default_featured'];
$_show_filters = (bool)$atts['show_filters'];
$_filter_entries = $atts['filter_entries'];
$_load_more_text = $atts['load_more_text'];
$_posts_number_per_page = $atts['posts_number_per_page'];
$_posts_number_per_row = $atts['posts_number_per_row'];
$_posts_number_per_row_tab = $atts['posts_number_per_row_tab'];
$_posts_number_per_row_mobile = $atts['posts_number_per_row_mobile'];
$_order_by = $atts['order_by'];
$_order = $atts['order'];
$_show_category_label = $atts['show_category_label'];
$_layout_type = $atts['layout']['layout_choice'];


$_show_date = fw_akg('show_date/show_date_choice', $atts);
$_date_position = fw_akg('show_date/true/date_position', $atts);
$_date_format = 'd F Y';
if ($_show_date == 'true') {
    $_date_format = (!empty(fw_akg('show_date/true/date_format', $atts))) ? fw_akg('show_date/true/date_format', $atts) : 'd F Y';
}

$_col_mob = 12 / $_posts_number_per_row_mobile;
$_col_tab = 12 / $_posts_number_per_row_tab;
$_col_des = 12 / $_posts_number_per_row;

$paged = (intval(get_query_var('paged'))) ? get_query_var('paged') : 1;

$_featured_id = 0;
$_fea_the_query = '';

// Default args
$args = array(
    'post_type' => 'post',
    'orderby' => $_order_by,
    'order' => $_order
);


if (count($_resource_types) && !in_array('all', $_resource_types)) {
    $args['tax_query'][0] = array(
        'taxonomy' => 'blog-types',
        'field' => 'slug',
        'terms' => $_resource_types,
        'operator' => 'IN'
    );
}


if ($_show_featured) {
    $_fea_args = $args;
    $_fea_args['posts_per_page'] = 1;
    $_fea_args['meta_query'] = array(
        array(
            'key' => 'featured_resource',
            'value' => 'yes',
            'compare' => '=',
        )
    );


    $_fea_the_query = new WP_Query($_fea_args);
    if (count($_fea_the_query->posts)) {
        $_featured_id = $_fea_the_query->posts[0]->ID;
    } else {
        if ($_show_default_featured) {
            $_fea_args = $args;
            $_fea_args['posts_per_page'] = 1;
            $_fea_the_query = new WP_Query($_fea_args);
            if (count($_fea_the_query->posts)) {
                $_featured_id = $_fea_the_query->posts[0]->ID;
            }
        }
    }
}

/*$args['paged'] = $paged;
$args['posts_per_page'] = $_posts_number_per_page;

if ($_show_filters) {
    //fw_print($_filter_entries);
}

if($_featured_id){
    $args['post__not_in'] = array($_featured_id);
}

$_the_query = new WP_Query($args);*/
?>
    <div id="<?php echo $resourcesID; ?>" class="news-and-event resources-content-block">

        <?php if ($_show_featured && count($_fea_the_query)) {
            while ($_fea_the_query->have_posts()) {
                $_fea_the_query->the_post();
                $_post_id = get_the_ID();
                $_featured_image = fw_get_db_post_option($_post_id, 'featured_image');
                if ($_featured_image) {
                    $_fea_img = wp_get_attachment_url($_featured_image['attachment_id']);
                } else {
                    $_fea_img = wp_get_attachment_image_src(get_post_thumbnail_id($_post_id), 'single-post-thumbnail')[0];
                }
                $term_list = wp_get_post_terms($_post_id, 'blog-types', array("fields" => "names"));
                $_learn_more_label_featured = fw_get_db_post_option($_post_id, 'learn_more_label');
                $_webinar_date = fw_get_db_post_option($_post_id, 'webinar_date');
                $_link_data = json_decode(getResourceLink($_post_id, 'data'), true);

                ?>

                <div class="featured-block <?php echo strtolower(implode(' ', $term_list)); ?>">
                    <div class="default-slider" id="featured-news-slider">
                        <div class="slide-wrapper image-slide">
                            <a class="<?php echo $_link_data['_gated_class']; ?>"
                               href="<?php echo $_link_data['_link']; ?>"
                               target="<?php echo $_link_data['_target']; ?>" <?php echo $_link_data['_attibutes']; ?>>
                                <div class="fw-row">
                                    <div class="fw-col-sm-6 left-col">
                                        <div class="block-left" style="background-image: url(<?php echo $_fea_img; ?>);">
                                            <?php if ($_show_category_label): ?>
                                                <p class="cat_label"><?php echo implode(', ', $term_list); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="fw-col-sm-6 right-col">
                                        <div class="block-right">
                                            <div class="title">
                                                <?php if ($_show_date == 'true' && $_date_position == 'top') : ?>
                                                    <span><?php echo get_the_time("$_date_format"); ?></span>
                                                <?php endif; ?>
                                                <h3><?php the_title(); ?></h3>
                                                <?php if ($_show_date == 'true' && $_date_position == 'bottom') : ?>
                                                    <span><?php echo get_the_time("$_date_format"); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="content-area content">
                                                <div class="short-description">
                                                    <?php the_excerpt(); ?>
                                                </div>
                                                <?php if (trim($_learn_more_label_featured)) { ?>
                                                    <label class="link-text cf-link-btn"><?php echo $_learn_more_label_featured; ?></label>
                                                <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php getDownloadForm($_post_id); ?>
                        </div>
                    </div>
                </div>

                <?php
                // }
            }
        }
        wp_reset_query();
        wp_reset_postdata(); ?>

        <?php if ($_show_filters && count($_filter_entries)) { ?>
            <div class="resource-filters_<?php echo $resourcesID; ?> resources-filter-wrapper">
                <?php foreach ($_filter_entries as $_filter_entrie) { ?>
                    <div class="filter-<?php echo $_filter_entrie; ?>">
                        <?php if ($_filter_entrie == 'year') {
                            $years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'resource' ORDER BY post_date DESC");
                            ?>
                            <select id="<?php echo $_filter_entrie; ?>" name="<?php echo $_filter_entrie; ?>">
                                <option value="">Year</option>
                                <?php foreach ($years as $year) { ?>
                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                <?php } ?>
                            </select>
                        <?php } else {
                            $terms = get_terms(array(
                                'taxonomy' => $_filter_entrie,
                                'hide_empty' => false,
                            ));
                            $taxonomy = get_taxonomy($_filter_entrie);
                            ?>
                            <select id="<?php echo $_filter_entrie; ?>" name="<?php echo $_filter_entrie; ?>">
                                <option value=""><?php echo $taxonomy->label; ?></option>
                                <?php foreach ($terms as $term) { ?>
                                    <option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
                                <?php } ?>
                            </select>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="items-wrapper resources-blocks news-items-wrapper">
            <!-- ROW Open   -->
            <div class="fw-row resource-items_<?php echo $resourcesID; ?>">
                <?php get_blog_data($atts, $_featured_id); ?>
            </div>
        </div>
        <div class="load-more custom-post-load-more">
            <a href="javascript:void(0);"
               class="loadMore_<?php echo $resourcesID; ?> base-pro-button fw-btn primary"><?php echo $_load_more_text; ?></a>
            <input type="hidden" name="maxPage" id="maxPage_<?php echo $resourcesID; ?>"
                   value="<?php get_blog_data($atts, $_featured_id, false, 'maxPage'); ?>">
            <input type="hidden" name="paged" id="paged_<?php echo $resourcesID; ?>" value="2">
        </div>
    </div>
<script>
    //    if(2 > 2){
    //        alert('ok');
    //    }else{
    //        alert('notok');
    //    }

    function sameHeights(selector) {
        var selector = selector,
            query = document.querySelectorAll(selector),
            elements = query.length,
            max = 0;
        if (elements) {
            while (elements--) {
                var element = query[elements];
                if (element.clientHeight > max) {
                    max = element.clientHeight;
                }
            }
            elements = query.length;
            while (elements--) {
                var element = query[elements];
                element.style.height = max + 'px';
            }
        }
    }

    (function ($, window, document) {
        // Check load more [show/hide button]


        function checkLoadMoreButton_<?php echo $resourcesID; ?>() {
            var paged = parseInt($('#paged_<?php echo $resourcesID; ?>').val()); //alert(paged);
            var valMaxPage = parseInt($('#maxPage_<?php echo $resourcesID; ?>').val()); //alert(valMaxPage);
            if (paged > valMaxPage) { //alert('hide');
                $('.loadMore_<?php echo $resourcesID; ?>').hide();
            } else {
                $('.loadMore_<?php echo $resourcesID; ?>').show();
            }
        }

        checkLoadMoreButton_<?php echo $resourcesID; ?>();
        sameHeights(".resources-eh");

        $(".loadMore_<?php echo $resourcesID; ?>").on("click", function () {
            getResourcesData_<?php echo $resourcesID; ?>('click', 'load');
        });
        $(".resource-filters_<?php echo $resourcesID; ?> select").on("change", function () {
            getResourcesData_<?php echo $resourcesID; ?>('select', 'load');
            getResourcesData_<?php echo $resourcesID; ?>('select', 'maxPage');
        });

        function getResourcesData_<?php echo $resourcesID; ?>(mode, maxPage) {
            // We'll pass this variable to the PHP function example_ajax_request
            var atts = <?php echo json_encode($atts); ?>;
            var paged = parseInt($('#paged_<?php echo $resourcesID; ?>').val());
            //
            var valMaxPage = parseInt($('#maxPage_<?php echo $resourcesID; ?>').val());
            var filters = {};

            if (mode === 'select') {
                var paged = 1;
            }

            $(".resource-filters_<?php echo $resourcesID; ?> select").each(function (index) {
                if ($(this).has('option:selected')) {
                    //console.log('Select number ' + index + ': ' + $(this).val());
                    //console.log($(this).attr("name"));
                    filters['"' + $(this).attr("name") + '"'] = $(this).val();
                }
            });

            // This does the ajax request
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>', // or example_ajax_obj.ajaxurl if using on frontend
                type: 'post',
                data: {
                    'action': 'get_blog_data',
                    'atts': atts,
                    'featured_id': <?php echo $_featured_id; ?>,
                    'ajax': true,
                    'paged': paged,
                    'filters': filters,
                    'dataType': maxPage,
                },
                success: function (data) {
                    //alert(data); 
                    //alert(mode);
                    // alert(maxPage);
                    // This outputs the result of the ajax request
                    if (data != 0) {
                        if (mode === 'select') {
                            if (maxPage === 'maxPage') {
                                $("#paged_<?php echo $resourcesID; ?>").val(2);
                                $("#maxPage_<?php echo $resourcesID; ?>").val(data);
                                checkLoadMoreButton_<?php echo $resourcesID; ?>();
                            } else {
                                $(".resource-items_<?php echo $resourcesID; ?>").html(data);
                                sameHeights(".resources-eh");
                            }
                        } else {
                            $(".resource-items_<?php echo $resourcesID; ?>").append(data);
                            sameHeights(".resources-eh");
                            if (paged >= valMaxPage) {
                                $('.loadMore_<?php echo $resourcesID; ?>').hide();
                            }
                            $('#paged_<?php echo $resourcesID; ?>').val(paged + 1);
                        }
                    } else {
                        $(".resource-items_<?php echo $resourcesID; ?>").html('No data found');
                        $('.loadMore_<?php echo $resourcesID; ?>').hide();
                    }

                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        }
    })(jQuery); // or even jQuery.noConflict()
</script>
