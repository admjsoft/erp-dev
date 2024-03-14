
    <?php foreach ($absent_emp_names as $index => $absent_emp_name) : ?>
    <tr>
        <td><?php echo $index + 1; ?></td>
        <td><?php echo $absent_emp_name['name']; ?></td>
    </tr>
    <?php endforeach; ?>
