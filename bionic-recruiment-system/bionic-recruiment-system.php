<?php
/*
Plugin Name: Bionic Recruitment System
Plugin URI: http://bionicsystembd.com//wordpress/plugins/sample-user-directory/
Description: Creates a directory of the site's users.
Version: 1.7.2 
License: GPLv2
Author: NURMOHAMMAD
Author URI:  http://bionicsystembd.com
*/

//total character show
function show_total_character($content)
{

    return $content . "<hr> <div style='color:blue' class='alert alert-success'>This article contains " . mb_strlen($content) . " characters.</div>";
}

add_filter('the_content', 'show_total_character', 10, 1);


//data store in option page
function add_stepone_options()
{
    $args = array(
        'name' => 'Bionic Recruitment System',
        'email' => 'bionic@gmail.com',
        'phone' => '01711111111',
        'about' => 'This is about section',
    );
    if (!get_option('bionic_personal_info')) {
        add_option('bionic_personal_info', $args, '', 'yes');
    }
}
add_action('admin_init', 'add_stepone_options');

function add_steptwo_options()
{
    $args = array(
        'NID no' => '111111111',
        'Driver/Character no' => '888888888',
        'CV' => 'Cv is here',
    );
    if (!get_option('bionic_certification')) {
        add_option('bionic_certification', $args, '', 'yes');
    }
}
add_action('admin_init', 'add_steptwo_options');

// form 

//Personal info

function scl_simple_options_page()
{

?>
    <div class="wrap">
        <form method="post" id="bionic_personal_info" action="options.php">
            <?php
            settings_fields('bionic_personal_info');
            $options = get_option('bionic_personal_info');
            ?>
            <h2> <?php _e('Bionic Recruitment Info:'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Name'); ?></th>
                    <td colspan="3">
                        <input type="text" id="name"
                            name="bionic_personal_info[name]" value="<?php echo esc_attr($options['name']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Email'); ?></th>
                    <td colspan="3">
                        <input type="email" id="email"
                            name="bionic_personal_info[email]" value="<?php echo esc_attr($options['email']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Phone'); ?></th>
                    <td colspan="3">
                        <input type="number" id="phone"
                            name="bionic_personal_info[phone]" value="<?php echo esc_attr($options['phone']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('About'); ?></th>
                    <td colspan="3">
                        <input type="text" id="about"
                            name="bionic_personal_info[about]" value="<?php echo esc_attr($options['about']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" value="<?php esc_attr_e('Update Info'); ?>"
                    class="button-primary" />
            </p>
        </form>
    </div>
<?php
}

add_action('admin_menu', 'scl_simple_options_add_pages');

function scl_simple_options_add_pages()
{
    add_options_page(__('Admin Message Form', 'bionic_personal_info'), __('Bionic Recruitment Info', 'bionic_personal_info'), 'manage_options', 'simple-options-example', 'scl_simple_options_page');
    register_setting('bionic_personal_info', 'bionic_personal_info', 'bionic_personal_info_sanitize');
}


function show_personnal_info($content)
{
    $options = get_option('bionic_personal_info');
    return $content . "<hr> <h2 style='color:info'>" .
        " " . $options['name'] . " | " . $options['email'] . " | " . $options['phone'] . " |" . $options['about'];
    ".</h2>";
}

add_filter('the_content', 'show_personnal_info', 10, 1);




//Certification
function simple_options_page()
{
?>
    <div class="wrap">
        <form method="post" id="bionic_certification" action="options.php">
            <?php
            settings_fields('bionic_certification');
            $options = get_option('bionic_certification');
            ?>
            <h2> <?php _e('Bionic Recruitment Certification:'); ?></h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('NID no'); ?></th>
                    <td colspan="3">
                        <input type="text" id="nid_no"
                            name="bionic_certification[NID no]" value="<?php echo esc_attr($options['NID no']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Driver/Character no'); ?></th>
                    <td colspan="3">
                        <input type="text" id="driver_no"
                            name="bionic_certification[Driver/Character no]" value="<?php echo esc_attr($options['Driver/Character no']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('CV'); ?></th>
                    <td colspan="3">
                        <input type="text" id="cv"
                            name="bionic_certification[CV]" value="<?php echo esc_attr($options['CV']); ?>" />
                        <br /><span class="description"><?php _e('Enter the verification key for the Google meta tag.'); ?></span>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" value="<?php esc_attr_e('Update Info'); ?>"
                    class="button-primary" />
            </p>
        </form>
    </div>
<?php
}

add_action('admin_menu', 'certification_options_add_pages');

function certification_options_add_pages()
{
    add_options_page(__('Admin Message Form', 'bionic_certification'), __('Bionic Recruitment Certification', 'bionic_certification'), 'manage_options', 'certification-options-example', 'simple_options_page');
    register_setting('bionic_certification', 'bionic_certification', 'bionic_certification_sanitize');
}


function certification_info($content)
{
    $options = get_option('bionic_certification');
    return $content . "<hr> <h3 style='color:info'>" .
        " " . $options['NID no'] . " | " . $options['Driver/Character no'] . " | " . $options['CV'];
    ".</h3>";
}

add_filter('the_content', 'certification_info', 10, 1);
