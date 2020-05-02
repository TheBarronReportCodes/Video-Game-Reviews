<?php
require('../model/database.php');
require('../model/reviews_db.php');
require('../model/video_game_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_reviews';
    }
}

if ($action == 'list_reviews') {
    $video_game_id = filter_input(INPUT_GET, 'video_game_id',
        FILTER_VALIDATE_INT);
    if ($video_game_id == NULL || $video_game_id == FALSE) {
        $video_game_id = 1;
    }
    $video_games = get_video_game();
    $video_game_name = get_video_game_name($video_game_id);
//     print_r($video_games);
    $reviews = get_reviews_by_videogame($video_game_id);
    include('review_list.php');
} else if ($action == 'view_video_game') {
    $video_game_id = filter_input(INPUT_GET, 'video_game_id',
        FILTER_VALIDATE_INT);
    if ($video_game_id == NULL || $video_game_id == FALSE) {
        $error = 'Missing or incorrect $video game id.';
        include('../errors/error.php');
    }  else {
        $video_games = get_video_game();
        $video_game_name = get_video_game_name($video_game_id);
        $reviews = get_reviews_by_videogame($video_game_id);
        
        // Calculate discounts
        $list_price = 60;
        $discount_percent = 30;  // 30% off for all web orders
        $discount_amount = round($list_price * ($discount_percent/100.0), 2);
        $unit_price = $list_price - $discount_amount;
        
        // Format the calculations
        $discount_amount_f = number_format($discount_amount, 2);
        $unit_price_f = number_format($unit_price, 2);
        
        // Get image URL and alternate text
        $id = $video_game_id;
        $image_filename = '../images/' .  $id . '.png';
        $image_alt = 'Image: ' .  $id . '.png';
        
        include('review_view.php');
    }
} else if ($action == 'view_cart') {
    include ('cart_view.php');
}