<?php
include("includes.php")

?>
<script type="text/javascript">
  var auth = localStorage.getItem("authentication");
  if (auth == "true"){
    window.location.href = 'index.php';
  }
</script>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <div class="navbar-brand" href="#">CDP ANALYTICS</div>
  </div>
</nav>
<hr>

<div class="form-control" style="width: 60%;margin-left: 250px;">
	<form id="login_form">
	  <div class="mb-3">
	    <label for="exampleInputEmail1" class="form-label">Email address</label>
	    <input type="email" class="form-control" name="exampleInputEmail1" aria-describedby="emailHelp">
	    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
	  </div>
	  <div class="mb-3">
	    <label for="exampleInputPassword1" class="form-label">Password</label>
	    <input type="password" class="form-control" name="exampleInputPassword1">
	  </div>
	  <button type="submit" id="su" class="btn btn-primary">Submit</button>
	</form>
</div>
<!-- </div> -->
<?php include("footer.php") ?>

<script>

$('#su').click(function(e){

	$.ajax({
		url: 'login_authenticate.php',
		type: 'POST',
		data: $('#login_form').serialize()
		}).done(function(response){
			// print(response);
      if (response == 'success') {
        localStorage.setItem("authentication", "true");
        window.location.href = 'index.php';
        // alert(response);
      }else{
        localStorage.removeItem("authentication");
        alert('Wrong Credentials Please Login Again!');
        // alert(response);
      }
		})
	return false;

})	
</script>