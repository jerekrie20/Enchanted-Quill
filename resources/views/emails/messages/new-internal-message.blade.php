<x-mail::message>
# You Have a New Message

Hello {{ $contact->user ? $contact->user->name : $contact->name }},

You have received a new message from the Enchanted Quill team.

**Message:**

<x-mail::panel>
{{ $contact->message }}
</x-mail::panel>

@if($contact->user_id)
<x-mail::button :url="$url">
View Message in Portal
</x-mail::button>
@endif

Where words weave magic,<br>
The Enchanted Quill Team
</x-mail::message>
