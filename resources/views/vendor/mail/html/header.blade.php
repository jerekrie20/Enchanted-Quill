@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
@if (trim($slot) === 'Laravel')
<img src="{{ config('app.url') }}/graphic/quill.webp" class="logo" alt="{{ config('app.name') }} Logo">
<div style="margin-top: 10px; font-family: 'Playfair Display', serif; color: #00a3e0; font-size: 24px;">{{ config('app.name') }}</div>
@else
{!! $slot !!}
@endif
</a>
</td>
</tr>
