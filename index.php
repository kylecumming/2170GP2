<!doctype html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>JediTweeps</title>
	
		<!-- Bootstrap core CSS -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">	

		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/style.css">

        <?php
        include_once "includes/header.php";
        ?>
  	</head>
    <body>
        <main class="container">
        <?php
           if($_SESSION["submitted"] == 1){
                echo "<div id= 'submitSuccess'>";
                echo "<h4>Your post was submitted successfully!</h4>";
                echo "</div>";
                $_SESSION["submitted"] = 0;
        }
        ?>
        <div id="post-blog">
            <form class="input-form" action="includes/submit.php">
            <span class="username">RR</span>
                <lable for="blog-posting" class="d-none">Write a blog</lable>
                <textarea id="blog-posting" name="blog" rows="4" cols="50"  placeholder="Tell me your mind...." maxlength="240"></textarea>
                <button type="submit" class="submit-post">Post</button>
                <!-- <input type="text" id="blog-posting" name="bolg" > -->
            </form>

        </div>
        <div id="feed">
            <?php require_once "includes/load-posts.php"; ?>
        </div>
        </main>
        <footer class="py-5 footer">
			<div class="container">
			
				<p class="mb-1">&copy; 2021 JediTweeps Inc.</p>
			</div>
		</footer>

		
    </body>
</html>