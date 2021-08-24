<?php
include("includes.php");

?>
<script type="text/javascript">
  var auth = localStorage.getItem("authentication");
  if (auth != "true"){
    window.location.href = 'login_Page.php';
  }
</script>

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
	<?php include('report_filter_section.php'); ?>
</div>

<div class="container">

<table class="table" id="dataTable">
  <thead>
    <tr>
      <!-- <th scope="col">Month</th> -->
      <th scope="col">Source</th>
      <th scope="col">Users</th>
      <th scope="col">Sessions</th>
      <th scope="col">Sessions</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

</div>

<!-- </div> -->
<?php include("footer.php") ?>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>

<script>
var dataTable = undefined;

$('#getReport').click(function(e){
  // localStorage.clear();

      localStorage.setItem('startDate',$('#startDate').val());
      localStorage.setItem('endDate',$('#endDate').val());
      localStorage.setItem('channel',$('#channel').val());

      dataTable.ajax.url('get_data.php?startDate='+localStorage.getItem('startDate')+'&endDate='+localStorage.getItem('endDate')+'&channel='+localStorage.getItem('channel'));
      dataTable.ajax.reload();

    return false;

})  


$(document).ready(function() {

dataTable = $('#dataTable').DataTable({
          'processing': true,
          'serverSide': true,
          'paging': false,
          'pageLength': 20,
          'lengthChange': false,
          'searching': false,
          'ordering': false,
          'responsive': true,
          'info': true,
          'autoWidth': false,
          "deferLoading": 1,
          "pageLength": 1,
          'language':{
                        'processing': '<i class="fa fa-spinner fa-spin fa-2x fa-fw" style="border:none;"></i>',
                        'emptyTable': function(data, type, row){
                            if(data == 0){
                                return 'No data is available';
                            }
                        }
                    },
          'columnDefs': [
	          // {
	          //   'render': function(data, type, row) {
           //        return row['Month'];         
	          //   },
	          //   'targets': 0,
	          //   'sortable': false,
	          // },
              {
                'render': function(data, type, row) {
                  return row['source'];         
                },
                'targets': 0
              },
              {
                'render': function(data, type, row) {
                  return row['users'];         
                },
                'targets': 1
              },
              {
                'render': function(data, type, row) {
                  return row['sessions'];         
                },
                'targets': 2
              },
              {
                'render': function(data, type, row) {
                  return row['sessions'];         
                },
                'targets': 2
              },
              ],
              'ajax': {
                // url: 'get_data.php'+location.search,
                url: 'get_data.php?startDate='+localStorage.getItem('startDate')+'&endDate='+localStorage.getItem('endDate')+'&channel='+localStorage.getItem('channel'),
                // url: 'get_data.php?startDate='+$('#startDate').val()+'&endDate='+$('#endDate').val(),
                type: 'get',
                // data:$('#reportFilterForm').serialize(),
                error: function() {
                  $('.employee-grid-error').html('');
                  $('#competitor_promo').append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                  $('#employee-grid_processing').css('display', 'none');

                }
              },

            });
});
	
</script>