<?php

namespace MasterClass\Controllers;


use MasterClass\Model\Story as StoryModel;
use MasterClass\Model\Comment as CommentModel;

class Story {
    
    protected $storyModel;
    protected $commentModel;


    public function __construct($config) {
      $this->storyModel = new StoryModel($config);
      $this->commentModel = new CommentModel($config);
    }
    
    private function cleanParams() {
      return array('headline' => $_POST['headline'],
                   'url' => $_POST['url'],
                   'username' => $_SESSION['username']
                  );
    }

    public function index() {
        if(!isset($_GET['id'])) {
            header("Location: /");
            exit;
        }
        
        $story = $this->storyModel->getStory($_GET['id']);

        if(empty($story) || !isset($story['id'])) {
            header("Location: /");
            exit;
        }
        
        $comment_count = $this->commentModel->getCommentCount($story['id']);
        $comments = $this->commentModel->getComments($story['id']);
        $content = '
            <a class="headline" href="' . $story['url'] . '">' . $story['headline'] . '</a><br />
            <span class="details">' . $story['created_by'] . ' | ' . $comment_count . ' Comments | 
            ' . date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
        ';
        
        if(isset($_SESSION['AUTHENTICATED'])) {
            $content .= '
            <form method="post" action="/comment/create">
            <input type="hidden" name="story_id" value="' . $_GET['id'] . '" />
            <textarea cols="60" rows="6" name="comment"></textarea><br />
            <input type="submit" name="submit" value="Submit Comment" />
            </form>            
            ';
        }
        
        foreach($comments as $comment) {
            $content .= '
                <div class="comment"><span class="comment_details">' . $comment['created_by'] . ' | ' .
                date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
                ' . $comment['comment'] . '</div>
            ';
        }
        
        require_once '../tpl/layout.phtml';
        
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            header("Location: /user/login");
            exit;
        }
        
        $error = '';
        if(isset($_POST['create'])) {
            if(!isset($_POST['headline']) || !isset($_POST['url']) ||
               !filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)) {
                $error = 'You did not fill in all the fields or the URL did not validate.';       
            } else {
              $params = $this->cleanParams();
              $id = $this->storyModel->createStory($params);
              header("Location: /story/?id=$id");
              exit;
            }
        } else {
        
        $content = '
            <form method="post">
                ' . $error . '<br />
        
                <label>Headline:</label> <input type="text" name="headline" value="" /> <br />
                <label>URL:</label> <input type="text" name="url" value="" /><br />
                <input type="submit" name="create" value="Create" />
            </form>
        ';
        }
        
        require_once '../tpl/layout.phtml';
    }
    

    
}