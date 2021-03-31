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
  	</head>
    <body>
        <header>
        <!-- https://getbootstrap.com/docs/4.0/components/navbar/
            Created By: BootStrap 
            Accessed On: 31 March, 2021
        -->

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand app-name" href="#">Jedi<span class="yellow">Tweeps</span></a>
                
                    <div class="collapse navbar-collapse" id="navbarText">                        
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">My Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Feeds</a>
                            </li>
                        </ul>
        
                    </div>
        
                    <div class="search-form">
                        <form method="post"> 
                
                            <lable for="srch" class="d-none">Search</lable>
                            <input type="text" id="srch" name="searchKeywords" placeholder="Search By">

                            <label for="searchBy" class="d-none">Choose a car:</label>
                            <select name="searchOption" id="searchBy">
                                <option value="name">Name</option>
                                <option value="uname">Username</option>
                            </select>
                
                        </form>
                
                    </div>
                    <ul class="navbar-nav mr-auto sign-in">
                        <li class="nav-link">
                            <a class="sign" href="#">Logout</a>
                        </li>
                        <li class="nav-link">
                            <a class="sign" href="#">Login</a>
                        </li>
                    </ul>  
                </div>
            </nav>
        </header>
        <main class="container">
        <div id="post-blog">
            <form class="input-form">
            <span class="username">RR</span>
                <lable for="blog-posting" class="d-none">Write a blog</lable>
                <textarea id="blog-posting" name="blog" rows="4" cols="50"  placeholder="Tell me your mind...." maxlength="240"></textarea>
                <button type="submit" class="submit-post">Post</button>
                <!-- <input type="text" id="blog-posting" name="bolg" > -->
            </form>

        </div>
            
        </main>
        <footer class="py-5 footer">
			<div class="container">
			
				<p class="mb-1">&copy; 2021 JediTweeps Inc.</p>
			</div>
		</footer>

		
    </body>
</html>
    
      