<nav>
	<ul>
<!-- display links for all video games -->
	<?php if (!empty($video_games) && isset($video_games) && is_array($video_games)) {?>
         <?php foreach ($video_games as $video_game) : ?>
         <li><a href=".?video_game_id=<?php echo htmlspecialchars($video_game['videoGameID']); ?>">
                 <?php echo htmlspecialchars($video_game['videoGameName']); ?>
             </a>
         </li>
         <?php endforeach; ?>
     <?php }?>
     </ul>
</nav>