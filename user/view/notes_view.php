<?php
require "../../config/Database.php"; // Adjust the path if needed

if (isset($_GET['id'])) {
    $note_id = intval($_GET['id']);

    $note_query = $connection->query("SELECT * FROM notes WHERE id = $note_id");

    if ($note_query && $note_query->num_rows > 0) {
        $note = $note_query->fetch_assoc();

        $title = htmlspecialchars($note['title']);
        $price = htmlspecialchars($note['price']);
        $description = htmlspecialchars($note['description']); // make sure this column exists
        $thumbnail = htmlspecialchars($note['thumbnail_path']);
        $demo1 = htmlspecialchars($note['demo1_path']);
        $demo2 = htmlspecialchars($note['demo2_path']);
        $demo3 = htmlspecialchars($note['demo3_path']);
        $note_file = htmlspecialchars($note['file_path']);

        // Get category name
        $category_id = $note['category_id'];
        $category_name = "Unknown";
        $cat_res = $connection->query("SELECT name FROM categories WHERE id = $category_id");
        if ($cat_res && $cat_res->num_rows > 0) {
            $category_name = htmlspecialchars($cat_res->fetch_assoc()['name']);
        }
    } else {
        echo "Note not found.";
        exit();
    }
} else {
    echo "No note ID specified.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Note View</title>
    <link rel="stylesheet" href="../user_assets/css/views.css">
    <link rel="stylesheet" href="../user_assets/css/style.css">

    <style>
        .notes-card {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
        }

        .card img {
            width: -webkit-fill-available;
        }

        .card {
            background: #fff;
            padding: 20px;
            width: 300px;
            border-radius: 12px;
            box-shadow: 2px 2px 4px 4px #dbdbdb;
        }

        @media (max-width: 568px) {
            .card {
                width: 300px;
            }

            .card img {
                width: -webkit-fill-available;
            }
        }

        .content h4 {
            color: #003b74;
            font-size: 25px;
        }

        .content p {
            color: gray;
            font-size: 14px;
        }

        .price {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }

        .price p {
            color: #004e7e;
        }

        .price button {
            padding: 4px;
            border: none;
            background: #014b86;
            color: #fff;
            border-radius: 5px;
            width: 100px;
            cursor: pointer;
        }

        .image-list .image {
            border: 2px solid #ddd;
            padding: 5px;
            cursor: pointer;
            transition: border 0.2s ease;
        }

        .image-list {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .image-box {
            width: 100%;
            height: auto;
            max-width: 500px;
        }

        .btn-secondary {
            padding: 10px 15px;
            background-color: #004d8d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-secondary:hover {
            background-color: #002b5c;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            padding: 20px;
            gap: 40px;
        }

        .left-side, .right-side {
            flex: 1 1 400px;
        }

        .description {
            margin: 20px 0;
        }
        /* scroll bar */
::-webkit-scrollbar {
  width: 6px;
  height: 6px;
}

::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb {
  background: #888;
  border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
  background: #555;
}
/* end scroll bar */
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="left-side">
                <div class="image-container">
                    <div class="image-box">
                        <img id="main-image" src="../../admin/<?php echo $thumbnail; ?>" alt="<?php echo $title; ?>">
                    </div>
                    <div class="image-list">
                        <div class="image img-1" onclick="changeImage('../admin/<?php echo $demo1; ?>')">
                            <img src="../../admin/<?php echo $demo1; ?>" alt="Demo 1" width="100">
                        </div>
                        <div class="image img-2" onclick="changeImage('../admin/<?php echo $demo2; ?>')">
                            <img src="../../admin/<?php echo $demo2; ?>" alt="Demo 2" width="100">
                        </div>
                        <div class="image img-3" onclick="changeImage('../admin/<?php echo $demo3; ?>')">
                            <img src="../../admin/<?php echo $demo3; ?>" alt="Demo 3" width="100">
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-side">
                <div class="title">
                    <h2><?php echo $title; ?></h2>
                    <h4><?php echo $category_name; ?> Category</h4>
                    <p><strong>Price: ₹<?php echo $price; ?></strong></p>
                </div>
                <div class="description">
                    <?php echo $description; ?>
                </div>
                <div class="actions">
                    <a href="../../admin/<?php echo $note_file; ?>" download class="btn-secondary">Download Now</a>
                </div>
            </div>
        </div>
    </main>
        <section class="notes" id="notes">
        <div class="notes-container">
            <div class="section-title">
                <h2>Latest Uploaded Study Notes</h2>
            </div>          
            <div class="notes-grid ">
              <?php
    $notes_result = $connection->query("SELECT * FROM notes ORDER BY uploaded_at DESC LIMIT 3");
    if ($notes_result->num_rows > 0) {
        while ($row = $notes_result->fetch_assoc()) {
            $note_id = htmlspecialchars($row['id']);
            $title = htmlspecialchars($row['title']);
            $price = htmlspecialchars($row['price']);
            $uploaded_at = htmlspecialchars($row['uploaded_at']);
            $category_id = htmlspecialchars($row['category_id']);
            $thumbnail = htmlspecialchars($row['thumbnail_path']);

            // Fetch category name
            $category_name = "Unknown Category";
            $category_query = $connection->query("SELECT name FROM categories WHERE id = $category_id");
            if ($category_query && $category_query->num_rows > 0) {
                $category_row = $category_query->fetch_assoc();
                $category_name = htmlspecialchars($category_row['name']);
            }
    ?>
        <div class="note-card" data-category="<?php echo strtolower($category_name); ?>">
            <div class="note-image">
                <img src="<?php echo '../../admin/' . $thumbnail; ?>" alt="<?php echo $title; ?>" width="100px" height="200px">
                <span class="note-category"><?php echo $category_name; ?></span>
            </div>
            <div class="note-content">
                <h3><?php echo $title; ?></h3>
                <p>
                    A detailed note on <?php echo $category_name; ?> concepts.
                </p>
                <div class="note-stats">
                    <span class="note-price">Price: ₹<?php echo $price; ?></span>
                    <a href="./view/notes_view.php?id=<?php echo $note_id; ?>" class="btn-download">
                        View Note <i class="fa-solid fa-download" style="color: #eaeef5;"></i>
                    </a>
                </div>
            </div>
        </div>
    <?php
        }
    } else {
        echo "<p>There are no posts uploaded yet.</p>";
    }
    ?>  
            </div>
        </div>
    </section>
    <script>
        function changeImage(src) {
            document.getElementById('main-image').src = src;
        }

        // Highlight the first thumbnail by default
        window.onload = function () {
            const firstThumbnail = document.querySelector('.image-list .image:first-child');
            if (firstThumbnail) {
                firstThumbnail.style.borderColor = '#4CAF50';
                firstThumbnail.style.boxShadow = '0 0 0 2px rgba(76, 175, 80, 0.3)';
            }
        };
    </script>
</body>
</html>
