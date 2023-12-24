<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('DASHBOARD') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-3 gap-4">
              @foreach ($posts as $post)
                  <x-post-card :post="$post" />
              @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
