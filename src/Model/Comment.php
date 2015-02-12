<?php



namespace MasterClass\Model;

use MasterClass\Dbal\AbstractDb;


class Comment {
  
  protected $db;
  protected $dbconfig;
  
  public function __construct(AbstractDb $db) {
    $this->db = $db;
  }
  
  public function getCommentCount ($id) {
    $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
    $count = $this->db->fetchAll($comment_sql, [$id]);
    //var_dump ($count);
    return $count[0]['count'];
  }
  
  public function createComment ($id) {
    $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
    return $this->db->execute($sql, array(
                        $_SESSION['username'],
                        $id,
                        filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        ));
  }
  public function getComments ($id) {
    $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
    $comments = $this->db->fetchAll($comment_sql, [$id]);

    return $comments;
  }
  
  
}
