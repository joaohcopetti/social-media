<title inertia>{{ $title ?? 'Perfis Sociais' }}</title>
<meta name="title" content="{{ $title ?? 'Perfis Sociais' }}" />

@if(isset($description) && !!$description)
<meta name="description" content="{{ $description}}" />
@endisset
