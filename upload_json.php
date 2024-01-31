<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Σύνδεση με τη βάση δεδομένων
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "emergency_items";

    // Δημιουργία σύνδεσης
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Έλεγχος σύνδεσης
    if ($conn->connect_error) {
        die("Αποτυχία σύνδεσης: " . $conn->connect_error);
    }

    // Έλεγχος αν έχει επιλεγεί αρχείο JSON
    if ($_FILES["jsonFile"]["error"] == UPLOAD_ERR_OK) {
        $json_file = file_get_contents($_FILES["jsonFile"]["tmp_name"]);
        $data = json_decode($json_file, true);

        // Εισαγωγή δεδομένων κατηγοριών στη βάση
        foreach ($data['categories'] as $category) {
            $category_id = $category['id'];
            $category_name = $category['category_name'];

            $category_sql = "INSERT INTO categories (id, category_name)
                              VALUES ('$category_id', '$category_name')";

            if ($conn->query($category_sql) !== TRUE) {
                echo "Error inserting category record: " . $conn->error;
            }
        }

        // Εισαγωγή δεδομένων ειδών στη βάση
        foreach ($data['items'] as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $category = $item['category'];

            foreach ($item['details'] as $detail) {
                $detail_name = $detail['detail_name'];
                $detail_value = $detail['detail_value'];

                $sql = "INSERT INTO items (id, name, category, detail_name, detail_value)
                        VALUES ('$id', '$name', '$category', '$detail_name', '$detail_value')";

                if ($conn->query($sql) === TRUE) {
                    echo "Record inserted successfully";
                } else {
                    echo "Error inserting record: " . $conn->error;
                }
            }
        }
    } else {
        echo "Σφάλμα ανέβασματος αρχείου JSON: " . $_FILES["jsonFile"]["error"];
    }

    // Κλείσιμο σύνδεσης
    $conn->close();
}
?>
