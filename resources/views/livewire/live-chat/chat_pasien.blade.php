@php
  use Carbon\Carbon;
@endphp
<div x-data="{ activeChat: false }"
  class="h-[calc(100vh-100px)] md:h-screen grid grid-cols-1 md:grid-cols-3 gap-4 bg-gray-50 dark:bg-gray-900">
  <!-- Left Sidebar: Conversation List -->
  <div class="border-r bg-white md:block"
    :class="{ 'hidden': activeChat, 'block': !activeChat && window.innerWidth < 768 }" wire:poll.1s="loadConsultations">
    <div
      class="sticky top-0 z-10 bg-gray-100 dark:bg-gray-700 p-4 border-b dark:border-gray-600 flex items-center justify-between">
      <x-filament::icon icon="heroicon-m-chat-bubble-left-right" class="w-6 h-6 text-blue-600 dark:text-blue-400" />
      <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">{{ __('Chat Konsultasi') }}</h2>
      <x-filament::badge>{{ count($this->consultations) }}</x-filament::badge>
    </div>

    <!-- Chat List -->
    <div class="overflow-y-auto custom-scrollbar p-2">
      @forelse ($this->consultations as $consultation)
        <div wire:key="{{ $consultation['id'] }}" wire:click="selectConsultation({{ $consultation['id'] }})"
          @click="activeChat = true"
          class="p-4 mb-2 rounded-lg cursor-pointer transition-all duration-200
                            {{ $this->activeConsultation && $this->activeConsultation['id'] === $consultation['id']
                                ? 'bg-blue-100 dark:bg-blue-900/30 ring-2 ring-blue-200 dark:ring-gray-700'
                                : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}">
          <div class="flex items-center gap-3">
            <x-filament::avatar
              src="https://ui-avatars.com/api/?name={{ urlencode($consultation['other_person_name']) }}"
              alt="{{ $consultation['other_person_name'] }}"
              class="w-12 h-12 rounded-full ring-2 ring-white dark:ring-gray-700" />
            <div class="flex-1 min-w-0">
              <div class="flex justify-between items-center mb-1">
                <h3 class="font-semibold text-gray-800 dark:text-gray-200 truncate">
                  {{ $consultation['other_person_name'] }}
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                  {{ $consultation['last_message_time']
                      ? Carbon::parse($consultation['last_message_time'])->shortRelativeDiffForHumans()
                      : '' }}
                </span>
              </div>
              <div class="flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400 truncate">
                  @if ($consultation['is_sender'])
                    <span class="text-blue-600 dark:text-blue-400 font-bold">You: </span>
                  @endif
                  {{ $consultation['latest_message'] }}
                </p>
                @if ($consultation['unread_count'] > 0)
                  <x-filament::badge color="primary" size="sm">
                    {{ $consultation['unread_count'] }}
                  </x-filament::badge>
                @endif
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="flex flex-col items-center justify-center text-center p-6">
          <x-filament::icon icon="heroicon-m-chat-bubble-left" class="w-8 h-8 text-gray-500 dark:text-gray-400" />
          <p class="text-gray-600 dark:text-gray-400">{{ __('No conversations yet') }}</p>
        </div>
      @endforelse
    </div>
  </div>

  <!-- Right Sidebar: Chat Room -->
  <div class="md:col-span-2 bg-white dark:bg-gray-900 rounded-lg shadow-sm h-screen"
    :class="{ 'hidden': !activeChat && window.innerWidth < 768, 'block': activeChat }" wire:poll.5s="checkChatStatus">
    @if ($this->activeConsultation)
      <div class="flex flex-col h-full">
        <!-- Chat Header -->
        <div
          class="sticky top-0 z-10 flex items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 border-b dark:border-gray-700">
          <div class="flex items-center gap-3">
            <button @click="activeChat = false" class="md:hidden text-gray-600">
              <x-filament::icon icon="heroicon-o-chevron-left" class="w-6 h-6" />
            </button>
            <x-filament::avatar
              src="https://ui-avatars.com/api/?name={{ urlencode($this->activeConsultation['other_person_name']) }}"
              alt="{{ $this->activeConsultation['other_person_name'] }}" class="w-10 h-10 rounded-full m-10" />
            <h2 class="font-bold text-black dark:text-white text-sm md:text-lg">
              {{ $this->activeConsultation['other_person_name'] }}
            </h2>
          </div>
          <h5 class="text-black dark:text-white text-xs md:text-sm">Jadwal:
            {{ substr($this->activeConsultation['jadwal_start'], 0, 5) }}
            - {{ substr($this->activeConsultation['jadwal_end'], 0, 5) }}</h5>
        </div>

        <!-- Accordion Section -->
        <div x-data="{ open: false }" class="relative w-full border-t">
          <button @click="open = !open"
            class="w-full text-left p-4 bg-gray-50 border-b flex justify-between items-center">
            <span class="text-sm text-gray-700">{{ __('Detail Konsultasi') }}</span>
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
          </button>
          <div x-show="open" x-cloak
            class="absolute left-0 w-full bg-white border-t shadow-lg p-4 z-50 max-h-60 overflow-y-auto">
            <h4 class="font-semibold text-sm text-gray-800 mb-2">{{ __('Judul Konsultasi') }}</h4>
            <p class="text-gray-600 text-sm mb-4">
              {{ $this->activeConsultation['judul_konsultasi'] ?? 'No title available' }}
            </p>
            <h4 class="font-semibold text-sm text-gray-800 mb-2">{{ __('Penjelasan') }}</h4>
            <p class="text-gray-600 text-sm">
              {{ $this->activeConsultation['penjelasan'] ?? 'No explanation available' }}
            </p>
          </div>
        </div>

        <!-- Chat Messages -->
        <div class="h-screen flex-1 overflow-y-auto p-6 bg-white dark:bg-gray-900 custom-scrollbar"
          wire:poll.1s="loadConsultations">
          @forelse ($this->messages as $message)
            <div class="flex {{ $message['from_user_id'] === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4 ">
              <div
                class="max-w-[70%] p-3 rounded-lg shadow-lg {{ $message['from_user_id'] === auth()->id() ? 'bg-blue-500 text-black dark:text-white' : 'bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-200' }}">
                <p class="text-sm break-words">
                  {{ $message['message'] }}
                </p>
                <span
                  class="text-xs {{ $message['from_user_id'] === auth()->id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }} mt-1 block text-right">
                  {{ Carbon::parse($message['created_at'])->format('H:i') }}
                </span>
              </div>
            </div>
          @empty
            <div class="flex justify-center items-center h-full text-gray-500 dark:text-gray-400">
              No messages yet
            </div>
          @endforelse
        </div>

        <!-- Message Input -->
        <div class="sticky bottom-0 p-4 bg-gray-100 dark:bg-gray-800 border-t dark:border-gray-700">
          @if ($this->activeConsultation['status'] === true)
            <div class="text-center text-gray-700 dark:text-gray-400">
              Chat telah selesai.
            </div>
          @elseif (Carbon::parse($this->activeConsultation['jadwal_start'])->isFuture())
            <div class="text-center text-gray-700 dark:text-gray-400">
              Chat belum dimulai.
            </div>
          @elseif ($this->chatEnded)
            <div class="text-center text-gray-700 dark:text-gray-400">
              Chat telah selesai.
            </div>
          @else
            <form wire:submit.prevent="sendMessage">
              <div class="flex items-center space-x-3">
                <input type="text" wire:model="newMessage" placeholder="Tulis sebuah pesan..."
                  class="flex-1 p-2 rounded-lg border text-black border-gray-300 dark:text-black"
                  @if ($chatEnded) disabled @endif>
                <button type="submit" class="px-4 py-2 bg-gray-500 dark:bg-white text-black dark:text-white rounded-lg"
                  @if ($chatEnded) disabled @endif>{{ __('Kirim') }} </button>
              </div>
            </form>
          @endif
        </div>
      </div>
    @else
      <!-- No Conversation Selected -->
      <div class="flex flex-col items-center justify-center h-full text-center">
        <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('Select a conversation to start chatting') }}</p>
      </div>
    @endif
  </div>
</div>
