
<?php
      $sql2 = mysqli_query($conn, "SELECT * FROM url ORDER BY id DESC");
      if(mysqli_num_rows($sql2) > 0){;
        ?>
          <div class="statistics">
            <?php
              $sql3 = mysqli_query($conn, "SELECT COUNT(*) FROM url");
              $res = mysqli_fetch_assoc($sql3);

              $sql4 = mysqli_query($conn, "SELECT clicks FROM url");
              $total = 0;
              while($count = mysqli_fetch_assoc($sql4)){
                $total = $count['clicks'] + $total;
              }
              
  include "php/config.php";
  $new_url = "";
  if(isset($_GET)){
    foreach($_GET as $key=>$val){
      $u = mysqli_real_escape_string($conn, $key);
      $new_url = str_replace('/', '', $u);
    }
      $sql = mysqli_query($conn, "SELECT full_url FROM url WHERE shorten_url = '{$new_url}'");
      if(mysqli_num_rows($sql) > 0){
        $sql2 = mysqli_query($conn, "UPDATE url SET clicks = clicks + 1 WHERE shorten_url = '{$new_url}'");
        if($sql2){
            $full_url = mysqli_fetch_assoc($sql);
            header("Location:".$full_url['full_url']);
          }
      }
  }
            ?>
            <span>Total Links: <span><?php echo end($res) ?></span> & Total Clicks: <span><?php echo $total ?></span></span>
            <a href="php/delete.php?delete=all">Clear All</a>
        </div>
        <div class="urls-area">
          <div class="title">
            <li>Shorten URL</li>
            <li>Original URL</li>
            <li>Clicks</li>
            <li>Action</li>
          </div>
          <?php
            while($row = mysqli_fetch_assoc($sql2)){
              ?>
                <div class="data">
                <li>
                  <a href="<?php echo $domain.$row['shorten_url'] ?>" target="_blank">
                  <?php
                    if($domain.strlen($row['shorten_url']) > 50){
                      echo $domain.substr($row['shorten_url'], 0, 50) . '...';
                    }else{
                      echo $domain.$row['shorten_url'];
                    }
                  ?>
                  </a>
                </li> 
                <li>
                  <?php
                    if(strlen($row['full_url']) > 60){
                      echo substr($row['full_url'], 0, 60) . '...';
                    }else{
                      echo $row['full_url'];
                    }
                  ?>
                </li> 
              </li>
                <li><?php echo $row['clicks'] ?></li>
                <li><a href="php/delete.php?id=<?php echo $row['shorten_url'] ?>">Delete</a></li>
              </div>
              <?php
            }
          ?>
      </div>
        <?php
      }
    ?>
  