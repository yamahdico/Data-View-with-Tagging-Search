<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <title>تگ‌های رنگی با AlpineJS و Tailwind</title>
  <script src="alpine3.x.x.min.js" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6 font-sans" x-data="employeeFilter()">

  <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
    
    <!-- Header -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">سامانه‌ها با تگ‌های رنگی</h1>

    <!-- Controls -->
    <div class="flex flex-col md:flex-row items-start md:items-center gap-4 mb-6">
      <input type="text" x-model="search" placeholder="جستجو..." class="w-full md:w-1/2 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
      
      <div class="flex items-center gap-2">
        <label for="field" class="text-gray-600">جستجو در:</label>
        <select x-model="searchField" id="field" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-400">
          <option value="all">همه فیلدها</option>
          <option value="title">عنوان</option>
          <option value="description">توضیحات</option>
        </select>
      </div>
    </div>

    <!-- Tags -->
    <div class="flex flex-wrap gap-2 mb-6">
      <span
        class="cursor-pointer px-3 py-1 text-sm rounded-full border"
        :class="selectedTag === '' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-800 hover:bg-gray-300'"
        @click="toggleTag('')"
      >همه موارد</span>

      <template x-for="tag in allTags" :key="tag">
        <span
          class="cursor-pointer px-3 py-1 text-sm rounded-full border"
          :class="selectedTag === tag ? getTagClass(tag) + ' text-white' : getTagClass(tag, false)"
          @click="toggleTag(tag)"
          x-text="tag"
        ></span>
      </template>
    </div>

    <!-- تعداد نتایج -->
    <div class="mb-4 text-gray-700">
      <span class="font-medium">تعداد موارد یافت‌شده:</span>
      <span x-text="filteredItems.length"></span>
    </div>

    <!-- Items -->
    <template x-if="filteredItems.length === 0">
      <p class="text-gray-500">موردی یافت نشد.</p>
    </template>

    <template x-for="item in filteredItems" :key="item.id">
      <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-4 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-800 mb-2" x-text="item.title"></h3>
        <p class="text-gray-600 mb-1"><strong>توضیحات:</strong> <span x-text="item.description"></span></p>
        <p class="text-gray-500 mb-2"><strong>مدیر:</strong> <span x-text="item.adminer"></span></p>
        <div class="flex flex-wrap gap-1 mt-2">
          <template x-for="tag in item.tags">
            <span class="text-xs px-2 py-0.5 rounded-full text-white" :class="getTagClass(tag)" x-text="tag"></span>
          </template>
        </div>
      </div>
    </template>
  </div>


  <script>
    function employeeFilter() {
      const sourceData = 
	
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
	foreach ($rows as &$row) {
    // اگر tags به صورت رشته‌ای از تگ‌هاست (مثلاً: "اساتید,مالی")
    // آن را به آرایه تبدیل کن
    if (isset($row['tags'])) {
        $tags = explode(',', $row['tags']);  // جدا کردن با ویرگول
        $tags = array_map('trim', $tags);    // حذف فاصله اضافی
        $row['tags'] = $tags;
    }
}
    echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    // مدیریت خطاها
    //header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["error" => $e->getMessage()]);
}
?>

  
      const tagColorMap = {
        "مالی": "bg-green-500",
        "اساتید": "bg-purple-500",
        "حقوق": "bg-red-500",
        "پشتیبانی": "bg-yellow-500",
        "فناوری": "bg-blue-500"
      };

      return {
        search: '',
        searchField: 'all',
        selectedTag: '',
        items: sourceData,

        get allTags() {
          return [...new Set(this.items.flatMap(i => i.tags))].sort();
        },

        toggleTag(tag) {
          this.selectedTag = tag;
        },

        getTagClass(tag, isActive = true) {
          const base = tagColorMap[tag] || 'bg-gray-500';
          return isActive ? `${base}` : `${base} bg-opacity-30 text-gray-800`;
        },

        get filteredItems() {
          return this.items.filter(item => {
            const s = this.search.toLowerCase();
            const inTitle = (item.title || "").toLowerCase().includes(s);
            const inDesc = (item.description || "").toLowerCase().includes(s);

            const matchesSearch =
              this.searchField === 'title' ? inTitle :
              this.searchField === 'description' ? inDesc :
              inTitle || inDesc;

            const matchesTag = this.selectedTag === '' || item.tags.includes(this.selectedTag);
            return matchesSearch && matchesTag;
          });
        }
      };
    }
  </script>
</body>
</html>
