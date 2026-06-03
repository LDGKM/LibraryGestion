<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Utilisateurs') }}
        </h2>
    </x-slot>
	<table>
		<tr>
			<td>Utilisateurs</td>
			<td>Role</td>
			<td>Status</td>
			<td>Nombre de pret en cours</td>
			<td>Nombre de pret total  </td>
			<td>Actions</td>
		</tr>
		@foreach($users as $user)
		<tr>
			<td>{{$user->name}}</td>
			<td>{{$user->role}}</td>
			<td>{{$user->status}}</td>
			<td>{{$user->nb_pret}}</td>
			<td>{{$user->nb_pret_total}}</td>
			<td>
				<form action="{{ route('users.userUpdate',$user->id) }}" method="POST">
				@csrf
				@method('put')
				@if(auth()->check() && auth()->user()->isSuperAdmin())
				<button type="submit" name="promote">Promouvoir</button>
				<button type="submit" name="demote">Limoger</button>
				@endif
				<button type="submit" name="suspend">Suspendre</button>
				<button type="submit" name="block">Bloquer</button>
				</form>	
			</td>
		</tr>
		@endforeach
	</table>
</x-app-layout>