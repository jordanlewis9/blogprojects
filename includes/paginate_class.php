<?php

class Paginate {
  public $num_items;
  public $items_array;
  public $pages;
  public $num_per_page;
  public $current_page;

  function __construct($num_items, $num_per_page, $cur_page) {
    $this->num_items = $num_items;
    $this->num_per_page = $num_per_page;
    $this->pages = ceil($this->num_items / $num_per_page);
    $this->set_current_page($cur_page);
  }

  public function set_current_page($cur_page) {
    if (!preg_match('/^[0-9]{1,}$/', $cur_page)) {
      return $this->current_page = 1;
    }
    if ($cur_page > $this->pages) {
      $this->current_page = $this->pages;
    } elseif ($cur_page < 1) {
      $this->current_page = 1;
    } else {
      $this->current_page = $cur_page;
    }
  }

  public function return_offset() {
    return ($this->current_page - 1) * $this->num_per_page;
  }

  public function is_there_prev_page() {
    if ($this->current_page <= 1) {
      return false;
    } else {
      return true;
    }
  }

  public function is_there_next_page() {
    if ($this->current_page >= $this->pages) {
      return false;
    } else {
      return true;
    }
  }

  public function next_page() {
    return $this->current_page + 1;
  }

  public function previous_page() {
    return $this->current_page - 1;
  }

  public function show_pagination() {
    if ($this->pages <= 1) {
      return null;
    } else {
      $cur_file = basename($_SERVER['PHP_SELF']);
      if ($this->is_there_prev_page()) {
        $prev_page = "<a href='{$cur_file}?page={$this->previous_page()}' class='paginate__prev'>
        <div class='paginate__prev--arrow-top'></div>
        <div class='paginate__prev--arrow-mid'></div>
        <div class='paginate__prev--arrow-bottom'></div></a>";
      } else {
        $prev_page = "";
      }
      if ($this->is_there_next_page()) {
        $next_page = "<a href='{$cur_file}?page={$this->next_page()}' class='paginate__next'>
        <div class='paginate__next--arrow-top'></div>
        <div class='paginate__next--arrow-mid'></div>
        <div class='paginate__next--arrow-bottom'></div></
        </a>";
      } else {
        $next_page = "";
      }
    }
    
    $user_pick_page = "
    <form action='' method='GET' class='paginate__form'>
      <input type='text' name='page' value='{$this->current_page}' class='paginate__input'>
    </form>
    <p class='total_pages'> of {$this->pages} pages</p>
    ";
    
    echo "<div class='paginate__container'>" . $prev_page . $user_pick_page . $next_page . "</div>";
  }
}

?>