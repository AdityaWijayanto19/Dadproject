<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="picture/logo.png" type="image/x-icon">
    <title>home page | Dad Project</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="header">
            <div class="boxsearch left">
                <img class="foto" src="picture/logo.png" alt="Dad project">
                <input class="search" type="text" name="search" placeholder="cari...">
            </div>

            <div class="hamburger" onclick="toggleMenu()">&#9776;</div>

            <div class="boxsearch right nav-links" id="navLinks">
                <div class="boxbtn">
                    <a class="regbtn" href="component/login.php">Masuk</a>
                </div>
                <div class="boxbtn">
                    <a class="regbtn" href="component/register.php">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- hero image -->
    <section>
        <div class="container">
            <img class="image-slide" src="picture/imghero1.jpg" alt="">
            <div class="slogan">
                <h3>Bangun karirmu sebagai Developer Profesional</h3>
                <p>Mulai belajar terarah dengan learning path</p>
            </div>
        </div>

        <div class="container2">
            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">FRONT-END DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">BACK-END DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">MOBILE DEVELOPER</label>
            </div>

            <div class="path">
                <button class="box" id="box">
                    <img class="imgpath" src="picture/logo.png" alt="">
                </button>
                <label for="box">IOT ENGINEER</label>
            </div>
        </div>
    </section>

    <section>
        <div class="boxkelas">
            <div class="kelas">
                <h3>JavaScript</h3>
                <img class="foto" src="picture/javascript.jpg" alt="">
                <p>The JavaScript logo is commonly recognized as a stylized depiction of the letters "JS." The logo's design is simple yet distinctive.</p>
                <button>mulai Belajar</button>
            </div>

            <div class="kelas">
                <h3>JavaScript</h3>
                <img class="foto" src="picture/javascript.jpg" alt="">
                <p>The JavaScript logo is commonly recognized as a stylized depiction of the letters "JS." The logo's design is simple yet distinctive.</p>
                <button>mulai Belajar</button>
            </div>

            <div class="kelas">
                <h3>JavaScript</h3>
                <img class="foto" src="picture/javascript.jpg" alt="">
                <p>The JavaScript logo is commonly recognized as a stylized depiction of the letters "JS." The logo's design is simple yet distinctive.</p>
                <button>mulai Belajar</button>
            </div>

            <div class="kelas">
                <h3>JavaScript</h3>
                <img class="foto" src="picture/javascript.jpg" alt="">
                <p>The JavaScript logo is commonly recognized as a stylized depiction of the letters "JS." The logo's design is simple yet distinctive.</p>
                <button>mulai Belajar</button>
            </div>
        </div>

        
    </section>


    <script>
        const images = ["picture/imghero1.jpg", "picture/imghero2.png", "picture/imghero3.jpg"];

        let currentIndex = 0;
        const imgelemet = document.querySelector(".image-slide");

        function changeImg() {
            currentIndex = (currentIndex + 1) % images.length;
            imgelemet.src = images[currentIndex];
        }

        setInterval(changeImg, 2000);


        function toggleMenu() {
            const nav = document.getElementById("navLinks");
            nav.classList.toggle("active");
        }

    </script>
</body>

</html>