<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/fastbootstrap@2.2.0/dist/css/fastbootstrap.min.css" rel="stylesheet"
        integrity="sha256-V6lu+OdYNKTKTsVFBuQsyIlDiRWiOmtC8VQ8Lzdm2i4=" crossorigin="anonymous">
    <title>Landing page</title>
</head>

<body>

    <style>
        .container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            height: 100vh;
        }

        .text {
            /* position: absolute; */
            /* margin-left: 5rem; */
            width: auto;
            height: auto;
            margin: 0rem 35rem 0 0rem;
        }

        .img {
            position: absolute;
            width: 35rem;
            height: 35rem;
            margin-left: 35rem;
        }

        /* From Uiverse.io by alexroumi */
        button {
            padding: 14px 37px;
            border: unset;
            border-radius: 0.5rem;
            color: #e8e8e8;
            z-index: 1;
            background-color: #212121;
            position: relative;
            font-weight: 700;
            transition: all 250ms;
            overflow: hidden;
            margin-top: 1.5rem;
        }

        button::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 0;
            border-radius: 0.5rem;
            background: #baddff;
            z-index: -1;
            transition: all 250ms
        }

        button:hover {
            
            color: #212121;
        }

        button:hover::before {
            width: 100%;
        }
    </style>
    <div class="container">
        <div class="text">
            <h1>Pengaduan masyarakat</h1>
            <p> Apakah Anda memiliki keluhan atau masalah yang ingin disampaikan? Kami siap membantu Anda. Silakan laporkan masalah Anda melalui platform ini dan kami akan menindaklanjutinya dengan cepat dan tepat.</p>
        <form action="{{ route('login') }}">
            <button type="submit">Bergabung!!</button>
        </form>
        </div>

        <div class="img">
            <svg id="10015.io" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <defs>
                    <clipPath id="blob">
                        <path fill="#474bff"
                            d="M436.5,307.5Q426,375,355.5,376.5Q285,378,229,413Q173,448,109.5,414.5Q46,381,83,310.5Q120,240,92,176Q64,112,117,69Q170,26,226.5,67Q283,108,356.5,105Q430,102,438.5,171Q447,240,436.5,307.5Z" />
                    </clipPath>
                </defs>
                <image x="0" y="0" width="100%" height="100%" clip-path="url(#blob)"
                    xlink:href="https://i.pinimg.com/736x/92/e2/9e/92e29e8a5d4cceafdbc3f5cb70aa66ad.jpg"
                    preserveAspectRatio="xMidYMid slice"></image>
            </svg>
        </div>
    </div>
</body>

</html>
