<?php

namespace MasterClass\Controllers;

use Aura\Web\Request;
use Aura\Web\Response;
use MasterClass\Model\Comment as CommentModel;

class Comment {
    
    protected $commentModel;
    
    protected $request;
    protected $response;
    
    public function __construct(CommentModel $comment,
                                Request $request,
                                Response $responce) {
        $this->commentModel = $comment;
        $this->request = $request;
        $this->response = $responce;
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            die('not auth');
            header("Location: /");
            exit;
        }
        $username = $_SESSION['username'];
        $story_id = $this->request->post->get('story_id');
        $comment = $this->request->post->get('comment');
        $this->commentModel->createComment($username, $story_id, $comment);
        return $this->response;
    }
    
}