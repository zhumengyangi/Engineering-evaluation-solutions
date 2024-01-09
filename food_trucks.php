<?php

$file = fopen('Mobile_Food_Facility_Permit.csv', 'r');
if ($file) {
    while (($data = fgetcsv($file)) !== FALSE) {
        $locationId = $data[0];
        $applicant = $data[1];
        $facilityType = $data[2];
        $cnn = $data[3];
        $locationDescription = $data[4];
        
        // 定义食车数据存储数据到数组中
        $food_trucks[] = [
            'id' => $locationId,
            'applicant' => $applicant,
            'facilityType' => $applicant,
            'cnn' => $applicant,
            'locationDescription' => $applicant,
            'address' => $applicant,
            'applicant' => $applicant,
        ];
    }
    fclose($file);
} else {
    echo "无法打开文件"; exit;
}


// 获取请求的位置 ID
$location_id = isset($_GET["locationid"]) ? $_GET["locationid"] : null;

// 如果未提供位置 ID，则显示所有食车
if ($location_id === null) {
    echo json_encode($food_trucks);
    exit;
}

// 过滤出与请求位置 ID 匹配的食车
$filtered_food_trucks = array_filter($food_trucks, function ($food_truck) use ($location_id) {
    return $food_truck["id"] === $location_id;
});

// 如果找到匹配的食车，则显示它们
if (count($filtered_food_trucks) > 0) {
    echo json_encode(array_values($filtered_food_trucks));
    exit;
}

// 如果未找到匹配的食车，则显示错误消息
http_response_code(404);
echo json_encode([
    "error" => "No food trucks found for the given location ID.",
]);
