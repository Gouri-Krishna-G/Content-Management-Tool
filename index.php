<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Blog Post</title>
    <link rel="stylesheet" type="text/css" href="../index.css" media="screen" />
    <script src="index.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/19c75da57a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
        // Include database connection
        include('./include/db.php');

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            


            $title = $_POST['title'];
            $content = $_POST['content'];
            $image_url = $_POST['image_url'];
            $video_url = $_POST['video_url'];

            // Display the post details dynamically using JavaScript
            echo "<div class='card blogcard'>" .
                "<div class='card-header'>" .
                "<h1 class='blogp'><b>BLOG</b></h1>".
                "<h3 class='card-title'><b>Title: </b>" . $title . "</h3>" .
                "</div>" .
                "<div class='card-body'>" .
                "<p><b>Content: </b><br>" . $content . "</p>";
            
            
            if ($_FILES['image']['tmp_name']) {
                $image_url = "./image/" . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], $image_url);
                echo "<p><b>Image: </b><br></p>".
                "<img src='" . $image_url . "' alt='Uploaded Image'>";
            }

            // Handle video upload
            
            if ($_FILES['video']['tmp_name']) {
                $video_url = "./video/" . $_FILES['video']['name'];
                move_uploaded_file($_FILES['video']['tmp_name'], $video_url);
                echo "<p><b>Video: </b><br></p>". 
                "<video width='320' height='240' controls>" .
                "<source src='" . $video_url . "' type='video/mp4'>" .
                "Your browser does not support the video tag." ."</video>";
            }
            

            echo "</div></div>";

            // Insert data into the database
            $query = "INSERT INTO blog_posts (title, content, image_url, video_url) VALUES ('$title', '$content', '$image_url', '$video_url')";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                echo "Error: " . mysqli_error($conn);
            }
        }
    ?>
    <br>
    <br>
    <h1 class="blogp">Create a New Blog Post</h1>
    <form action="?" method="post" enctype="multipart/form-data">
        <div class="card">
                <div class="input-section">
                    <b><label for="title">Title:</label></b> <br />
                    <input class="input " type="text" name="title" id="title" placeholder="Enter title"> <br />
                    <br>
                    <b><label for="content">Content:</label></b> <br />
                    <input class="input" id="content" name="content" placeholder="Enter content" />
                </div>
                <br>
                <div class="input-section">
                    <b><label class="label-section" for="image">Image:</label></b>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                <br>
                <div class="input-section">
                    <b><label class="label-section" for="video">Video:</label></b>
                    <input type="file" id="video" name="video" accept="video/*">
                </div>
        </div>

        <div class="button-section ">
            <button class="button submit">Submit</button>
        </div>

    </form>
    
    
</body>
</html>

