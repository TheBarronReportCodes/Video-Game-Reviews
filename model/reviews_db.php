<?php
function get_reviews($review_id) {
    global $db;
    $query = 'SELECT * FROM reviews
              WHERE reviewID = :review_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':review_id', $review_id);
    $statement->execute();
    $review = $statement->fetch();
    $statement->closeCursor();
    return $review;
}

function get_reviews_by_videogame($videoGame_id) {
    global $db;
    $query = 'SELECT * FROM reviews AS r
              INNER JOIN videoGames AS v ON r.videoGameID = v.videoGameID
              WHERE r.videoGameID = :videoGame_id
              ORDER BY reviewID';
    $statement = $db->prepare($query);
    $statement->bindValue(':videoGame_id', $videoGame_id);
    $statement->execute();
    $reviews = $statement->fetchAll();
    $statement->closeCursor();
    return $reviews;
}

function get_reviews_recent() {
    global $db;
    $date = time() - (365 * 24 * 60 *60);   //reviews within the past year
    $dateString = date('Y-m-d H:i:s', $date);
    $query = 'SELECT * FROM reviews AS r
            INNER JOIN videoGames AS v ON r.videoGameID = v.videoGameID 
            WHERE reviewDate > "'.$dateString.'" ORDER BY rating DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $reviews = $statement->fetchAll(PDO::FETCH_ASSOC);
    $topReviews = array(); // will store top 3 games
    $topReviews = sort_reviews($reviews);
    $statement->closeCursor();
    return $topReviews;
}

function sort_reviews($reviews) {
    $ratings = array();
    foreach($reviews as $k => $v) {
        $ratings[$k] = $v['rating'];
    }
    array_multisort($reviews, $ratings);
    $topReviews = array_reverse($reviews); //reverse the reviews array. Will give us the highest ratings
    $topReviews = array_slice($topReviews, 0, 3); //seperate array into the first three indexes
    return $topReviews;
}

function delete_review($review_id){
    global $db;
    $query = 'DELETE FROM reviews
              WHERE reviewID = :review_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':review_id', $review_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_review($video_game_id, $review_date, $rating, $author) {
    global $db;
    $query = 'INSERT INTO reviews
             (videoGameID, reviewDate, rating, reviewAuthor)
          VALUES
             (:video_game_id, :review_date, :rating, :author)';
    $statement = $db->prepare($query);
    $statement->bindValue(':video_game_id', $video_game_id);
    $statement->bindValue(':review_date', $review_date);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':author', $author);
    $statement->execute();
    $statement->closeCursor();
}

function edit_review($review_id, $video_game_id, $review_date, $rating, $author) {
    global $db;
    $query = 'UPDATE reviews
              SET videoGameID = :video_game_id, reviewDate = :review_date, rating = :rating, reviewAuthor = :author
              WHERE reviewID = :review_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':review_id', $review_id);
    $statement->bindValue(':video_game_id', $video_game_id);
    $statement->bindValue(':review_date', $review_date);
    $statement->bindValue(':rating', $rating);
    $statement->bindValue(':author', $author);
    $statement->execute();
    $statement->closeCursor();
}
?>