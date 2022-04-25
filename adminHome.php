<!DOCTYPE html>
<head>
    <title>Items Display</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="adminHome.css" rel="stylesheet" />
    <div class="head">
        <a href="#default" class="logo" onclick="location.href = 'adminHome.php';">CompanyLogo</a>
        <button type="submit">Home</button>
        <div class="header-right">
            <button type="submit">profile</button>
        </div>
    </div>
</head>
<body>
    <div class="container">
        <button class="button"> <img src="user.png" height="200" width="200" onclick="location.href = 'orderLogs.php';"/></button>
        <button class="button"> <img src="write.png" height="200" width="200" onclick="location.href = 'manageInventory.php';"/></button>
        <button class="button"> <img src="cart.png" height="200" width="200" onclick="location.href = 'manageDiscounts.php';"/></button>
        <button class="button"> <img src="write.png" height="200" width="200" onclick="location.href = 'manageUsers.php';"/></button>
    </div>
    <div class="return">
        <button class="button"> <img src="return.png" height="60" width="75" /></button>
    </div>
</body>