function all() 
{
	// Ajax config
	$.ajax({
        type: "GET", //we are using GET method to get all record from the server
        url: 'all.php', // get the route value
        success: function (response) {//once the request successfully process to the server side it will return result here

            // Parse the json result
        	response = JSON.parse(response);

        	var html = "";
            // Check if there is available records
        	if(response.length) {
        		html += '<div class="list-group">';
	            // Loop the parsed JSON
        		$.each(response, function(key,value) {
	            	// Our employee list template
        			html += '<a href="#" class="">';
        			html += "<p>" + value.first_name +' '+ value.last_name + " <span class='list-email'>(" + value.email + ")</span>" + "</p>";
        			html += "<p class='list-address'>" + value.address + "</p>";
        			html += "<button class='btn btn-sm btn-primary mt-2' data-toggle='modal' data-target='#edit-employee-modal' data-id='"+value.id+"'>Edit</button>";
        			html += '</a>';   
        		});
        		html += '</div>';
        	} else {
        		html += '<div class="alert alert-warning">';
        		html += 'No records found!';
        		html += '</div>';
        	}



            // Insert the HTML Template and display all employee records
        	$("#employees-list").html(html);
        }
    });
}

function save() 
{
	$("#btnSubmit").on("click", function() {
		var $this 		    = $(this); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#form"; //defined the #form ID
        var formData        = $(form).serializeArray(); //serialize the form into array
        var route 			= $(form).attr('action'); //get the route using attribute action

        // Ajax config
        $.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	        	$this.attr('disabled', true).html("Processing...");
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	        	$this.attr('disabled', false).html($caption);

	            // Reload lists of employees
	        	all();

	            // We will display the result using alert
	        	alert(response);

	            // Reset form
	        	resetForm(form);
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
    });
}

function resetForm(selector) 
{
	$(selector)[0].reset();
}


function get() 
{
	$(document).delegate("[data-target='#edit-employee-modal']", "click", function() {

		var employeeId = $(this).attr('data-id');

		// Ajax config
		$.ajax({
	        type: "GET", //we are using GET method to get data from server side
	        url: 'get.php', // get the route value
	        data: {employee_id:employeeId}, //set data
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click

	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	        	response = JSON.parse(response);
	        	$("#edit-form [name=\"id\"]").val(response.id);
	        	$("#edit-form [name=\"email\"]").val(response.email);
	        	$("#edit-form [name=\"first_name\"]").val(response.first_name);
	        	$("#edit-form [name=\"last_name\"]").val(response.last_name);
	        	$("#edit-form [name=\"address\"]").val(response.address);
	        }
	    });
	});
}

function update() 
{
	$("#btnUpdateSubmit").on("click", function() {
		var $this 		    = $(this); //submit button selector using ID
        var $caption        = $this.html();// We store the html content of the submit button
        var form 			= "#edit-form"; //defined the #form ID
        var formData        = $(form).serializeArray(); //serialize the form into array
        var route 			= $(form).attr('action'); //get the route using attribute action

        // Ajax config
        $.ajax({
	        type: "POST", //we are using POST method to submit the data to the server side
	        url: route, // get the route value
	        data: formData, // our serialized array data for server side
	        beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
	        	$this.attr('disabled', true).html("Processing...");
	        },
	        success: function (response) {//once the request successfully process to the server side it will return result here
	        	$this.attr('disabled', false).html($caption);

	            // Reload lists of employees
	        	all();

	            // We will display the result using alert
	        	alert(response);

	            // Reset form
	        	resetForm(form);

	            // Close modal
	        	$('#edit-employee-modal').modal('toggle');
	        },
	        error: function (XMLHttpRequest, textStatus, errorThrown) {
	        	// You can put something here if there is an error from submitted request
	        }
	    });
    });
}


$(document).ready(function() {

	// Get all employee records
	all();

	// Submit form using AJAX To Save Data
	save();

	// Get the data and view to modal
	get();

	// Updating the data
	update();
});