$(document).ready(function() {
    $('.container').on('click', '.commentFormContainer button[type="submit"]', function(e){
        e.preventDefault();
        
        // Are we commenting on the web page or another comment?
        var $parentMediaContainer = $(this).parents('div.media').first();
        if ($parentMediaContainer.length == 0) {
            // Commenting on web page
            var $markupTarget = $('.media-list');
        } else {
            // Commenting on comment
            var $markupTarget = $parentMediaContainer.find('.comment-comments').first();
        }
        
        var $parentForm = $(this).parents('form');
        // Delete old error messages
        $parentForm.children('.alert').remove();
        var authorName = $parentForm.find('input[name="authorName"]').val();
        var parentCommentId = $parentForm.find('input[name="parentCommentId"]').val();
        var commentBody = $parentForm.find('textarea[name="commentBody"]').val();

        $.ajax({
            url: "ajax.php",
            type: "POST",
            data: {
                'action': 'saveComment',
                'authorName': authorName,
                'commentBody': commentBody,
                'parentCommentId': parentCommentId
            },
            success: function(data){
                data = JSON.parse(data);
                
                if (data.status == 'success') {
                    // Handle success
                    
                    // Clean up and hide the comment form
                    $parentForm.find('input[name="authorName"]').val('');
                    $parentForm.find('textarea[name="commentBody"]').val('');
                    if (parentCommentId > 0) {
                        // This was a comment for a comment
                        $('#replyButton' + parentCommentId).click();
                    } else {
                        // This was a comment for the web page
                        $('#replyButtonBase').click();
                    }

                    $markupTarget.prepend($.parseHTML(data.comment.markup));
                } else {
                    // Handle errors
                    
                    var errors = data.errors;
                    errors.forEach(function(error) {
                        $parentForm.prepend($.parseHTML('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ' + error + '</div>')); 
                    });
                }
            }
        });
    });
});