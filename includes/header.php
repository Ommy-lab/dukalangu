<?php
// includes/header.php
// Expects (optional): $pageTitle, $activePage — set by the including page before this file is required.
if (!isset($pageTitle))  { $pageTitle = "Dashboard"; }
if (!isset($activePage)) { $activePage = ""; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $pageTitle; ?> | Duka Bora Inventory System</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="app-wrapper">

    <?php include __DIR__ . '/sidebar.php'; ?>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <div class="main-col">

        <header class="topbar">
            <div class="topbar-left">
                <button class="hamburger" id="hamburgerBtn" aria-label="Toggle menu">&#9776;</button>
                <div class="topbar-title">Duka Bora Inventory System</div>
            </div>

            <div class="topbar-right">
                <div class="topbar-datetime" id="liveDateTime"></div>

                <div class="topbar-notif" title="Notifications">
                    &#128276;
                    <span class="dot"></span>
                </div>

                <div class="topbar-user">
                    <div class="avatar">A</div>
                    <div class="user-meta">
                        <div class="user-name">Administrator</div>
                        <div class="user-role">Store Manager</div>
                    </div>
                </div>
            </div>
        </header>

        <main class="page-content">
