<?php
session_start();                                 //starts a session
if (!isset($_SESSION['recent'])) {
    $_SESSION['recent'] = array();               //creates empty session array with the index ['recent']
}

require('../model/database.php');
require('../model/reviews_db.php');
require('../model/video_game_db.php');

$action = filter_input(INPUT_POST, 'action'); //action variable is an array of information where the 'name' variable is equal to 'action'
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_reviews'; //action variable takes on the string name of 'list_review'
    }
}
if ($action == 'list_reviews') { // if the action variable is equal to 'list_review', run the code inside
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
} else if ($action == 'delete_review') { // if the action variable is equal to 'delete_review', run the code inside
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT); //post and filter review id from form
    $video_game_id = filter_input(INPUT_POST, 'video_game_id', FILTER_VALIDATE_INT); //post and filter video game id from form
    if ($video_game_id == NULL || $video_game_id == FALSE ||
        $review_id == NULL || $review_id == FALSE) {
        $error = "Missing or incorrect review or video game id.";
        include('../errors/error.php');
     } else {
         delete_review($review_id);
         header("Location: .?video_game_id=$video_game_id"); //after we delete we need to show the user the new page, so we add the parameter
     }
} else if ($action == 'show_review_edit_form') { // if the action variable is equal to 'show_edit_form', run the code inside
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT); //post and filter review id from form
    $video_game_id = filter_input(INPUT_POST, 'video_game_id', FILTER_VALIDATE_INT); //post and filter video game id from form
    if ($video_game_id == NULL || $video_game_id == FALSE ||
        $review_id == NULL || $review_id == FALSE) {
            $error = "Invalid review data. Check all fields and try again.";
            include('../errors/error.php');
    } else {
        $video_games = get_video_game();
        $reviews = get_reviews($review_id);
        $review_date = $reviews['reviewDate'];
        $error_review_date = "";
        $rating = $reviews['rating'];
        $error_rating = "";
        $author = $reviews['reviewAuthor'];        
        $error_author = "";
        include('review_edit.php');
    }
} else if ($action == 'edit_review') {
    $review_id = filter_input(INPUT_POST, 'review_id', FILTER_VALIDATE_INT); //post and filter review id from form
    $video_game_id = filter_input(INPUT_POST, 'video_game_id', FILTER_VALIDATE_INT); //post and filter video game id from form
    if ($video_game_id == NULL || $video_game_id == FALSE ||
        $review_id == NULL || $review_id == FALSE) {
        $error = "Invalid review data. Check all fields and try again.";
        include('../errors/error.php');
    } else {
        
        $review_date = filter_input(INPUT_POST, 'review_date');
        $error_review_date = "";
        $rating = filter_input(INPUT_POST, 'rating');
        $error_rating = "";
        $author = filter_input(INPUT_POST, 'author');
        $error_author = "";
        
        // validate form fields
        $error = FALSE;
        if ($review_date == NULL) {
            $error_review_date = "date required";
            $error = TRUE;
        }
        if ($rating == NULL || $rating == FALSE) {
            $error_rating  = "rating required";
            $error = TRUE;
        } else if ($rating <= 0 || $rating > 10  ) {
            $error_rating  = "rating must be between 0 and 10";
            $error = TRUE;
        }
        if ($author == NULL) {
            $error_author  = "author required";
            $error = TRUE;
        } else if (strlen($author) < 2) {
            $error_author = "author must consist of two or more characters";
            $error = TRUE;
        }
        
        if ($error) {
            $video_games = get_video_game();
            include('review_edit.php');
        } else {
            edit_review($review_id, $video_game_id, $review_date, $rating, $author);
            header("Location: .?video_game_id=$video_game_id");
        }
     }
} else if ($action == 'show_add_review_form') { //  if the action variable is equal to 'show_add_review_form', run the code inside
    $video_games = get_video_game();                           //retrieves video games table
    include('review_add_form.php');             // displays reviews add form
} else if ($action == 'add_review') {
    $video_game_id = filter_input(INPUT_POST, 'video_game_id', FILTER_VALIDATE_INT);
    $review_date = filter_input(INPUT_POST, 'review_date');
    $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
    $author = filter_input(INPUT_POST, 'author');
    
    if ($video_game_id == NULL || $video_game_id == FALSE ||                //check for validation
        $review_date == NULL || $review_date == FALSE ||
        $rating == NULL || $rating == FALSE ||
        $rating < 1 || $rating > 10 ||
        $author == NULL || $author == FALSE) {
        $error = "Invalid review data. Check all fields and try again.";
        include('../errors/error.php');
     } else {                                                             //if validation passes
         $video_game_name = get_video_game_name($video_game_id);
         if (in_array($video_game_name, $_SESSION['recent'])) {           //check if name exist inside SESSION array, DO NOT add onto Session Array
             add_review($video_game_id, $review_date, $rating, $author);      //add the review
             header("Location: .?video_game_id=$video_game_id");              //redirect back to page
         } else {                                                         //if it doesn't exist
             array_push($_SESSION['recent'], $video_game_name);   //add the name of the recently added video game to the SESSION array
             if (count($_SESSION['recent']) > 3) {                //If more than 3 added to the array, remove the least recent one
                 array_shift($_SESSION['recent']);
             }
             add_review($video_game_id, $review_date, $rating, $author);      //add the review
             header("Location: .?video_game_id=$video_game_id");              //redirect back to page
         }
     }


}