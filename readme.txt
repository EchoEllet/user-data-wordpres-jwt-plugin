=== User Data Fields For JWT Authentication ===

Contributors: ahmedriyadh
Tags: wp-json, jwt, json web authentication, wp-api
Tested up to: 6.0.1
Stable tag: 1.2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==

Wordpress is a good content mangement system for building websites, but it will be better if you build like mobile apps,
With the wordpress rest api you can create posts, edit posts, view posts, Users, Uploading Media etc...
but the problem with the wordpress rest api it does not provide any authentication methods for third party application like mobile apps
The Jwt Plugin on wordpress.org does provide that

and this plugin is just a addon for that plugin

So this plugin is useful if you don't want to make another request to fetch user data like Id etc..
because you have to get the id of the user in ordet to get all data

It really simple plugin
it writed with 50 lines of code, the size of the plugin is 3Kb

Note: This Is Plugin For
[JwtAuthenticatonForWordpress](https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/)

so if the jwt authentication plugin is not installed
this plugin will not add the fields to it endpoints

and the fields will be added only if the token is getted successfully

Example request (before install the plugin):
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjAuMTgyIiwiaWF0IjoxNjE0MDg3NDQ2LCJuYmYiOjE2MTQwODc0NDYsImV4cCI6MTYxNDY5MjI0NiwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.KeAUc7PiTne0_PThsSAWo1ruvl2Ocu-fbCn2jG7zkoE",
    "user_email": "example@example.com",
    "user_nicename": "admin",
    "user_display_name": "admin"
}

Example response (after install the plugin):
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xOTIuMTY4LjAuMTgyIiwiaWF0IjoxNjE0MDg2NjQyLCJuYmYiOjE2MTQwODY2NDIsImV4cCI6MTYxNDY5MTQ0MiwiZGF0YSI6eyJ1c2VyIjp7ImlkIjoiMSJ9fX0.nyDOICdQcZKbWZo2kQRp_eLBkuxjnK_rpxs-HJREyCg",
    "user_email": "example@example.com",
    "user_nicename": "admin",
    "user_display_name": "admin",
    "user_id": 1,
    "user_login": "admin",
    "user_first_name": "sfd",
    "user_last_name": "",
    "user_roles": [
        "administrator"
    ],
    "user_role": "administrator",
    "user_registered": "2021-02-17 09:21:29",
    "user_url": "http://localhost",
    "user_status": "0",
    "user_avatar_url": "https://secure.gravatar.com/avatar/22feea4605ac5b7163eac439b5241034?s=96&d=mm&r=g",
    "user_activation_key": ""
}

Of course you can add the code of this plugin to your Theme,
but this is not recommened because when you change the theme or update it
the changes will revert back, you can create child theme for that
but instead you can just install this simple plugin

Don't forget to setup (JwtAuthenticatonForWordpress)[https://wordpress.org/plugins/jwt-authentication-for-wp-rest-api/]

[Github](https://github.com/ahmedhnewa/user-data-fields-jwt-plugin)

### Can Add User Data Fields To Validate Token Endpoint ?
This plugin can also add user data fields to validate token endpoint,

Unfortunately, the jwt extension does not support using the filter for validate_token function,
So You Will Need To Modify Some Codes Inside Jwt Plugin Codes
Go To \wp-content\plugins\jwt-authentication-for-wp-rest-api\public\class-jwt-auth-public.php
And At The End Of Function That Named validate_token
In Line 302

Edit This Code 
From :
/** If the output is true return an answer to the request to show it */
            return array(
                'code' => 'jwt_auth_valid_token',
                'data' => array(
                    'status' => 200,
                ),
            );
To : 
$value = array(
			'code' => 'jwt_auth_valid_token',
				'data' => array(
                    'status' => 200,
                )
			);
            /** If the output is true return an answer to the request to show it */
            return apply_filters('jwt_auth_validate_token', $value, $token);

Now you have done,
the plugin should be able to add new values by adding a filter

Note :
If you updated the jwt plugin,
you should again edit the code because it will be removed

### REQUIREMENTS
JWT Authentication for WP REST API Plugin

== Upgrade Notice ==
= 1.2.1 =
* Tested up to the current version of wordpress
= 1.2.0 =
* Add User Data Fields To Validate Token Endpoint (Please Read Docs)

== Changelog ==
.

== Frequently Asked Questions ==

= How To Use This Plugin ? =
Just install it to your wordpress site, and no another action required, but if you want to add the user fields to validate token endpoint,
please make sure that you have edit the jwt plugin code, Please read description for more information

== Screenshots ==
1. This is when get token response
2. This Is when get validate token response