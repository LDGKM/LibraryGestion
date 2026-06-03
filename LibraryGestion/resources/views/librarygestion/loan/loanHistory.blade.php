<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mes emprunts') }}
        </h2>
    </x-slot>
	<table>
		<tr>
			<td>Utilisateurs</td>
			<td>Nom du Livre</td>
			<td>Date d'emprunt</td>
			<td>Date de retour </td>
			<td>Status</td>
			<td>Actions</td>
		</tr>
		@foreach($loans as $l)
		<tr>
			<td>{{$l->user->name}}</td>
			<td><a href="{{ route('book.show',$l->book_id) }}">{{$l->book->titre}}</a></td>
			<td>{{$l->borrowed_at}}</td>
			<td>{{$l->due_at}}</td>
			<td>{{ $l->status }}</td>

			@if($l->status=='ACTIVE')
			<td>
				<form action="{{ route('borrow.statusUpdate',$l->id) }}" method="POST">
					@csrf
					@method('put')
					<button type="submit" name="RETURNED">Livre Retorune</button>
					<button type="submit" name="LOST">Livre Perdu</button>
				</form>
			</td>
			@endif
		</tr>
		@endforeach
	</table>
</x-app-layout>