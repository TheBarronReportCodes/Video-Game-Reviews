<h2>Directory</h2>
<table>
      <tr>
          <th>Video Game ID</th>
          <th>Studio</th>
          <th>System</th>
      </tr>
            
    <?php foreach ($video_games as $videogame) : ?>
       <tr>
          <td><?php echo htmlspecialchars($videogame['videoGameID']); ?></td>
          <td><?php echo htmlspecialchars($videogame['videoGameStudio']); ?></td>
          <td><?php echo htmlspecialchars($videogame['systemName']); ?></td>
       </tr>
    <?php endforeach; ?>
</table>
