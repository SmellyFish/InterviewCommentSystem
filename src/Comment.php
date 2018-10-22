<?php

class Comment
{
    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $commentBody;
    
    /**
     * @var string
     */
    private $createdAt;
    
    /**
     * @var string
     */
    private $depth;

    /**
     * @var string
     */
    private $id;
    
    /**
     * @var string
     */
    private $parentCommentId;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return Comment
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param string $authorName
     * @return Comment
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
     * @return string
     */
    public function getCommentBody()
    {
        return $this->commentBody;
    }

    /**
     * @param string $commentBody
     * @return Comment
     */
    public function setCommentBody($commentBody)
    {
        $this->commentBody = $commentBody;
        return $this;
    }

    /**
     * @return string
     */
    public function getDepth()
    {
        return $this->depth;
    }

    /**
     * @param string $depth
     * @return Comment
     */
    public function setDepth($depth)
    {
        $this->depth = $depth;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Comment
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getParentCommentId()
    {
        return $this->parentCommentId;
    }

    /**
     * @param string $parentCommentId
     * @return Comment
     */
    public function setParentCommentId($parentCommentId)
    {
        $this->parentCommentId = $parentCommentId;
        return $this;
    }
}
