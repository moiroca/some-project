var abc = 0;      // Declaring and defining global increment variable.
$(document).ready(function() {
	//  To add new input file field dynamically, on click of "Add More Files" button below function will be executed.
	var counter = 0;
	$('#add_more').click(function() {
		$(this).before($("<div class='form-group well' >", {
			id: 'filediv'
			}).fadeIn('slow').append(
				$("<img/>", {
				src: base_url+"public/img/x.png",
				id: 'img',
				class: ++counter+"xxx"
				}).click(function() {
					$(this).parent().remove();
					}),
				$("<input/>", {
				name: 'file[]',
				type: 'file',
				id: 'file',
				class: "form-control"
				}),
				$("<input/>", {
				name: 'fileTitle[]',
				type: 'text',
				id: 'fileTitle',
				class: "form-control",
				placeholder: 'Title'
				}),
				$("<input/>", {
				name: 'fileDescription[]',
				type: 'text',
				id: 'fileDescription',
				class: "form-control",
				placeholder: 'Description'
				}),
				$("<input/>", {
				name: 'fileOtherInfo[]',
				type: 'text',
				id: 'fileOtherInfo',
				class: "form-control",
				placeholder: 'Other Information'
				})

		,$("</div>")));
	});
	$('.xxx').click(function(){
		$(this).parent().remove();
	});
	function imageIsLoaded(e) {
		$('#previewimg' + abc).attr('src', e.target.result);
	};
	$('#upload').click(function(e) {
		var name = $(":file").val();
		var id = $("#user_id").val();
		var fileType = $("input[name='fileFolder']:checked").val();
		if (fileType==1){	
			if ((!name) || (!id)) {
				alert("Image or Employee must be Selected!");
				e.preventDefault();
			}
		};
	});
	$('#gen-folder').click(function(){
		$('.ind-folder-div').fadeOut("slow");
	});
	$('#ind-folder').click(function(){
		$('#user_id').val("")
		$('.ind-folder-div').fadeIn("slow");
	});
});
function search(searchMe){
	var searchKey = document.getElementById('searchKey').value;
	$.ajax({
		url: base_url+"searchEmployee",
		type: "POST",
		data: {searchKey : searchKey, searchData : searchMe },
		success:function(response)
		{
			$("#user_id").html("");
			$("#user_id").append($('<option>',{
					value: "",
					text: "Please Select Employee"}));
			$.each(response,function(index,value){
				$("#user_id").append($('<option>',{
					value: value.id,
					text: value.last_name+ " " +value.first_name}));
			});
			// console.log(response);
		}
	});
}
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