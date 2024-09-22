<?php
define('__ROOT__', dirname(dirname(__FILE__)));

require_once(__ROOT__ . '/connect.php');
// Khởi tạo biến
$hospitalName = $averageRating = $reviews = null;


if (isset($_GET['hospitalName'])) {
    $hospitalName = $conn->real_escape_string($_GET['hospitalName']);

    // Thực hiện truy vấn để lấy thông tin bệnh viện, số sao trung bình và tất cả các nhận xét từ cơ sở dữ liệu
    $sql = "
        SELECT 
            rh.id_rate,
            rh.id_hopital,
            rh.id_user,
            rh.name AS hospital_name,
            rh.rating,
            rh.comment,
            rh.created_at,
            u.name AS user_name,
            u.address AS user_address,
            u.email AS user_email,
            u.username AS user_username,
            AVG(rh.rating) OVER (PARTITION BY rh.name) AS average_rating
        FROM 
            rate_hospitals rh
        JOIN 
            users u ON rh.id_user = u.id_user
        WHERE 
            rh.name = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $hospitalName);
    $stmt->execute();
    $result = $stmt->get_result();

    $hospitalInfo = [];
    $reviews = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Set hospital info if not already set
            if (empty($hospitalInfo)) {
                $hospitalInfo = [
                    'id_hopital' => $row['id_hopital'],
                    'hospital_name' => $row['hospital_name'],
                    'average_rating' => $row['average_rating']
                ];
                $averageRating = $hospitalInfo['average_rating'];
            }

            // Add review to reviews array
            $reviews[] = [
                'id_rate' => $row['id_rate'],
                'rating' => $row['rating'],
                'comment' => $row['comment'],
                'created_at' => $row['created_at'],
                'user_name' => $row['user_name'],
                'user_address' => $row['user_address'],
                'user_email' => $row['user_email'],
                'user_username' => $row['user_username']
            ];
        }
    }

    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_user = $_SESSION['id_user'] ?? null;
    if(!$id_user) {
        header("Location:" ."./login.php");
        die();
    }
    if (isset($_GET['hospitalName']) && isset($_POST['rating']) && isset($_POST['comment'])) {
        $hospitalName = $conn->real_escape_string($_GET['hospitalName']);
        $rating = (float)$_POST['rating'];
        $comment = $conn->real_escape_string($_POST['comment']);

        // Get the hospital ID from the hospital name
        $sql = "SELECT id_hopital FROM crud_hopital_location WHERE name = '$hospitalName'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $hospitalId = $row['id_hopital'];

            // Insert the rating into the database
            $sql = "INSERT INTO rate_hospitals (id_hopital, id_user, name, rating, comment) VALUES ($hospitalId, $id_user, '$hospitalName', $rating, '$comment')";
            if ($conn->query($sql) === TRUE) {
                // If insertion is successful, refresh the page to display the new comment
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Hospital not found.";
        }
    } else {
        echo "Invalid request. All fields are required.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .autocomplete-items {
            max-height: 250px;
            overflow-y: auto;
        }

        h1,
        h2,
        h3,
        h3 {
            margin: 0 !important;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
            background-color: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }

        .box-container {
            min-height: 50vh;
        }

        /* Star Rating CSS */
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
        }

        .star-rating input[type="radio"] {
            display: none;
        }

        .star-rating label {
            font-size: 25px;
            color: #ccc;
            cursor: pointer;
        }

        .star-rating label:hover,
        .star-rating label:hover~label,
        .star-rating input[type="radio"]:checked~label {
            color: #ffc107;
            /* Change color when hovered or selected */
        }

        /* Review Section CSS */
        .review-section {
            margin-top: 30px;
        }

        .review-content h6 {
            margin: 0;
        }

        .review-content i {
            font-size: 13px;
            margin-left: 5px;
        }


        .review-content .name {
            display: flex;
        }




        .review-list {
            list-style: none;
            padding: 0;
        }

        .review-list li {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .review-list li:last-child {
            border-bottom: none;
        }

        .hospital-info {
            text-align: center;
        }

        .hospital-info img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            /* để làm hình tròn */
            margin-bottom: 10px;
            /* Khoảng cách giữa ảnh và các phần tử khác */
        }

        .review-list li {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #0000001f !important;
        }

        img.avt-user {
            align-self: self-start;
            width: 40px;
            height: 40px;
            margin: 0 10px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid red;
        }

        .star-filled {
            color: orange;
            /* Màu cho sao được đánh giá */
        }

        .star-unfilled {
            color: grey;
            /* Màu cho sao không được đánh giá */
        }

        p {
            margin: 0 !important;
        }
    </style>
</head>

<body>
    <?php require_once(__ROOT__ . '/component/navbar.php'); ?>
    <div class="container box-container mt-5 pb-5">
        <div id="hospitalList" class="autocomplete-items"></div>
        <div class="infor-hopital pt-5 pb-5"></div>

        <?php if ($hospitalName) : ?>
            <div class="row justify-content-center review-section pb-5">
                <div class="col-md-6">
                    <h4>Nhận xét: </h4>
                    <b>
                        <?php
                        echo round($averageRating, 1) . " ";
                        // Tạo các dấu sao dựa trên số rating
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= round($averageRating)) {
                                echo "<span class='star-filled'>★</span>"; // Sử dụng ký tự sao (star) Unicode
                            } else {
                                echo "<span class='star-unfilled'>★</span>"; // Sử dụng ký tự sao (star) Unicode
                            }
                        }
                        ?> (<?php echo isset($reviews) && count($reviews) > 0 ? count($reviews) : 0; ?>)
                    </b>
                    <ul class="review-list">
                        <?php
                        if (isset($reviews) && count($reviews) > 0) {
                            foreach ($reviews as $review) {
                                $rating = intval($review["rating"]); // Chuyển đổi rating thành số nguyên
                        ?>
                                <li>
                                    <img src="https://cdn.sforum.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg" alt="" class="avt-user" srcset="">
                                    <div class="review-content">
                                        <div class="name">
                                            <h6><?php echo $review["user_username"]; ?></h6>
                                            <i><?php echo $review["created_at"]; ?></i>
                                        </div>
                                        <?php
                                        // Tạo các dấu sao dựa trên số rating
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo "<span class='star-filled'>★</span>"; // Sử dụng ký tự sao (star) Unicode
                                            } else {
                                                echo "<span class='star-unfilled'>★</span>"; // Sử dụng ký tự sao (star) Unicode
                                            }
                                        }
                                        ?>
                                        <p><?php echo $review["comment"]; ?></p>
                                    </div>
                                </li>
                            <?php
                            }
                        } else { ?>
                            <li>Chưa có nhận xét nào.</li>
                        <?php } ?>
                    </ul>

                </div>
            </div>
            <div class="row justify-content-center review-section">
                <div class="col-md-6">
                    <h4>Thêm nhận xét</h4>
                    <form id="reviewForm" action="" method="post">
                        <div class="form-group">
                            <div class="star-rating">
                                <input type="radio" id="rating1" name="rating" value="5">
                                <label for="rating1">&#9733;</label>
                                <input type="radio" id="rating2" name="rating" value="4">
                                <label for="rating2">&#9733;</label>
                                <input type="radio" id="rating3" name="rating" value="3">
                                <label for="rating3">&#9733;</label>
                                <input type="radio" id="rating4" name="rating" value="2">
                                <label for="rating4">&#9733;</label>
                                <input type="radio" id="rating5" name="rating" value="1">
                                <label for="rating5">&#9733;</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Nhận xét: </label>
                            <textarea class="form-control mt-2 mb-2" id="comment" name="comment" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm nhận xét</button>
                    </form>

                    <script>
                        document.getElementById('reviewForm').addEventListener('submit', function(event) {
                            var ratingChecked = document.querySelector('input[name="rating"]:checked');
                            var commentValue = document.getElementById('comment').value.trim();

                            if (!ratingChecked || commentValue === '') {
                                alert('Vui lòng điền đầy đủ cả rating và nhận xét.');
                                event.preventDefault(); // Ngăn form được submit
                            }
                        });
                    </script>

                </div>
            </div>
        <?php endif; ?>
    </div>
    </div>
    <?php require_once(__ROOT__ . '/component/footer.php'); ?>

    <?php
    $hospitalName = $_GET['hospitalName'] ?? ''; // Assuming hospitalName is passed as a GET parameter

    if ($hospitalName) {
        // Fetch hospital data
        $stmt = $conn->prepare("SELECT name, address, specialist, image FROM crud_hopital_location WHERE name LIKE ?");
        $searchTerm = "%$hospitalName%";
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        $hospitals = [];
        while ($row = $result->fetch_assoc()) {
            $hospitals[] = $row;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php if (!empty($hospitals)) : ?>
                var hospitals = <?php echo json_encode($hospitals); ?>;
                hospitals.forEach(function(hospital) {
                    // Create HTML elements to display hospital information
                    var hospitalInfoDiv = document.createElement('div');
                    hospitalInfoDiv.classList.add('hospital-info', 'd-flex', 'flex-column', 'align-items-center');

                    var avatarHeading = document.createElement('img');
                    avatarHeading.classList.add('img-thumbnail', 'rounded-circle');
                    avatarHeading.src = hospital.image || "https://kientrucbenhvien.com/wp-content/uploads/2020/02/ben-vien-hung-vuong-1-1-1024x580.jpg";
                    hospitalInfoDiv.appendChild(avatarHeading);

                    var nameHeading = document.createElement('h3');
                    nameHeading.textContent = hospital.name;
                    hospitalInfoDiv.appendChild(nameHeading);

                    var addressParagraph = document.createElement('p');
                    addressParagraph.textContent = 'Địa chỉ: ' + hospital.address;
                    hospitalInfoDiv.appendChild(addressParagraph);

                    var specialtiesHeading = document.createElement('p');
                    specialtiesHeading.textContent = 'Chuyên khoa:';
                    hospitalInfoDiv.appendChild(specialtiesHeading);

                    var specialtiesList = document.createElement('ul');
                    var specialties = hospital.specialist ? hospital.specialist.split(',') : [];
                    specialties.forEach(function(specialty, index) {
                        var specialtyItem = document.createElement('b');
                        specialtyItem.textContent = specialty.trim();
                        if (index < specialties.length - 1) {
                            specialtyItem.textContent += ', ';
                        }
                        specialtiesList.appendChild(specialtyItem);
                    });

                    hospitalInfoDiv.appendChild(specialtiesList);

                    // Append hospital information to the DOM
                    var hospitalInfoContainer = document.querySelector('.infor-hopital');
                    hospitalInfoContainer.appendChild(hospitalInfoDiv);
                });
            <?php endif; ?>
        });
    </script>

</body>

</html>