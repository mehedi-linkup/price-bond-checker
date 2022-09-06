// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "lengthMenu": [500, 1000, 1500, 2000, 'All']
  });
});
