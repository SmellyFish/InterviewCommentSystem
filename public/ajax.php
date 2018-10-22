<?php
require_once '../conf/bootstrap.php';

$action = $_POST['action'];
    
switch ($action) {
    case 'saveComment':
        $comment = (new Comment())
            ->setAuthorName($_POST['authorName'])
            ->setCommentBody($_POST['commentBody'])
            ->setParentCommentId($_POST['parentCommentId']);
        
        $commentManager = new CommentManager($container);
        $comment = $commentManager->prepareCommentForInsert($comment);
        if ($errors = $commentManager->validateCommentForInsert($comment)) {
            echo json_encode([
                'status' => 'error',
                'errors' => $errors
            ]);
        } else {
            $comment = $commentManager->insert($comment);
            
            // Get markup for the element
            $currentComment = $comment;
            ob_start();
            include 'templates/comment.partial.tem.php';
            $markup = ob_get_clean();
            
            echo json_encode([
                'status' => 'success',
                'comment' => [
                    'id' => $comment->getId(),
                    'authorName' => $comment->getAuthorName(),
                    'commentBody' => $comment->getCommentBody(),
                    'markup' => $markup
                ]
            ]);
        }
        break;
}
