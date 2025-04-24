<?php
/**
 * Theme Options Page
 */

add_action('admin_menu', 'vixen_themeoptions');
add_action('admin_init', 'vixen_register_settings');
add_action('admin_enqueue_scripts', 'vixen_admin_scripts');

// Register Theme Options Menu
function vixen_themeoptions() {
    add_menu_page(
        'Theme Options',
        'Theme Options',
        'manage_options',
        'vixen-options',
        'vixen_options_page',
        'dashicons-admin-generic',
        61
    );
}

// Register Options and Fields
function vixen_register_settings() {
    // HEADER
    add_settings_section("header_section", "Header Settings", null, "vixen-options-header");
    add_settings_field("header_logo", "Header Logo", "vixen_text_field", "vixen-options-header", "header_section", ["name" => "header_logo", "type" => "image"]);
    register_setting("vixen_options_group", "header_logo");

    // FOOTER
    add_settings_section("footer_section", "Footer Settings", null, "vixen-options-footer");
    add_settings_field("footer_logo", "Footer Logo", "vixen_text_field", "vixen-options-footer", "footer_section", ["name" => "footer_logo", "type" => "image"]);
    add_settings_field("footer_desc", "Footer Description", "vixen_text_field", "vixen-options-footer", "footer_section", ["name" => "footer_desc"]);
    add_settings_field("footer_menu_heading", "Footer Menu Heading", "vixen_text_field", "vixen-options-footer", "footer_section", ["name" => "footer_menu_heading"]);
    register_setting("vixen_options_group", "footer_logo");
    register_setting("vixen_options_group", "footer_desc");
    register_setting("vixen_options_group", "footer_menu_heading");

    register_setting('vixen_options_group', 'footer_social_links', [
        'sanitize_callback' => function () {
            return json_decode(stripslashes($_POST['footer_social_links_serialized']), true);
        }
    ]);

    // HOMEPAGE
    add_settings_section("homepage_section", "Homepage Settings", null, "vixen-options-homepage");
    for ($i = 1; $i <= 3; $i++) {
        $key = "homepage_cat{$i}";
        add_settings_field($key, "Homepage Category {$i}", "vixen_category_dropdown", "vixen-options-homepage", "homepage_section", ["name" => $key]);
        register_setting("vixen_options_group", $key);
    }
}

// Render the Options Page
function vixen_options_page() {
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'header';
    ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <h2 class="nav-tab-wrapper">
            <a href="?page=vixen-options&tab=header" class="nav-tab <?= $active_tab == 'header' ? 'nav-tab-active' : '' ?>">Header</a>
            <a href="?page=vixen-options&tab=footer" class="nav-tab <?= $active_tab == 'footer' ? 'nav-tab-active' : '' ?>">Footer</a>
            <a href="?page=vixen-options&tab=homepage" class="nav-tab <?= $active_tab == 'homepage' ? 'nav-tab-active' : '' ?>">Homepage</a>
        </h2>
        <form method="post" action="options.php">
            <?php
            settings_fields("vixen_options_group");
            do_settings_sections("vixen-options-{$active_tab}");

            if ($active_tab === 'footer') {
                echo '<h2>Social Links</h2>';
                $social_links = get_option('footer_social_links', []);
                echo '<div id="vixen-social-links">';
                if (!empty($social_links) && is_array($social_links)) {
                    foreach ($social_links as $item) {
                        echo vixen_social_row($item['icon'], $item['url']);
                    }
                }
                echo '</div>';
                echo '<button type="button" class="button" id="add-social-link">Add Social Link</button>';
                echo '<input type="hidden" name="footer_social_links_serialized" id="footer_social_links_serialized">';
            }

            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Text / Image Field Renderer
function vixen_text_field($args) {
    $name = $args['name'];
    $type = $args['type'] ?? 'text';
    $value = esc_attr(get_option($name));

    if ($type === 'image') {
        echo "<input type='text' id='{$name}' name='{$name}' value='{$value}' class='regular-text'>";
        echo "<button class='button vixen-upload-button' data-input='{$name}' data-preview='{$name}_preview'>Upload</button>";
        $preview = $value ? "<img id='{$name}_preview' src='{$value}' style='max-height:100px; display:block; margin-top:10px;' />" : "<img id='{$name}_preview' style='max-height:100px; display:none; margin-top:10px;' />";
        echo $preview;
    } else {
        echo "<input type='text' name='{$name}' value='{$value}' class='regular-text'>";
    }
}

// Category Dropdown
function vixen_category_dropdown($args) {
    $name = $args['name'];
    $value = get_option($name);
    $categories = get_categories(['hide_empty' => false]);

    echo "<select name='{$name}'>";
    echo "<option value=''>Select a category</option>";
    foreach ($categories as $cat) {
        $selected = ($value == $cat->term_id) ? 'selected' : '';
        echo "<option value='{$cat->term_id}' {$selected}>{$cat->name}</option>";
    }
    echo "</select>";
}

// Social Row Renderer
function vixen_social_row($icon = '', $url = '') {
    return "
    <div class='vixen-social-row' style='margin-bottom: 10px;'>
        <input type='text' placeholder='Icon Class (fab fa-twitter)' value='{$icon}' class='vixen-icon-input' />
        <input type='text' placeholder='URL' value='{$url}' class='vixen-url-input' />
        <button type='button' class='button remove-social'>Remove</button>
    </div>";
}

// Enqueue Media and JS
function vixen_admin_scripts($hook) {
    if ($hook !== 'toplevel_page_vixen-options') return;

    wp_enqueue_media();
    wp_enqueue_style('vixen-admin-style', get_template_directory_uri() . '/css/admin-theme-options.css');
    wp_enqueue_script('vixen-admin', get_template_directory_uri() . '/js/vixen-admin.js', ['jquery'], null, true);
}
