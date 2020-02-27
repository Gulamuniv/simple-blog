 <nav>
 	 <div style="margin-left: 200px;">
            <ul class="pagination pagination-lg pagination">
              <!-- Creating Backward Button -->
              <?php if(isset($Page) ) {
                if ( $Page>1) {?>
             <li class="page-item">
                 <a href="index.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
           
            $sql           = "SELECT COUNT(*) FROM posts";
            $resultsCount   =mysqli_query($conn,$sql);
            $RowPagination = mysqli_fetch_assoc($resultsCount);
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/2;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if(isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="index.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="index.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if (isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="index.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
            </div>
          </nav>