<?php

namespace MasterClass\Model;

use MasterClass\Dbal\AbstractDb;


class Story {
  
  protected $db;
  protected $dbconfig;
  
  public function __construct(AbstractDb $db) {
    $this->db = $db;
  }
  
  public function getStory ($id) {
    $sql = 'SELECT * FROM story WHERE id = ?';
    return $this->db->fetchOne($sql, [$id]);

  }
  public function getStoryList () {
    $sql = 'SELECT * FROM story ORDER BY created_on DESC';
    $stories = $this->db->fetchAll($sql);
          foreach($stories as $key => $story) {
            $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
            $count = $this->db->fetchOne($comment_sql, [$story['id']]);
            $stories[$key]['comment_count'] = $count['count'];
        }
    return $stories;
  }
  
  public function createStory ($params) {

    $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';  
    $this->db->execute(array(
      $params['headline'],
      $params['url'],
      $params['username'],
    ));
    
    return $this->db->lastInsertId();
  }
  
}