    <button
        class="filter-btn  @if ($category->name == 'Culinary') btn  @else btn  @endif  border-0 py-2 w-100 rounded fw-bold"
        onclick="filterTable('{{ $category->name }}')">
        {{ $category->name }}
    </button>
