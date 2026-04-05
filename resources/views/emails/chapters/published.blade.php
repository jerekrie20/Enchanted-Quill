<x-mail::message>
# Congratulations!

Great news, {{ $chapter->book->author->name }}!

Your chapter **"{{ $chapter->title }}"** from the book **"{{ $chapter->book->title }}"** has reached its scheduled publication time and is now live on the platform.

<x-mail::button :url="$url">
View Your Chapter
</x-mail::button>

Where words weave magic,<br>
The Enchanted Quill Team
</x-mail::message>
