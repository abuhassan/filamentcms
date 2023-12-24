<div class="bg-white rounded-xl shadow-md dark:bg-gray-800 p-4 flex flex-col md:flex-row item-center md:space-x-4" >
    <img class="m-full h-60 md:m-60 p-2 md:p-8" src="{{ $post->getFirstMediaUrl() }}" alt="Placeholder image" />
    <div>
        <div class="text-xl font-medium text-black dark:text-white">
            {{ $post->title }}
        </div>
        <p class="text-gray-500 dark:text-gray-300">
            {{ $post->excerpt() }}
        </p>
    </div>
