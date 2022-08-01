<?php
/**
 * Plugin Name: User Data Fields For Jwt Authentication
 * Plugin URI: https://wordpress.org/plugins/custom-fields-for-jwt-authentication-for-wp-rest-api/
 * Description: A simple plugin that adds new fields (userId ,userlogin ,userFirstName ,UserLastName ,userRoles ,userRegisteredData ,userUrl ,userStatus ,userAvatarUrl , userActivationKey) in the jwt plugin response in the token endpoint
 * Version: 1.2.1
 * Author: AhmedHnewa
 * Author URI: https://www.youtube.com/darkzeroone
 * License: GPL2
 */
 if (!defined('ABSPATH')) {
	 die;
 }
add_filter( 'jwt_auth_token_before_dispatch', 'add_data_to_jwt_token', 10, 2 );
function add_data_to_jwt_token( $data, $user ) {
	$data['user_id'] = $user->ID;
	$data['user_login'] = $user->user_login;
	$data['user_first_name'] = $user->first_name;
	$data['user_last_name'] = $user->last_name;
	$data['user_roles'] = $user->roles;
	$data['user_role'] = implode(', ', $user->roles);
	$data['user_registered'] = $user->user_registered;
	$data['user_url'] = $user->user_url;
	$data['user_status'] = $user->user_status;
	$data['user_avatar_url'] = get_avatar_url($user->ID);
	$data['user_activation_key'] = $user->user_activation_key;
    return $data;
}

add_filter('jwt_auth_validate_token','add_data_to_jwt_validate_token', 10, 2);

function add_data_to_jwt_validate_token( $value, $token ){
	return array(
				'code' => 'jwt_auth_valid_token',
				'data' => array(
                    'status' => 200,
                ),
				'user_id' => get_userdata( $token->data->user->id )->ID,
				'user_email' => get_userdata( $token->data->user->id)->data->user_email,
				'user_login' => get_userdata( $token->data->user->id )->data->user_login,
				'display_name' => get_userdata( $token->data->user->id)->data->display_name,
				'user_nicename' => get_userdata( $token->data->user->id)->data->user_nicename,
				'user_roles' => get_userdata( $token->data->user->id )->roles,
				'user_role' => implode(', ', get_userdata( $token->data->user->id )->roles),
				'user_registered' => get_userdata( $token->data->user->id)->data->user_registered,
				'user_url' => get_userdata( $token->data->user->id)->data->user_url,
				'user_status' => get_userdata( $token->data->user->id)->data->user_status,
				'user_activation_key' => get_userdata( $token->data->user->id)->data->user_activation_key,
				);
}