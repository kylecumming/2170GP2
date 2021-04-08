<!-- Added some of the element and classes to work with using CSS : Sahil Sorathiya B00838439
I learned some of the elements of bootstrap and how to work with CSS on multiple pages together. Also refreshed my css knowledge -->

<footer class="py-5 footer">
	<div class="container">
		<p class="float-end mb-1">
			<a href="#">Back to top</a>
		</p>
		<p class="mb-1">&copy; 2021 JediTweeps Inc.</p>
	</div>
</footer>

<!-- Copied from starter code given for assignment 3 by Dr. Raghav Sampangi 
    Accessed On 31 March, 2021
    Bootstrap core on java -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>


</html>
<?php
//closing db at end of page
if (isset($dbconnection)) {
	$dbconnection->close();
}
?>