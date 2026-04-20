@if ($teachers->hasPages())
    <div class="flex justify-center">
        {{ $teachers->links() }}
    </div>
@endif
