@extends('layouts.auth-page')
@section('page-name', 'Вход')

@section('body')
    <x-form.box action="{{ route('authenticate') }}" method="POST" header="Вход" center :w=500 messages>
        <x-form.input name="login" label="Логин" />
        <x-form.input name="password" inp-type="password" label="Пароль"/>
    </x-form.box>
@endsection
