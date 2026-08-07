<x-app-layout>
    <x-slot name="header">
        <h2>Administrator Dashboard</h2>
    </x-slot>

    <div class="p-6">
        Welcome, {{ Auth::user()->name }}!

        <br><br>

        You are logged in as:

        <strong>{{ Auth::user()->role }}</strong>
    </div>
</x-app-layout>
