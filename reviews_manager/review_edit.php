<?php include '../view/header.php'; ?>
<main>
    <h1>Edit Review</h1>
    <form action="index.php" method="post" id="add_product_form"> 
        <input type="hidden" name="action" value="edit_review">
		<input type="hidden" name="review_id" value="<?php echo $review_id; ?>">
    
        <label>Video Game ID:</label>
        <select name="video_game_id">
        	<?php foreach ($video_games as $videogame) : ?>
            	<?php if ($videogame['videoGameID'] == $video_game_id) {?>
            		<option value="<?php echo htmlspecialchars($videogame['videoGameID']); ?>"
					selected>
                        <?php echo htmlspecialchars($videogame['videoGameName']); ?>
                    </option>
            	<?php } else {?>
                    <option
					value="<?php echo htmlspecialchars($videogame['videoGameID']); ?>">
                        <?php echo htmlspecialchars($videogame['videoGameName']); ?>
                    </option>
                <?php }?>
            <?php endforeach; ?>
        </select>
        <br>     
    
        <label>Review Date:</label>
        <input type="text" value="<?php echo $review_date; ?>" name="review_date" readonly  />
        <span class="error"><?php echo $error_review_date; ?></span>
        <br>

        <label>Rating:</label>
        <input type="text" value="<?php echo $rating; ?>" name="rating" />
        <span class="error"><?php echo $error_rating; ?></span>
        <br>

        <label>Author:</label>
        <input type="text" value="<?php echo $author; ?>" name="author" />
        <span class="error"><?php echo $error_author; ?></span>
        <br>
        
    	<label>&nbsp;</label>
        <input type="submit" value="edit review" />
        <br>  
    </form>
    <p class="last_paragraph">
       <a href="index.php?action=list_reviews">View Review List</a>
    </p>
</main>
<?php include '../view/footer.php'; ?> 