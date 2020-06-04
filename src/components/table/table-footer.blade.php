<div class="d-flex justify-content-between mt-3">
    <div class="text-weight-light">
        Showing {{ $items->firstItem() }} to {{ $items->lastItem() }} out of {{ $items->total() }} results
    </div>
    <div>
        {{ $items->links() }}
    </div>
</div>
