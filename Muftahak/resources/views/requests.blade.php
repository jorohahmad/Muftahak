<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/requestsstyle.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css">
    <title>Users</title>
</head>

<body>
    <div class="home">
        <nav>
            <h1><span> R</span>equests <span>R</span>egisters</h1>
            <div class="img">
                <img src="{{ asset('image/logo.png') }}" alt="not found">
            </div>
        </nav>
        <div class="container">

            <div class="div-cc">
                <div class="users">
                    @foreach ($collection as $item)
                        @if ($item->boolean === 'zero')
                            <div class="user">
                                <div class="nav">

                                    <img src="{{ asset('storage/M/' . $item->personalImage) }}" alt="">
                                    <h4> {{ $item->role }}</h4>

                                </div>
                                <div class="info">
                                    <h2> {{ $item->firstName }} {{ $item->lastName }}</h2>
                                    <p><span> Phone Number: </span>{{ $item->phoneNumber }}</p>
                                    <p><span>Birthday :</span>{{ $item->birthday }}</p>
                                    <a
                                        href="{{ route('images', ['img1' => $item->personalImage, 'img2' => $item->personalIdImage]) }}">personal
                                        & personal ID image</a>

                                </div>
                                <div class="buttons">
                                    <form action="{{ route('deleteRequest', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Do You Sure To Delete')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="delete"> DISAPPROVAL</button>
                                    </form>
                                    <form action="{{ route('registerA', $item->id) }}" method="POST"
                                        onsubmit="return confirm('Do You Sure To Approve')">
                                        @csrf
                                        <button> APPROVAL </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
            



            <form method="POST" action="{{ route('requestRegister', 2) }}">
                @csrf
                <button class="btn"> <i class="fas fa-exchange"></i></button>
            </form>




        </div>









    </div>

    {{-- <script>
        const buttons = document.querySelectorAll('.buttons button');
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
