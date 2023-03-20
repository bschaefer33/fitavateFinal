// Wait for the document to finish loading
$(document).ready(function() {
    // Attach a submit event listener to the form with ID 'user_form'
    $('#loginForm').submit(function(e) {
        // Prevent the default form submission behavior
        e.preventDefault();
        
        // Submit the form data via AJAX
        $.ajax({
            // Use a POST request
            type: 'POST',
            // Submit the form data to this URL
            url: 'fitavateMVC/App/Models/backend.php',
            // Serialize the form data and send it as the payload
            data: $('#loginForm').serialize(),
            // If the request is successful, do the following
            success: function(response) {
                // Reset the form inputs
                $('#loginForm')[0].reset();
                // Redirect to the login page
                window.location.href = "index.php";
            },
            // If there's an error, log it to the console
            error: function(error) {
                console.log(error);
            }
        });
    });
});
