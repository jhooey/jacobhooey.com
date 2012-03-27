<?php
 
/**
 * Class to handle articles
 */
 
class Article
{
 
  // Properties
 
  /**
  * @var mediumint The article ID from the database
  */
  public $content_id = null;
 
  /**
  * @var tinyint What section will it be in
  */
  public $nav_id = null;
 
  /**
  * @var string Full title of the article
  */
  public $content_title = null;
 
  /**
  * @var tinyint used to order the secondary navigation
  */
  public $menu_order = null;
 
  /**
  * @var string The HTML content of the article
  */
  public $panel_content = null;
 
 
  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */
 
  public function __construct( $data=array() ) {
    if ( isset( $data['content_id'] ) ) $this->content_id = (int)$data['content_id'];
    if ( isset( $data['nav_id'] ) ) $this->nav_id = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['nav_id']);
    if ( isset( $data['content_title'] ) ) $this->content_title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/", "", $data['content_title'] );
    if ( isset( $data['menu_order'] ) ) $this->menu_order = $data['menu_order'];
    if ( isset( $data['panel_content'] ) ) $this->panel_content = $data['panel_content'];
  }
 
 
  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */
 
  public function storeFormValues ( $params ) {
 
    // Store all the parameters
    $this->__construct( $params );
 
    /* Parse and store the publication date
    if ( isset($params['publicationDate']) ) {
      $publicationDate = explode ( '-', $params['publicationDate'] );
 
      if ( count($publicationDate) == 3 ) {
        list ( $y, $m, $d ) = $publicationDate;
        $this->publicationDate = mktime ( 0, 0, 0, $m, $d, $y );
      }
    }*/
  }
 
 
  /**
  * Returns an Article object matching the given article ID
  *
  * @param int The article ID
  * @return Article|false The article object, or false if the record was not found or there was a problem
  */
 
  public static function getById( $content_id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM content WHERE content_id = :content_id";
    
    /*Once we've stored our SELECT statement in a string, we prepare the statement by calling $conn->prepare()*/
    $st = $conn->prepare( $sql );
   
    /*Rather than placing our $id parameter directly inside the SELECT string, which can be a security risk, we instead use :id. This is known as a placeholder.*/
    $st->bindValue( ":content_id", $content_id, PDO::PARAM_INT );
    
    /*Lastly, we call execute() to run the query, then we use fetch() to retrieve the resulting record as an associative array of field names and corresponding field values, which we store in the $row variable.*/
    $st->execute();
    $row = $st->fetch();
    
    /*Since we no longer need our connection, we close it by assigning null to the $conn variable. It's a good idea to close database connections as soon as possible to free up memory on the server.*/
    $conn = null;
    if ( $row ) return new Article( $row );
  }
 
 
  /**
  * Returns all (or a range of) Article objects in the DB
  *
  * @param int Optional The number of rows to return (default=all)
  * @param string Optional column by which to order the articles (default="publicationDate DESC")
  * @return Array|false A two-element array : results => array, a list of Article objects; totalRows => Total number of articles
  */
 
  public static function getList( $numRows=1000000, $order="nav_id DESC", $nav = "default") {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    
    if ( $nav == "default" ) {
    
    $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM content
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
    $st = $conn->prepare( $sql );
    }
    else {
      $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM content WHERE nav_id = :nav_id
            ORDER BY " . mysql_escape_string($order) . " LIMIT :numRows";
      $st = $conn->prepare( $sql );
      $st->bindValue( ":nav_id", $nav, PDO::PARAM_STR );
    }

    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    $st->execute();
    $list = array();
 
    while ( $row = $st->fetch() ) {
      $article = new Article( $row );
      $list[] = $article;
    }
 
    // Now get the total number of articles that matched the criteria
    $sql = "SELECT FOUND_ROWS() AS totalRows";
    $totalRows = $conn->query( $sql )->fetch();
    
    //close the connection
    $conn = null;
    return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
  }
 
 
  /**
  * Inserts the current Article object into the database, and sets its ID property.
  */
 
  public function insert() {
 
    // Does the Article object already have an ID?
    if ( !is_null( $this->content_id ) ) trigger_error ( "Article::insert(): Attempt to insert an Article object that already has its ID property set (to $this->id).", E_USER_ERROR );
 
    // Insert the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO content ( nav_id, content_title, panel_content ) VALUES (:nav_id, :content_title, :panel_content )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":nav_id", $this->nav_id, PDO::PARAM_STR );
    $st->bindValue( ":content_title", $this->content_title, PDO::PARAM_STR );
    $st->bindValue( ":panel_content", $this->panel_content, PDO::PARAM_STR );
    $st->execute();
    $conn = null;
  }
 
 
  /**
  * Updates the current Article object in the database.
  */
 
  public function update() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->content_id ) ) trigger_error ( "Article::update(): Attempt to update an Article object that does not have its ID property set.", E_USER_ERROR );
    
    // Update the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE content SET nav_id=:nav_id, content_title=:content_title, panel_content=:panel_content WHERE content_id = :content_id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":nav_id", $this->nav_id, PDO::PARAM_STR );
    $st->bindValue( ":content_title", $this->content_title, PDO::PARAM_STR );
    $st->bindValue( ":panel_content", $this->panel_content, PDO::PARAM_STR );
    $st->bindValue( ":content_id", $this->content_id, PDO::PARAM_INT );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }
 
 
  /**
  * Deletes the current Article object from the database.
  */
 
  public function delete() {
 
    // Does the Article object have an ID?
    if ( is_null( $this->content_id ) ) trigger_error ( "Article::delete(): Attempt to delete an Article object that does not have its ID property set.", E_USER_ERROR );
 
    // Delete the Article
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM content WHERE content_id = :content_id LIMIT 1" );
    $st->bindValue( ":content_id", $this->content_id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }
 
}
 
?>