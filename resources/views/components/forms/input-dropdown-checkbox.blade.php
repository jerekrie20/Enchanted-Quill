@props(['name', 'modal', 'data'])

<p class="mb-2 text-lg font-medium ">{{$name}}</p>

<button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox"
        class="rounded-md bg-accent  focus:ring-secondary focus:border-secondary block w-full p-2.5 text-secondaryText mb-2"
        type="button">{{$name}} <i class="fa-solid fa-angle-down text-secondaryText"></i>
</button>

<!-- Dropdown menu -->
<div id="dropdownDefaultCheckbox"
     class="z-10 w-full hidden bg-accent  divide-y divide-gray-100 rounded-lg shadow ">
    <ul class="p-3 space-y-3 text-sm text-secondary"
        aria-labelledby="dropdownCheckboxButton">

        <li>
            <div class="flex items-center flex-wrap">
                @foreach($data as $item)
                    <div class="p-2" wire:key="{{$item->id}}">
                        <input id="checkbox-item-{{$item->id}}" type="checkbox" value="{{$item->id}}"
                               class="w-4 h-4 text-secondary bg-gray-100 border-gray-300 rounded"
                               wire:model.live="{{$modal}}">
                        <label for="checkbox-item-{{$item->id}}"
                               class="ms-2 text-sm font-medium text-secondaryText ">{{$item->name}}</label>
                    </div>
                @endforeach
            </div>
        </li>

    </ul>
</div>
