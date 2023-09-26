<!DOCTYPE html>
<html>
<head>
    <title>Dynamic Sidebar</title>
</head>
<body>
    <ul>
        <?php
        function buildSidebar($items, $parentId = null) {
            foreach ($items as $item) {
                if ($item->parent_id == $parentId) {
                    echo '<li>' . $item->title;

                    // Check if there are child items
                    $hasChildren = false;
                    foreach ($items as $childItem) {
                        if ($childItem->parent_id == $item->id) {
                            $hasChildren = true;
                            break;
                        }
                    }

                    if ($hasChildren) {
                        echo '<ul>';
                        buildSidebar($items, $item->id); // Recursive call for child items
                        echo '</ul>';
                    }

                    echo '</li>';
                }
            }
        }

        // Start building the sidebar hierarchy
        buildSidebar($sidebar_hierarchy);
        ?>
    </ul>
</body>
</html>
