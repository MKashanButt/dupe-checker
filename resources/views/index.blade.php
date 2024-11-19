@php
    $title = 'Dupe Checker - Squad International';
@endphp

@extends('template')
@section('content')
    <section class="w-[40%] flex flex-col gap-2">
        <h1 class="text-4xl font-bold text-center mb-5">Medicare
            Dupe
            Checker</h1>
        <form action="/check-medicare-id" class="flex gap-2">
            <input type="text" name="medicare_id" id="medicare_id"
                class="w-[80%] border-2 border-black pl-2 outline-none w-4/5" placeholder="Enter Medicare Id">
            <button class="p-2 flex items-center justify-center bg-black text-white uppercase w-1/5">Check
                Id</button>
        </form>
        @isset($present)
            @if ($present)
                <p class="bg-red-500 w-full p-2 text-center text-white uppercase font-bold">Member Id is Present</p>
            @else
                <p class="bg-green-500 w-full p-2 text-center text-white uppercase font-bold">Member Id is not Present
                </p>
            @endif
        @endisset
    </section>
@endsection
