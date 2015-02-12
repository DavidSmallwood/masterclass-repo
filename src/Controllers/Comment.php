<?php

namespace MasterClass\Controllers;

use MasterClass\Model\Comment as CommentModel;

class Comment {
    
    protected $commentModel;
    
    public function __construct(CommentModel $comment) {
        $this->commentModel = $comment;
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            die('not auth');
            header("Location: /");
            exit;
        }
        $params = array(
            'username' => $_SESSION['username'],
            'story_id' => intval($_POST['story_id']),
            'comment' => filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
            );
        $this->commentModel->createComment($params);
        header("Location: /story?id=" . $params['story_id']);
    }
    
}