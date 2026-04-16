<div>
    @auth
    <a wire:click="toggle" class="cursor-pointer">
        @if ($heartable->isHearted())
        <span class="text-red-600 text-xl">&hearts;</span>
        @else
        <span class="text-gray-600 text-xl">&hearts;</span>
        @endif
    </a>
    @else
    <span class="text-gray-600 text-xl">&hearts;</span>
    @endauth
</div>