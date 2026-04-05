<x-mail::message>
# You Have a New Message

Hello {{ $contact->user ? $contact->user->name : $contact->name }},

You have received a new message from the Enchanted Quill team.

**Message:**
{{ $contact->message }}

@if($contact->user_id)
<x-mail::button :url="$url">
View Message in Portal
</x-mail::button>
@endif

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
