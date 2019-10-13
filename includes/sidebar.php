            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control">
                            <span class="input-group-btn">
                                <button name="submit" class="btn btn-default" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- User Login -->
                <div class="well">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                    } else { ?>
                        <h4>Login</h4>
                        <form action="includes/login.php" method="post">
                            <div class="form-group">
                                <input type="text" name="login_user" class="form-control" id="login_user" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" name="login_password" class="form-control" id="login_password" placeholder="Password">
                            </div>
                            <button type="submit" name="sign_in" class="btn btn-primary">Login</button>
                        </form>
                    <?php


                    }
                    ?>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <?php

                        // Select all data from categoried
                        $query = "SELECT * FROM categories";
                        // Connect data for getting data from categories
                        $select_categories_sidebar = mysqli_query($connect, $query);

                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php

                                    // Fetch the category from categories table by associative array
                                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)) 
                                    {
                                        $cat_id = $row["cat_id"];
                                        $cat_title = $row["cat_title"];

                                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                                    }                                
                                
                                ?>                                
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <?php 
                    include("includes/widget.php");
                ?>

            </div>