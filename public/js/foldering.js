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
					var con = bootbox.alert("Folder Created!");
					if(id != null)
						window.location.href=base_url+"createFolder?folder_id="+id;
					else
						window.location.href=base_url+"createFolder";
					
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
function saveFile(id)
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

$(document).ready(function()
{
	$(".delete").on("click",function($this)
	{
		//alert($this);
	});
});
function deleteFolder($folder_id,$parent_id)
{
	bootbox.confirm("Are you sure you want to delete this folder?", function(result) {
	  if(result)
	  {
		  $.ajax({
				type: "POST",
				url: base_url+"administrator/deleteFolder",
				data: {folder_id:$folder_id},
				success: function(result){
					if($parent_id != null)
						window.location.href=base_url+"createFolder?folder_id="+$parent_id;
					else
						window.location.href=base_url+"createFolder";
				}
			});
	  }
	}); 
	return false;
}