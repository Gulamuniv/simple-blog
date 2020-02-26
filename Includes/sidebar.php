 <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">
              <img src="images/bZNdOA2s.png" class="d-block img-fluid mb-3" alt="">
              <div class="text-center">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-dark text-light">
              <h2 class="lead">Sign Up !</h2>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button">Join the Forum</button>
              <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-primary text-light">
              <h2 class="lead">Categories</h2>
              </div>
              <div class="card-body">
                <?php
                $sql = "SELECT *FROM category ORDER BY id DESC";
                $result =mysqli_query($conn,$sql);
                if (mysqli_num_rows($result)>0) {
                  while ($dataRows= mysqli_fetch_assoc($result)) {
                    $CategoryId = $dataRows['id'];
                    $CategoryTitle =$dataRows['title'];
                 
                 ?>
                <a href="Blog.php?category=<?php echo $CategoryTitle;?>"> <span class="heading"> <?php echo $CategoryTitle;?></span> </a><br>
               <?php }}?>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-info text-white">
              <h2 class="lead"> Recent Posts</h2>
            </div>
            <div class="card-body">
              <?php
               $sql = "SELECT *FROM posts ORDER BY id DESC LIMIT 0,4";
               $result = mysqli_query($conn,$sql);
               if (mysqli_num_rows($result)>0) {
                 while ($data = mysqli_fetch_assoc($result)) {
                    $Id  =$data['id'];
                   $DateTime  =$data['datetime'];
                   $Title  =$data['title'];
                   $Images  =$data['image'];
              
              ?>
              <div class="media">
                <img src="Uploads/<?php echo htmlentities($Images);?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="FullPost.php?id=<?php echo $Id;?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title);?></h6> </a>
                  <p class="small"><?php echo htmlentities($DateTime);?></p>
                </div>
              </div>
              <hr>
              <?php }}?>
              
              
            </div>
          </div>
 
        </div>