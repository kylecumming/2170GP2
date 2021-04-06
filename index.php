<?php
require_once "includes/header.php";
?>

<main class="container">
    <?php
    if (isset($_SESSION["submitted"])) {
        if ($_SESSION["submitted"] == 1) {
            echo "<div id= 'submitSuccess'>";
            echo "<h4>Your post was submitted successfully!</h4>";
            echo "</div>";
            $_SESSION["submitted"] = 0;
        }
    }
    ?>
    <div id="post-blog">
        <form class="input-form" action="includes/submit.php">
            <span class="username">RR</span>
            <label for="blog-posting" class="d-none">Write a blog</label>
            <textarea id="blog-posting" name="blog" rows="4" cols="50" placeholder="Tell me your mind...." maxlength="240"></textarea>
            <button type="submit" class="submit-post">Post</button>
            <!-- <input type="text" id="blog-posting" name="bolg" > -->
        </form>

    </div>
    <div id="feed">
        <?php require_once "includes/load-posts.php"; ?>
    </div>
</main>
<?php
require_once "includes/footer.php";
?>