<x-mail::message>
# Congratulations!

Great news, {{ $book->author->name }}!

Your book **"{{ $book->title }}"** has reached its scheduled publication time and is now live on the platform.

<x-mail::button :url="$url">
View Your Book
</x-mail::button>

Where words weave magic,<br>
The Enchanted Quill Team
</x-mail::message>
