// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    "lengthMenu": [100, 150, 1500, 2000, 'All']
  });
});
