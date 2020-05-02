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
                <th>&nbsp;</th>
                <th>&nbsp;</th>
            </tr>
              
          <?php foreach ($reviews as $review) : ?>
            <tr>
                <td><?php echo htmlspecialchars($review['reviewID']); ?></td>
                <td><?php echo htmlspecialchars($review['videoGameID']); ?></td>
                <td><?php echo htmlspecialchars($review['reviewDate']); ?></td>
                <td><?php echo htmlspecialchars($review['rating']); ?></td>
                <td><?php echo htmlspecialchars($review['reviewAuthor']); ?></td>
                <td>
                    <form action="." method="post">
                    	<input type="hidden" name="action" 
                    	   value="delete_review">
                    	<input type="hidden" name="review_id" 
                           value="<?php echo $review['reviewID']; ?>"> <!-- allows access to review ID. This will allow us to delete the review -->
                    	<input type="hidden" name="video_game_id" 
                    	   value="<?php echo $review['videoGameID']; ?>"> <!-- allows access to video game ID. This will be used to return to the page -->
                		<input type="submit" value="Delete">
                </form>
                </td>
                <td>
                    <form action="." method="post">
                    	<input type="hidden" name="action" 
                           value="show_review_edit_form"> 
                    	<input type="hidden" name="review_id" 
                           value="<?php echo $review['reviewID']; ?>"> 
                    	<input type="hidden" name="video_game_id" 
                           value="<?php echo $review['videoGameID']; ?>">                                                                      
                		<input type="submit" value="Edit">
                    </form>
                </td>
            </tr>
           <?php endforeach; ?>
        </table>
        <p><a href="?action=show_add_review_form">Add Review</a></p>     
        <p><a href="../index.php">Menu</a></p>   
    </section>        
</main>
<?php include '../view/footer.php'; ?>