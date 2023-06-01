<?php

session_start();
include "db.con.php";
if (isset($_SESSION['id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'homeseeker') {

        if (isset($_GET['apply_id'])) {
            $property_id = (int) $_GET['apply_id'];

            $sql = "SELECT id FROM rentalapplication WHERE property_id=$property_id and home_seeker_id={$_SESSION['id']}";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                $sql = "SELECT id FROM rentalapplication ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $id = (int) str_replace('ra', '', $row['id']) + 1;
                $id = 'ra' . str_pad($id, 3, '0', STR_PAD_LEFT);


                $sql = "INSERT INTO rentalapplication 
                        (id, property_id, home_seeker_id, application_status_id) VALUE
                        ('$id',$property_id,{$_SESSION['id']},'0002')";
                mysqli_query($conn, $sql);
            }

            header('Location: homeseeker.php');
            exit();
        }
?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>Home seeker</title>
            <link rel="stylesheet" href="css/navbar.css">
            <link rel="stylesheet" href="css/homeskeeker.css">
            <link rel="apple-touch-icon" sizes="180x180" href="icon/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="icon/avicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="icon/favicon-16x16.png">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <link rel="manifest" href="icon/site.webmanifest">
        </head>

        <script>
            function changeCategory(select) {
                newCategory = select.value;
                const rows = document.getElementById('rows2');
                $.ajax({
                    url: "catFilter.php",
                    dataType: "json",
                    type: "POST",
                    data: { category_id: newCategory },
                    success: (res) => {
                        console.log('suc', res);
                        rows.innerHTML = '';
                        for(i=0; i<res.length; i++) {
                            row = res[i];
                            rows.innerHTML += `<tr>
                                    <td><a href="property-detail.php?id=${row['id'] }">${row['name']}</a></td>
                                    <td>${row['category'] }</td>
                                    <td>${row['rent_cost'] }/month</td>
                                    <td>${row['rooms'] }</td>
                                    <td>${row['location'] }</td>
                                    <td class="apply"><a href="?apply_id=${row['id'] }">Apply</a></td>
                                </tr>`;
                        };
                        if(res.length === 0) rows.innerHTML = `<td>No properties match current category!</td>`
                    },
                    error: (res) => {
                        console.log('err', res)
                    }

                })
            }
        </script>

        <body>
            <header>

                <div class="topnav">
                    <div class="logo">
                        <a href="homeseeker.php"><img src="img/comfortKey-logo.png" alt=""></a>
                    </div>
                    <div class="navigation">
                        <a href="#info" href="#">my info</a>
                        <a href="logout.php">Log out</a>
                    </div>

                </div>
            </header>
            <main>
                <div class="info-container" id="info">
                    <video id='vid' width="900" autoplay muted>
                        <source src="img/HomeHeader.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <?php
                    $id = $_SESSION['id'];
                    $sql = "SELECT * FROM homeseeker WHERE id='$id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div class="info">
                        <h2>Welcome
                            <?php echo $row['first_name'] ?>!
                        </h2>
                        <div class="info-details">
                            <div class="detail">
                                <p>First name:</p>
                                <p>
                                    <?php echo $row['first_name'] ?>
                                </p>
                            </div>
                            <div class="detail">
                                <p>Last name:</p>
                                <p>
                                    <?php echo $row['last_name'] ?>
                                </p>
                            </div>
                            <div class="detail">
                                <p>Number of family members:</p>
                                <p>
                                    <?php echo $row['family_member'] ?>
                                </p>
                            </div>
                            <div class="detail">
                                <p>Phone number:</p>
                                <p>
                                    <?php echo $row['phone_number'] ?>
                                </p>
                            </div>
                            <div class="detail">
                                <p>Email address:</p>
                                <p>
                                    <?php echo $row['email_address'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tables">

                    <table id="req">
                        <caption>Requested Homes</caption>
                        <tr>
                            <th class="left-edge">Property Name</th>
                            <th>Category</th>
                            <th>Rent</th>
                            <th>Status</th>
                            <th class="right-edge"></th>
                        </tr>


                        <?php
                        $sql = "SELECT p.id, p.name, pc.category, ps.status, p.rent_cost 
                                FROM rentalapplication as ra
                                join property as p on ra.property_id=p.id
                                join propertycategory as pc on pc.id=p.property_category_id
                                join applicationstatus as ps on ps.id=ra.application_status_id
                                 WHERE home_seeker_id='{$_SESSION['id']}'";

                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                            <tr>
                                <td>
                                    <a href="property-detail.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a>
                                </td>
                                <td>
                                    <?php echo $row['category'] ?>
                                </td>
                                <td>
                                    <?php echo $row['rent_cost'] ?>/month
                                </td>
                                <td>
                                    <?php echo $row['status'] ?>
                                </td>
                                <!-- <td class="withdraw">
                                    <?php if ($row['status'] == 'under consideration') { ?>
                                        <a href="#">Withdraw</a>
                                    <?php } ?>
                                </td> -->

                            </tr>

                        <?php } ?>

                    </table>


                    <div style="display:flex; justify-content:flex-end; align-items:center; width:100%">
                        <label style='width:auto; align-self:auto'>Search by Category</label>
                        <select name="category_id" onchange="changeCategory(this)" style='max-width:10rem; margin:0 3rem;'>
                            <option value="">All</option>
                            <?php
                            $sql = "SELECT * FROM propertycategory";

                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == $row['id'] ? 'selected' : '' ?>><?php echo $row['category'] ?></option>
                            <?php } ?>
                        </select>
                    </div>


                    <table id="homes">
                    <caption>Homes for Rent</caption>
                        <tr>
                            <th class="left-edge">Property Name</th>
                            <th>Category</th>
                            <th>Rent</th>
                            <th>Rooms</th>
                            <th>Location</th>
                            <th class="right-edge"></th>
                        </tr>
                        <tbody id='rows2'>
                        <?php

                        $category = '';

                        if (isset($_GET['category_id']) && $_GET['category_id']) {
                            $category = 'property_category_id = ' . (int) $_GET['category_id'] . ' AND ';
                        }
                        $sql = "SELECT p.id, p.name, pc.category , p.rooms , p.location , p.rent_cost
                                FROM property as p 
                                join propertycategory as pc on pc.id=p.property_category_id
                                WHERE $category  p.id NOT in (SELECT property_id FROM rentalapplication WHERE application_status_id = '0000')";


                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><a href="property-detail.php?id=<?php echo $row['id'] ?>">
                                            <?php echo $row['name'] ?>
                                        </a></td>
                                    <td>
                                        <?php echo $row['category'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['rent_cost'] ?>/month
                                    </td>
                                    <td>
                                        <?php echo $row['rooms'] ?>
                                    </td>
                                    <td>
                                        <?php echo $row['location'] ?>
                                    </td>
                                    <td class="apply"><a href="?apply_id=<?php echo $row['id'] ?>">Apply</a></td>

                                </tr>
                        <?php }
                        } ?>
                        </tbody>
                    </table>
                </div>

            </main>
        </body>

        </html>

<?php


    } else {
        header('Location: homeowner.php');
    }
} else {
    header('Location: homepage.php');
}

?>
