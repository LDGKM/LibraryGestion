<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes emprunts') }}
        </h2>
    </x-slot>
	<table>
		<tr>
			<td>Nom du Livre</td>
			<td>Date d'emprunt</td>
			<td>Date de retour </td>
			<td>Status</td>
			<td>Actions</td>
		</tr>
		@foreach($loans as $l)
		<tr>
			<td><a href="{{ route('book.show',$l->book_id) }}">{{$l->book->titre}}</a></td>
			<td>{{$l->borrowed_at}}</td>
			<td>{{$l->due_at}}</td>
			<td>{{ $l->status }}</td>
			<td>
				@if($l->status=='PENDING')
				<form action="{{ route('borrow.destroy',$l->id) }}" method="POST">
					@csrf
					@method('delete')
					<button type="submit">Annuler</button>
				</form>
				@else
				{{ __('Merci pour votre emprunt') }}
				@endif
			</td>
		</tr>
		@endforeach
	</table>
</x-app-layout>