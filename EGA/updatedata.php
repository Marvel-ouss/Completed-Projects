<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Patient Profile</h2>
    
    <!-- Input bar and search button -->
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" name="search_query" placeholder="Enter Patient ID or Name">
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Display patient profile data here -->
    <?php
    // Include database connection file
    include "dbconnect.php";

    // Check if patient ID or name is provided in the form
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        // Retrieve form data
        $search_query = $_POST['search_query'];

        // Construct the SQL query to fetch patient data based on patient ID or name
        $sql = "SELECT * FROM patdata WHERE PatientID = '$search_query' OR fname LIKE '%$search_query%'";

        // Execute the query
        $result = mysqli_query($conn, $sql);

        // Check if any records found
        if (mysqli_num_rows($result) > 0) {
            // Fetch the patient data
            $row = mysqli_fetch_assoc($result);
            ?>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Patient ID</td>
                    <td><?php echo $row['PatientID']; ?></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><?php echo $row['fname']; ?></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><?php echo $row['lname']; ?></td>
                </tr>
                <tr>
                    <td>Hospital</td>
                    <td><span class="editable" data-field="Allergies&Treatment"><?php echo $row['Hospital']; ?></td>
                </tr>
                <!-- Additional patient data (data to be edited) -->

                <br><br>
                <h2>Update Patient Data</h2>

                <tr>
                    <td>Allergies&Treatment</td>
                    <td><span class="editable" data-field="Allergies&Treatment"><?php echo $row['Allergies&Treatment']; ?></span></td>
                </tr>
                <tr>
                    <td>Treatment History</td>
                    <td><span class="editable" data-field="TreatmentHistory"><?php echo $row['TreatmentHistory']; ?></span></td>
                </tr>
                <tr>
                    <td>Lab Results</td>
                    <td><span class="editable" data-field="LabResults"><?php echo $row['LabResults']; ?></span></td>
                </tr>
                <tr>
                    <td>Medical Directives</td>
                    <td><span class="editable" data-field="MedicalDirective"><?php echo $row['MedicalDirective']; ?></span></td>
                </tr>
                <!-- Add more rows for other patient attributes -->
            </table>
        <?php
        } else {
            echo "Patient not found.";
        }
    }
    ?>

</div>

<!-- Modal for editing -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <textarea id="editField" style="width: 100%; height: 200px;"></textarea>
        <button id="saveButton">Save</button>
    </div>
</div>

<script>
    // Get all editable fields
    var editableFields = document.querySelectorAll('.editable');

    // Add click event listener to each editable field
    editableFields.forEach(function(field) {
        field.addEventListener('click', function() {
            var value = this.textContent.trim();
            var fieldData = this.getAttribute('data-field');
            document.getElementById('editField').value = value;
            document.getElementById('editModal').style.display = 'block';

            // Save edited value to database
            document.getElementById('saveButton').onclick = function() {
                var newValue = document.getElementById('editField').value;
                this.parentNode.style.display = 'none';
                field.textContent = newValue;

                // Update database with the new value
                var patientID = '<?php echo $row["PatientID"]; ?>';
                var fieldName = field.getAttribute('data-field');
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Database updated successfully
                            console.log(xhr.responseText);
                        } else {
                            // Error occurred while updating database
                            console.error('Error:', xhr.statusText);
                        }
                    }
                };
                xhr.open('POST', 'updatedata.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('patientID=' + encodeURIComponent(patientID) + '&fieldName=' + encodeURIComponent(fieldName) + '&newValue=' + encodeURIComponent(newValue));
            };
        });
    });

    // Close the modal when clicking on the close button
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('editModal').style.display = 'none';
    });

    // Close the modal when clicking outside the modal content
    window.onclick = function(event) {
        var modal = document.getElementById('editModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    };
</script>

</body>
</html>

