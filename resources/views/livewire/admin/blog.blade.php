<div>

    <div>
        <x-alerts.success/>
    </div>

    <h1 class="p-2">Blogs Management</h1>

    <x-buttons.primary href="{{route('blog.manage','create')}} " text="Add New Blog"/>

    <div class="flex flex-wrap items-center justify-center p-2" x-data="{ show: @entangle('show') }">
        <input type="text" name="search" id="search" placeholder="Search"
               class="bg-secondaryText rounded-md border-0 text-text mr-2 w-full mb-2"
               wire:model.live.debounce.500ms="search"
        >

        <select name="status" id="status" class="bg-secondaryText rounded-md border-0 text-text mr-2 w-1/2 mb-2"
                wire:model.live.debounce.500ms="status">
            <option value="">Status</option>
            <option value="0">Draft</option>
            <option value="1">Published</option>
            <option value="2">Private</option>
        </select>

        <select name="perPage" id="perPage" class="bg-secondaryText rounded-md border-0 text-text mr-2 w-1/5 mb-2"
                wire:model.live.debounce.500ms="perPage">
            <option value="">Per page</option>
            <option value="4">4</option>
            <option value="6">6</option>
            <option value="8">8</option>
            <option value="10">10</option>
            <option value="12">12</option>
        </select>

        <select name="sort" id="sort" class="bg-secondaryText rounded-md border-0 text-text w-1/4 mb-2"
                wire:model.live.debounce.500ms="sort">
            <option value="">Sort</option>
            <option value="desc">Desc</option>
            <option value="asc">Asc</option>
        </select>

        <div class="font-semibold relative w-full">
            <!-- category -->
            <section>
                <button @click="show = !show" id="dropdownBgHoverButton"
                        class="bg-secondaryText rounded-md border-0 text-text w-full mr-2 mb-2 p-2">
                    Click Here For Categories
                </button>

                <!-- Dropdown menu -->

                <div @click.away="show = false" x-show="show"
                     class="absolute left-1/2 transform -translate-x-1/2 bg-white border border-gray-200 rounded-lg shadow-lg mt-2 z-50 text-xl sm:text-lg w-full sm:w-screen sm:max-w-lg">

                    <ul class="py-1 flex justify-start flex-wrap">
                        @foreach($categories as $category)
                            <li class="px-4 py-2 hover:bg-gray-100">
                                <input type="checkbox" id="{{ $category->id }}" value="{{ $category->id }}"
                                       wire:model.live="category">
                                <label for="{{ $category->id }}">{{ $category->name }}</label>
                            </li>
                        @endforeach
                    </ul>

                </div>

            </section>
        </div>
    </div>

    <div class="mt-4 p-2">
        {{ $blogs->links() }}
    </div>


    <div>
        @foreach($blogs as $blog)

            <div class="bg-secondaryText rounded drop-shadow-sm m-2">
                <div class="flex justify-start">
                    <div class="w-1/3 mr-2">
                        <img src="{{asset('graphic/forest-8765686_640.jpg')}}" class="rounded-tl" alt="Blog Img">
                    </div>

                    <div>
                        <p><span>Title:</span> {{$blog->title}}</p>
                        <p><span>Author:</span> {{$blog->user->name}}</p>
                        <p><span>Category:</span>
                            @foreach($blog->categories as $blogCategory)
                                {{$blogCategory->name}} |
                            @endforeach
                        </p>
                        <p
                            x-data="{ flash: false }"
                            x-init="@this.on('status-updated', (event) => {
                                if (event.blogId === {{ $blog->id }}) {
                                    flash = true;
                                    setTimeout(() => flash = false, 1000);
                                }
                              })"
                            :class="flash ? 'bg-green-200 text-green-800' : ''"
                            class="transition-all duration-500 rounded"
                        >
                            <span>Status:</span> {{$blog->status_label}}
                        </p>
                        <p><span>Published:</span> {{ $blog->created_at->format('l j, Y ') }}</p>
                        <p><span>Updated:</span> {{ $blog->updated_at->format('l j, Y ') }}</p>
                    </div>
                </div>

                <div class="flex">
                    <x-buttons.secondary href="{{route('blog.manage', $blog->id)}}" text="Edit"
                                         class="pr-5 pl-5 pt-1 pb-1"/>

                    <div class="m-auto text-center p-2">

                        <select
                            name="status"
                            id="status"
                            class="bg-accent text-secondaryText rounded-md mr-2 pr-4 pl-4 pt-1 pb-1"
                            wire:change="updateStatus({{ $blog->id }}, $event.target.value)"
                        >
                            <option disabled  value="">Status</option>
                            <option value="0" @if($blog->status == 0) selected @endif>Draft</option>
                            <option value="1" @if($blog->status == 1) selected @endif>Published</option>
                            <option value="2" @if($blog->status == 2) selected @endif>Private</option>
                        </select>

                    </div>
                    <x-buttons.delete href=" " text="Delete" class="pr-4 pl-4 pt-1 pb-1"
                                      wire:click.prevent="delete({{$blog->id}})"
                                      wire:confirm="Are you sure you want to delete {{$blog->title}}"
                    />
                </div>

            </div>
        @endforeach
    </div>

</div>
