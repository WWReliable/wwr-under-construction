<?php

namespace WWReliable\UnderConstruction;

defined( 'ABSPATH' ) || exit;

class Init
{

    public AdminSettings $adminSettings;

    public function __construct()
    {
        $this->adminSettings = new AdminSettings();
        add_action('init', [$this, 'init']);
    }

    public function init() {
        if ( !is_admin() && get_option( 'wwr_under_construction_mode' ) && !current_user_can( 'manage_options' ) ) {
            add_action('template_redirect', [$this, 'displayUnderConstruction']);
            add_filter( 'template_include', array( $this, 'loadUnderConstructionTemplate' ), 99 );
        }
    }

    public function displayUnderConstruction() {
        $content = $this->getTemplate();
        if ( !empty( $content ) ) {
            status_header( 302 );
            // Save the template content as a global variable to use it later.
            global $under_construction_content;
            $under_construction_content = $content;
        }
    }

    private function getTemplate() : string {
        $name = 'under-construction';
        $args = array(
            'post_type'      => 'wp_template',
            'post_name__in'  => array($name),
            'post_status'    => 'publish',
            'numberposts'    => 1,
        );
        $template = get_posts($args);
        if ( !empty($template) ) {
            return $template[0]->post_content;
        }

        $templates = get_template_directory() . "/templates/";
        if ( file_exists( $templates . $name . '.html' ) ) {
            return file_get_contents( $templates . $name . '.html' );
        }

        return "";
    }

    public function loadUnderConstructionTemplate( $template ) {
        global $under_construction_content;
        if ( !empty( $under_construction_content ) ) {
            // Create a temporary custom page template.
            $template = dirname(dirname( __FILE__ )) . '/templates/under-construction-page.php';
        }

        return $template;
    }
}