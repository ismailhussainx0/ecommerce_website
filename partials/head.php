<?php /* shared <head> — frontend only. Expects $pageTitle, optional $cssFile (user.css | admin.css) */
$cssFile = $cssFile ?? "user.css";

// CSS link that works from any folder / any project name (localhost/ecommerce, localhost/shop, virtual host...)
// e.g. /ecommerce/user/product.php  ->  /ecommerce/CSS/user.css
$cssBase  = rtrim(str_replace("\\", "/", dirname(dirname($_SERVER["SCRIPT_NAME"]))), "/") . "/CSS/";
$cssPath  = __DIR__ . "/../CSS/" . $cssFile;
$cssHref  = $cssBase . $cssFile . (file_exists($cssPath) ? "?v=" . filemtime($cssPath) : "");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle ?? "My Store"); ?> — My Store</title>

    <!-- Font + Icons + Bootstrap -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">

    <!-- my css (separate for user / admin) -->
    <link rel="stylesheet" href="<?php echo htmlspecialchars($cssHref); ?>">
</head>
