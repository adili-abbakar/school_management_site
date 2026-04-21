@if ($sessions->hasPages())
    <div class="flex justify-center">
        {{ $sessions->links() }}
    </div>
@endif
