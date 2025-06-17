<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - TaskShare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height:100vh;">
    <div class="card shadow p-4" style="width: 22rem;">
        <h3 class="text-center mb-4">Login TaskShare</h3>
        <form id="loginForm">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-danger mt-3 text-center" id="errorMsg" style="display: none;"></div>
    </div>

    <script>
        document.getElementById("loginForm").addEventListener("submit", async function(e) {
            e.preventDefault();

            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;

            try {
                const res = await fetch("http://localhost:8000/auth", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        email,
                        password
                    })
                });

                const data = await res.json();

                if (res.ok) {
                    localStorage.setItem("token", data.token);
                    window.location.href = "index.php?c=AppController&m=friendTasks";
                } else {
                    document.getElementById("errorMsg").innerText = data.message || "Login gagal.";
                    document.getElementById("errorMsg").style.display = "block";
                }

            } catch (err) {
                document.getElementById("errorMsg").innerText = "Gagal terhubung ke server.";
                document.getElementById("errorMsg").style.display = "block";
            }
        });
    </script>
</body>

</html>