<?php

namespace MasterClass\Controllers;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use MasterClass\Model\Story as StoryModel;
use MasterClass\Model\Comment as CommentModel;

class Story {
    
    protected $storyModel;
    protected $commentModel;
    protected $request;
    protected $response;
    protected $template;


    public function __construct(StoryModel $story,
                                CommentModel $comment,
                                Request $request,
                                Response $responce,
                                View $view) {
      $this->storyModel = $story;
      $this->commentModel = $comment;
      $this->request = $request;
      $this->response = $responce;
      $this->template = $view;
    }
    
    private function cleanParams() {
      return array('headline' => $_POST['headline'],
                   'url' => $_POST['url'],
                   'username' => $_SESSION['username']
                  );
    }

    public function index() {
      $id = $this->request->query->get('id');
      if(!$id) {
          $this->response->redirect->to('/');
          return $this->response;
      }
      $story = $this->storyModel->getStory($id);

      if(empty($story) || !isset($story['id'])) {
        $this->response->redirect->to('/');
        return $this->response;
      }
        
        //$comment_count = $this->commentModel->getCommentCount($story['id']);
        $comments = $this->commentModel->getComments($story['id']);
        $story['comment_count'] = count($comments);
        $this->template->setData(['story' => $story, 'comments' => $comments]);
        $this->template->setView('story');
        $this->template->setLayout('layout');
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
          $this->response->redirect->to('/user/login');
          return $this->response;
        }
        
        $headline = $this->request->post->get('headline');
        $url = $this->request->post->get('url');
        
        $error = '';
        if(!$headline || !$url||
          !filter_input($url, FILTER_VALIDATE_URL)) {
          $error = 'You did not fill in all the fields or the URL did not validate.';       
        } else {
          $id = $this->storyModel->createNewStory($headline, $url, $_SESSION['username']);
          $this->response->redirect->to("/story?id=$id");
          return $this->response;
        }

        $this->template->setView('story_create');
        $this->template->setLayout('layout');
        $this->template->setData(['error' => $error]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}
