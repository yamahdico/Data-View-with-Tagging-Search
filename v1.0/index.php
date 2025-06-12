<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Sub-domains of Al-Zahra</title>
  <link href="tailwind.min.css" rel="stylesheet" />
  <script src="alpine.min.js" defer></script>

  <link rel="icon" type="image/x-icon" href="favicon.ico">
  <link rel="shortcut icon" type="image/png" href="favicon.png" />


</head>

<body class="bg-grey-100 px-3 font-sans leading-normal tracking-normal">
  <div class="container pt-8 mx-auto" x-data="loadEmployees()">
    <input x-ref="searchField" x-model="search" x-on:keydown.window.prevent.slash="$refs.searchField.focus()"
      placeholder="Search for an Sub-domains..." type="search"
      class="block w-full bg-gray-200 focus:outline-none focus:bg-white focus:shadow text-gray-700 font-bold rounded-lg px-4 py-3" />
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
      <template x-for="item in filteredEmployees" :key="item">
        <div
          class="flex items-center shadow hover:bg-indigo-100 hover:shadow-lg hover:rounded transition duration-150 ease-in-out transform hover:scale-100 p-5">
          <img class="w-10 h-10 rounded-full mr-4" :src="`${item.profile_image}`" />
          <div class="text-sm">
            <p class="text-gray-900 leading-none" x-text="item.title"></p>
            <p><a class="text-gray-600" x-bind:href="'https://'+item.url" x-text="item.url" target="_blank"></a>
            <p x-text="item.owner"></p>
            </a></p><br>
            <p class="text-gray-600">
              <a class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded"
                x-bind:href="'https://'+item.admin" target="_blank">مدیریت</a>
            </p>
          </div>
        </div>
      </template>
    </div>
  </div>
  <script>
    function loadEmployees() {
      return {
        search: "",
        myForData: sourceData,
        get filteredEmployees() {
          if (this.search === "") {
            return this.myForData;
          }
          return this.myForData.filter((item) => {
            return item.title
              .toLowerCase()
              .includes(this.search.toLowerCase());
          });
        },
      };
    }
    var sourceData = 
	
<?php
$dbPath = "itm-jz.db";

// نام جدول

try {
    // اتصال به دیتابیس SQLite
    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // اجرای کوئری برای دریافت تمام داده‌های جدول
    $stmt = $pdo->query("SELECT * FROM subdomains");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // تنظیم هدر JSON
    //header('Content-Type: application/json; charset=utf-8');

    // تبدیل داده‌ها به فرمت JSON و نمایش
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    // مدیریت خطاها
    //header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error" => $e->getMessage()]);
}
?>

  </script>
</body>

</html>
