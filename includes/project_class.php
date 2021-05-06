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

  public function new_project() {
    global $db, $message;
    if ($this->transfer_image()) {
      $sql = "INSERT INTO projects (" . implode(", ", array_slice($this->class_properties, 1)) . ") VALUES ";
      $sql .= "('{$this->title}', '{$this->description}', '{$this->picture}', '{$this->snippet}', '{$this->link}')";
      if($db->query($sql)) {
        $message->set_message("Project {$this->title} inserted successfully. <a href='../project.php?project_id={$this->id}'>View here.</a>");
        redirect("projects.php");
      } else {
        $message->set_message("There was an error saving project {$this->title}. Please try again.");
        redirect("add_project.php");
      }
    } else {
      redirect("projects.php");
    }
  }

  public function update_project() {
    global $message;
    if ($this->transfer_image()) {
      if ($this->update_item("projects")) {
        $message->set_message("Project {$this->title} updated successfully. <a href='../project.php?project_id={$this->id}'>View here.</a>");
        redirect("projects.php");
      } else {
        $message->set_message("There was an error updating project {$this->title}. Please try again.");
        redirect("edit_project.php?project_id={$this->id}");
      }
    } else {
      redirect("edit_project.php?project_id={$this->id}");
    }
  }


}




?>