<div class="pagination flex-m flex-w p-t-26">
    <?php
    if ($page != 1) {
        $prev = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 1) . '" class="item-pagination flex-c-m trans-0-4 prev"><</a>';
    }
    if ($page != $total) {
        $next = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 1) . '" class="item-pagination flex-c-m trans-0-4 next">></a>';
    }

    if ($page - 5 > 0) {
        $page5left = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 5) . '">' . ($page - 5) . '</a>';
    }
    if ($page - 4 > 0) {
        $page4left = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 4) . '" class="item-pagination flex-c-m trans-0-4">' . ($page - 4) . '</a>';
    }
    if ($page - 3 > 0) {
        $page3left = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 3) . '" class="item-pagination flex-c-m trans-0-4">' . ($page - 3) . '</a>';
    }
    if ($page - 2 > 0) {
        $page2left = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 2) . '" class="item-pagination flex-c-m trans-0-4">' . ($page - 2) . '</a>';
    }
    if ($page - 1 > 0) {
        $page1left = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page - 1) . '" class="item-pagination flex-c-m trans-0-4">' . ($page - 1) . '</a>';
    }
    if ($page + 5 <= $total) {
        $page5right = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 5) . '" class="item-pagination flex-c-m trans-0-4">' . ($page + 5) . '</a>';
    }
    if ($page + 4 <= $total) {
        $page4right = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 4) . '" class="item-pagination flex-c-m trans-0-4">' . ($page + 4) . '</a>';
    }
    if ($page + 3 <= $total) {
        $page3right = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 3) . '" class="item-pagination flex-c-m trans-0-4">' . ($page + 3) . '</a>';
    }
    if ($page + 2 <= $total) {
        $page2right = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 2) . '" class="item-pagination flex-c-m trans-0-4">' . ($page + 2) . '</a>';
    }
    if ($page + 1 <= $total) {
        $page1right = '<a href="/view_categories?cat=' . $categories . '&family=' . $family . '&page=' . ($page + 1) . '" class="item-pagination flex-c-m trans-0-4">' . ($page + 1) . '</a>';
    }

    if ($total > 1) {
        echo '<div class="pagination flex-m flex-w p-t-26">';
        echo $prev . $page5left . $page4left . $page3left . $page2left . $page1left . "<a class='item-pagination flex-c-m trans-0-4 active-pagination' href='/view_categories?cat=$categories&family=$family&page=" . $page . "&sort=" . $sorting . "'>" . $page . "</a>" . $page1right . $page2right . $page3right . $page4right . $page5right . $next;
        echo '</div>';
    }
    ?>
</div>