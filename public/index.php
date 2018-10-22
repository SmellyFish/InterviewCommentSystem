<?php
require_once '../conf/bootstrap.php';
// Get the top level comments. These are the website comments, not comment comments
$currentComments = (new CommentManager($container))->getByDepth(1);
include 'templates/header.tem.php';
include 'templates/comments.tem.php';
include 'templates/footer.tem.php';
