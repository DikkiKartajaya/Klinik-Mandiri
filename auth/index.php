<?php  
session_start();

if (isset($_SESSION['jabatan'])) {
	if ($_SESSION['jabatan']!="") {
		header("location:../dashboard");
	}
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Praktik Mandiri Klinik</title>
    <link rel="icon" href="../asset/img/logo.png" type="image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="login.css" rel="stylesheet">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;900&display=swap');
input {
    caret-color: red;
}

body {
    margin: 0;
    width: 100vw;
    height: 100vh;
    background: #ff746c;
    display: flex;
    align-items: center;
    text-align: center;
    justify-content: center;
    place-items: center;
    overflow: hidden;
    font-family: poppins;
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    height: auto;
    width: auto;
    border-radius: 20px;
    padding-top: 40px;
    padding-bottom: 40px;
    padding-left: 60px;
    padding-right: 60px;
    box-sizing: border-box;
    background: #EEF7FF;
}

.logo {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    border-radius: 50%;
    box-sizing: border-box;
    box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
    height: 400px;
    width: 400px;
}

.brand-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 400px;
    width: 400px;
    background: url("../asset/img/logo.png") center/cover no-repeat; /* Mengubah properti background untuk memastikan gambar muncul dengan benar */
    padding-top: 0;
    border-radius: 5%;
    box-sizing: border-box;
    box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px white;
}

.brand-title {
    margin-top: 10px;
    font-weight: 900;
    font-size: 1.8rem;
    color: #d1011f;
    letter-spacing: 1px;
}

.inputs {
    text-align: left;
    margin-top: 30px;
    width: 100%;
}

label,
input,
button {
    display: block;
    width: 100%;
    padding: 0;
    border: none;
    outline: none;
    box-sizing: border-box;
}

label {
    margin-bottom: 4px;
}

label:nth-of-type(2) {
    margin-top: 12px;
}

input::placeholder {
    color: gray;
}

input {
    background: #ecf0f3;
    padding: 10px;
    padding-left: 20px;
    height: 50px;
    font-size: 14px;
    border-radius: 50px;
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px white;
}

button {
    color: white;
    margin-top: 20px;
    background: #d1011f;
    height: 40px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: 900;
    box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px white;
    transition: 0.5s;
}

button:hover {
    box-shadow: none;
}

a {
    position: absolute;
    font-size: 8px;
    bottom: 4px;
    right: 4px;
    text-decoration: none;
    color: black;
    background: yellow;
    border-radius: 10px;
    padding: 2px;
}

h1 {
    position: center;
    top: 0;
    left: 0;
}
</style>
<body>


    <main class="form-signin">
        <form method="post" action="cek_login.php">
            <div class="container">
                <div class="brand-logo">
                </div>
                <div class="brand-title">Praktik Mandiri Klinik</div>
                <div class="inputs">
                <?php
						if(isset($_GET['pesan'])) {
							if($_GET['pesan']=="gagal") {
								echo "<div class='alert alert-danger'>Username dan Password tidak sesuai</div>";
							} elseif ($_GET['pesan']=="tabrak") {
								echo "<div class='alert alert-danger'>Anda harus <strong>Login</strong> terlebih dahulu!!</div>";
							} elseif ($_GET['pesan']=="logout") {
								echo "<div class='alert alert-success'>Anda berhasil logout</div>";
							}
						}
					?>
                    <input type="text" name="username" placeholder="Masukkan username" require>
					<br>
                    <input type="password" name="password" placeholder="Masukkan password" require>
                    <button type="submit">LOGIN</button>
                </div>
            </div>
        </form>
    </main>
</body>

</html>

