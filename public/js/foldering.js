function saveFolder(id)
{
	bootbox.prompt("Enter Name of Folder", function(result) {                
	  
		if((result !== null) && (result.length !== 0))
		{
			$.ajax({
				type: "POST",
				url: base_url+"secretary/saveFolder",
				data: {name:result,folder_id:id},
				success: function(result){
					bootbox.alert("Folder Created!");
				}
			});
		}
		else		
		{
			bootbox.dialog({
			  message: "No folder Name. No folder created.",
			  title: "Warning:",
			  buttons: {
				danger: {
				  label: "Ok",
				  className: "btn-danger"
				}
			  }
			});
		}
	});
	
	
}