
<?php require_once('header.php'); ?>
<?php require_once('db.php'); ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div id="top-bar"><h1 class="h2">#Subject List</h1></div>

        <!-- search bar-->
        <div class="container">
        <form class="form-inline">

        <div class="form-group mb-2">
        <select name="search_field">
          <option value="id">Id</option>
          <option value="sub_name">Subject Name</option>
        </select>
      </div>

      <div class="form-group mx-sm-3 mb-2">
        <label for="inputPassword2" class="sr-only">search</label>
        <input type="text" class="form-control" name="search" id="inputPassword2" placeholder="search....">
      </div>
      <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>
    </div>

        <div class="btn-toolbar mb-2 mb-md-0">
         <div class="btn-group mr-2">
           <a class="btn btn-sm btn-outline-secondary" href="subject.php">Add New</a>

         </div>
       </div>
      </div>


<?php

try{

  $search = '';

  $per_page = 5;
  $curr_page = 1;

  if(isset($_GET['search']) && $_GET['search'] != '')
    $search = $_GET['search'];

    if(isset($_GET['page'])){
      $curr_page = $_GET['page'];
    }

    $limit_start = ($curr_page - 1) * $per_page;

    $limit = ' limit '.$limit_start.', '.$per_page;




  $query = 'SELECT * FROM `subject`';

  if($search != ''){
    $query = $query." WHERE ".$_GET['search_field']." = '".$search."'";
  }

  //run query to get total data
  $stmt = $conn->query($query);

  $total = $stmt->rowCount();
  $pages = $total/$per_page;

  if($total % $per_page > 0){
    $pages++;
  }

  //run actual query

  $stmt = $conn->query($query.' '.$limit);

      ?>
      <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Sub Id</th>
      <th scope="col">Sub Name</th>
      <th scope="col">Operation</th>

    </tr>
  </thead>

  <?php
  while($row = $stmt->fetch()){
  ?>

    <tr>

      <td><?php echo $row['id']; ?></td>
      <td><?php echo $row['sub_name']; ?></td>
      <td><a href="subj-edit.php?edit=<?php echo $row['id']; ?>">Edit</a></td>
      <td><a href="subj-delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>

    </tr>

    <?php
  }
  ?>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
      for ($i=1; $i <= $pages ; $i++) {

        $active = '';
        if($i == $curr_page ){

          $active = 'active';

        }

     ?>
    <li class="page-item <?php echo $active; ?>">
      <a class="page-link" href="http://localhost/school-management/subj-display.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    </li>

    <?php
      }
    ?>

  </ul>
</nav>

<?php

}catch(PDOException $e){

}

 ?>
</main>
<?php require_once('footer.php'); ?>
