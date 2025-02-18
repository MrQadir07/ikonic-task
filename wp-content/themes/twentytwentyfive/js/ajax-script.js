jQuery(document).ready(function($) {
    $('#fetch-projects').on('click', function() {
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'GET',
            data: {
                action: 'fetch_architecture_projects'
            },
            success: function(response) {
                console.log(response); // Log the response to inspect it
                if (response.success) {
                    var projects = response.data.data; // Access the correct data property
                    if (Array.isArray(projects)) {
                        var output = '<ul>';
                        projects.forEach(function(project) {
                            output += '<li><a href="' + project.link + '">' + project.title + '</a></li>';
                        });
                        output += '</ul>';
                        $('#projects-result').html(output);
                    } else {
                        $('#projects-result').html('<p>Unexpected response format.</p>');
                    }
                } else {
                    $('#projects-result').html('<p>No projects found.</p>');
                }
            },
            error: function() {
                $('#projects-result').html('<p>An error occurred.</p>');
            }
        });
    });
});
