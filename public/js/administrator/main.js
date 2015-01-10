function deleteConfirm(id)
{
	bootbox.confirm("Are you sure want to delete this Office?", function(result) {
		if(result)
			window.location.href = base_url+"deleteOffice?id="+id;
	}); 
}
$(document).ready(function(e) {
   
});