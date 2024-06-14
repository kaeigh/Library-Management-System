<?php
	$timezone = 'Asia/Manila';
	date_default_timezone_set($timezone);
?>

<?php

            $sql = "SELECT * FROM book";
            $result = mysqli_query($conn, $sql);
            if ($result) {
               while ($row = mysqli_fetch_assoc($result)) {
                  $isbn = $row['isbn'];
                  $title = $row['title'];
                  $author = $row['author'];
                  $publication_date = $row['publication_date'];
                  echo '<tr>
                  <td>' . $isbn . '</td>
                  <td>' . $title . '</td>
                  <td>' . $author . '</td>
                  <td>' . $publication_date . '</td>
                  <td>
               available
            </td>
                  <td>
               <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#qrCodeModal<?= $studentID ?>"><img src="https://cdn-icons-png.flaticon.com/512/1341/1341632.png" alt="" width="16"></button>

            </td>
                  </tr>';
               }
            }

            ?>