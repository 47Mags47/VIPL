@extends('layouts.page')
@section('page-name', 'Поставщик')

@section('include-vite')
    @vite('resources/sass/pages/admin/maker.sass')
@endsection

@section('body')
    <div class="maker-box">
        <div class="logo">
            <img src="{{ asset('/storage/maker-logos/default_logo.png') }}" alt="">
        </div>
        <x-form.box class="info">
            <ul>
                <li>
                    <x-form.input type="select" label="Город">
                        <option value="">--- Не выбрано ---</option>
                    </x-form.input>
                    <x-form.input label="Наименование" name="name"/>
                    <x-form.input label="Адрес" name="adres"/>
                    <x-form.input label="Ссылка" name="link"/>
                    <x-form.input type="area" label="Краткое описание" name="link"/>
                </li>
            </ul>
        </x-form.box>
        {{-- <div class="info">

        </div> --}}
        <div class="items">
            items
        </div>
    </div>
@endsection
