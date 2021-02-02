<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('posts.store') }}" method="post">
                        @csrf

                        <div class="text-md">
                            {{ \Illuminate\Support\Carbon::now()->format('l,  jS \\of F, Y') }}
                        </div>

                        <div class="mt-4">
                            <x-label for="today" :value="__('What did you do today?')" />

                            <textarea id="today" class="block mt-1 w-full rounded border-gray-200" rows="3" name="today" :value="old('today')" required autofocus></textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="tomorrow" :value="__('What will you do tomorrow?')" />

                            <textarea id="tomorrow" class="block mt-1 w-full rounded border-gray-200" rows="3" name="tomorrow" :value="old('tomorrow')" required></textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="blockers" :value="__('Anything blocking your progress?')" />

                            <textarea id="blockers" class="block mt-1 w-full rounded border-gray-200" rows="3" name="blockers" :value="old('blockers')"></textarea>
                        </div>

                        <x-button class="mt-4">
                            {{ __('Submit') }}
                        </x-button>
                    </form>
                </div>
            </div>

            @if (! empty($posts))
                @foreach ($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <form method="post" action="{{ route('posts.destroy', $post) }}">
                                @method('delete')
                                @csrf

                                <button type="submit" class="float-right text-red-600 underline">Delete</button>
                            </form>

                            <div class="text-md">
                                {{ $post->created_at->format('l, jS \\of F, Y') }}
                            </div>

                            <div class="mt-4">
                                <x-label :value="__('What was done')" />
                                <div class="block mt-1 w-full rounded border-gray-200">{{ $post->today }}</div>
                            </div>

                            <div class="mt-4">
                                <x-label :value="__('What was planned for the next day')" />
                                <div class="block mt-1 w-full rounded border-gray-200">{{ $post->tomorrow }}</div>
                            </div>

                            @if (! empty($post->blockers))
                                <div class="mt-4">
                                    <x-label :value="__('What was blocking')" />
                                    <div class="block mt-1 w-full rounded border-gray-200">{{ $post->blockers }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
