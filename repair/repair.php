<?php
   include "config.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Repair / Maintenance</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="icon" type="image" href="../car2.png">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="repair.css">
      <script>
         $(document).ready(function(){
             $('[data-toggle="tooltip"]').tooltip();   
         });
      </script>
   </head>
   <body>
      <div class="wrapper">
         <div class="d-flex justify-content-center">
            <div class="row">
               <div class="col-md-12">
                  <div class="mt-5 mb-3 clearfix">
                     <br>
                     <br>
                     <div class="login-box">
                        <a href="../index2.php">
                           <h2 class="pull-left">Repair / Maintenance
                              <span></span>
                              <span></span>
                              <span></span>
                              <span></span>
                           </h2>
                        </a>
                     </div>
                  </div>
                  <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Entry</a>
                  <br>
                  <br>
                  <br>
                  <style>
                     table {
                     width: 100%;
                     }
                     th, td {
                     padding: 8px;
                     }
                     @media screen and (max-width: 600px) {
                     table {
                     font-size: 12px;
                     }
                     }
                     /* Styles for the pagination and page count */
                     .pagination {
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     margin-top: 20px;
                     }
                     .pagination a {
                     padding: 8px 12px;
                     border: 1px solid #ccc;
                     text-decoration: none;
                     color: #fff;
                     margin: 0 5px;
                     border-radius: 5px;
                     }
                     .pagination a.active {
                     background-color: #007bff;
                     color: #fff;
                     }
                     .table-container {
                     margin-bottom: 20px;
                     }
                     .page-count {
                     display: flex;
                     justify-content: center;
                     align-items: center;
                     margin-top: 10px;
                     color: #666;
                     }
                     .update-form {
                     display: flex;
                     justify-content:end;
                     align-items: center;
                     margin-bottom: 10px;
                     }
                     .update-form label {
                     margin-right: 5px;
                     font-weight: bold;
                     color:#fff;
                     }
                     .update-form input[type="number"] {
                     padding: 5px;
                     border: 1px solid #ccc;
                     border-radius: 5px;
                     width: 60px;
                     }
                     .update-form button {
                     padding: 5px 10px;
                     background-color: #007bff;
                     color: #fff;
                     border: none;
                     border-radius: 5px;
                     cursor: pointer;
                     }
                  </style>
                  <form method="get" action="" class="update-form">
                     <label for="recordsPerPage">Page count:</label>
                     <input type="number" name="recordsPerPage" id="recordsPerPage" value="<?php echo $recordsPerPage; ?>" min="1">
                     &nbsp;
                     <button type="submit">Update</button>
                  </form>
                  <?php
                     $recordsPerPage = isset($_GET['recordsPerPage']) && is_numeric($_GET['recordsPerPage']) ? (int)$_GET['recordsPerPage'] : 10;
                     $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                     $startFrom = ($page - 1) * $recordsPerPage;
                     
                     $sql = "SELECT COUNT(*) AS total FROM `repair`";
                     $result = mysqli_query($conn, $sql);
                     $row = mysqli_fetch_assoc($result);
                     $totalRecords = $row['total'];
                     $totalPages = ceil($totalRecords / $recordsPerPage);
                     
                     $sql = "SELECT * FROM `repair` LIMIT $startFrom, $recordsPerPage";
                     $result = mysqli_query($conn, $sql);
                     $no = ($page - 1) * $recordsPerPage + 1;
                     
                     $totalAmount = 0; // Initialize total amount
                     
                     // Calculate total amount for all entries
                     $sqlTotalAmount = "SELECT SUM(CAST(amount AS SIGNED)) AS totalAmount FROM `repair`";
                     $resultTotalAmount = mysqli_query($conn, $sqlTotalAmount);
                     $rowTotalAmount = mysqli_fetch_assoc($resultTotalAmount);
                     $totalAmount = $rowTotalAmount['totalAmount'];
                     ?>
                  <div class="table-container">
                  <div>
                     <form action="export.php" method="POST">
                           <input type="hidden" name="export_type" value="pdf">
                           <button class="btn btn-primary" type="submit">Download as PDF</button>
                     </form>
                  </div>
                  <br>
                     <table class="table table-bordered table-striped">
                        <!-- Table header -->
                        <thead>
                           <tr>
                              <th scope="col">S.NO</th>
                              <th scope="col">Date</th>
                              <th scope="col">KM</th>
                              <th scope="col">Problem</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Edit</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>";
                                  echo "<td>" . $no . "</td>";
                                  echo "<td>" . (!empty($row['date']) ? $row['date'] : '-') . "</td>";
                                  echo "<td>" . (!empty($row['km']) ? $row['km'] : '-') . "</td>";
                                  echo "<td>" . (!empty($row['problem']) ? $row['problem'] : '-') . "</td>";
                              
                                  // Convert "amount" to signed integer
                                  $amount = !empty($row['amount']) ? '₹ ' . $row['amount'] : '-';
                                  echo "<td>" . $amount . "</td>";
                              
                                  echo "<td>";
                                  echo '<a href="delete.php?id=' . $row['id'] . '" data-toggle="tooltip" style="color:white"><span class="fa fa-edit" style="color:white;"></span> &nbsp;Delete</a>';
                                  echo "</td>";
                                  echo "</tr>";
                              
                                  $no++;
                              }
                              ?>
                           <!-- Display the total row -->
                           <tr>
                              <td colspan="4"></td>
                              <td><b>Total :</b></td>
                              <td><?php echo '₹ ' . number_format($totalAmount); ?></td>
                           </tr>
                        </tbody>
                     </table>
                     <!-- Pagination Links -->
                     <div class="pagination">
                        <?php
                           if ($page > 1) {
                               echo '<a href="?page=' . ($page - 1) . '&recordsPerPage=' . $recordsPerPage . '">Previous</a>';
                           }
                           for ($i = 1; $i <= $totalPages; $i++) {
                               $active = ($i === $page) ? 'active' : '';
                               echo '<a href="?page=' . $i . '&recordsPerPage=' . $recordsPerPage . '" class="' . $active . '">' . $i . '</a>';
                           }
                           if ($page < $totalPages) {
                               echo '<a href="?page=' . ($page + 1) . '&recordsPerPage=' . $recordsPerPage . '">Next</a>';
                           }
                           ?>
                     </div>
                  </div>
                  <!-- Page Count -->
                  <div class="page-count">
                     Page <?php echo $page; ?> of <?php echo $totalPages; ?>
                  </div>
                  <?php
                     mysqli_free_result($result);
                     ?>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>