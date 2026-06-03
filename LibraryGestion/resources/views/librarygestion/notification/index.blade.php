<x-app-layout>    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notifications') }}
        </h2>
    </x-slot>
    @if($notifications->isEmpty())
    <p>Aucun message pour le moment</p>
    @else
		@foreach($notifications as $notif)
		<div>
			{{ $notif->data['message'] }}
		</div>
		@endforeach
	@endif
</x-app-layout>