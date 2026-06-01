@if ($sections->hasPages())
    <div class="flex justify-center">
        {{ $sections->links() }}
    </div>
@endif
