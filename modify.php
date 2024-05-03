<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "Raid Planning Tool";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['player_id'])) {
    // Get the current data of the player
    $stmt = $conn->prepare("SELECT * FROM Player WHERE PlayerID = ?");
    $stmt->bind_param("i", $_GET['player_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $player = $result->fetch_assoc();
    $stmt->close();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update the player's data
    $stmt = $conn->prepare("UPDATE Player SET CharacterName = ?, Class = ?, Specialization = ?, ItemLevel = ?, LootAssignedID = ? WHERE PlayerID = ?");
    $stmt->bind_param("sssiii", $_POST['characterName'], $_POST['class'], $_POST['spec'], $_POST['itemLevel'], $_POST['item'], $_POST['player_id']);
    if ($stmt->execute()) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $stmt->error;
    }
    $stmt->close();

    // Redirect back to the index page
    header("Location: index.php");
    exit;
}
?>

?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="main.css">
<link rel="stylesheet" type="text/css" href="fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="noscript.css">

<body>

    <h2>Modify Player</h2>

    <!DOCTYPE html>
    <html>

    <body>

        <form method="post">
            <input type="hidden" name="player_id" value="<?php echo $player['PlayerID']; ?>">

            <div>
                <label for="characterName">Character Name:</label>
                <input type="text" id="characterName" name="characterName"
                    value="<?php echo $player['CharacterName']; ?>" required>
            </div>

            <div>
                <label for="class">Class:</label>
                <select id="class" name="class" required>
                    <option value="">Select Class</option>
                    <option value="Warrior" <?php if ($player['Class'] == 'Warrior')
                        echo 'selected'; ?>>Warrior</option>
                    <option value="Paladin" <?php if ($player['Class'] == 'Paladin')
                        echo 'selected'; ?>>Paladin</option>
                    <option value="Hunter" <?php if ($player['Class'] == 'Hunter')
                        echo 'selected'; ?>>Hunter</option>
                    <option value="Rogue" <?php if ($player['Class'] == 'Rogue')
                        echo 'selected'; ?>>Rogue</option>
                    <option value="Priest" <?php if ($player['Class'] == 'Priest')
                        echo 'selected'; ?>>Priest</option>
                    <option value="Death Knight" <?php if ($player['Class'] == 'Death Knight')
                        echo 'selected'; ?>>Death
                        Knight</option>
                    <option value="Shaman" <?php if ($player['Class'] == 'Shaman')
                        echo 'selected'; ?>>Shaman</option>
                    <option value="Mage" <?php if ($player['Class'] == 'Mage')
                        echo 'selected'; ?>>Mage</option>
                    <option value="Warlock" <?php if ($player['Class'] == 'Warlock')
                        echo 'selected'; ?>>Warlock</option>
                    <option value="Monk" <?php if ($player['Class'] == 'Monk')
                        echo 'selected'; ?>>Monk</option>
                    <option value="Druid" <?php if ($player['Class'] == 'Druid')
                        echo 'selected'; ?>>Druid</option>
                    <option value="Demon Hunter" <?php if ($player['Class'] == 'Demon Hunter')
                        echo 'selected'; ?>>Demon
                        Hunter</option>
                </select>
            </div>

            <div>
                <label for="spec">Spec:</label>
                <select id="spec" name="spec" required>
                    <option value="">Select Spec</option>
                    <option value="Fury" <?php if ($player['Specialization'] == 'Fury')
                        echo 'selected'; ?>>Fury</option>
                    <option value="Protection" <?php if ($player['Specialization'] == 'Protection')
                        echo 'selected'; ?>>
                        Protection</option>
                    <option value="Arms" <?php if ($player['Specialization'] == 'Arms')
                        echo 'selected'; ?>>Arms</option>
                    <option value="Assassination" <?php if ($player['Specialization'] == 'Assassination')
                        echo 'selected'; ?>>Assassination</option>
                    <option value="Outlaw" <?php if ($player['Specialization'] == 'Outlaw')
                        echo 'selected'; ?>>Outlaw
                    </option>
                    <option value="Subtlety" <?php if ($player['Specialization'] == 'Subtlety')
                        echo 'selected'; ?>>
                        Subtlety</option>
                    <option value="Discipline" <?php if ($player['Specialization'] == 'Discipline')
                        echo 'selected'; ?>>
                        Discipline</option>
                    <option value="Marksman" <?php if ($player['Specialization'] == 'Marksman')
                        echo 'selected'; ?>>
                        Marksman</option>
                    <option value="Beast Mastery" <?php if ($player['Specialization'] == 'Beast Mastery')
                        echo 'selected'; ?>>Beast Mastery</option>
                    <option value="Survival" <?php if ($player['Specialization'] == 'Survival')
                        echo 'selected'; ?>>
                        Survival</option>
                    <option value="Holy" <?php if ($player['Specialization'] == 'Holy')
                        echo 'selected'; ?>>Holy</option>
                    <option value="Shadow" <?php if ($player['Specialization'] == 'Shadow')
                        echo 'selected'; ?>>Shadow
                    </option>
                    <option value="Blood" <?php if ($player['Specialization'] == 'Blood')
                        echo 'selected'; ?>>Blood
                    </option>
                    <option value="Frost" <?php if ($player['Specialization'] == 'Frost')
                        echo 'selected'; ?>>Frost
                    </option>
                    <option value="Unholy" <?php if ($player['Specialization'] == 'Unholy')
                        echo 'selected'; ?>>Unholy
                    </option>
                    <option value="Elemental" <?php if ($player['Specialization'] == 'Elemental')
                        echo 'selected'; ?>>
                        Elemental</option>
                    <option value="Enhancement" <?php if ($player['Specialization'] == 'Enhancement')
                        echo 'selected'; ?>>
                        Enhancement</option>
                    <option value="Restoration" <?php if ($player['Specialization'] == 'Restoration')
                        echo 'selected'; ?>>
                        Restoration</option>
                    <option value="Arcane" <?php if ($player['Specialization'] == 'Arcane')
                        echo 'selected'; ?>>Arcane
                    </option>
                    <option value="Fire" <?php if ($player['Specialization'] == 'Fire')
                        echo 'selected'; ?>>Fire</option>
                    <option value="Frost" <?php if ($player['Specialization'] == 'Frost')
                        echo 'selected'; ?>>Frost
                    </option>
                    <option value="Affliction" <?php if ($player['Specialization'] == 'Affliction')
                        echo 'selected'; ?>>
                        Affliction</option>
                    <option value="Demonology" <?php if ($player['Specialization'] == 'Demonology')
                        echo 'selected'; ?>>
                        Demonology</option>
                    <option value="Destruction" <?php if ($player['Specialization'] == 'Destruction')
                        echo 'selected'; ?>>
                        Destruction</option>
                    <option value="Brewmaster" <?php if ($player['Specialization'] == 'Brewmaster')
                        echo 'selected'; ?>>
                        Brewmaster</option>
                    <option value="Mistweaver" <?php if ($player['Specialization'] == 'Mistweaver')
                        echo 'selected'; ?>>
                        Mistweaver</option>
                    <option value="Windwalker" <?php if ($player['Specialization'] == 'Windwalker')
                        echo 'selected'; ?>>
                        Windwalker</option>
                    <option value="Balance" <?php if ($player['Specialization'] == 'Balance')
                        echo 'selected'; ?>>Balance
                    </option>
                    <option value="Feral" <?php if ($player['Specialization'] == 'Feral')
                        echo 'selected'; ?>>Feral
                    </option>
                    <option value="Guardian" <?php if ($player['Specialization'] == 'Guardian')
                        echo 'selected'; ?>>
                        Guardian</option>
                    <option value="Havoc" <?php if ($player['Specialization'] == 'Havoc')
                        echo 'selected'; ?>>Havoc
                    </option>
                    <option value="Vengeance" <?php if ($player['Specialization'] == 'Vengeance')
                        echo 'selected'; ?>>
                        Vengeance</option>
                </select>
            </div>
            <div>
                <label for="item">Item:</label>
                <select id="item" name="item" >
                    <option value="">Select Item</option>
                    <?php
                    $sql = "SELECT * FROM LOOT";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['ItemID'] . '">' . $row['ItemName'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <label for="itemLevel">Item Level:</label>
                <input type="number" id="itemLevel" name="itemLevel" style="color: black;" min="1" step="1" required
                    value="<?php echo $player['ItemLevel']; ?>">
            </div>
            </div>

            <button type="submit">Submit</button>
            <button type="button" onclick="window.location.href='index.php'">Cancel</button>
        </form>

    </body>

    </html>