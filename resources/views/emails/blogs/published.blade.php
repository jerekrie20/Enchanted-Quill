<x-mail::message>
# Congratulations!

Great news, {{ $blog->user->name }}!

Your blog post **"{{ $blog->title }}"** has reached its scheduled publication time and is now live on the platform.

<x-mail::button :url="$url">
View Your Blog Post
</x-mail::button>

Where words weave magic,<br>
The Enchanted Quill Team
</x-mail::message>
