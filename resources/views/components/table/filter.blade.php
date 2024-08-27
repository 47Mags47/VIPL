{{-- REQ --}}
{{-- pole --}}
{{-- OPTIONAL --}}
{{-- title text|Заголовок ;  --}}

<li>
    <label class="preview" for="opened_{{ $pole }}">
        <span>{!! isset($title) ? $title : 'Заголовок' !!}</span>
        <i class="fa fa-angle-down" aria-hidden="true"></i>
        <input type="checkbox" id="opened_{{ $pole }}">
    </label>
    <div class="filter">
        <div class="filter-search">
            <input type="search" placeholder="{!! isset($title) ? $title : 'Заголовок' !!}">
        </div>
        <ul class="list mini-scroll">
            {{-- @foreach ($items as $item)
                <li>
                    <x-form.input inp-type="checkbox"/>
                </li>
            @endforeach --}}
        </ul>
    </div>
</li>
