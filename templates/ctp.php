<div class="wrap">
    <h1>CTP Manager</h1>
    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php
        settings_fields('learning_plugin_cpt_settings');
        do_settings_sections('learning_cpt');
        submit_button();
        ?>
    </form>
</div>