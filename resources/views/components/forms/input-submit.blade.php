@props(['value'])

<input type="submit" value="{{!empty($value) ? $value : 'Submit' }}" class="hover:bg-secondary hover:cursor-pointer pr-10 pl-10 pt-1 pb-1  border border-secondary text-text rounded-md mr-2 ">
