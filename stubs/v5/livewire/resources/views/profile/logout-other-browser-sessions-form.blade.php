<x-jet-action-section>
    <x-slot name="title">
        Browser Sessions
    </x-slot>

    <x-slot name="description">
        Manage and logout your active sessions on other browsers and devices.
    </x-slot>

    <x-slot name="content">
        <div>
            If necessary, you may logout of all of your other browser sessions across all of your devices. If you feel your account has been compromised, you should also update your password.
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-3">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="d-flex">
                        <div>
                            @if ($session->agent->isDesktop())
                                <svg fill="none" width="32" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="text-muted">
                                    <path d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" class="text-muted">
                                    <path d="M0 0h24v24H0z" stroke="none"></path><rect x="7" y="4" width="10" height="16" rx="1"></rect><path d="M11 5h2M12 17v.01"></path>
                                </svg>
                            @endif
                        </div>

                        <div class="ml-2">
                            <div>
                                {{ $session->agent->platform() }} - {{ $session->agent->browser() }}
                            </div>

                            <div>
                                <div class="small font-weight-lighter text-muted">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-success font-weight-bold">This device</span>
                                    @else
                                        Last active {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="d-flex mt-3">
            <x-jet-button wire:click="confirmLogout" wire:loading.attr="disabled">
                Logout Other Browser Sessions
            </x-jet-button>

            <x-jet-action-message class="ml-3" on="loggedOut">
                Done.
            </x-jet-action-message>
        </div>

        <!-- Logout Other Devices Confirmation Modal -->
        <x-jet-dialog-modal wire:model="confirmingLogout">
            <x-slot name="title">
                Logout Other Browser Sessions
            </x-slot>

            <x-slot name="content">
                Please enter your password to confirm you would like to logout of your other browser sessions across all of your devices.

                <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                    <x-jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                 x-ref="password"
                                 wire:model.defer="password"
                                 wire:keydown.enter="logoutOtherBrowserSessions" />

                    <x-jet-input-error for="password" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    Nevermind
                </x-jet-secondary-button>

                <x-jet-button class="ml-2" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    Logout Other Browser Sessions
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </x-slot>
</x-jet-action-section>
