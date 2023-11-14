@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://crn.advantisexpress.com//images/advantis-express.png" class="logo" width="1575px" height="566px">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
