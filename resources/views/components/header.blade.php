<div class="bg-base-100 border-base-content/20 sticky top-0 z-50 flex border-b lg:ps-75">
    <div class="mx-auto w-full max-w-screen">
        <nav class="navbar py-2">
            <div class="navbar-start gap-2">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-toggle" data-overlay="#layout-toggle">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>
            </div>

            <div class="navbar-end gap-6">
                <div class="dropdown relative inline-flex [--offset:21]">
                    <div class="flex items-center gap-4">
                        <div class="flex flex-col items-end">
                            <p class="text-base-content/80 text-sm font-medium">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-base-content/80 text-xs font-medium">( {{ auth()->user()->role }} )</p>
                        </div>
                        <button id="profile-dropdown" type="button" class="dropdown-toggle avatar" aria-haspopup="menu"
                            aria-expanded="false" aria-label="Dropdown">
                            <span class="rounded-full size-12">
                                <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/default-avatar.png') }}" alt="User Avatar" />
                            </span>
                        </button>
                    </div>
                    <ul class="dropdown-menu dropdown-open:opacity-100 hidden w-full max-w-75 space-y-0.5"
                        role="menu" aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header mb-1 gap-4 px-5 pt-4.5 pb-3.5">
                            <div class="avatar avatar-online-top">
                                <div class="w-10 rounded-full">
                                    <img src="https://cdn.flyonui.com/fy-assets/avatar/avatar-8.png" alt="avatar" />
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">Charlotte Anne</h6>
                                <p class="text-base-content/80 font-medium">Influencer</p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--user] size-5"></span>
                                My account
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--settings] size-5"></span>
                                Setting
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--credit-card] size-5"></span>
                                Billing
                            </a>
                        </li>
                        <li>
                            <hr class="border-base-content/20 -mx-2 my-1" />
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--users] size-5"></span>
                                Manage team
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--edit] size-5"></span>
                                Customisation
                            </a>
                        </li>
                        <li class="mb-1">
                            <a class="dropdown-item px-3" href="#">
                                <span class="icon-[tabler--circle-plus] size-5"></span>
                                Add team account
                            </a>
                        </li>
                        <li class="dropdown-footer p-2 pt-1">
                            <a class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal"
                                href="#">
                                <span class="icon-[tabler--logout] size-5"></span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
