@component('mail::message')
# Hola tu articulo ha recibo un nuevo comentario

{{ $comment->text }}
The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
