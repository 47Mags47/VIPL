<div
    @class([
        'form-box',
        'mini-scroll'=> isset($scroll) ,
        'center' => isset($center),
        $attributes['class']
    ])
>
    <form
        action="{{ isset($action) ? $action : '' }}"
        method="{{ isset($method) ? $method : 'GET' }}"
        id="{{ isset($id) ? $id : '' }}"
        enctype="{{ isset($files) ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}"
        style="{{isset($w) ? 'width:' . $w . 'px' : ''}}"
    >
        @csrf
        @isset($method)
            @method($method)
        @endisset
        @isset($header)
            <p class="form-header">{{ $header }}</p>
        @endisset
        @isset($messages)
            <x-form.messages />
        @endif
        {{ $slot }}
        @isset($other)
            <div class="other-box">
                {{ $other }}
            </div>
        @endisset

        <x-form.input type="submit" />
    </form>
</div>
