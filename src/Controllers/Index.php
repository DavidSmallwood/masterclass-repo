<?php

namespace MasterClass\Controllers;

use Aura\View\View;
use Aura\Web\Request;
use Aura\Web\Response;
use MasterClass\Model\Comment as CommentModel;
use MasterClass\Model\Story as StoryModel;

class Index {

    
    protected $storyModel;
    protected $response;
    protected $request;
    protected $template;
    
    public function __construct(StoryModel $story,
                                Request $request,
                                Response $response,
                                View $view) {
        $this->storyModel = $story;
        $this->response = $response;
        $this->request = $request;
        $this->template = $view;
        //var_dump(array('story' => $story, 'response' => $response, 'request' => $request, 'view' => $view));
    }
    
    public function index() {
        
        $stories = $this->storyModel->getStoryList();
        
        $this->template->setLayout('layout');
        $this->template->setView('index');

        $this->template->setData(['stories' => $stories]);
        $this->response->content->set($this->template->__invoke());
        return $this->response;
    }
}

