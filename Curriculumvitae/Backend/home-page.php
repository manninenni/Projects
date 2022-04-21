<?php
require_once 'includes/header.php';
?>

<?php
/**
 *  file:   home-page.php
 *  desc:   Haetaan asiakkaita tietokannasta
 */
if (isset($_SESSION['userID'])) {
    require 'includes/database.php';
    
    $name = $_SESSION['name'];
    
    $sql = "SELECT * 
    FROM yksityistunnit
    INNER JOIN sukupuolet ON yksityistunnit.sukupuoliID = sukupuolet.sukupuoliID
    WHERE ohjaaja = '$name'";

    $result = $conn->query($sql);
    $rowCount = mysqli_num_rows($result);
?>

<h3 class="m-3">There are <?php echo $rowCount; ?> private lessons for you.</h3>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Customer</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Lesson topic</th>
        <th>Gender</th>
        <th>Belt rank</th>
      </tr>
    </thead>
    <tbody>
      <?php
      //tulostetaan $result-muuttujalta kaikki rivit while-silmukalle
      while ($row = $result->fetch_assoc()) {  // or foreach ($result as $row) 
          echo '<tr>';
          echo '<td>'.$row['nimi'].'</td>';
          echo '<td>'.$row['email'].'</td>';
          echo '<td>'.$row['puhelin'].'</td>';
          echo '<td>'.$row['oppituntiaihe'].'</td>';
          echo '<td>'.$row['sukupuoli'].'</td>';
          echo '<td>'.$row['vyoarvo'].'</td>';
          // echo '<td>'.number_format($row['price'], 0).'</td>';
          echo '</tr>';
      }
    } 
    $conn->close(); //hävittää yhteyden tiedot palvelimen muistista
    ?>
  </tbody>
</table>

<?php
require_once 'includes/footer.php';
?>