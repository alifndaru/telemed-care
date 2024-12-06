@php
  use Carbon\Carbon;
@endphp
<div class="h-[calc(100vh-100px)] grid grid-cols-1 md:grid-cols-3 bg-white">
  <!-- Left Sidebar: Conversation List -->
  <div class="border-r bg-white">
    <div class="bg-blue-500 p-4 border-b border-blue-200">
      <div class="flex items-center justify-between space-x-3">
        <x-filament::icon icon="heroicon-m-chat-bubble-left-right" class="w-6 h-6 text-white" />
        <h2 class="text-lg font-bold text-white">{{ __('Chat Konsultasi') }}</h2>
        <x-filament::badge class="bg-white font-bold text-blue-700 ring-2">
          {{ count($this->consultations) }}
        </x-filament::badge>
      </div>
    </div>

    <!-- Chat List -->
    <div class="overflow-y-auto custom-scrollbar p-2">
      @forelse ($this->consultations as $consultation)
        <div wire:key="{{ $consultation['id'] }}" wire:click="selectConsultation({{ $consultation['id'] }})"
          class="p-4 mb-2 rounded-lg cursor-pointer transition-all duration-200 
                {{ $this->activeConsultation && $this->activeConsultation['id'] === $consultation['id']
                    ? 'bg-blue-200'
                    : 'hover:bg-blue-100' }}">
          <div class="flex items-center space-x-4">
            <x-filament::avatar
              src="https://ui-avatars.com/api/?name={{ urlencode($consultation['other_person_name']) }}"
              alt="{{ $consultation['other_person_name'] }}" class="w-12 h-12 rounded-full ring-2 ring-white" />
            <div class="flex-1 min-w-0">
              <div class="flex justify-between items-center mb-1">
                <h3 class="font-semibold text-gray-800 truncate">
                  {{ $consultation['other_person_name'] }}
                </h3>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                  {{ $consultation['last_message_time'] ? Carbon::parse($consultation['last_message_time'])->shortRelativeDiffForHumans() : '' }}
                </span>
              </div>
              <div class="flex items-center justify-between">
                <p class="text-gray-800 truncate pr-2">
                  @if ($consultation['is_sender'])
                    <span class="text-blue-600 dark:text-blue-400 font-bold">Kamu: </span>
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
        <p class="mt-6 text-blue-500 text-center">{{ __('Belum ada percakapan') }}</p>
      @endforelse
    </div>
  </div>

  <!-- Right Side: Chat Room -->
  <div class="md:col-span-2 bg-gray-100 flex flex-col h-[calc(100vh-100px)] overflow-y-auto">
    @if ($this->activeConsultation)
      <!-- Chat Header -->
      <div class="bg-white py-4 px-6 flex justify-between items-center">
        <div class="flex items-center gap-5">
          <x-filament::avatar
            src="https://ui-avatars.com/api/?name={{ urlencode($this->activeConsultation['other_person_name']) }}"
            alt="{{ $this->activeConsultation['other_person_name'] }}" class="w-10 h-10 rounded-full" />
          <div class="detail-profile">
            <h2 class="font-bold ">
              {{ $this->activeConsultation['other_person_name'] }}
            </h2>
            <span class="text-gray-500">{{ $consultation['other_person_spesialis'] }}</span>
          </div>
        </div>
        <h5>Jadwal: {{ substr($consultation['jadwal_start'], 0, 5) }} -
          {{ substr($consultation['jadwal_end'], 0, 5) }}</h5>
        <h5 class="font-bold">{{ $consultation['klinik'] }}</h5>
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
          <p class="text-gray-600 mb-4">{{ $consultation['judul_konsultasi'] }}</p>
          <h4 class="font-semibold text-gray-800 mb-2">{{ __('Penjelasan') }}</h4>
          <p class="text-gray-600 text-sm">{{ $consultation['penjelasan'] }}</p>
        </div>
      </div>

      <!-- Chat Messages -->
      <div class="flex-1 p-4 bg-blue-50 custom-scrollbar h-[calc(100vh-100px)] overflow-y-auto"
        wire:poll.1s=loadConsultations>
        @forelse ($this->messages as $message)
          <div class="flex {{ $message['from_user_id'] === auth()->id() ? 'justify-end' : 'justify-start' }} mb-4"
            wire:poll.1s=loadConsultations>
            <div
              class="max-w-[70%] p-3 rounded-lg shadow {{ $message['from_user_id'] === auth()->id() ? 'bg-blue-500 text-white' : 'bg-blue-100' }}">
              <p class="{{ $message['from_user_id'] === auth()->id() ? 'text-white' : 'text-gray-700' }} break-words">
                {{ $message['message'] }}
              </p>
              <span
                class="text-xs {{ $message['from_user_id'] === auth()->id() ? 'text-white' : 'text-gray-700 text-end' }} mt-1 block">
                {{ Carbon::parse($message['created_at'])->format('H:i') }}
              </span>
            </div>
          </div>
        @empty
          <div class="mt-6 text-center">
            <p>{{ __('Belum ada pesan.') }}</p>
          </div>
        @endforelse
      </div>

      <!-- Message Input -->
      <div class="bg-blue-100 p-4 border-t border-blue-200">
        @if ($activeConsultation && $activeConsultation['status'] !== true)
          <form wire:submit.prevent="sendMessage">
            <div class="flex items-center space-x-3">
              <input type="text" wire:model="newMessage" placeholder="Tulis sebuah pesan..."
                class="flex-1 p-2 border border-blue-300 rounded-lg focus:outline-none"
                @if ($chatEnded) disabled @endif>
              <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700"
                @if ($chatEnded) disabled @endif>{{ __('Kirim') }} </button>
            </div>
          </form>
        @else
          <div class="p-4 border-t border-gray-200 dark:border-gray-700 text-center text-gray-500 dark:text-gray-400">
            Chat berakhir. Kamu tidak dapat mengirim pesan lagi.
          </div>
        @endif
      </div>
    @else
      <div class="h-[calc(100vh-100px)] flex flex-col justify-center">
        <img src="{{ asset('images/logo_telemedicine.png') }}" alt="pkbi"
          class="w-36 md:w-44 lg:w-52 h-auto mx-auto object-cover" loading="lazy">
        <h5 class="text-center text-lg  p-4 text-blue-600">{{ __('Pilih room chat untuk memulai konsultasi') }}
        </h5>
      </div>
    @endif
  </div>
</div>
