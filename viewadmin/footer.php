<script>
        function toggleAddProductForm() {
            var addProductForm = document.getElementById('addProductForm');
            var editProductForm = document.getElementById('editProductForm');

            // Ẩn form sửa nếu đang hiển thị
            if (editProductForm.style.display !== 'none') {
                editProductForm.style.display = 'none';
            }

            // Đảo ngược trạng thái hiển thị của form thêm
            if (addProductForm.style.display === 'none') {
                addProductForm.style.display = 'block';
            } else {
                addProductForm.style.display = 'none';
            }
        }
    </script>



<footer class="footer">
        &copy; <?php echo date("Y"); ?> TRANG ADMIN
    </footer>
</div>
</body>
</html>