<?php  
session_start();                                 //starts a session
if (!isset($_SESSION['recent'])) {
    $_SESSION['recent'] = array();               //creates empty session array with the index ['recent']
}


include 'view/header.php'; 
require('model/database.php');
require('model/reviews_db.php');
require('model/video_game_db.php');
// print_r(get_reviews_recent());
?>


<main>
    <h1>Menu</h1>
    <ul>
        <li>
            <a href="reviews_manager">Game Reviews Manager</a>
        </li>
        <li>
            <a href="reviews_catalog">Game Reviews Catalog</a>
        </li>
    </ul>
	<h2>Recently Rated Games</h2>
	 <ul>
	 <?php 

	 foreach ($_SESSION['recent'] as $videogame) {         //diplays items in the $_SESSION array
	     echo '<li>';
	     echo "Game: $videogame";
	     echo '</li>';
	 }
	 
	 ?>
    </ul>

    <h2>Recent Game Reviews With Highest Ratings</h2>
<?php 
    $top = get_reviews_recent();
    echo '<table>';
        echo '<tr><th> review ID</th><th>video game ID</th><th>date</th> <th>rating</th><th>author</th>
                <th>game name</th><th>game studio</th><th>system</th>
                </tr>';
        foreach ($top as $k => $v) {                       //rows
            echo '<tr>';
                foreach( $v as $kk => $vv) {                   //columns
                    echo '<td>'.htmlspecialchars($vv).'</td>';
                }
            echo '</tr>';
        }
    echo '</table>';
?>
</main>
<?php include 'view/footer.php'; ?>