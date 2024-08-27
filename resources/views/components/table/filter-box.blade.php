<form
    class="filter-form"
    action="{{ isset($action) ? $action : '' }}"
>
    <x-form.input type="table-search" />
    <x-link.new-button link="{{ $createLink }}" title="Добавить" />
    <ul class="filter-list">
        {{ $slot }}
    </ul>
</form>
