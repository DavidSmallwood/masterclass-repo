<?php

namespace MasterClass\Controllers;

use MasterClass\Model\Comment as CommentModel;
use MasterClass\Model\Story as StoryModel;

class Index {

    
    protected $commentModel;
    protected $storyModel;
    
    public function __construct(StoryModel $story, CommentModel $comment) {
        $this->storyModel = $story;
        $this->commentModel = $comment;
    }
    
    public function index() {
        
        $stories = $this->storyModel->getStoryList();
        
        $content = '<ol>';
        
        foreach($stories as $story) {
            $count = $this->commentModel->getCommentCount($story['id']);
            $content .= '
                <li>
                <a class="headline" href="' . $story['url'] . '">' . $story['headline'] . '</a><br />
                <span class="details">' . $story['created_by'] . ' | <a href="/story?id=' . $story['id']
                . '">' . $count . ' Comments</a> | 
                ' . date('n/j/Y g:i a', strtotime($story['created_on'])) . '</span>
                </li>
            ';
        }
        
        $content .= '</ol>';
        
        require '../tpl/layout.phtml';
    }
}

