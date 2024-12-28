<x-Layouts.admin>

    <x-slot:title>
        Settings
    </x-slot>


    <div class="p-2"><h1>Settings</h1></div>

    <div class="mt-3">
        <ul class="flex flex-wrap mx-2 font-medium text-center " id="default-tab"
            data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="border-2 border-secondary " role="presentation">
                <button class="inline-flex items-center justify-center p-4 group text-text aria-selected:bg-secondary aria-selected:text-text   "
                        id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile"
                        aria-selected="false">
                    <i class="fa-regular fa-user mr-2" style="color: #0d1111;"></i>Personal Info
                </button>
            </li>
            <li class="border-2 border-secondary" role="presentation">
                <button class="inline-flex items-center justify-center p-4 group text-text aria-selected:bg-secondary aria-selected:text-text " id="dashboard-tab"
                        data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                        aria-selected="false">
                    <i class="fa-solid fa-shield-halved mr-2" style="color: #0d1111;"></i>Security
                </button>
            </li>
        </ul>
    </div>

    <div id="default-tab-content">
        <div class="hidden p-4 bg-secondaryText mx-2" id="profile" role="tabpanel"
             aria-labelledby="profile-tab">
            <livewire:general.personal/>
        </div>
        <div class="hidden p-4 bg-secondaryText mx-2" id="dashboard" role="tabpanel"
             aria-labelledby="dashboard-tab">
            <p class="text-sm text-gray-500 dark:text-gray-400">This is some placeholder content the <strong
                    class="font-medium text-gray-800 dark:text-white">Dashboard tab's associated content</strong>.
                Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps
                classes to control the content visibility and styling.</p>
        </div>
    </div>


</x-Layouts.admin>
