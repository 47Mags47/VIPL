@extends('layouts.page')
@section('page-name', 'Поставщик')

@section('body')
    <x-table.table create-link="{{ route('maker.create') }}">
        <x-slot:thead>
            <tr>
                <th>Город</th>
                <th>Наименование</th>
                <th>Адрес</th>
                <th>Описание</th>
                <th>Логотип</th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @foreach ($makers as $maker)
                <tr>
                    <td>{!! $maker->city->name !!}</td>
                    <td>{!! $maker->name !!}</td>
                    <td>{!! $maker->adres !!}</td>
                    <td>{!! $maker->short_description !!}</td>
                    <td>{!! $maker->logo !!}</td>
                </tr>
            @endforeach
        </x-slot:tbody>
    </x-table.table>
@endsection
