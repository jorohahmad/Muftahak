<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/loginstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <form class="container" method="POST" action="{{ route('users') }}">
        @csrf
        <div class="blur"></div>
        <nav class="logo"><img src="image/logo.png" alt=""></nav>
        <div class="login">
            <h1>Admin <span>login</span> page</h1>

            <div class="input name">
                <input name="idNumber" type="text" placeholder="ID Number">
                <i class="fa-regular fa-circle-user icon1"></i>
                <!-- <label for="">ID</label> -->
            </div>
            <div class="input password">
                <input name="password" type="password" required placeholder="password">
                <i class="fa-solid fa-key icon1"></i>
                <!-- <label for="">password</label> -->
            </div>
            <h6> Welcome with <span>MUFTAHAK</span></h6>
            <button>login</button>


        </div>
    </form>
    {{-- <script src="{{asset('js/script.js')}}"></script> --}}

  @if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif


</body>

</html>
