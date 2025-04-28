@php
    $title = 'Dupe Checker - Squad International';
@endphp

@extends('template')
@section('content')
    <section class="w-[40%] flex flex-col gap-2">
        <h1 class="text-4xl font-bold text-center mb-5">Medicare
            Dupe
            Checker</h1>
        <form action="/check-medicare-id" class="flex gap-2 border-y-2 py-10">
            <input type="text" name="medicare_id" id="medicare_id"
                class="w-[80%] border-2 border-white pl-2 outline-none w-4/5 text-black" placeholder="Enter Medicare Id"
                maxlength="11" pattern=".{11,11}" title="Medicare ID must be exactly 11 characters">
            <button class="p-2 flex items-center justify-center bg-white text-black uppercase w-1/5">Check
                Id</button>
        </form>
        <p class="text-center">Copyright © Squad International Pvt Ltd. All Rights Reserved</p>
        <script>
            @isset($present)
                @if ($present)
                    toastr.error('Member Id is Present!');
                @else
                    toastr.success('Member Id is not Present!');
                @endif
            @endisset

            document.addEventListener('contextmenu', function(e) {
                e.preventDefault();
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'F12' ||
                    (e.ctrlKey && e.shiftKey && e.key === 'I') ||
                    (e.ctrlKey && e.shiftKey && e.key === 'J') ||
                    (e.ctrlKey && e.key === 'U')) {
                    e.preventDefault();
                }
            });
        </script>
    </section>
@endsection
