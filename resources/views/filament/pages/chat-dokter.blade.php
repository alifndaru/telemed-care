@php
    use Carbon\Carbon;
@endphp

<x-filament-panels::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 h-[calc(100vh-120px)] bg-gray-50 dark:bg-gray-900">
        <!-- Left Sidebar: Conversation List -->
        <div class="md:col-span-1 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 rounded-lg shadow-sm">
            <div class="sticky top-0 z-10 bg-gray-100 dark:bg-gray-700 p-4 border-b dark:border-gray-600 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <x-filament::icon
                        icon="heroicon-m-chat-bubble-left-right"
                        class="w-6 h-6 text-blue-600 dark:text-blue-400"
                    />
                    <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                        {{ __('Active Conversations') }}
                    </h2>
                    <x-filament::badge>
                        {{ count($this->conversations) }}
                    </x-filament::badge>
                </div>
            </div>

            <!-- Conversation List with Enhanced Scrolling -->
            <div class="h-[calc(100vh-220px)] overflow-y-auto custom-scrollbar p-2">
                @forelse ($this->conversations as $conversation)
                    <div
                        wire:key="{{ $conversation['id'] }}"
                        wire:click.prevent="selectConversation({{ $conversation['id'] }})"
                        class="
                            p-4 mb-2 rounded-lg cursor-pointer transition-all duration-200
                            {{ $this->activeConversation && $this->activeConversation['id'] === $conversation['id']
                                ? 'bg-blue-100 dark:bg-blue-900/30 ring-2 ring-blue-200 dark:ring-blue-700'
                                : 'hover:bg-gray-100 dark:hover:bg-gray-700'
                            }}
                            {{ $conversation['unread_count'] > 0
                                ? 'bg-blue-50 dark:bg-blue-800/20'
                                : ''
                            }}
                        "
                    >
                        <div class="flex items-center space-x-4">
                            <x-filament::avatar
                                src="https://ui-avatars.com/api/?name={{ urlencode($conversation['other_person_name']) }}"
                                alt="{{ $conversation['other_person_name'] }}"
                                class="w-12 h-12 rounded-full ring-2 ring-white dark:ring-gray-700"
                            />
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 truncate">
                                        {{ $conversation['other_person_name'] }}
                                    </h3>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ Carbon::parse($conversation['last_message_time'])->shortRelativeDiffForHumans() }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 truncate pr-2">
                                        @if($conversation['is_sender'])
                                            <span class="text-blue-600 dark:text-blue-400 font-bold">You: </span>
                                        @endif
                                        {{ $conversation['latest_message'] }}
                                    </p>
                                    @if ($conversation['unread_count'] > 0)
                                        <x-filament::badge color="primary" size="sm">
                                            {{ $conversation['unread_count'] }}
                                        </x-filament::badge>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center h-full text-center p-6">
                        <div class="p-4 mb-4 bg-gray-100 dark:bg-gray-700 rounded-full">
                            <x-filament::icon
                                icon="heroicon-m-chat-bubble-left"
                                class="w-8 h-8 text-gray-500 dark:text-gray-400"
                            />
                        </div>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ __('No conversations yet') }}
                        </p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Side: Chat Room -->
       <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-lg shadow-sm">
            @if ($this->activeConversation)
                <div class="flex flex-col h-full">
                    <!-- Chat Header -->
                    <div class="sticky top-0 z-10 flex items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 border-b dark:border-gray-700">
                        <div class="flex items-center space-x-3">
                            <x-filament::avatar
                                src="https://ui-avatars.com/api/?name={{ urlencode($this->activeConversation['other_person_name']) }}"
                                alt="{{ $this->activeConversation['other_person_name'] }}"
                                class="w-10 h-10 rounded-full"
                            />
                            <div>
                                <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">
                                    {{ $this->activeConversation['other_person_name'] }}
                                </h2>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ Carbon::parse($this->activeConversation['last_message_time'])->longAbsoluteDiffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50 dark:bg-gray-900 custom-scrollbar">
                        <div class="flex justify-start mb-4">
                            <div class="max-w-[70%] bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm">
                                <p class="text-sm text-gray-800 dark:text-gray-200">
                                    {{ $this->activeConversation['latest_message'] }}
                                </p>
                                <span class="text-xs text-gray-500 dark:text-gray-400 mt-1 block text-right">
                                    {{ Carbon::parse($this->activeConversation['last_message_time'])->format('H:i') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Message Input -->
                    <div class="sticky bottom-0 p-4 bg-gray-100 dark:bg-gray-800 border-t dark:border-gray-700">
                        <div class="flex items-center space-x-2">
                            <div class="flex-1">
                                <input
                                    type="text"
                                    placeholder="{{ __('Type a message...') }}"
                                    class="
                                        w-full p-3 rounded-lg border
                                        border-gray-300 dark:border-gray-600
                                        bg-white dark:bg-gray-700
                                        text-gray-800 dark:text-gray-200
                                        focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400
                                        transition-all duration-200
                                    "
                                />
                            </div>
                            <x-filament::button color="primary" size="md">
                                {{ __('Send') }}
                            </x-filament::button>
                        </div>
                    </div>
                </div>
            @else
                <!-- No Conversation Selected -->
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                        <x-filament::icon
                            icon="heroicon-m-chat-bubble-bottom-center-text"
                            class="w-12 h-12 text-gray-500 dark:text-gray-400"
                        />
                    </div>
                    <p class="text-lg text-gray-600 dark:text-gray-400">
                        {{ __('Select a conversation to start chatting') }}
                    </p>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.1);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(0,0,0,0.2);
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.1);
        }
        .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.2);
        }
    </style>
    @endpush
</x-filament-panels::page>
