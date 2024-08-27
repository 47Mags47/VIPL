<div class="message-box">
    @if ($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    @endif
    @if (session('message'))
        <ul class="message">
            <li>{{ session('message') }}</li>
        </ul>
    @endif
</div>
