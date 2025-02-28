<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Disaster Ready: Activity Logs</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/admin-logs.css">
  <link rel="icon" href="images/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<div class="topnav" id="myTopnav">
  <img src="images/icon.png">
    <div class="topcont">
      <div class="p1">Republic of the Philippines</div>
      <div class="p2">Municipality of Barugo</div>
      <div class="p3">MDRRMO</div>
    </div>

  <div class="dropdown">
    <?php
    // Assuming you have stored the logged-in user's ID in a session variable named $_SESSION['id']
    if(isset($_SESSION['id'])){
        $logged_in_id = $_SESSION['id'];

        include 'admin_db_connection.php';

        $sql = "SELECT * FROM users WHERE id = $logged_in_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                $image = $row["image"];
                $first_name = $row["first_name"][0] . ".";
                $last_name = $row["last_name"];
                echo "<div class='dropdown' style='background-color: #043a87; color: #ffffff;'>
                        <button class='dropbtn' style='color: #ffffff;'>
                        <img src='$image' alt='User Image'>$first_name $last_name
                            <i class='fa fa-caret-down' style='margin-left: 1em;'></i>
                        </button>
                        <div class='dropdown-content'>
                          <a href='logs.php' style='height: 3em;width: 14em; padding: 0; border-top: 1px solid #e5a920; font-size: 12px; background-color: #043a87; color: #ffffff;'>
                            <p>Logs</p>
                          </a>
                            
                          <a href='logout.php' style='margin-top: 3em;height: 3em;width: 14em; padding: 0; border-top: 1px solid #e5a920; font-size: 12px;'>
                            <p>Logout</p>
                          </a>
                        </div>
                    </div>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
    } else {
        // Handle the case where the user is not logged in
        // You might want to redirect the user to the login page or handle the situation in some other way
        echo "User not logged in.";
    }
?>

</div>


    <a href="reports-flood.php">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M88,112a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Zm8,40h80a8,8,0,0,0,0-16H96a8,8,0,0,0,0,16ZM232,64V184a24,24,0,0,1-24,24H32A24,24,0,0,1,8,184.11V88a8,8,0,0,1,16,0v96a8,8,0,0,0,16,0V64A16,16,0,0,1,56,48H216A16,16,0,0,1,232,64Zm-16,0H56V184a23.84,23.84,0,0,1-1.37,8H208a8,8,0,0,0,8-8Z"></path>
        </svg>
        <br>Reports
      </div>
    </a>

    <a href="admin-map.php">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M228.92,49.69a8,8,0,0,0-6.86-1.45L160.93,63.52,99.58,32.84a8,8,0,0,0-5.52-.6l-64,16A8,8,0,0,0,24,56V200a8,8,0,0,0,9.94,7.76l61.13-15.28,61.35,30.68A8.15,8.15,0,0,0,160,224a8,8,0,0,0,1.94-.24l64-16A8,8,0,0,0,232,200V56A8,8,0,0,0,228.92,49.69ZM104,52.94l48,24V203.06l-48-24ZM40,62.25l48-12v127.5l-48,12Zm176,131.5-48,12V78.25l48-12Z"></path>
        </svg>
        <br>Map
      </div>
    </a>

    <a href="admin-population.php">
      <div class="navcont">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 256 256">
          <path d="M244.8,150.4a8,8,0,0,1-11.2-1.6A51.6,51.6,0,0,0,192,128a8,8,0,0,1-7.37-4.89,8,8,0,0,1,0-6.22A8,8,0,0,1,192,112a24,24,0,1,0-23.24-30,8,8,0,1,1-15.5-4A40,40,0,1,1,219,117.51a67.94,67.94,0,0,1,27.43,21.68A8,8,0,0,1,244.8,150.4ZM190.92,212a8,8,0,1,1-13.84,8,57,57,0,0,0-98.16,0,8,8,0,1,1-13.84-8,72.06,72.06,0,0,1,33.74-29.92,48,48,0,1,1,58.36,0A72.06,72.06,0,0,1,190.92,212ZM128,176a32,32,0,1,0-32-32A32,32,0,0,0,128,176ZM72,120a8,8,0,0,0-8-8A24,24,0,1,1,87.24,82a8,8,0,1,0,15.5-4A40,40,0,1,0,37,117.51,67.94,67.94,0,0,0,9.6,139.19a8,8,0,1,0,12.8,9.61A51.6,51.6,0,0,1,64,128,8,8,0,0,0,72,120Z"></path>
        </svg>
        <br>Population
      </div>
    </a>

    
    <a href="admin-about.php">About</a>
    <a href="admin-contact.php">Contact</a>
    <a href="admin-typhoon.php">Typhoon</a>
    <a href="admin-flood.php">Flood</a>
    
    <!-- <div class="dropdown2">
      <button class="dropbtn2">Typhoon<i class='fa fa-caret-down' style='margin-left: 1em;'></i></button>
        <div class="dropdown-content2">
          <a href="admin-typhoon.php">Typhoon Data</a>
          <a href="admin-typhoon-adv.php" style='margin-top: 3em;'>Typhoon Advisories</a>
        </div>
    </div>
    
    <div class="dropdown2">
      <button class="dropbtn2">Flood<i class='fa fa-caret-down' style='margin-left: 1em;'></i></button>
        <div class="dropdown-content2">
          <a href="admin-flood.php">Flood Data</a>
          <a href="admin-flood-adv.php" style='margin-top: 3em;'>Flood Advisories</a>
        </div>
    </div> -->

    <a href="admin-home.php">Home</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // First Dropdown
    var dropdown1 = document.querySelector(".dropdown");
    dropdown1.addEventListener("hover", function() {
      var dropdownContent = dropdown1.querySelector(".dropdown-content");
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });

    // Second Dropdown
    var dropdown2 = document.querySelector(".dropdown2");
    dropdown2.addEventListener("hover", function() {
      var dropdownContent = dropdown2.querySelector(".dropdown-content2");
      dropdownContent.style.display = dropdownContent.style.display === "block" ? "none" : "block";
    });
  });
</script>

<div class="main">
  <div class="division">
    <div class="filters-container">
      <h1>Filters</h1>
      <?php
      include 'db_connection.php';

      // Fetch hazard-prone area data from the database with pagination
      $sql = "SELECT * FROM logs";
      $result = $conn->query($sql);
      ?>

      <form id="filterForm" method="get">
        <label for="employee_id">Employee ID:</label>
        <select name="employee_id" id="employee_id" onchange="submitForm()">
          <option value="">All</option>
          <?php
            $employeeIdQuery = "SELECT DISTINCT employee_id FROM logs;";
            $employeeIdResult = $conn->query($employeeIdQuery);

            while ($employeeIdRow = $employeeIdResult->fetch_assoc()) {
              $selected = (isset($_GET['employee_id']) && $_GET['employee_id'] == $employeeIdRow['employee_id']) ? 'selected' : '';
              echo "<option value='{$employeeIdRow['employee_id']}' $selected>{$employeeIdRow['employee_id']}</option>";
            }
          ?>
        </select>

        <label for="section">Section:</label>
        <select name="section" id="section" onchange="submitForm()">
          <option value="">All</option>
          <?php
            $sectionQuery = "SELECT DISTINCT section FROM logs;";
            $sectionResult = $conn->query($sectionQuery);

            while ($sectionRow = $sectionResult->fetch_assoc()) {
              $selected = (isset($_GET['section']) && $_GET['section'] == $sectionRow['section']) ? 'selected' : '';
              echo "<option value='{$sectionRow['section']}' $selected>{$sectionRow['section']}</option>";
            }
            ?>
        </select>

        <label for="date">Date:</label>
        <select name="date" id="date" onchange="submitForm()">
            <option value="">All</option>
            <?php
            $dateQuery = "SELECT DISTINCT DATE(date_time) AS date FROM logs;";
            $dateResult = $conn->query($dateQuery);

            while ($dateRow = $dateResult->fetch_assoc()) {
                $selected = (isset($_GET['date']) && $_GET['date'] == $dateRow['date']) ? 'selected' : '';
                echo "<option value='{$dateRow['date']}' $selected>{$dateRow['date']}</option>";
            }
            ?>
        </select>
      </form>

      <script>
          function submitForm() {
              document.getElementById('filterForm').submit();
          }
      </script>
    </div>
  </div>


  <div class="division">
    <div class="table-container">
      <?php
      include 'db_connection.php';

      // Determine the page number
      $page = isset($_GET['page']) ? $_GET['page'] : 1;
      $recordsPerPage = 15;
      $offset = ($page - 1) * $recordsPerPage;

      // Construct SQL query with filters
      $sql = "SELECT * FROM logs WHERE 1=1";

      if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
        $employeeIdFilter = $conn->real_escape_string($_GET['employee_id']);
        $sql .= " AND employee_id = '$employeeIdFilter'";
      }

      if (isset($_GET['section']) && !empty($_GET['section'])) {
        $sectionFilter = $conn->real_escape_string($_GET['section']);
        $sql .= " AND section = '$sectionFilter'";
      }

      if (isset($_GET['date']) && !empty($_GET['date'])) {
        $dateFilter = $conn->real_escape_string($_GET['date']);
        $sql .= " AND DATE(date_time) = '$dateFilter'";
      }

      $sql .= " ORDER BY id DESC LIMIT $offset, $recordsPerPage;";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
                <th>Employee ID</th>
                <th>Section</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $row['employee_id'] . "</td>";
          echo "<td>" . $row['section'] . "</td>";
          echo "<td>" . $row['description'] . "</td>";
          echo "<td>" . date('Y-m-d', strtotime($row['date_time'])) . "</td>";
          echo "<td>" . date('H:i:s A', strtotime($row['date_time'])) . "</td>";
          echo "</tr>";
        }

        echo "</table>";
        echo "</div>";

        // Display pagination links with previous and next buttons
        $sql = "SELECT COUNT(*) AS total FROM logs WHERE 1=1";

        if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
          $employeeIdFilter = $conn->real_escape_string($_GET['employee_id']);
          $sql .= " AND employee_id = '$employeeIdFilter'";
        }

        if (isset($_GET['section']) && !empty($_GET['section'])) {
          $sectionFilter = $conn->real_escape_string($_GET['section']);
          $sql .= " AND section = '$sectionFilter'";
        }

        if (isset($_GET['date']) && !empty($_GET['date'])) {
          $dateFilter = $conn->real_escape_string($_GET['date']);
          $sql .= " AND DATE(date_time) = '$dateFilter'";
        }

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $totalRecords = $row['total'];
        $totalPages = ceil($totalRecords / $recordsPerPage);

        echo "<div class='pagination'>";

        // Previous button
        if ($page > 1) {
          echo "<a href='?page=1" . buildFilterQueryString() . "'>&laquo;&laquo;</a>"; // First page link
          echo "<a href='?page=" . ($page - 1) . buildFilterQueryString() . "'>&laquo;</a>"; // Previous page link
        }

        // Page numbers
        $startPage = max(1, $page - 2);
        $endPage = min($totalPages, $startPage + 4);

        for ($i = $startPage; $i <= $endPage; $i++) {
          // Add the "active" class to the current page link
          $activeClass = ($i == $page) ? "active" : "";
          echo "<a href='?page=$i" . buildFilterQueryString() . "' class='$activeClass'>$i</a>";
        }

        // Next button
        if ($page < $totalPages) {
          echo "<a href='?page=" . ($page + 1) . buildFilterQueryString() . "'>&raquo;</a>"; // Next page link
          echo "<a href='?page=$totalPages" . buildFilterQueryString() . "'>&raquo;&raquo;</a>"; // Last page link
        }

        echo "</div>";

      } else {
        echo "0 results";
      }

      $conn->close();

      // Function to build filter query string
      function buildFilterQueryString()
      {
        $filterQueryString = "";

        if (isset($_GET['employee_id']) && !empty($_GET['employee_id'])) {
          $filterQueryString .= "&employee_id=" . urlencode($_GET['employee_id']);
        }

        if (isset($_GET['section']) && !empty($_GET['section'])) {
          $filterQueryString .= "&section=" . urlencode($_GET['section']);
        }

        if (isset($_GET['date']) && !empty($_GET['date'])) {
          $filterQueryString .= "&date=" . urlencode($_GET['date']);
        }

        return $filterQueryString;
      }
      ?>
    </div>
  </div>

<div class="footer">
  <div class="foot-txt">
  <img src="images/footer.png" style="height: 100%; width: 80%;">
  </div>

  <div class="foot-txt">
      <font style="font-weight: 700;">REPUBLIC OF THE PHILIPPINES</font>
      All content is in the public domain unless otherwise stated.
  </div>

  <div class="foot-txt">
    <font style="font-weight: 700;">ABOUT GOVPH</font>
    Learn more about the Philippine government, its structure, how government works and the people behind it.
  </div>
</div>



</body>
</html>