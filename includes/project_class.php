<?php

class Project extends Methods {
  public $id;
  public $title;
  public $description;
  public $picture;
  public $snippet;
  public $link;
  public $tmp_path;
  public $class_properties = ['id' => 'i', 'title' => 's', 'description' => 's', 'picture' => 's', 'snippet' => 's', 'link' => 's'];

  public function new_project() {
    global $db, $message;
    if ($this->transfer_image()) {
      list($main_query, $sanitized_items, $types_string) = $this->set_items(array_slice($this->class_properties, 1));
      $sql = "INSERT INTO projects SET " . implode(", ", $main_query);
      $stmt = $db->connection->prepare($sql);
      $stmt->bind_param($types_string, ...$sanitized_items);
      $stmt->execute();
      if ($stmt->affected_rows === 1) {
        $message->set_message("Project {$this->title} inserted successfully. <a href='../project.php?project_id={$this->id}'>View here.</a>");
        redirect("projects.php");
      } else {
        $message->set_message($stmt->error);
        redirect("add_project.php");
      }
    } else {
      redirect("projects.php");
    }
  }

  public function update_project() {
    global $message;
    if ($this->transfer_image()) {
      if ($this->update_item("projects", $this->class_properties)) {
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