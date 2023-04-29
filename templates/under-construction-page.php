<?php
/**
 * Template Name: Under Construction Page
 */


global $under_construction_content;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <?php wp_head(); ?>
    </head>

<body <?php body_class('wwr-under-construction'); ?>>
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <?php
            if ( !empty( $under_construction_content ) ) {
                echo do_blocks( $under_construction_content );
            }
            ?>
        </main><!-- #main -->
    </div><!-- #primary -->

    <?php wp_footer(); ?>

</body>
</html>