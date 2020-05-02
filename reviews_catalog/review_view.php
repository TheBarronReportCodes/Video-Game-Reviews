<?php include '../view/header.php'; ?>
<main>
	<aside>
		<h1>Video Games</h1>
		<?php include '../view/categories_nav.php'; ?>
    </aside>
  <form action="index.php" method="post">
  <input type="hidden" name="action" value="view_cart" />
    <section>
        <h1><?php echo htmlspecialchars($video_game_name); ?></h1>
        <div id="left_column">
            <p>
                <img src="<?php echo $image_filename; ?>"
                    alt="<?php echo $image_alt; ?>" />
            </p>
        </div>

        <div id="right_column">
            <p><b>List Price:</b> $<?php echo $list_price; ?></p>
            <p><b>Discount:</b> <?php echo $discount_percent; ?>%</p>
            <p><b>Your Price:</b> $<?php echo $unit_price_f; ?>
                 (You save $<?php echo $discount_amount_f; ?>)</p>
                 
         <?php if (!empty($reviews) && isset($reviews) && is_array($reviews)) { //if the reviews table is not empty, is set, and is an array
                    $review_value_total = 0;
                     foreach ($reviews as $review) :        //this is a 2 D array
                        $review_value_total += $review['rating'];  //for each video game; it adds the rating from every review for it together
                      endforeach;                     
                    $review_count = count($reviews);       //total number of reviews per video game   
          		    $review_average = $review_value_total / $review_count; //average review for video game ?>
            		<p><b>Average Review:</b> <?php echo $review_average_f = number_format($review_average , 2); ?></p>  
            		
            <?php } else { ?>
                    <p><b>Average Review:</b> <?php echo "No Reviews"; ?></p>                       
       <?php }?>
         
			<p><b>Quantity:</b> <input type="number"></p>
			
            <input type="submit" value="Add to Cart" />  
      </form>        
            
             <p><a href="../index.php">Menu</a></p>   
        </div>

    </section>
</main>
<?php include '../view/footer.php'; ?>