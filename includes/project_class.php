<?php

class Project extends Methods {
  public $id;
  public $title;
  public $description;
  public $picture;
  public $snippet;
  public $link;
  public $tmp_path;
  public $class_properties = ['id', 'title', 'description', 'picture', 'snippet', 'link'];

  public function save_project() {
    global $db;
    if ($this->transfer_image()) {
      $sql = "INSERT INTO projects (" . implode(", ", array_slice($this->class_properties, 1)) . ") VALUES ";
      $sql .= "('{$this->title}', '{$this->description}', '{$this->picture}', '{$this->snippet}', '{$this->link}')";
      $db->query($sql);
      redirect("projects.php");
    } else {
      redirect("projects.php?message=Project save unsuccessful");
    }
  }


}




?>