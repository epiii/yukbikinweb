<?php
/*
 * Plugin Name: Webdevia Latest Tweets
 * Plugin URI: http://www.themeforest.net/user/Mymoun
 * Description: A widget that displays your latest tweets
 * Version: 1.1
 * Author: Mymoun
 * Author URI: http://www.themeforest.net/user/Mymoun
 * License: GPL2

    Copyright 2014  Mymoun

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License,
    version 2, as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
*/
       
    
function wd_getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
    
    
if(!function_exists("wd_get_tweets_tile")){
  function wd_get_tweets_tile(){
    if(session_id() == '' || !isset($_SESSION)) {
      //session_start();
    }
    require_once 'twitteroauth/twitteroauth.php'; 
    
    $output = '';
    $twitteruser        = get_option('wd_lt_twitter_user');
    $notweets           = 2; //how many tweets you want to retrieve
    $consumerkey        =  get_option('wd_lt_consumer_key');
    $consumersecret     = get_option('wd_lt_consumer_secret');
    $accesstoken        = get_option('wd_lt_oauth_token');
    $accesstokensecret  = get_option('wd_lt_oauth_token_secret');    
    
    $connection = wd_getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
    
    $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets); 
      
     if(is_array($tweets)){
       
       $output .= "<div class='wd-tweets'><ul>";
       foreach ($tweets as $key => $tweet) {
         $output .= "<li>". wd_url_text( $tweet->text, TRUE ) . "</li>";
       }
       $output .= "</ul></div>";
       
     }else{
       $output .= "<p>Error 512! sorry I can't get your tweets from twitter :( </p>";
     }
  return $output;    
  }
}