function deleteConfirm(id)
{
	bootbox.confirm("Are you sure want to delete this Office?", function(result) {
		if(result)
			window.location.href = base_url+"deleteOffice?id="+id;
	}); 
}
function editOffice(id, description)
{
	bootbox.prompt("Rename <strong>"+description+"</strong> to: ", function(result) {
		if(result)
			window.location.href = base_url+"editOffice?id="+id+"&description="+result;
	});
}

$(document).ready(function(e) {
   
});


