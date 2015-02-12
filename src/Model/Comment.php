<?php



namespace MasterClass\Model;

use PDO;


class Comment {
  
  protected $db;
  protected $dbconfig;
  
  public function __construct(PDO $pdo) {
    $this->db = $pdo;
  }
  
  public function getCommentCount ($id) {
    $comment_sql = 'SELECT COUNT(*) as `count` FROM comment WHERE story_id = ?';
    $comment_stmt = $this->db->prepare($comment_sql);
    $comment_stmt->execute(array($id));
    $count = $comment_stmt->fetch(PDO::FETCH_ASSOC);
    return $count['count'];
  }
  
  public function createComment ($id) {
    $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array(
                        $_SESSION['username'],
                        $id,
                        filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                        ));
  }
  public function getComments ($id) {
    $comment_sql = 'SELECT * FROM comment WHERE story_id = ?';
    $comment_stmt = $this->db->prepare($comment_sql);
    $comment_stmt->execute(array($id));
    return $comment_stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  
}
