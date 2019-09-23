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

                <!-- Blog Categories Well -->
                <div class="well">
                    <?php

                        // Select all data from categoried
                        $query = "SELECT * FROM categories";
                        // Connect data for getting data from categories
                        $select_all_categories_query = mysqli_query($connect, $query);

                    ?>
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php

                                    // Fetch the category from categories table by associative array
                                    while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                                        $cat_title = $row["cat_title"];

                                        echo "<li><a href='#'>{$cat_title}</a></li>";
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