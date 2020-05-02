<?php include '../view/header.php'; ?>
<main>
    <h1>Add Review</h1>
    <form action="index.php" method="post" id="add_product_form">
    	<input type="hidden" name="action" value="add_review">
    	
    	<label>Video Game ID:</label>
    	<select name="video_game_id">
    	<?php foreach ($video_games as $videogame) : ?>
    	     <option value="<?php echo htmlspecialchars($videogame['videoGameID']); ?>" >
    		       <?php echo htmlspecialchars($videogame['videoGameName']); ?>
    	     </option>
        <?php endforeach; ?>
    	</select>
    	<br>
    	
   <?php $date = date('Y-m-d'." ".'h:i:s');?> 
    	<label>Review Date:</label>
    	<input type="text" name="review_date" value="<?php echo $date; ?>" readonly />
    	<br>
    
    	<label>Rating:</label>
    	<input type="text" name="rating" />
    	<br>
    	
   	 	<label>Author:</label>
   	 	<input type="text" name="author" />
   	 	<br>
   	 	
   	 	<label>&nbsp;</label>
   	 	<input type="submit" value="add review" />
   	 	<br>
    </form>
   <p class="last_paragraph">
        <a href="index.php?action=list_reviews">View Review List</a>
    </p>
</main>
<?php include '../view/footer.php'; ?>