<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lấy tọa độ hiện tại và địa điểm hiện tại</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    table {
      width: 100%;
      margin-top: 20px;
    }

    table th,
    table td {
      text-align: left;
      padding: 8px;
    }
  </style>
</head>

<body>
  <?php
  define('__ROOT__', dirname(dirname(__FILE__)));

  require_once(__ROOT__ . '/component/navbar.php');

  ?>
  <div class="container pt-5 pb-5">
    <h2 class="mt-3">Lấy tọa độ hiện tại và địa điểm hiện tại</h2>
    <button class="btn btn-primary" onclick="getLocation()">
      Lấy vị trí hiện tại
    </button>
    <p id="coordinates" class="mt-3"></p>
    <div id="locationDetails" class="mt-3">
      <h3>Thông tin địa điểm:</h3>
      <ul class="list-group">
        <li class="list-group-item">Thành phố: <span id="city"></span></li>
        <li class="list-group-item">Quốc gia: <span id="country"></span></li>
        <li class="list-group-item">
          Mã bưu chính: <span id="postcode"></span>
        </li>
        <li class="list-group-item">Quận/huyện: <span id="suburb"></span></li>
        <li class="list-group-item">Phường/xã: <span id="quarter"></span></li>
      </ul>
    </div>
    <div id="medicalFacilities" class="mt-3">
      <h3>Các cơ sở y tế của phường:</h3>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Mã số</th>
            <th scope="col">Tên</th>
            <th scope="col">Địa chỉ</th>
          </tr>
        </thead>
        <tbody id="medical-facilities"></tbody>
      </table>
    </div>
  </div>
  <?php

  require_once(__ROOT__ . '/component/footer.php');

  ?>
  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../js/location.js"></script>

  <script>
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        alert("Trình duyệt của bạn không hỗ trợ định vị địa lý.");
      }
    }

    function showPosition(position) {
      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
      var coordinates =
        "Tọa độ hiện tại của bạn là: " + latitude + ", " + longitude;

      document.getElementById("coordinates").innerHTML = coordinates;

      // Gửi yêu cầu đến API để lấy thông tin địa chỉ từ tọa độ
      fetch(
          `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${latitude}&lon=${longitude}`
        )
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
          // In ra các thông tin cần thiết vào DOM
          document.getElementById("city").innerHTML = data.address.city;
          document.getElementById("country").innerHTML = data.address.country;
          document.getElementById("postcode").innerHTML =
            data.address.postcode;
          document.getElementById("suburb").innerHTML = data.address.suburb;
          document.getElementById("quarter").innerHTML = data.address.quarter;

          return data.address.suburb;
        })
        .then((suburb) => {
          console.log(suburb);
          const hospitalNearnest = locationData["Hà Nội"].filter((item) => {
            console.log(Object.keys(item).toString());
            return (
              Object.keys(item).toString().toLowerCase() ==
              suburb.toLowerCase()
            );
          });
          hospitalNearnest[0][
            Object.keys(hospitalNearnest[0]).toString()
          ]?.forEach((medicalStation) => {
            let tr = document.createElement("tr");

            let td1 = document.createElement("td");
            td1.textContent = medicalStation["Mã số"];

            let td2 = document.createElement("td");
            let aDirect = document.createElement("a");
            aDirect.target = "_blank";
            aDirect.href =
              "https://www.google.com/maps/dir/" +
              latitude +
              "," +
              longitude +
              "/" +
              encodeURIComponent(medicalStation["Tên"]);
            aDirect.textContent = medicalStation["Tên"];
            td2.appendChild(aDirect);

            let td3 = document.createElement("td");
            td3.textContent = medicalStation["Địa chỉ"];

            tr.appendChild(td1);
            tr.appendChild(td2);
            tr.appendChild(td3);

            document.getElementById("medical-facilities").appendChild(tr);
          });
        })
        .catch((error) => console.error("Error:", error));
    }
  </script>
</body>

</html>