<div class="table-box">
    <div class="table-options">
        <x-table.filter-box :$createLink>
            <x-table.filter title="Город" pole="city"/>
        </x-table.filter-box>
    </div>
    <table>
        <thead>
            {{ $thead }}
        </thead>
        <tbody>
            {{ $tbody }}
        </tbody>
    </table>
</div>
