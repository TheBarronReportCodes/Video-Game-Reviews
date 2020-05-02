 <?php
 //returns all video game rows
function get_video_game() {
    global $db;
    $query = 'SELECT * FROM videogames
              ORDER BY videoGameID';
    $statement = $db->prepare($query);
    $statement->execute();
    $videogames = $statement->fetchAll();
    $statement->closeCursor();
    return $videogames;

}

//returns name of specific video game row
function get_video_game_name($video_game_id) {
    global $db;
    $query = 'SELECT * FROM videogames
              WHERE videoGameID = :video_game_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':video_game_id', $video_game_id);
    $statement->execute();
    $video_game = $statement->fetch();
    $statement->closeCursor();
    $video_game_name = $video_game['videoGameName'];

    return $video_game_name;
}



?>