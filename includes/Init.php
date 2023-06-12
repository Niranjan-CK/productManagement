<?php

    spl_autoload_register(function($class){
        require dirname(__DIR__) . "/classes/{$class}.php";
    });

    session_start();

    $maxLength = 5;

    if (!isset($_SESSION['recently_viewed'])) {
        $_SESSION['recently_viewed'] = [];
    }

    // Remove older items if the recently viewed list exceeds the maximum length
    if (count($_SESSION['recently_viewed']) > $maxLength) {
        array_splice($_SESSION['recently_viewed'], 0, count($_SESSION['recently_viewed']) - $maxLength);
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Check if the ID already exists in the recently viewed list
        $existingItem = array_filter($_SESSION['recently_viewed'], function($item) use ($id) {
            return $item['id'] === $id;
        });

        if (empty($existingItem)) {
            // Add the new item to the list
            $_SESSION['recently_viewed'][] = ["id" => $id, "count" => 1];
        } else {
            // Increment the count for the existing item
            $existingItemId = array_keys($existingItem)[0];
            $_SESSION['recently_viewed'][$existingItemId]['count']++;

        }
    }

    // Sort the recently viewed list by count in acending order
    usort($_SESSION['recently_viewed'], function($a, $b) {
        return $a['count'] <=> $b['count'];
    });
  
    
?>