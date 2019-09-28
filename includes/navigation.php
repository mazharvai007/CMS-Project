    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">

            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CMS Project</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 
                    
                        // Select all data from categoried
                        $query = "SELECT * FROM categories";
                        // Connect data for getting data from categories
                        $select_all_categories_query = mysqli_query($connect, $query);

                        // Fetch the category from categories table by associative array
                        while ($row = mysqli_fetch_assoc($select_all_categories_query)) {
                            $cat_title = $row["cat_title"];

                            echo "<li><a href='#'>{$cat_title}</a></li>";
                        }
                    
                    ?>
                    <li><a href="admin">Admin</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>