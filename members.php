<?php
      include('includes/start.php');
      include('includes/head.php');
      include('includes/header.php'); ?>
<?php
$results = DB::query('SELECT *,m.id as memberid ,m.name as name, c.name as cname FROM members m,committees c WHERE m.committee_id=c.id');

?>

      <div id="main-body">
        <div class="page-title">
          Members
        </div>
        <div class="cards">
          <div class="row">
            <div class="item">
              <h1>"Committee" members</h1>
              <div class="table-container">
                <table class="table">
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>ID</th>
                    <th>Committee</th>
                    <th>Evaluate</th>
                    <th>Warn</th>
                  </tr>
                  <?php  foreach($results as $item){ ?>

                  <tr>
                    <td><?php echo $item['memberid']; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['phone']; ?></td>
                    <td><?php echo $item['email']; ?></td>
                    <td><?php echo $item['id']; ?></td>
                    <td><?php echo $item['cname']; // -- Print member's committee name -- ?></td>
                    <td><div class="xbutton blue"> <i class="fas fa-star"></i> </div></td>
                    <td><div class="xbutton red", button onclick="myFunction(<?= $item['memberid'] ?>)"
>
                                         
                     <i class="fas fa-exclamation-triangle"></i> </div></td>
                  </tr>
                  <?php
                  }
                  ?>
                </table>
              </div>
              <div class="xbutton">1</div>
              <div class="xbutton secondary">2</div>
              <div class="xbutton secondary">3</div>
              <div class="xbutton secondary">4</div>
            </div>
          </div>
      </div>
    </div>
    <script>function myFunction(id) {
    if (confirm("Confirm warning member!")) {
        window.location.href = "http://localhost/CAMPGIT/Campaigners-portal/warnings.php?id=" + id;
    } else {
        txt = "You pressed Cancel!";
    }
}</script>
<?php include('includes/footer.php') ?>
