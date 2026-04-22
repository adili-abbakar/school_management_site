@if ($applications->hasPages())
    <div class="flex justify-center">
        {{ $applications->links() }}
    </div>
@endif
