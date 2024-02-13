<?php
   include "config.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Fuel Details</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="icon" type="image" href="../car2.png">
      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="fuel.css">
      <script>
         $(document).ready(function(){
             $('[data-toggle="tooltip"]').tooltip();   
         });
         function printScreen() {
            window.print();
        }
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
                           <h2 class="pull-left">Fuel Cost Details
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
                     align-items:center;
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
                  <form  form method="get" action="" class="update-form">
                     <label for="recordsPerPage">Page Count:</label>
                     <input type="number" name="recordsPerPage" id="recordsPerPage" value="<?php echo $recordsPerPage; ?>" min="1">
                     &nbsp;
                     <button type="submit">Update</button>
                  </form>
                  <?php
                     $recordsPerPageFuel = isset($_GET['recordsPerPage']) && is_numeric($_GET['recordsPerPage']) ? (int)$_GET['recordsPerPage'] : 10;
                     $pageFuel = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
                     $startFromFuel = ($pageFuel - 1) * $recordsPerPageFuel;
                     
                     $sqlFuel = "SELECT COUNT(*) AS total FROM `fuel`";
                     $resultFuel = mysqli_query($conn, $sqlFuel);
                     $rowFuel = mysqli_fetch_assoc($resultFuel);
                     $totalRecordsFuel = $rowFuel['total'];
                     $totalPagesFuel = ceil($totalRecordsFuel / $recordsPerPageFuel);
                     
                     $sqlFuel = "SELECT * FROM `fuel` LIMIT $startFromFuel, $recordsPerPageFuel";
                     $resultFuel = mysqli_query($conn, $sqlFuel);
                     $noFuel = ($pageFuel - 1) * $recordsPerPageFuel + 1;
                     
                     $totalAmountFuel = 0; // Initialize total amount
                     
                     // Calculate total amount for all entries
                     $sqlTotalAmountFuel = "SELECT SUM(CAST(amount AS SIGNED)) AS totalAmount FROM `fuel`";
                     $resultTotalAmountFuel = mysqli_query($conn, $sqlTotalAmountFuel);
                     $rowTotalAmountFuel = mysqli_fetch_assoc($resultTotalAmountFuel);
                     $totalAmountFuel = $rowTotalAmountFuel['totalAmount'];
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
                              <th scope="col">Fuel</th>
                              <th scope="col">Price</th>
                              <th scope="col">Liter</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Edit</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              while ($rowFuel = mysqli_fetch_assoc($resultFuel)) {
                                  echo "<tr>";
                                  echo "<td>" . $noFuel . "</td>";
                                  echo "<td>" . (!empty($rowFuel['date']) ? $rowFuel['date'] : '-') . "</td>";
                                  echo "<td>" . (!empty($rowFuel['km']) ? $rowFuel['km'] : '-') . "</td>";
                                  echo "<td>" . (!empty($rowFuel['fuel']) ? $rowFuel['fuel'] : '-') . "</td>";
                              
                                  // Check if the price is empty or NULL, and display "-" accordingly
                                  $price = !empty($rowFuel['price']) ? '&nbsp;<span>&#8377&nbsp;</span>' . $rowFuel['price'] : '-';
                                  echo "<td>" . $price . "</td>";
                              
                                  echo "<td>" . (!empty($rowFuel['liter']) ? $rowFuel['liter'] . '&nbsp;<span>&#8467;</span>' : '-') . "</td>";
                              
                                  // Display the amount with the rupee symbol
                                  $amount = !empty($rowFuel['amount']) ? '₹ ' . $rowFuel['amount'] : '-';
                                  echo "<td>" . $amount . "</td>";
                              
                                  echo "<td>";
                                  echo '<a href="delete.php?id=' . $rowFuel['id'] . '" data-toggle="tooltip" style="color:white"><span class="fa fa-edit" style="color:white;"></span> &nbsp;Delete</a>';
                                  echo "</td>";
                                  echo "</tr>";
                                  $noFuel++;
                              }
                              ?>
                           <!-- Display the total row -->
                           <tr>
                              <td colspan="6"></td>
                              <td>Total:</td>
                              <td><?php echo '₹ ' . number_format($totalAmountFuel); ?></td>
                           </tr>
                        </tbody>
                     </table>
                     <!-- Pagination Links -->
                     <div class="pagination">
                        <?php
                           if ($pageFuel > 1) {
                               echo '<a href="?page=' . ($pageFuel - 1) . '&recordsPerPage=' . $recordsPerPageFuel . '">Previous</a>';
                           }
                           for ($i = 1; $i <= $totalPagesFuel; $i++) {
                               $activeFuel = ($i === $pageFuel) ? 'active' : '';
                               echo '<a href="?page=' . $i . '&recordsPerPage=' . $recordsPerPageFuel . '" class="' . $activeFuel . '">' . $i . '</a>';
                           }
                           if ($pageFuel < $totalPagesFuel) {
                               echo '<a href="?page=' . ($pageFuel + 1) . '&recordsPerPage=' . $recordsPerPageFuel . '">Next</a>';
                           }
                           ?>
                     </div>
                     <!-- Page Count -->
                     <div class="page-count">
                        Page <?php echo $pageFuel; ?> of <?php echo $totalPagesFuel; ?>
                     </div>
                  </div>
                  <?php
                     mysqli_free_result($resultFuel);
                     ?>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>