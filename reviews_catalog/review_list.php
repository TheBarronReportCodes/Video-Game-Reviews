<?php include '../view/header.php'; ?>
<main>
	<aside>
		<h1>Video Games</h1>
		<?php include '../view/categories_nav.php'; ?>
    </aside>
    
    <section>
        <h1><?php echo htmlspecialchars($video_game_name); ?></h1>  
        <h2>Reviews</h2>
          <table>
            <tr>
                <th>Review ID</th>
                <th>Video Game ID</th>
                <th>Review Date</th>
                <th>Rating</th>
                <th>Author</th>
            </tr>
            
          <?php foreach ($reviews as $review) : ?>
            <tr>
                <td><?php echo htmlspecialchars($review['reviewID']); ?></td>
                <td><?php echo htmlspecialchars($review['videoGameID']); ?></td>
                <td><?php echo htmlspecialchars($review['reviewDate']); ?></td>
                <td><?php echo htmlspecialchars($review['rating']); ?></td>
                <td><?php echo htmlspecialchars($review['reviewAuthor']); ?></td>
            </tr>
           <?php endforeach; ?>
        </table>
        
		<?php include '../view/directory.php'; ?>
		
    <p>
    <a href="?action=view_video_game&amp;video_game_id=<?php echo htmlspecialchars($video_game_id); ?>">
    Purchase <?php echo htmlspecialchars($video_game_name); ?>
    </a>
    </p>  
    <p><a href="../index.php">Menu</a></p>  
    </section>
</main>
<?php include '../view/footer.php'; ?>