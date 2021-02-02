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
                            {{ \Illuminate\Support\Carbon::now()->format('l, jS \\of F, Y') }}
                        </div>

                        <div class="mt-4">
                            <x-label :value="__('What did you do today?')" />

                            <textarea class="block mt-1 w-full rounded border-gray-200" rows="3" name="today" :value="old('today')" required autofocus></textarea>
                        </div>

                        <div class="mt-4">
                            <x-label for="tomorrow" :value="__('What will you do tomorrow?')" />

                            <textarea class="block mt-1 w-full rounded border-gray-200" rows="3" name="tomorrow" :value="old('tomorrow')" required></textarea>
                        </div>

                        <div class="mt-4">
                            <x-label :value="__('Anything blocking your progress?')" />

                            <textarea class="block mt-1 w-full rounded border-gray-200" rows="3" name="blockers" :value="old('blockers')"></textarea>
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

                                <button type="submit" class="text-xs float-right text-red-600 border-red-600 border rounded-md px-1 hover:bg-red-100 transition duration-150 ease-in-out">⨯</button>
                            </form>

                            <div class="text-md">
                                {{ $post->created_at->format('l, jS \\of F, Y') }}
                            </div>

                            <div class="mt-4">
                                <x-label :value="__('What was done')" />
                                <form method="post" action="{{ route('posts.update', $post) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="today" id="today-{{$post->id}}" value="">
                                    <div class="block mt-1 w-full rounded border-gray-200 whitespace-pre-line"
                                        contenteditable="true"
                                        onblur="document.getElementById('today-{{$post->id}}').value=event.target.innerHTML;event.preventDefault();this.closest('form').submit();"
                                    >{{ $post->today }}</div>
                                </form>
                            </div>

                            <div class="mt-4">
                                <x-label :value="__('What was planned for the next day')" />
                                <form method="post" action="{{ route('posts.update', $post) }}">
                                    @method('patch')
                                    @csrf
                                    <input type="hidden" name="tomorrow" id="tomorrow-{{$post->id}}" value="">
                                    <div class="block mt-1 w-full rounded border-gray-200 whitespace-pre-line"
                                        contenteditable="true"
                                        onblur="document.getElementById('tomorrow-{{$post->id}}').value=event.target.innerHTML;event.preventDefault();this.closest('form').submit();"
                                    >{{ $post->tomorrow }}</div>
                                </form>
                                <div class="block mt-1 w-full rounded border-gray-200 whitespace-pre-line">{{ $post->tomorrow }}</div>
                            </div>

                            @if (! empty($post->blockers))
                                <div class="mt-4">
                                    <x-label :value="__('What was blocking')" />
                                    <form method="post" action="{{ route('posts.update', $post) }}">
                                        @method('patch')
                                        @csrf
                                        <input type="hidden" name="blockers" id="blockers-{{$post->id}}" value="">
                                        <div class="block mt-1 w-full rounded border-gray-200 whitespace-pre-line"
                                            contenteditable="true"
                                            onblur="document.getElementById('blockers-{{$post->id}}').value=event.target.innerHTML;event.preventDefault();this.closest('form').submit();"
                                        >{{ $post->blockers }}</div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
