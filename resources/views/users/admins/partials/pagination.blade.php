@if ($admins->hasPages())
    <div class="flex justify-center">
        {{ $admins->links() }}
    </div>
@endif
