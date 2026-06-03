<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Accueil</title>
</head>
<body>
	@if(!auth()->check())<h1>Bienvenue sur la plateforme de notre Librairie</h1>@endif
	@include('librarygestion.book.index')

	@if(!auth()->check())
	<a href="{{route('login')}}"><button>Se connecter</button></a>
	<a href="{{route('register')}}"><button>S'inscrire</button></a>
	@endif
</body>
</html>