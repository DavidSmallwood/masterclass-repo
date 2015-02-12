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
    return $this->db->fetchAll($sql);

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