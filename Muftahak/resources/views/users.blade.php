<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usersstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <title>Users</title>
</head>

<body>

    <div class="home">
        <nav>
            <h1><span> M</span>anegement <span>U</span>sers</h1>
            <div class="img">
                <img src="{{ asset('image/logo.png') }}" alt="not found">
            </div>
        </nav>
        <div class="container">
            <div class="div-cc">
                <div class="users">
                    @foreach ($collection as $item)
                        <div class="user">
                            <div class="nav">
                                <!-- <div class="img"></div> -->
                                <img src="{{ asset('storage/M/' . $item->personalImage) }}" alt="">
                                <h4> {{ $item->role }}</h4>
                                <form action="{{ route('deleteUser', ['id' => $item->id, 'users' => $item->role]) }}"
                                    method="POST" onsubmit="return confirm('Are you sure you want to delete?')"> @csrf
                                    @method('DELETE')
                                    <button class="delete"> <span
                                            style="font-size: 17px;font-weight: bold; background-color: rgb(97, 53, 36);color: aliceblue;border-radius: 50%; width: 20px;height:20px;display: flex;justify-content: center;align-items: center;">&#9472;</span>
                                    </button>
                                </form>
                            </div>
                            <div class="info">
                                <h2> {{ $item->firstName }} {{ $item->lastName }}</h2>
                                <p><span> Phone Number: </span>{{ $item->phoneNumber }}</p>
                                <p><span>Birthday :</span>{{ $item->birthday }}</p>


                                <a
                                    href="{{ route('images', ['img1' => $item->personalImage, 'img2' => $item->personalIdImage]) }}">personal
                                    & personal ID image</a>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <form class="container" method="POST" action="{{ route('users') }}"> --}}
            <form method="POST" action="{{ route('requestRegister', 1) }}">
                @csrf
                <button class="btn"> <i class="fas fa-exchange"></i></button>
            </form>
        </div>









    </div>
    {{-- <script>
        const buttons = document.querySelectorAll('.delete');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // alert(`You clicked the ${button.textContent} button.`);
                let confirmation = confirm(`Are you sure you want to ${button.textContent}?`);
                if (confirmation) {
                    alert(`${button.textContent} confirmed.`);
                } else {
                    alert(`${button.textContent} canceled.`);
                }
            });
        });
    </script> --}}
   

</body>

</html>
