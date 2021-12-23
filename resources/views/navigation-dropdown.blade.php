<nav class="main-header navbar navbar-expand navbar-white navbar-light" >
    <ul class="navbar-nav ml-auto" style="width: 100%;">
        <div class="" style="width: 100%;">
            <div class="" style="width: 100%;">
                <bs-appbar class="bg-indigo" shadow>


                    <bs-spacer></bs-spacer>
                    <bs-appbar-title class="text-white" title="{{  Auth::user()!=null?Auth::user()->FULLNAME:'' }}">
                    </bs-appbar-title>
                    <bs-appbar-items>
                        <bs-menu class="ml-2" placement="bottom-right">
                            <bs-button mode="icon" color="light-grey" flat>
                                <bs-icon icon="MoreVert"></bs-icon>
                            </bs-button>
                            <template v-slot:content>
                                <bs-list-view slot="content">
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <bs-list-tile url="{{ route('logout') }}">
                                            <bs-list-tile-title>
                                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                                    {{ __('Salir') }}
                                                </x-jet-dropdown-link>
                                            </bs-list-tile-title>
                                        </bs-list-tile>
                                    </form>
                                </bs-list-view>
                            </template>
                        </bs-menu>
                    </bs-appbar-items>
                    <bs-button color="light-grey" mode="icon" flat>
                        <bs-icon data-widget="pushmenu" icon="MenuBars"></bs-icon>
                    </bs-button>
                </bs-appbar>
            </div>
        </div>
    </ul>
</nav>