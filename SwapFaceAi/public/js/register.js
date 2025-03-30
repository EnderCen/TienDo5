document.getElementById('btn-registers').addEventListener('click', function() {
    window.location.href = 'http://localhost:8000/login';
});

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Ngăn trang tải lại

    let formData = new FormData(this); // Thu thập dữ liệu form

    fetch("{{ url('/register') }}", {
        method: "POST",
        body: formData,
        headers: {
            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            alert("Có lỗi xảy ra: " + JSON.stringify(data.errors));
        } else {
            alert("Đăng ký thành công!");
            window.location.href = "/login"; // Điều hướng đến trang đăng nhập
        }
    })
    .catch(error => console.error("Lỗi:", error));
});
</script>
