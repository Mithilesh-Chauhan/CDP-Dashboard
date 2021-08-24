<?php
include("includes.php")
?>
<nav class="navbar navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CDP ANALYTICS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Events Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Conversions Data</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">#####</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<hr>

<div class="container">

<div class="col-md-2"></div>		
		
<div class="col-md-8">		
<form id="data-form" >

 <label style="width: 100%;">
    <h6>Start Date</h6> 
    <input class="form-control" id="start_date" type="date" name="start_date" value="Today" style="width: 40%;" />
  </label>
 <br/>
 <br/>
  <label style="width: 100%;">
    <h6 >End Date</h6> 
    <input class="form-control" id="end_date" type="date" name="end_date" data-value="7" value="After one week" style="width: 40%;"/>
  </label>
  <br/>
  <br/>
  <div class="input-group mb-3" style="width: 100%;">
	  <label style="width: 13%;" class="input-group-text" for="inputGroupSelect01">You Want: </label>
	  <select class="form-select" style="max-width:200px;" id="kpi" name="kpi">
	    <option value="channels">Channel Wise Data</option>
	    <option value="source">Source Wise Data</option>
	    <option value="td_ip_city_name">City Wise Data</option>
	    <option value="td_path">Path Wise Data</option>
	  </select>
	</div>
</form>
<button id="su" class="btn btn-primary" type="button">Submit</button>
</div>
</div>
<div class="col-md-2"></div>
<?php include("footer.php") ?>

<script>

$('#su').click(function(e){

	$.ajax({
		url: 'data_filter.php',
		type: 'POST',
		data: $('#data-form').serialize()
		}).done(function(){
			alert('success!')
		})

})	
</script>