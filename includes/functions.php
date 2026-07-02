<?php
/*
  includes/functions.php
  Presentation-only helpers used by the redesigned UI.
  These do NOT touch the database, business rules, or CRUD logic —
  they only format values that are already returned by the existing queries.
*/

// Builds the colored stock badge + quantity used on the Products page
function renderStockBadge($qty)
{
    $qty = intval($qty);

    if ($qty === 0) {
        $class = "badge badge-danger";
        $label = "Out of Stock";
    } elseif ($qty < 10) {
        $class = "badge badge-warning";
        $label = "Low Stock";
    } else {
        $class = "badge badge-success";
        $label = "In Stock";
    }

    return '<span class="' . $class . '">' . $label . '</span> <span class="stock-qty">' . $qty . '</span>';
}

// Formats a number as Tanzanian Shilling currency for display only
function formatCurrency($amount)
{
    return "TZS " . number_format((float)$amount, 2);
}

// Formats a MySQL datetime/date string for display only
function formatDate($dateString)
{
    $timestamp = strtotime($dateString);
    if (!$timestamp) {
        return $dateString;
    }
    return date("M d, Y - h:i A", $timestamp);
}
?>
