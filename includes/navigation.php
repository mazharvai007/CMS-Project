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
                <a class="navbar-brand" href="../CMS-Project">CMS Project</a>
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
                            $cat_id = $row["cat_id"];
                            $cat_title = $row["cat_title"];

                            $cat_class = '';
                            $registration_class = '';
                            $registration_page = 'registration.php';
                            $contact_class = '';
                            $contact_page = 'contact.php';
                            $pageName = basename($_SERVER['PHP_SELF']);

                            if (isset($_GET['category']) && $_GET['category'] == $cat_id) {
                                $cat_class = 'active';
                            } else if ($pageName == $registration_page) {
                                $registration_class = 'active';
                            } else if ($pageName == $contact_page) {
                                $contact_class = 'active';
                            }

                            echo "<li class='$cat_class'><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                            //echo "<li class='$cat_class'><a href='../category/$cat_id'>{$cat_title}</a></li>";
                        }
                    
                    ?>
                    <li class="<?php echo $contact_class; ?>"><a href="contact.php">Contact</a></li>

                    <?php if (isLoggedIn()): ?>
                        <li><a href="admin">Admin</a></li>
                        <li><a href="includes/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li class='$registration_class'><a href='registration.php'>Registration</a></li>
                    <?php endif; ?>


                    <?php
                        if (isset($_SESSION['user_role'])) {
                            if (isset($_GET['p_id'])) {
                                $the_post_id = $_GET['p_id'];
                                echo "<li><a href='admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                                //echo "<li><a href='../admin/posts.php?source=edit_post&p_id={$the_post_id}'>Edit Post</a></li>";
                            }
                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>