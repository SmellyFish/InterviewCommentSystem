<div class="baseReplyContainer">
    <span>
        <button type="button" class="btn btn-default replyButton" id="replyButtonBase" data-toggle="collapse" href="#replyCommentBase" aria-expanded="false" aria-controls="collapseExample">Leave Comment</button>
    </span>
    <div class="collapse commentFormContainer" id="replyCommentBase">
        <form>
            <input type="hidden" name="parentCommentId" value="" />
            
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" class="form-control" name="authorName" />
            </div>
            <div class="form-group">
                <label for="comment">Your Comment</label>
                <textarea name="commentBody" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Send</button>
        </form>
    </div>
</div>
<div class="media-list">
    <?php
    foreach ($currentComments as $currentComment) {
        include 'templates/comment.partial.tem.php';
    } ?>
</div>
