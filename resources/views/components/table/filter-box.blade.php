<form
    class="filter-form"
    action="{{ isset($action) ? $action : '' }}"
>
    <x-form.input type="table-search" />
    <ul class="filter-list">
        {{ $slot }}
    </ul>
</form>
