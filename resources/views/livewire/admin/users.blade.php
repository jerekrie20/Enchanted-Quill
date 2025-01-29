<div>
    <div class="p-2"><h1>Users Management</h1></div>

    <div class="flex items-center justify-center p-2">
        <input type="text" name="search" id="search" placeholder="Search"
               class="bg-lightGray rounded-md border-0 text-text mr-2 w-1/2"
               wire:model.live.debounce.500ms="search"
        >

        <select name="sortRole" id="sortRole" class="bg-lightGray  rounded-md border-0 text-text w-1/4 mr-2 "
                wire:model.live.debounce.500ms="sortRole">
            <option value="">Role</option>
            <option value="admin">Admin</option>
            <option value="author">Author</option>
            <option value="reader">Reader</option>
        </select>

        <select name="sort" id="sort" class="bg-lightGray  rounded-md border-0 text-text w-1/4"
                wire:model.live.debounce.500ms="sort">
            <option value="desc">Sort</option>
            <option value="desc">Desc</option>
            <option value="ASC">asc</option>
        </select>


    </div>


    <div class="mt-8 p-2">
        {{ $users->links() }}
    </div>


    <div>
        <x-alerts.success/>
    </div>


    <div class="p-2 ">
        @foreach($users as $user)
            <div class="md:hidden bg-lightGray  rounded-md shadow-md hover:shadow-lg p-3 mb-4">
                <p class="text-text"><span class="font-semibold">Name: </span>{{$user->name}}</p>
                <p class="text-text"><span class="font-semibold">Email: </span>{{$user->email}}</p>
                <p class="text-text"><span class="font-semibold">Role: </span> {{$user->role}}</p>
                <p class="text-text"><span
                        class="font-semibold">Last Active:</span> {{$user->last_active ? $user->last_active->diffForHumans() : 'Never'}}
                </p>

                <p class="text-text mt-2"><span class="font-semibold">Auctions:</span>
                    <button wire:click="openModal({{$user->id}})"
                            class="border-2 border-secondary text-center pr-10 pl-10 pt-1 pb-1 rounded-md hover:border-primary">
                        Edit
                    </button>


                    <button
                        type="button"
                        wire:click="delete({{$user->id}})"
                        wire:confirm="Are you sure you want to delete {{$user->name}}"
                        class="border-2 border-secondary text-center pr-10 pl-10 pt-1 pb-1 rounded-md">Delete
                    </button>
                </p>


            </div>
        @endforeach
    </div>

    <div class="mt-8 p-2">
        {{ $users->links() }}
    </div>

    <div wire:key="edit-user-modal" class="{{ $displayModel ? 'block' : 'hidden' }}">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center ">
            <div class="bg-white px-3 mx-3 rounded-md shadow-md w-full ">
                <h2 class="my-3">Edit User</h2>
                <!-- Include your form here using @wire or standard form structure -->
                <form wire:submit="update">

                    <div class="flex flex-col justify-center">
                        <x-forms.input-text name="name" wire:model.blur-sm="name"/>
                        <x-forms.input-email name="email" wire:model.blur-sm="email"/>
                        <x-forms.input-select name="role" wire:model.blur-sm="role" :data="$roleArray"/>
                    </div>

                    <div class="flex flex-col justify-center">
                        <x-forms.input-password wire:model.blur="password"/>
                        <x-forms.input-conf-password wire:model.blur="password_confirmation"/>
                    </div>

                    <div class="flex justify-center mb-4">
                        <x-forms.input-submit/>

                        <button wire:click.prevent="closeModal"
                                class="border-2 border-secondary text-center pr-10 pl-10 pt-1 pb-1 rounded-md hover:border-primary">
                            Close
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>


</div>
