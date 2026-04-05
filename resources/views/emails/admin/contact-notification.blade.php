<x-mail::message>
# @if($contact->parent_id) New Reply from User @else New Contact Form Submission @endif

You have received a @if($contact->parent_id) reply @else new message @endif from @if($contact->parent_id) the message portal @else the contact form @endif.

**From:** {{ $contact->name }} ({{ $contact->email }})

**Message:**
{{ $contact->message }}

<x-mail::button :url="$url">
View @if($contact->parent_id) Reply @else Message @endif in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
