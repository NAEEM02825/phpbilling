<?php
require('../functions.php'); // Assuming this includes MeekroDB
header('Content-Type: application/json');

$period = $_GET['period'] ?? 'week'; // Default to week

try {
    // Determine date range based on period
    $endDate = date('Y-m-d H:i:s');
    $startDate = date('Y-m-d H:i:s', strtotime('-7 days')); // Default to week
    
    switch ($period) {
        case 'today':
            $startDate = date('Y-m-d 00:00:00');
            $format = 'H:00';
            $groupFormat = '%H';
            break;
        case 'month':
            $startDate = date('Y-m-d H:i:s', strtotime('-30 days'));
            $format = 'M j';
            $groupFormat = '%Y-%m-%d';
            break;
        case 'year':
            $startDate = date('Y-m-d H:i:s', strtotime('-1 year'));
            $format = 'M';
            $groupFormat = '%Y-%m';
            break;
        default: // week
            $format = 'D';
            $groupFormat = '%Y-%m-%d';
    }

    // Get completed tasks (assuming status='completed')
    $completed = DB::query("
        SELECT DATE_FORMAT(updated_at, %s) as day, COUNT(*) as count
        FROM tasks
        WHERE status = 'completed' AND updated_at BETWEEN %s AND %s
        GROUP BY day
    ", $groupFormat, $startDate, $endDate);

    // Get created tasks
    $created = DB::query("
        SELECT DATE_FORMAT(created_at, %s) as day, COUNT(*) as count
        FROM tasks
        WHERE created_at BETWEEN %s AND %s
        GROUP BY day
    ", $groupFormat, $startDate, $endDate);

    // Generate all labels for the period
    $labels = [];
    $current = strtotime($startDate);
    $end = strtotime($endDate);
    
    while ($current <= $end) {
        $labels[] = date($format, $current);
        if ($period === 'today') $current = strtotime('+1 hour', $current);
        else if ($period === 'year') $current = strtotime('+1 month', $current);
        else $current = strtotime('+1 day', $current);
    }

    // Initialize data arrays
    $completedData = array_fill(0, count($labels), 0);
    $createdData = array_fill(0, count($labels), 0);

    // Fill completed data
    foreach ($completed as $row) {
        $index = array_search($row['day'], $labels);
        if ($index !== false) $completedData[$index] = (int)$row['count'];
    }

    // Fill created data
    foreach ($created as $row) {
        $index = array_search($row['day'], $labels);
        if ($index !== false) $createdData[$index] = (int)$row['count'];
    }

    echo json_encode([
        'success' => true,
        'labels' => $labels,
        'completed' => $completedData,
        'created' => $createdData
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}