<div class="min-h-screen bg-gradient-to-b from-bg via-bg to-lightGray/20 dark:from-navbg dark:via-navbg dark:to-accent/10">
    <x-alerts.success/>
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
            <div class="bg-danger/10 border-2 border-danger/50 text-danger px-6 py-4 rounded-sm relative">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Header Section --}}
    <header class="relative mb-12 overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-px bg-primary/20"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center space-y-4">
                <div class="flex items-center justify-center gap-4 mb-4">
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                    <svg class="w-8 h-8 text-secondary dark:text-primary" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <div class="h-px w-16 lg:w-32 bg-secondary/40"></div>
                </div>

                <h1 class="text-text font-heading">Classification Archives</h1>
                <p class="text-base lg:text-lg text-text/70 font-serif italic mx-auto">
                    "Organize the vast realms of knowledge through carefully curated categories"
                </p>

                <div class="flex items-center justify-center gap-2 mt-6">
                    <div class="h-px w-8 bg-secondary/30"></div>
                    <div class="w-1.5 h-1.5 rotate-45 bg-primary/50"></div>
                    <div class="h-px w-8 bg-secondary/30"></div>
                </div>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 space-y-8">
        {{-- Create New Category Button --}}
        <div class="flex justify-center">
            <button wire:click="openCreateModal"
                    class="relative px-8 py-3 font-serif text-sm text-white bg-secondary hover:bg-secondary/90 dark:bg-primary dark:hover:bg-primary/90 border-2 border-secondary/50 dark:border-primary/50 transition-all duration-300 group">
                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
                <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Category
                </span>
            </button>
        </div>

        {{-- Search & Filters --}}
        <section class="relative bg-white/60 dark:bg-accent/20 backdrop-blur-sm border-2 border-secondary/20 dark:border-secondary/10 p-6 lg:p-8 rounded-sm">
            <div class="absolute top-0 left-0 w-4 h-4 border-t-2 border-l-2 border-secondary/50"></div>
            <div class="absolute top-0 right-0 w-4 h-4 border-t-2 border-r-2 border-secondary/50"></div>

            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-full bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                    <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-heading text-text">Search & Filter</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <input type="text" name="search" placeholder="Search categories..."
                       class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                       wire:model.live.debounce.500ms="search">

                <select name="perPage"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="perPage">
                    <option value="15">15 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                    <option value="100">100 per page</option>
                </select>

                <select name="sort"
                        class="bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-secondary dark:focus:border-primary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                        wire:model.live.debounce.500ms="sort">
                    <option value="desc">Newest First</option>
                    <option value="asc">Oldest First</option>
                </select>
            </div>
        </section>

        {{-- Pagination --}}
        <div class="flex justify-center">
            {{ $categories->links() }}
        </div>

        {{-- Categories Table --}}
        <section class="relative bg-white/80 dark:bg-accent/30 backdrop-blur-sm border-2 border-text/10 rounded-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-primary/10 dark:bg-primary/20 border-b-2 border-primary/30">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-heading uppercase tracking-wider text-text">Name</th>
                        <th class="px-6 py-4 text-left text-xs font-heading uppercase tracking-wider text-text">Slug</th>
                        <th class="px-6 py-4 text-center text-xs font-heading uppercase tracking-wider text-text">Books</th>
                        <th class="px-6 py-4 text-center text-xs font-heading uppercase tracking-wider text-text">Blogs</th>
                        <th class="px-6 py-4 text-center text-xs font-heading uppercase tracking-wider text-text">Created</th>
                        <th class="px-6 py-4 text-center text-xs font-heading uppercase tracking-wider text-text">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-text/10">
                    @forelse($categories as $category)
                        <tr class="hover:bg-primary/5 dark:hover:bg-primary/10 transition-colors duration-200">
                            <td class="px-6 py-4">
                                <span class="font-heading text-text">{{ $category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <code class="text-sm font-mono bg-accent/20 dark:bg-accent/40 px-2 py-1 rounded text-text/70">
                                    {{ $category->slug }}
                                </code>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold bg-secondary/20 text-secondary">
                                    {{ $category->books_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/20 text-primary">
                                    {{ $category->blogs_count }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm font-serif text-text/60">
                                {{ $category->created_at->format('M j, Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="openEditModal({{ $category->id }})"
                                            class="px-3 py-1.5 font-serif text-xs text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border border-primary/50 dark:border-secondary/50 rounded-sm transition-all duration-300">
                                        Edit
                                    </button>

                                    <button wire:click="delete({{ $category->id }})"
                                            wire:confirm="Are you sure you want to delete '{{ $category->name }}'?"
                                            class="px-3 py-1.5 font-serif text-xs text-danger bg-danger/10 hover:bg-danger/20 border border-danger/50 rounded-sm transition-all duration-300">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <svg class="w-16 h-16 mx-auto text-text/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                                </svg>
                                <h3 class="text-xl font-heading text-text mb-2">No Categories Found</h3>
                                <p class="text-text/60 font-serif">Create your first category to organize content.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        {{-- Pagination Bottom --}}
        <div class="flex justify-center pt-8">
            {{ $categories->links() }}
        </div>
    </main>

    {{-- Create/Edit Category Modal --}}
    @if($displayModal)
        <div class="fixed inset-0 bg-navbg/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="relative bg-white dark:bg-accent/95 rounded-sm border-2 border-primary/30 shadow-2xl w-full md:max-w-1/2 ">
                {{-- Modal ornaments --}}
                <div class="absolute top-0 left-0 w-6 h-6 border-t-2 border-l-2 border-primary"></div>
                <div class="absolute top-0 right-0 w-6 h-6 border-t-2 border-r-2 border-primary"></div>
                <div class="absolute bottom-0 left-0 w-6 h-6 border-b-2 border-l-2 border-primary"></div>
                <div class="absolute bottom-0 right-0 w-6 h-6 border-b-2 border-r-2 border-primary"></div>

                <div class="p-8">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center gap-3 mb-4">
                            <div class="h-px w-12 bg-primary/30"></div>
                            <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                            <div class="h-px w-12 bg-primary/30"></div>
                        </div>
                        <h2 class="font-heading text-text text-2xl">
                            {{ $isEditing ? 'Edit Category' : 'Create New Category' }}
                        </h2>
                        <p class="text-sm text-text/60 font-serif italic mt-2">
                            {{ $isEditing ? 'Update the category information' : 'Add a new classification to the archives' }}
                        </p>
                    </div>

                    <form wire:submit="save" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-serif text-text/70 mb-2">
                                Category Name <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   id="name"
                                   wire:model.blur="name"
                                   class="w-full bg-white dark:bg-navbg/40 rounded-sm border-2 border-text/10 focus:border-primary dark:focus:border-secondary text-text px-4 py-2.5 font-serif transition-colors duration-300"
                                   placeholder="Enter category name">
                            @error('name')
                            <p class="mt-2 text-sm text-danger font-serif">{{ $message }}</p>
                            @enderror
                        </div>

                        @if($slug)
                            <div>
                                <label class="block text-sm font-serif text-text/70 mb-2">
                                    Generated Slug
                                </label>
                                <code class="block w-full bg-accent/20 dark:bg-accent/40 rounded-sm border-2 border-text/10 text-text px-4 py-2.5 font-mono text-sm">
                                    {{ $slug }}
                                </code>
                                <p class="mt-1 text-xs text-text/50 font-serif italic">Automatically generated from category name</p>
                            </div>
                        @endif

                        <div class="flex gap-4 pt-6 border-t border-text/10">
                            <button type="submit"
                                    class="flex-1 relative px-6 py-3 font-serif text-sm text-white bg-primary hover:bg-primary/90 dark:bg-secondary dark:hover:bg-secondary/90 border-2 border-primary/50 dark:border-secondary/50 transition-all duration-300">
                                <span class="absolute top-0 left-0 w-2 h-2 border-t border-l border-white/30"></span>
                                <span class="absolute top-0 right-0 w-2 h-2 border-t border-r border-white/30"></span>
                                <span class="absolute bottom-0 left-0 w-2 h-2 border-b border-l border-white/30"></span>
                                <span class="absolute bottom-0 right-0 w-2 h-2 border-b border-r border-white/30"></span>
                                {{ $isEditing ? 'Update Category' : 'Create Category' }}
                            </button>

                            <button type="button"
                                    wire:click="closeModal"
                                    class="flex-1 relative px-6 py-3 font-serif text-sm text-text bg-white/50 dark:bg-navbg/50 hover:bg-white dark:hover:bg-navbg border-2 border-text/20 hover:border-text/40 transition-all duration-300">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
