<x-pulse::card :cols="$cols" :rows="$rows" :class="$class">
    <x-pulse::card-header name="Outdated Composer Dependencies">
        <x-slot:icon>
            <x-dynamic-component :component="'pulse::icons.sparkles'" />
        </x-slot:icon>
    </x-pulse::card-header>

    <x-pulse::scroll :expand="$expand" wire:poll.5s="">
        @if (!count($packages))
            <x-pulse::no-results />
        @else
            <div class="grid grid-cols-1 @lg:grid-cols-2 @3xl:grid-cols-3 @6xl:grid-cols-4 gap-2">
                <x-pulse::table>
                    <colgroup>
                        <col width="100%" />
                        <col width="0%" />
                        <col width="0%" />
                    </colgroup>
                    <x-pulse::thead>
                        <tr>
                            <x-pulse::th>Package</x-pulse::th>
                            <x-pulse::th class="text-right">Installed</x-pulse::th>
                            <x-pulse::th class="text-right">Available</x-pulse::th>
                        </tr>
                    </x-pulse::thead>
                    <tbody>
                    @foreach ($packages as $package)
                        <tr class="h-2 first:h-0"></tr>
                        <tr wire:key="{{ $package['name'] }}">
                            <x-pulse::td class="max-w-[1px]">
                                <code class="block text-xs text-gray-900 dark:text-gray-100 truncate" title="">
                                    {{ $package['name'] }}
                                </code>
                                @isset($package['source'])
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 truncate" title="">
                                        <a href='{{ $package['source'] }}'>
                                            {{ str($package['source'])->after('://') }}
                                        </a>
                                    </p>
                                @endisset
                            </x-pulse::td>
                            <x-pulse::td numeric class="text-gray-700 dark:text-gray-300 font-bold">
                                {{ $package['version'] }}
                            </x-pulse::td>
                            <x-pulse::td numeric class="text-gray-700 dark:text-gray-300 font-bold">
                                {{ $package['latest'] }}
                            </x-pulse::td>
                        </tr>
                    @endforeach
                    </tbody>
                </x-pulse::table>
            </div>
        @endif
    </x-pulse::scroll>
</x-pulse::card>
