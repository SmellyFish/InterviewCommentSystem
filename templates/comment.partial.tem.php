<div class="media">
    <div class="media-left"></div>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $currentComment->getAuthorName(); ?></h4>
        <p><?php echo $currentComment->getCommentBody(); ?></p>
        <?php if ($currentComment->getDepth() < 3) { ?>
            <div class="comment-meta">
                <span>
                    <button type="button" class="btn btn-default replyButton" id="replyButton<?php echo $currentComment->getId(); ?>" data-toggle="collapse" href="#replyComment<?php echo $currentComment->getId(); ?>" aria-expanded="false" aria-controls="collapseExample">Reply</button>
                </span>
                <div class="collapse commentFormContainer" id="replyComment<?php echo $currentComment->getId(); ?>">
                    <form>
                        <input type="hidden" name="parentCommentId" value="<?php echo $currentComment->getId(); ?>" />
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
            
            <div class="comment-comments">
            <?php
                foreach ((new CommentManager($container))->getByParentCommentId($currentComment->getId()) as $currentComment) {
                    include 'templates/comment.partial.tem.php';
                } 
            ?>
            </div>
        <?php } ?>
    </div>
</div>