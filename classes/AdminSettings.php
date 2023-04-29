<?php

namespace WWReliable\UnderConstruction;

class AdminSettings
{

    public function __construct()
    {
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_notices', [$this, 'displayAdminWarning']);
    }

    public function registerSettings() {
        add_settings_field(
            'wwr_under_construction_mode',
            'Under Construction Mode',
            [$this, 'underConstructionToggleCallback'],
            'general'
        );
        register_setting('general', 'wwr_under_construction_mode');
    }

    public function underConstructionToggleCallback() {
        $option = get_option('wwr_under_construction_mode');
        echo '<input type="checkbox" id="wwr_under_construction_mode" name="wwr_under_construction_mode" value="1"' . checked(1, $option, false) . '/>';
    }

    public function isUnderConstruction(): bool
    {
        $option = get_option('wwr_under_construction_mode');
        return $option == 1;
    }

    public function displayAdminWarning() {
        if ($this->isUnderConstruction()) {
            ?>
            <div class="notice notice-warning">
                <p><?php
                    printf(__('Warning: The Under Construction mode is enabled. <a href="%s">Go to General Options</a> to disable Under Construction when you are ready to show the world your awesome content.'), admin_url('options-general.php'));
                    ?></p>
            </div>
            <?php
        }
    }

}