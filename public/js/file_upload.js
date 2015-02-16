var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
	//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
	$('#add_more').click(function() {
		$(this).before($("<center style='margin-bottom:10px;'><div/>", {
		id: 'filediv'
		}).fadeIn('slow').append($("<input/>", {
		name: 'file[]',
		type: 'file',
		id: 'file',
		class: "form-control"
		}), $("</center>")));
	});
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	$('#upload').click(function(e) {
		var name = $(":file").val();
		var id = $("#user_id").val();
		if ((!name) || (!id)) {
			alert("Image or Employee must be Selected!");
			e.preventDefault();
		}
	});
});

function deleteFile(file_id, name_in_folder, folder_id){
	bootbox.confirm("Are you sure you want to delete this file?", function(result) {          
		if(result)
		{
			$.ajax({
				type: "POST",
				url: base_url+"secretary/fileDelete",
				data: {name:name_in_folder,file_id:file_id},
				beforeSend: function() {
                      $("#loader").show();
				},
				success: function(result){
					$("#loader").hide();
					bootbox.alert("File Deleted!");
					window.location.href=base_url+"createFolder?folder_id="+folder_id;
					
				}
			});
		}
		else		
		{
			bootbox.dialog({
			  message: "File not deleted.",
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