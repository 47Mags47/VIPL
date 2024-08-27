@extends('layouts.page')
@section('page-name', 'Загрузка')

@section('body')
    <x-table.table>
        <x-slot:thead>
            <x-table.thr :headers="['ID', 'Фамилия', 'Имя', 'Отчество', 'Номер счёта', 'Сумма', 'Номер паспорта', 'Дата рождения', '', 'СНИЛС']" />
        </x-slot:thead>
        <x-slot:tbody>
            
        </x-slot:tbody>
    </x-table.table>
@endsection