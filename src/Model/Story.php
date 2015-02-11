<?php

namespace MasterClass\Model;

use PDO;

/**
 * Model for Story
 *
 */
class Story {
  
  protected $db;
  protected $dbconfig;
  
  public function __construct($config) {
    $this->dbconfig = $config['database'];
    $dsn = 'mysql:host=' . $this->dbconfig['host'] . ';dbname=' . $this->dbconfig['name'];
    $this->db = new PDO($dsn, $this->dbconfig['user'], $this->dbconfig['pass']);
    $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  
  public function getStory ($id) {
    $story_sql = 'SELECT * FROM story WHERE id = ?';
    $story_stmt = $this->db->prepare($story_sql);
    $story_stmt->execute(array($id));
    return $story_stmt->fetch(PDO::FETCH_ASSOC);
    
  }
  public function getStoryList () {
    $sql = 'SELECT * FROM story ORDER BY created_on DESC';
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 
  }
  
  public function createStory ($params) {

    $sql = 'INSERT INTO story (headline, url, created_by, created_on) VALUES (?, ?, ?, NOW())';  
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array(
      $params['headline'],
      $params['url'],
      $params['username'],
    ));
    
    return $this->db->lastInsertId();
  }
  
}