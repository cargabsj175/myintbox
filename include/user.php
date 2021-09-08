<?php

include_once MWC_ROOT . "/include/random_numbers.php";

/**
 * Upon user registration, generate a random number and add this to the usermeta table
 *
 * @param required integer $user_id The ID of the newly registerd user
 */
add_action('user_register', 'my_on_user_register');
function my_on_user_register($user_id){

//    $args = array(
//        'length'    => 6,
//        'before'    => date("Y")
//    );
    $random_number = my_random_string($args);
    update_user_meta($user_id, 'random_number', $random_number);

}

/**
 * Output additional data to the users profile page
 *
 * @param WP_User $user Object properties for the current user that is being displayed
 */
add_action('show_user_profile', 'my_extra_user_profile_fields');
add_action('edit_user_profile', 'my_extra_user_profile_fields');
function my_extra_user_profile_fields($user){
    
    $random_number = get_the_author_meta('random_number', $user->ID);
?>
    <h3><?php _e('Mailbox Properties'); ?></h3>
    
    <table class="form-table">
        <tr>
            <th><label for="address"><?php _e('Mailbox ID'); ?></label></th>
            <td><?php echo $random_number; ?></td>
        </tr>
    </table>
<?php
}
