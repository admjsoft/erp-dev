<?php
    // Example list of IDs to be checked
    $checkedIds = array_column($role_permissions,'id'); // Replace with your list of IDs

    // Function to display the sidebar recursively
    function displaySidebar($items, $parentId = null, $checkedIds) {
        echo '<ul>';
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                echo '<li>';
                $isChecked = in_array($item->id, $checkedIds) ? 'checked' : '';
                echo '<input type="checkbox" id="item_' . $item->id . '" ' . $isChecked . '>';
                echo '<label class="ml-1" for="item_' . $item->id . '">' . $item->title . '</label>';
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
