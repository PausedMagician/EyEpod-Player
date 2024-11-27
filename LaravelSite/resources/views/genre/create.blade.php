<div>
    <form action="{{route('genre.store')}}" method="POST">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="container_input">
            <div>
                <label for="name">Name</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="button_div">
                <button type="submit">Create Genre</button>
            </div>
        </div>
    </form>
</div>