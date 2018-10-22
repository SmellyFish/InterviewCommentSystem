<?php

class CommentManager
{
    /**
     * @var \Pimple\Container
     */
    private $container;

    /**
     * @param \Pimple\Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }
    
    /**
     * @param int $depth
     * @return Comment[]
     */
    public function getByDepth($depth)
    {
        $sql = 'SELECT id, authorName, commentBody, depth, createdAt, parentCommentId FROM `comments` WHERE depth = ? ORDER BY createdAt DESC';
        $statement = $this->container['databaseConnection']->prepare($sql);
        $statement->execute([$depth]);

        $comments = [];
        while ($row = $statement->fetch()) {
            $comments[] = (new Comment())->setId($row['id'])
                ->setAuthorName($row['authorName'])
                ->setCommentBody($row['commentBody'])
                ->setDepth($row['depth'])
                ->setCreatedAt($row['createdAt'])
                ->setParentCommentId($row['parentCommentId']);
        }
        return $comments;
    }
    
    /**
     * @param $id
     * @return Comment
     */
    public function getById($id)
    {
        $sql = 'SELECT id, authorName, commentBody, depth, createdAt, parentCommentId FROM `comments` WHERE id = ?';
        $statement = $this->container['databaseConnection']->prepare($sql);
        $statement->execute([$id]);

        $comment = new Comment();
        while ($row = $statement->fetch()) {
            $comment->setId($row['id'])
                ->setAuthorName($row['authorName'])
                ->setCommentBody($row['commentBody'])
                ->setDepth($row['depth'])
                ->setCreatedAt($row['createdAt'])
                ->setParentCommentId($row['parentCommentId']);
        }
        return $comment;
    }

    /**
     * @param $id
     * @return Comment[]
     */
    public function getByParentCommentId($id)
    {
        $sql = 'SELECT id, authorName, commentBody, depth, createdAt, parentCommentId FROM `comments` WHERE parentCommentId = ? ORDER BY createdAt DESC';
        $statement = $this->container['databaseConnection']->prepare($sql);
        $statement->execute([$id]);

        $comments = [];
        while ($row = $statement->fetch()) {
            $comments[] = (new Comment())->setId($row['id'])
                ->setAuthorName($row['authorName'])
                ->setCommentBody($row['commentBody'])
                ->setDepth($row['depth'])
                ->setCreatedAt($row['createdAt'])
                ->setParentCommentId($row['parentCommentId']);
        }
        return $comments;
    }

    /**
     * @param Comment $comment
     * @return Comment
     */
    public function insert($comment)
    {
        $sql = 'INSERT INTO comments (authorName, commentBody, depth, parentCommentId, createdAt) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP())';
        $statement = $this->container['databaseConnection']->prepare($sql);
        $statement->execute([
            $comment->getAuthorName(),
            $comment->getCommentBody(),
            $comment->getDepth(),
            $comment->getParentCommentId()
        ]);
        return $comment->setId($this->container['databaseConnection']->lastInsertId());
    }

    /**
     * @param Comment $comment
     * @return Comment
     */
    public function prepareCommentForInsert($comment)
    {
        $comment->setParentCommentId(intval($comment->getParentCommentId()));
        $parentComment = $this->getById($comment->getParentCommentId());
        $comment->setDepth($parentComment->getDepth() + 1);
        $comment->setAuthorName(htmlspecialchars($comment->getAuthorName()));
        $comment->setCommentBody(nl2br(htmlspecialchars($comment->getCommentBody())));
        
        return $comment;
    }

    /**
     * @param Comment $comment
     * @return array
     */
    public function validateCommentForInsert($comment)
    {
        $errors = [];
        // Sanity check
        if ($comment->getDepth() < 0) {
            $errors[] = 'There was a problem saving your comment. Please try again.';
        }
        
        if ($comment->getDepth() > 3) {
            $errors[] = 'Our system only allows comments three levels deep.';
        }
        
        // Check that the comment we're supposedly commenting on exists
        if (!empty($comment->getParentCommentId())) {
            $parentComment = $this->getById($comment->getParentCommentId());
            if ($comment->getParentCommentId() != $parentComment->getId()) {
                $errors[] = 'The comment you are commenting on no longer exists.';
            }
        }
        
        if (empty(trim($comment->getAuthorName()))) {
            $errors[] = 'Comment author value is required. Please try again.';
        }

        if (empty(trim($comment->getCommentBody()))) {
            $errors[] = 'Comment body value is required. Please try again.';
        }
        return $errors;
    }
}
