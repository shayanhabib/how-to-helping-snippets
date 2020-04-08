
<?php require_once("header.php"); ?>

  <div class="row">
    <div class="col-lg-8">
    	
        <?php  
				//original content
				$newsqryy = mysqli_query($db, "select * from news_events");
				if($newsqryy){
						$newsqryyfetch = mysqli_fetch_array($newsqryy); 
						$cntent =  $newsqryyfetch['description']; 
						
				} 
				//echo $cntent;
				
				//artist name for match
				$artistsss = mysqli_query($db, "select * from artists");
				for($l = 1; $l<=mysqli_num_rows($artistsss); $l++ ){
						$artistsssfetch = mysqli_fetch_array($artistsss); 
						$artists_name[] =  $artistsssfetch['name']; 
						
				} 
				
				//movie name for match
				$moviessss = mysqli_query($db, "select * from movies");
				for($d = 1; $d<=mysqli_num_rows($moviessss); $d++ ){
						$moviessssfetch = mysqli_fetch_array($moviessss); 
						$moviessss_name[] =  $moviessssfetch['name']; 
						
				} 
				
				//matching and showing new content 
				//var_dump($artists_name);
				
				$i = 0;
				$len = count($artists_name);
				foreach($artists_name as $str => $val){
					//echo $val;
					if (strpos($cntent, $val) !== false) {
						$cntent = str_replace($val, '<a href="search.php?artist_name='.$val.'">'.$val.'</a>', $cntent);
						if ($i == $len - 1){
							//echo $i;
							$content_fetch_after_matching_artist =  $cntent;
							//echo $cntent; 
						}
					}  
					$i++;
				}
				echo $content_fetch_after_matching_artist;
				//var_dump($moviessss_name);
				 
				/*$h = 0;
				$len2 = count($moviessss_name);
				foreach($moviessss_name as $strrr => $valll){
					//echo $valll;
					//echo $content_fetch_after_matching_artist;
					if (strpos($content_fetch_after_matching_artist, $valll) !== false) {
						$cntenttttt = str_replace($valll, '<a href="'.$valll.'">'.$valll.'</a>', $content_fetch_after_matching_artist);
						//echo $cntenttttt; 
						if ($h == $len2 - 1){
							//echo $h;
							echo $cntenttttt;
						}
					}   
					$h++;
				}*/
				
				
		?>
        
    </div>
    <div class="col-lg-4">
    	<h3>User Polls</h3>
        <div class="list-group"> 
          <?php 
				$qury = mysqli_query($db, "select * from movie_polls");
				for($j=1;$j<=mysqli_num_rows($qury);$j++) {
					$quryfetch = mysqli_fetch_array($qury);
					echo "<a href='polling.php?question=".$quryfetch['id']."' class='list-group-item'>".$quryfetch['question']."</a>";
				}
			?>
        </div>
        <h3>Like Us On Facebook</h3>
         
    </div>
    <div class="clearfix"></div>
  </div>
  <hr>
  
<?php require_once("footer.php"); ?>