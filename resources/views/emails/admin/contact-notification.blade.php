<x-mail::message>
# @if($contact->parent_id) New Reply from User @else New Contact Form Submission @endif

You have received a @if($contact->parent_id) reply @else new message @endif from @if($contact->parent_id) the message portal @else the contact form @endif.

**From:** {{ $contact->name }} ({{ $contact->email }})

**Message:**

<x-mail::panel>
{{ $contact->message }}
</x-mail::panel>

<x-mail::button :url="$url">
View @if($contact->parent_id) Reply @else Message @endif in Admin Panel
</x-mail::button>

Where words weave magic,<br>
The Enchanted Quill Team
</x-mail::message>
