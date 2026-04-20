@if ($students->hasPages())
    <div class="flex justify-center">
        {{ $students->links() }}
    </div>
@endif
