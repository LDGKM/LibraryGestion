<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Balance') }}
        </h2>
    </x-slot>
		<label>Solde Courant</label>
		<p>{{ $user->balance }}</p>

		<label>Recharger votre compte</label>
		<label>Retirer de l'argent</label>
</x-app-layout>
