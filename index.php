<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Raid Planning Tool";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert the form handling code here
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $characterName = $_POST['characterName'];
    $class = $_POST['class'];
    $spec = $_POST['spec'];
    $itemLevel = $_POST['itemLevel'];

    // Prepare an SQL statement
    $stmt = $conn->prepare("INSERT INTO Player (CharacterName, Class, Specialization, ItemLevel) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $characterName, $class, $spec, $itemLevel);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Raider added successfully!";
    } else {
        echo "Failed to add raider: " . $stmt->error;
    }
    // Close the statement
    $stmt->close();
}

if (isset($_GET['delete_id'])) {
    // Get the id of the record to delete
    $delete_id = $_GET['delete_id'];

    // Prepare a SQL statement to delete the record
    $stmt = $conn->prepare("DELETE FROM Player WHERE PlayerID = ?");
    $stmt->bind_param("i", $delete_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Player deleted successfully!";
    } else {
        echo "Failed to delete player: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raid Planning Tool
    </title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <link rel="stylesheet" type="text/css" href="fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="noscript.css">
    <style>
        /* Basic styling for the form and table */
        table {
            border-collapse: collapse;
            width: 85%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #raiderForm div {
            display: inline-block;
            margin-right: 10px;
        }

        #instances {
            width: 200px;
            padding: 5px;
            border: 1px solid;
            border-radius: 4px;
            box-sizing: border-box;
        }

        a[data-tooltip] {
            position: relative;
        }

        a[data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            left: 0;
            top: 100%;
            white-space: nowrap;
            z-index: 10;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }

        .tooltip-link {
            position: relative;
        }

        .tooltip-link:hover .tooltip-content {
            display: block;
            position: absolute;
            left: 0;
            top: 100%;
            white-space: nowrap;
            z-index: 10;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <center>
        <h1>Raid Planning Tool</h1>
        <center>
            <form id="raiderForm" method="post">
                <form id="raiderForm">
                    <div>
                        <label for="characterName">Character Name:</label>
                        <input type="text" id="characterName" name="characterName" required>
                    </div>

                    <div>
                        <label for="class">Class:</label>
                        <select id="class" name="class" required>
                            <option value="">Select Class</option>
                            <option value="Warrior">Warrior</option>
                            <option value="Paladin">Paladin</option>
                            <option value="Hunter">Hunter</option>
                            <option value="Rogue">Rogue</option>
                            <option value="Priest">Priest</option>
                            <option value="Death Knight">Death Knight</option>
                            <option value="Shaman">Shaman</option>
                            <option value="Mage">Mage</option>
                            <option value="Warlock">Warlock</option>
                            <option value="Monk">Monk</option>
                            <option value="Druid">Druid</option>
                            <option value="Demon Hunter">Demon Hunter</option>
                        </select>
                    </div>

                    <div>
                        <label for="spec">Spec:</label>
                        <select id="spec" name="spec" required>
                            <option value="">Select Spec</option>
                            <option value="Fury">Fury</option>
                            <option value="Protection">Protection</option>
                            <option value="Arms">Arms</option>
                            <option value="Assassination">Assassination</option>
                            <option value="Outlaw">Outlaw</option>
                            <option value="Subtlety">Subtlety</option>
                            <option value="Discipline">Discipline</option>
                            <option value="Marksman">Marksman</option>
                            <option value="Beast Mastery">Beast Mastery</option>
                            <option value="Survival">Survival</option>
                            <option value="Holy">Holy</option>
                            <option value="Shadow">Shadow</option>
                            <option value="Blood">Blood</option>
                            <option value="Frost">Frost</option>
                            <option value="Unholy">Unholy</option>
                            <option value="Elemental">Elemental</option>
                            <option value="Enhancement">Enhancement</option>
                            <option value="Restoration">Restoration</option>
                            <option value="Arcane">Arcane</option>
                            <option value="Fire">Fire</option>
                            <option value="Frost">Frost</option>
                            <option value="Affliction">Affliction</option>
                            <option value="Demonology">Demonology</option>
                            <option value="Destruction">Destruction</option>
                            <option value="Brewmaster">Brewmaster</option>
                            <option value="Mistweaver">Mistweaver</option>
                            <option value="Windwalker">Windwalker</option>
                            <option value="Balance">Balance</option>
                            <option value="Feral">Feral</option>
                            <option value="Guardian">Guardian</option>
                            <option value="Havoc">Havoc</option>
                            <option value="Vengeance">Vengeance</option>
                        </select>
                        </select>
                    </div>

                    <div>
                        <label for="itemLevel">Item Level:</label>
                        <input type="number" id="itemLevel" name="itemLevel" style="color: black;" required>
                    </div>

                    <button type="submit">Add Raider</button>
                </form>

                <label for="instances">Instance:</label>
                <?php
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection Error: " . @$conn->connect_error);
                }

                $sql = "SELECT * FROM INSTANCE";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<span style='font-size: 18px; font-weight: bold;'>" . $row["Iname"] . ". Difficulty: " . $row["Idifficulty"] . "      " . "</span>";
                        echo "<button onclick='modifyInstance()'>Change</button>";
                    }
                }

                $conn->close();
                ?>


            </form>
            </select>
            </form>
            </form>

            <h2>Raider List</h2>
            <?php

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection Fialed" . $conn->connect_error);

            }
            $sql = "SELECT PlayerID, Class, Specialization, CharacterName, ItemLevel, LootAssignedID FROM Player";
            $result = $conn->query($sql);

            $result = $conn->query($sql);

            // Count the number of rows
            $num_rows = $result->num_rows;

            // Display the number of rows above the table
            echo "<p>$num_rows Players</p>";

            if ($result->num_rows > 0) {
                // Output data of each row
                echo "<table>";
                echo "<tr><th>Name</th><th>Class</th><th>Specialization</th><th>Item Level</th><th>Loot Reserved</th><th>Action</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["CharacterName"] . "</td>";
                    echo "<td>" . $row["Class"] . "</td>";
                    echo "<td>" . $row["Specialization"] . "</td>";
                    echo "<td>" . $row["ItemLevel"] . "</td>";

                    // Check if ItemAssignedID is empty
                    if ($row["LootAssignedID"] == "") {
                        echo "<td>No loot assigned</td>";
                    } else {

                        // Get the loot details from the database
                        $sql_loot = "SELECT ItemName, ItemType, Stat FROM LOOT WHERE ItemID = " . $row["LootAssignedID"];
                        $result_loot = $conn->query($sql_loot);
                        if ($result_loot->num_rows > 0) {
                            $row_loot = $result_loot->fetch_assoc();
                            // Prepare the item details
                            $item_details = '<div class="item-details" style="display: none;">' .
                                'Type: ' . $row_loot["ItemType"] . '<br>' .
                                'Stat: ' . $row_loot["Stat"] . '</div>';
                            // Display the item name with a link that shows or hides the item details
                            echo '<td><a href="#" class="item-link" onclick="showHideItemDetails(event)">' . $row_loot["ItemName"] . '</a>' . $item_details . '</td>';
                        } else {
                            echo "<td>No loot assigned</td>";
                        }
                    }

                    // Action buttons
                    echo "<td>";
                    echo "<a href='modify.php?player_id=" . $row["PlayerID"] . "'>Modify</a> | ";
                    echo "<a href='index.php?delete_id=" . $row["PlayerID"] . "' onclick='return confirm(\"Are you sure you want to delete this player?\")'>Delete</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "0 results";
            }

            $conn->close();

            ?>
            <script>
                function addRaider() {
                    // Get the values from the form
                    $characterName = $_POST['characterName'];
                    $class = $_POST['class'];
                    $spec = $_POST['spec'];
                    $itemLevel = $_POST['itemLevel'];

                    // Insert the values into the Player table
                    $sql_insert = "INSERT INTO Player (CharacterName, Class, Specialization, ItemLevel) VALUES ('$characterName', '$class', '$spec', '$itemLevel')";
                    $conn -> query($sql_insert);

                    // Check if the insertion was successful
                    if ($conn -> affected_rows > 0) {
            echo "Raider added successfully!";
                    } else {
            echo "Failed to add raider.";
                    }
                }
            </script>

            <script>
                function showHideItemDetails(event) {
                    event.preventDefault();
                    var itemDetails = event.target.nextElementSibling;
                    if (itemDetails.style.display === "none") {
                        itemDetails.style.display = "block";
                    } else {
                        itemDetails.style.display = "none";
                    }
                }
            </script>
</body>

</html>