<!DOCTYPE html>
<html>
<head>
    <title>Sidebar</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        /* Style the sidebar */
        ul.sidebar {
            list-style: none;
            padding-left: 20px;
        }

        /* Style list items */
        ul.sidebar li {
            position: relative;
            margin-bottom: 5px;
        }

        /* Style checkboxes */
        ul.sidebar input[type="checkbox"] {
            position: absolute;
            left: -20px;
        }

        /* Style labels (item titles) */
        ul.sidebar label {
            cursor: pointer;
        }

        /* Indent child items */
        ul.sidebar ul {
            margin-left: 20px;
        }

        /* Show sublist when the 'active' class is applied */
        ul.sidebar ul.active {
            display: block;
        }
    </style>
</head>
<body>
    <ul class="sidebar">
        <?php
        // Example list of IDs to be checked
        $checkedIds = [1, 3, 7]; // Replace with your list of IDs

        // Function to display the sidebar recursively
        function displaySidebar($items, $parentId = null, $checkedIds) {
            echo '<ul>';
            foreach ($items as $item) {
                if ($item->parent_id == $parentId) {
                    echo '<li>';
                    $isChecked = in_array($item->id, $checkedIds) ? 'checked' : '';
                    echo '<input type="checkbox" id="item_' . $item->id . '" ' . $isChecked . '>';
                    echo '<label for="item_' . $item->id . '">' . $item->title . '</label>';
                    $hasChildren = false;

                    // Check if the item has children
                    foreach ($items as $child) {
                        if ($child->parent_id == $item->id) {
                            $hasChildren = true;
                            break;
                        }
                    }

                    if ($hasChildren) {
                        displaySidebar($items, $item->id, $checkedIds); // Recursively display children
                    }
                    echo '</li>';
                }
            }
            echo '</ul>';
        }

        // Start building and checking the sidebar hierarchy
        displaySidebar($sidebar_hierarchy, null, $checkedIds);
        ?>
        <button id="getSelected">Get Selected IDs</button>
        
    </ul>
</body>
</html>
